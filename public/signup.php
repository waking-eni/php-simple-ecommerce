<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
    crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
    crossorigin="anonymous"></script>
    <title>Nowena Sign Up</title>
    <link rel="stylesheet" href="../design/style.css">
</head>
<body>

    <!--Navigation bar-->
    <?php
        include 'header.php';
    ?>
    <!--end of navigation-->

    <!--wrapper-->
    <div class="container-fluid">
        <div class="row row-wrapper">

            <!--sidebar-->
            <?php
                include 'sidebar.php';
            ?>
            <!--end of sidebar-->

            <!--main-->
            <main class="col-9 main">

            <h1 class="text-center mt-5">Sign up</h1>
            <!-- Action points to the script for user sign up-->
            <form class="center-div" name="loginForm" action="../includes/signup.inc.php" method="post" onsubmit="return(validate());">
                <input class="d-block my-3" type="text" name="uid" placeholder="Username">
                <p id="userName"></p>
                <input class="d-block my-3" type="text" name="mail" placeholder="E-mail">
                <p id="userMail"></p>
                <input class="d-block my-3" type="password" name="pwd" placeholder="Password">
                <p id="userPwdd"></p>
                <input class="d-block my-3" type="password" name="pwd-repeat" placeholder="Repeat password">
                <p id="userPwddRep"></p>
                <button class="d-block my-3 btn btn-dark float-right" type="submit" name="signup-submit">Sign Up</button>
            </form>

            </main>
            <!--end of main-->
        </div>
    </div>
    <!--end of wrapper-->

<script>
//client side validation

function validate() {
    
    if(document.forms["loginForm"]["uid"].value == "") {
        document.getElementById("userName").innerHTML = "Please provide your Username";
        document.forms["loginForm"]["uid"].focus();
        return false;
    }
    if(document.forms["loginForm"]["mail"].value == "") {
        document.getElementById("userMail").innerHTML = "Please provide your E-mail";
        document.forms["loginForm"]["mail"].focus();
        return false;
    }
    if(document.forms["loginForm"]["pwd"].value == "") {
        document.getElementById("userPwdd").innerHTML = "Please provide your Password";
        document.forms["loginForm"]["pwd"].focus();
        return false;
    }
    if(document.forms["loginForm"]["pwd-repeat"].value == "") {
        document.getElementById("userPwddRep").innerHTML = "Please repeat your Password";
        document.forms["loginForm"]["pwd-repeat"].focus();
        return false;
    }
}

</script>

<?php
    //does the username already exist
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if(strpos($actual_link, 'usertaken')) {
        echo '<script>document.getElementById("userName").innerHTML = "Username already exists";</script>';
    }

?>

</body>
</html>
