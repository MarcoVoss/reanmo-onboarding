<?php
    class User {
        private $db;
        public function __construct() {
            $this->db = new Database();
        }

        public function create($data) {
            $this->db->query('INSERT INTO orders (user_id, date, price) VALUES (:user_id, :date, :price)');
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':date', $data['date']);
            $this->db->bind(':price', $data['price']);
            $this->db->single();
            return $this->db->rowCount() > 0;
        }

        public function getAll() {
            $this->db->query('SELECT * FROM orders');
            return $this->db->resultSet();
        }

        public function getById($id) {
            $this->db->query('SELECT * FROM orders WHERE id= :id');
            $this->db->bind(':id', $id);
            return $this->db->single();
        }

        public function update($data) {
            $this->db->query('UPDATE orders SET user_id=:user_id, date=:date, price=:price');
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':date', $data['date']);
            $this->db->bind(':price', $data['price']);
            return $this->db->single();
        }

        public function lastRowCount() {
            return $this->db->rowCount();
        }
    }