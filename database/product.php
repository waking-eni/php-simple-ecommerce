<?php

/*
Script with functions that fetch data from the database related to products
*/

require_once __DIR__.'/dbhandler.php';

class Product {

    public function connect()
    {
        $db = Database::getInstance();
        return $db;
    }

    public function fetchProducts($offset, $total_records_per_page) {
        $db = $this->connect();
        $sql = "SELECT id, name, price, image FROM product 
                ORDER BY name DESC LIMIT $offset, $total_records_per_page ;";
        $result = $db->getWithoutParameters($sql);
        return $result;
        exit();
    }

    public function getProduct($id) {
        $db = $this->connect();
        $sql = "SELECT id, name, price, quantity, image, image_large, category FROM product
                WHERE id = ? ;";
        $result = $db->getWithParameter($sql, $id);
        return $result;
        exit();
    }

    public function getAllCategories() {
        $db = $this->connect();
        $sql = "SELECT name FROM category ;";
        $result = $db->getWithoutParameters($sql);
        return $result;
        exit();
    }

    public function getProductByCategory($category) {
        $db = $this->connect();
        $sql = "SELECT id, name, price, image FROM product 
                WHERE category = ? ;";
        $result = $db->getWithParameter($sql, $category);
        return $result;
        exit();
    }

    public function getNumberOfProducts() {
        $db = $this->connect();
        $sql = "SELECT id FROM product ;";
        $result = $db->numRows($sql);
        return $result;
        exit();
    }

}
