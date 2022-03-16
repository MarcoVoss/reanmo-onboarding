<?php
    class Product extends CRUDModel{
        private $db;
        public function __construct() {
            $this->db = new Database();
        }

        public function create($data) {
            $this->db->query('INSERT INTO products (category_id, name, imagePath) VALUES (:category_id, :name, :path)');
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':path', $data['path']);
            $this->db->bind(':category_id', $data['category_id']);
            $this->db->single();
            return $this->db->rowCount() > 0;
        }

        public function getAll() {
            $this->db->query('SELECT p.id as PId, p.name as PName, c.name as CName, p.imagePath as Path, s.id as SId, s.name as SName, ps.price as Price
                FROM products_sizes as ps
                LEFT JOIN products as p ON ps.product_id=p.id 
                LEFT JOIN sizes as s ON ps.size_id=s.id
                LEFT JOIN categories as c ON p.category_id=c.id');
            return $this->db->resultSet();
        }

        public function getOne($key) {
            $this->db->query('SELECT p.id, p.name, c.name, p.imagePath, s.id, s.name, ps.price
                FROM products_sizes as ps
                LEFT JOIN products as p ON ps.product_id=p.id 
                LEFT JOIN sizes as s ON ps.size_id=s.id
                LEFT JOIN categories as c ON p.category_id=c.id
                WHERE id= :id');
            $this->db->bind(':id', $key['id']);
            return $this->db->single();
        }

        public function update($key, $data) {
            $this->db->query('UPDATE products SET category_id=:category_id, name=:name WHERE id= :id');
            $this->db->bind(':id', $key['id']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':category_id', $data['category_id']);
            $this->db->bind(':imagePath', $data['path']);
            return $this->db->single();
        }

        public function delete($key) {
            $this->db->query('DELETE FROM products_sizes as ps WHERE id= :id');
            $this->db->bind(':id', $key['id']);
            return $this->db->single();
        }

        public function lastRowCount() {
            return $this->db->rowCount();
        }
    }