<?php

class User
{
    public $db = null;

    public function __construct(Dbh $db)
    {
        if (!isset($db->conn)) return null;
        $this->db = $db;
    }

    // Get All Orders
    public function getUserOrders($id) {
        $sql = "SELECT order_details.*, product.product_name, orders.date_created, order_status.status_id, order_status.status_code 
        FROM order_details INNER JOIN product ON order_details.product_id = product.product_id 
        INNER JOIN orders ON order_details.order_id= orders.order_id 
        INNER JOIN order_status on order_status.status_id = orders.order_status_id WHERE orders.user_id = ?
        ORDER BY orders.order_id DESC;";

        $resultArray = $this->getOrderData($sql, $id);
        return $resultArray;
    }

    public function getOpenOrders($array) {
        $open_orders = array_filter($array, function ($var) {
            return ($var['status_id'] !== 3);
        });
        return $open_orders;
    }

    // Get Open Orders
    public function getUserOpenOrders($id) {
        $sql = "SELECT order_details.*, product.product_name, orders.date_created, order_status.status_id, order_status.status_code 
        FROM order_details INNER JOIN product ON order_details.product_id = product.product_id 
        INNER JOIN orders ON order_details.order_id= orders.order_id 
        INNER JOIN order_status on order_status.status_id = orders.order_status_id 
        WHERE orders.user_id = ? AND order_status.status_id <> 3
        ORDER BY orders.order_id DESC;";

        $resultArray = $this->getOrderData($sql, $id);


        return $resultArray;
    }


    protected function getOrderData($sql, $id) {
        $resultArray = array();
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // $resultArray = $stmt->fetchAll();
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){

            // Check if order_id in array
            if (!array_key_exists($item['order_id'], $resultArray)) {
                $x = $item['order_id'];
                // New order, add common information  
                $resultArray[$x] = array();
                $resultArray[$x]['date_created'] = date_create($item['date_created']);
                $resultArray[$x]['status_code'] = $item['status_code'];
                $resultArray[$x]['status_id'] = $item['status_id'];
                $resultArray[$x]['products'] = array();
                $resultArray[$x]['order_total'] = 0.00;
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



}
?>