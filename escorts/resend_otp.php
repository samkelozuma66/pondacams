<?php
    include '../config.php';
    include '../error.php';
    $error ="";
    $user_otp ="";
    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);
    
    $user_otp = rand(100000, 999999);
    $OTP = $user_otp;
    $name = $decoded['full_name'];
    $message = '
    Hi  ' .$name.' Thanks for signing up!  With Pondacams Escort Service , Your OTP: "'.$OTP.'".'; 
    $postdata = http_build_query(
                array(
                        'username' => 'walit',
                        'userid' => '15970',
                        'handle' => '504acd5615a9a9a5362fa6e6b569d295',
                        'msg' => $message,
                        'from' => 'pondacams',
                        'to' => $decoded['phone_number']
                    )
                );
    $response = file_get_contents('https://api.budgetsms.net/sendsms/?'.$postdata, false);
    
    $conn -> updateData("escort",["sms_otp"=> $OTP],["id"=>$_SESSION['id']]);
    $_SESSION['otp'] = $OTP;
    echo $OTP;
?>