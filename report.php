<?php 
    session_start();

    $postdata = file_get_contents("php://input");
    $post = json_decode($postdata,true);
    $user = $_SESSION['user'];

    $resp['post']=$post;
    $resp['session']=$_SESSION;

    if(isset($post['reason']) && isset($post['songname']) && isset($post['reportedBy']) && isset($post['creator']) && isset($user) && $user=='user'){
        require 'db_config.php';
        $songname = $db_conn->escape_string($post['songname']);
        $reason = $db_conn->escape_string($post['reason']);
        $creator = $db_conn->escape_string($post['creator']);
        $reportedBy = $db_conn->escape_string($post['reportedBy']);

        $query= "INSERT INTO `PRIJAVA`(`PRIJAVA_RAZLOG`, `PRIJAVA_PESMA`, `PRIJAVA_KREATOR`, `PRIJAVA_PRIJAVIO`)
         VALUES ('$reason','$songname','$creator','$reportedBy')";
        $result = $db_conn->query($query); 
        if($result->num_rows==0){
            $resp['success']=true;        
        }
        mysqli_close($db_conn);
    }


    header("Content-type: application/json");    
    echo json_encode($resp);

?>