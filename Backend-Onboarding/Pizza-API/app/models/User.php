<?php
    class User {
        private $db;
        public function __construct() {
            $this->db = new Database();
        }

        public function create($data) {
            $this->db->query('INSERT INTO users (name, email, phone, password) VALUES (:name, :email, :phone, :password)');
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
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

        public function update($data) {
            $this->db->query('UPDATE users SET name=:name, email=:email, phone=:phone, password=:password WHERE email=:preEmail');
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':preEmail', $data['preEmail']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':password', $data['password']);
            $this->db->single();
            return $this->db->rowCount() > 0;
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