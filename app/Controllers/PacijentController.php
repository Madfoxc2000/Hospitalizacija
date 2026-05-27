<?php
require_once APP_DIR . '/Controllers/BaseController.php';

require_once APP_DIR . '/Models/BaznaKonekcija.php';
require_once APP_DIR . '/Models/BaznaTabela.php';
require_once APP_DIR . '/Models/BaznaTransakcija.php';
require_once APP_DIR . '/Models/DBPacijent.php';
require_once APP_DIR . '/Models/DBOsnovOsiguranja.php';
require_once APP_DIR . '/Models/Validacije.php';
require_once APP_DIR . '/Models/PoslovnaLogika.php';

class PacijentController extends BaseController {

    private function db(): Konekcija {
        $db = new Konekcija(APP_DIR . '/Models/BaznaParametriKonekcije.xml');
        $db->connect();
        if (!$db->konekcijaDB) {
            Response::serverError('db_connect_failed');
        }
        return $db;
    }

    // GET api/pacijent-lista?filter=
    public function index(): void {
        $this->requireAuth();

        $filter = trim($this->request->get('filter', ''));
        $db = $this->db();
        $p  = new Pacijent($db, 'Pacijent');

        $col = $filter !== ''
            ? $p->DajKolekcijuPacijenataFiltrirano('BrojIstorijeBolesti', $filter, 'like', 'Ime')
            : $p->DajKolekcijuSvihPacijenata();

        $count = $p->DajUkupanBrojPacijenata($col);
        $items = [];
        for ($i = 0; $i < $count; $i++) {
            $items[] = [
                'brojIstorijeBolesti' => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 0),
                'jmbg'                => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 1),
                'imeJednogRoditelja'  => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 2),
                'lbo'                 => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 3),
                'osnovOsiguranja'     => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 4),
                'clanJePorodice'      => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 5),
                'ime'                 => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 6),
                'prezime'             => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 7),
                'telefon'             => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 8),
                'datumRodjenja'       => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 9),
                'drzavljanstvo'       => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 10),
                'pol'                 => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 11),
                'adresa'              => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 12),
                'maloletan'           => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 13),
            ];
        }

        $db->disconnect();
        $this->json(['items' => $items]);
    }

    // GET api/pacijent-form-data — opcije padajućeg menija za formu unosa
    public function formData(): void {
        $this->requireAuth();

        $db    = $this->db();
        $osObj = new OsnovOsiguranja($db, 'osnov_osiguranja');
        $osCol = $osObj->DajKolekcijuSvihOsnovaOsiguranja();
        $osN   = $osObj->DajUkupanBrojSvihOsnovaOsiguranja($osCol);
        $osnovi = [];
        for ($i = 0; $i < $osN; $i++) {
            $osnovi[] = [
                'oznaka' => $osObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($osCol, $i, 0),
                'naziv'  => $osObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($osCol, $i, 1),
            ];
        }

        $db->disconnect();
        $this->json(['osnovi' => $osnovi]);
    }

    // GET api/pacijent-izmeni?id=
    public function show(): void {
        $this->requireAuth();

        $id = trim($this->request->get('id', ''));
        if ($id === '') {
            $this->json(['error' => 'missing_id'], 400);
        }

        $db  = $this->db();
        $p   = new Pacijent($db, 'Pacijent');
        $col = $p->DajKolekcijuPacijenataFiltrirano('BrojIstorijeBolesti', $id, '=', 'Ime');

        if ($p->DajUkupanBrojPacijenata($col) < 1) {
            $db->disconnect();
            $this->json(['error' => 'not_found'], 404);
        }

        $pacijent = [
            'brojIstorijeBolesti' => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 0),
            'jmbg'                => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 1),
            'imeJednogRoditelja'  => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 2),
            'lbo'                 => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 3),
            'osnovOsiguranja'     => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 4),
            'clanJePorodice'      => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 5),
            'ime'                 => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 6),
            'prezime'             => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 7),
            'telefon'             => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 8),
            'datumRodjenja'       => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 9),
            'drzavljanstvo'       => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 10),
            'pol'                 => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 11),
            'adresa'              => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, 0, 12),
        ];

        $osObj  = new OsnovOsiguranja($db, 'osnov_osiguranja');
        $osCol  = $osObj->DajKolekcijuSvihOsnovaOsiguranja();
        $osN    = $osObj->DajUkupanBrojSvihOsnovaOsiguranja($osCol);
        $osnovi = [];
        for ($i = 0; $i < $osN; $i++) {
            $osnovi[] = [
                'oznaka' => $osObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($osCol, $i, 0),
                'naziv'  => $osObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($osCol, $i, 1),
            ];
        }

        $db->disconnect();
        $this->json(['pacijent' => $pacijent, 'osnovi' => $osnovi]);
    }

    // POST api/pacijent-unos
    public function store(): void {
        $this->requireRole([self::ROLE_ADMIN, self::ROLE_SESTRA]);

        $p      = $this->request->all();
        $brojIB = trim($p['BrojIstorijeBolesti'] ?? '');

        if ($brojIB === '') {
            $this->json(['error' => 'missing_required'], 400);
        }

        $jmbg    = $p['JMBG'] ?? '';
        $ime     = $p['Ime'] ?? '';
        $prezime = $p['Prezime'] ?? '';
        $imeRod  = $p['ImeJednogRoditelja'] ?? '';
        $lbo     = $p['LBO'] ?? '';
        $osigur  = $p['OsnovOsiguranja'] ?? '';
        $clan    = $p['ClanJePorodice'] ?? '';
        $tel     = $p['Telefon'] ?? '';
        $datum   = $p['DatumRodjenja'] ?? '';
        $drzav   = $p['Drzavljanstvo'] ?? '';
        $pol     = $p['Pol'] ?? '';
        $adresa  = $p['Adresa'] ?? '';

        $db   = $this->db();
        $pObj = new Pacijent($db, 'Pacijent');

        if ($pObj->DaLiPostojiBrojBolesti($brojIB)) {
            $db->disconnect();
            $this->json(['error' => 'Пацијент са овим бројем историје болести се већ налази у бази'], 422);
        }

        $maloletan = (new PoslovnaLogika())->DaLiJeMaloletan($datum);

        $tr = new Transakcija($db, 'mysqli');
        $tr->ZapocniTransakciju();
        $greska = $pObj->DodajNovogPacijenta(
            $brojIB, $jmbg, $imeRod, $lbo, $osigur, $clan,
            $ime, $prezime, $tel, $datum, $drzav, $pol, $adresa, $maloletan
        );
        $tr->ZavrsiTransakciju($greska);
        $db->disconnect();

        if ($greska) {
            $this->json(['error' => 'store_failed', 'details' => $greska], 500);
        }

        $this->json(['ok' => true]);
    }

    // PUT/POST api/pacijent-izmeni
    public function update(): void {
        $this->requireRole([self::ROLE_ADMIN, self::ROLE_SESTRA]);

        $p      = $this->request->all();
        $brojIB = trim($p['BrojIstorijeBolesti'] ?? '');

        if ($brojIB === '') {
            $this->json(['error' => 'missing_required'], 400);
        }

        $jmbg    = $p['JMBG'] ?? '';
        $ime     = $p['Ime'] ?? '';
        $prezime = $p['Prezime'] ?? '';
        $imeRod  = $p['ImeJednogRoditelja'] ?? '';
        $lbo     = $p['LBO'] ?? '';
        $osigur  = $p['OsnovOsiguranja'] ?? '';
        $clan    = $p['ClanJePorodice'] ?? '';
        $tel     = $p['Telefon'] ?? '';
        $datum   = $p['DatumRodjenja'] ?? '';
        $drzav   = $p['Drzavljanstvo'] ?? '';
        $pol     = $p['Pol'] ?? '';
        $adresa  = $p['Adresa'] ?? '';

        $maloletan = (new PoslovnaLogika())->DaLiJeMaloletan($datum);

        $db     = $this->db();
        $pObj   = new Pacijent($db, 'Pacijent');
        $greska = $pObj->IzmeniPacijenta(
            $brojIB, $jmbg, $imeRod, $lbo, $osigur, $clan,
            $ime, $prezime, $tel, $datum, $drzav, $pol, $adresa, $maloletan
        );
        $db->disconnect();

        if ($greska) {
            $this->json(['error' => 'update_failed', 'details' => $greska], 500);
        }

        $this->json(['ok' => true]);
    }

    // POST api/pacijent-obrisi
    public function delete(): void {
        $this->requireRole([self::ROLE_ADMIN, self::ROLE_SESTRA]);

        $idP = $this->request->post('idPacijenta', '');
        if ($idP === '') {
            $this->json(['error' => 'missing_id'], 400);
        }

        $db   = $this->db();
        $pObj = new Pacijent($db, 'pacijent');

        $prijemljenCol = $pObj->UcitajSveIdPacijenataPrijema();
        $prijemljenN   = $pObj->DajUkupanBrojPacijenata($prijemljenCol);
        $sviBrojevi    = '';
        for ($i = 0; $i < $prijemljenN; $i++) {
            $sviBrojevi .= $pObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($prijemljenCol, $i, 0);
        }

        $val    = new Validacije();
        $greska = $val->DaLiJePacijentPrimljen($sviBrojevi, $idP);
        if ($greska) {
            $db->disconnect();
            $this->json(['error' => $greska], 422);
        }

        $greska = $pObj->ObrisiPacijenta($idP);
        $db->disconnect();

        if ($greska) {
            $this->json(['error' => 'delete_failed', 'details' => $greska], 500);
        }

        $this->json(['ok' => true]);
    }
}
