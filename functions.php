<?php 

function deleteReports($songname,$creator){
    require('db_config.php');
    $resp['success']=false;

    $query = "DELETE FROM `PRIJAVA` WHERE PRIJAVA.PRIJAVA_PESMA='$songname' AND PRIJAVA.PRIJAVA_KREATOR='$creator'";
    if ($db_conn->query($query)) {
        $resp['success']=true;
    }

    mysqli_close($db_conn);

    return $resp;
}
?>