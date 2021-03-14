<?php

class Product
{
    public $db = null;

    public function __construct(Dbh $db)
    {
        if (!isset($db->conn)) return null;
        $this->db = $db;
    }

    // fetch product data using getData Method
    public function getData($table = 'product'){
        $result = $this->db->conn->query("SELECT * FROM {$table}");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }



    // fetch product data using getData Method
    public function getDataByDateAdded($table = 'product'){
        $result = $this->db->conn->query("SELECT * FROM {$table} ORDER BY date_added DESC LIMIT 12");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }
    



    // Return A Selection of Products Low in Stock
    public function getLowQuantity($table = 'product'){
        $result = $this->db->conn->query("SELECT * FROM {$table} WHERE product_quantity <= 20 AND product_quantity > 0 ");
        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }
        shuffle($resultArray);

        return array_slice($resultArray, 0, 4);
    }

    // Return Featured Products
    public function getFeaturedProducts($table = 'product'){
        $result = $this->db->conn->query("SELECT * FROM {$table} WHERE featured = 1");
        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }
        shuffle($resultArray);

        return array_slice($resultArray, 0, 4);
    }

    // Get Most Recent Data
    public function getMostRecentData($table = 'product'){
        $result = $this->db->conn->query("SELECT * FROM {$table} ORDER BY date_added DESC LIMIT 4");
        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    // PRODUCT PAGE FUNCTIONS
    public function getTotalPages(){
        $resultArray = $this->getData();

        return ceil(count($resultArray) / 12);
    }

    public function getTotalProducts(){
        $resultArray = $this->getData();

        return count($resultArray);
    }

    // Return Multiple Products for Page
    public function getProductsForPage($offset){
        $result = $this->db->conn->query("SELECT * FROM product ORDER BY date_added DESC LIMIT {$offset}, 12");
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


    public function getRecommendedProducts($id = null, $table = 'product') {
        if (isset($id)) {
            $result = $this->db->conn->query("SELECT * FROM {$table} WHERE product_id <> {$id} AND product_quantity > 0 ");
            $resultArray = array();
    
            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }
            shuffle($resultArray);
    
            return array_slice($resultArray, 0, 4);
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




}
?>