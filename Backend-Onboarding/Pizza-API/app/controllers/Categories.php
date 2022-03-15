<?php
    class Users extends Controller {
        public function __construct() {
            $this->categoryModel = $this->model('Category');
        }

        public function categories() {
            $data = $this->categoryModel->getAll();
            $this->view('JsonView', $data);
        }
    }