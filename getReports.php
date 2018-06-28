<?php 
    session_start();

    if(isset($_SESSION['user']) && $_SESSION['user']=='admin'){
        require('db_config.php');
        if(!$db_conn){
            die('server not connected');
        }

        $result = mysqli_query($db_conn,"SELECT `PRIJAVA_RAZLOG`, `PRIJAVA_PESMA`, `PRIJAVA_KREATOR`,`PRIJAVA_ID`,`PRIJAVA_PRIJAVIO` FROM `PRIJAVA`");
        $data = array(); 

        while($row = mysqli_fetch_array($result)){
            $temp['reason']=$row['0'];            
            $temp['song']=$row['1'];            
            $temp['creator']=$row['2'];            
            $temp['id']=$row['3'];            
            $temp['reportedBy']=$row['4'];            
            array_push($data,$temp);
        }

        $resp['reports']=$data;
        mysqli_close($db_conn);

}
    echo json_encode($resp);

?>