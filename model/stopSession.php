<?php
    include 'config.php';
    $id = $_POST["id"];
    $session = $_POST["session"];
    
    $session = $conn -> getRow('session',['id' => $id]);
    echo "l ".$session[0]['model'];
    $conn ->updateData('users',["is_online"=> 0],["id"=>$session[0]["model"]]);
    
    $data = ['id' => $id];
    $done = $conn ->deleteRow('session',$data);
    
    
    
    $end_time   = date("H:i:s");
    $conn ->updateData('session_time',["end_time" => $end_time],["sesion_id"=>$session[0]['stream']]);
    
    echo $done;
?>