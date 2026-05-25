<?php
require_once APP_DIR . '/Controllers/BaseController.php';

require_once APP_DIR . '/Models/BaznaKonekcija.php';
require_once APP_DIR . '/Models/BaznaTabela.php';
require_once APP_DIR . '/Models/BaznaTransakcija.php';
require_once APP_DIR . '/Models/DBHospitalizacija.php';
require_once APP_DIR . '/Models/DBPrijem.php';
require_once APP_DIR . '/Models/DBAktivnost.php';
require_once APP_DIR . '/Models/DBMKB.php';
require_once APP_DIR . '/Models/DBOdeljenje.php';
require_once APP_DIR . '/Models/DBOtpust.php';
require_once APP_DIR . '/Models/DBIzvestaj.php';
require_once APP_DIR . '/Models/DBStoredProcedure.php';
require_once APP_DIR . '/Models/PoslovnaLogika.php';

class HospitalizacijaController extends BaseController {

    private function db(): Konekcija {
        $db = new Konekcija(APP_DIR . '/Models/BaznaParametriKonekcije.xml');
        $db->connect();
        if (!$db->konekcijaDB) {
            Response::serverError('db_connect_failed');
        }
        return $db;
    }

    // GET api/hospitalizacije-index
    public function index(): void {
        $db = $this->db();
        $h  = new Hospitalizacija($db, 'hospitalizacija');

        $col   = $h->DajPogledHospitalizacija();
        $count = $h->DajUkupanBrojSvihHospitalizacija($col);

        $items = [];
        for ($i = 0; $i < $count; $i++) {
            $items[] = [
                'brojIstorijeBolesti'         => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 0),
                'datumPrijema'                => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 1),
                'datumOtpusta'                => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 2),
                'osnovniUzrokHospitalizacije' => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 3),
            ];
        }

        $db->disconnect();
        $this->json(['items' => $items]);
    }

    // GET api/hospitalizacija-izmeni?id=
    public function show(): void {
        $this->requireAuth();

        $id = trim($this->request->get('id', ''));
        if ($id === '') {
            $this->json(['error' => 'missing_id'], 400);
        }

        $db = $this->db();
        $h  = new Hospitalizacija($db, 'hospitalizacija');

        $col = $h->DajKolekcijuHospitalizacijaFiltriranoIzmena('ID', $id, '=', 'DATUMOTPUSTA');
        if ($h->DajUkupanBrojSvihHospitalizacija($col) < 1) {
            $db->disconnect();
            $this->json(['error' => 'not_found'], 404);
        }

        $hospitalizacija = [
            'id'                              => $id,
            'idPrijema'                       => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 1),
            'osnovniUzrokHospitalizacije'     => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 2),
            'prateceDijagnoze'                => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 3),
            'brojSatiVentilatornePodrske'     => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 4),
            'datumOtpusta'                    => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 5),
            'brojDanaHospitalizacije'         => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 6),
            'odeljenjeSaKojegJeOtpustIzvrsen' => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 7),
            'vrstaOtpusta'                    => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 8),
            'obdukovan'                       => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 9),
            'osnovniUzrokSmrti'               => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 10),
        ];

        $mkbObj = new MKB($db, 'mkb');
        $mkbCol = $mkbObj->DajKolekcijuSvihSifri();
        $mkbN   = $mkbObj->DajUkupanBrojSvihSifri($mkbCol);
        $mkb    = [];
        for ($i = 0; $i < $mkbN; $i++) {
            $mkb[] = [
                'sifra' => $mkbObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($mkbCol, $i, 0),
                'naziv' => $mkbObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($mkbCol, $i, 1),
            ];
        }

        $odeljenjeObj = new Odeljenje($db, 'odeljenje');
        $odeljenjeCol = $odeljenjeObj->DajKolekcijuSvihOdeljenja();
        $odeljenjeN   = $odeljenjeObj->DajUkupanBrojSvihOdeljenja($odeljenjeCol);
        $odeljenja    = [];
        for ($i = 0; $i < $odeljenjeN; $i++) {
            $odeljenja[] = [
                'oznaka' => $odeljenjeObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($odeljenjeCol, $i, 0),
                'naziv'  => $odeljenjeObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($odeljenjeCol, $i, 1),
            ];
        }

        $otpustObj = new VrstaOtpusta($db, 'vrsta_otpusta');
        $otpustCol = $otpustObj->DajKolekcijuSvihOtpusta();
        $otpustN   = $otpustObj->DajUkupanBrojSvihOtpusta($otpustCol);
        $otpusti   = [];
        for ($i = 0; $i < $otpustN; $i++) {
            $otpusti[] = [
                'sifra' => $otpustObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($otpustCol, $i, 0),
                'naziv' => $otpustObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($otpustCol, $i, 1),
            ];
        }

        $db->disconnect();
        $this->json([
            'hospitalizacija' => $hospitalizacija,
            'mkb'             => $mkb,
            'odeljenja'       => $odeljenja,
            'otpusti'         => $otpusti,
        ]);
    }

    // POST/PUT api/hospitalizacija-izmeni
    public function update(): void {
        $this->requireAdminAuth();

        $p   = $this->request->all();
        $idH = trim($p['IdHospitalizacije'] ?? '');
        $idP = trim($p['IDPrijema'] ?? '');

        if ($idH === '' || $idP === '') {
            $this->json(['error' => 'missing_required'], 400);
        }

        $osnUzrok  = $p['OsnovniUzrokHospitalizacije'] ?? '';
        $pratece   = $p['PrateceDijagnoze'] ?? '';
        $satiVent  = $p['BrojSatiVentilatornePodrske'] ?? '';
        $datumOtp  = $p['DatumOtpusta'] ?? '';
        $odeljenje = $p['OdeljenjeSaKojegJeOtpustIzvrsen'] ?? '';
        $vrstaOtp  = $p['VrstaOtpusta'] ?? '';
        $obdukovan = $p['Obdukovan'] ?? '';
        $uzrokSmr  = $p['OsnovniUzrokSmrti'] ?? '';

        $db = $this->db();

        $prijemObj    = new Prijem($db, 'Prijem');
        $datumPrijema = $prijemObj->DajDatumPrijema($idP);

        $poslovnaObj = new PoslovnaLogika();
        $brojDana    = $poslovnaObj->DajBrojDana($datumPrijema, $datumOtp);

        $h      = new Hospitalizacija($db, 'hospitalizacija');
        $greska = $h->IzmeniHospitalizaciju(
            $idH, $osnUzrok, $pratece, $satiVent,
            $datumOtp, $brojDana, $odeljenje,
            $vrstaOtp, $obdukovan, $uzrokSmr
        );

        $db->disconnect();

        if ($greska) {
            $this->json(['error' => 'update_failed', 'details' => $greska], 500);
        }

        $this->json(['ok' => true]);
    }

    // GET api/hospitalizacije-filter
    public function filter(): void {
        $this->requireAuth();

        $filterValue = trim($this->request->get('filter', ''));
        $db = $this->db();
        $h  = new Hospitalizacija($db, 'hospitalizacija');

        $col = $filterValue !== ''
            ? $h->DajKolekcijuHospitalizacijaFiltrirano('OSNOVNIUZROKHOSPITALIZACIJE', $filterValue, 'like', 'DATUMOTPUSTA DESC')
            : $h->DajRadniPogledHospitalizacija();

        $count = $h->DajUkupanBrojSvihHospitalizacija($col);
        $items = [];
        for ($i = 0; $i < $count; $i++) {
            $items[] = [
                'id'                          => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 4),
                'brojIstorijeBolesti'         => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 0),
                'datumPrijema'                => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 1),
                'datumOtpusta'                => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 2),
                'osnovniUzrokHospitalizacije' => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 3),
            ];
        }

        $db->disconnect();
        $this->json(['items' => $items]);
    }

    // GET api/hospitalizacije-korisnik
    public function listKorisnik(): void {
        $this->requireAuth();

        $filterValue = trim($this->request->get('filter', ''));
        $db = $this->db();
        $h  = new Hospitalizacija($db, 'hospitalizacija');

        $col = $filterValue !== ''
            ? $h->DajKolekcijuHospitalizacijaFiltrirano('OSNOVNIUZROKHOSPITALIZACIJE', $filterValue, 'like', 'DATUMOTPUSTA DESC')
            : $h->DajPogledHospitalizacija();

        $count = $h->DajUkupanBrojSvihHospitalizacija($col);
        $items = [];
        for ($i = 0; $i < $count; $i++) {
            $items[] = [
                'brojIstorijeBolesti'         => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 0),
                'datumPrijema'                => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 1),
                'datumOtpusta'                => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 2),
                'osnovniUzrokHospitalizacije' => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 3),
            ];
        }

        $db->disconnect();
        $this->json(['items' => $items]);
    }

    // POST api/hospitalizacija-obrisi
    public function delete(): void {
        $this->requireAdminAuth();

        $idH = $this->request->post('IdHospitalizacije', '');
        if ($idH === '') {
            $this->json(['error' => 'missing_id'], 400);
        }

        $db = $this->db();
        $tr = new Transakcija($db, 'mysqli');
        $tr->ZapocniTransakciju();

        $h  = new Hospitalizacija($db, 'hospitalizacija');
        $p  = new Prijem($db, 'prijem');
        $a  = new Aktivnost($db, 'aktivnost');

        $idPrijema = $p->DajIDPrijemaHospitalizacije($idH);
        $greska1   = $h->ObrisiHospitalizaciju($idH);

        $aktCol = $a->DajSveAktivnostiPrijema($idPrijema);
        $brAkt  = $a->DajUkupanBrojSvihAktivnosti($aktCol);
        for ($i = 0; $i < $brAkt; $i++) {
            $idAkt = $a->DajVrednostPoRednomBrojuZapisaPoRBPolja($aktCol, $i, 0) . '|';
            $a->ObrisiAktivnost($idAkt);
        }

        $greska2 = $p->ObrisiPrijem($idPrijema);
        $greska  = $greska1 . $greska2;
        $tr->ZavrsiTransakciju($greska);
        $db->disconnect();

        if ($greska) {
            $this->json(['error' => 'delete_failed', 'details' => $greska], 500);
        }

        $this->json(['ok' => true]);
    }

    // POST api/hospitalizacija-unos
    public function store(): void {
        $this->requireAdminAuth();

        $p            = $this->request->all();
        $idPrijema    = $p['IdPrijema'] ?? '';
        $osnUzrok     = $p['OsnovniUzrokHospitalizacije'] ?? '';
        $pratece      = $p['PrateceDijagnoze'] ?? '';
        $satiVent     = $p['BrojSatiVentilatornePodrske'] ?? '';
        $datumOtpusta = $p['DatumOtpusta'] ?? '';
        $odeljenje    = $p['OdeljenjeSaKojegJeOtpustIzvrsen'] ?? '';
        $vrstaOtp     = $p['VrstaOtpusta'] ?? '';
        $obdukovan    = $p['Obdukovan'] ?? '';
        $uzrokSmrti   = $p['OsnovniUzrokSmrti'] ?? '';

        if ($idPrijema === '') {
            $this->json(['error' => 'missing_required'], 400);
        }

        $db = $this->db();
        $tr = new Transakcija($db, 'mysqli');
        $tr->ZapocniTransakciju();

        $prijemObj    = new Prijem($db, 'Prijem');
        $datumPrijema = $prijemObj->DajDatumPrijema($idPrijema);

        $poslovnaObj = new PoslovnaLogika();
        $brojDana    = $poslovnaObj->DajBrojDana($datumPrijema, $datumOtpusta);

        $hObj    = new Hospitalizacija($db, 'hospitalizacija');
        $greska1 = $hObj->DodajOtpust(
            $idPrijema, $osnUzrok, $pratece, $satiVent,
            $datumOtpusta, $brojDana, $odeljenje,
            $vrstaOtp, $obdukovan, $uzrokSmrti
        );
        $greska2 = $prijemObj->ArhivirajPrijem($idPrijema);
        $greska  = $greska1 . $greska2;
        $tr->ZavrsiTransakciju($greska);
        $db->disconnect();

        if ($greska) {
            error_log('[hospitalizacija-unos] ' . $greska);
            $this->json(['error' => 'Грешка при чувању: ' . $greska], 500);
        }

        $this->json(['ok' => true]);
    }

    // GET api/hospitalizacija-form-data — dropdown options for the unos form
    public function formData(): void {
        $this->requireAuth();

        $db = $this->db();

        $mkbObj = new MKB($db, 'mkb');
        $mkbCol = $mkbObj->DajKolekcijuSvihSifri();
        $mkbN   = $mkbObj->DajUkupanBrojSvihSifri($mkbCol);
        $mkb    = [];
        for ($i = 0; $i < $mkbN; $i++) {
            $mkb[] = [
                'sifra' => $mkbObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($mkbCol, $i, 0),
                'naziv' => $mkbObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($mkbCol, $i, 1),
            ];
        }

        $odeljenjeObj = new Odeljenje($db, 'odeljenje');
        $odeljenjeCol = $odeljenjeObj->DajKolekcijuSvihOdeljenja();
        $odeljenjeN   = $odeljenjeObj->DajUkupanBrojSvihOdeljenja($odeljenjeCol);
        $odeljenja    = [];
        for ($i = 0; $i < $odeljenjeN; $i++) {
            $odeljenja[] = [
                'oznaka' => $odeljenjeObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($odeljenjeCol, $i, 0),
                'naziv'  => $odeljenjeObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($odeljenjeCol, $i, 1),
            ];
        }

        $otpustObj = new VrstaOtpusta($db, 'vrsta_otpusta');
        $otpustCol = $otpustObj->DajKolekcijuSvihOtpusta();
        $otpustN   = $otpustObj->DajUkupanBrojSvihOtpusta($otpustCol);
        $otpusti   = [];
        for ($i = 0; $i < $otpustN; $i++) {
            $otpusti[] = [
                'sifra' => $otpustObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($otpustCol, $i, 0),
                'naziv' => $otpustObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($otpustCol, $i, 1),
            ];
        }

        $db->disconnect();
        $this->json(['mkb' => $mkb, 'odeljenja' => $odeljenja, 'otpusti' => $otpusti]);
    }

    // GET api/hospitalizacija-print?id=
    public function printReport(): void {
        $this->requireAuth();

        $idH = trim($this->request->get('id', ''));
        if ($idH === '') {
            $this->json(['error' => 'missing_id'], 400);
        }

        $db = $this->db();

        $izv = new Izvestaj($db, 'izvestaj');
        $izv->IDHospitalizacije = $idH;
        $col = $izv->DajIzvestaj();

        $payload = [
            'idPrijema'                      => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 0),
            'osnovniUzrokHospitalizacije'    => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 1),
            'prateceDijagnoze'               => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 2),
            'brojSatiVentilatornePodrske'    => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 3),
            'datumOtpusta'                   => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 4),
            'brojDanaHospitalizacije'        => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 5),
            'odeljenjeSaKojegJeOtpustIzvrsen'=> $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 6),
            'nazivOdeljenjaOtpusta'          => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 7),
            'vrstaOtpusta'                   => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 8),
            'nazivOtpusta'                   => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 9),
            'obdukovan'                      => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 10),
            'osnovniUzrokSmrti'              => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 11),
            'jmbg'                           => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 13),
            'datumRodjenja'                  => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 14),
            'drzavljanstvo'                  => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 15),
            'pol'                            => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 16),
            'adresa'                         => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 17),
            'osnovOsiguranja'                => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 18),
            'nazivOsiguranja'                => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 19),
            'lbo'                            => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 20),
            'odeljenjeNaPrijemu'             => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 21),
            'nazivPrijemnogOsiguranja'       => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 22),
            'ime'                            => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 23),
            'prezime'                        => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 24),
            'uputnaDijagnoza'                => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 25),
            'tezinaNaPrijemu'                => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 26),
            'datumPrijema'                   => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 27),
            'povreda'                        => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 28),
            'spoljniUzrokPovrede'            => $izv->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 29),
        ];

        // Consume trailing OK packet from CALL to avoid "Commands out of sync"
        if ($col) { mysqli_free_result($col); }
        while (mysqli_next_result($db->konekcijaDB)) {
            $extra = mysqli_use_result($db->konekcijaDB);
            if ($extra) { mysqli_free_result($extra); }
        }

        $aktObj = new Aktivnost($db, 'aktivnost');
        $aktCol = $aktObj->DajSveAktivnostiPrijema($payload['idPrijema']);
        $brAkt  = $aktObj->DajUkupanBrojSvihAktivnosti($aktCol);
        $sifre  = '';
        for ($i = 0; $i < $brAkt; $i++) {
            $sifre .= $aktObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($aktCol, $i, 2) . '|';
        }
        $payload['sifraProcedurePoNomenklaturi'] = $sifre;

        $db->disconnect();
        $this->json($payload);
    }
}
