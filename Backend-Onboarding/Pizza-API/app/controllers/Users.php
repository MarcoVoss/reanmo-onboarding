<?php
    class Users extends Controller {
        public function __construct() {
            $this->userModel = $this->model('User');
        }

        public function register() {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if(!$this->verifyUserData($_POST))
                ExceptionHelper::badRequestException();

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'password' => $this->hashPassword($_POST['password']),
            ];

            if($this->userAlreadyExists($data['email']))
                ExceptionHelper::mailAlreadyExistException();

            return $this->userModel->create($data);
        }

        public function login() {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if(!$this->verifyLoginData($_POST))
                ExceptionHelper::badRequestException();

            $mail = trim($_POST['email']);
            $password = trim($_POST['password']);   
            $user = $this->userModel->getByEmail($mail);  

            if(!$user)
                ExceptionHelper::unauthorizedException();

            $success = password_verify($password, $user->password);

            if ($success) {                
                $this->createSession($user);
            } else {
                ExceptionHelper::unauthorizedException();
            }
        }

        public function current() {
            $data = $this->userModel->getByEmail($_SESSION['email']);
            $this->view('JsonView', $data);
        }

        public function update($request) {
            if(!$this->verifyUpdateData($request))
                ExceptionHelper::badRequestException();

            $data = [
                'name' => $request[0],
                'email' => $request[1],
                'phone' => $request[2],
                'password' => $this->hashPassword($request[3]),
            ];

            $key = [
                'preEmail' => $_SESSION['email']
            ];

            if($this->userAlreadyExists($data['email']))
                ExceptionHelper::mailAlreadyExistException();
            
            if($this->userModel->update($key, $data)) {
                $user = $this->userModel->getByEmail($data['email']); 
                $this->createSession($user);
            } else {
                ExceptionHelper::internalServerError();
            }
        }

        public function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['email']);
            unset($_SESSION['name']);
            session_destroy();
        }

        private function verifyLoginData($data) {
            return isset($data) and isset($data['email']) and isset($data['password']);
        }

        private function verifyUserData($data) {
            return isset($data) and isset($data['name']) and isset($data['email']) and isset($data['phone']) and isset($data['password']);
        }

        private function verifyUpdateData($data) {
            return isset($data) and count($data) == 4;
        }

        private function createSession($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['email'] = $user->email;
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