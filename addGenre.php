<?php 
    session_start();
    $postdata = file_get_contents("php://input");
    $post = json_decode($postdata,true);
    $user = $_SESSION['user'];

    if(isset($user) && $user =='admin' && isset($post['name']) && isset($post['about'])){
        require('db_config.php');
        if(!$db_conn){
            die('server not connected');
        }
        $genreName=$db_conn->escape_string($post['name']);
        $about=$db_conn->escape_string($post['about']);

        $resp["success"]=false;

        $myQuery = "INSERT INTO `ZANR`( `ZANR_NAZIV`, `ZANR_OPIS`) VALUES ('$genreName','$about')";
        if ($db_conn->query($myQuery)) {
            $resp["success"]=true;
        }
        mysqli_close($db_conn);
        echo json_encode($resp);
    } 
?>