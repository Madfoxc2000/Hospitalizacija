<?php
require_once APP_DIR . '/Controllers/BaseController.php';

require_once APP_DIR . '/Models/BaznaKonekcija.php';
require_once APP_DIR . '/Models/BaznaTabela.php';
require_once APP_DIR . '/Models/DBKorisnik.php';

class AuthController extends BaseController {

    private function db(): Konekcija {
        $db = new Konekcija(APP_DIR . '/Models/BaznaParametriKonekcije.xml');
        $db->connect();
        if (!$db->konekcijaDB) {
            Response::serverError('db_connect_failed');
        }
        return $db;
    }

    // POST api/auth/login
    public function login(): void {
        $username = trim($this->request->post('korisnickoIme', ''));
        $password = trim($this->request->post('sifra', ''));

        if ($username === '' || $password === '') {
            $this->json(['error' => 'missing_credentials'], 400);
        }

        $db = $this->db();
        $k  = new Korisnik($db, 'KORISNIK');

        if ($k->DaLiPostojiKorisnik($username, $password) !== 'DA') {
            $db->disconnect();
            $this->json(['error' => 'invalid_credentials'], 401);
        }

        $_SESSION['korisnik']    = $k->DajImePrezimePrijavljenogKorisnika($username, $password);
        $_SESSION['ime']         = $k->DajImePrijavljenogKorisnika($username, $password);
        $_SESSION['prez']        = $k->DajPrezimePrijavljenogKorisnika($username, $password);
        $_SESSION['idkorisnika'] = $k->DajIDPrijavljenogKorisnika($username, $password);
        $uloga                   = $k->DajUloguPrijavljenogKorisnika($username, $password);
        $db->disconnect();

        $redirect = $uloga === 'Администратор'
            ? APP_BASE . '/welcome-administrator'
            : APP_BASE . '/welcome-korisnik';

        $this->json(['ok' => true, 'redirect' => $redirect]);
    }

    // POST api/auth/logout
    public function logout(): void {
        session_destroy();
        $this->json(['ok' => true, 'redirect' => APP_BASE . '/prijava']);
    }
}
