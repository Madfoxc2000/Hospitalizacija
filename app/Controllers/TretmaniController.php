<?php
require_once APP_DIR . '/Controllers/BaseController.php';

require_once APP_DIR . '/Models/BaznaKonekcija.php';
require_once APP_DIR . '/Models/BaznaTabela.php';
require_once APP_DIR . '/Models/DBAktivnost.php';
require_once APP_DIR . '/Models/DBTipAktivnosti.php';

class TretmaniController extends BaseController {

    private function db(): Konekcija {
        $db = new Konekcija(APP_DIR . '/Models/BaznaParametriKonekcije.xml');
        $db->connect();
        if (!$db->konekcijaDB) {
            Response::serverError('db_connect_failed');
        }
        return $db;
    }

    // GET api/tretmani-tipovi — dropdown options for the activity form
    public function tipovi(): void {
        $this->requireAuth();

        $db  = $this->db();
        $obj = new TipAktivnosti($db, 'tipaktivnosti');
        $col = $obj->DajKolekcijuSvihTipovaAktivnosti();
        $n   = $obj->DajUkupanBrojSvihTipovaAktivnosti($col);

        $items = [];
        for ($i = 0; $i < $n; $i++) {
            $items[] = [
                'id'    => $obj->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 0),
                'naziv' => $obj->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 1),
            ];
        }

        $db->disconnect();
        $this->json(['items' => $items]);
    }

    // POST api/tretmani-unos
    public function store(): void {
        $this->requireAdminAuth();

        $p              = $this->request->all();
        $idPrijema      = $p['IdPrijema'] ?? '';
        $tipAktivnosti  = $p['TipAktivnosti'] ?? '';
        $datumIzvrsenja = $p['DatumIzvrsenja'] ?? '';
        $opis           = $p['Opis'] ?? '';

        if ($idPrijema === '' || $tipAktivnosti === '' || $datumIzvrsenja === '') {
            $this->json(['error' => 'missing_required'], 400);
        }

        $db     = $this->db();
        $obj    = new Aktivnost($db, 'aktivnost');
        $greska = $obj->DodajNovuAktivnost($idPrijema, $tipAktivnosti, $datumIzvrsenja, $opis);
        $db->disconnect();

        if ($greska) {
            $this->json(['error' => 'store_failed', 'details' => $greska], 500);
        }

        $this->json(['ok' => true]);
    }
}
