<?php 
    header("Content-type: application/json");
    $postdata = file_get_contents("php://input");
    $post = json_decode($postdata,true);
    // $post['creator']="nikola";
    // $post['songName']="Cardi";
    // $post['ip']="87.116.179.16";

    if(isset($post['creator']) && isset($post['songName']) && isset($post['ip'])){
        echo getSong($post['songName'],$post['creator'],$post['ip']);
    }

    function getSong($songName,$creator,$ip){
        require('db_config.php');
    
        $songName = $db_conn->escape_string($songName);
        $creator = $db_conn->escape_string($creator);
        $ip = $db_conn->escape_string($ip);

        if(!$db_conn){
            die('server not connected');
        }

        $query = "SELECT KREATOR.KREATOR_USERNAME, PESMA.PESMA_NAZIV,PESMA.PESMA_PATH_ZIG,
        PESMA.PESMA_TRAJANJE, PESMA.PESMA_DATUM,PESMA.PESMA_ID,PESMA.PESMA_OPIS, PESMA.PESMA_CENA,
        PESMA.PESMA_BR_KUPOVINA, ZANR.ZANR_NAZIV 
        FROM PESMA LEFT JOIN KREATOR ON PESMA.KREATOR_ID = KREATOR.KREATOR_ID 
        LEFT JOIN ZANR ON PESMA.ZANR_ID = ZANR.ZANR_ID 
        WHERE PESMA.PESMA_NAZIV='$songName' AND KREATOR.KREATOR_USERNAME='$creator'";
        $result = mysqli_query($db_conn,$query);

        $data;
        while($row=mysqli_fetch_array($result)){
            $temp['creator']=$row['0'];
            $temp['name']=$row['1'];
            $temp['path']=$row['2'];
            $temp['duration']=$row['3'];
            $temp['upload-date']=$row['4'];
            $temp['about']=$row['6'];
            $temp['price']=$row['7'];
            $temp['sales']=$row['8'];
            $temp['genre']=$row['9'];

            //Check if it's liked by this user
            $songId =$row['5'];
            //get total likes (SELECT COUNT(*) FROM LAJKOVI WHERE LAJKOVI.PESMA_ID='18')AS likes 
            $getTotalLikes = "SELECT COUNT(*) FROM LAJKOVI WHERE LAJKOVI.PESMA_ID='$songId'";
            $result2= mysqli_query($db_conn,$getTotalLikes);
            if($row2=mysqli_fetch_array($result2)){
                if (isset($row2['0'])) {
                    $temp['likes']=$row2['0'];
                }
            }

            $isLiked = "SELECT LAJKOVI.LAJKOVI_ID FROM `LAJKOVI`
            WHERE LAJKOVI.LAJKOVI_IP = '$ip' AND LAJKOVI.PESMA_ID = '$songId'";
            $result3= mysqli_query($db_conn,$isLiked);
            if($row3=mysqli_fetch_array($result3)){
                if (isset($row3['0'])) {
                    $temp['liked']=true;
                }
            }
            $data =$temp;
        }
        mysqli_close($db_conn);
        
        return json_encode($data);
    }
?>