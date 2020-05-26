<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

?>

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
    <title>Nowena</title>
    <link rel="stylesheet" href="../design/style.css">
</head>

<body>

    <!--Navigation bar-->
    <?php
        include 'header.php';
    ?>
    <!--end of navigation-->

    <!--wrapper-->
    <div class="container-fluid wrapper-container">
        <div class="row row-wrapper mt-5">

            <!--sidebar-->
            <?php
                include 'sidebar.php';
            ?>
            <!--end of sidebar-->

            <!--main-->
            <main class="col-9 main">
                <div class="main-card row">

                    <?php

                    if(isset($_SESSION['userUsername'])) {
                        if(isset($_SESSION['cart'])) {
                            $max = sizeof($_SESSION['cart']);
                            $array = $_SESSION['cart'];
                            if(array_key_exists(0, $array[0])) {
                                for($i=0; $i<$max; $i++) {
                                    echo '<tr>';
                                        echo '<td>';
                                            echo $array[$i][0];
                                        echo '</td>';
                                        echo '<td>';
                                            echo $array[$i][1];
                                        echo '</td>';
                                        echo '<td>';
                                            echo $array[$i][2];
                                        echo '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<p>Your cart is empty.</p>';
                            }
                        } 
                    } 

                    ?>

                </div>
            </main>
            <!--end of main-->

        </div>
    </div>
    <!--end of wrapper-->

</body>

</html>
