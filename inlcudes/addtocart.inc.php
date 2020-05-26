<?php

/*
Script for the functionality of adding a product to the cart
*/

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if(isset($_POST['addtocart'])) {
    require_once __DIR__.'/../database/dbhandler.php';

    try {
        $db = Database::getInstance();
    } catch(Exception $e) {
        echo 'Caught exception: '.$e->getMessage();
    }

    $quantity = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['quantity']);
    $total = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['total']);
    $productId = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['productId']);

    if(empty($quantity) || empty($total) || empty($productId)) {
        header("Location: ../public/index.php?error=noproduct");
        exit();
    } else {
        $_SESSION['cart'] = array();
        $a = array($productId, $quantity, $total);
        array_push($_SESSION['cart'], $a);

        header("Location: ../public/cart.php");
        exit();
    }

} else {
    header("Location: ../public/index.php");
	exit();
}
