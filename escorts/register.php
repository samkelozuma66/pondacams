<?php
include '../config.php';
include '../error.php';
$error ="";
$user_otp ="";

$url1 = "https://countriesnow.space/api/v0.1/countries";
$xml1 = file_get_contents($url1);

$xml = file_get_contents("https://countriesnow.space/api/v0.1/countries/states");
if($_SERVER['REQUEST_METHOD']=='POST'){
    $error = true;
    if(empty($_POST['full_name'])){
        $nameErr = "please input First name";                      
        $error = false;
    }elseif(!preg_match("/^[a-zA-Z0-9 ]*$/", $_POST['full_name'])){
        $error = false;
        $nameErr = "only alphabet and white space allowed";
    }
    
    if(empty($_POST['display_name'])){
        $dnameErr = "please input Display name";                      
        $error = false;
    }elseif(!preg_match("/^[a-zA-Z0-9 ]*$/", $_POST['display_name'])){
        $error = false;
        $dnameErr = "only alphabet and white space allowed";
    }
    
    if(empty($_POST['age'])){
        $ageErr = "please input Age";                      
        $error = false;
    }elseif(!preg_match("/^[0-9 ]*$/", $_POST['age'])){
        $error = false;
        $ageErr = "only Numbers allowed";
    }
    
    if(empty($_POST['gender'])){
        $genderErr = "please Select Gender";                      
        $error = false;
    }
    
    if(empty($_POST['phone_number'])){
        $phoneErr = "please input Phone Number";                      
        $error = false;
    }elseif(!preg_match("/^[0-9_+ ]*$/", $_POST['phone_number'])){
        $error = false;
        $phoneErr = "only + and Numbers allowed";
    }
    
    if(empty($_POST['Address'])){
        $addressErr = "please input Address";                      
        $error = false;
    }
    
    if(empty($_POST['bio'])){
        $bioErr = "please input Bio";                      
        $error = false;
    }
    
    if(empty($_POST['area'])){
        $areaErr = "please input Area";                      
        $error = false;
    }
    
    if(empty($_POST['terms'])){
        $termsErr = "Please Agree to Terms & Conditions";                      
        $error = false;
    }
    
    /* echo "<pre>"; phone_number Address area
    print_r($mail);die; */
    /* */
    /*if(empty($_POST['password'])){
        $error = false;
        $passErr = "password required";
    
    }elseif(empty($_POST['confirm_password'])){
        $error = false;
        $CpassErr = "please confirm password"; 
    }elseif($_POST['password']!=$_POST['confirm_password']){
        $error = false;
        $passErr = "password do not match!!!";
    }    */
  }
if($error){ 
    if(isset($_POST['sendMail'])){
      if($_SERVER['HTTP_HOST']=='pondacams.com'){
        $user_otp = rand(100000, 999999);
        $OTP = $user_otp;
        $name = $_POST['full_name'];
        $message = '
        Hi  ' .$name.' Thanks for signing up!  With Pondacams Escort Service , Your OTP: "'.$OTP.'".'; 
        $postdata = http_build_query(
                    array(
                            'username' => 'walit',
                            'userid' => '15970',
                            'handle' => '504acd5615a9a9a5362fa6e6b569d295',
                            'msg' => $message,
                            'from' => 'pondacams',
                            'to' => $_POST['phone_number']
                        )
                    );
        $response = file_get_contents('https://api.budgetsms.net/sendsms/?'.$postdata, false);
        //echo $response;
        
        /*$email = $_POST['email'];
        $password = $_POST['password'];
        $to      = $email; // Send email to our user
        $subject = 'Signup | Verification'; // Give the email a subject 
        $OTP = $user_otp;
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
        mail($to, $subject, $message); // Send our email*/
      }else{
        $user_otp = 123456;
      }     
    }/*`full_name`, `display_name`, `age`, `gender`, `hair_color`, `eye_color`, `breast_size`, `email`, `phone_number`, 
    `work_address`, `bio`, `country`, `state`, `city`, `area`, `travel`, `available`, `sms_otp`, `verify`*/
    $data = ['full_name'=>$_POST['full_name'],
             'display_name'=>$_POST['display_name'],
             'age'=>$_POST['age'],
             'gender'=>$_POST['gender'],
             'hair_color'=>$_POST['hair'],
             'eye_color'=>$_POST['eyes'],
             'breast_size'=>$_POST['bSize'],
             'email'=>$_POST['email'],
             'phone_number'=>$_POST['phone_number'],
             'work_address'=>$_POST['Address'],
             'bio'=>$_POST['bio'],
             'country'=>$_POST['country'],
             'state'=>$_POST['state'],
             'city'=>$_POST['city'],
             'area'=>$_POST['area'],
             'travel'=>$_POST['travel'],
             'available'=>$_POST['available'],
             'sms_otp'=>$user_otp
             ];
    $done = $conn ->insData('escort',$data);
    //echo "done ".$done;
    if($done){       
      $_SESSION['name'] = $_POST['full_name'];
      $_SESSION['phone_number']=$_POST['phone_number'];
      $_SESSION['id']= $done;
      $_SESSION['otp'] = $user_otp;
      echo "<script> alert('OTP is sent to your Phone Number for verification')</script>";
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
	<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon1.png">
    <title>Pondacam | Signup</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/css/materialdesignicons.min.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.6.55/css/materialdesignicons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- End layout styles -->
    <style>
        .error{
                color : red;
            }
        </style>
    <script>
            var cities = <?php echo json_encode($xml1); ?>;
            var country_code = "<?php if(isset($_POST['country'])){echo $_POST['country']; }?>";
            var citySel = '<?php if(isset($_POST['city'])){echo $_POST['city']; }?>';
            var state = '<?php if(isset($_POST['state'])){echo $_POST['state']; }?>';
            var json = JSON.parse(cities);
            //console.log(json.data)
    </script>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
          <div class="row flex-grow">
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
              <div class="auth-form-transparent text-left p-3">
                <div class="brand-logo" >
                  <img src="../pondacams_red.png" alt="logo">
                </div>
                <h4>Join our escort service today! It takes only few steps</h4>
                <form class="pt-3" method = 'post'>
                  <div class="form-group">
                    <label for="exampleInputEmail">Full Name (Required)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-account-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control form-control-lg border-left-0" name = "full_name" id="full_name"
                       placeholder="Full Name" value = "<?php if(isset($_POST['full_name'])){echo $_POST['full_name']; }?>">
                    </div>
                    <span class = "error"><?php echo $nameErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">Display Name (Required)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-account-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control form-control-lg border-left-0" name = "display_name" id="display_name"
                       placeholder="Display Name" value = "<?php if(isset($_POST['display_name'])){echo $_POST['display_name']; }?>">
                    </div>
                    <span class = "error"><?php echo $dnameErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">Age (Required)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-account-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control form-control-lg border-left-0" name = "age" id="age"
                       placeholder="Age" value = "<?php if(isset($_POST['age'])){echo $_POST['age']; }?>">
                    </div>
                    <span class = "error"><?php echo $ageErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">Gender (Required)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-account-outline text-primary"></i>
                        </span>
                      </div>
                      <select name="gender" id="gender" class="form-control form-control-lg border-left-0"
                              onchange="changeSize(this.value)" 
                      >
                          <option value="female" <?php if(isset($_POST['gender'])){ if ($_POST['gender'] == "female"){echo "selected" ;} }?>>Female</option>
                          <option value="male"   <?php if(isset($_POST['gender'])){ if ($_POST['gender'] == "male"){echo "selected" ;} }?>>Male</option>
                          <option value="other"  <?php if(isset($_POST['gender'])){ if ($_POST['gender'] == "other"){echo "selected" ;} }?>>Other</option>
                      </select>
                    </div>
                    <span class = "error"><?php echo $genderErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">Hair (Required)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-account-outline text-primary"></i>
                        </span>
                      </div>
                      <select name="hair" id="hair" class="form-control form-control-lg border-left-0">
                          <option value="black" <?php if(isset($_POST['hair'])){ if ($_POST['hair'] == "black"){echo "selected" ;} }?>>Black</option>
                          <option value="Blond" <?php if(isset($_POST['hair'])){ if ($_POST['hair'] == "Blond"){echo "selected" ;} }?>>Blond</option>
                          <option value="Brunet"<?php if(isset($_POST['hair'])){ if ($_POST['hair'] == "Brunet"){echo "selected" ;} }?>>Brunet</option>
                      </select>
                    </div>
                    <span class = "error"><?php echo $hairErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">Eyes (Required)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-account-outline text-primary"></i>
                        </span>
                      </div>
                      <select name="eyes" id="eyes" class="form-control form-control-lg border-left-0">
                          <option value="black"    <?php if(isset($_POST['eyes'])){ if ($_POST['eyes'] == "black"){echo "selected" ;} }?>>Black</option>
                          <option value="brownish" <?php if(isset($_POST['eyes'])){ if ($_POST['eyes'] == "brownish"){echo "selected" ;} }?>>Brownish</option>
                          <option value="blue"     <?php if(isset($_POST['eyes'])){ if ($_POST['eyes'] == "blue"){echo "selected" ;} }?>>Blue</option>
                          <option value="green"    <?php if(isset($_POST['eyes'])){ if ($_POST['eyes'] == "green"){echo "selected" ;} }?>>Green</option>
                      </select>
                    </div>
                    <span class = "error"><?php echo $eyesErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail" id="lblBSize">Breast Size (Required)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-account-outline text-primary"></i>
                        </span>
                      </div>
                      <select name="bSize" id="bSize" class="form-control form-control-lg border-left-0">
                          <option value="small"   <?php if(isset($_POST['bSize'])){ if ($_POST['bSize'] == "small"){echo "selected" ;} }?>>Small</option>
                          <option value="normal"  <?php if(isset($_POST['bSize'])){ if ($_POST['bSize'] == "normal"){echo "selected" ;} }?>>Normal</option>
                          <option value="big"     <?php if(isset($_POST['bSize'])){ if ($_POST['bSize'] == "big"){echo "selected" ;} }?>>Big</option>
                          <option value="huge"    <?php if(isset($_POST['bSize'])){ if ($_POST['bSize'] == "huge"){echo "selected" ;} }?>>Huge</option>
                      </select>
                    </div>
                    <span class = "error"><?php echo $bsizeErr ?></span>
                  </div>
				  <div class="form-group">
                    <label>Email(Optional)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-email-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="email" class="form-control form-control-lg border-left-0"name = "email" id="email"
                      placeholder="email" value = "<?php if(isset($_POST['email'])){echo $_POST['email']; }?>">
                    </div>
                    <span class = "error"><?php echo $emailErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">Phone Number (Required)<small>NB: Phone Number with Country Code</small></label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-phone-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control form-control-lg border-left-0" name = "phone_number" id="phone_number"
                       placeholder="Phone Number(+27124567891)" value = "<?php if(isset($_POST['phone_number'])){echo $_POST['phone_number']; }?>">
                    </div>
                    <span class = "error"><?php echo $phoneErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">Working Address (Optional)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-home text-primary"></i>
                        </span>
                      </div>
                      <textarea id="Address" class="form-control form-control-lg border-left-0" name="Address" rows="4" cols="50"
                                placeholder="Address For administration use"
                      ><?php if(isset($_POST['Address'])){echo $_POST['Address']; }?></textarea>
                      <!--<input type="text" class="form-control form-control-lg border-left-0" name = "full_name" id="name"
                       placeholder="Address" value = "<?php if(isset($_POST['full_name'])){echo $_POST['full_name']; }?>">-->
                    </div>
                    <span class = "error"><?php echo $addressErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">Short Bio (Required)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-bio text-primary"></i>
                        </span>
                      </div>
                      <textarea id="bio" class="form-control form-control-lg border-left-0" name="bio" rows="4" cols="50"
                                placeholder="Short Intro for Customers"
                      ><?php if(isset($_POST['bio'])){echo $_POST['bio']; }?></textarea>
                      <!--<input type="text" class="form-control form-control-lg border-left-0" name = "full_name" id="name"
                       placeholder="Address" value = "<?php if(isset($_POST['full_name'])){echo $_POST['full_name']; }?>">-->
                    </div>
                    <span class = "error"><?php echo $bioErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">Country (Required)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-earth text-primary"></i>
                        </span>
                      </div>
                      <select name="country" id="country" class="form-control form-control-lg border-left-0" onchange="getState(this.value)">
                          
                          <?php 
                                $country   = $conn -> getRow("country");
                                //$modelinfo = $conn -> getRow("modelinfo",["model_id" => $_SESSION['id']]);
                                foreach($country as $ind => $row)
                                {
                                    //$blonkedCountry = $modelinfo[0]["country_code"];
                                    $selected = "";
                                    //if(isset($_POST['bio'])){echo $_POST['bio']; }
                                    if(isset($_POST['country']) && $_POST['country'] == $row["code"] )
                                    {
                                        $selected = "selected";
                                    }
                                    echo '<option value="'.$row["code"].'" '.$selected.'>'.$row["name"].'</option>';
                                    
                                }
                            ?>
                          
                      </select>
                      
                    </div>
                    <span class = "error"><?php echo $countryErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">State/ Province (Required)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-earth text-primary"></i>
                        </span>
                      </div>
                      <select name="state" id="state" class="form-control form-control-lg border-left-0">
                      </select>
                      <!--<input type="text" class="form-control form-control-lg border-left-0" name = "full_name" id="name"
                       placeholder="Phone Number" value = "<?php if(isset($_POST['full_name'])){echo $_POST['full_name']; }?>">-->
                    </div>
                    <span class = "error"><?php echo $stateErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">City (Required)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-city text-primary"></i>
                        </span>
                      </div>
                      <select name="city" id="city" class="form-control form-control-lg border-left-0">
                      </select>
                      <!--<input type="text" class="form-control form-control-lg border-left-0" name = "full_name" id="name"
                       placeholder="Phone Number" value = "<?php if(isset($_POST['full_name'])){echo $_POST['full_name']; }?>">-->
                    </div>
                    <span class = "error"><?php echo $cityErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword">Area (Required)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-earth text-primary"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control form-control-lg border-left-0" name = "area" id="area" placeholder="Area"
                      value = "<?php if(isset($_POST['area'])){echo $_POST['area']; }?>">            
                    </div>
                    <span class = "error"><?php echo $areaErr ?></span>  
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">Travel (Required)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-car text-primary"></i>
                        </span>
                      </div>
                      <select name="travel" id="travel" class="form-control form-control-lg border-left-0">
                          <option value="1" <?php if(isset($_POST['travel'])){ if($_POST['travel'] == "1" ){echo "selected";}}?>>Yes</option>
                          <option value="0" <?php if(isset($_POST['travel'])){ if($_POST['travel'] == "0" ){echo "selected";}}?>>No</option>
                      </select>
                    </div>
                    <span class = "error"><?php echo $travelErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">Available (Required)</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-clock text-primary"></i>
                        </span>
                      </div>
                      <select name="available" id="available" class="form-control form-control-lg border-left-0">
                          <option value="always"   <?php if(isset($_POST['available'])){ if($_POST['available'] == "always" ){echo "selected";}}?>>Always</option>
                          <option value="weekdays" <?php if(isset($_POST['available'])){ if($_POST['available'] == "weekdays" ){echo "selected";}}?>>WeekDays</option>
                          <option value="weekends" <?php if(isset($_POST['available'])){ if($_POST['available'] == "weekends" ){echo "selected";}}?>>Weekends</option>
                      </select>
                    </div>
                    <span class = "error"><?php echo $availErr ?></span>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input" name="terms" id="terms"> I agree to all Terms & Conditions 
						            <i class="input-helper"></i></label>
                    </div>
                    
                  </div>
                  <span class = "error"><?php echo $termsErr ?></span>
                  <div class="my-3">
                    <button type = "submit" name = "sendMail" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >CREATE  ACCOUNT</button>
                  </div>
                  
                  <!--<div class="text-center mt-4 font-weight-light"> Already have an account? 
				           <a href="login.php" class="text-primary">Login</a>
                  </div>-->
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
    <script>
            function changeSize(size)
            {
                var lblBSize = document.getElementById("lblBSize");
                
                if(size == "male")
                {
                    lblBSize.innerHTML = "Dick Size (Required)";
                }
                else
                {
                    lblBSize.innerHTML = "Breast Size (Required)";
                }
            }
            function getState(country_id)
            {
                $('#state').empty();
                //getCountry.php
                var xhttp = new XMLHttpRequest();
                var formData = new FormData();
                formData.append("code",country_id);
                //const countryJson = "";
                xhttp.onreadystatechange = function ()
                {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        var response = this.responseText;
                        console.log(response);
                        var countryJson = JSON.parse(response);
                        var x = document.getElementById("state");
                        var opt = document.createElement("option");
                        opt.text = "Select Province or State";
                        opt.value = "Default";
                        x.add(opt);
                        //state
                        //city
                        for(var i = 0; i < countryJson.length; i++) 
                        {
                            var obj = countryJson[i];
                            
                            var option = document.createElement("option");
                            option.text = obj.name;
                            option.value = obj.state_code;
                            if(state == obj.state_code)
                            {
                                option.selected = true;
                            }
                            x.add(option);
                            
                            //console.log(obj.name);
                        }
                        getCities(country_id);
                         
                    }
                }; 
                xhttp.open("POST", "../model/getCountry.php", true);
                xhttp.send(formData); 
            }
            function getStateLoad()
            {
                //alert(country_code);
                if(country_code !== "0" && country_code !== null && country_code !== "")
                {
                    getState(country_code);
                }
            }
            function getCities(country_id)
            {
                $('#city').empty();
                
                var country  = $( "#country option:selected" ).text();
                //var country = document.createElement("countrySelect").value;
                var province = $( "#state option:selected" ).text();
                var x = document.getElementById("city");
                var opt = document.createElement("option");
                opt.text = "Select City";
                opt.value = "Default";
                x.add(opt);
                json.data.forEach(function(item)
                {
                    if(item.country == country)
                    {
                        item.cities.forEach(function(city)
                        {
                            var option = document.createElement("option");
                            option.text = city;
                            option.value = city;
                            if(citySel == city)
                            {
                                option.selected = true;
                            }
                            x.add(option);
                        })
                        
                    }
                    
                });
                //console.log(json.data);
            }
            getStateLoad();
        </script>
  
</body>
</html>