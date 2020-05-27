<?php

/*
Script that adds products to the database once administrator choses to do so,
and if everything is proper
*/

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if(isset($_POST['add-product'])) {
    require_once __DIR__.'/../database/dbhandler.php';

    $name = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['name']);
    $price = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['price']);
    $category = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['category']);
    $quantity = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['quantity']);

    if(count($_FILES) > 0) {
        if(is_uploaded_file($_FILES['chooseimg']['tmp_name'])) {
            $image = addslashes(file_get_contents($_FILES['chooseimg']['tmp_name']));
            $imagename = $_FILES['chooseimg']['name'];
        }
        if(is_uploaded_file($_FILES['chooseimgl']['tmp_name'])) {
            $imagel = addslashes(file_get_contents($_FILES['chooseimgl']['tmp_name']));
            $imagelname = $_FILES['chooseimgl']['name'];
        }
        $target = "../images/products-small/".basename($image);
        $targetl = "../images/products-original/".basename($imagel);
        move_uploaded_file($image, $target);
        move_uploaded_file($imagel, $targetl);
    } else {
        $image = null;
        $imagel = null;
    }

    $db = Database::getInstance();

    if(empty($name) || empty($price) || empty($category)  || empty($quantity)) {
        header("Location: ../public/adminAddProducts.php?error=emptyfields");
        exit();
    } else {
        $sql = "INSERT INTO product (name, price, quantity, image, image_large, category)
        VALUES ('".$name."', '".$price."', '".$quantity."','".$imagename."', '".$imagelname."', '".$category.") ;";
        $db->runQuery($sql);
        header("Location: ../public/adminAddProducts.php?add=success");
        exit();
    }

} else {
    header("Location: ../public/adminAddProducts.php");
    exit();
}
