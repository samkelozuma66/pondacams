<?php
include '../config.php';
include '../error.php';
$OTPErr = "";
$error = "";
//print_r($_SESSION['otp']);die;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $error = true;
    if(empty($_POST['otp'])){
       $error = false;
        $OTPErr = "Input OTP";
    }elseif($_POST['otp']==$_SESSION['otp']){
    $error = true;
    }else{
    $error = false;
    $OTPErr = "INVALID OTP";
    }
    if($error){
      $conn -> updateData("escort",["verified"=> 1],["id"=>$_SESSION['id']]);
      echo "<script>window.location.href='index.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pondacam </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/css/materialdesignicons.min.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.6.55/css/materialdesignicons.min.css">
    <!-- End layout styles -->
    <style>
      .error{
        color:red;
      }
    </style>
   
    <script>
        function send_otp()
        {
            fetch("resend_otp.php", {
                method:"POST",
                body: JSON.stringify({
                    full_name: "<?php echo $_SESSION['name']?>",
                    phone_number: "<?php echo $_SESSION['phone_number']?>",
                    id: "<?php echo $_SESSION['id']?>"
                    })
                })
                .then(response => response.json())
                .then(result => {
                    // do something with the result
                    console.log(result);
                    alert("New OTP sent to : <?php echo $_SESSION['phone_number']?> ");
                }).catch(err => {
                    // if any error occured, then catch it here
                    alert(err);
                });
            
        }
    </script>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
          <div class="row flex-grow">
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
              <div class="auth-form-transparent text-left p-3">
                <div class="brand-logo">
                  <img src="../pondacams_red.png" alt="logo">
                </div>
                
                <h6 class="font-weight-light">Input Valid OTP </h6>
                <form class="pt-3" method = "post">                 
                  <div class="form-group">
                    <label for="exampleInputPassword">OTP</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-lock-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="password" name="otp" id="" class="form-control form-control-lg border-left-0" id="exampleInputPassword"
                      value = "" placeholder="......">             
                    </div>
                    <div><span class = "error"><?php echo $OTPErr?> </span></div>
                    <div class="my-3">
                        <p style="text-align:center;"><a href="#" onclick="send_otp()" style="color:red;">Resend OTP</a></p>
                       <button type = "submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >Submit</button>
                    </div>
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
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
  
</body>
</html>