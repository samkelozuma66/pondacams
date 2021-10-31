<?php
include 'config.php';
$model = $conn->getRow('users',['id'=>$_POST['id']]);
if($model[0]['registration_type'] == 'individual')
{
    $modelinfo = $conn->getRow('modelinfo',['model_id'=>$_POST['id']]);
    if(!isset($modelinfo[0]))
    {
        $conn->insData('modelinfo',['model_id'=>$_POST['id']]);
    }
}
$conn->updateData('users',$_POST,['id'=>$_POST['id']]);
if($_POST["status"] == "approved")
{
    sendMail($conn);
}
function sendMail($con)
{
    $user       = $con->getRow('users',['id'=>$_POST['id']]);
    $to         = $user[0]["email"]; 
    $from       = 'admin@pondacams.com'; 
    $fromName   = 'Pondacams Admin'; 
    $subject    = "Model Created : ".$user[0]["name"] ; 
    $temp_sub   = $subject;
    

    $htmlContent = ' 
                    <html> 
                    <head> 
                        <title>Application Approved</title> 
                    </head> 
                    <body> 
                        <div style="background-color:red;"><img src="https://www.pondacams.com/images/logo-compact2.png" width="50%"></div>
                        <h4>Congratulations <b>'.$user[0]["d_name"].'</b>, </h4>
                        <h5>Your Application was Approved :</5>
                        <h5><b>Please click on the link below and login to your account and update profile data to Start Streaming</b></h5> 
                        <p><a href="https://www.pondacams.com/model">PONDACAMS MODEL LOGIN</a></p>
                        <div><h3>Regards </h3><br /><h4> '.$fromName.'</h4> </div>
                    </body> 
                    </html>'; 
        
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    // Additional headers 
    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
    if($user[0]["parent_id"] !== "0")
    {
        $studio       = $con->getRow('users',['id'=>$user[0]["parent_id"]]);
        $headers .= 'Cc:'.$studio[0]["email"].'' . "\r\n";
    }
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
     
    
     
    //$headers .= 'Bcc: welcome2@example.com' . "\r\n"; 

    // Send email 
    if(mail($to, $subject, $htmlContent, $headers)){ 
        // 'Email has sent successfully.'; 
        echo "mail sent";
    }else{ 
       echo 'Email sending failed.'; 
    }
}
?>