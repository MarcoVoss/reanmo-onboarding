<?php
    abstract class CRUDModel {
        abstract function getAll();

        abstract function getOne($key);

        abstract function update($key, $data);

        abstract function delete($key);

        abstract function create($data);
    }