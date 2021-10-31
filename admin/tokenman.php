<?php 
    include 'config.php';
    
    $ID             = $_REQUEST["ID"];
    $DESCRIPTION    = $_REQUEST["DESCRIPTION"];
    $VALUE          = $_REQUEST["VALUE"];
    $DISCOUNT       = $_REQUEST["DISCOUNT"];
    $TOKENS         = $_REQUEST["TOKENS"];
    $ACTION         = $_REQUEST["ACTION"];
    
    if($ACTION == "SAVE")
    {
        echo $DESCRIPTION;
        $conn -> updateData("tokenOptions",["description" => $DESCRIPTION  ,
                            "value" => $VALUE,
                            "discount" => $DISCOUNT,
                            "tokens" => $TOKENS],["id" => $ID]);
        echo 'SAVED';
    }
    elseif($ACTION == "DELETE")
    {
        $conn -> deleteRow("tokenOptions",["id" => $ID]);
        echo 'DELETED';
    }
    
?>