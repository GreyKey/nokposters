<?php
    include_once ('functions.php');
    $cart_total = array_sum($_SESSION['np_cart']);
    if(!isset($page_title)) {
      $page_title = "NokPosters";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NokPosters</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Rubik&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="styles/style.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

  
</head>

<body>
    <!--HEADER-->
  <header id="header">
    <nav class="navbar navbar-expand-lg navbar-dark colour-primary-bg fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand font-rubik" href="index.php">NokPosters</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav m-auto">
            <li class="nav-item">
              <a class="nav-link ps-2 px-lg-3" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ps-2 px-lg-3" href="products.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ps-2 px-lg-3" href="categories.php">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ps-2 px-lg-3" href="about.php">About</a>
            </li>
          </ul>
          <hr class="d-block my-1 d-lg-none">
          <!--Right Aligned NavBar-->
          <ul class="navbar-nav navbar-right">

            <!--Customised NavBar based on login-->
            <?php if (isset($_SESSION['loggedin'])):

                // Add Admin Panel if administrator is logged in
                if ($_SESSION['id'] == 1) : ?>
                  <li class="nav-item">
                    <a href="admin.php" class="nav-link ps-2" id="admin">Admin</a>
                  </li>
                
                <?php else: ?>
                  <li class="nav-item dropdown">
                  <a class="nav-link ps-2 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Welcome, <?=$_SESSION['first_name']?>
                  </a>
                  <ul class="dropdown-menu colour-primary-bg account-dropdown" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="profile.php">Your Orders</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="login/logout.php">Sign Out</a></li>
                  </ul>
                </li>
                <?php endif ?>
            <?php else : ?>
                <li class="nav-item">
                <a class="nav-link ps-2 px-lg-3" aria-current="page" href="login.php">Login | Sign Up</a>
                </li>
            <?php endif;
            
            if(!isset($_SESSION['id']) || $_SESSION['id'] !== 1) :?>
            <li class="nav-item">
              <a href="cart.php" class="nav-link ps-2" id="cart_quantity">
                  <i class="bi bi-cart px-1"></i>
                  <span id="cart_total"><?=$cart_total?></span>
              </a>
            </li>
            <?php else : ?>
              <li class="nav-item">
                <a href="login/logout.php" class="nav-link ps-2" id="logout">
                  Log Out
                </a>
              </li>
            <?php endif ?>
          </ul>
        
        </div>
      </div>
      </nav>       
  </header>