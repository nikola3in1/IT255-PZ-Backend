<?php 
    header("Content-type: application/json");        
    require 'db_config.php';
    $query = "SELECT ZANR.ZANR_NAZIV FROM `ZANR`";
    $result = mysqli_query($db_conn,$query);
    $data = array();

    while($row=mysqli_fetch_array($result)){
        array_push($data,$row['0']);
    }
    mysqli_close($db_conn);
    $response['genres']=$data;
    echo json_encode($response);
?>