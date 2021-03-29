<?php
require_once('functions.php');

$data = array(1, 0);

if (isset($_POST['submit'])) {
    $product_id = (int)$_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['np_cart']) && is_array($_SESSION['np_cart'])) {
        if (array_key_exists($product_id, $_SESSION['np_cart'])) {
            // Product exists in cart, only add if new quantity is less than four
            if ($_SESSION['np_cart'][$product_id] + $quantity < 4) {
                $_SESSION['np_cart'][$product_id] += $quantity;
            }
            else {
                $data[0] = 0;
            }          
        } 
        else {
            // Product is not in cart so add it
            $_SESSION['np_cart'][$product_id] = $quantity;
        }
    }    
    else {
        // There are no products in cart, this will add the first product to cart
        $_SESSION['np_cart'] = array($product_id => $quantity);
    }
    //Return new cart total
    $data[1] = array_sum($_SESSION['np_cart']);
    $data[2] = $_SESSION['np_cart'][$product_id] == 3 ? 1 : 0;
    echo json_encode($data);
}
?>