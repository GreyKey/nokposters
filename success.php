<?php
session_start(); 

require_once ('includes/dbh.php');
require_once ('includes/success.class.php');
$db = new DBh();
$obj = new Success($db);

// Insert data to order and order_details, and update product quantities
$new_id = $obj->insertOrder();
$obj->insertOrderDetails($new_id);
$obj->updateProductQuantities();

// Clear session cart array
if (isset($_SESSION['np_cart']) && is_array($_SESSION['np_cart'])) {
    unset($_SESSION['np_cart']);
}
//END OF PHP
include_once('header.php');
?>

<!--BODY-->
<main> 
<div class="container">
    <div class="row justify-content-center">
        <div class="p-5 m-3 alert-success purchase-complete">
            <h3 class="display-5">Purchase Complete!</h3>
            <p class="lead">Check your e-mail for order confirmation</p>
            <hr class="my-2">
            <p>Forgot something? Continue browsing...</p>
            <a class="btn btn-primary btn-md" href="index.php" role="button">Home</a>
            <a class="btn btn-primary btn-md" href="products.php" role="button">Posters</a>
        </div>
    </div>
</div>
</main>

<?php
    include_once('footer.php');
?>