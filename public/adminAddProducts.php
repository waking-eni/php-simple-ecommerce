<?php
   include_once __DIR__.'/../database/product.php';
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
        <div class="row row-wrapper">

            <!--sidebar-->
            <?php
                include 'sidebar.php';
            ?>
            <!--end of sidebar-->

            <!--main-->
            <main class="col-9 main">

                <?php
                    try {
                        $product = new Product();
                    } catch(Exception $e) {
                        echo 'Caught exception: '.$e->getMessage();
                    }
                    $categories = $product->getAllCategories();
                ?>

                <!--form for adding products-->
                <h1 class="text-center mt-5">New Product</h1>    
                <form enctype="multipart/form-data" class="center-divv" name="adminaddForm" action="../includes/adminaddpr.inc.php" method="post" onsubmit="return(validate());">
                    <div class="form-group">
                        <label for="name">Name</label>    
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        <p id="prname"></p>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label> 
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price">
                        <p id="prprice"></p>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category">
                            <?php 
                                if($categories && !empty($categories)) {
                                    foreach($categories as $key => $category) {
                                        echo '<option>';
                                        echo $category["category"];
                                        echo '</option>';
                                    }
                                }
                            ?>
                        </select>
                        <p id="prcategory"></p>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label> 
                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
                        <p id="prquantity"></p>
                    </div>
                    <div class="form-group">
                        <label for="chooseimg">Choose a preview picture</label>    
                        <input type="file" name="chooseimg" id="chooseimg" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="chooseimg">Choose a full sized picture</label>    
                        <input type="file" name="chooseimg" id="chooseimg" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="d-block my-3 btn btn-dark float-right" type="submit" name="add-article">Add</button>
                    </div>
                </form>

            </main>
            <!--end of main-->
        </div>
    </div>
    <!--end of wrapper-->
    
<script>
//client side validation

function validate() {
    
    if(document.forms["adminaddForm"]["name"].value == "") {
        document.getElementById("prname").innerHTML = "Please provide a Name";
        document.forms["adminaddForm"]["name"].focus();
        return false;
    }
    if(document.forms["adminaddForm"]["price"].value == "") {
        document.getElementById("prprice").innerHTML = "Please provide a Price";
        document.forms["adminaddForm"]["price"].focus();
        return false;
    }
    if(document.forms["adminaddForm"]["quantity"].value == "") {
        document.getElementById("prquantity").innerHTML = "Please provide the Quantity";
        document.forms["adminaddForm"]["quantity"].focus();
        return false;
    }
}

</script>

</body>
</html>
