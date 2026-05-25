<?php

// ── HTML page routes ──────────────────────────────────────────────────────────
require_once APP_DIR . '/Controllers/PageController.php';

$router->any('',                               [PageController::class, 'home']);
$router->any('welcome-administrator',          [PageController::class, 'welcomeAdministrator']);
$router->any('welcome-korisnik',               [PageController::class, 'welcomeKorisnik']);
$router->any('prijava',                        [PageController::class, 'prijava']);
$router->any('hospitalizacija-lista-filter',   [PageController::class, 'hospitalizacijaListaFilter']);
$router->any('hospitalizacija-lista-korisnik', [PageController::class, 'hospitalizacijaListaKorisnik']);
$router->any('hospitalizacija-unos',           [PageController::class, 'hospitalizacijaUnos']);
$router->any('hospitalizacija-izmeni',         [PageController::class, 'hospitalizacijaIzmeni']);
$router->any('pacijent-unos',                  [PageController::class, 'pacijentUnos']);
$router->any('pacijent-lista',                 [PageController::class, 'pacijentLista']);
$router->any('pacijent-lista-korisnik',        [PageController::class, 'pacijentListaKorisnik']);
$router->any('pacijent-izmeni',                [PageController::class, 'pacijentIzmeni']);
$router->any('pacijent-prijem',                [PageController::class, 'pacijentPrijem']);
$router->any('primljeni-pacijenti',            [PageController::class, 'primljeniPacijenti']);
$router->any('medicinski-tretmani-unos',       [PageController::class, 'medicinskiTretmaniUnos']);
$router->any('izvestaj-stampa',                [PageController::class, 'izvestajStampa']);
$router->any('stampa',                         [PageController::class, 'stampa']);

// ── API routes — Auth ────────────────────────────────────────────────────
require_once APP_DIR . '/Controllers/AuthController.php';

$router->post('api/auth/login',  [AuthController::class, 'login']);
$router->post('api/auth/logout', [AuthController::class, 'logout']);

// ── API routes — Pacijent ────────────────────────────────────────────────
require_once APP_DIR . '/Controllers/PacijentController.php';

$router->get('api/pacijent-form-data', [PacijentController::class, 'formData']);
$router->get('api/pacijent-lista',   [PacijentController::class, 'index']);
$router->get('api/pacijent-izmeni',  [PacijentController::class, 'show']);
$router->post('api/pacijent-unos',   [PacijentController::class, 'store']);
$router->post('api/pacijent-izmeni', [PacijentController::class, 'update']);
$router->put('api/pacijent-izmeni',  [PacijentController::class, 'update']);
$router->post('api/pacijent-obrisi', [PacijentController::class, 'delete']);

// ── API routes — Prijem ──────────────────────────────────────────────────
require_once APP_DIR . '/Controllers/PrijemController.php';

$router->get('api/prijem-lista',      [PrijemController::class, 'index']);
$router->get('api/prijem-form-data',  [PrijemController::class, 'formData']);
$router->post('api/prijem-unos',      [PrijemController::class, 'store']);

// ── API routes — Tretmani ────────────────────────────────────────────────
require_once APP_DIR . '/Controllers/TretmaniController.php';

$router->get('api/tretmani-tipovi', [TretmaniController::class, 'tipovi']);
$router->post('api/tretmani-unos',  [TretmaniController::class, 'store']);

// ── API routes — Hospitalizacija ─────────────────────────────────────────
require_once APP_DIR . '/Controllers/HospitalizacijaController.php';

$router->get('api/hospitalizacija-form-data', [HospitalizacijaController::class, 'formData']);
$router->post('api/hospitalizacija-unos',    [HospitalizacijaController::class, 'store']);
$router->get('api/hospitalizacije-index',    [HospitalizacijaController::class, 'index']);
$router->get('api/hospitalizacija-izmeni',   [HospitalizacijaController::class, 'show']);
$router->post('api/hospitalizacija-izmeni',  [HospitalizacijaController::class, 'update']);
$router->put('api/hospitalizacija-izmeni',   [HospitalizacijaController::class, 'update']);
$router->get('api/hospitalizacije-filter',   [HospitalizacijaController::class, 'filter']);
$router->get('api/hospitalizacije-korisnik', [HospitalizacijaController::class, 'listKorisnik']);
$router->post('api/hospitalizacija-obrisi',  [HospitalizacijaController::class, 'delete']);
$router->get('api/hospitalizacija-print',    [HospitalizacijaController::class, 'printReport']);
