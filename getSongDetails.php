<?php 
    $postdata = file_get_contents("php://input");
    $post = json_decode($postdata,true);

    if(isset($post['songName']) && isset($post['creator'])){
        require('db_config.php');
    
        $songName = $db_conn->escape_string($post['songName']);
        $creator = $db_conn->escape_string($post['creator']);

        if(!$db_conn){
            die('server not connected');
        }

        mysqli_close($db_conn);
    }

?>