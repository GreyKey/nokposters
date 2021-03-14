<?php
require_once('functions.php');

$data = array(1,2);

if (isset($_POST['submit'])) {
    $product_id = (int)$_POST['product_id'];

    if (isset($_SESSION['np_cart']) && is_array($_SESSION['np_cart'])) {
        if (array_key_exists($product_id, $_SESSION['np_cart'])) {
            
            //Update product quantity
            $_SESSION['np_cart'][$product_id] += $_POST['diff'];
            //Get new subtotal
            $subtotal = filter_var($_POST['subtotal'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $price_change = $_POST['diff'] * (float)$_POST['product_subtotal'];
            $subtotal += $price_change;
            if ($subtotal < 50) {
                 $shipping = "£8.00";
                 $total = "£".number_format($subtotal + 8, 2);
            } else {
                $shipping = "£0.00";
                $total = "£".number_format($subtotal, 2);
            }
            $new_subtotal = "£".number_format($subtotal, 2);

            $data[0] = array_sum($_SESSION['np_cart']);
            $data[1] = array($new_subtotal, $shipping, $total);
            echo json_encode($data);
        }          
    } 


}
?>