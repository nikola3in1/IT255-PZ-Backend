<?php 
    header("Content-type: application/json");
  $postdata = file_get_contents("php://input");
  $post = json_decode($postdata,true);

  if(isset($post['songname']) && isset($post['creator']) ){
    require('db_config.php');
    if(!$db_conn){
        die('server not connected');
    }
    $resp["success"]=false;

    $songname=$db_conn->escape_string($post['songname']);
    $creator=$db_conn->escape_string($post['creator']);

    $getId = "SELECT PESMA.PESMA_ID FROM `PESMA`
    LEFT JOIN KREATOR ON PESMA.KREATOR_ID = KREATOR.KREATOR_ID 
    WHERE PESMA.PESMA_NAZIV='$songname' AND KREATOR.KREATOR_USERNAME='$creator'";

    $result = mysqli_query($db_conn,$getId);

    $songId;
    if($row=mysqli_fetch_array($result)){
        $songId=$row['0'];
        $increment = "UPDATE `PESMA` SET PESMA.PESMA_BR_KUPOVINA = PESMA.PESMA_BR_KUPOVINA + 1 WHERE PESMA.PESMA_ID= $songId";
    
        if ($db_conn->query($increment)) {
            $resp['success']=true;
        }
    }

    mysqli_close($db_conn);
    echo json_encode($resp);
  }

?>