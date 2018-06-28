<?php 

    $postdata = file_get_contents("php://input");
    $post = json_decode($postdata,true);

        require 'db_config.php';

        $post['username'] ="admin";
        $post['password'] ="admin";

        $username = $db_conn->escape_string($post['username']);
        $password = $db_conn->escape_string(password_hash($post['password'], PASSWORD_BCRYPT));
        
        $usernameCheck = $db_conn->query("SELECT * FROM `administrator` WHERE ADMIN_USERNAME='$username'") or die($db_conn->error());
        
        if ($usernameCheck->num_rows > 0) {
            $_SESSION['error'] = true;
            $_SESSION['message'] = 'User with this email already exists!';
        } else {
            $query = "INSERT INTO `administrator` (ADMIN_USERNAME, ADMIN_SIFRA)"
                . "VALUES ('$username','$password')";
            if ($db_conn->query($query)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['error'] = false;
            } else {
                $_SESSION['error'] = true;
                $_SESSION['message'] = 'Registration failed!';
            }
        }
        mysqli_close($db_conn);
?>