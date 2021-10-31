<?php 
    include 'config.php';
    $modelId = $_REQUEST["id"];
    $block   = $_REQUEST["blocked"];
    
    //$modelinfo  = $conn -> getRow("modelinfo",["model_id" => $modelId]);
    $xml = $conn -> updateData("modelinfo",["blocked_countries" => $block ],["model_id" => $modelId]);
    echo $xml;
?>
