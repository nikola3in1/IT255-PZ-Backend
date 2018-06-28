<?php 

    session_start();

    header("Access-Control-Allow-Origin: http://localhost:4200");  
    header("Content-type: application/json");        

    //Getting post data since we are dealing with json;
    $postdata = file_get_contents("php://input");
    $post = json_decode($postdata,true);


    if(isset($post['firstname']) && isset($post['lastname']) && isset($post['username']) && isset($post['email']) && isset($post['password'])){
        require 'db_config.php';
        $firstname = $db_conn->escape_string($post['firstname']);
        $lastname = $db_conn->escape_string($post['lastname']);
        $username = $db_conn->escape_string($post['username']);
        $email = $db_conn->escape_string($post['email']);
        $password = $db_conn->escape_string(password_hash($post['password'], PASSWORD_BCRYPT));
        
        $emailCheck = $db_conn->query("SELECT * FROM `KREATOR` WHERE KREATOR_EMAIL='$email'") or die($db_conn->error());
        $usernameCheck = $db_conn->query("SELECT * FROM `KREATOR` WHERE KREATOR_USERNAME='$username'") or die($db_conn->error());
        
        $response = array();


        if ($emailCheck->num_rows > 0 || $usernameCheck->num_rows > 0) {
            $response["success"]="false";
            $response["message"]="vec postoji";
        } else {
                $query = "INSERT INTO `KREATOR` (KREATOR_IME, KREATOR_PREZIME, KREATOR_ZARADA, KREATOR_USERNAME, KREATOR_EMAIL, KREATOR_SIFRA)"
                . "VALUES ('$firstname','$lastname','0','$username','$email','$password')";
        
            if ($db_conn->query($query)) {
                $response["message"]="registrovan!";
                $response["success"]="true";
                $_SESSION["initLogin"]="true";
            } else {
                $response["message"]="failed";
                $response["success"]="true";                
            }
        }

        //Ovde ide redirect
        mysqli_close($db_conn);
        echo json_encode($response);
        
    }
    
   

?>