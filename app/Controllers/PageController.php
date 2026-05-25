<?php
require_once APP_DIR . '/Controllers/BaseController.php';

class PageController extends BaseController {

    protected function requireAuth(): void {
        if (!isset($_SESSION['korisnik'])) {
            $this->redirect(APP_BASE . '/');
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

    public function welcomeAdministrator(): void {
        $this->requireAuth();
        Response::view(APP_DIR . '/Views/pages/welcome-administrator.php');
    }

    public function welcomeKorisnik(): void {
        $this->requireAuth();
        Response::view(APP_DIR . '/Views/pages/welcome-korisnik.php');
    }

    public function hospitalizacijaListaFilter(): void {
        $this->requireAuth();
        Response::view(APP_DIR . '/Views/pages/hospitalizacija/lista-filter.php');
    }

    public function hospitalizacijaListaKorisnik(): void {
        $this->requireAuth();
        Response::view(APP_DIR . '/Views/pages/hospitalizacija/lista-korisnik.php');
    }

    public function hospitalizacijaUnos(): void {
        $this->requireAuth();
        $idPrijema = $this->request->post('IdPrijema', '') ?: $this->request->get('IdPrijema', '');
        if ($idPrijema === '') {
            $this->redirect(APP_BASE . '/');
        }
        Response::view(APP_DIR . '/Views/pages/hospitalizacija/unos.php', ['IDPrijema' => $idPrijema]);
    }

    public function hospitalizacijaIzmeni(): void {
        $this->requireAuth();
        $id = $this->request->post('IdHospitalizacije', '')
            ?: $this->request->get('IdHospitalizacije', '')
            ?: $this->request->get('id', '');
        if ($id === '') {
            $this->redirect(APP_BASE . '/');
        }
        Response::view(APP_DIR . '/Views/pages/hospitalizacija/izmeni.php', ['id' => $id]);
    }

    public function pacijentUnos(): void {
        $this->requireAuth();
        Response::view(APP_DIR . '/Views/pages/pacijent/unos.php');
    }

    public function pacijentLista(): void {
        $this->requireAuth();
        Response::view(APP_DIR . '/Views/pages/pacijent/lista.php');
    }

    public function pacijentListaKorisnik(): void {
        $this->requireAuth();
        Response::view(APP_DIR . '/Views/pages/pacijent/lista-korisnik.php');
    }

    public function pacijentIzmeni(): void {
        $this->requireAuth();
        $id = $this->request->post('idPacijenta', '') ?: $this->request->get('idPacijenta', '');
        if ($id === '') {
            $this->redirect(APP_BASE . '/');
        }
        Response::view(APP_DIR . '/Views/pages/pacijent/izmeni.php');
    }

    public function pacijentPrijem(): void {
        $this->requireAuth();
        $id = $this->request->post('idPacijenta', '') ?: $this->request->get('idPacijenta', '');
        if ($id === '') {
            $this->redirect(APP_BASE . '/');
        }
        Response::view(APP_DIR . '/Views/pages/prijem/unos.php', ['idPacijenta' => $id]);
    }

    public function primljeniPacijenti(): void {
        $this->requireAuth();
        Response::view(APP_DIR . '/Views/pages/prijem/lista.php');
    }

    public function medicinskiTretmaniUnos(): void {
        $this->requireAuth();
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
}
