<?php
    class ShoppingCart {
        private $db;
        public function __construct() {
            $this->db = new Database();
        }

        public function create($data) {
            $this->db->query('INSERT INTO products_users_sizes (user_id, product_id, size_id, amount) VALUES (:user_id, :product_id, :size_id, :amount)');
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':product_id', $data['product_id']);
            $this->db->bind(':size_id', $data['size_id']);
            $this->db->bind(':amount', $data['amount']);
            $this->db->single();
            return $this->db->rowCount() > 0;
        }

        public function getAll() {
            $this->db->query('SELECT * FROM products_users_sizes');
            return $this->db->resultSet();
        }

        public function getByUser($user_id) {
            $this->db->query('SELECT * FROM products_users_sizes WHERE user_id=:user_id');
            $this->db->bind(':user_id', $user_id);
            return $this->db->single();
        }

        public function update($data) {
            $this->db->query('UPDATE products_users_sizes SET amount=:amount WHERE user_id=:user_id and product_id=:product_id and size_id=:size_id');
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':product_id', $data['product_id']);
            $this->db->bind(':size_id', $data['size_id']);
            $this->db->bind(':amount', $data['amount']);
            return $this->db->single();
        }

        public function lastRowCount() {
            return $this->db->rowCount();
        }
    }