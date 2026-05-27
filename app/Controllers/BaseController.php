<?php
require_once APP_DIR . '/Core/Request.php';
require_once APP_DIR . '/Core/Response.php';

abstract class BaseController {

    const ROLE_ADMIN  = 'Администратор';
    const ROLE_LEKAR  = 'Лекар';
    const ROLE_SESTRA = 'Медицинска сестра';

    protected Request $request;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->request = new Request();
    }

    protected function requireAuth(): void {
        if (!isset($_SESSION['korisnik'])) {
            Response::unauthorized();
        }
    }

    protected function requireAdminAuth(): void {
        if (!isset($_SESSION['uloga']) || $_SESSION['uloga'] !== self::ROLE_ADMIN) {
            Response::unauthorized();
        }
    }

    // Odbija sa 401 ako nije prijavljen, 403 ako je prijavljen ali nema odgovarajuću ulogu.
    protected function requireRole(array $roles): void {
        if (!isset($_SESSION['korisnik'])) {
            Response::unauthorized();
        }
        if (!in_array($_SESSION['uloga'] ?? '', $roles, true)) {
            Response::forbidden();
        }
    }

    protected function json($data, int $status = 200): void {
        Response::json($data, $status);
    }

    protected function view(string $file, array $data = []): void {
        Response::view($file, $data);
    }

    protected function redirect(string $url): void {
        Response::redirect($url);
    }
}
