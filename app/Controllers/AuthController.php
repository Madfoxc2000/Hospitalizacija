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
        $_SESSION['uloga']       = $k->DajUloguPrijavljenogKorisnika($username, $password);
        $uloga                   = $_SESSION['uloga'];
        $db->disconnect();

        if ($uloga === self::ROLE_ADMIN) {
            $redirect = APP_BASE . '/welcome-administrator';
        } elseif ($uloga === self::ROLE_LEKAR) {
            $redirect = APP_BASE . '/welcome-lekar';
        } elseif ($uloga === self::ROLE_SESTRA) {
            $redirect = APP_BASE . '/welcome-medicinska-sestra';
        } else {
            $redirect = APP_BASE . '/welcome-korisnik'; // stara rezervna opcija
        }

        $this->json(['ok' => true, 'redirect' => $redirect]);
    }

    // POST api/auth/register
    public function register(): void {
        $prezime         = trim($this->request->post('prezime', ''));
        $ime             = trim($this->request->post('ime', ''));
        $korisnickoIme   = trim($this->request->post('korisnickoIme', ''));
        $sifra           = trim($this->request->post('sifra', ''));
        $telefon         = trim($this->request->post('telefon', ''));
        $email           = trim($this->request->post('email', ''));
        $specijalizacija = trim($this->request->post('specijalizacija', ''));
        $kod             = trim($this->request->post('kodRegistracije', ''));

        if ($prezime === '' || $ime === '' || $korisnickoIme === '' ||
            $sifra  === '' || $telefon === '' || $email === '' || $kod === '') {
            $this->json(['error' => 'missing_fields'], 400);
        }

        // 1xxxx = Медицинска сестра, 2xxxx = Лекар, 3xxxx = Администратор
        if (!preg_match('/^[123]\d{4}$/', $kod)) {
            $this->json(['error' => 'invalid_code'], 400);
        }

        if ($kod[0] === '1') {
            $statusucesca = self::ROLE_SESTRA;
        } elseif ($kod[0] === '2') {
            $statusucesca = self::ROLE_LEKAR;
        } else {
            $statusucesca = self::ROLE_ADMIN;
        }

        $db = $this->db();
        $k  = new Korisnik($db, 'KORISNIK');

        if ($k->DaLiPostojiKorisnickoIme($korisnickoIme)) {
            $db->disconnect();
            $this->json(['error' => 'username_taken'], 409);
        }

        $newId = $k->RegistrujKorisnika([
            'prezime'         => $prezime,
            'ime'             => $ime,
            'korisnickoIme'   => $korisnickoIme,
            'sifra'           => $sifra,
            'telefon'         => $telefon,
            'email'           => $email,
            'specijalizacija' => $specijalizacija,
            'statusucesca'    => $statusucesca,
        ]);
        $db->disconnect();

        if ($newId === 0) {
            $this->json(['error' => 'register_failed'], 500);
        }

        // Automatska prijava nakon uspešne registracije
        $_SESSION['korisnik']    = $prezime . ' ' . $ime;
        $_SESSION['ime']         = $ime;
        $_SESSION['prez']        = $prezime;
        $_SESSION['idkorisnika'] = $newId;
        $_SESSION['uloga']       = $statusucesca;

        if ($statusucesca === self::ROLE_ADMIN) {
            $redirect = APP_BASE . '/welcome-administrator';
        } elseif ($statusucesca === self::ROLE_LEKAR) {
            $redirect = APP_BASE . '/welcome-lekar';
        } else {
            $redirect = APP_BASE . '/welcome-medicinska-sestra';
        }

        $this->json(['ok' => true, 'redirect' => $redirect]);
    }

    // GET api/zaposleni-lista?uloga=...
    public function staff(): void {
        $this->requireRole([self::ROLE_ADMIN]);

        $uloga   = trim($this->request->get('uloga', ''));
        $allowed = [self::ROLE_SESTRA, self::ROLE_LEKAR];

        if (!in_array($uloga, $allowed, true)) {
            $this->json(['error' => 'invalid_role'], 400);
        }

        $db   = $this->db();
        $k    = new Korisnik($db, 'KORISNIK');
        $data = $k->DajZaposlenePoStatusu($uloga);
        $db->disconnect();

        $this->json($data);
    }

    // POST api/auth/logout
    public function logout(): void {
        session_destroy();
        $this->json(['ok' => true, 'redirect' => APP_BASE . '/prijava']);
    }
}
