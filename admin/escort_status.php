<?php
include 'config.php';
$model = $conn->getRow('escort',['id'=>$_POST['id']]);

$conn->updateData('escort',$_POST,['id'=>$_POST['id']]);
if($_POST["status"] == "approved")
{
    sendMail($conn,$_POST['id']);
    
    $nextPay = date("Y-m-d",strtotime("+3 month"));
    $conn -> insData("escort_payment",["escort_id"=>$_POST['id'],"due_date"=>$nextPay]);
    
}
function sendMail($con,$ref)
{
    $user       = $con->getRow('escort',['id'=>$_POST['id']]);
    //$user_otp = rand(100000, 999999);
    //$OTP = $user_otp;
    $name = $user[0]['full_name'];
    $message = '
    Hi  ' .$name.' Your Application with Pondacams Escorts ,Has been approved you are now listed and ready to earn. Your user reference id "'.$ref.'". Please send us a whatsapp on +27818067263 from your registered contact number with the following : Profile Image (Landscape), Five Sexy stunning pictures and a 10 seconds intro video clip. include your user reference '; 
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