<?php 
    header("Content-type: application/json");
    $postdata = file_get_contents("php://input");
    $post = json_decode($postdata,true);

    if(isset($post['query'])) {
        require('db_config.php');
    
        $myQuery = $db_conn->escape_string($post['query']);

        if(!$db_conn){
            die('server not connected');
        }

        $gotResults=false;

        //is is a song?
        $query = "SELECT DISTINCT PESMA.PESMA_NAZIV,KREATOR.KREATOR_USERNAME FROM PESMA 
        LEFT JOIN KREATOR ON PESMA.KREATOR_ID = KREATOR.KREATOR_ID
        WHERE PESMA_NAZIV LIKE '%$myQuery%'";
        $result = mysqli_query($db_conn,$query);
        $data['songs'] = array();
        $data['creators'] = array();
        
        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_array($result)){
                $temp['song']=$row['0'];
                $temp['creator']=$row['1'];
                array_push($data['songs'],$temp);
                $gotResults=true;
            }
        }

         //is is a creator?
        $query = "SELECT DISTINCT KREATOR.KREATOR_USERNAME FROM KREATOR
        WHERE KREATOR.KREATOR_USERNAME LIKE '%".$myQuery."%'";
        $result = mysqli_query($db_conn,$query);
        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_array($result)){
               $temp['creator']=$row['0'];
               array_push($data['creators'],$temp);
               $gotResults=true;
            }
        }
        mysqli_close($db_conn);
        echo json_encode($data);
    }
?>