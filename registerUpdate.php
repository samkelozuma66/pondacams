<?php
include 'config.php';
if(!isset($_SESSION['name'])){
  echo "<script>window.location.href='register.php'</script>";
} 
$profile = $conn->getRow('users',['id'=>$_SESSION['id']]);
//print_r($profile);die;
if(isset($_GET['type'])){
  $data = ['registration_type'=>$_GET['type']];
  $up = $conn->updateData('users',$data,['id'=>$_SESSION['id']]);
 // print_r($up);die;
  if(isset($up)){
    echo "<script>window.location.href='registerUpdate.php'</script>";
  }
}
$pinfo = $conn->getRow('banking_details',['user_id'=>$_SESSION['id']]);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon1.png">
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
    </head>
    <body>
        <div class="container-scroller">
        <input type="hidden" id = "img1" value = "<?php if(isset($profile[0])){ echo $profile[0]['id_front'];} ?>">
        <input type="hidden" id = "img2" value = "<?php if(isset($profile[0])){ echo $profile[0]['id_back'];} ?>">
        <input type="hidden" id = "img3" value = "<?php if(isset($profile[0])){ echo $profile[0]['face_id'];} ?>">
        <input type="hidden" id = "img4" value = "<?php if(isset($profile[0])){ echo $profile[0]['selfie'];} ?>">
        
        <input type="hidden" id = "img5" value = "<?php if(isset($profile[0])){ echo $profile[0]['company_registration'];} ?>">
        <input type="hidden" id = "img6" value = "<?php if(isset($profile[0])){ echo $profile[0]['proof_address'];} ?>">
        <input type="hidden" id = "img7" value = "<?php if(isset($profile[0])){ echo $profile[0]['bank_confirm'];} ?>">
            <!-- partial:partials/_navbar.html -->
            <?php include 'topbar.php'; ?>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
              <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                  <li class="nav-item ">
                    <a class="nav-link" href="#">
                      <span class="menu-title">Models</span>
                      <i class="mdi mdi-account-multiple menu-icon "></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span class="menu-title">Statistic</span>
                      <i class="mdi mdi-chart-line menu-icon "></i>
                    </a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="registerUpdate.php">
                      <span class="menu-title">Personal Data</span>
                      <i class="mdi mdi-settings menu-icon "></i>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
                      <span class="menu-title">Payout</span>
                      <i class="menu-arrow"></i>
                      <i class="mdi mdi-buffer menu-icon"></i>
                    </a>
                    <div class="collapse" id="page-layouts">
                      <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="#">Payout card</a></li>
                        <li class="nav-item"> <a class="nav-link" href="#">Withdraw bank</a></li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span class="menu-title">Member Referral</span>
                      <i class="mdi mdi-bullhorn menu-icon "></i>
                    </a>
                  </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#helpinfo" aria-expanded="false" aria-controls="page-layouts">
                      <span class="menu-title">Help & Info </span>
                      <i class="menu-arrow"></i>
                      <i class="mdi mdi-information-outline menu-icon"></i>
                    </a>
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
                                 <?php 
                                    $modelUser = $conn -> getRow("users",["id" => $_SESSION["id"]]);
                                    
                                    if($modelUser[0]["parent_id"] == 0)
                                    { ?>
                                    <style>
                                        #progressbar li {
                                            list-style-type: none;
                                            color: #040404;
                                            text-transform: capitalize;
                                            font-size: 12px;
                                            width: 25%;
                                            float: left;
                                            position: relative;
                                            letter-spacing: 1px;
                                        }
                                    </style>
                                    <?php } ?>
                                <ul id="progressbar">
                                    <li class="active">Account and Personal Detail</li>
                                    <?php 
                                    
                                    if($modelUser[0]["parent_id"] == 0)
                                    { ?>
                                    <li>Payment Details</li>
                                    <?php } ?>
                                    <li>Upload Personal Documents</li>
                                    <li>Sign Agreement</li>
                                </ul>
                                <?php 
                                    $process = $conn -> getRow('user_process',['user_id' => $_SESSION['id']]);
                                    $colorPersonal ='yellow';
                                    $colorDocument ='yellow';
                                    $colorAggrement ='yellow';
                                    $colorPayment  ='yellow';
                                    if(!isset($process[0]))
                                    {
                                        $conn -> insData('user_process',['user_id' => $_SESSION['id']]);
                                        $process = $conn -> getRow('user_process',['user_id' => $_SESSION['id']]);
                                    }
                                    //personal
                                    if($process[0]['personal_details'] == "approved")
                                    {
                                        $colorPersonal = "green";
                                    }
                                    else if($process[0]['personal_details'] == "pending")
                                    {
                                        $colorPersonal = "yellow";
                                    }
                                    else if($process[0]['personal_details'] == "rejected")
                                    {
                                        $colorPersonal = "red";
                                    }
                                    //documents
                                    if($process[0]['documents'] == "approved")
                                    {
                                        $colorDocument = "green";
                                    }
                                    else if($process[0]['documents'] == "pending")
                                    {
                                        $colorDocument = "yellow";
                                    }
                                    else if($process[0]['documents'] == "rejected")
                                    {
                                        $colorDocument = "red";
                                    }
                                    //contract
                                    if($process[0]['contract'] == "approved")
                                    {
                                        $colorAggrement = "green";
                                    }
                                    else if($process[0]['contract'] == "pending")
                                    {
                                        $colorAggrement = "yellow";
                                    }
                                    else if($process[0]['contract'] == "rejected")
                                    {
                                        $colorAggrement = "red";
                                    }
                                    
                                    //payment_details
                                    if($process[0]['payment_details'] == "approved")
                                    {
                                        $colorPayment = "green";
                                    }
                                    else if($process[0]['payment_details'] == "pending")
                                    {
                                        $colorPayment = "yellow";
                                    }
                                    else if($process[0]['payment_details'] == "rejected")
                                    {
                                        $colorPayment = "red";
                                    }
                                ?>
                                <fieldset>
                                     <h4 class="mb-4">Account and Personal Detail 
                                         <p style="boarder-radias: 10px;background-color:<?php echo $colorPersonal ;?>;"><?php echo $process[0]['personal_details'] ;?></p>
                                         <?php 
                                            if($process[0]['personal_details'] == 'rejected')
                                            {
                                        ?>
                                        <div>
                                            Rejection Reason :
                                            <p><?php echo $process[0]['personal_note']; ?></p>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                     </h4>
                                    <div class="row">  
                                        <div class="form-group col-sm-6">
                                        <input type="hidden" id = "id" value = "<?php if(isset($_SESSION['id'])){ echo $_SESSION['id'];} ?>">
                                            <label for="exampleInputEmail"><?php   if(isset($profile[0])){ if($profile[0]['registration_type'] == "company"){ echo 'Studio Name'; } else { echo 'Display Name';}}?></label>
                                            <p class="mb-0"><small>Choose an appropriate display name to go online NB: No Spacial Characters</small></p>
                                            <div class="input-group">
                                            <input type="text" class="form-control form-control-lg"  id="d_name" name ="d_name" placeholder="Display name"
                                            value = "<?php if(isset($profile[0])){ echo $profile[0]['d_name'];} ?>" >
                                            </div>
                                            <span class = "error" id = "d_nameErr"></span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            
                                            <label for="exampleInputEmail">Legal Name</label>
                                            <p class="mb-0"><small>Your legal name same as you have on your id NB: No Spacial Characters</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg"id="l_name" name ="l_name" placeholder="Legal Name"
                                                value = "<?php if(isset($profile[0])){ echo $profile[0]['l_name'];} ?>">
                                            </div>
                                            <span class = "error" id = "l_nameErr"></span>
                                        </div>
                                        <?php   if(isset($profile[0])){ if($profile[0]['registration_type'] == "company"){ }}?>
                                        <?php   if(isset($profile[0]))
                                                { 
                                                    if($profile[0]['registration_type'] == "company")
                                                    {
                                        
                                        ?>
                                        <div class="form-group col-sm-6">
                                            
                                            <label for="exampleInputEmail">Representative Name</label>
                                            <p class="mb-0"><small>Your Representative Name same as you have on your id</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg"id="rep_name" name ="rep_name" placeholder="Representative Name"
                                                value = "<?php if(isset($profile[0])){ echo $profile[0]['owner_details'];} ?>">
                                            </div>
                                            <span class = "error" id = "rep_nameErr"></span>
                                        </div>
                                        <?php       }
                                                }
                                        
                                        ?>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Gender</label>
                                            <p class="mb-0"><small>Gender on your id card</small></p>
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
                                            <p class="mb-0"><small>Your date of birth, same as on your id card</small></p>
                                            <div class="input-group">								
                                            <input type="date" id="dob" name = "dob" class="form-control form-control-lg"
                                            value = "<?php if(isset($profile[0])){ echo $profile[0]['dob'];} ?>">
                                            </div>
                                            <span class = "error" id = "dobErr"></span>
                                        </div>
                                    
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Country</label>
                                            <p class="mb-0"><small>Your Country must be the same where your ID has beeb issued</small></p>
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
                                <?php 
                                    
                                    
                                    if($modelUser[0]["parent_id"] == 0)
                                    {
                                ?>
                                <fieldset>
                                     <h4 class="mb-4">Payment Details 
                                        <p style="boarder-radias: 10px;background-color:<?php echo $colorPayment ;?>;"><?php echo $process[0]['payment_details'] ;?></p>
                                        
                                        <?php 
                                            if($process[0]['personal_details'] == 'rejected')
                                            {
                                        ?>
                                        <div>
                                            Rejection Reason :
                                            <p><?php echo $process[0]['payment_note']; ?></p>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                    </h4>
                                    <div class="row">  
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">BANK NAME</label>
                                            <p class="mb-0"><small>Enter Bank name</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="bank_name" 
                                                value = "<?php if(isset($pinfo[0])){ echo $pinfo[0]['bank_name'];}?>">
                                                <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                            </div>
                                            <span class = "error" id = "bank_nameErr"></span>
                                        </div>
                                        
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">ACCOUNT NUMBER</label>
                                            <p class="mb-0"><small>Enter acount number</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="account_no" 
                                                value = "<?php if(isset($pinfo[0])){ echo $pinfo[0]['account_no'];}?>">
                                                <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                            </div>
                                            <span class = "error" id = "account_noErr"></span>
                                        </div>
                                        
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">BRANCH CODE</label>
                                            <p class="mb-0"><small>Enter Branch code</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="branch_code" 
                                                value = "<?php if(isset($pinfo[0])){ echo $pinfo[0]['branch_code'];}?>">
                                                <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                            </div>
                                            <span class = "error" id = "branch_codeErr"></span>
                                        </div>
                                        
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">ACCOUNT TYPE</label>
                                            <p class="mb-0"><small>Enter Account type</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="account_type" 
                                                value = "<?php if(isset($pinfo[0])){ echo $pinfo[0]['account_type'];}?>">
                                                <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                            </div>
                                            <span class = "error" id = "account_typeErr"></span>
                                        </div>
                                        
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">IBAN</label>
                                            <p class="mb-0"><small>Enter IBAN</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="iban" 
                                                value = "<?php if(isset($pinfo[0])){ echo $pinfo[0]['iban'];}?>">
                                                <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                            </div>
                                            <span class = "error" id = "iban_typeErr"></span>
                                        </div>
                                        
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">SWIFT CODE</label>
                                            <p class="mb-0"><small>Enter Swift Code</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="swift" 
                                                value = "<?php if(isset($pinfo[0])){ echo $pinfo[0]['swift'];}?>">
                                                <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                            </div>
                                            <span class = "error" id = "swift_typeErr"></span>
                                        </div>
                                        
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">BANK ADDRESS</label>
                                            <p class="mb-0"><small>Enter Bank Address</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="bank_address" 
                                                value = "<?php if(isset($pinfo[0])){ echo $pinfo[0]['bank_address'];}?>">
                                                <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                            </div>
                                            <span class = "error" id = "bank_address_typeErr"></span>
                                        </div>
                                        
                                    </div>
                                    
                                    <input type="button" name="previous" class="previous btn btn-primary" value="Previous"/>
                                    <input type="button" name="next" id="next-5" class="next btn btn-primary" id="next-3"  value="Next"/>
                                </fieldset> 
                                <?php } ?>
                                <fieldset>
                                     <h4 class="mb-4">Upload Personal Documents 
                                         <p style="boarder-radias: 10px;background-color:<?php echo $colorDocument ;?>;"><?php echo $process[0]['documents'] ;?></p>
                                         
                                         <?php 
                                            if($process[0]['documents'] == 'rejected')
                                            {
                                        ?>
                                        <div>
                                            Rejection Reason :
                                            <p><?php echo $process[0]['document_note']; ?></p>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                         
                                     </h4>
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
                                                    <img id="show_front_id" src="documents/<?php if(isset($profile[0])){ echo $profile[0]['id_front'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block">
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
                                                    <img id="show_back_id" src="documents/<?php if(isset($profile[0])){ echo $profile[0]['id_back'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block">
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
                                                <img id="show_face_id" src="documents/<?php if(isset($profile[0])){ echo $profile[0]['face_id'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block">
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
                                                <img id="show_avatar" src="documents/<?php if(isset($profile[0])){ echo $profile[0]['selfie'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block">
                                                </div>
                                                <span class = "error" id ="selfieErr"></span>
                                            </div>
                                            
                                        </div>
                                        
                                        <?php   if(isset($profile[0]))
                                                { 
                                                    if($profile[0]['parent_id'] == 0)
                                                    { 
                                                        
                                                    
                                                
                                        ?>
                                        
                                        <div class="col-lg-6 grid-margin stretch-card">
                                            <div class="card">
                                                <!-- Upload image input-->
                                                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                                    <input id="bank" type="file" onchange="readURL(this, 'show_bank_confirm');" class="form-control border-0"
                                                    >
                                                    <div class="input-group-append">
                                                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> 
                                                        <i class="mdi mdi-cloud-upload mr-2 text-muted"></i>
                                                        <small class="text-uppercase font-weight-bold text-muted">Proof of Banking Details</small></label>
                                                    </div>
                                                </div>
                                                <!-- Uploaded image area-->
                                                <div class="image-area mt-4">
                                                <img id="show_bank_confirm" src="documents/<?php if(isset($profile[0])){ echo $profile[0]['bank_confirm'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block">
                                                </div>
                                                <span class = "error" id ="bankErr"></span>
                                            </div>
                                            
                                        </div>
                                        <?php       }
                                                }
                                        
                                        
                                                if(isset($profile[0]))
                                                { 
                                                    if($profile[0]['registration_type'] == "company")
                                                    { 
                                                        
                                        ?>
                                        
                                        <div class="col-lg-6 grid-margin stretch-card">
                                            <div class="card">
                                                <!-- Upload image input-->
                                                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                                    <input id="proof_address" type="file" onchange="readURL(this, 'show_proof_address');" class="form-control border-0"
                                                    >
                                                    <div class="input-group-append">
                                                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> 
                                                        <i class="mdi mdi-cloud-upload mr-2 text-muted"></i>
                                                        <small class="text-uppercase font-weight-bold text-muted">Proof of Address</small></label>
                                                    </div>
                                                </div>
                                                <!-- Uploaded image area-->
                                                <div class="image-area mt-4">
                                                <img id="show_proof_address" src="documents/<?php if(isset($profile[0])){ echo $profile[0]['proof_address'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block">
                                                </div>
                                                <span class = "error" id ="addressErr"></span>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="col-lg-6 grid-margin stretch-card">
                                            <div class="card">
                                                <!-- Upload image input-->
                                                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                                    <input id="registration" type="file" onchange="readURL(this, 'show_registration');" class="form-control border-0"
                                                    >
                                                    <div class="input-group-append">
                                                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> 
                                                        <i class="mdi mdi-cloud-upload mr-2 text-muted"></i>
                                                        <small class="text-uppercase font-weight-bold text-muted">Proof of Company Registration</small></label>
                                                    </div>
                                                </div>
                                                <!-- Uploaded image area-->
                                                <div class="image-area mt-4">
                                                <img id="show_registration" src="documents/<?php if(isset($profile[0])){ echo $profile[0]['company_registration'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block">
                                                </div>
                                                <span class = "error" id ="registrationErr"></span>
                                            </div>
                                            
                                        </div>
                                        
                                        <?php 
                                                    }
                                                }
                                        ?>
                                        <style>
                                        .loader {
                                          border: 16px solid #f3f3f3;
                                          border-radius: 50%;
                                          border-top: 16px solid #3498db;
                                          width: 20px;
                                          height: 20px;
                                          -webkit-animation: spin 2s linear infinite; /* Safari */
                                          animation: spin 2s linear infinite;
                                        }
                                        
                                        /* Safari */
                                        @-webkit-keyframes spin {
                                          0% { -webkit-transform: rotate(0deg); }
                                          100% { -webkit-transform: rotate(360deg); }
                                        }
                                        
                                        @keyframes spin {
                                          0% { transform: rotate(0deg); }
                                          100% { transform: rotate(360deg); }
                                        }
                                    </style>
                                    
                                    </div>
                                    <div id="loadDiv" style = "display:none;">
                                        <div class="loader"></div>
                                        <p>Uploading...</p>
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
                                                <h3>Thank you ! 
                                                    <p style="boarder-radias: 10px;background-color:<?php echo $colorAggrement ;?>;"><?php echo $process[0]['contract'] ;?></p>
                                                    
                                                    <?php 
                                                        if($process[0]['personal_details'] == 'rejected')
                                                        {
                                                    ?>
                                                    <div>
                                                        Rejection Reason :
                                                        <p><?php echo $process[0]['contract_note']; ?></p>
                                                    </div>
                                                    <?php 
                                                        }
                                                    ?>
                                                </h3>
                                                <p class="w-75 mb-2 mx-auto text-muted">Your personal information will need to be approved in order to start earning money. This information will be confidential and securely used only for positioning
                                                  purposes on our site. It will never be shared with anyone.</p>
                                                    <div class="col-sm-12">
                                                    <h5>Agreement</h5>
                                                    <p>Please read and sign the agreement in order to have your application reviewed.</p>
                                                </div>                              
                                                <button type = "button" class="button" id="myBtn">Read & Sign Agreement</button>
                                                <div class = "modal" id = "myModal1" style = "display : none;"> 
                                                    <button type = "button" style="display:block;margin-left:45%;" class="button" id="myBtn1">CLOSE</button>
                                                    <iframe width="70%" id = "aggrement" height="700" src="./agreement?user_id= <?php echo $_SESSION['id']; ?>" style="background:white;margin-top:3%;"></iframe>
                                                    
                                                </div>
                                                <?php
                                                 if(isset($profile[0]) AND $profile[0]['status'] != 'approved' AND $profile[0]['registration_type'] != 'individual' ){
                                                  echo "<h4>NOTICE - Your Registration is under review Please Wait for Administrator confirmation.<br>
                                                  You’ll always be able to add more people as soon as your account gets approved.
                                                  </h4>";
                                                 }else{
                                                  echo "<h4>NOTICE - Your Registration is under review Please Wait for Administrator confirmation.</h4>";
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
          
        <div class="modal fade" id="myModal"  data-backdrop="static"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Create Model Account</h4>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                        
                    </div>
                    <div class="modal-body" style="padding-top:0px;padding-bottom:0px;">
                        <h5 class="onloadn">TO WHOM DO YOU WANT TO CREATE A NEW ACCOUNT FOR?</h5>
                        <p class="text-center">
                        <!-- <input class="checkbox-tools" type="radio" name="userType" id="tool-1" value = "individual"> -->
                        <a  class ="button"   href="registerUpdate.php?type=individual">MY SELF</a>
                       <!--  <label class="for-checkbox-tools" for="tool-1">MY SELF </label> -->
                                                
                       <!--  <input class="checkbox-tools" type="radio" name="userType" id="tool-2" value = "company"> -->
                        <a class ="button"  href="registerUpdate.php?type=company">FOR STUDIO</a>
                        <!-- <label class="for-checkbox-tools" for="tool-2">FOR AGANCY</label> -->
                        </p>
                        
                    </div>
                    <!-- <div class="modal-footer text-center">
                        <button type="button"  class="btn btn-primary" style="margin: 0px auto;">DONE</button>
                    </div> -->
                </div> 
            </div>
        </div>
        <script src="https://fintranxect.com/testing/assets/js/jquery.min.js"></script>
        <script src="assets/js/vendor.bundle.base.js"></script>
        <script src="assets/js/off-canvas.js"></script>
        <script src="assets/js/hoverable-collapse.js"></script>
        <script src="assets/js/misc.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="assets/js/img-upload.js"></script>
        <script src="assets/js/step-jquery.js"></script>
        <script> 
        var modal = document.getElementById("myModal1");
        modal.style.display = "none"; 
        //console.log(modal);
        //alert('fdg');
        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");
        var btn1 = document.getElementById("myBtn1");
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks the button, open the modal 
        
        btn.onclick = function() {
            modal.style.display = "block";       
        } 
        // When the user clicks on <span> (x), close the modal
        btn1.onclick = function() {
        modal.style.display = "none";
        } 
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function ()
        {
          if (this.readyState == 4 && this.status == 200)
          {
            var response = this.responseText;
          // console.log(response);
            var row = JSON.parse(response);
            //alert(row[0]['registration_type']);
            //console.log(row[0]);
            // console.log(JSON.parse(response)[0]); 
            $(function() {
              if(row[0]['registration_type']!=null){
               // alert(row[0]['registration_type']);
                $("#myModal").modal("hide");
                
              }else{
                $("#myModal").modal();
              }          	       	
            });                
            $('#myModal input').on('change', function() {
              var ty = $('input[name=userType]:checked', '#myModal').val(); 
              $("#myModal").modal("hide");
            });  

          }           
        }; 
        xhttp.open("POST", "ajaxdata.php", true);
        xhttp.send();   
        
        </script>
  </body>
</html>