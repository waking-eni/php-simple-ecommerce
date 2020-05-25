<?php

/*
Script for administrator log in
*/

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

//checking SHA-256 password
function checkPassword($password, $db_password)
{
    $hashed = hash('sha256',$password);
    return ($hashed == $db_password) ? true : false;
}

if(isset($_POST['login-submit'])) {
    require_once __DIR__.'/../database/dbhandler.php';
	
	$mailuid = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['mailuid']);
    $password = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['pwd']);
    
    $db = Database::getInstance();
	
	if(empty($mailuid) || empty($password))  {
		header("Location: ../public/loginadministrator.php?error=emptyfields&mailuid=".$mailuid."&mail=".$email);
		exit();
	}
	else {
		$sql = "SELECT * FROM administrator WHERE username = ? OR email = ? ;";
        $result = $db->checkLogIn($sql, $mailuid, $mailuid);
        if(!empty($result)) {
            foreach($result as $key => $value) {
                    /*I used SHA-256 for password encryption in MySQL for administrators*/ 
                    $pwdCheck = checkPassword($password, $value['password']);
                    if($pwdCheck == false) {
                        header("Location: ../public/loginadministrator.php?error=wrongpwd");
                        exit();
                    } else if($pwdCheck == true) {
                        $_SESSION['administratorId'] = $value['id'];
                        $_SESSION['administratorUsername'] = $value['username'];
                        
                        header("Location: ../public/index.php?login=succes");
                        exit();
                    }
            }
        } else {
            header("Location: ../public/loginuser.php?error=nouser");
            exit();
        }
	}
	
} else {
	header("Location: ../public/loginadministrator.php");
	exit();
}
