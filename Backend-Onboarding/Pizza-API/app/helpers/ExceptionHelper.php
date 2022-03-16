<?php
    abstract class ExceptionHelper {
        public static function notFoundException() {
            ExceptionHelper::httpException(404);
        }

        public static function forbiddenAccessException() {
            ExceptionHelper::httpException(403);
        }

        public static function badRequestException() {
            ExceptionHelper::httpException(400);
        }

        public static function mailAlreadyExistException() {
            ExceptionHelper::httpException(409);
        }

        public static function unauthorizedException() {
            ExceptionHelper::httpException(401);
        }

        public static function internalServerError() {
            ExceptionHelper::httpException(500);
        }

        public static function httpException($code) {
            http_response_code($code);
            die();
        }
    }