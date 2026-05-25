<?php
require_once APP_DIR . '/Core/Request.php';
require_once APP_DIR . '/Core/Response.php';

abstract class BaseController {
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
        if (!isset($_SESSION['idkorisnika'])) {
            Response::unauthorized();
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
