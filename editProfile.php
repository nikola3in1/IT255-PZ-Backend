<?php 
    session_start();
    header("Content-type: application/json");   
    
    if(isset($_POST['about']) && isset($_POST['paypal']) && isset($_SESSION['username'])){
        $tempPath = $_FILES["picture"]["tmp_name"];
        $name = $_FILES["picture"]["name"];
    
        $ext = explode(".",$name);
        $username = $_SESSION['username'];
    
        $songPath = "uploads/".$username.".".$ext[1];
        
        if(move_uploaded_file($tempPath,$songPath)){
            echo json_encode(updateProfile($songPath));
        }
    }

    function updateProfile($path){
        require 'db_config.php';
        $songPath = $db_conn->escape_string($path);
        $username = $db_conn->escape_string($_SESSION['username']);
        $about = $db_conn->escape_string($_POST['about']);
        $paypal = $db_conn->escape_string($_POST['paypal']);

        $resp = array();
        
        $query= "UPDATE `KREATOR` SET `KREATOR_PAYPAL`='$paypal',`KREATOR_SLIKA`='$songPath',`KREATOR_TEXT`='$about' WHERE KREATOR_USERNAME='$username'";
        $result = $db_conn->query($query); 
        if($result->num_rows==0){
            $_SESSION['initLogin']="false";
            return $resp['success']=true;        
        }
        mysqli_close($db_conn);
        return $resp['success']=false;
    }
?>