<?php 
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $post = json_decode($postdata,true);

    if(isset($post['creator'])){
        require('db_config.php');
        if(!$db_conn){
            die('server not connected');
        }

        $creatorUser = $db_conn->escape_string($post['creator']);
        
        $result = mysqli_query($db_conn,"SELECT KREATOR.KREATOR_ID,KREATOR.KREATOR_IME,KREATOR.KREATOR_PREZIME,KREATOR.KREATOR_SLIKA,KREATOR.KREATOR_TEXT FROM `KREATOR` WHERE KREATOR.KREATOR_USERNAME='$creatorUser'");
        $data = array(); 
        $creatorId;

        if($row = mysqli_fetch_array($result)){
            $creatorId=$row['0'];
            $temp['ime']=$row['1'];
            $temp['prezime']=$row['2'];
            $temp['slika']=$row['3'];
            $temp['about']=$row['4'];
        }

        $result1 = mysqli_query($db_conn,"SELECT COUNT(*) FROM `PESMA` WHERE PESMA.KREATOR_ID = $creatorId");
        if($row2 = mysqli_fetch_array($result1)){
            $temp['brPesama']= $row2['0'];            
        }
        mysqli_close($db_conn);
        $resp = $temp;
        echo json_encode($resp);
    }
?>