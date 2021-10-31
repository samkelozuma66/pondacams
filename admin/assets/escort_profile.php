<?php
include 'config.php';
if(isset($_GET['view'])){
    $profile = $conn->getRow('users',['id'=>$_GET['view']]);
    
    $pinfo = $conn->getRow('banking_details',['user_id' => $_GET['view']]);
    $agree = $conn -> getRow("agreement",    ["user_id" => $_GET['view']]);
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
                location.reload();
              }           
            }; 
            xhttp.open("POST", "status.php", true); 
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
                                    $process = $conn -> getRow('user_process',['user_id' => $profile[0]['id']]);
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
                                    $percent = round(($count / $total) * 100);
                                ?>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center mt-3">
                                        <img src="../documents/<?php echo $profile[0]['selfie'] ?>" alt=""
                                            class="avatar-lg rounded-circle" />
                                        <h5 class="mt-2 mb-0"><?php echo $profile[0]['name'] ?></h5>
                                        <h6 class="text-muted font-weight-normal mt-2 mb-0">Model
                                        </h6>
                                        <h6 class="text-muted font-weight-normal mt-1 mb-4"><?php echo $profile[0]['country'] ?></h6>

                                        <div class="progress mb-4" style="height: 14px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $percent;?>%;"
                                                aria-valuenow="<?php echo $percent;?>" aria-valuemin="0" aria-valuemax="100">
                                                <span class="font-size-12 font-weight-bold">Your Profile is <span
                                                        class="font-size-11"><?php echo $percent;?>%</span> completed</span>
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
                                                        <th scope="row">Email</th>
                                                        <td><?php echo $profile[0]['email']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Id Number</th>
                                                        <td><?php echo $profile[0]['id_number']?></td>
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
                                        <?php   
                                                if(isset($profile[0]))
                                                { 
                                                    if($profile[0]['parent_id'] == 0)
                                                    { 
                                                        
                                                    
                                                
                                            ?>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-banking-details-tab" data-toggle="pill"
                                                href="#pills-banking-details" role="tab" aria-controls="pills-banking-details"
                                                aria-selected="false">
                                                Banking Details
                                            </a>
                                        </li>
                                        <?php   
                                                    }
                                                }
                                                        
                                                    
                                                
                                            ?>
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
                                                Contract & Complete Application
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
                                            <h5 class="mt-3">Personal Details
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
                                                
                                                
                                            </h5>
                                            <div class="row">  
                                                <div class="form-group col-sm-6">
                                                    <input type="hidden" id = "id" value = "<?php if(isset($profile[0])){ echo $profile[0]['id'];} ?>">
                                                    <label for="exampleInputEmail"><?php   if(isset($profile[0])){ if($profile[0]['registration_type'] == "company"){ echo 'Studio Name'; } else { echo 'Display Name';}}?></label>
                                                    <div class="input-group">
                                                    <input type="text" disabled class="form-control form-control-lg"  id="d_name" name ="d_name" placeholder="Display name"
                                                    value = "<?php if(isset($profile[0])){ echo $profile[0]['d_name'];} ?>" >
                                                    </div>
                                                    <span class = "error" id = "d_nameErr"></span>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    
                                                    <label for="exampleInputEmail">Legal Name</label>
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg"id="l_name" name ="l_name" placeholder="Legal Name"
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
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg"id="rep_name" name ="rep_name" placeholder="Representative Name"
                                                        value = "<?php if(isset($profile[0])){ echo $profile[0]['owner_details'];} ?>">
                                                    </div>
                                                    <span class = "error" id = "rep_nameErr"></span>
                                                </div>
                                                <?php       }
                                                        }
                                                
                                                ?>
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">Gender</label>
                                                    <div class="input-group">
                                                        <select class="form-control form-control-lg" name = "gender" id = "gender" disabled>
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
                                                    <div class="input-group">								
                                                    <input type="date" disabled id="dob" name = "dob" class="form-control form-control-lg"
                                                    value = "<?php if(isset($profile[0])){ echo $profile[0]['dob'];} ?>">
                                                    </div>
                                                    <span class = "error" id = "dobErr"></span>
                                                </div>
                                            
                                                <div class="form-group col-sm-6">
                                                    <label for="exampleInputEmail">Country</label>
                                                    <div class="input-group">
                                                        <select class="form-control form-control-lg" name="country" id="country" disabled>
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
                                                    <div class="input-group">
                                                        <input type="text" disabled class="form-control form-control-lg" id="id_number" name = "id_number" placeholder="Type your ID number here"
                                                        value = "<?php if(isset($profile[0])){ echo $profile[0]['id_number'];} ?>">
                                                    </div>
                                                    <span class = "error" id = "idNErr"></span>
                                                </div>
                                            </div>
                                            <div class="left-timeline mt-3 pl-4">
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
                                            </div>
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
                                            <h5 class="mt-3">Contract & Complete Application
                                                <p style="boarder-radias: 10px;background-color:<?php echo $colorAggrement ;?>;"><?php echo $process[0]['contract'] ;?></p>
                                                <?php 
                                                    if($process[0]['contract'] == 'rejected')
                                                    {
                                                ?>
                                                <div>
                                                    Rejection Reason :
                                                    <p><?php echo $process[0]['contract_note']; ?></p>
                                                </div>
                                                <?php 
                                                    }
                                                ?>
                                                
                                                
                                            </h5>
                                            
                                            <ul class="list-unstyled">
                                                <li class="py-3 border-bottom">
                                                    <div class="media">
                                                        <div class="mr-3">
                                                            Contract
                                                        </div>
                                                        
                                                        <div class="media-body overflow-hidden">
                                                            <h5 class="font-size-15 mt-2 mb-1"><a href="#"
                                                                    class="text-dark">Initials : <?php if(isset($agree[0])){ echo $agree[0]['initials'];}else{ echo 'Not Signed'; }?></a></h5>
                                                            <p class="text-muted font-size-13 text-truncate mb-0">
                                                                Date : <?php if(isset($agree[0])){ echo $agree[0]['date'];}else{  echo 'Not Signed';  }?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                
                                            </ul>
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
                                            <!--<ul class="list-unstyled">
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
                                                
                                            </ul>-->

                                            <div class="text-center">
                                                <a href="#" class="btn btn-primary btn-sm" onclick="approveAplication()">APPROVE APPLICATION</a>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="pills-projects" role="tabpanel"
                                            aria-labelledby="pills-projects-tab">

                                            <h5 class="mt-3">Documents 
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
                                            </h5>

                                            <div class="row mt-3">
                                                <div class="col-xl-4 col-lg-6" >
                                                <h5 class="mt-3">Id Front <a href="../documents/<?php echo $profile[0]['id_front']?>" target = "_BLANK">view</a></h5>
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
                                            </div>
                                            <?php   
                                                if(isset($profile[0]))
                                                { 
                                                    if($profile[0]['parent_id'] == 0)
                                                    { 
                                                        
                                                    
                                                
                                            ?>
                                            <div class="row mt-3">
                                                <div class="col-xl-4 col-lg-6" >
                                                <h5 class="mt-3">Proof of Banking Details <a href="../documents/<?php echo $profile[0]['bank_confirm']?>" target = "_BLANK">view</a></h5>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">
                                                    
                                                    <img src="../documents/<?php echo $profile[0]['bank_confirm']?>"width="500" height="300" alt="NO PREVIEW">
                                                    
                                                
                                                </div>                                               
                                            </div>
                                            
                                            <?php       }
                                                    }
                                            
                                            
                                                    if(isset($profile[0]))
                                                    { 
                                                        if($profile[0]['registration_type'] == "company")
                                                        { 
                                                            
                                            ?>
                                            <div class="row mt-3">
                                                <div class="col-xl-4 col-lg-6" >
                                                    <h5 class="mt-3">Proof of Address <a href="../documents/<?php echo $profile[0]['proof_address']?>" target = "_BLANK">view</a></h5>
                                                </div>
                                               <div class="col-xl-4 col-lg-6">
                                                    <img src="../documents/<?php echo $profile[0]['proof_address']?>" width="500" height="300" alt="NO PREVIEW">
                                                    
                                                </div>
                                            </div>                                          
                                            <div class="row mt-3">
                                                <div class="col-xl-4 col-lg-6" >
                                                    <h5 class="mt-3">Proof of Company registration <a href="../documents/<?php echo $profile[0]['company_registration']?>" target = "_BLANK">view</a> </h5>
                                                </div>
                                                <div class="col-xl-4 col-lg-6">  
                                                    <img src="../documents/<?php echo $profile[0]['company_registration']?>"width="500" height="300" alt="NO PREVIEW">                  
                                                    
                                                </div>
                                            </div>
                                            <?php 
                                                        }
                                                    }
                                            ?>
                                            <div class="left-timeline mt-3 pl-4">
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
                                            <!-- end row -->
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
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>