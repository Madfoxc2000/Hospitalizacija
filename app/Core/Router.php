<?php

class Router {
    private array $routes = [];
    private string $basePath;

    public function __construct(string $basePath = '') {
        $this->basePath = rtrim($basePath, '/');
    }

    public function get(string $path, $handler): void {
        $this->routes[] = ['GET', $path, $handler];
    }

    public function post(string $path, $handler): void {
        $this->routes[] = ['POST', $path, $handler];
    }

    public function put(string $path, $handler): void {
        $this->routes[] = ['PUT', $path, $handler];
    }

    public function delete(string $path, $handler): void {
        $this->routes[] = ['DELETE', $path, $handler];
    }

    public function any(string $path, $handler): void {
        $this->routes[] = ['ANY', $path, $handler];
    }

    public function dispatch(): void {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';

        if ($this->basePath !== '' && strpos($uri, $this->basePath) === 0) {
            $uri = substr($uri, strlen($this->basePath));
        }
        $path = trim($uri, '/');

        foreach ($this->routes as [$routeMethod, $routePath, $handler]) {
            if ($routeMethod !== 'ANY' && $routeMethod !== $method) {
                continue;
            }

            $params = [];
            if ($this->matches($routePath, $path, $params)) {
                $this->call($handler, $params);
                return;
            }
        }

        http_response_code(404);
        echo 'Not Found';
    }

    private function matches(string $routePath, string $path, array &$params): bool {
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $routePath);
        $pattern = '#^' . $pattern . '$#u';

        if (!preg_match($pattern, $path, $matches)) {
            return false;
        }

        foreach ($matches as $key => $value) {
            if (is_string($key)) {
                $params[$key] = $value;
            }
        }
        return true;
    }

    private function call($handler, array $params): void {
        if ($handler instanceof Closure) {
            call_user_func_array($handler, array_values($params));
        } elseif (is_array($handler) && count($handler) === 2) {
            [$class, $method] = $handler;
            $instance = new $class();
            call_user_func_array([$instance, $method], array_values($params));
        } elseif (is_string($handler) && file_exists($handler)) {
            require $handler;
        }
    }
}
