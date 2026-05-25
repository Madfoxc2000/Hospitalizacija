<?php

class Response {
    public static function json($data, int $status = 200): void {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

    public static function view(string $file, array $data = []): void {
        extract($data);
        require $file;
        exit;
    }

    public static function redirect(string $url): void {
        header("Location: $url");
        exit;
    }

    public static function notFound(string $message = 'Not Found'): void {
        http_response_code(404);
        echo $message;
        exit;
    }

    public static function unauthorized(): void {
        http_response_code(401);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['error' => 'unauthorized']);
        exit;
    }

    public static function methodNotAllowed(): void {
        http_response_code(405);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['error' => 'method_not_allowed']);
        exit;
    }

    public static function serverError(string $details = ''): void {
        http_response_code(500);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['error' => 'server_error', 'details' => $details]);
        exit;
    }
}
