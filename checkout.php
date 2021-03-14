<?php
    include_once('header.php');
    include_once('includes/cart.class.php');
    $cart_details = $my_cart->getCartProducts();
    $subtotal = $my_cart->getTotalPrice($cart_details);
    $shipping = $my_cart->getShipping($subtotal);
    $total = $subtotal + $shipping;
?>

<!--BODY-->
<main>
<div class="container">
    <div class="row">
        <h2 class="text-center pt-4">Time to Checkout</h2>
        <hr>
        <div class="row" id="checkout-container">
                <div class="col-md-6 col-12" id="cart-list">
                <table class="table table-hover table-sm align-middle text-center">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col text-start">Product</th>
                        <th scope="col">Sale Price / £</th>
                        <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($cart_details as $item) :
                        $item_quantity= $my_cart->getProductQuantity($item['product_id']);
                        if ($item['product_sale'] > 0) {
                            $item_price = $item['product_sale'];
                        } else {
                            $item_price = $item['product_price'];
                        } 
                    ?>
                    <tr>
                    <th scope="row"><?=$item['product_id']?></th>
                    <td class="text-start"><?=$item['product_name']?></td>
                    <td><?=$item_price?></td>
                    <td><?=$item_quantity?></td>

                    </tr>
                        <?php endforeach?>
                    </tbody>
                </table>

                </div>
                <div class="col-md-4 col-12">
                    <!-- Total -->
                    <div class="card mb-7 bg-light">
                    <div class="card-body cost-div">
                        <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                        <li class="list-group-item d-flex">
                            <span class="me-2">Subtotal: </span>
                            <span class="font-size-sm" id="cart-subtotal">&pound;<?=number_format($subtotal, 2)?></span>
                        </li>
                        <li class="list-group-item d-flex">
                            <span class="me-2">Shipping: </span>
                            <span class="ml-auto font-size-sm" id="cart-shipping">&pound;<?=number_format($shipping, 2)?></span>
                        </li>
                        <li class="list-group-item d-flex font-size-lg fw-bold">
                            <span class="me-2">Total: </span>
                            <span class="ml-auto font-size-sm" id="cart-total-price" data-total=<?=$total?>>&pound;<?=number_format($subtotal + $shipping, 2)?></span>
                        </li>
                        </ul>
                    </div>
                    </div>

                    <!-- Links -->
                    <div class="container row justify-content-center">
                        <div id="paypal-checkout" class="col-8 m-2"></div>
                        <?php include_once('includes/paypal_script.html'); ?>
                    </div>                 
                </div>
    </div>
</div>
</main>


<?php
    include_once('footer.php');
?>