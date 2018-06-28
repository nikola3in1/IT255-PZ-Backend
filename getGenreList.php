<?php
    header("Content-type: application/json");
    $postdata = file_get_contents("php://input");
    $post = json_decode($postdata,true);

    require('db_config.php');

    if(!$db_conn){
        die('server not connected');
    }

    $query = "SELECT `ZANR_NAZIV` FROM `ZANR` WHERE 1";

    if(isset($post['limit'])){
        $limit = $db_conn->escape_string($post['limit']);

        $query = "SELECT `ZANR_NAZIV` FROM `ZANR` WHERE 1 LIMIT $limit";       
    }

    $result = mysqli_query($db_conn,$query);
    $data = array();

    while($row=mysqli_fetch_array($result)){
        array_push($data,$row['0']);
    }
    mysqli_close($db_conn);
    echo json_encode($data); 
?>