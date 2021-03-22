<?php
    include_once('header.php');
    include_once('includes/product.class.php');
    $product = new Product($db);
    $recently_added = $product->getMostRecentData();
    $last_chance = $product->getLowQuantity();
    $featured_products = $product->getFeaturedProducts();
?>

    <!--BODY-->
    <main>
        <div>
            <div class="container">
                <div class="p-5 rounded-lg m-3 hero-section">
                    <h1 class="display-4 font-rubik">Welcome to NokPosters!</h1>
                    <p class="lead">Buy high quality prints inspired by films, and designed by independent artists</p>
                    <hr class="my-4">
                    <p>View our entire range, or choose from one of our categories:</p>
                    <a class="btn btn-primary btn-md mt-2" href="products.php" role="button">View Our Products</a>
                    <a class="btn btn-primary btn-md mt-2" href="categories.php" role="button">Categories</a>
                </div>
            </div>
            <div class="container font-rubik text-center mt-5" id="recentlyAdded">
                <h1>Recently Added Posters</h1>
                <hr>
                <!--Recently Added Products-->
                <div class="row mb-4">
                    <?php foreach ($recently_added as $item) : ?>
                    <div class="col-md-3 col-12 my-3">
                        <?=createProductCard($item);?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!--Recently Added Products-->
            </div>

            <div class="container font-rubik text-center" id="featuredCategories">
                <h1>Featured Prints</h1>
                <p>View our favourite prints</p>
                <hr>
                <div class="row mb-4">
                    <?php foreach ($featured_products as $item) : ?>
                    <div class="col-md-3 col-12 my-3">
                        <?=createProductCard($item);?> 
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="container font-rubik text-center" id="lastChance">
                <h1>Last Chance</h1>
                <p>Last Chance to order these limited prints</p>
                <hr>
                <div class="row mb-4">
                    <?php foreach ($last_chance as $item) : ?>
                    <div class="col-md-3 col-12 my-3">
                        <?=createProductCard($item);?> 
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

    </main>


<?php
    include_once('footer.php');
?>