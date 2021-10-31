<?php
    include 'config.php';
    $id = $_POST["id"];
    $type = $_POST["type"];
    $chatuser_id = $_POST["chatuser_id"];
    echo $id;
    $data = ['chatuser_id'=>$chatuser_id,'session_type'=>$type];
    $done = $conn ->updateData('session',$data,['id' => $id]);
    echo $done;
?>