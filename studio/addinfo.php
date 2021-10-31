<?php
include 'config.php';
$error = "";
$data = [];
$respnse_array= [];
$respnse_array['test'] = "test";
header('Content-type: application/json');
if(!empty($_POST)){
    
    $error = true;
    if(isset($_POST['parent_id'])){$data['parent_id'] = $_POST['parent_id'];}
    if(isset($_POST['name'])){$data['name'] = $_POST['name'];}
    if(isset($_POST['email'])){
        $data['email'] = $_POST['email'];
        $checkmail = $conn->getRow('users',['id'=>$data['email']]);
        if(count($checkmail)>0){
            $respnse_array['insertmailErr'] = "ERROR!!!";
            $error = false;
        }
    }
    if(isset($_POST['password'])){$data['password'] = $_POST['password'];}
    if(isset($_POST['d_name'])){$data['d_name'] = $_POST['d_name'];}
    if(isset($_POST['l_name'])){$data['l_name'] = $_POST['l_name'];}
    if(isset($_POST['gender'])){$data['gender'] = $_POST['gender'];}
    if(isset($_POST['dob'])){$data['dob'] = $_POST['dob'];}
    if(isset($_POST['country'])){$data['country'] = $_POST['country'];}
    if(isset($_POST['id_number'])){$data['id_number'] = $_POST['id_number'];}
    if(isset($_POST['id'])){$data['id'] = $_POST['id'];}
    $data['registration_type'] = 'individual';
    
$respnse_array['error'] = "$error";
$respnse_array['data']  = $data;
    if($error){
        $respnse_array['model_id'] = $conn->insData('users',$data);
    }
    if(!empty($data['id'])){
        //$respnse_array['insideupdate'] = "INSIDE";
        /* if(isset($_POST['email'])){
            $data['email'] = $_POST['email'];
            $check1 = $conn->getRow('users',['id'=>$data['id']]);
            if(isset($check1[0])){
                $checkmail = $conn->getRow('users',['id'=>$data['email']]);
                if($data['email']==$check1[0]['email']){}
                elseif(count($checkmail)>0){
                    $respnse_array['updatemailErr'] = "ERROR!!!";
                    $error = false;
                }
            }           
        } */
        /* if($error){ */
            unset($data['email']);
            $respnse_array['updated'] = $conn->updateData('users',$data,['id'=>$data['id']]);
            $respnse_array['model_id']=$data['id'];
       /*  }  */      
    } 
    if(!empty($_FILES)){
        if(isset($_FILES['id_front']['name'])){
            $images['id_front']=time() .$_FILES['id_front']['name'];
            move_uploaded_file($_FILES['id_front']['tmp_name'], '../documents/' .time() .$_FILES['id_front']['name']);
        }
        if(isset($_FILES['id_back']['name'])){
            $images['id_back']=time() .$_FILES['id_back']['name'];
            move_uploaded_file($_FILES['id_back']['tmp_name'], '../documents/' .time() .$_FILES['id_back']['name']);
        }
        if(isset($_FILES['face_id']['name'])){
            $images['face_id']=time() .$_FILES['face_id']['name'];
            move_uploaded_file($_FILES['face_id']['tmp_name'], '../documents/' .time() .$_FILES['face_id']['name']);
        }
        if(isset($_FILES['selfie']['name'])){
            $images['selfie']=time() .$_FILES['selfie']['name'];
            move_uploaded_file($_FILES['selfie']['tmp_name'], '../documents/' .time() .$_FILES['selfie']['name']);
        }
        $conn->updateData('users',$images,['id'=>$_POST['id']]);
        $msg = "Model Application";
        sendMail($conn);
        
    }
    
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
                        <title>New Model Application </title> 
                    </head> 
                    <body> 
                        <div style="background-color:red;"><img src="https://www.pondacams.com/images/logo-compact2.png" width="50%"></div>
                        <h4>Hi <b>'.$user[0]["d_name"].'</b>, </h4>
                        <h5>Welcome to Pondacams :</5>
                        <h5><b>You have been registered under '.$_SESSION["name"].'</b></h5> 
                        <p><b>Username :</b>'.$user[0]["email"].'</p>
                        <p><b>Please complete your registration by clicking the link below :</b></p>
                        <p><a href="https://www.pondacams.com/model">PONDACAMS MODEL LOGIN</a></p>
                        <div><h3>Regards </h3><br /><h4> '.$fromName.'</h4> </div>
                    </body> 
                    </html>'; 
        
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
     
    // Additional headers 
    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
    //$headers .= 'Cc:'.$username.'' . "\r\n"; 
    //$headers .= 'Bcc: welcome2@example.com' . "\r\n"; 

    // Send email 
    if(mail($to, $subject, $htmlContent, $headers)){ 
        // 'Email has sent successfully.'; 
        echo "mail sent";
    }else{ 
       echo 'Email sending failed.'; 
    }
}
echo json_encode($respnse_array);
?>