<?php
    class Category {
        private $db;
        public function __construct() {
            $this->db = new Database();
        }

        public function create($data) {
            $this->db->query('INSERT INTO categories (name) VALUES (:name)');
            $this->db->bind(':name', $data['name']);
            $this->db->single();
            return $this->db->rowCount() > 0;
        }

        public function getAll() {
            $this->db->query('SELECT * FROM categories');
            return $this->db->resultSet();
        }

        public function getById($id) {
            $this->db->query('SELECT * FROM categories WHERE id= :id');
            $this->db->bind(':id', $id);
            return $this->db->single();
        }

        public function update($data) {
            $this->db->query('UPDATE categories SET name=:name WHERE id= :id');
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':name', $data['name']);
            return $this->db->single();
        }

        public function lastRowCount() {
            return $this->db->rowCount();
        }
    }