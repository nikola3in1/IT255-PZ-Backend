<?php 
    session_start();

    $postdata = file_get_contents("php://input");
    $post = json_decode($postdata,true);

    $user=$_SESSION['user'];
    $creator= $_SESSION['username'];
    $songname=$db_conn->escape_string($post['songname']);

    if(isset($user) && $user == 'user' && isset($songname) && isset($creator)) {
        //Creator brise    
        deleteSong($creator,$songname);
    }
    else if( isset($user) && $user == 'admin' && isset($songname) && isset($post['creator'])){
        //Admin brise
        $creator=$post['creator'];
        deleteSong($creator,$songname);
    }

    function deleteSong($creator,$songname){
        require('db_config.php');
        require('functions.php');

        $query = "SELECT PESMA.PESMA_ID,PESMA.PESMA_PATH,PESMA.PESMA_PATH_ZIG FROM `PESMA` 
        LEFT JOIN KREATOR ON PESMA.KREATOR_ID = KREATOR.KREATOR_ID 
        WHERE KREATOR.KREATOR_USERNAME='$creator' AND PESMA.PESMA_NAZIV='$songname'";
        $result = mysqli_query($db_conn,$query);
        $data = array();

        $songPath;
        $wsongPath;
        $songId;
        while($row=mysqli_fetch_array($result)){
            $songId=$row['0'];
            $songPath=$row['1'];
            $wsongPath=$row['2'];
        }

        //Delete from filesystem
        unlink('./'.$songPath);
        unlink('./'.$wsongPath);

        //Delete from db
        $query = "DELETE FROM `PESMA` WHERE PESMA.PESMA_ID='$songId'";
        if ($db_conn->query($query)) {
            $resp['success']=true;
        }

        mysqli_close($db_conn);
        $resp['reports']= deleteReports($songname,$creator);

        echo json_encode($resp);
    }



?>