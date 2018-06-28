<?php 
    $postdata = file_get_contents("php://input");
    $post = json_decode($postdata,true);

    $response=array();
    $response['status']="false";
    if(isset($post['songName']) && isset($post['ip'])){
        require('db_config.php');
        if(!$db_conn){
            die('server not connected');
        }

        $ip=$db_conn->escape_string($post['ip']);
        $songName=$db_conn->escape_string($post['songName']);

        //get song id
        $getSongId= mysqli_query($db_conn,"SELECT PESMA.PESMA_ID from PESMA WHERE PESMA.PESMA_NAZIV = '$songName'");
        $data = $getSongId->fetch_assoc();
        $songId = $data['PESMA_ID']; 


        //check if its already liked
        $songIdInt=intval($songId);
        $isLiked = mysqli_query($db_conn,"SELECT * from LAJKOVI WHERE LAJKOVI.PESMA_ID = '$songId' AND LAJKOVI.LAJKOVI_IP='$ip'");

        if($isLiked->num_rows!=0){
            //it's liked, then dislike it
            //DELETE FROM `Lajkovi` WHERE Lajkovi.`pesma_id`=
            $query = "DELETE FROM `LAJKOVI` WHERE `LAJKOVI`.`PESMA_ID` = '$songId'";
            $result = mysqli_query($db_conn,$query);
            $response['status']="disliked";

        }else{
            //like it
            $query = "INSERT INTO `LAJKOVI`(`LAJKOVI_IP`, `PESMA_ID`) VALUES ('$ip','$songId')";
            $result = mysqli_query($db_conn,$query);
            $response['status']="liked";
        }
        mysqli_close($db_conn);
    }
    header("Content-type: application/json");
    echo json_encode($response);  
?>