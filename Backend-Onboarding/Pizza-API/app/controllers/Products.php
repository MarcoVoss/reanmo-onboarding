<?php
    class Users extends Controller {
        public function __construct() {
            $this->productModel = $this->model('Product');
        }

        public function products() {
            $data = $this->productModel->getAll();
            $this->view('JsonView', $data);
        }
    }