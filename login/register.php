<?php 
require_once('../functions.php');
// if(isset($db->conn)) {
//     echo "database established";
// }

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Test for empty fields
    if (empty($email) || empty($password) || empty($first_name) || empty($last_name) ) {
        echo "Fill in all fields!";
        exit();
    }
    // Test for valid e-mail
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid e-mail address, try again!";
        exit();
    }

    // Test for e-mail already existing
    $stmt = $db->conn->prepare("SELECT * from user WHERE email = ?;");
    
    // set parameters and execute
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $num_of_rows = $stmt->num_rows;
    $stmt->close();

    if ($num_of_rows >= 1) {
        echo "Email is already in the database!";
        exit();
    }


    // Test Conditions have been passed, now insert into the user table
    $sql = "INSERT INTO user (email, password, first_name, last_name) VALUES (?, ?, ?, ?)";
    $stmt = $db->conn->prepare($sql);

    // Hash password for db security
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    
    // set parameters and execute
    $stmt->bind_param("ssss", $email, $hashed_pass, $first_name, $last_name);
    $stmt->execute();
    $id = $stmt->insert_id;
    $stmt->close();

    //Set Session as logged in
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $id;
    $_SESSION['first_name'] = $first_name;
}
?>