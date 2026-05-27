<?php
require_once APP_DIR . '/Controllers/BaseController.php';

class PageController extends BaseController {

    // Rute stranica preusmeravaju na početnu stranicu umesto da vraćaju 401 JSON.
    protected function requireAuth(): void {
        if (!isset($_SESSION['korisnik'])) {
            $this->redirect(APP_BASE . '/');
        }
    }

    protected function requireAdminAuth(): void {
        if (!isset($_SESSION['korisnik'])) {
            $this->redirect(APP_BASE . '/');
        }
        if ($_SESSION['uloga'] !== self::ROLE_ADMIN) {
            Response::view(APP_DIR . '/Views/pages/403.php');
        }
    }

    protected function requireRole(array $roles): void {
        if (!isset($_SESSION['korisnik'])) {
            $this->redirect(APP_BASE . '/');
        }
        if (!in_array($_SESSION['uloga'] ?? '', $roles, true)) {
            Response::view(APP_DIR . '/Views/pages/403.php');
        }
    }

    public function home(): void {
        session_unset();
        session_destroy();
        Response::view(APP_DIR . '/Views/pages/home.php');
    }

    public function prijava(): void {
        Response::view(APP_DIR . '/Views/pages/prijava.php');
    }

    public function registracija(): void {
        Response::view(APP_DIR . '/Views/pages/registracija.php');
    }

    // ── Početne stranice (dobrodošlica) ───────────────────────────────────────

    public function welcomeAdministrator(): void {
        $this->requireRole([self::ROLE_ADMIN]);
        Response::view(APP_DIR . '/Views/pages/welcome-administrator.php');
    }

    public function welcomeKorisnik(): void {
        $this->requireAuth(); // stara rezervna opcija
        Response::view(APP_DIR . '/Views/pages/welcome-korisnik.php');
    }

    public function welcomeMedicinskaSestra(): void {
        $this->requireRole([self::ROLE_SESTRA]);
        Response::view(APP_DIR . '/Views/pages/welcome-medicinska-sestra.php');
    }

    public function welcomeLekar(): void {
        $this->requireRole([self::ROLE_LEKAR]);
        Response::view(APP_DIR . '/Views/pages/welcome-lekar.php');
    }

    // ── Hospitalizacija ───────────────────────────────────────────────────────
    // Sve tri uloge mogu pregledati i upravljati hospitalizacijama

    public function hospitalizacijaListaFilter(): void {
        $this->requireRole([self::ROLE_ADMIN, self::ROLE_SESTRA, self::ROLE_LEKAR]);
        Response::view(APP_DIR . '/Views/pages/hospitalizacija/lista-filter.php');
    }

    public function hospitalizacijaListaKorisnik(): void {
        $this->requireRole([self::ROLE_ADMIN, self::ROLE_SESTRA, self::ROLE_LEKAR]);
        Response::view(APP_DIR . '/Views/pages/hospitalizacija/lista-korisnik.php');
    }

    public function hospitalizacijaUnos(): void {
        $this->requireRole([self::ROLE_ADMIN, self::ROLE_LEKAR]);
        $idPrijema = $this->request->post('IdPrijema', '') ?: $this->request->get('IdPrijema', '');
        if ($idPrijema === '') {
            $this->redirect(APP_BASE . '/');
        }
        Response::view(APP_DIR . '/Views/pages/hospitalizacija/unos.php', ['IDPrijema' => $idPrijema]);
    }

    public function hospitalizacijaIzmeni(): void {
        $this->requireRole([self::ROLE_ADMIN, self::ROLE_LEKAR]);
        $id = $this->request->post('IdHospitalizacije', '')
            ?: $this->request->get('IdHospitalizacije', '')
            ?: $this->request->get('id', '');
        if ($id === '') {
            $this->redirect(APP_BASE . '/');
        }
        Response::view(APP_DIR . '/Views/pages/hospitalizacija/izmeni.php', ['id' => $id]);
    }

    // ── Pacijenti ─────────────────────────────────────────────────────────────
    // Pun CRUD: medicinska sestra + administrator. Samo čitanje: sve uloge.

    public function pacijentUnos(): void {
        $this->requireRole([self::ROLE_ADMIN, self::ROLE_SESTRA]);
        Response::view(APP_DIR . '/Views/pages/pacijent/unos.php');
    }

    public function pacijentLista(): void {
        $this->requireRole([self::ROLE_ADMIN, self::ROLE_SESTRA, self::ROLE_LEKAR]);
        Response::view(APP_DIR . '/Views/pages/pacijent/lista.php');
    }

    public function pacijentListaKorisnik(): void {
        $this->requireRole([self::ROLE_ADMIN, self::ROLE_SESTRA, self::ROLE_LEKAR]);
        Response::view(APP_DIR . '/Views/pages/pacijent/lista-korisnik.php');
    }

    public function pacijentIzmeni(): void {
        $this->requireRole([self::ROLE_ADMIN, self::ROLE_SESTRA]);
        $id = $this->request->post('idPacijenta', '') ?: $this->request->get('idPacijenta', '');
        if ($id === '') {
            $this->redirect(APP_BASE . '/');
        }
        Response::view(APP_DIR . '/Views/pages/pacijent/izmeni.php');
    }

    // ── Prijem ────────────────────────────────────────────────────────────────
    // Samo medicinska sestra i administrator

    public function pacijentPrijem(): void {
        $this->requireRole([self::ROLE_ADMIN, self::ROLE_SESTRA]);
        $id = $this->request->post('idPacijenta', '') ?: $this->request->get('idPacijenta', '');
        if ($id === '') {
            $this->redirect(APP_BASE . '/');
        }
        Response::view(APP_DIR . '/Views/pages/prijem/unos.php', ['idPacijenta' => $id]);
    }

    // Sve uloge vide listu primljenih pacijenata
    public function primljeniPacijenti(): void {
        $this->requireAuth();
        Response::view(APP_DIR . '/Views/pages/prijem/lista.php');
    }

    // ── Tretmani i izveštaji ──────────────────────────────────────────────────
    // Lekar i administrator za tretmane; sve uloge za izveštaje

    public function medicinskiTretmaniUnos(): void {
        $this->requireRole([self::ROLE_ADMIN, self::ROLE_LEKAR]);
        $idPrijema = $this->request->post('IdPrijema', '') ?: $this->request->get('IdPrijema', '');
        if ($idPrijema === '') {
            $this->redirect(APP_BASE . '/');
        }
        Response::view(APP_DIR . '/Views/pages/tretmani/unos.php', ['IdPrijema' => $idPrijema]);
    }

    public function izvestajStampa(): void {
        $this->requireAuth();
        Response::view(APP_DIR . '/Views/pages/izvestaj-stampa.php');
    }

    public function stampa(): void {
        $this->requireAuth();
        require_once APP_DIR . '/Models/BaznaKonekcija.php';
        require_once APP_DIR . '/Models/BaznaTabela.php';
        require_once APP_DIR . '/Models/DBHospitalizacija.php';

        $items      = [];
        $ukupanBroj = 0;

        if (isset($_GET['filtriraj'])) {
            $db = new Konekcija(APP_DIR . '/Models/BaznaParametriKonekcije.xml');
            $db->connect();
            if ($db->konekcijaDB) {
                $h           = new Hospitalizacija($db, 'hospitalizacija');
                $filterValue = trim($_GET['filter'] ?? '');
                $col         = $filterValue !== ''
                    ? $h->DajKolekcijuHospitalizacijaFiltrirano('OSNOVNIUZROKHOSPITALIZACIJE', $filterValue, 'like', 'DATUMOTPUSTA DESC')
                    : $h->DajPogledHospitalizacija();
                $ukupanBroj  = $h->DajUkupanBrojSvihHospitalizacija($col);
                for ($i = 0; $i < $ukupanBroj; $i++) {
                    $items[] = [
                        'brojIstorijeBolesti'         => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 0),
                        'datumPrijema'                => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 1),
                        'datumOtpusta'                => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 2),
                        'osnovniUzrokHospitalizacije' => $h->DajVrednostPoRednomBrojuZapisaPoRBPolja($col, $i, 3),
                    ];
                }
                $db->disconnect();
            }
        }

        Response::view(APP_DIR . '/Views/pages/hospitalizacija/stampa.php', [
            'items'      => $items,
            'ukupanBroj' => $ukupanBroj,
        ]);
    }

    // ── Samo administrator ────────────────────────────────────────────────────

    public function zaposleniLista(): void {
        $this->requireRole([self::ROLE_ADMIN]);
        Response::view(APP_DIR . '/Views/pages/zaposleni-lista.php');
    }
}
