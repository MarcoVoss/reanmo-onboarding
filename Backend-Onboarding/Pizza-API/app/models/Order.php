<?php
    class Order extends CRUDModel {
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

        public function delete($key) {
            $this->db->query('DELETE FROM orders WHERE id= :id');
            $this->db->bind(':id', $key['id']);
            return $this->db->single();
        }

        public function update($key, $data) {
            $this->db->query('UPDATE orders SET user_id=:user_id, date=:date, price=:price WHERE id=:id');
            $this->db->bind(':id', $key['id']);
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

        public function getOne($key) {
            $this->db->query('SELECT * FROM orders WHERE id=:id');
            $this->db->bind(':id', $key['id']);
            return $this->db->single();
        }

        public function getPastOrders($userId) {
            $this->db->query('SELECT o.id as OId, o.date as Date, o.price as Price, p.id as PId, p.name as PName, ops.amount as Amount, s.id as SId, s.name as SName
                FROM orders as o
                RIGHT JOIN orders_products_sizes as ops ON ops.order_id = o.id
                LEFT JOIN products as p ON ops.product_id = p.id
                LEFT JOIN sizes as s ON ops.size_id = s.id
                WHERE o.user_id = :user_id');
            $this->db->bind(':user_id', $userId);
            return $this->db->resultSet();
        }

        public function lastRowCount() {
            return $this->db->rowCount();
        }
    }