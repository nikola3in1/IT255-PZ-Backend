<?php 
        session_start();

        header("Access-Control-Allow-Origin: http://localhost:4200");  
        header("Content-type: application/json");        
        require 'db_config.php';

        //Getting post data since we are dealing with json;
        $postdata = file_get_contents("php://input");
        $post = json_decode($postdata,true);

        $username = $db_conn->escape_string($post['username']);
        $result;

        //username
        $result = $db_conn->query("SELECT * FROM `KREATOR` WHERE KREATOR_USERNAME='$username'"); 
        if($result->num_rows==0){
            $result = $db_conn->query("SELECT * FROM `ADMINISTRATOR` WHERE ADMIN_USERNAME='$username'");
        }

        //Checking if there are some results
        if ($result->num_rows != 0) {
            $user = $result->fetch_assoc();
            if(password_verify($post['password'],$user['KREATOR_SIFRA'])){
                //User is logged in
                $_SESSION['user']='user';
                $_SESSION['username']=$post['username'];
                
                $response = array();
                $response['message']="User is logged in";                
                $response['success']=true;
        
            }else if(password_verify($post['password'],$user['ADMIN_SIFRA'])){
                $_SESSION['user']='admin';
                $_SESSION['username']=$post['username'];

                $response = array();
                $response['message']="Admin is logged in";                
                $response['success']=true;
            }else{
                //Wrong password
                $response = array();
                $response['status']="login failed";
            }
        }else{
            $response = array();
            $response['message']="login failed";
            $response['success']=false;
        }

        echo json_encode($response);
        
        mysqli_close($db_conn);
    
?>