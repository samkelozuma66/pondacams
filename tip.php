<?php
    include 'config.php';
    $USER_ID = $_REQUEST["USER_ID"];
    $CHATUSER_ID = $_REQUEST["CHATUSER_ID"];
    $AMOUNT = $_REQUEST["AMOUNT"];
    $DATE   = date("Y-m-d");
    $conn -> insData("tokenTransfer",['user_id' => $USER_ID, 'chatuser_id' => $CHATUSER_ID, 'amount' => $AMOUNT , 'date' => $DATE]);
    //$resp = {"USER_ID":"'.$USER_ID.'","CHATUSER_ID":"'.$CHATUSER_ID.'"};
    $myObj = (object)[];
    $myObj->USER_ID =$USER_ID;
    $myObj->CHATUSER_ID = $CHATUSER_ID;
    $myObj->AMOUNT = $AMOUNT;

    $myJSON = json_encode($myObj);
    echo $myJSON;
    //INSERT INTO `tokenTransfer` (`id`, `user_id`, `chatuser_id`, `amount`, `date`) VALUES (NULL, '26', '109', '15', '2021-08-15');
    //https://pondacams.com/tip.php?USER_ID=109&CHATUSER_ID=26&AMOUNT=20
?>