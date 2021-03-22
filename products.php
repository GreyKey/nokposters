<?php
    include_once('header.php');
    include_once('includes/product.class.php');
    $product = new Product($db);

    $num_pages = $product->getTotalPages();
    $total_products = $product->getTotalProducts();

    $current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

    if ($current_page > $num_pages) { $current_page = $num_pages; }
    if ($current_page < 1) { $current_page = 1; }

    $offset = ($current_page - 1) * 12;
    $page_products = $product->getProductsForPage($offset);
    $i_product = $offset + 1;
    $j_product = ($current_page < $num_pages ? $offset + 12 : $total_products);
    $product_range_blurb = sprintf("Showing %d-%d of %d products", $i_product, $j_product, $total_products);
?>

    <!--BODY-->
    <main>
        
     <div class="container">
        <div>
            <div class="row mt-2">
                <h2 class="text-center">View Products</h2>
                <hr>
                <p><?php echo $product_range_blurb?></p>
            </div>
            

            <div class="row">
                <!--Products-->
                <div class="row mx-auto mb-4">
                    <?php foreach ($page_products as $item) : ?>
                    <div class="col-md-3 col-sm-6 col-12 my-3">
                        <?=createProductCard($item);?> 
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

        <!-- Pagination -->
        <div class="row">
            <nav>
                <ul class="pagination justify-content-center">
                <?php if($current_page == 1): ?>
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <?php else: ?>
                    <li class="page-item"><a class="page-link" href="products.php?page=<?php echo $current_page - 1;?>">Previous</a></li>
                <?php endif ?>
                    
                <?php for($i = 1; $i <= $num_pages; $i++) : ?>
                    <li class="page-item<?php if($current_page == $i) echo ' active';?>">
                        <a class="page-link" href="products.php?page=<?php echo $i;?>">
                            <?php echo $i;?>
                        </a>
                    </li>
                <?php endfor ?>

                <?php if($current_page == $num_pages): ?>
                    <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                <?php else: ?>
                    <li class="page-item"><a class="page-link" href="products.php?page=<?php echo $current_page + 1;?>">Next</a></li>
                <?php endif ?>
                </ul>
            </nav>
        </div>
        





    </div>
    </main>

<?php
    include_once('footer.php');
?>