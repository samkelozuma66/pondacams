<?php
include 'config.php';
if(!isset($_SESSION['name'])){	
	echo "<script>window.location.href='../login.php'</script>";
}else{
	$row = $conn->getRow('users',['id'=>$_SESSION['id']]);
	if($row[0]['user_type']==1 || $row[0]['registration_type']!='company'){
		echo "<script>window.location.href='../login.php'</script>";
	}
	elseif($row[0]['status'] !='approved'){
	  echo "<script>window.location.href='../registerUpdate.php'</script>";
	}
}
if(isset($_GET['edit'])){
    $profile = $conn->getRow('users',['id'=>$_GET['edit']]);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon1.png">
        <title>Pondacam | Edit Account</title>
        <link rel="stylesheet" href="assets/css/stepForm.css">
        <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/img-upload.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.6.55/css/materialdesignicons.min.css">
    <style>
        
    </style>
    
	<script src="https://use.fontawesome.com/0f43fe6a33.js"></script>
    </head>
    <body>
        <div class="container-scroller">
        <input type="hidden" id = "img1" value = "<?php if(isset($profile[0])){ echo $profile[0]['id_front'];} ?>">
        <input type="hidden" id = "img2" value = "<?php if(isset($profile[0])){ echo $profile[0]['id_back'];} ?>">
        <input type="hidden" id = "img3" value = "<?php if(isset($profile[0])){ echo $profile[0]['face_id'];} ?>">
        <input type="hidden" id = "img4" value = "<?php if(isset($profile[0])){ echo $profile[0]['selfie'];} ?>">
        <input type='hidden' id = 'model_id' value = "<?php if(isset($_GET['edit'])){echo $_GET['edit'];}?>">
            <!-- partial:partials/_navbar.html -->
            <?php include 'topbar.php'; ?>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
				<ul class="nav">
                    <li class="nav-item">
                       <a class="nav-link" href="home.php"><span class="menu-title">Home</span><i class="mdi mdi-home menu-icon"></i></a>
                    </li>
					<li class="nav-item active">
						<a class="nav-link" href="models.php"><span class="menu-title">Models</span> <i class="mdi mdi-account-multiple menu-icon "></i> </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php"> <span class="menu-title">Statistic</span> <i class="mdi mdi-chart-line menu-icon "></i> </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="profile.php"> <span class="menu-title">Personal Data</span> <i class="mdi mdi-settings menu-icon "></i> </a>
					</li>
					<li class="nav-item">
                      <a class="nav-link" href="tipHistory.php" > <span class="menu-title">Earnings</span>  <i class="mdi mdi-buffer menu-icon"></i> </a>
        			
                    </li>
					<!--<li class="nav-item">
						<a class="nav-link" href="#"> <span class="menu-title">Member Referral</span> <i class="mdi mdi-bullhorn menu-icon "></i> </a>
					</li></-->
					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#helpinfo" aria-expanded="false" aria-controls="page-layouts"> <span class="menu-title">Help & Info </span> <i class="menu-arrow"></i> <i class="mdi mdi-information-outline menu-icon"></i> </a>
						<div class="collapse" id="helpinfo">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link" href="#">Contact</a></li>
								<li class="nav-item"> <a class="nav-link" href="#">Chat</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</nav>
              <!-- partial -->
              <div class="main-panel">
                <div class="content-wrapper">
                  <div class="row">
                    <div class="col-12 grid-margin">
                      <div class="card">
                        <div class="card-body">
                            <form id="msform">
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active">Account and Personal Detail</li>
                                    <li>Upload Personal Documents</li>
                                    <li>Application Completed</li>
                                </ul>
                                <fieldset>
                                     <h4 class="mb-4">Account and Personal Detail</h4>
                                    <div class="row"> 
                                        <div class="form-group col-sm-6">                
                                            <label for="exampleInputEmail">Display Name</label>
                                            <p class="mb-0"><small>Enter model name</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="name" name ="name" placeholder="Name"
                                                value = "<?php if(isset($profile[0])){ echo $profile[0]['name'];} ?>">
                                            </div>
                                            <span class = "error" id = "nameErr"></span>
                                        </div> 
                                        <div class="form-group col-sm-6">                
                                            <label for="exampleInputEmail">Email</label>
                                            <p class="mb-0"><small>Enter Model Email </small></p>
                                            <div class="input-group">
                                                <input type="text" <?php if(isset($_GET['edit'])){ echo 'disabled';} ?> class="form-control form-control-lg"id="email" name ="email" placeholder="Email"
                                                value = "<?php if(isset($profile[0])){ echo $profile[0]['email'];} ?>">
                                            </div>
                                            <span class = "error" id = "emailErr"></span>
                                        </div>
                                        <div class="form-group col-sm-6">                
                                            <label for="exampleInputEmail">Password</label>
                                            <p class="mb-0"><small>Enter Model Password</small></p>
                                            <div class="input-group">
                                                <input type="password" class="form-control form-control-lg" id="password" name ="password" placeholder="password....."
                                                value = "<?php if(isset($profile[0])){ echo $profile[0]['password'];} ?>">
                                            </div>
                                            <span class = "error" id = "passwordErr"></span>
                                        </div>
                                        <div class="form-group col-sm-6">                
                                            <label for="exampleInputEmail">Confirm Password</label>
                                            <p class="mb-0"><small>Confirm Model Password</small></p>
                                            <div class="input-group">
                                                <input type="password" class="form-control form-control-lg"id="cpassword" name ="cpassword" placeholder="confirm password....."
                                                value = "<?php if(isset($profile[0])){ echo $profile[0]['password'];} ?>">
                                            </div>
                                            <span class = "error" id = "cpasswordErr"></span>
                                        </div>
                                        <div class="form-group col-sm-6" style="display:none;">
                                            <input type="hidden" id = "parentid" value = "<?php if(isset($_SESSION['id'])){ echo $_SESSION['id'];} ?>">
                                            <label for="exampleInputEmail">Display Name</label>
                                            <p class="mb-0"><small>Choose an appropriate display name to go online</small></p>
                                            <div class="input-group">
                                            <input type="text" class="form-control form-control-lg"  id="d_name" name ="d_name" placeholder="Display name"
                                            value = "<?php if(isset($profile[0])){ echo $profile[0]['d_name'];} ?>" >
                                            </div>
                                            <span class = "error" id = "d_nameErr"></span>
                                        </div>
                                        <div class="form-group col-sm-6">                
                                            <label for="exampleInputEmail">Legel Name</label>
                                            <p class="mb-0"><small>Model legal name same as  on model id</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg"id="l_name" name ="l_name" placeholder="Legal Name"
                                                value = "<?php if(isset($profile[0])){ echo $profile[0]['l_name'];} ?>">
                                            </div>
                                            <span class = "error" id = "l_nameErr"></span>
                                        </div>
                                        
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Gender</label>
                                            <p class="mb-0"><small>Gender on model id card</small></p>
                                            <div class="input-group">
                                                <select class="form-control form-control-lg" name = "gender" id = "gender">
                                                    <option value="" >Select Sex</option>
                                                    <option value="female" <?php if(isset($profile[0]) AND $profile[0]['gender'] == 'female'){ echo "selected" ;} ?>>Female</option>
                                                    <option value="male"<?php if(isset($profile[0]) AND $profile[0]['gender'] == 'male'){ echo "selected" ;} ?>>Male</option>
                                                    <option value="others"<?php if(isset($profile[0]) AND $profile[0]['gender'] == 'others'){ echo "selected" ;} ?>>Others</option>
                                                </select>													
                                            </div>
                                            <span class = "error" id = "genErr"></span>					
                                        </div>					  
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Date of Birth</label>
                                            <p class="mb-0"><small>Model date of birth, same as on model id card</small></p>
                                            <div class="input-group">								
                                            <input type="date" id="dob" name = "dob" class="form-control form-control-lg"
                                            value = "<?php if(isset($profile[0])){ echo $profile[0]['dob'];} ?>">
                                            </div>
                                            <span class = "error" id = "dobErr"></span>
                                        </div>
                                    
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Country</label>
                                            <p class="mb-0"><small>Model Country must be the same where your ID has been issued</small></p>
                                            <div class="input-group">
                                                <select class="form-control form-control-lg" name="country" id="country">
                                                    <option value = "">Select country</option>
                                                    <?php $conRow = $conn->getRow('tbl_countries');
                                                    foreach($conRow as $country){
                                                    ?>                                    
                                                    <option value="<?php echo  $country['name'] ?>"<?php if(isset($profile[0]) AND $profile[0]['country'] == $country['name']){ echo "selected" ;} ?>><?php echo  $country['name'] ; ?></option>
                                                <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>	
                                            <div><span class = "error" id = "contErr"></span></div>
                                        </div>
                            
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">ID Number</label>
                                            <p class="mb-0"><small>Your ID Number</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="id_number" name = "id_number" placeholder="Type your ID number here"
                                                value = "<?php if(isset($profile[0])){ echo $profile[0]['id_number'];} ?>">
                                            </div>
                                            <span class = "error" id = "idNErr"></span>
                                        </div>
                                    </div>
                                    <input type="button" name="next" id="next-1" class="next btn btn-primary" value="Next" />
                                </fieldset>                                
                                <fieldset>
                                    
                                    <h4 class="mb-4">Upload Personal Documents</h4>
                                    <div class="row">  
                                        <div class="col-lg-6 grid-margin stretch-card">
                                            <div class="card">
                                                    <!-- Upload image input-->
                                                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                                    <input id="fid" type="file" onchange="readURL(this,'show_front_id');" class="form-control border-0" 
                                                    value = "<?php if(isset($profile[0])){ echo $profile[0]['id_front'];} ?>">
                                                    <div class="input-group-append">
                                                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> 
                                                        <i class="mdi mdi-cloud-upload mr-2 text-muted"></i>
                                                        <small class="text-uppercase font-weight-bold text-muted">ID FRONT</small></label>
                                                    </div>
                                                </div>
                                                    <!-- Uploaded image area-->
                                                <div class="image-area mt-4">
                                                    <img id="show_front_id" src="../documents/<?php if(isset($profile[0])){ echo $profile[0]['id_front'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block">
                                                </div>
                                                <span class = "error" id = "fidErr"></span>
                                            </div>
                                            
                                        </div>						  
                                        <div class="col-lg-6 grid-margin stretch-card">
                                            <div class="card">
                                                <!-- Upload image input-->
                                                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                                    <input id="bid" type="file" onchange="readURL(this,'show_back_id');" class="form-control border-0"
                                                    value = "<?php if(isset($profile[0])){ echo $profile[0]['id_back'];} ?>">
                                                    <div class="input-group-append">
                                                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> 
                                                        <i class="mdi mdi-cloud-upload mr-2 text-muted"></i>
                                                        <small class="text-uppercase font-weight-bold text-muted">ID BACK</small></label>
                                                    </div>
                                                </div>
                                                <!-- Uploaded image area-->
                                                <div class="image-area mt-4">
                                                    <img id="show_back_id" src="../documents/<?php if(isset($profile[0])){ echo $profile[0]['id_back'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block">
                                                </div>
                                                <span class = "error" id = "bidErr"></span>
                                            </div>
                                            
                                        </div>																	  
                                        <div class="col-lg-6 grid-margin stretch-card">
                                            <div class="card">
                                                <!-- Upload image input-->
                                                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                                    <input id="fandid" type="file" onchange="readURL(this,'show_face_id');" class="form-control border-0"
                                                    >
                                                    <div class="input-group-append">
                                                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> 
                                                        <i class="mdi mdi-cloud-upload mr-2 text-muted"></i>
                                                        <small class="text-uppercase font-weight-bold text-muted">FACE & ID</small></label>
                                                    </div>
                                                </div>
                                                <!-- Uploaded image area-->
                                                <div class="image-area mt-4">
                                                <img id="show_face_id" src="../documents/<?php if(isset($profile[0])){ echo $profile[0]['face_id'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block">
                                                </div>
                                                <span class = "error" id ="faceidErr"></span>
                                            </div>
                                            
                                        </div>						  						  
                                        <div class="col-lg-6 grid-margin stretch-card">
                                            <div class="card">
                                                <!-- Upload image input-->
                                                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                                    <input id="avatar" type="file" onchange="readURL(this, 'show_avatar');" class="form-control border-0"
                                                    >
                                                    <div class="input-group-append">
                                                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> 
                                                        <i class="mdi mdi-cloud-upload mr-2 text-muted"></i>
                                                        <small class="text-uppercase font-weight-bold text-muted">AVATER</small></label>
                                                    </div>
                                                </div>
                                                <!-- Uploaded image area-->
                                                <div class="image-area mt-4">
                                                <img id="show_avatar" src="../documents/<?php if(isset($profile[0])){ echo $profile[0]['selfie'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block">
                                                </div>
                                                <span class = "error" id ="selfieErr"></span>
                                            </div>
                                            
                                        </div>						  
                                    </div>
                                    <input type="button" name="previous" class="previous btn btn-primary" value="Previous"/>
                                    <input type="button" name="next" id="next-2" class="next btn btn-primary" id="next-2" value="Next"/>
                                </fieldset>
                              
                                <fieldset>
                                    <div class="row">  
                                        <!-- <div class="col-md-4 grid-margin stretch-card">
                                            <div class="card">
                                            <img class="card-img-top" src="assets/images/top-banner.jpg" alt="card images">
                                            </div>
                                        </div>
                                        <div class="col-md-4 grid-margin stretch-card">
                                            <div class="card">
                                            <img class="card-img-top" src="assets/images/top-banner.jpg" alt="card images">
                                            </div>
                                        </div>
                                        <div class="col-md-4 grid-margin stretch-card">
                                            <div class="card">
                                            <img class="card-img-top" src="assets/images/top-banner.jpg" alt="card images">
                                            </div>
                                        </div> -->
                                        <div class="col-12">
                                            <div class="text-center">
                                                <div class="mb-3">
                                                    <i class="uil uil-check-square text-success h2"></i>
                                                </div>
                                                <h3>Thank you !</h3>
                                                <p class="w-75 mb-2 mx-auto text-muted">Your personal information will need to be approved in order to start earning money. This information will be confidential and securely used only for positioning
                                                  purposes on our site. It will never be shared with anyone.</p>
                                                    <div class="col-sm-12">
                                                    <h5>Application Progress</h5>
                                                    <p>Please use the Login credetials you provided to Sign Model Agreement  & trace application progress</p>
                                                </div>                              
                                                
                                                <?php
                                                if(isset($profile[0]) AND $profile[0]['status'] != 'approved' AND $profile[0]['registration_type'] == 'individual' ){
                                                echo "<h4>NOTICE - Your Model Registration are under review Please Wait for Administrator confirmation.<br>
                                                
                                                </h4>";
                                                }elseif(isset($profile[0]) AND $profile[0]['status'] == 'approved'){
                                                echo "<h4>NOTICE - Your  Model Registration is Approved!! .</h4>";
                                                }else{
                                                    echo "<h4>NOTICE - Your Model Registration are under review Please Wait for Administrator confirmation.<br>
                                                
                                                    </h4>"; 
                                                }
                                                ?>                                                                                
                                            </div>
                                        </div> 							
                                    </div> 
                                </fieldset>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>                  
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                  <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 
                    <a href="" target="_blank">Pondacam</a>. All rights reserved.</span>
                   
                  </div>
                </footer>
                <!-- partial -->
              </div>
              <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
          </div>    
        <script src="assets/js/vendor.bundle.base.js"></script>
        <script src="assets/js/off-canvas.js"></script>
        <script src="assets/js/hoverable-collapse.js"></script>
        <script src="assets/js/misc.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="assets/js/img-upload.js"></script>     
        <script>

        
        //console.log(modal);
        //alert('fdg');
        // Get the button that opens the modal
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        

            var current_fs, next_fs, previous_fs; //fieldsets
            var left, opacity, scale; //fieldset properties which we will animate
            var animating; //flag to prevent quick multi-click glitches
            
            $(".next").click(function(){
                
                animating = true;
                current_fs = $(this).parent();
                next_fs = $(this).parent().next();
                
                var currentid=$(this).attr('id');
                if(currentid=='next-1'){
                    document.getElementById('nameErr').innerHTML = "";
                    document.getElementById('emailErr').innerHTML = "";
                    document.getElementById('passwordErr').innerHTML = "";
                    document.getElementById('cpasswordErr').innerHTML = "";
                    document.getElementById('d_nameErr').innerHTML = "";
                    document.getElementById('l_nameErr').innerHTML = "";
                    document.getElementById('genErr').innerHTML = "";
                    document.getElementById('dobErr').innerHTML = "";
                    document.getElementById('contErr').innerHTML = "";
                    document.getElementById('idNErr').innerHTML = "";
                    var parentid = document.getElementById('parentid').value;
                    var name = document.getElementById('name').value;
                    var email = document.getElementById('email').value;
                    var password = document.getElementById('password').value;
                    var cpassword = document.getElementById('cpassword').value;
                    var dname = document.getElementById('name').value;
                    var lname = document.getElementById('l_name').value;
                    var gender = document.getElementById('gender').value;
                    var dob = document.getElementById('dob').value;
                    var country = document.getElementById('country').value;
                    var idN = document.getElementById('id_number').value;
                    var model_edit_id = document.getElementById('model_id').value;
                    //console.log(model_edit_id);
                    if (name == "")
                    {
                        document.getElementById('nameErr').innerHTML = "Input field required";
                        return false;
                    }
                    if (email == "")
                    {
                        document.getElementById('emailErr').innerHTML = "Input field required";
                        return false;
                    }else if(!email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.(?:[a-zA-Z0-9-]+)*$/) && !email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.(?:[a-zA-Z0-9-]+)+\.(?:[a-zA-Z0-9-]+)*$/)){
                        document.getElementById('emailErr').innerHTML = "Invalid Email Format!!!!";
                        return false;
                    }
                    if (password == "")
                    {
                        document.getElementById('passwordErr').innerHTML = "Input field required";
                        return false;
                    }
                    if (cpassword == "")
                    {                      
                        document.getElementById('cpasswordErr').innerHTML = "Input field required";
                        return false;
                    }else if(password!=cpassword){
                        document.getElementById('cpasswordErr').innerHTML = "Password Do Not Match!!!";
                        return false;
                    }
                    if (dname == "")
                    {
                        /* alert("Input field required"); */

                        document.getElementById('d_nameErr').innerHTML = "Input field required";
                        return false;
                    }
                    if (gender == "")
                    {
                        // alert("Input field required");
                        document.getElementById('genErr').innerHTML = "Input field required";
                        return false;
                    }
                    if (country == "")
                    {
                        // alert("Input field required");
                        document.getElementById('contErr').innerHTML = "Input field required";
                        return false;
                    }
                    if (lname == "")
                    {
                        // alert("Input field required");
                        document.getElementById('l_nameErr').innerHTML = "Input field required";
                        return false;
                    }

                    if (dob == "")
                    {
                        // alert("Input field required");
                        document.getElementById('dobErr').innerHTML = "Input field required";
                        return false;
                    }

                    if (idN == "")
                    {
                    
                        document.getElementById('idNErr').innerHTML = "Input field required";

                        return false;
                    }
                    var formdata = new FormData();
                    if(parentid !== undefined){formdata.append('parent_id',parentid)}
                    if(name !== undefined){formdata.append('name',name)}
                    if(email !== undefined){formdata.append('email',email)}
                    if(password !== undefined){formdata.append('password',password)}
                    if(dname !== undefined){formdata.append('d_name',dname)}                    
                    if(lname !== undefined){formdata.append('l_name',lname)}                    
                    if(gender !== undefined){formdata.append('gender',gender)}                    
                    if(dob !== undefined){formdata.append('dob',dob)}                    
                    if(country !== undefined){formdata.append('country',country)}                    
                    if(idN !== undefined){formdata.append('id_number',idN)}                    
                    if(model_edit_id !== ""){formdata.append('id',model_edit_id)}    
                    //console.log(formdata);                         
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function ()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            var response = this.responseText;
                            //console.log(response);   
                            if(response!=""){
                                var row = JSON.parse(response);
                                //console.log(row);
                                if(row['insertmailErr']=='ERROR!!!'){
                                    document.getElementById('emailErr').innerHTML = "Email Already EXIST!!!!";
                                    return false;
                                }else if(row['updatemailErr']=='ERROR!!!'){
                                    document.getElementById('emailErr').innerHTML = "Email Already EXIST!!!!";
                                    return false;
                                } 
                                 if(row['insideupdate']=='INSIDE'){
                                    alert('in update mode');
                                }  
                                nextstep()
                                document.getElementById('model_id').value = row['model_id'];
                                //console.log(row['model_id']);
                                //console.log(row[0]['name']);
                                // console.log(row[0]);
                                // console.log(JSON.parse(response)[0]);
                                /* next(); */
                            }
                        }
                    };
                    xhttp.open("POST", "addinfo.php", true);
                    /* xhttp.open("GET", "test.php?name="+name+"&email="+email+"&password="+password, true); */
                    //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    //xhttp.send('id='+model_edit_id+"&parent_id="+parentid+"&name="+name+"&email="+email+"&password="+password+ "&d_name=" + dname + "&l_name=" + lname + "&gender=" + gender + "&dob=" + dob + "&country=" + country + "&id_number=" + idN);
                    xhttp.send(formdata);           
                }else if(currentid=='next-2'){ 
                    document.getElementById('fidErr').innerHTML = "";
                    document.getElementById('bidErr').innerHTML = "";
                    document.getElementById('faceidErr').innerHTML = "";
                    document.getElementById('selfieErr').innerHTML = ""; 
                    var img1 =  document.getElementById('img1').value;                             
                    var img2 =  document.getElementById('img2').value;                             
                    var img3 =  document.getElementById('img3').value;                             
                    var img4 =  document.getElementById('img4').value;                             
                    var id = document.getElementById('model_id').value;
                    var fid = document.getElementById('fid').files[0];                               
                    var bid = document.getElementById('bid').files[0];
                    var faceid = document.getElementById('fandid').files[0];
                    var avatar = document.getElementById('avatar').files[0];
                    if(img1 ==""){
                        if (fid !== undefined)
                        {
                            var ext = fid.name.split('.').pop();
                            if (ext.toLowerCase() == 'jpg' || ext.toLowerCase() == 'png' || ext.toLowerCase() == 'jpeg')
                            {}
                            else
                            {
                                document.getElementById('fidErr').innerHTML = "Input file are not allowed";
                                return false;
                            }
                        }
                        else
                        {
                            document.getElementById('fidErr').innerHTML = "Input field required";
                            return false;
                        }

                    }
                    if(img2==""){
                        if (bid !== undefined)
                        {
                            var ext = bid.name.split('.').pop();
                            if (ext.toLowerCase() == 'jpg' || ext.toLowerCase() == 'png' || ext.toLowerCase() == 'jpeg')
                            {}
                            else
                            {
                                document.getElementById('bidErr').innerHTML = "Input file are not allowed";
                                return false;
                            }
                        }
                        else
                        {
                            document.getElementById('bidErr').innerHTML = "Input field required";
                            return false;
                        }
                    }               
                    if(img3==""){
                        if (faceid !== undefined)
                        {
                            var ext = faceid.name.split('.').pop();
                            if (ext.toLowerCase() == 'jpg' || ext.toLowerCase() == 'png' || ext.toLowerCase() == 'jpeg')
                            {}
                            else
                            {
                                document.getElementById('faceidErr').innerHTML = "Input file are not allowed";
                                return false;
                            }
                        }
                        else
                        {
                            document.getElementById('faceidErr').innerHTML = "Input field required";
                            return false;
                        }
                    }
                    if(img4==""){
                        if (avatar !== undefined)
                        {
                            var ext = avatar.name.split('.').pop();
                            if (ext.toLowerCase() == 'jpg' || ext.toLowerCase() == 'png' || ext.toLowerCase() == 'jpeg')
                            {}
                            else
                            {
                                document.getElementById('selfieErr').innerHTML = "Input file are not allowed";
                                return false;
                            }
                        }
                        else
                        {
                            document.getElementById('selfieErr').innerHTML = "Input field required";
                            return false;
                        }   
                    }
                /*  }  */     
                var formdata = new FormData();
                formdata.append('id',id); 
                formdata.append('id_front', fid);
                formdata.append('id_back', bid);
                formdata.append('face_id', faceid);
                formdata.append('selfie', avatar);
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function ()
                {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        var response = this.responseText;
                                
                    }
                };
                xhttp.open("POST", "addinfo.php", true);
                xhttp.send(formdata);
                nextstep()
                }else if(currentid=='next-3'){
                    nextstep()
                }
            });

            $(".previous").click(function(){
                animating = true;
                
                current_fs = $(this).parent();
                previous_fs = $(this).parent().prev();
                
                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
                
                previous_fs.show(); 
                current_fs.animate({opacity: 0}, {
                    step: function(now, mx) {
                        scale = 0.8 + (1 - now) * 0.2;
                        left = ((1-now) * 50)+"%";
                        opacity = 1 - now;
                        current_fs.css({'left': left});
                        previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
                    }, 
                    duration: 200, 
                    complete: function(){
                        current_fs.hide();
                        animating = false;
                    }, 
                    easing: 'easeOutQuint'
                });
            });
            function nextstep(){
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                //show the next fieldset
                    next_fs.show(); 
                //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now, mx) {
                        //as the opacity of current_fs reduces to 0 - stored in "now"
                        //1. scale current_fs down to 80%
                        scale = 1 - (1 - now) * 0.2;
                        //2. bring next_fs from the right(50%)
                        left = (now * 50)+"%";
                        //3. increase opacity of next_fs to 1 as it moves in
                        opacity = 1 - now;
                        current_fs.css({'transform': 'scale('+scale+')'});
                        next_fs.css({'left': left, 'opacity': opacity});
                    }, 
                    duration: 200, 
                    complete: function(){
                        current_fs.hide();
                        animating = false;
                    }, 
                    //this comes from the custom easing plugin
                    easing: 'easeOutQuint'
                });
            }
            $("fieldset").delegate(".removeOrder", "click", function () {  
                $(this).closest('.card').remove();
            }
            );  
        </script>
       
  </body>
</html>