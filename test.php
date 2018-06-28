<?php
    require_once('./getID3-master/getid3/getid3.php');
    // mp3("./uploads/song3.mp3");
function mp3($pathName){
    $getID3 = new getID3;
    $file = $getID3->analyze($pathName);
    getid3_lib::CopyTagsToComments($file);
    echo round($file["playtime_seconds"]). " ". $file["playtime_string"];
}
?>