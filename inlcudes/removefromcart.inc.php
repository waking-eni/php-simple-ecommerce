<?php

/*
Script for the functionality of removing a product from the cart
*/

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if(isset($_POST['prRemove'])) {

    $prId = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['prId']);

    foreach($_SESSION['cart'] as $subKey => $subArray){
        if($subArray[0] == $prId){
            unset($_SESSION['cart'][$subKey]);
        }
    }

    header("Location: ../public/cart.php");
	exit();

} else {
    header("Location: ../public/index.php");
	exit();
}
