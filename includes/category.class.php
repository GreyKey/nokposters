<?php

class Category
{
    public $db = null;

    public function __construct(Dbh $db)
    {
        if (!isset($db->conn)) return null;
        $this->db = $db;
    }

    // fetch product data using getData Method
    public function getData($table = 'genres'){
        $result = $this->db->conn->query("SELECT * FROM {$table}");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    public function getCategoryData($id){
        $result = $this->db->conn->query("SELECT * FROM product_genres WHERE product_genres.genre_id = ($id)");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }


    public function getGenreName($id) {
        if (isset($id) && $id != 0){
            $stmt = $this->db->conn->prepare("SELECT * FROM genres WHERE genre_id = ? LIMIT 1");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row['genre_name'];
        }

        else {
            return "Unknown";
        }
    }

    


    // CATEGORY PAGE FUNCTIONS
    public function getTotalPages($id){
        $resultArray = $this->getCategoryData($id);

        return ceil(count($resultArray) / 12);
    }

    public function getTotalProductsCount($id){
        
        $resultArray = $this->getCategoryData($id);

        return count($resultArray);
    }

    // Return Multiple Products for Page
    public function getProductsForPage($offset, $id){
        $query = "SELECT * FROM product INNER JOIN product_genres ON product_genres.product_id=product.product_id 
                    WHERE product_genres.genre_id ={$id} ORDER BY date_added DESC LIMIT {$offset}, 12";
        $result = $this->db->conn->query($query);
        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

      
        return $resultArray;
    }



    // get product using item id
    public function getProduct($id = null, $table= 'product'){
        if (isset($id)){
            $result = $this->db->conn->query("SELECT * FROM {$table} WHERE product_id={$id}");

            $resultArray = array();

            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }

            return $resultArray[0];
        }
    }


    // Get Artist Name using product id
    public function getArtist($id = null) {
        if (isset($id) && $id != 0){
            $stmt = $this->db->conn->prepare("SELECT * FROM artist WHERE artist_id = ? LIMIT 1");
            $stmt->bind_param("i", $id);

            // set parameters and execute
            $stmt->execute();

            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row['artist_name'];
        }

        else {
            return "Unknown";
        }
    }

    public function getProductGenres($id) {
        $q = "SELECT * FROM genres INNER JOIN product_genres ON 
        product_genres.genre_id=genres.genre_id WHERE product_genres.product_id = $id ORDER BY 2 ASC";
        $result = $this->db->conn->query($q);

        $resultArray = array();
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    public function getCategories($id) {
        $q = "SELECT * FROM genres INNER JOIN product_genres ON 
        product_genres.genre_id=genres.genre_id WHERE product_genres.product_id = $id ORDER BY 2 ASC";
        $result = $this->db->conn->query($q);

        $resultArray = array();
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }

}
?>