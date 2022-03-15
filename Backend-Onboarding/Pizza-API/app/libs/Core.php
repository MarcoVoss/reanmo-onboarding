<?php
    class Core {
        public function __construct() {
            if (session_status() === PHP_SESSION_NONE) 
                session_start();
            
            $url = $this->getUrl();
            $method = $this->getRequestMethod();

            if(!$this->routeExists($method, $url[0])) 
                ExceptionHelper::notFoundException();

            $controllerName = $this->getController($method, $url[0]);
            $function = $this->getFunction($method, $url[0]);
            $urlPath = "../app/controllers/$controllerName.php";

            if(!file_exists($urlPath)) 
                ExceptionHelper::notFoundException();
            
            if($this->needsAuthorization($method, $url[0]) and !$this->isLoggedIn())
                ExceptionHelper::forbiddenAccessException();

            require_once $urlPath;
            $controller = new $controllerName;

            $params = array_values(array_slice($url, 1));
            call_user_func([$controller, $function], $params);
        }

        private function routeExists($method, $function) {
            return isset(ROUTES[$method][$function]);
        }

        private function getController($method, $function) {
            return ROUTES[$method][$function][0];
        }

        private function getFunction($method, $function) {
            return ROUTES[$method][$function][1];
        }

        private function needsAuthorization($method, $function) {
            return ROUTES[$method][$function][2];
        }

        private function isLoggedIn() {
            return isset($_SESSION['user_id']);
        }

        private function getRequestMethod() {
            return $_SERVER['REQUEST_METHOD'];
        }

        private function getUrl() {
            if(isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
            return [null, null];
        }
    }