<?php 
    session_start();

    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $post = json_decode($postdata,true);

    $resp['success']=false;
    
    if(isset($post['name']) && isset($_SESSION['user']) && $_SESSION['user'] == 'admin'){
        require('db_config.php');

        $genreName=$db_conn->escape_string($post['name']);

        $query = "DELETE FROM `ZANR` WHERE ZANR.ZANR_NAZIV='$genreName'";
        if ($db_conn->query($query)) {
            $resp['success']=true;
        }
    
        mysqli_close($db_conn);
    }
    echo json_encode($resp);

?>