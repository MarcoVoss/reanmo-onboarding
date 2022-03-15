<?php
    class User {
        private $db;
        public function __construct() {
            $this->db = new Database();
        }

        public function create($data) {
            $this->db->query('INSERT INTO users (name, email, phone, password) VALUES (:name, :mail, :phone, :password)');
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':mail', $data['mail']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':password', $data['password']);
            $this->db->single();
            return $this->db->rowCount() > 0;
        }

        public function getAll() {
            $this->db->query('SELECT * FROM users');
            return $this->db->resultSet();
        }

        public function getById($id) {
            $this->db->query('SELECT * FROM users WHERE id= :id');
            $this->db->bind(':id', $id);
            return $this->db->single();
        }

        public function getByEmail($mail) {
            $this->db->query('SELECT * FROM users WHERE email= :email');
            $this->db->bind(':email', $mail);
            return $this->db->single();
        }

        public function lastRowCount() {
            return $this->db->rowCount();
        }
    }