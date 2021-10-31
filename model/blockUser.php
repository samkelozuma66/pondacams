<?php
    include 'config.php';
    
    $model = $_POST['model_id'];
    $cuser = $_POST['chatuser'];
    $btype = $_POST['type'];
    $from_date = date('Y-m-d');
    if($btype == "banish")
    {
        $to_date   = date('Y-m-d',strtotime("+7 days"));
    }
    else
    {
        $to_date   = date('Y-m-d',strtotime("+30 days"));
    }
    $data = ['model_id'=> $model,
             'chatuser_id' => $cuser,
             'from_date'   => $from_date,
             'to_date'     => $to_date,
             'type'         => $btype    ];
    $done = $conn -> insData('blocked',$data);
    echo $done;

?>