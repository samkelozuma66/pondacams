<?php
    include 'config.php';
    
    $modelId = $_REQUEST["modelId"];
    $id     = $_REQUEST["chatuserid"];
    $conn -> insData("favorites", ["member" => $id , "model" => $modelId]);
    echo "done";
?>