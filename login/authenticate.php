<?php 
require_once('../functions.php');
// if(isset($db->conn)) {
//     echo "database established";
// }

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errorEmpty = false;
    $errorEmail = false;

    if (empty($email) || empty($password)) {
        echo "<span>Fill in all fields!</span>";
        $errorEmpty = true;
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<span>Invalid e-mail address, try again!</span>";
        $errorEmail = true;
    }
    else {
        // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
        if ($stmt = $db->conn->prepare('SELECT user_id, password, first_name FROM user WHERE email = ?')) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
            $stmt->bind_param('s', $_POST['email']);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $password, $first_name);
                $stmt->fetch();
                // Account exists, now we verify the password.
                // Note: remember to use password_hash in your registration file to store the hashed passwords.
            // if (password_verify($_POST['password'], $password)) { Hashed Passwords
                if ($_POST['password'] === $password || password_verify($_POST['password'], $password)) {
                    // Verification success! User has logged-in!
                    // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['id'] = $id;
                    $_SESSION['first_name'] = $first_name;

                    if ($_SESSION['id'] == 1) {
                        echo 1;
                        // header('Location: ../admin.php');
                    }
                    else {
                        echo 2;
                        // header('Location: ../index.php');
                    }
                    
                } else {
                    // Incorrect password
                    echo 'Incorrect password!';
                }
            } 
            else {
                // Incorrect username
                echo 'Account not found with e-mail address';
            }

            $stmt->close();
        }
    }
}
?>