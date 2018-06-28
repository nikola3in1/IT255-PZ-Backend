<?php 
    header("Content-type: application/json");
    $postdata = file_get_contents("php://input");
    $post = json_decode($postdata,true);

    if(isset($post['ip'])){
        require('db_config.php');

        $ip = $db_conn->escape_string($post['ip']);
    
        if(!$db_conn){
            die('server not connected');
        }
    
        $query = "SELECT KREATOR.KREATOR_USERNAME,PESMA.PESMA_NAZIV,PESMA.PESMA_PATH,PESMA.PESMA_DATUM,PESMA.PESMA_ID 
        FROM `PESMA` LEFT JOIN KREATOR ON PESMA.KREATOR_ID = KREATOR.KREATOR_ID 
        WHERE PESMA_DATUM >= NOW() + INTERVAL -7 DAY
        AND PESMA_DATUM < NOW() + INTERVAL 0 DAY 
        ORDER BY PESMA.PESMA_BR_KUPOVINA DESC LIMIT 5";
        $result = mysqli_query($db_conn,$query);
        $data = array();
    
        while($row=mysqli_fetch_array($result)){
            $temp['creator']=$row['0'];
            $temp['name']=$row['1'];
            $temp['path']=$row['2'];
            $temp['upload-date']=$row['3'];
    
            //Check if it's liked by this user
            $songId =$row['4'];
            $temp['liked']=false;

            //get total likes (SELECT COUNT(*) FROM LAJKOVI WHERE LAJKOVI.PESMA_ID='18')AS likes 
            $getTotalLikes = "SELECT COUNT(*) FROM LAJKOVI WHERE LAJKOVI.PESMA_ID='$songId'";
            $result2= mysqli_query($db_conn,$getTotalLikes);
            if($row2=mysqli_fetch_array($result2)){
                if (isset($row2['0'])) {
                    $temp['likes']=$row2['0'];
                }
            }

            $isLiked = "SELECT LAJKOVI.LAJKOVI_ID FROM `LAJKOVI`
            WHERE LAJKOVI.LAJKOVI_IP = '$ip' AND LAJKOVI.PESMA_ID = '$songId'";
            $result3= mysqli_query($db_conn,$isLiked);
            if($row3=mysqli_fetch_array($result3)){
                if (isset($row3['0'])) {
                    $temp['liked']=true;
                }
            }

            array_push($data,$temp);            
        }
        mysqli_close($db_conn);

        $response['songs']=$data;

        echo json_encode($response);
    }

?>