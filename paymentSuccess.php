<?php
    include 'config.php';
    
    $tokens = $_GET["tokens"];
    $id = $_GET["userid"];
    $vip = $_GET["vip"];
    $v = 0;
    if($vip == "yes")
    {
        $v = 1;
    }
    $chatusers = $conn -> getRow('chatusers', ['id' => $id]);
    $conn -> updateData('chatusers',['money' => ($chatusers[0]['money'] + $tokens),'vip'=>$v] , ['id' => $id]);
    echo "<h1>Payment Success Full</h1>";
    //echo "<script>window.location.href='./index.php'</script>";
    //echo '<script>window.open("", "_self");
//window.close();</script>';
?>