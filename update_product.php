<?php
require_once('functions.php');
include_once('includes/admin.class.php');

$admin = new Admin($db);
$data = array(1,2);

if (isset($_POST['submit'])) {
    
    $result = $admin->updateProduct($_POST['product_id'], $_POST['featured'], $_POST['new_price']);
    echo json_encode($result);
}
?>