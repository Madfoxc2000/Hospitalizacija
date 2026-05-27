<?php
require_once APP_DIR . '/Controllers/BaseController.php';

require_once APP_DIR . '/Models/BaznaKonekcija.php';
require_once APP_DIR . '/Models/BaznaTabela.php';
require_once APP_DIR . '/Models/DBPrijem.php';
require_once APP_DIR . '/Models/DBOdeljenje.php';
require_once APP_DIR . '/Models/DBMKB.php';
require_once APP_DIR . '/Models/DBSpoljniUzrokPovrede.php';

class PrijemController extends BaseController {

    private function db(): Konekcija {
        $db = new Konekcija(APP_DIR . '/Models/BaznaParametriKonekcije.xml');
        $db->connect();
        if (!$db->konekcijaDB) {
            Response::serverError('db_connect_failed');
        }
        return $db;
    }

    // GET api/prijem-lista?filter=
    public function index(): void {
        $this->requireAuth();

        $filter = trim($this->request->get('filter', ''));
        $db = $this->db();
        $p  = new Prijem($db, 'prijem');

        $col = $filter !== ''
            ? $p->DajKolekcijuPrijemaFiltrirano('BrojIstorijeBolesti', $filter, 'like', 'DatumPrijema')
            : $p->DajKolekcijuAktivnihPrijema();

        $count = $p->DajUkupanBrojSvihPrijema($col);
        $items = [];
        for ($i = 0; $i < $count; $i++) {
            $items[] = [
                'id'                  => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 0),
                'brojIstorijeBolesti' => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 1),
                'odeljenjeNaPrijemu'  => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 2),
                'uputnaDijagnoza'     => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 3),
                'tezinaNaPrijemu'     => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 4),
                'datumPrijema'        => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 5),
                'povreda'             => $p->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 6),
            ];
        }

        $db->disconnect();
        $this->json(['items' => $items]);
    }

    // GET api/prijem-form-data — opcije padajućeg menija za formu prijema
    public function formData(): void {
        $this->requireAuth();

        $db = $this->db();

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

        $spoljniObj = new SpoljniUzrokPovrede($db, 'spoljasnji_uzrok_povrede');
        $spoljniCol = $spoljniObj->DajKolekcijuSvihSpoljnihUzroka();
        $spoljniN   = $spoljniObj->DajUkupanBrojSvihSpoljnihUzroka($spoljniCol);
        $spoljni    = [];
        for ($i = 0; $i < $spoljniN; $i++) {
            $spoljni[] = [
                'sifra' => $spoljniObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($spoljniCol, $i, 0),
                'naziv' => $spoljniObj->DajVrednostPoRednomBrojuZapisaPoRBPolja($spoljniCol, $i, 1),
            ];
        }

        $db->disconnect();
        $this->json(['odeljenja' => $odeljenja, 'mkb' => $mkb, 'spoljniUzroci' => $spoljni]);
    }

    // POST api/prijem-unos
    public function store(): void {
        $this->requireRole([self::ROLE_ADMIN, self::ROLE_SESTRA]);

        $p             = $this->request->all();
        $idPacijenta   = $p['idPacijenta'] ?? '';
        $odeljenje     = $p['OdeljenjeNaPrijemu'] ?? '';
        $tezina        = $p['TezinaNaPrijemu'] ?? '';
        $datumPrijema  = $p['DatumPrijema'] ?? '';
        $povreda       = $p['Povreda'] ?? '';
        $spoljniUzrok  = $p['SpoljniUzrokPovrede'] ?? '';
        $uputnaDij     = $p['UputnaDijagnoza'] ?? '';

        if ($idPacijenta === '' || $odeljenje === '' || $datumPrijema === '') {
            $this->json(['error' => 'missing_required'], 400);
        }

        $db        = $this->db();
        $prijemObj = new Prijem($db, 'prijem');
        $greska    = $prijemObj->DodajNoviPrijem(
            $idPacijenta, $odeljenje, $tezina,
            $datumPrijema, $povreda, $spoljniUzrok, $uputnaDij
        );
        $db->disconnect();

        if ($greska) {
            $this->json(['error' => 'store_failed', 'details' => $greska], 500);
        }

        $this->json(['ok' => true]);
    }
}
