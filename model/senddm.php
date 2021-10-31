<?php
    include 'config.php';
    $dc_id      = $_POST['dc_id'];
    $from_id    = $_POST['from_id'];
    $msg        = $_POST['msg'];
    $name       = $_POST['name'];
    
    $data = ['dc_id'    => $dc_id,
             'from_id'  => $from_id,
             'msg'      => $msg,
             'name'     => $name
             ];
             
    $done = $conn -> insData('direct_msg',$data);
    
    echo $done;

?>