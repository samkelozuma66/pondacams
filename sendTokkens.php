<?php
    include 'config.php';
    $tokken = $_REQUEST["tokkens"];
    $id = $_REQUEST["id"];
    $model_id = $_REQUEST["model_id"];
    
    $data = ['id'=>$id];
    $done = $conn ->getRow('chatusers',$data);
    $done1 = $conn ->getRow('users',['id' => $model_id]);
    $respon = "";
    if($done[0]["money"] < $tokken)
    {
        
        $respon = '{"status":"failed","message":"You dont Have Enough Tokkens. Your Balance is : '.$done[0]["money"].' T"}';
    }
    else
    {
        $conn ->updateData('chatusers',['money' => ($done[0]["money"] - $tokken)],$data);
        $conn ->updateData('users',['money' => ($done1[0]["money"] + $tokken)],['id' => $model_id]);
        $reuest ="https://pondacams.com/tip.php?USER_ID=$model_id&CHATUSER_ID=$id&AMOUNT=".$tokken;
        $xml = file_get_contents($reuest);
        
        $respon = '{"status":"done","message":'.$xml.',"tokkens":"'.$tokken.'"}';
        
    }
   // $model = $_POST["model"];
    //$data = ['id'=>'0','model'=>$model,'status'=>'1','stream'=>$stream];
    //$done = $conn ->getRow('session',$data);
    echo $respon;
?>