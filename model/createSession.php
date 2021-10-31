<?php
    include 'config.php';
    $stream = $_POST["stream"];
    $model = $_POST["model"];
    $data = ['id'=>'0','model'=>$model,'status'=>'1','stream'=>$stream,'session_type'=>'public','chatuser_id'=>'0'];
    $done = $conn ->insData('session',$data);
    
    $conn ->updateData('users',["is_online"=> 1],["id"=>$model]);
    $end_time   = date("H:i:s");
    $start_time = date("H:i:s");
    $conn ->insData('session_time',['id'=>'0','model_id'=>$model,"sesion_id" => $stream,"start_time" => $start_time,"end_time"=>$end_time]);
    echo $done;
?>