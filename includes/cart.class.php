<?php

class Cart {


    public $cart = array();
    public $db = null;

    public function __construct(Dbh $db){ 

        // get the shopping cart array from the session 
        $this->cart = !empty($_SESSION['np_cart']) ? $_SESSION['np_cart']: array(); 

        if (!isset($db->conn)) return null;
        $this->db = $db;

        // if ($this->cart === NULL){ 
        //     // set some base values 
        //     $this->cart = array('cart_total' => 0, 'total_items' => 0); 
        // } 
    } 

    public function getIDsFromCart() {
        $ids = array();
        foreach($_SESSION['np_cart'] as $id=>$value){
            array_push($ids, $id);
        }
        return $ids;
    }


    public function getProductQuantity($id) {
        if (array_key_exists($id, $_SESSION['np_cart'])) {
            // Product exists in cart
            return $_SESSION['np_cart'][$id];       
        } 
        else {
            // Product is not in cart, qty = 0
            return 0;
        }
    }

    public function getCartProducts($table = 'product'){

        $ids = $this->getIDsFromCart();
        if($ids) {
            $i_array = implode(", ", $ids);
            $query = "SELECT * FROM {$table} WHERE product_id IN ($i_array)";
            // print_r($query);
            // exit();
            $stmt = $this->db->conn->prepare($query);
            // return $stmt;
            $stmt->execute();
            $result = $stmt->get_result();

            $resultArray = array();

                // fetch product data one by one
                while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $resultArray[] = $item;
                }

            return $resultArray;
        }
        else {
            return array();
        }
    }

    public function getTotalPrice($cart_details){

        $subtotal = 0.00;

        foreach ($cart_details as $product) {
            
            if (empty($product['product_sale'])) {
                $price = $product['product_price'];
            }
            else {
                $price = $product['product_sale'];
            }
            $subtotal += (float)$price * (int)$this->cart[$product['product_id']];
        }

        return $subtotal;
    }

    public function getShipping($total){

        if ($total >= 50) {
            return 0.00;
        }
        else {
            return 8.00;
        }
    }
}
?>