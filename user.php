<?php 
    session_start();
       header("Content-type: application/json");        
    
    $user = $_SESSION['user'];
    $init = $_SESSION['initLogin'];
    $response=array();
    $response['username']=$_SESSION['username'];
    if($user == 'admin'){
        $response['message']="admin";
        $response['success']=true;
    }else if($init=="true"){
        $response['message']="user";
        $response['initLogin']=true;
        $response['success']=true;
    }
    else if($user=='user'){
        $response['message']="user";
        $response['success']=true;
    }
    else{        
        $response['message']="You shall not pass!";
        $response['success']=false;
    }

    echo json_encode($response);
?>