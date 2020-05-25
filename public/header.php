    <nav class="navbar navbar-expand navbar-dark bg-dark">

            <ul class="navbar-nav  pl-0 ml-0 float-left">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Join Us
                    </a>
                    <!--in drop down Join Us-->
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        
                        <?php

                            //show log out if somenone is logged in
                            if(isset($_SESSION['userUsername']) || isset($_SESSION['administratorUsername'])) {
                                echo '<a class="dropdown-item" href="../includes/logout.inc.php">Log out</a>';
                            } else {
                                echo '<a class="dropdown-item" href="loginuser.php">Log in as User</a>';
                                echo '<a class="dropdown-item" href="loginadministrator.php">Log in as Administrator</a>';
                                echo '<div class="dropdown-divider"></div>';
                                echo '<a class="dropdown-item" href="signup.php">Sign Up</a>';
                            }

                        ?>

                    </div>
                </li>
            </ul>
            <!--search form that I'd like to implement later
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> -->

            <ul class="navbar-nav pl-0 ml-0 float-left">
                
                <a class="navbar-brand" href="#">
                    <img src="../images/1200px-Heart_corazón.svg.webp" width="30" height="30" class="d-inline-block align-top" alt="">
                </a>

            </ul>

            <ul class="navbar-nav pl-0 ml-0 float-left">
                
                <a class="navbar-brand" href="#">
                    <img src="../images/Ecommerce_RTE-03-512.png" width="30" height="30" class="d-inline-block align-top" alt="">
                </a>

            </ul>

            <ul class="navbar-nav pl-0 ml-0 float-left">
                
                    <?php

                        //show the username of the person who is logged in (and manage button for admins)
                        if(isset($_SESSION['userUsername'])) {
                            $userUsername = $_SESSION['userUsername'];
                            echo '<li class="nav-item active white-font">'.$userUsername.'</li>';
                        } else if(isset($_SESSION['administratorUsername'])) {
                            $administratorUsername = $_SESSION['administratorUsername'];
                            echo '<li class="nav-item active btn btn-success"><a href="adminManageArticles.php">Manage</a></li>';
                            echo '<li class="nav-item active white-font my-auto mx-1">'.$administratorUsername.'</li>';
                        } else {
                            echo '<li class="nav-item active white-font"></li>';
                        }

                    ?>
                
            </ul>  

    </nav>

    <div class="jumbotron jumbotron-fluid jumbotron-header mb-0">
        <div class="container">
            <h2 class="display-4 text-center">Nowena Shop</h2>
        </div>
    </div>
