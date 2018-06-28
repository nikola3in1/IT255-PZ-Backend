<?php 
    session_start();
    header('Content-type: application/json');

    $temp['session']=$_SESSION;

    if(isset($_SESSION['username']) && isset($_SESSION['user']) && $_SESSION['user']=='user'){
        require('db_config.php');
        if(!$db_conn){
            die('server not connected');
        }

        $creatorUser = $db_conn->escape_string($_SESSION['username']);
        
        $result = mysqli_query($db_conn,"SELECT KREATOR.KREATOR_ID,KREATOR.KREATOR_IME,KREATOR.KREATOR_PREZIME,KREATOR.KREATOR_ZARADA,KREATOR.KREATOR_SLIKA,KREATOR.KREATOR_TEXT FROM `KREATOR` WHERE KREATOR.KREATOR_USERNAME='$creatorUser'");
        $data = array(); 
        $creatorId;

        while($row = mysqli_fetch_array($result)){
            $creatorId=$row['0'];
            $temp['ime']=$row['1'];
            $temp['prezime']=$row['2'];
            $temp['zarada']=$row['3'];
            $temp['slika']=$row['4'];
            $temp['about']=$row['5'];
        }

        $result1 = mysqli_query($db_conn,"SELECT COUNT(*) FROM `PESMA` WHERE PESMA.KREATOR_ID = $creatorId");
        if($row2 = mysqli_fetch_array($result1)){
            $temp['brPesama']= $row2['0'];            
        }
        
        mysqli_close($db_conn);
    }
    echo json_encode($temp);
    
?>