<?php

/*
Script for user log in
*/

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}


if(isset($_POST['login-submit'])) {
    require_once __DIR__.'/../database/dbhandler.php';
	
	$mailuid = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['mailuid']);
    $password = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['pwd']);
    
    $db = Database::getInstance();
	
	if(empty($mailuid) || empty($password))  {
		header("Location: ../public/loginUser.php?error=emptyfields&mailuid=".$mailuid."&mail=".$email);
		exit();
	}
	else {
		$sql = "SELECT * FROM user WHERE username = ? OR email = ? ;";
		$result = $db->checkLogIn($sql, $mailuid, $mailuid);
			if(!empty($result)) {
                foreach($result as $key => $value) {
                    $pwdCheck = password_verify($password, $value['password']);
                    if($pwdCheck == false) {
                        header("Location: ../public/loginUser.php?error=wrongpwd");
                        exit();
                    }
                    else if($pwdCheck == true) {
                        $_SESSION['userId'] = $value['id'];
                        $_SESSION['userUsername'] = $value['username'];
                        
                        header("Location: ../public/index.php?login=succes");
                        exit();
                    }
                }
			} else {
				header("Location: ../public/loginUser.php?error=nouser");
				exit();
			}
		}
	}

else {
	header("Location: ../public/loginUser.php");
	exit();
}
