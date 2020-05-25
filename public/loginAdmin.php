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
    <title>Nowena Log In Administrator</title>
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

            <h1 class="text-center mt-5">Log In Administrator</h1>
            <!--action points to the script for administrator log in-->
            <form class="center-div" name="loginForm" action="../includes/loginadmin.inc.php" method="post" onsubmit="return(validate());">
                <input type="text" name="mailuid" placeholder="E-mail/Username">
                <p id="adminMailName"></p>
                <input class="d-block my-3" type="password" name="pwd" placeholder="Password">
                <p id="adminPwd"></p>
                <button class="d-block my-3 btn btn-dark float-right" type="submit" name="login-submit">Log In</button>
            </form>

            </main>
            <!--end of main-->
        </div>
    </div>
    <!--end of wrapper-->

<script>
//client side validation

function validate() {
    
    if(document.forms["loginForm"]["mailuid"].value == "") {
        document.getElementById("adminMailName").innerHTML = "Please provide your E-mail/Username";
        document.forms["loginForm"]["mailuid"].focus();
        return false;
    }
    if(document.forms["loginForm"]["pwd"].value == "") {
        document.getElementById("adminPwd").innerHTML = "Please provide your password";
        document.forms["loginForm"]["pwd"].focus();
        return false;
    }
}

</script>

<?php
    //does the user exist
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if(strpos($actual_link, 'nouser')) {
        echo '<script>document.getElementById("adminMailName").innerHTML = "User doesn\'t exist";</script>';
    }

?>
    
</body>
</html>
