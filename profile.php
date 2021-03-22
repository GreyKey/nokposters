<?php
    include_once('header.php');
    include_once('includes/user.class.php');
    $user = new User($db);
    $uid = $_SESSION['id'];


    $orders = $user->getUserOrders($uid);
    $open_orders = $user->getOpenOrders($orders);
?>

    <!--BODY-->
    <main>
        
    <div class="container">
        <div class="row my-4 justify-content-center">
            <h3>Your Orders</h3>
            <div class="col-11 mt-2">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" 
                        type="button" role="tab" aria-controls="home" aria-selected="true">All Orders</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="open-orders-tab" data-bs-toggle="tab" data-bs-target="#open-orders"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">Open Orders</button>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    <?php if(!$orders) : ?>
                        <div class="no-orders">You have no order history</div>
                    <?php endif;
                    foreach($orders as $order) : 
                        $products = $order['products']; ?>
                        <div class="card my-2">
                            <div class="card-header container">
                                <div class="row">
                                    <div class="col-12">Order Placed: <?=date_format($order['date_created'], 'd M Y')?></div>
                                    <div class="col-4">Total: &pound;<?=number_format($order['order_total'], 2)?></div>
                                    <?php if( $order['status_id'] !== 3) :?>
                                    <div class="col-8 text-end">Status: <?=$order['status_code']?></div>
                                    <?php endif ?>
                                </div>                                   
                            </div>
                            <div class="card-body">
                            <?php foreach($products as $product) : ?>
                                <div class="container">
                                    <div class="row mb-2 g-0">
                                        <div class="col">
                                            <img src="product_imgs/product_<?=$product['p_id']?>.jpg" alt="..." class="w-100 img-fluid">
                                        </div>
                                        <div class="ms-2 col-10">
                                            <h5><?=$product['p_name']?></h5>
                                            <p class="mb-2 font-size-sm text-muted">
                                                Quantity: <?=$product['quantity']?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </div>



                    <div class="tab-pane" id="open-orders" role="tabpanel" aria-labelledby="open-orders-tab">
                    <?php if(!$open_orders) : ?>
                        <div class="no-orders">You have no orders open</div>
                    <?php endif; foreach($open_orders as $order) : 
                        $products = $order['products']; ?>
                        <div class="card my-2">
                            <div class="card-header container">
                                <div class="row">
                                    <div class="col-12">Order Placed: <?=date_format($order['date_created'], 'd M Y')?></div>
                                    <div class="col-4">Total: &pound;<?=number_format($order['order_total'], 2)?></div>
                                    <?php if( $order['status_id'] !== 3) :?>
                                    <div class="col-8 text-end">Status: <?=$order['status_code']?></div>
                                    <?php endif ?>
                                </div>                                   
                            </div>
                            <div class="card-body">
                            <?php foreach($products as $product) : ?>
                                <div class="container">
                                    <div class="row mb-2 g-0">
                                        <div class="col">
                                            <img src="product_imgs/product_<?=$product['p_id']?>.jpg" alt="..." class="w-100 img-fluid">
                                        </div>
                                        <div class="ms-2 col-10">
                                            <h5><?=$product['p_name']?></h5>
                                            <p class="mb-2 font-size-sm text-muted">
                                                Quantity: <?=$product['quantity']?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </div>
                </div>


            </div>
        </div>

    </div>
    </main>

<?php
    include_once('footer.php');
?>