<?php
include 'config.php';
include 'error.php';
$error ="";
$user_otp ="";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $error = true;
    if(empty($_POST['full_name'])){
        $nameErr = "please input First name";                      
        $error = false;
    }elseif(!preg_match("/^[a-zA-Z0-9 ]*$/", $_POST['full_name'])){
        $error = false;
        $nameErr = "only alphabet and white space allowed";
    }
    $mail = $conn->getRow('users',['email'=>$_POST['email']]);
    if(empty($_POST['email'])){
        $error = false;
        $emailErr = "input field required";
    }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $error = false;
        $emailErr = "Invalid email format";
    }elseif(count($mail)>0){
      $error = false;
      $emailErr = "Email Already Exist!!!!";
    }
    /* echo "<pre>";
    print_r($mail);die; */
    /* */
    if(empty($_POST['password'])){
        $error = false;
        $passErr = "password required";
    
    }elseif(empty($_POST['confirm_password'])){
        $error = false;
        $CpassErr = "please confirm password"; 
    }elseif($_POST['password']!=$_POST['confirm_password']){
        $error = false;
        $passErr = "password do not match!!!";
    }    
  }
if($error){ 
    if(isset($_POST['sendMail'])){
      if($_SERVER['HTTP_HOST']=='pondacams.com'){
        $user_otp = rand(100000, 999999);
        $email = $_POST['email'];
        $name = $_POST['full_name'];
        $password = $_POST['password'];
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
      }else{
        $user_otp = 123456;
      }     
    }
    $data = ['name'=>$_POST['full_name'],'email'=>$_POST['email'],'password'=>$_POST['password'],'email_otp'=>$user_otp];
    $done = $conn ->insData('users',$data);
    if($done){       
      $_SESSION['name'] = $_POST['full_name'];
      $_SESSION['email']=$_POST['email'];
      $_SESSION['id']= $done;
      $_SESSION['otp'] = $user_otp;
      echo "<script> alert('OTP is sent to your email for verification')</script>";
      echo "<script>window.location.href='verify_otp.php'</script>";
    }      
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon1.png">
    <title>Pondacam | Signup</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.6.55/css/materialdesignicons.min.css">
    <!-- End layout styles -->
    <style>
        .error{
                color : red;
            }
        </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
          <div class="row flex-grow">
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
              <div class="auth-form-transparent text-left p-3">
                <div class="brand-logo" >
                  <img src="pondacams_red.png" alt="logo">
                </div>
                <h4>Join us today! It takes only few steps</h4>
                <form class="pt-3" method = 'post'>
                  <div class="form-group">
                    <label for="exampleInputEmail">Name</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-account-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control form-control-lg border-left-0" name = "full_name" id="name"
                       placeholder="username" value = "<?php if(isset($_POST['full_name'])){echo $_POST['full_name']; }?>">
                    </div>
                    <span class = "error"><?php echo $nameErr ?></span>
                  </div>
				          <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-email-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="email" class="form-control form-control-lg border-left-0"name = "email" id="email"
                      value = "<?php if(isset($_POST['email'])){echo $_POST['email']; }?>">
                    </div>
                    <span class = "error"><?php echo $emailErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-lock-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="password" class="form-control form-control-lg border-left-0" name = "password" id="password" placeholder="Enter your password"
                      value = "<?php if(isset($_POST['password'])){echo $_POST['password']; }?>">            
                    </div>
                    <span class = "error"><?php echo $passErr ?></span>  
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword">Confirm Password</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-lock-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="password" class="form-control form-control-lg border-left-0" name = "confirm_password" id="password" placeholder="Confirm your password"
                      value = "<?php if(isset($_POST['confirm_password'])){echo $_POST['confirm_password']; }?>"> 
                    </div>
                    <span class = "error"><?php echo $CpassErr ?></span>  
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions 
						            <i class="input-helper"></i></label>
                    </div>
                  </div>
                  <div class="my-3">
                    <button type = "submit" name = "sendMail" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >CREATE  ACCOUNT</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? 
				           <a href="login.php" class="text-primary">Login</a>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-6 login-half-bg d-flex flex-row">
              <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2020 All rights reserved.</p>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
  
</body>
</html>