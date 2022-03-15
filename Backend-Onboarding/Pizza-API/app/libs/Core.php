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

            unset($url[0]);
            require_once $urlPath;
            $controller = new $controllerName;

            $params = array_values(array_slice($url, 1));
            call_user_func([$controller, $function], $params);
        }

        public function routeExists($method, $function) {
            return isset(ROUTES[$method][$function]);
        }

        public function getController($method, $function) {
            return ROUTES[$method][$function][0];
        }

        public function getFunction($method, $function) {
            return ROUTES[$method][$function][1];
        }

        public function needsAuthorization($method, $function) {
            return ROUTES[$method][$function][2];
        }

        public function isLoggedIn() {
            return isset($_SESSION['user_id']);
        }

        public function getRequestMethod() {
            return $_SERVER['REQUEST_METHOD'];
        }

        public function getUrl() {
            if(isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
            return [null, null];
        }
    }