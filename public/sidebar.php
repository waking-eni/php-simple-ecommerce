<?php
   include_once __DIR__.'/../database/product.php';
?>

<div class="col sidebar bg-light mt-0 pb-0">
    <h3>Categories</h3>

    <ul class="list-unstyled">

        <?php
        
        try {
            $product = new Product();
            $categories = $product->getAllCategories();
        } catch(Exception $e) {
            echo 'Caught exception: '.$e->getMessage();
        }

        //list all categories
        if($categories && !empty($categories)) {
            foreach($categories as $key => $category) {

                echo '<li class="nav-item">';
                    echo '<a class="nav-link active red-font" href="listByCategory.php?category='
                    .$category["name"].'">'.$category['name'].'</a>';
                echo '</li>';

            }
        }

        ?>

    </ul>

</div>
