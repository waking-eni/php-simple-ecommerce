<?php

/*
Script that deletes products from the database once administrator choses to do so
*/

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

require_once __DIR__.'/../database/dbhandler.php';
$db = Database::getInstance();

if(isset($_POST['deletepr'])) {
    $id = str_replace(array(':', '-', '/', '*', '<', '>'), '',  $_POST['prId']);
    
    if(empty($id)) {
        header("Location: ../public/adminManageProducts.php?error=emptyid");
        exit();
    } else {
        $sql="DELETE FROM product WHERE id = ? ;";
        $db->deleteData($sql, $id);
        header("Location: ../public/adminManageProducts.php?deletearticle=success");
		exit();
    }

} else {
    header("Location: ../public/adminManageProducts.php");
	exit();
}
