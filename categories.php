<?php
    $page_title = "Categories | NokPosters";
    include_once('header.php');
    include_once('includes/artist.class.php');
    include_once('includes/category.class.php');
    $category = new Category($db);
    $artist = new Artist($db);
    
    $categories = $category->getData();
    $artists = $artist->getData();
    array_multisort(array_column($categories, 'genre_name'), SORT_ASC, $categories);
?>

<!--BODY-->
<main>
    <nav aria-label="breadcrumb" class="ps-2 category-navbar">
        <ol class="breadcrumb py-2">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
    </nav>   
    <div class="container">
        <div>
            <div class="row mt-2">
                <h3>View by Genre</h3>
            </div>
            <div class="row">
                <!--Products-->
                <div class="row mx-auto mb-4">
                    <?php foreach ($categories as $item) : ?>
                    <div class="col-md-3 col-6 my-3">
                        <div class="card product-card h-100 font-rubik">
                            <div class="card-body text-center">
                                <h4 class="card-title product-name">
                                    <a class="stretched-link" href="category.php?id=<?=$item['genre_id']?>"><?=$item['genre_name']?></a>
                                </h4>
                                <hr>
                                <p class="card-text"><?=$item['genre_tagline']?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <h3>View by Artists</h3>
            </div>
            <div class="row">
                <form class="go_to_artist mb-3" action="artist.php" method="GET">
                    <select name="id" class="artist-select w-auto p-2 ms-4 me-3">
                        <option value="">--Choose an Artist--</option>
                        <?php foreach ($artists as $item) : ?>
                            <option value=<?=$item['artist_id']?>><?=$item['artist_name']?></option>
                        <?php endforeach ?>
                    </select>
                    <input type="submit" value="Go" id="go-to-artist-btn" class="btn btn-info btn-sm py-2 px-3" disabled></input>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
    include_once('footer.php');
?>