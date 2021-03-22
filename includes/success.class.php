<?php

class Success {

    public $db = null;
    public $new_order_id = null;

    public function __construct(Dbh $db){ 

        if (!isset($db->conn)) return null;
        $this->db = $db;
    } 

    public function insertOrder() {
        $user_id = $_SESSION['id'];
        // Insert new row to orders table
        $sql = "INSERT INTO orders (user_id, order_status_id) VALUES (?, 1)";
        
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $new_order_id = $stmt->insert_id;

        return $new_order_id;
    }

    public function insertOrderDetails($new_order_id) {
        foreach ($_SESSION['np_cart'] as $p_id => $qty) {
            $sql = "INSERT INTO order_details (order_id, product_id, quantity, product_price, total_cost) VALUES (?, ?, ?, ?, ?)";
            $price = $this->getProductPrice($p_id);
            $total = $price * $qty;
            
            $ostmt = $this->db->conn->prepare($sql);
            $ostmt->bind_param("iiidd", $new_order_id, $p_id, $qty, $price, $total);
            // $ostmt->execute();
            if(!$ostmt->execute()) echo $ostmt->error;
        }
        $ostmt->close();
    }

    public function updateProductQuantities() {
        foreach($_SESSION['np_cart'] as $id=>$value){
            $sql = "UPDATE product SET product_quantity = product_quantity - ?  WHERE product_id = ?;";
            $pstmt  = $this->db->conn->prepare($sql);
            $pstmt->bind_param("ii", $value, $id);
            $pstmt->execute();
        }
        $pstmt->close();
    }

    public function getProductPrice($id = null) {
        if (isset($id) && $id != 0){
            $stmt = $this->db->conn->prepare("SELECT * FROM product WHERE product_id = ? LIMIT 1");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $row = $stmt->get_result()->fetch_assoc();

            if (is_null($row['product_sale'])) {
                return $row['product_price'];
            }
            else {
                return $row['product_sale'];
            }
        }
    }

}
?>