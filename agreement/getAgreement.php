<?php
    include 'config.php';
    $user_id = $_POST["user_id"];
    $initials = $_POST["initials"];
    if(!isset($initials))
    {
        $agree = $conn -> getRow("agreement",["user_id" => $user_id]);
        if(!isset($agree[0]))
        {
            
            $conn -> insData("agreement",["user_id" => $user_id]);
            $agree = $conn -> getRow("agreement",["user_id" => $user_id]);
           
        }
        else
        {
            echo json_encode($agree[0]);
        }
    }
    else
    {
        $conn -> updateData("agreement",["initials" => $initials,"date" => date("Y-m-d")],["user_id" => $user_id]);
        echo "DONE";
    }
?>