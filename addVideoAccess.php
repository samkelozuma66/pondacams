<?php
    include 'config.php';
    $chatuser_id    = $_REQUEST["chatuser_id"];
    $img_id         = $_REQUEST["img_id"];
    $from_date      = date("Y-m-d");
    
    $to_date        = date("Y-m-d" ,strtotime("+90 DAYS"));
    
    $data = ["chatuser_id" => $chatuser_id,
             "video_id" => $img_id,
             "from_date" => $from_date,
             "to_date" => $to_date];
             
    //chatuser_id
    //img_id
    //from_date
    //to_date
    
    $respon = '{"status":"done","msg":"Picture Unlocked from '.$from_date.' to '.$to_date.'","Image id":"'.$img_id.'"}';
    
    $id = $conn -> insData("modelvideo_access", $data);
    echo $respon;

?>