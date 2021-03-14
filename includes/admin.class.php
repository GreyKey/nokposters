<?php

class Admin
{
    public $db = null;

    public function __construct(Dbh $db)
    {
        if (!isset($db->conn)) return null;
        $this->db = $db;
    }

    // Get Open Orders
    public function getAllOpenOrders() {
        $sql = "SELECT order_details.*, product.product_name, orders.date_created, order_status.status_id, 
        order_status.status_code, user.first_name, user.last_name
        FROM order_details INNER JOIN product ON order_details.product_id = product.product_id 
        INNER JOIN orders ON order_details.order_id= orders.order_id 
        INNER JOIN order_status on order_status.status_id = orders.order_status_id 
        INNER JOIN user on orders.user_id = user.user_id 
        WHERE order_status.status_id <> 3
        ORDER BY orders.date_created ASC;";

        $resultArray = $this->getOrderData($sql);


        return $resultArray;
    }

    public function getStatusCodes() {
        $sql = "SELECT * FROM order_status ORDER BY status_id ASC";
        $result = $this->db->conn->query($sql);

        $resultArray = array();
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }
        return $resultArray;
    }


    protected function getOrderData($sql) {
        $resultArray = array();
        $stmt = $this->db->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        // $resultArray = $stmt->fetchAll();
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){

            // Check if order_id in array
            if (!array_key_exists($item['order_id'], $resultArray)) {
                $x = $item['order_id'];
                // New order, add common information  
                $resultArray[$x] = array();
                $resultArray[$x]['order_id'] = $x;
                $resultArray[$x]['customer'] = sprintf("%s %s", $item['first_name'], $item['last_name']);
                $resultArray[$x]['date_created'] = date_create($item['date_created']);
                $resultArray[$x]['status_code'] = $item['status_code'];
                $resultArray[$x]['status_id'] = $item['status_id'];
                $resultArray[$x]['products'] = array();
                $resultArray[$x]['order_total'] = 0.00;

                // $result = sprintf("%s %s", $data1, $data2)
            }

            // Add product details to subarray
            $y = $item['product_id'];

            $resultArray[$x]['products'][$y] = array();
            $resultArray[$x]['products'][$y]['p_id'] = $item['product_id'];
            $resultArray[$x]['products'][$y]['p_name'] = $item['product_name'];
            $resultArray[$x]['products'][$y]['quantity'] = $item['quantity'];
            $resultArray[$x]['products'][$y]['price'] = $item['product_price'];
            $resultArray[$x]['products'][$y]['subtotal'] = $item['total_cost'];
            
            //Calculate order total
            $resultArray[$x]['order_total'] += $item['total_cost'];
        }
        $stmt->close();

        return $resultArray;
    }



    public function updateOrder($status_id, $order_id) {
        $sql = "UPDATE orders SET order_status_id = ? WHERE orders.order_id = ?;";
        
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("ii", $status_id, $order_id);
        $stmt->execute();

        // set parameters and execute
        $affected_rows = $stmt->affected_rows;
        $stmt->close();

        if ($affected_rows > 0) {
            $resultArray = array(1, $affected_rows);
        }
        else {
            $resultArray = array(0, $affected_rows);
        }
        return $resultArray;
    }



    public function getProductData(){
        $result = $this->db->conn->query("SELECT * FROM product ORDER BY product_id ASC;");
        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }
        return $resultArray;
    }

    public function updateProduct($product_id, $featured, $sale_price) {
        
        if ($sale_price === "") {
            $sql = "UPDATE product SET featured = ? WHERE product.product_id = ?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bind_param("ii", $featured, $product_id);
        }
        else {
            if ($sale_price === "0") {
                $sql = "UPDATE product SET product_sale = NULL, featured = ? WHERE product.product_id = ?";
                $stmt = $this->db->conn->prepare($sql);
                $stmt->bind_param("ii", $featured, $product_id);
            }
            else {
                $sale_price = number_format($sale_price, 2);
                $sql = "UPDATE product SET product_sale = ?, featured = ? WHERE product.product_id = ?";
                $stmt = $this->db->conn->prepare($sql);
                $stmt->bind_param("dii", $sale_price, $featured, $product_id);
            }
        }
        
        $stmt->execute();
        $affected_rows = $stmt->affected_rows;
        $stmt->close();

        if ($affected_rows > 0) {
            $resultArray = array(1, $affected_rows, $sale_price, $sql);
        }
        else {
            $resultArray = array(0, $affected_rows, $sale_price, $sql);
        }
        return $resultArray;
    }
}
?>