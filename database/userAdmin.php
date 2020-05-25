<?php

/*
Script with a function that gets user's or administrator's username from the database
*/

require_once __DIR__.'/dbhandler.php';

class UserAndAdmin {

    public function connect()
    {
        $db = Database::getInstance();
        return $db;
    }

    public function getUsername($table, $id) {
        $db = $this->connect();
        $sql = "SELECT username FROM $table WHERE id = ? ;";
        $result = $db->getWithParameter($sql, $id);
        return $result;
        exit();
    }

}
