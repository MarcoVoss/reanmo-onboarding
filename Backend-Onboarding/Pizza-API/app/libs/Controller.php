<?php
    abstract Class Controller {
        public function model($model) {
            require_once "../app/models/$model.php";
            return new $model();
        }

        public function view($view, $data = []) {
            $viewPath = "../app/views/$view.php";
            if(!file_exists($viewPath))
                ExceptionHelper::notFoundException();

            require_once $viewPath;
        }

        public function jsonView($data) {

        }
    }