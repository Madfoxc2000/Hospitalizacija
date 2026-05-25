<?php

class Request {
    public string $method;
    public string $uri;

    public function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
    }

    public function get(string $key, $default = null) {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }

    public function post(string $key, $default = null) {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    public function input(string $key, $default = null) {
        $data = $this->all();
        return isset($data[$key]) ? $data[$key] : $default;
    }

    public function all(): array {
        if ($this->method === 'PUT' || $this->method === 'PATCH') {
            parse_str(file_get_contents('php://input'), $payload);
            return $payload;
        }
        return $_POST;
    }

    public function isMethod(string $method): bool {
        return strtoupper($this->method) === strtoupper($method);
    }

    public function isAjax(): bool {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}
