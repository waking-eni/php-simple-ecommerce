<?php

/*
Script for user sign up
*/

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if(isset($_POST['signup-submit'])) {
    require_once __DIR__.'/../database/dbhandler.php';
	
	$username = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['uid']);
	$email = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['mail']);
	$password = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['pwd']);
    $passwordRepeat = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['pwd-repeat']);
    
    $db = Database::getInstance();
	
	/*error handlers */

	if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat) ) {
		header("Location: ../public/signup.php?error=emptyfields&uid=".$username."&mail=".$email);
		exit();
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: ../public/signup.php?error=invalidmailuid");
		exit();
	}
	/* check for invalid email */
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../public/signup.php?error=invalidmail&uid=".$username);
		exit();
	}
	/* check for invalid username */
	else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: ../public/signup.php?error=invaliduid&mail=".$email);
		exit();
	}
	/* are the two password fields matching */
	else if($password !== $passwordRepeat) {
		header("Location: ../public/signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
		exit();
	}
	else {
		/* does the chosen username already exist*/
		$sql = "SELECT username FROM user WHERE username = ? ;";
		$resultCheck = $db->numRows($sql);
		if($resultCheck > 0) {
			header("Location: ../public/signup.php?error=usertaken&mail=".$email);
			exit();
		} else {
            /* insert */
            $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?) ;";
			$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            $db->insertData($sql,$username, $email, $hashedPwd);
            header("Location: ../public/loginuser.php?signup=success");
            exit();
		}
	}
		
} else {
	header("Location: ../public/signup.php");
	exit();
}
