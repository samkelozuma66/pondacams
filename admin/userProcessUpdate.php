<?php

    include 'config.php';
    $user_id = $_POST["user_id"];
    $process = $_POST["process"];
    $status  = $_POST["status"];
    
    $note  = $_POST["note"];
    $note_type = "";
    if($process == "personal_details")
    {
        $note_type = "personal_note";
    }
    else if ($process == "documents")
    {
        $note_type = "document_note";
    }
    else if ($process == "contract")
    {
        $note_type = "contract_note";
    }
    else if ($process == "payment_details")
    {
        $note_type = "payment_note";
    }
    $conn -> updateData("user_process",[$process => $status,$note_type => $note],["user_id" => $user_id])

?>