<?php 
    header("Content-type: application/json");
    $postdata = file_get_contents("php://input");
    $post = json_decode($postdata,true);

    if(isset($post['genre']) && isset($post['ip'])){
        echo getGenre($post['ip'],$post['genre']);
    }else if(isset($post['creator']) && isset($post['ip'])){
        echo getByCreator($post['creator'],$post['ip']);
    }

    function getByCreator($creator,$ip){
        require('db_config.php');

        $ip = $db_conn->escape_string($ip);
        $creator = $db_conn->escape_string($creator);

        if(!$db_conn){
            die('server not connected');
        }

        $query = "SELECT KREATOR.KREATOR_USERNAME, PESMA.PESMA_NAZIV,PESMA.PESMA_PATH_ZIG,PESMA.PESMA_TRAJANJE,PESMA.PESMA_DATUM,PESMA.PESMA_ID 
        FROM PESMA
        LEFT JOIN KREATOR ON PESMA.KREATOR_ID = KREATOR.KREATOR_ID 
        WHERE KREATOR.KREATOR_USERNAME='$creator'";
        $result = mysqli_query($db_conn,$query);
        $data = array();

        while($row=mysqli_fetch_array($result)){

            $temp['creator']=$row['0'];
            $temp['name']=$row['1'];
            $temp['path']=$row['2'];
            $temp['upload-date']=$row['4'];

            //Check if it's liked by this user
            $songId =$row['5'];
            $temp['liked']=false;

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
            array_push($data,$temp);            
        }
        $response['songs']=$data;
        
        return json_encode($response);
    }


    function getGenre($ips,$genres){
        require('db_config.php');
        
        $ip = $db_conn->escape_string($ips);
        $genre = $db_conn->escape_string($genres);


        if(!$db_conn){
            die('server not connected');
        }
        // $genre = $db_conn->escape_string($post['genre']);
        // $ip = $db_conn->escape_string($post['ip']);

        //NE ZABORAVI DA IZMENI DA BDE pesma.KREATOR_ID!!!
        $query = "SELECT KREATOR.KREATOR_USERNAME, PESMA.PESMA_NAZIV,PESMA.PESMA_PATH,PESMA.PESMA_TRAJANJE,PESMA.PESMA_DATUM,PESMA.PESMA_ID 
        FROM PESMA
        LEFT JOIN KREATOR ON PESMA.KREATOR_ID = KREATOR.KREATOR_ID 
        LEFT JOIN ZANR ON PESMA.ZANR_ID = ZANR.ZANR_ID WHERE ZANR.ZANR_NAZIV='$genre'";
        $result = mysqli_query($db_conn,$query);
        $data = array();

        while($row=mysqli_fetch_array($result)){
            $temp['creator']=$row['0'];
            $temp['name']=$row['1'];
            $temp['path']=$row['2'];
            $temp['upload-date']=$row['4'];

            //Check if it's liked by this user
            $songId =$row['5'];
            $temp['liked']=false;

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


            array_push($data,$temp);            
        }
        mysqli_close($db_conn);

        $response['songs']=$data;
        
        header("Content-type: application/json");
        return json_encode($response);
    }
?>