<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

   include_once __DIR__.'/../database/product.php';
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

            try {
                $product = new Product();
            } catch(Exception $e) {
                echo 'Caught exception: '.$e->getMessage();
            }

            $idProduct = $_GET['id'];
            $productt = $product->getProduct($idProduct);

            //show the product
            if(!empty($productt)) {

                foreach($productt as $key => $value) {
                    echo '<div class="col-sm-6">';
                        echo '<div class="card">';
                            echo '<img class="card-img-top" src="../images/products-small/'.$value['image'].
                                '" alt="Product image">';
                            echo '<div class="card-body">';
                                echo '<h2 class="card-text"><a class="text-muted h6" target="_blank" href="../images/products-original/'.$value['image_large'].
                                    '">Full sized image</a></h2>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';

                        echo '<div class="col-sm-6">';
                            echo '<div class="card">';
                                echo '<div class="card-body">';
                                    echo '<h2 class="card-header">'.stripslashes($value['name']).'</h2>';
                                    echo '<form id="productform" method="post" action="../includes/addtocart.inc.php" 
                                            oninput="totalview.value=parseInt(quantity.value)*'.stripslashes($value['price']).'" onchange="return(total());">';
                                        echo '<div class="form-row">';
                                            echo '<div class="col">';
                                                //category
                                                echo '<div class="md-form">';
                                                    echo '<p>Category: '.stripslashes($value['category']).'</p>';
                                                echo '</div';
                                                //id
                                                echo '<div class="md-form">';
                                                    echo '<p>Product code: '.stripslashes($value['id']).'</p>';
                                                echo '</div';
                                                //quantity
                                                echo '<div class="md-form">';
                                                    echo '<label for:"quantity">Quantity: </label>';
                                                    echo '<select id="quantity" name="quantity" size="1">';
                                                        for($i=1; $i<stripslashes($value['quantity']+1); $i++) {
                                                            echo '<option>'.$i.'</option>';
                                                        }
                                                    echo '</select>';
                                                echo '</div';
                                                //price
                                                echo '<div class="md-form">';
                                                    echo '<p>Price: '.stripslashes($value['price']).'</p>';
                                                echo '</div';
                                                //total
                                                echo '<div class="md-form">';
                                                    echo '<label for:"totalview">Total: </label>';
                                                        echo '<output id="totalview" name="totalview" for="quantity price" form="productform">'.stripslashes($value['price']).'</output>';
                                                echo '</div';
                                                //submit
                                                echo '<div class="md-form">';
                                                    echo '<button class="d-block my-3 btn btn-dark float-right" type="submit" name="addtocart">Add to Cart</button>';
                                                    echo '<input type="hidden" id="total" name="total">';
                                                echo '</div';
                                                //hidden id input field
                                                echo '<input type="hidden" id="productId" name="productId" value="'.stripslashes($value['id']).'">';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</form>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                }

            }

            ?>

            </div>
        </main>
        <!--end of main-->

<script>
    //put output value in the hidden input field to send it to the script via post method (on submit)
    function total() {
        document.getElementById('total').value = document.getElementById('totalview').value;
    }

</script>

</body>

</html>
