<?php
    include_once('header.php');
    include_once('includes/cart.class.php');
    $cart_details = $my_cart->getCartProducts();
    $subtotal = $my_cart->getTotalPrice($cart_details);
    $shipping = $my_cart->getShipping($subtotal);
?>
<!--BODY-->
<main>

    <div class="container">
        <div class="row mt-2">
        <?php if($cart_details) : ?>
            <div class="row">
                <div class="col-md-6 col-9">
                    <h3>Shopping Cart</h3>
                </div>
                <div class="col-md-2 col-3">
                    <input type="submit" id="clear-cart" value="Clear Cart" class="float-end btn btn-info clear-cart"></input>
                </div>
            </div>
            <hr>

            <div class="row" id="cart-container">
                <div class="col-md-8 col-12" id="cart-list">
                    <!-- List group -->
                    <ul class="list-group list-group-lg mb-6 list-group-flush">
                    <?php foreach($cart_details as $item) :
                        $item_quantity= $my_cart->getProductQuantity($item['product_id']);
                        if ($item['product_sale'] > 0) {
                            $item_price = $item['product_sale'];
                        } else {
                            $item_price = $item['product_price'];
                        } 
                    ?>

                    
                    <li class="list-group-item cart-product_<?=$item['product_id']?>">
                        <div class="row align-items-center">
                        <div class="col-3 col-md-2">
                            <!-- Image -->
                            <a href="#">
                                <img src="product_imgs/product_<?=$item['product_id']?>.jpg" alt="..." class="img-fluid">
                            </a>
                        </div>
                        <div class="col" data-price=<?=$item_price?>>
                            <!-- Title -->
                            <div class="d-flex mb-2 font-weight-bold">
                                <h4><a class="text-body" href="product.html"><?=$item['product_name']?></a></h4>
                                <br>
                                
                            </div>
                            <div class="price-info mb-2">
                                <?php if ($item['product_sale'] > 0): ?>
                                <span class="product-old-price">&pound;<?=$item['product_price']?></span>
                                <?php endif; ?>
                                <span class="product-price">&pound;<?=$item_price?></span>                                
                            </div>
                                <p class="mb-2 font-size-sm text-muted">
                                    Quantity:
                                    <select class="quantity-select w-auto" data-quantity=<?=$item_quantity?>>
                                        <?php for ($i = 1; $i <= 3; $i++) : ?>
                                            <?php if($i == $item_quantity): ?>
                                                <option selected value=<?=$i?>><?=$i?></option>
                                            <?php else: ?>
                                                <option value=<?=$i?>><?=$i?></option>
                                            <?php endif ?>
                                        <?php endfor ?>
                                    </select>
                                    <span class="quantity-updated alert-success" role="alert">Updated</span>
                                </p>
                                <div class="d-flex align-items-center">
                                    <form class="remove_from_cart" action="remove_from_cart.php" method="POST">
                                        <input type="hidden" id="product-id" name="product_id" value=<?=$item['product_id']?>>
                                        <input type="submit" id="cart-remove-item-submit" value="Remove" class="btn btn-info remove-from-cart mt-2"></input>
                                        <p class="cart-message-<?=$item['product_id']?>"></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </li>
                        <?php endforeach?>
                    </ul>

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
                            <span class="ml-auto font-size-sm" id="cart-total-price">&pound;<?=number_format($subtotal + $shipping, 2)?></span>
                        </li>
                        </ul>
                    </div>
                    </div>

                    <!-- Links -->
                    <a class="btn btn-dark ms-1 me-2 my-2" href="products.php">Continue Shopping</a>
                    <?php if(isset($_SESSION['loggedin'])): ?>
                        <a class="btn btn-primary mx-auto my-2" href="checkout.php">Proceed to Checkout</a>
                    <?php else: ?>
                        <a class="btn btn-primary mx-auto my-2" href="login.php">Login / Create Account</a>
                    <?php endif; ?>

                    
                </div>
           
            </div> 
        <?php else : ?>
            <div class="text-center empty-cart">You have no items in the cart</div>
            <div class="col text-center">
                <a href="products.php" class="my-2 btn btn-primary">View our product range</a>
            </div>
        <?php endif ?>
            


        </div>
    </div>
</main>   
<?php
    include_once('footer.php');
?>