<?php
require_once('functions.php');

$data = array("", "");

if (isset($_POST['submit'])) {
    $product_id = (int)$_POST['product_id'];

    if (isset($_SESSION['np_cart']) && is_array($_SESSION['np_cart'])) {
        if (array_key_exists($product_id, $_SESSION['np_cart'])) {
            unset($_SESSION['np_cart'][$product_id]);
            $data[0] = "Product has been removed from cart...";
            //Get new subtotal
            $subtotal = filter_var($_POST['subtotal'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $diff = (int)$_POST['qty'] * (float)$_POST['product_subtotal'];
            $subtotal -= $diff;
            if ($subtotal < 50 && $subtotal > 0) {
                 $shipping = "£8.00";
                 $total = "£".number_format($subtotal + 8, 2);
            } else {
                $shipping = "£0.00";
                $total = "£".number_format($subtotal, 2);
            }
            $new_subtotal = "£".number_format($subtotal, 2);
            $data[1] = array($new_subtotal, $shipping, $total);
            $data[2] = array_sum($_SESSION['np_cart']);

            echo json_encode($data);
        }          
    } 
}
?>