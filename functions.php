<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!(isset($_SESSION['np_cart']))) {
    $_SESSION['np_cart'] = array();
}

    // Establish MySQL connection
    require_once ('includes/dbh.php');
    require_once ('includes/cart.class.php');

    $db = new DBh();
    $my_cart = new Cart($db);

    function createProductCard($item) {
    // PRODUCT CARD TEMPLATE
    ob_start(); ?>
    <div class="card product-card h-100">
        <a href="product.php?id=<?=$item['product_id']?>">
            <img src="product_imgs/small2/product_<?=$item['product_id']?>.jpg" class="card-img-top p-1" alt="Poster for <?=$item['product_name']?>">
        </a>
        <div class="card-body product-content text-center">
            <h4 class="card-title product-name"><a href="product.php?id=<?=$item['product_id']?>"><?=$item['product_name']?></a></h4>

            <?php if ($item['product_quantity'] == 0): ?>
                <div class="sold-out mb-2"><strong>SOLD OUT</strong></div>
            <?php else: ?>
                <div class="price-info mb-2">
                    <?php if ($item['product_sale'] > 0): ?>
                    <span class="product-old-price">&pound;<?=$item['product_price']?></span>
                    <span class="product-price">&pound;<?=$item['product_sale']?></span>
                    <?php else: ?>
                    <span class="product-price">&pound;<?=$item['product_price']?></span>
                    <?php endif; ?>
                </div>
                <a class="btn btn-primary view-details" href="product.php?id=<?=$item['product_id']?>">View Details</a>
            <?php endif;?>
        </div>
        <!--Add Last Chance Badge-->
        <?php if($item['product_quantity'] <= 20 && $item['product_quantity'] > 0): ?>
            <div class="last-chance-badge">LAST CHANCE</div>
        <?php endif; ?>
    </div>
<?php return ob_get_clean();
}