<?php
    class Users extends Controller {
        public function __construct() {
            $this->orderModel = $this->model('Order');
        }

        public function orders() {
            $data = $this->orderModel->getAll();
            $this->view('JsonView', $data);
        }
    }