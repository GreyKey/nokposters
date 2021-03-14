<?php
    include_once('header.php');
    include_once('includes/category.class.php');
    include_once('includes/product.class.php');
    $product = new Product($db);
    $category = new Category($db);
    
    $this_id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 1;

    $genre_name = $category->getGenreName($this_id);
    $num_pages = $category->getTotalPages($this_id);
    $total_products = $category->getTotalProductsCount($this_id);

    $current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($current_page > $num_pages) { $current_page = $num_pages; }

    $offset = ($current_page - 1) * 12;
    $page_products = $category->getProductsForPage($offset, $this_id);
    $i_product = $offset + 1;
    $j_product = ($current_page < $num_pages ? $offset + 12 : $total_products);
    $product_range_blurb = sprintf("Showing %d-%d of %d products", $i_product, $j_product, $total_products);
?>

    <!--BODY-->
    <main>
        <nav aria-label="breadcrumb" class="ps-2 category-navbar">
            <ol class="breadcrumb py-2">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="categories.php">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?=$genre_name?></li>
            </ol>
        </nav>   
     <div class="container">
        <div>
            <div class="row mt-2">
                <p><?=$product_range_blurb?></p>
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
        <?php if ($num_pages > 1) : ?>
        <div class="row">
            <nav>
                <ul class="pagination justify-content-center">
                <?php if($current_page == 1): ?>
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <?php else: ?>
                    <li class="page-item"><a class="page-link" href="category.php?id=<?=$this_id?>&page=<?=$current_page - 1;?>">Previous</a></li>
                <?php endif ?>
                    
                <?php for($i = 1; $i <= $num_pages; $i++) : ?>
                    <li class="page-item<?php if($current_page == $i) echo ' active';?>">
                        <a class="page-link" href="category.php?id=<?=$this_id?>&page=<?=$i;?>">
                            <?php echo $i;?>
                        </a>
                    </li>
                <?php endfor ?>

                <?php if($current_page == $num_pages): ?>
                    <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                <?php else: ?>
                    <li class="page-item"><a class="page-link" href="category.php?id=<?=$this_id?>&page=<?=$current_page + 1;?>">Next</a></li>
                <?php endif ?>
                </ul>
            </nav>
        </div>
        <?php endif ?>
        





    </div>
    </main>

<?php
    include_once('footer.php');
?>