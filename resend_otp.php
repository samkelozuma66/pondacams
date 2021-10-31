<?php
    include 'config.php';
    include 'error.php';
    $error ="";
    $user_otp ="";
    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);
    $user_otp = rand(100000, 999999);
    $email = $decoded["email"];
    $name = $decoded['full_name'];
    $password = $decoded['password'];
    $to      = $email; // Send email to our user
    $subject = 'Signup | Verification'; // Give the email a subject 
    $OTP = $user_otp;
    $from       = 'admin@pondacams.com'; 
    $fromName   = 'Pondacams Admin'; 
    
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    // Additional headers 
    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
    
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    
    $message = '
    Hi  "' .$name.'" 
    Thanks for signing up!
    
    OTP: "'.$OTP.'".
      
    ------------------------
    OTP : "'.$OTP.'"
    Email: "' .$email.'"
    Password: "' .$password.'"
    ------------------------
    '; 
                
    //$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
    mail($to, $subject, $message,$headers); // Send our email
    $conn -> updateData("users",["email_otp"=> $OTP],["id"=>$_SESSION['id']]);
    $_SESSION['otp'] = $OTP;
    echo $OTP;
?>