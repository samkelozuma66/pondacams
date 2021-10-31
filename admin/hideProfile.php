<?php
    include 'config.php';
    
    $id     = $_POST["user_id"];
    $reason = $_POST["reason"];
    $hidden = $_POST["hidden"];
    
    echo $hidden;
    $conn->updateData("escort",["hidden"=>$hidden,"hide_reason"=>$reason],["id"=>$id]);
    if($reason == "payment_overdue")
    {
        $user = $conn->getRow("escort",["id"=>$id]);
        $name = $user[0]['full_name'];
        $message = '
        Hi  ' .$name.' Your Profile with Pondacams Escorts ,Has been suppended due to NO PAYMENT RECEIVED. Please send us a whatsapp on +27818067263 from your registered contact number for more information '; 
        $postdata = http_build_query(
                    array(
                            'username' => 'walit',
                            'userid' => '15970',
                            'handle' => '504acd5615a9a9a5362fa6e6b569d295',
                            'msg' => $message,
                            'from' => 'pondacams',
                            'to' => $user[0]['phone_number']
                        )
                    );
        $response = file_get_contents('https://api.budgetsms.net/sendsms/?'.$postdata, false);
    
    }
    
    
?>