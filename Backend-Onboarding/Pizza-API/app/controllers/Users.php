<?php
    class Users extends Controller {
        public function __construct() {
            $this->userModel = $this->model('User');
        }

        public function register() {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if(!isset($_POST) or count($_POST) != 4)
                ExceptionHelper::badRequestException();

            $data = [
                'name' => trim($_POST['name']),
                'mail' => trim($_POST['mail']),
                'phone' => trim($_POST['phone']),
                'password' => $this->hashPassword($_POST['password']),
            ];

            if($this->userAlreadyExists($data['mail']))
                ExceptionHelper::mailAlreadyExistException();

            return $this->userModel->create($data);
        }

        public function login() {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $mail = trim($_POST['mail']);
            $password = trim($_POST['password']);   
            $user = $this->userModel->getByEmail($mail);       
            $success = password_verify($password, $user->password);

            if ($success) {                
                $this->createSession($user);
            } else {
                ExceptionHelper::unauthorizedException();
            }
        }

        public function current() {
            $data = $this->userModel->getByEmail($_SESSION['mail']);
            $this->view('JsonView', $data);
        }

        public function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['mail']);
            unset($_SESSION['name']);
            session_destroy();
        }

        private function createSession($user) {
            session_start();
            $_SESSION['user_id'] = $user->id;
            $_SESSION['mail'] = $user->email;
            $_SESSION['name'] = $user->name;
        }

        private function userAlreadyExists($mail) {
            $this->userModel->getByEmail($mail);
            return $this->userModel->lastRowCount() > 0;
        }

        private function hashPassword($password) {
            return password_hash(trim($password), PASSWORD_DEFAULT);  
        }
    }