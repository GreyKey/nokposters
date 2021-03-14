<?php
require_once('functions.php');

if (isset($_POST['submit'])) {
    if (isset($_SESSION['np_cart']) && is_array($_SESSION['np_cart'])) {
        unset($_SESSION['np_cart']);
        echo "Your cart is empty";
    }
}
?>