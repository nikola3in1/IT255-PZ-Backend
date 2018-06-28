<?php 
    session_start();
    header("Content-type: application/json"); 

    $username = $_SESSION['username'];
    $user = $_SESSION['user'];

    if(isset($username) && isset($user) && $user=='user'
        && isset($_POST['name']) && isset($_POST['genre']) && isset($_POST['about']) 
        && isset($_FILES['song']) && isset($_FILES['wsong'])){

        require('db_config.php');

    //Setting the lock for table `pesma`
    // $db_conn->query("LOCK TABLES `pesma` WRITE");    
    // $result = $db_conn->query("SELECT MAX(PESMA_ID) FROM `pesma`");
    // $nextSongID = $result->fetch_assoc()['MAX(PESMA_ID)']+1;
    
        $songNameRaw = $_SESSION['username']."-".$_POST['name'];
        $songPath = "uploads/songs/".$songNameRaw.".mp3";
        

        $songNameHash = str_replace('/','',password_hash($songNameRaw, PASSWORD_DEFAULT)); 
        $wsongPath = "uploads/hsongs/".$songNameHash.".mp3";

        $response['123']=$wsongPath;

    // //Check if song exists in filesystem
    if(!file_exists($songPath)){
        $response['message']="SVE KUL";
        if(move_uploaded_file($_FILES["song"]["tmp_name"],$wsongPath) 
        && move_uploaded_file($_FILES["wsong"]["tmp_name"],$songPath)){
            $response['status']=addSong($songPath,$wsongPath,$_SESSION['username'],$_POST['name'],$_POST['genre'],$_POST['about']);
        }else{
            $response['message']= 'failed here';
        }
    }else{
        $response['message']= "DUPLICATE";
    }

}
echo json_encode($response);


function addSong($songPath,$wsongPath,$userName,$songName,$songGenre,$about){
    require('db_config.php');

    //Calculating Data
    $currDate=date("Y-m-d");
    $songDuration = songDuration($songPath);
    $price=2.99;
    if($songDuration>120){
        $price=4.99;
    }

    $query = "INSERT INTO `PESMA` SET
    `KREATOR_ID` = (SELECT KREATOR.KREATOR_ID FROM `KREATOR` WHERE KREATOR.KREATOR_USERNAME= '$userName'),
    `ZANR_ID`=(SELECT `ZANR_ID` FROM `ZANR` WHERE `ZANR_NAZIV` = '$songGenre' ), 
    `PESMA_PATH`='$wsongPath', 
    `PESMA_PATH_ZIG`='$songPath', 
    `PESMA_NAZIV`='$songName',
    `PESMA_TRAJANJE`='$songDuration',
    `PESMA_CENA`='$price',
    `PESMA_DATUM`='$currDate',
    `PESMA_BR_KUPOVINA`= 0,
    `PESMA_OPIS`='$about'";

    $resp['success']=false;

    if ($db_conn->query($query)) {
        $resp['success']=true;
    }
    mysqli_close($db_conn);

    return $resp;
}

function songDuration($songPath){
    require_once('./getID3-master/getid3/getid3.php');

    $getID3 = new getID3;
    $file = $getID3->analyze($songPath);
    getid3_lib::CopyTagsToComments($file);
    return ceil($file["playtime_seconds"]);
}

?>