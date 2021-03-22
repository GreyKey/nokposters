<?php
    include_once('header.php');
    include_once('includes/product.class.php');
    include_once('includes/admin.class.php');

    if (isset($_SESSION['id']) && $_SESSION['id']!== 1) {
        echo '<main><div class="small-content mt-5">You are currently logged in with a customer account.</div></main>';
        include_once('footer.php');
        exit();
    }

    if(!isset($_SESSION['id'])) {
        include_once('login-admin.php');
        include_once('footer.php');
        exit();
    }

    $product = new Product($db);
    $admin = new Admin($db);
    $open_orders = $admin->getAllOpenOrders();
    $products = $admin->getProductData();
    $status = $admin->getStatusCodes();
    // print_r($open_orders);
?>
<!--BODY-->
<main>
    

<div class="container">
    <div class="row my-4 justify-content-center">
        <h3>Welcome Admin.</h3>
        <hr>
        <div class="col-11 mt-2">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="admin-open-orders-tab" data-bs-toggle="tab" data-bs-target="#admin-open-orders" 
                    type="button" role="tab" aria-controls="home" aria-selected="true">Manage Open Orders</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="admin-products-tab" data-bs-toggle="tab" data-bs-target="#admin-products"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">Manage Products</button>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="admin-open-orders" role="tabpanel" aria-labelledby="admin-open-orders-tab">
                <?php if(!$open_orders) : ?>
                    <div class="no-orders">No open orders</div>
                <?php else: ?>
                <table class="table table-hover table-sm align-middle">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Order Placed</th>
                        <th scope="col">Total</th>
                        <th scope="col">Products (Qty)</th>
                        <th scope="col">Status</th>
                        <th scope="col">Update</th>
                        <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($open_orders as $order) : 
                        $order_products = $order['products'];?>
                        <tr>
                        <th scope="row"><?=$order['order_id']?></th>
                        <td><?=$order['customer']?></td>
                        <td><?=date_format($order['date_created'], 'd M Y')?></td>
                        <td>&pound;<?=number_format($order['order_total'], 2)?></td>
                        <td>
                        <?php foreach($order_products as $o_product) : ?>
                            <p class="m-0 p-0"style="font-size: 14px;"><?=$o_product['p_name']?> (<?=$o_product['quantity']?>)</p>
                            <?php endforeach ?>
                        </td>
                        <td class="current_status"><?=$order['status_code']?></td>
                        <td>
                            <select class="status-select w-auto" data-status=<?=$order['status_id']?>>
                                <?php foreach ($status as $row) : ?>
                                    <?php if($row['status_id'] == $order['status_id']): ?>
                                        <option selected value=<?=$row['status_id']?>><?=$row['status_code']?></option>
                                    <?php else: ?>
                                        <option value=<?=$row['status_id']?>><?=$row['status_code']?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                    
                        </td>
                        <td>
                            <form class="update_order_status" action="update_order.php" method="POST">
                                <input type="hidden" id="order-id" name="order" value=<?=$order['order_id']?>>
                                <input type="submit" value="Update" class="btn btn-info btn-sm update-order-btn" disabled></input>
                            </form></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>

                <?php endif ?>   
                </div>



                <div class="tab-pane" id="admin-products" role="tabpanel" aria-labelledby="admin-products-tab">
                <table class="table table-hover table-sm align-middle text-center">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Current Quantity</th>
                        <th scope="col">RRP / £</th>
                        <th scope="col">Sale Price / £</th>
                        <th scope="col">Featured</th>
                        <th scope="col">Update</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($products as $product) : ?>
                        <?php if ($product['product_quantity'] == 0) : ?>
                            <tr class='row-out-of-stock'>
                        <?php elseif ($product['product_quantity'] <= 10) : ?>
                            <tr class='row-low-stock'>
                        <?php else: ?>
                            <tr>
                        <?php endif ?>
                        <th scope="row"><?=$product['product_id']?></th>
                        <td class="text-start product-title-col"><?=$product['product_name']?></td>
                        <td><?=$product['product_quantity']?></td>
                        <td class="rrp"><?=$product['product_price']?></td>
                        <td class="col-sale-price">
                            <div class="input-group input-group-sm">
                            <span class="input-group-text sale-price"><?=$product['product_sale']?></span>
                            <input type="number" step="0.01" min="0.00" max=<?=$product['product_price']?> class="form-control new-sale-price" aria-label="New Sale Price">
                            </div>
                        </td>
                        <td>
                            
                                <input class="form-check-input featured-checkbox" type="checkbox" id="" value="" 
                                aria-label="is featured" data-featured=<?=$product['featured']?>
                                <?php if ($product['featured']) :?>
                                    checked
                                <?php endif;
                                if ($product['product_quantity'] == 0) :?>
                                    disabled
                                <?php endif; ?>
                                >
                            
                        </td>        
                        <td>
                            <form class="update_product" action="update_product.php" method="POST">
                                <input type="hidden" id="product-id" name="product" value=<?=$product['product_id']?>>
                                <input type="submit" value="Update" class="btn btn-info btn-sm update-product-btn" disabled></input>
                            </form></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
                </div>
            </div>


        </div>
    </div>

</div>


</main>
<?php
    include_once('footer.php');
?>