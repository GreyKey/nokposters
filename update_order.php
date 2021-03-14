<?php
require_once('functions.php');
include_once('includes/admin.class.php');

$admin = new Admin($db);
$data = array(1,2);

if (isset($_POST['submit'])) {
        $result = $admin->updateOrder($_POST['status_id'],$_POST['order_id']);
    echo json_encode($result);
}
?>