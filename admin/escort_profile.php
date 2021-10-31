<?php
include 'config.php';
if(isset($_GET['view'])){
    $profile = $conn->getRow('escort',['id'=>$_GET['view']]);
    
    //$pinfo = $conn->getRow('banking_details',['user_id' => $_GET['view']]);
    //$agree = $conn -> getRow("agreement",    ["user_id" => $_GET['view']]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Shreyu - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <style>

        img{
            border: 3px solid #aaa;
            object-fit: initial;
            }
            ::cue {
            font-size: 12px;
            }
    </style>
    <script>
        
        function approveAplication() 
        {
            var xhttp = new XMLHttpRequest();
            var formdata = new FormData(); 
            
            formdata.append("id","<?php echo $profile[0]['id'];?>");
            formdata.append("status","approved");
            
            xhttp.onreadystatechange = function ()
            {
              if (this.readyState == 4 && this.status == 200)
              {
                var response = this.responseText;
                //alert(respo)
                location.reload();
              }           
            }; 
            xhttp.open("POST", "escort_status.php", true); 
            //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(formdata);
        }
        function updateProcess(process,status,note_id,note_err,div_id)
        {
            //userProcessUpdate.php rejected
            var xhttp = new XMLHttpRequest();
            var formdata = new FormData();
            
            if(status == "rejected")
            {
                var note = document.getElementById(note_id);
                
                //alert(note.value);
                if(note.value == "")
                {
                    document.getElementById(note_err).innerHTML = "Rejection Reason Required";
                    return false;
                }
                formdata.append("note",'"'+ note.value + '"');
            }
            
            
            formdata.append("user_id","<?php echo $profile[0]['id'];?>");
            formdata.append("process",process);
            formdata.append("status",status);
            xhttp.onreadystatechange = function ()
            {
              if (this.readyState == 4 && this.status == 200)
              {
                var response = this.responseText;
                showNote(div_id);
                location.reload();
                
              }           
            }; 
            xhttp.open("POST", "userProcessUpdate.php", true);
            xhttp.send(formdata);
        }
        function hideProfile()
        {
            var hideReason = document.getElementById("hideReason");
            var reason = hideReason.value;
            
            var xhttp = new XMLHttpRequest();
            var formdata = new FormData();
            formdata.append("user_id","<?php echo $profile[0]['id'];?>");
            formdata.append("reason",reason);
            formdata.append("hidden","1");
            xhttp.onreadystatechange = function ()
            {
              if (this.readyState == 4 && this.status == 200)
              {
                var response = this.responseText;
                //showNote(div_id);
                location.reload();
                
              }           
            }; 
            xhttp.open("POST", "hideProfile.php", true);
            xhttp.send(formdata);
        }
        function showProfile()
        {
            //var hideReason = document.getElementById("hideReason");
            //var reason = hideReason.value;
            
            var xhttp = new XMLHttpRequest();
            var formdata = new FormData();
            formdata.append("user_id","<?php echo $profile[0]['id'];?>");
            formdata.append("reason","profile_active");
            formdata.append("hidden","0");
            xhttp.onreadystatechange = function ()
            {
              if (this.readyState == 4 && this.status == 200)
              {
                var response = this.responseText;
                //showNote(div_id);
                location.reload();
                
              }           
            }; 
            xhttp.open("POST", "hideProfile.php", true);
            xhttp.send(formdata);
        }
        function showNote(div_id)
        {
            var note = document.getElementById(div_id);
            
            if(note.style.display == "none")
                {note.style.display = "block";}
            else
                {note.style.display = "none"}
        }
        
    </script>

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
       
        <?php include 'topbar.php'?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
       <?php include 'leftsidebar.php'?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row page-title">
                        <div class="col-md-12">
                            <nav aria-label="breadcrumb" class="float-right mt-1">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">pondacam</a></li>
                                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                            <h4 class="mb-1 mt-0">Profile</h4>
                        </div>
                    </div>
                    <?php 
                                    /*$process = $conn -> getRow('user_process',['user_id' => $profile[0]['id']]);
                                    $colorPersonal ='yellow';
                                    $colorDocument ='yellow';
                                    $colorAggrement ='yellow';
                                    $colorPayment  ='yellow';
                                    $count = 0;
                                    if(!isset($process[0]))
                                    {
                                        $conn -> insData('user_process',['user_id' => $profile[0]['id']]);
                                        $process = $conn -> getRow('user_process',['user_id' => $profile[0]['id']]);
                                    }
                                    //personal
                                    if($process[0]['personal_details'] == "approved")
                                    {
                                        $colorPersonal = "green";
                                        $count += 1;
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
                                        $count += 1;
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
                                        $count += 1;
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
                                        $count += 1;
                                    }
                                    else if($process[0]['payment_details'] == "pending")
                                    {
                                        $colorPayment = "yellow";
                                    }
                                    else if($process[0]['payment_details'] == "rejected")
                                    {
                                        $colorPayment = "red";
                                    }
                                    $total = 3;
                                    if($profile[0]['parent_id'] == 0 || $profile[0]['registration_type'] == "company")
                                    {
                                        $total += 1;
                                    }
                                    $percent = round(($count / $total) * 100);*/
                                ?>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center mt-3">
                                        <img src="../documents/<?php echo $profile[0]['selfie'] ?>" alt=""
                                            class="avatar-lg rounded-circle" />
                                        <h5 class="mt-2 mb-0"><?php echo $profile[0]['full_name'] ?></h5>
                                        <h6 class="text-muted font-weight-normal mt-2 mb-0">Escort
                                        </h6>
                                        <h6 class="text-muted font-weight-normal mt-1 mb-4"><?php echo $profile[0]['country'] ?></h6>

                                        <div class="progress mb-4" style="height: 14px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo 100;?>%;"
                                                aria-valuenow="<?php echo 100;?>" aria-valuemin="0" aria-valuemax="100">
                                                <span class="font-size-12 font-weight-bold">Your Profile is <span
                                                        class="font-size-11"><?php echo 100;?>%</span> completed</span>
                                            </div>
                                        </div>

                                        <!-- <button type="button" class="btn btn-primary btn-sm mr-1">Follow</button>
                                        <button type="button" class="btn btn-white btn-sm">Message</button> -->
                                    </div>

                                    <!-- profile  -->
                                    <!-- <div class="mt-5 pt-2 border-top">
                                        <h4 class="mb-3 font-size-15">About</h4>
                                        <p class="text-muted mb-4">Hi I'm Shreyu. I am user experience and user
                                            interface designer.
                                            I have been working on UI & UX since last 10 years.</p>
                                    </div> -->
                                    <div class="mt-3 pt-2 border-top">
                                        <h4 class="mb-3 font-size-15">Contact Information</h4>
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0 text-muted">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Phone Number</th>
                                                        <td><?php echo $profile[0]['phone_number']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Email</th>
                                                        <td><?php echo $profile[0]['email']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Address</th>
                                                        <td><?php echo $profile[0]['country']?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- <div class="mt-3 pt-2 border-top">
                                        <h4 class="mb-3 font-size-15">Skills</h4>
                                        <label class="badge badge-soft-primary">UI design</label>
                                        <label class="badge badge-soft-primary">UX</label>
                                        <label class="badge badge-soft-primary">Sketch</label>
                                        <label class="badge badge-soft-primary">Photoshop</label>
                                        <label class="badge badge-soft-primary">Frontend</label>
                                    </div> -->
                                </div>
                            </div>
                            <!-- end card -->

                        </div>

                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-pills navtab-bg nav-justified" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-personal-details-tab" data-toggle="pill"
                                                href="#pills-personal-details" role="tab" aria-controls="pills-personal-details"
                                                aria-selected="true">
                                                Personal Details
                                            </a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-projects-tab" data-toggle="pill"
                                                href="#pills-projects" role="tab" aria-controls="pills-projects"
                                                aria-selected="false">
                                                Document images
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-messages-tab" data-toggle="pill"
                                                href="#pills-messages" role="tab" aria-controls="pills-messages"
                                                aria-selected="false">
                                                Complete Application
                                            </a>
                                        </li>
                                        
                                        <!--<li class="nav-item">
                                            <a class="nav-link active" id="pills-activity-tab" data-toggle="pill"
                                                href="#pills-activity" role="tab" aria-controls="pills-activity"
                                                aria-selected="true">
                                                Activity
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-messages-tab" data-toggle="pill"
                                                href="#pills-messages" role="tab" aria-controls="pills-messages"
                                                aria-selected="false">
                                                Messages
                                            </a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-tasks-tab" data-toggle="pill"
                                                href="#pills-tasks" role="tab" aria-controls="pills-tasks"
                                                aria-selected="false">
                                                Tasks
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-files-tab" data-toggle="pill"
                                                href="#pills-files" role="tab" aria-controls="pills-files"
                                                aria-selected="false">
                                                Files
                                            </a>
                                        </li>-->
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        
                                        <div class="tab-pane fade show active" id="pills-personal-details" role="tabpanel"
                                            aria-labelledby="pills-personal-details-tab">
                                            <h5 class="mt-3">Personal Details</h5>
                                            <div class="row">  
                                                <div class="form-group col-sm-6">
                                                    <input type="hidden" id = "id" value = "<?php if(isset($profile[0])){ echo $profile[0]['id'];} ?>">
                                                    <label for="exampleInputEmail">Full Name</label>
                                                    <div class="input-group">
                                                    <input type="text" disabled class="form-control form-control-lg"  id="full_name" name ="full_name" placeholder="Full name"
                                                    value = "<?php if(isset($profile[0])){ echo $profile[0]['full_name'];} ?>" >
                                                    </div>
                                                    <span class = "error" id = "d_nameErr"></span>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    
                                                    <label for="exampleInputEmail">Display Name</label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg"id="display_name" name ="display_name" placeholder="Display Name"
                                                        value = "<?php if(isset($profile[0])){ echo $profile[0]['display_name'];} ?>">
                                                    </div>
                                                    <span class = "error" id = "l_nameErr"></span>
                                                </div>
                                                
                                                <div class="form-group col-sm-6">
                                                    
                                                    <label for="exampleInputEmail">Age</label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg"id="age" name ="age" placeholder="age"
                                                        value = "<?php if(isset($profile[0])){ echo $profile[0]['age'];} ?>">
                                                    </div>
                                                    <span class = "error" id = "l_nameErr"></span>
                                                </div>
                                                
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">Gender</label>
                                                    <div class="input-group">
                                                        <select class="form-control form-control-lg" name = "gender" id = "gender" disabled>
                                                            <option value="" >Select Sex</option>
                                                            <option value="female" <?php if(isset($profile[0]) AND $profile[0]['gender'] == 'female'){ echo "selected" ;} ?>>Female</option>
                                                            <option value="male"<?php if(isset($profile[0]) AND $profile[0]['gender'] == 'male'){ echo "selected" ;} ?>>Male</option>
                                                            <option value="other"<?php if(isset($profile[0]) AND $profile[0]['gender'] == 'other'){ echo "selected" ;} ?>>Others</option>
                                                        </select>													
                                                    </div>
                                                    <span class = "error" id = "genErr"></span>					
                                                </div>		
                                                
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">Hair</label>
                                                    <div class="input-group">
                                                        <select class="form-control form-control-lg" name = "hair_color" id = "hair_color" disabled>
                                                            <option value="black" <?php if(isset($profile[0]) AND $profile[0]['hair_color'] == 'black'){ echo "selected" ;} ?>>black</option>
                                                            <option value="Blond" <?php if(isset($profile[0]) AND $profile[0]['hair_color'] == 'Blond'){ echo "selected" ;} ?>>Blond</option>
                                                            <option value="Brunet"<?php if(isset($profile[0]) AND $profile[0]['hair_color'] == 'Brunet'){ echo "selected" ;} ?>>Brunet</option>
                                                        </select>													
                                                    </div>
                                                    <span class = "error" id = "genErr"></span>					
                                                </div>
                                                
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">Eyes</label>
                                                    <div class="input-group">
                                                        <select class="form-control form-control-lg" name = "eye_color" id = "eye_color" disabled>
                                                            <option value="black"    <?php if(isset($profile[0]) AND $profile[0]['eye_color'] == 'black'){ echo "selected" ;} ?>>black</option>
                                                            <option value="brownish" <?php if(isset($profile[0]) AND $profile[0]['eye_color'] == 'brownish'){ echo "selected" ;} ?>>brownish</option>
                                                            <option value="blue"     <?php if(isset($profile[0]) AND $profile[0]['eye_color'] == 'blue'){ echo "selected" ;} ?>>blue</option>
                                                            <option value="green"    <?php if(isset($profile[0]) AND $profile[0]['eye_color'] == 'green'){ echo "selected" ;} ?>>green</option>
                                                        </select>													
                                                    </div>
                                                    <span class = "error" id = "genErr"></span>					
                                                </div>
                                                
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">Brest / Dick size </label>
                                                    <div class="input-group">
                                                        <select class="form-control form-control-lg" name = "breast_size" id = "breast_size" disabled>
                                                            <option value="small"   <?php if(isset($profile[0]) AND $profile[0]['breast_size'] == 'small'){ echo "selected" ;} ?>>small</option>
                                                            <option value="normal"  <?php if(isset($profile[0]) AND $profile[0]['breast_size'] == 'normal'){ echo "selected" ;} ?>>normal</option>
                                                            <option value="big"     <?php if(isset($profile[0]) AND $profile[0]['breast_size'] == 'big'){ echo "selected" ;} ?>>big</option>
                                                            <option value="huge"    <?php if(isset($profile[0]) AND $profile[0]['breast_size'] == 'huge'){ echo "selected" ;} ?>>huge</option>
                                                        </select>													
                                                    </div>
                                                    <span class = "error" id = "genErr"></span>					
                                                </div>
                                                
                                                <div class="form-group col-sm-6">
                                                    
                                                    <label for="exampleInputEmail">Email</label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg"id="email" name ="email" placeholder="email"
                                                        value = "<?php if(isset($profile[0])){ echo $profile[0]['email'];} ?>">
                                                    </div>
                                                    <span class = "error" id = "l_nameErr"></span>
                                                </div>
                                                
                                                <div class="form-group col-sm-6">
                                                    
                                                    <label for="exampleInputEmail">Phone Number</label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg"id="phone_number" name ="phone_number" placeholder="Phone Number"
                                                        value = "<?php if(isset($profile[0])){ echo $profile[0]['phone_number'];} ?>">
                                                    </div>
                                                    <span class = "error" id = "l_nameErr"></span>
                                                </div>
                                                
                                                
                                            
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">Country</label>
                                                    <div class="input-group">
                                                        <select class="form-control form-control-lg" name="country" id="country" disabled>
                                                            <option value = "">Select country</option>
                                                            <?php $conRow = $conn->getRow('country');
                                                            foreach($conRow as $country){
                                                            ?>                                    
                                                            <option value="<?php echo  $country['code'] ?>"<?php if(isset($profile[0]) AND $profile[0]['country'] == $country['code']){ echo "selected" ;} ?>><?php echo  $country['name'] ; ?></option>
                                                        <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>	
                                                    <div><span class = "error" id = "contErr"></span></div>
                                                </div>
                                    
                                                <div class="form-group col-sm-6">
                                                    
                                                    <label for="exampleInputEmail">State / Province </label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg"id="state" name ="state" placeholder="state"
                                                        value = "<?php if(isset($profile[0])){ echo $profile[0]['state'];} ?>">
                                                    </div>
                                                    <span class = "error" id = "l_nameErr"></span>
                                                </div>  
                                                
                                                <div class="form-group col-sm-6">
                                                    
                                                    <label for="exampleInputEmail">City </label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg"id="city" name ="city" placeholder="city"
                                                        value = "<?php if(isset($profile[0])){ echo $profile[0]['city'];} ?>">
                                                    </div>
                                                    <span class = "error" id = "l_nameErr"></span>
                                                </div>    
                                                
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">Working Address</label>
                                                    <div class="input-group">
                                                        
                                                        <textarea id="Address" 
                                                                  disabled 
                                                                  class="form-control form-control-lg " 
                                                                  name="Address" 
                                                                  rows="4" 
                                                                  cols="50"
                                                                  placeholder="Address For administration use"><?php if(isset($profile[0])){ echo $profile[0]['work_address'];} ?></textarea>
                                                    </div>
                                                    <span class = "error" id = "idNErr"></span>
                                                </div>
                                                
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">Bio</label>
                                                    <div class="input-group">
                                                        
                                                        <textarea id="bio" 
                                                                  disabled 
                                                                  class="form-control form-control-lg " 
                                                                  name="bio" 
                                                                  rows="4" 
                                                                  cols="50"
                                                                  placeholder="Address For administration use"><?php if(isset($profile[0])){ echo $profile[0]['bio'];} ?></textarea>
                                                    </div>
                                                    <span class = "error" id = "idNErr"></span>
                                                </div>
                                                
                                                <div class="form-group col-sm-6">
                                                    
                                                    <label for="exampleInputEmail">Area </label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg"id="area" name ="area" placeholder="area"
                                                        value = "<?php if(isset($profile[0])){ echo $profile[0]['area'];} ?>">
                                                    </div>
                                                    <span class = "error" id = "l_nameErr"></span>
                                                </div> 
                                                
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">Travel </label>
                                                    <div class="input-group">
                                                        <select class="form-control form-control-lg" name = "travel" id = "travel" disabled>
                                                            <option value="1"  <?php if(isset($profile[0]) AND $profile[0]['travel'] == '1'){ echo "selected" ;} ?>>Yes</option>
                                                            <option value="0"  <?php if(isset($profile[0]) AND $profile[0]['travel'] == '0'){ echo "selected" ;} ?>>No</option>
                                                        </select>													
                                                    </div>
                                                    <span class = "error" id = "genErr"></span>					
                                                </div>
                                                
                                                <div class="form-group col-sm-6">
                                                    
                                                    <label for="exampleInputEmail">Available </label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg"id="available" name ="available" placeholder="available"
                                                        value = "<?php if(isset($profile[0])){ echo $profile[0]['available'];} ?>">
                                                    </div>
                                                    <span class = "error" id = "l_nameErr"></span>
                                                </div> 
                                                
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">Status </label>
                                                    <div class="input-group"> 
                                                        <select class="form-control form-control-lg" name = "statusV" id = "statusV" disabled>
                                                            <option value="pending"   <?php if(isset($profile[0]) AND $profile[0]['status'] == 'pending'){ echo "selected" ;} ?>>pending</option>
                                                            <option value="approved"  <?php if(isset($profile[0]) AND $profile[0]['status'] == 'approved'){ echo "selected" ;} ?>>approved</option>
                                                            <option value="rejected"  <?php if(isset($profile[0]) AND $profile[0]['status'] == 'rejected'){ echo "selected" ;} ?>>rejected</option>
                                                            
                                                        </select>													
                                                    </div>
                                                    <span class = "error" id = "genErr"></span>					
                                                </div>
                                                
                                            </div>
                                           <!-- <div class="left-timeline mt-3 pl-4">
                                                <ul class="list-unstyled events mb-0">
                                                    <li><a href="#" class="btn btn-success btn-sm" onclick="updateProcess('personal_details','approved','pdReason','notePDErr','rejectNotePD')">APPROVE</a></li>
                                                    <li><a href="#" class="btn btn-danger btn-sm"  onclick="showNote('rejectNotePD')">REJECT</a>
                                                        <div id="rejectNotePD" style="display:none;">
                                                            <hr />
                                                            <textarea col="12" row="12" class="form-control form-control-lg"  placeholder="Rejection note...." id="pdReason"></textarea>
                                                            <span class = "error" id = "notePDErr" style="color:red;"></span>
                                                            <br />
                                                            <a href="#" class="btn btn-primary btn-sm" onclick="updateProcess('personal_details','rejected','pdReason','notePDErr','rejectNotePD')">submit</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>-->
                                        </div>
                                        
                                        <div class="tab-pane fade " id="pills-banking-details" role="tabpanel"
                                            aria-labelledby="pills-banking-details-tab">
                                            <h5 class="mt-3">Payment Details
                                                <p style="boarder-radias: 10px;background-color:<?php echo $colorPayment ;?>;"><?php echo $process[0]['payment_details'] ;?></p>
                                                <?php 
                                                    if($process[0]['payment_details'] == 'rejected')
                                                    {
                                                ?>
                                                <div>
                                                    Rejection Reason :
                                                    <p><?php echo $process[0]['payment_note']; ?></p>
                                                </div>
                                                <?php 
                                                    }
                                                ?>
                                                
                                                
                                            </h5>
                                            <div class="row">  
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">BANK NAME</label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg" id="bank_name" 
                                                        value = "<?php if(isset($pinfo[0])){ echo $pinfo[0]['bank_name'];}?>">
                                                        <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                                    </div>
                                                    <span class = "error" id = "bank_nameErr"></span>
                                                </div>
                                                
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">ACCOUNT NUMBER</label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg" id="account_no" 
                                                        value = "<?php if(isset($pinfo[0])){ echo $pinfo[0]['account_no'];}?>">
                                                        <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                                    </div>
                                                    <span class = "error" id = "account_noErr"></span>
                                                </div>
                                                
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">BRANCH CODE</label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg" id="branch_code" 
                                                        value = "<?php if(isset($pinfo[0])){ echo $pinfo[0]['branch_code'];}?>">
                                                        <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                                    </div>
                                                    <span class = "error" id = "branch_codeErr"></span>
                                                </div>
                                                
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">ACCOUNT TYPE</label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg" id="account_type" 
                                                        value = "<?php if(isset($pinfo[0])){ echo $pinfo[0]['account_type'];}?>">
                                                        <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                                    </div>
                                                    <span class = "error" id = "account_typeErr"></span>
                                                </div>
                                                
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">IBAN</label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg" id="iban" 
                                                        value = "<?php if(isset($pinfo[0])){ echo $pinfo[0]['iban'];}?>">
                                                        <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                                    </div>
                                                    <span class = "error" id = "iban_typeErr"></span>
                                                </div>
                                                
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">SWIFT CODE</label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg" id="swift" 
                                                        value = "<?php if(isset($pinfo[0])){ echo $pinfo[0]['swift'];}?>">
                                                        <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                                    </div>
                                                    <span class = "error" id = "swift_typeErr"></span>
                                                </div>
                                                
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">BANK ADDRESS</label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg" id="bank_address" 
                                                        value = "<?php if(isset($pinfo[0])){ echo $pinfo[0]['bank_address'];}?>">
                                                        <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                                    </div>
                                                    <span class = "error" id = "bank_address_typeErr"></span>
                                                </div>
                                                
                                            </div>
                                            <div class="left-timeline mt-3 pl-4">
                                                <ul class="list-unstyled events mb-0">
                                                    <li><a href="#" class="btn btn-success btn-sm" onclick="updateProcess('payment_details','approved','pydReason','notePyDErr','rejectNotePyD')">APPROVE</a></li>
                                                    <li><a href="#" class="btn btn-danger btn-sm"  onclick="showNote('rejectNotePyD')">REJECT</a>
                                                        <div id="rejectNotePyD" style="display:none;">
                                                            <hr />
                                                            <textarea col="12" row="12" class="form-control form-control-lg"  placeholder="Rejection note...." id="pydReason"></textarea>
                                                            <span class = "error" id = "notePyDErr" style="color:red;"></span>
                                                            <br />
                                                            <a href="#" class="btn btn-primary btn-sm" onclick="updateProcess('payment_details','rejected','pydReason','notePyDErr','rejectNotePyD')">submit</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="tab-pane fade" id="pills-activity" role="tabpanel"
                                            aria-labelledby="pills-activity-tab">
                                            <h5 class="mt-3">This Week</h5>
                                            <div class="left-timeline mt-3 mb-3 pl-4">
                                                <ul class="list-unstyled events mb-0">
                                                    <!-- <li class="event-list">
                                                        <div class="pb-4">
                                                            <div class="media">
                                                                <div class="event-date text-center mr-4">
                                                                    <div
                                                                        class="bg-soft-primary p-1 rounded text-primary font-size-14">
                                                                        02 hours ago</div>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h6 class="font-size-15 mt-0 mb-1">Designing
                                                                        Shreyu Admin</h6>
                                                                    <p class="text-muted font-size-14">Shreyu Admin - A
                                                                        responsive admin and dashboard template</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="event-list">
                                                        <div class="pb-4">
                                                            <div class="media">
                                                                <div class="event-date text-center mr-4">
                                                                    <div
                                                                        class="bg-soft-primary p-1 rounded text-primary font-size-14">
                                                                        21 hours ago</div>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h6 class="font-size-15 mt-0 mb-1">UX and UI for
                                                                        Ubold Admin</h6>
                                                                    <p class="text-muted font-size-14">Ubold Admin - A
                                                                        responsive admin and dashboard template</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="event-list">
                                                        <div class="pb-4">
                                                            <div class="media">
                                                                <div class="event-date text-center mr-4">
                                                                    <div
                                                                        class="bg-soft-primary p-1 rounded text-primary font-size-14">
                                                                        22 hours ago</div>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h6 class="font-size-15 mt-0 mb-1">UX and UI for
                                                                        Hyper Admin</h6>
                                                                    <p class="text-muted font-size-14">Hyper Admin - A
                                                                        responsive admin and dashboard template</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li> -->
                                                </ul>
                                            </div>

                                            <h5 class="mt-4">Last Week</h5>
                                            

                                            <h5 class="mt-4">Last Month</h5>
                                            <div class="left-timeline mt-3 pl-4">
                                                <ul class="list-unstyled events mb-0">
                                                    
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- messages -->
                                        <div class="tab-pane" id="pills-messages" role="tabpanel"
                                        aria-labelledby="pills-messages-tab">
                                            <h5 class="mt-3">Complete Application</h5>
                                            
                                            <!--
                                            <div class="left-timeline mt-3 pl-4">
                                                <ul class="list-unstyled events mb-0">
                                                    <li><a href="#" class="btn btn-success btn-sm" onclick="updateProcess('contract','approved','CReason','noteCErr','rejectNoteC')">APPROVE</a></li>
                                                    <li><a href="#" class="btn btn-danger btn-sm"  onclick="showNote('rejectNoteC')">REJECT</a>
                                                        <div id="rejectNoteC" style="display:none;">
                                                            <hr />
                                                            <textarea col="12" row="12" class="form-control form-control-lg"  placeholder="Rejection note...." id="CReason"></textarea>
                                                            <span class = "error" id = "noteCErr" style="color:red;"></span>
                                                            <br />
                                                            <a href="#" class="btn btn-primary btn-sm" onclick="updateProcess('contract','rejected','CReason','noteCErr','rejectNoteC')">submit</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <ul class="list-unstyled">
                                                <li class="py-3 border-bottom">
                                                    <div class="media">
                                                        <div class="mr-3">
                                                            <img src="assets/images/users/avatar-2.jpg" alt=""
                                                                class="avatar-md rounded-circle">
                                                        </div>
                                                        <div class="media-body overflow-hidden">
                                                            <h5 class="font-size-15 mt-2 mb-1"><a href="#"
                                                                    class="text-dark">John Jack</a></h5>
                                                            <p class="text-muted font-size-13 text-truncate mb-0">
                                                                The
                                                                languages only differ in their grammar</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                
                                            </ul>
-->
                                            <div class="left-timeline mt-3 pl-4">
                                                <ul class="list-unstyled events mb-0">
                                                    <li>
                                                        <div id="rejectNoteC" style="display:none;">
                                                            Why do you want to hide this profile
                                                            <select class="form-control form-control-lg" name = "hideReason" id = "hideReason">
                                                                <option value="payment_overdue" >Payment Overdue</option>
                                                                <option value="outdated_phone"  >Outdated Phone Number</option>
                                                                <option value="new_profile"     >New Profile</option>
                                                            </select>
                                                            <span class = "error" id = "noteCErr" style="color:red;"></span>
                                                            <br />
                                                            
                                                            <a href="#" class="btn btn-primary btn-sm" onclick="hideProfile()">submit</a>
                                                            
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="text-center">
                                                <a href="#" class="btn btn-primary btn-sm" onclick="approveAplication()">APPROVE APPLICATION</a>
                                                <a href="#" class="btn btn-danger btn-sm"  onclick="showNote('rejectNoteC')">REJECT APPLICATION</a>
                                                <?php
                                                
                                                    if($profile[0]["hidden"] == '0' )
                                                    {
                                                ?>
                                                <a href="#" class="btn btn-info btn-sm"    onclick="showNote('rejectNoteC')">Hide Profile</a>
                                                <?php
                                                    }
                                                    else
                                                    {
                                                ?>
                                                <a href="#" class="btn btn-info btn-sm"    onclick="showProfile()">Show Profile</a>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="pills-projects" role="tabpanel"
                                            aria-labelledby="pills-projects-tab">

                                            <h5 class="mt-3"> 
                                                <p style="boarder-radias: 10px;background-color:<?php echo $colorDocument ;?>;"><?php echo $process[0]['documents'] ;?></p>
                                                
                                            </h5>
                                            <!--<div class="row">  
                                                <div class="col-lg-6 grid-margin stretch-card">
                                                    <div class="card">
                                                        
                                                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                                            <input id="fid" type="file" onchange="readURL(this,'show_front_id');" class="form-control border-0" 
                                                            value = "<?php if(isset($profile[0])){ echo $profile[0]['id_front'];} ?>">
                                                            <div class="input-group-append">
                                                                <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> 
                                                                <i class="mdi mdi-cloud-upload mr-2 text-muted"></i>
                                                                <small class="text-uppercase font-weight-bold text-muted">ID FRONT</small></label>
                                                            </div>
                                                        </div>
                                                            
                                                        <div class="image-area mt-4">
                                                            <img id="show_front_id" src="documents/<?php if(isset($profile[0])){ echo $profile[0]['id_front'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block">
                                                        </div>
                                                        <span class = "error" id = "fidErr"></span>
                                                    </div>
                                                    
                                                </div>	
                                            </div>-->
                                            <style>
                                                .image-area {
                                                    border: 2px dashed #ddd;
                                                    padding: 1rem;
                                                    position: relative;
                                                }
                                                
                                                .image-area::before {
                                                    content: 'Uploaded image result';
                                                    color: #ddd;
                                                    font-weight: bold;
                                                    text-transform: uppercase;
                                                    position: absolute;
                                                    top: 50%;
                                                    left: 50%;
                                                    transform: translate(-50%, -50%);
                                                    font-size: 0.8rem;
                                                    z-index: 1;
                                                }
                                                
                                                .image-area img {
                                                    z-index: 2;
                                                    position: relative;
                                                }
                                                .img-fluid {
                                                  max-width: 100%;
                                                  height: auto; }
                                                .rounded, .loader-demo-box {
                                                  border-radius: 0.25rem !important; }  
                                                  
                                                .shadow-sm {
                                                  -webkit-box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
                                                  box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important; }
                                                .d-block {
                                                    display: block !important; }
                                                .border-0 {
                                                    border: 0 !important; }
                                                .mt-4,
                                                .my-4 {
                                                  margin-top: 1.5rem !important; }
                                            </style>
                                            <a href="#" class="btn btn-primary btn-sm" onclick="addCoverImg()">ADD NEW IMAGE</a>
                                            <h5>AVATA </h5>
                                            <div class="row mt-3">
                                                <div class="image-area mt-4">
                                                    <img id="show_front_id" src="../documents/<?php if(isset($profile[0])){ echo $profile[0]['selfie'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block" width="100%">
                                                </div>
                                            </div>
                                            <h5>COVER IMAGE</h5>
                                            <div class="row mt-3">
                                                <div class="image-area mt-4">
                                                    <img id="show_cover_img" src="../documents/<?php if(isset($profile[0])){ echo $profile[0]['cover_photo'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block" width="100%">
                                                </div>
                                            </div>
                                            <h5>COVER VIDEO</h5>
                                            <div class="row mt-3">
                                                <div class="image-area mt-4">
                                                    
                                                    <video id="show_cover_video" src="../documents/<?php if(isset($profile[0])){ echo $profile[0]['cover_video'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block" width="400" controls>
                                                    </video>
                                                </div>
                                            </div>
                                            <h5>All IMAGES</h5>
                                            <div class="row mt-3">
                                                <?php 
                                                    $allImg = $conn->getRow("escort_image",["escort_id"=>$_GET['view']]);
                                                    
                                                    foreach($allImg as $img)
                                                    {
                                                
                                                ?>
                                                <div class="image-area mt-4 col-lg-3">
                                                    <img id="show_cover_img" src="../documents/<?php echo $img['image_name']; ?>" alt="" class="img-fluid rounded shadow-sm  d-block" width="100%">
                                                </div>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                            
                                            <!--<div class="row mt-3">
                                                <div class="col-xl-4 col-lg-6" >
                                                <h5 class="mt-3">Avata <a href="../documents/<?php echo $profile[0]['id_front']?>" target = "_BLANK">view</a></h5>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    <img src="../documents/<?php echo $profile[0]['id_front']?>"width="500" height="300" alt="img">
                                                </div>                                               
                                            </div>
                                            <div class="row mt-3">
                                            <div class="col-xl-4 col-lg-6" >
                                            <h5 class="mt-3">Id Back <a href="../documents/<?php echo $profile[0]['id_back']?>" target = "_BLANK">view</a></h5>
                                                </div>
                                               <div class="col-xl-4 col-lg-6">
                                                    <img src="../documents/<?php echo $profile[0]['id_back']?>" width="500" height="300" alt="img">
                                                </div>
                                            </div>                                          
                                            <div class="row mt-3">
                                            <div class="col-xl-4 col-lg-6" >
                                            <h5 class="mt-3">Face & Id <a href="../documents/<?php echo $profile[0]['face_id']?>" target = "_BLANK">view</a></h5>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">  
                                                <img src="../documents/<?php echo $profile[0]['face_id']?>"width="500" height="300" alt="img">                  
                                                </div>
                                            </div>-->
                                            
                                            
                                        
                                            <!--<div class="left-timeline mt-3 pl-4">
                                                <ul class="list-unstyled events mb-0">
                                                    <li><a href="#" class="btn btn-success btn-sm" onclick="updateProcess('documents','approved','dReason','noteDErr','rejectNoteD')">APPROVE</a></li>
                                                    <li><a href="#" class="btn btn-danger btn-sm"  onclick="showNote('rejectNoteD')">REJECT</a>
                                                        <div id="rejectNoteD" style="display:none;">
                                                            <hr />
                                                            <textarea col="12" row="12" class="form-control form-control-lg"  placeholder="Rejection note...." id="dReason"></textarea>
                                                            <span class = "error" id = "noteDErr" style="color:red;"></span>
                                                            <br />
                                                            <a href="#" class="btn btn-primary btn-sm" onclick="updateProcess('documents','rejected','dReason','noteDErr','rejectNoteD')">submit</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                             end row -->
                                        </div>

                                        <div class="tab-pane fade" id="pills-tasks" role="tabpanel"
                                            aria-labelledby="pills-tasks-tab">
                                            <h5 class="mt-3">Tasks</h5>

                                            <div class="card mb-0 shadow-none">
                                                <div class="card-body">
                                                    <!-- task -->
                                                    <div class="row justify-content-sm-between border-bottom">
                                                        <div class="col-lg-6 mb-2 mb-lg-0">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task1">
                                                                <label class="custom-control-label" for="task1">
                                                                    Draft the new contract document for
                                                                    sales team
                                                                </label>
                                                            </div> <!-- end checkbox -->
                                                        </div> <!-- end col -->
                                                        <div class="col-lg-6">
                                                            <div class="d-sm-flex justify-content-between">
                                                                <div>
                                                                    <img src="assets/images/users/avatar-9.jpg"
                                                                        alt="image" class="avatar-xs rounded-circle"
                                                                        data-toggle="tooltip" data-placement="bottom"
                                                                        title="Assigned to Arya S" />
                                                                </div>
                                                                <div class="mt-3 mt-sm-0">
                                                                    <ul class="list-inline font-13 text-sm-right">
                                                                        <li class="list-inline-item pr-1">
                                                                            <i
                                                                                class='uil uil-schedule font-16 mr-1'></i>
                                                                            Today 10am
                                                                        </li>
                                                                        <li class="list-inline-item pr-1">
                                                                            <i
                                                                                class='uil uil-align-alt font-16 mr-1'></i>
                                                                            3/7
                                                                        </li>
                                                                        <li class="list-inline-item pr-2">
                                                                            <i
                                                                                class='uil uil-comment-message font-16 mr-1'></i>
                                                                            21
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <span
                                                                                class="badge badge-soft-danger p-1">High</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div> <!-- end .d-flex-->
                                                        </div> <!-- end col -->
                                                    </div>
                                                    <!-- end task -->

                                                    <!-- task -->
                                                    <div class="row justify-content-sm-between mt-2 border-bottom pt-2">
                                                        <div class="col-lg-6 mb-2 mb-lg-0">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task2">
                                                                <label class="custom-control-label" for="task2">
                                                                    iOS App home page
                                                                </label>
                                                            </div> <!-- end checkbox -->
                                                        </div> <!-- end col -->
                                                        <div class="col-lg-6">
                                                            <div class="d-sm-flex justify-content-between">
                                                                <div>
                                                                    <img src="assets/images/users/avatar-2.jpg"
                                                                        alt="image" class="avatar-xs rounded-circle"
                                                                        data-toggle="tooltip" data-placement="bottom"
                                                                        title="Assigned to James B" />
                                                                </div>
                                                                <div class="mt-3 mt-sm-0">
                                                                    <ul class="list-inline font-13 text-sm-right">
                                                                        <li class="list-inline-item pr-1">
                                                                            <i
                                                                                class='uil uil-schedule font-16 mr-1'></i>
                                                                            Today 4pm
                                                                        </li>
                                                                        <li class="list-inline-item pr-1">
                                                                            <i
                                                                                class='uil uil-align-alt font-16 mr-1'></i>
                                                                            2/7
                                                                        </li>
                                                                        <li class="list-inline-item pr-2">
                                                                            <i
                                                                                class='uil uil-comment-message font-16 mr-1'></i>
                                                                            48
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <span
                                                                                class="badge badge-soft-danger p-1">High</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div> <!-- end .d-sm-flex-->
                                                        </div> <!-- end col -->
                                                    </div>
                                                    <!-- end task -->

                                                    <!-- task -->
                                                    <div
                                                        class="row justify-content-sm-between mt-2 border-bottom pt-2 pb-3">
                                                        <div class="col-lg-6 mb-2 mb-lg-0">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task3">
                                                                <label class="custom-control-label" for="task3">
                                                                    Write a release note
                                                                </label>
                                                            </div> <!-- end checkbox -->
                                                        </div> <!-- end col -->
                                                        <div class="col-lg-6">
                                                            <div class="d-sm-flex justify-content-between">
                                                                <div>
                                                                    <img src="assets/images/users/avatar-4.jpg"
                                                                        alt="image" class="avatar-xs rounded-circle"
                                                                        data-toggle="tooltip" data-placement="bottom"
                                                                        title="Assigned to Kevin C" />
                                                                </div>
                                                                <div>
                                                                    <ul class="list-inline font-13 text-sm-right mb-0">
                                                                        <li class="list-inline-item pr-1">
                                                                            <i
                                                                                class='uil uil-schedule font-16 mr-1'></i>
                                                                            Today 6pm
                                                                        </li>
                                                                        <li class="list-inline-item pr-1">
                                                                            <i
                                                                                class='uil uil-align-alt font-16 mr-1'></i>
                                                                            18/21
                                                                        </li>
                                                                        <li class="list-inline-item pr-2">
                                                                            <i
                                                                                class='uil uil-comment-message font-16 mr-1'></i>
                                                                            73
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <span
                                                                                class="badge badge-soft-info p-1">Medium</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div> <!-- end .d-sm-flex-->
                                                        </div> <!-- end col -->
                                                    </div>
                                                    <!-- end task -->

                                                    <!-- task -->
                                                    <div class="row justify-content-sm-between border-bottom mt-2 pt-2">
                                                        <div class="col-lg-6 mb-2 mb-lg-0">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task4">
                                                                <label class="custom-control-label" for="task4">
                                                                    Invite user to a project
                                                                </label>
                                                            </div> <!-- end checkbox -->
                                                        </div> <!-- end col -->
                                                        <div class="col-lg-6">
                                                            <div class="d-sm-flex justify-content-between">
                                                                <div>
                                                                    <img src="assets/images/users/avatar-2.jpg"
                                                                        alt="image" class="avatar-xs rounded-circle"
                                                                        data-toggle="tooltip" data-placement="bottom"
                                                                        title="Assigned to James B" />
                                                                </div>
                                                                <div class="mt-3 mt-sm-0">
                                                                    <ul class="list-inline font-13 text-sm-right">
                                                                        <li class="list-inline-item pr-1">
                                                                            <i
                                                                                class='uil uil-schedule font-16 mr-1'></i>
                                                                            Tomorrow
                                                                            7am
                                                                        </li>
                                                                        <li class="list-inline-item pr-1">
                                                                            <i
                                                                                class='uil uil-align-alt font-16 mr-1'></i>
                                                                            1/12
                                                                        </li>
                                                                        <li class="list-inline-item pr-2">
                                                                            <i
                                                                                class='uil uil-comment-message font-16 mr-1'></i>
                                                                            36
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <span
                                                                                class="badge badge-soft-danger p-1">High</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div> <!-- end .d-sm-flex-->
                                                        </div> <!-- end col -->
                                                    </div>
                                                    <!-- end task -->

                                                    <!-- task -->
                                                    <div class="row justify-content-sm-between mt-2 pt-2 border-bottom">
                                                        <div class="col-lg-6 mb-2 mb-lg-0">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task5">
                                                                <label class="custom-control-label" for="task5">
                                                                    Enable analytics tracking
                                                                </label>
                                                            </div> <!-- end checkbox -->
                                                        </div> <!-- end col -->
                                                        <div class="col-lg-6">
                                                            <div class="d-sm-flex justify-content-between">
                                                                <div>
                                                                    <img src="assets/images/users/avatar-2.jpg"
                                                                        alt="image" class="avatar-xs rounded-circle"
                                                                        data-toggle="tooltip" data-placement="bottom"
                                                                        title="Assigned to James B" />
                                                                </div>
                                                                <div class="mt-3 mt-sm-0">
                                                                    <ul class="list-inline font-13 text-sm-right">
                                                                        <li class="list-inline-item pr-1">
                                                                            <i
                                                                                class='uil uil-schedule font-16 mr-1'></i>
                                                                            27 Aug
                                                                            10am
                                                                        </li>
                                                                        <li class="list-inline-item pr-1">
                                                                            <i
                                                                                class='uil uil-align-alt font-16 mr-1'></i>
                                                                            13/72
                                                                        </li>
                                                                        <li class="list-inline-item pr-2">
                                                                            <i
                                                                                class='uil uil-comment-message font-16 mr-1'></i>
                                                                            211
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <span
                                                                                class="badge badge-soft-success p-1">Low</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div> <!-- end .d-sm-flex-->
                                                        </div> <!-- end col -->
                                                    </div>
                                                    <!-- end task -->

                                                    <!-- task -->
                                                    <div class="row justify-content-sm-between mt-2 pt-2">
                                                        <div class="col-lg-6 mb-2 mb-lg-0">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task6">
                                                                <label class="custom-control-label" for="task6">
                                                                    Code HTML email template
                                                                </label>
                                                            </div> <!-- end checkbox -->
                                                        </div> <!-- end col -->
                                                        <div class="col-lg-6">
                                                            <div class="d-sm-flex justify-content-between">
                                                                <div>
                                                                    <img src="assets/images/users/avatar-7.jpg"
                                                                        alt="image" class="avatar-xs rounded-circle"
                                                                        data-toggle="tooltip" data-placement="bottom"
                                                                        title="Assigned to Edward S" />
                                                                </div>
                                                                <div class="mt-3 mt-sm-0">
                                                                    <ul class="list-inline font-13 text-sm-right mb-0">
                                                                        <li class="list-inline-item pr-1">
                                                                            <i
                                                                                class='uil uil-schedule font-16 mr-1'></i>
                                                                            No Due
                                                                            Date
                                                                        </li>
                                                                        <li class="list-inline-item pr-1">
                                                                            <i
                                                                                class='uil uil-align-alt font-16 mr-1'></i>
                                                                            0/7
                                                                        </li>
                                                                        <li class="list-inline-item pr-2">
                                                                            <i
                                                                                class='uil uil-comment-message font-16 mr-1'></i>
                                                                            0
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <span
                                                                                class="badge badge-soft-info p-1">Medium</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div> <!-- end .d-sm-flex-->
                                                        </div> <!-- end col -->
                                                    </div>
                                                    <!-- end task -->
                                                </div> <!-- end card-body-->
                                            </div> <!-- end card -->
                                        </div>

                                        <div class="tab-pane fade" id="pills-files" role="tabpanel"
                                            aria-labelledby="pills-files-tab">
                                            <h5 class="mt-3">Files</h5>

                                            <div class="card mb-2 shadow-none border">
                                                <div class="p-1 px-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <img src="assets/images/projects/project-1.jpg"
                                                                class="avatar-sm rounded" alt="file-image">
                                                        </div>
                                                        <div class="col pl-0">
                                                            <a href="javascript:void(0);"
                                                                class="text-muted font-weight-bold">sales-assets.zip</a>
                                                            <p class="mb-0">2.3 MB</p>
                                                        </div>
                                                        <div class="col-auto">
                                                            <!-- Button -->
                                                            <a href="javascript:void(0);" data-toggle="tooltip"
                                                                data-placement="bottom" title="Download"
                                                                class="btn btn-link text-muted btn-lg p-0">
                                                                <i class='uil uil-cloud-download font-size-14'></i>
                                                            </a>
                                                            <a href="javascript:void(0);" data-toggle="tooltip"
                                                                data-placement="bottom" title="Delete"
                                                                class="btn btn-link text-danger btn-lg p-0">
                                                                <i class='uil uil-multiply font-size-14'></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mb-2 shadow-none border">
                                                <div class="p-1 px-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <img src="assets/images/projects/project-2.jpg"
                                                                class="avatar-sm rounded" alt="file-image">
                                                        </div>
                                                        <div class="col pl-0">
                                                            <a href="javascript:void(0);"
                                                                class="text-muted font-weight-bold">new-contarcts.docx</a>
                                                            <p class="mb-0">1.25 MB</p>
                                                        </div>
                                                        <div class="col-auto">
                                                            <!-- Button -->
                                                            <a href="javascript:void(0);" data-toggle="tooltip"
                                                                data-placement="bottom" title="Download"
                                                                class="btn btn-link text-muted btn-lg p-0">
                                                                <i class='uil uil-cloud-download font-size-14'></i>
                                                            </a>
                                                            <a href="javascript:void(0);" data-toggle="tooltip"
                                                                data-placement="bottom" title="Delete"
                                                                class="btn btn-link text-danger btn-lg p-0">
                                                                <i class='uil uil-multiply font-size-14'></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end attachments -->
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <!-- end row -->
                </div> <!-- container-fluid -->

            </div> <!-- content -->

            

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            2019 &copy; Shreyu. All Rights Reserved. Crafted with <i class='uil uil-heart text-danger font-size-12'></i> by <a href="https://coderthemes.com" target="_blank">Coderthemes</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div class="rightbar-title">
            <a href="javascript:void(0);" class="right-bar-toggle float-right">
                <i data-feather="x-circle"></i>
            </a>
            <h5 class="m-0">Customization</h5>
        </div>
    
        <div class="slimscroll-menu">
    
            <h5 class="font-size-16 pl-3 mt-4">Choose Variation</h5>
            <div class="p-3">
                <h6>Default</h6>
                <a href="index.html"><img src="assets/images/layouts/vertical.jpg" alt="vertical" class="img-thumbnail demo-img" /></a>
            </div>
            <div class="px-3 py-1">
                <h6>Top Nav</h6>
                <a href="layouts-horizontal.html"><img src="assets/images/layouts/horizontal.jpg" alt="horizontal" class="img-thumbnail demo-img" /></a>
            </div>
            <div class="px-3 py-1">
                <h6>Dark Side Nav</h6>
                <a href="layouts-dark-sidebar.html"><img src="assets/images/layouts/vertical-dark-sidebar.jpg" alt="dark sidenav" class="img-thumbnail demo-img" /></a>
            </div>
            <div class="px-3 py-1">
                <h6>Condensed Side Nav</h6>
                <a href="layouts-dark-sidebar.html"><img src="assets/images/layouts/vertical-condensed.jpg" alt="condensed" class="img-thumbnail demo-img" /></a>
            </div>
            <div class="px-3 py-1">
                <h6>Fixed Width (Boxed)</h6>
                <a href="layouts-boxed.html"><img src="assets/images/layouts/boxed.jpg" alt="boxed"
                        class="img-thumbnail demo-img" /></a>
            </div>
        </div> <!-- end slimscroll-menu-->
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body" style="padding-top:0px;padding-bottom:0px;">
              <section>
                <!-- <div class="row">  --> 						  
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <!-- Upload image input-->
                      <div class="mt-4">
                            <label class="exampleInputEmail" for="task1">
                            Select Image Type
                            </label>
                            <select class="form-control form-control-lg" name = "imgUpload" id = "imgUpload" onchange="changeDisplay(this.value)" >
                                <option value="avata"      >Avata</option>
                                <option value="cover"      >Cover</option>
                                <option value="general"    >General Image</option>
                                <option value="cover_video">Cover Video</option>
                                
                            </select>	
                      </div>
                      <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                        <input id="upload" type="file" class="form-control border-0">
                        <div class="input-group-append">
                          <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> 
                          <i class="mdi mdi-cloud-upload mr-2 text-muted"></i>
                          <small class="text-uppercase font-weight-bold text-muted">Image</small></label>
                        </div>
                      </div>
                      <!-- Uploaded image area-->
                      <div class="image-area mt-4">
                        <div id="img_container">
                            <img id="imageResult" src="../documents/<?php if(isset($row[0])){echo $row[0]['selfie'];}?>" alt="" width="100%"  class="img-fluid rounded shadow-sm  d-block">
                    
                        </div>
                        <div style="Display: none;" id="vid_container">
                            <video id="preview_cover_video"  src="../documents/<?php if(isset($profile[0])){ echo $profile[0]['cover_video'];} ?>" alt="" class="img-fluid rounded shadow-sm  d-block" width="400" controls>
                            </video>
                        </div>
                        
                      </div>
                      <span class = "error" style="color:red;" id ="selfieErr"></span>
                    </div>
                  </div>						  
                <!-- </div> -->
              </section>	 
            </div>
            <div class="modal-footer text-center">
                
              <button type="button" id = "img_upload_button" class="btn btn-primary" style="margin: 0px auto;">upload image</button>
                <style>
                    .loader {
                      border: 16px solid #f3f3f3;
                      border-radius: 50%;
                      border-top: 16px solid #3498db;
                      margin-left : 46%;
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
                <div id="loadDiv" style = "display:none;" class="text-center">
                    <div class="loader"></div>
                    <p>Uploading...</p>
                </div>
            </div>
          </div> 
    </div>
                                            </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    
    <script src="../assets/js/img-upload.js"></script>
    <script>
        function changeDisplay(type)
        {
            //alert(type);
            var vid_container = document.getElementById("vid_container");
            var img_container = document.getElementById("img_container");
            
            var upload = document.getElementById("upload");
            if(type == "cover_video")
            {
                img_container.style.display = "none";
                vid_container.style.display = "block";
                upload.addEventListener("change", function() {
                    readURL(upload,'preview_cover_video')
                });
                
                
                
            }
            else
            {
                img_container.style.display = "block";
                vid_container.style.display = "none";
                upload.addEventListener("change", function(){
                    readURL(upload,'imageResult')
                });
                //upload.onchange = readURL(this,'imageResult');
            }
            //vid_container onchange="readURL(this,'imageResult');"
        }
        changeDisplay("");
        function addCoverImg()
        {
             
            //$('#imageResult')
            //    .attr('src', '../documents/<?php if(isset($row[0])){echo $row[0]["cover_photo"];}?>');
            //imgType = "cover";
            $("#myModal").modal();
        }
        $('#img_upload_button').click(function() {
          //loadDiv
          var imgUpload = document.getElementById("imgUpload");
          //var img       = document.getElementById('upload').files[0];
          
          var avatar  = document.getElementById('upload').files[0];
          var loadDiv = document.getElementById('loadDiv');
          var imgType = "";
          
          if(imgUpload.value == "avata")
          {
            imgType = "profile";
          }
          else if (imgUpload.value == "cover")
          {
            imgType = "cover_photo";
          }
          else if (imgUpload.value == "cover_video")
          {
            imgType = "cover_video";
          }
          else
          {
            imgType = "gen_photo";
          }
          
          if (avatar !== undefined)
          {
            var ext = avatar.name.split('.').pop();
            if (ext.toLowerCase() == 'jpg' || ext.toLowerCase() == 'png' || ext.toLowerCase() == 'jpeg' || ext.toLowerCase() == 'mp4')
            {}
            else
            {
              document.getElementById('selfieErr').innerHTML = "Input file are not allowed";
              return false;
            }
          }
          else
          {
            document.getElementById('selfieErr').innerHTML = "Input file is Required";
            return false;
          }
          
          var formdata = new FormData();
    			formdata.append('avatar',avatar);
    			formdata.append('type',imgType);
    			formdata.append('id',"<?php echo $_GET['view'];?>");
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;  
                //console.log(response);
                loadDiv.style.display = "none";
                location.reload();
                //$("#myModal").modal('hide');
            }
          };       
          xhttp.open("POST", "profile_image_upload.php", true); 
          //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send(formdata);
          loadDiv.style.display = "block";
          
        });
    </script>

</body>

</html>