<?php
    class ShoppingCart extends CRUDModel {
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

        public function getOne($key) {
            $this->db->query('SELECT * FROM products_users_sizes WHERE user_id=:user_id and product_id=:product_id and size_id=:size_id');
            $this->db->bind(':user_id', $key['user_id']);
            $this->db->bind(':product_id', $key['product_id']);
            $this->db->bind(':size_id', $key['size_id']);
            return $this->db->single();
        }

        public function getByUser($user_id) {
            $this->db->query('SELECT * FROM products_users_sizes WHERE user_id=:user_id');
            $this->db->bind(':user_id', $user_id);
            return $this->db->single();
        }

        public function update($key, $data) {
            $this->db->query('UPDATE products_users_sizes SET amount=:amount WHERE user_id=:user_id and product_id=:product_id and size_id=:size_id');
            $this->db->bind(':user_id', $key['user_id']);
            $this->db->bind(':product_id', $key['product_id']);
            $this->db->bind(':size_id', $key['size_id']);
            $this->db->bind(':amount', $data['amount']);
            return $this->db->single();
        }

        public function delete($key) {
            $this->db->query('DELETE FROM products_users_sizes WHERE user_id=:user_id and product_id=:product_id and size_id=:size_id');
            $this->db->bind(':user_id', $key['user_id']);
            $this->db->bind(':product_id', $key['product_id']);
            $this->db->bind(':size_id', $key['size_id']);
            return $this->db->single();
        }

        public function lastRowCount() {
            return $this->db->rowCount();
        }
    }