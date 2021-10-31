<?php
include 'config.php';
if(!isset($_SESSION['name'])){	
	echo "<script>window.location.href='../login.php'</script>";
}else{
	$row = $conn->getRow('users',['id'=>$_SESSION['id']]);
	if($row[0]['user_type']==1 || $row[0]['registration_type']!='individual'){
		echo "<script>window.location.href='../login.php'</script>";
	}
	elseif($row[0]['status'] !='approved'){
	  echo "<script>window.location.href='../registerUpdate.php'</script>";
	}
}
$minfo = $conn->getRow('modelinfo',['model_id'=>$_SESSION['id']]);
$pinfo = $conn->getRow('banking_details',['user_id'=>$_SESSION['id']]);
$preference = $conn->getRow('preference',['model_id'=>$_SESSION['id']]);
$url1 = "https://countriesnow.space/api/v0.1/countries";
$xml1 = file_get_contents($url1);

//print_r($minfo);die;

/*POST 'https://countriesnow.space/api/v0.1/countries/states' \
--data-raw '{
    "country": "Nigeria"
}*/
$xml = file_get_contents("https://countriesnow.space/api/v0.1/countries/states");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <link rel="icon" type="image/png" sizes="16x16" href="favicon1.png">
        <title>Pondacam | Edit Account</title>
        <link rel="stylesheet" href="assets/css/stepForm.css">
        <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/img-upload.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.6.55/css/materialdesignicons.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <script>
            var cities = <?php echo json_encode($xml1); ?>;
            var country_code = '<?php echo $minfo[0]["country_code"]; ?>';
            var state = '<?php echo $minfo[0]["province"]; ?>';
            var citySel = '<?php echo $minfo[0]["city"]; ?>';
            var json = JSON.parse(cities);
            //console.log(json.data)
        </script>
    </head>
    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <?php include 'topbar.php'; ?>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
              <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                  <li class="nav-item ">
                    <a class="nav-link" href="home.php">
                      <span class="menu-title">Home</span>
                      <i class="mdi mdi-home menu-icon"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php">
                      <span class="menu-title">Statistic</span>
                      <i class="mdi mdi-chart-line menu-icon "></i>
                    </a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="profile.php">
                      <span class="menu-title">Personal Data</span>
                      <i class="mdi mdi-settings menu-icon "></i>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" href="tipHistory.php" > <span class="menu-title">Earnings</span>  <i class="mdi mdi-buffer menu-icon"></i> </a>
						
                  </li>
                  <li class="nav-item">
                    	<a class="nav-link" href="security.php"> <span class="menu-title">Security & Privacy</span> <i class="mdi mdi-bullhorn menu-icon "></i> </a>
					
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
                                <?php 
                                    $modelUser = $conn -> getRow("users",["id" => $_SESSION["id"]]);
                                    
                                    if($modelUser[0]["parent_id"] != 0)
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
                                 <!-- progressbar -->
                                <ul id="progressbar" style="width:auto;">
                                    <li class="active">SHOW</li>
                                    <li>APPEARANCE</li>
                                    <?php 
                                    
                                    if($modelUser[0]["parent_id"] == 0)
                                    { ?>
                                    <li>PAYMENT DETAILS</li>
                                    <?php } ?>
                                    <li>PREFERENCE</li>
                                    <li>LOCATION</li>
                                </ul> 
                                <fieldset>
                                     <h4 class="mb-4">SHOW</h4>
                                    <div class="row">  
                                        <div class="form-group col-sm-6">
                                        <input type="hidden" id = "id" value = "<?php if(isset($_SESSION['id'])){ echo $_SESSION['id'];} ?>">
                                            <label for="exampleInputEmail">Show Type</label>
                                            <p class="mb-0"><small>Select Show type which way you want</small></p>
                                            <div class="input-group">                                               
                                                <select  multiple class="form-control form-control-lg js-example-basic-multiple" name = "showType" id = "showType">
                                                    <option value="">Select...</option>
                                                    <option value="video_call"<?php if(isset($minfo[0]) AND in_array('video_call', explode(",",$minfo[0]['showType']))){echo "selected";}?>>Video Call</option>
                                                    <option value="private_chat"<?php if(isset($minfo[0]) AND in_array('private_chat', explode(",",$minfo[0]['showType']))){echo "selected";}?>>Private Chat</option>
                                                    <option value="free_chat"<?php if(isset($minfo[0]) AND in_array('free_chat', explode(",",$minfo[0]['showType']))){echo "selected";}?>>Free Chat</option>
                                                    <option value="mobile_live"<?php if(isset($minfo[0]) AND in_array('mobile_live', explode(",",$minfo[0]['showType']))){echo "selected";}?>>Mobile Live</option>
                                                    <option value="vip_show"<?php if(isset($minfo[0]) AND in_array('vip_show', explode(",",$minfo[0]['showType']))){echo "selected";}?>>VIP Show</option>
                                                    <option value="two_way_audio"<?php if(isset($minfo[0]) AND in_array('two_way_audio', explode(",",$minfo[0]['showType']))){echo "selected";}?>>Two-way Audio</option>
                                                    <option value="story"<?php if(isset($minfo[0]) AND in_array('story', explode(",",$minfo[0]['showType']))){echo "selected";}?>>Story </option>
                                                    <option value="hd"<?php if(isset($minfo[0]) AND in_array('hd', explode(",",$minfo[0]['showType']))){echo "selected";}?>>HD</option>
                                                    
                                                </select>	
                                            </div>
                                            <span class = "error" id = "showTypeErr"></span>
                                        </div>
                                        <div class="form-group col-sm-6" style="display:none;">                                          
                                            <label for="exampleInputEmail">Price</label>
                                            <p class="mb-0"><small>Set your Price</small></p>
                                            <div class="input-group">
                                               <input type="number" class="form-control form-control-lg" id="price"  placeholder="..$" value= "<?php if(isset($minfo[0])){ echo $minfo[0]['price']; }else{ echo 0;} ?>">	
                                            </div>
                                            <span class = "error" id = "priceErr"></span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Willingness</label>
                                            <p class="mb-0"><small>Select Your willingness</small></p>
                                            <div class="input-group">
                                                <select multiple class="form-control form-control-lg js-example-basic-multiple"  id = "willingness">
                                                    <option value="" >Select...</option>
                                                    <option value="Close-up"<?php if(isset($minfo[0]) AND in_array('Close-up', explode(",",$minfo[0]['willingness']))){echo "selected";}?>>Close-up</option>
                                                    <option value="Dominant"<?php if(isset($minfo[0]) AND in_array('Dominant', explode(",",$minfo[0]['willingness']))){echo "selected";}?>>Dominant</option>
                                                    <option value="Toys"<?php if(isset($minfo[0]) AND in_array('Toys', explode(",",$minfo[0]['willingness']))){echo "selected";}?>>Toys</option>
                                                    <option value="Smoking"<?php if(isset($minfo[0]) AND in_array('Smoking', explode(",",$minfo[0]['willingness']))){echo "selected";}?>>Smoking</option>
                                                    <option value="Dancing"<?php if(isset($minfo[0]) AND in_array('Dancing', explode(",",$minfo[0]['willingness']))){echo "selected";}?>>Dancing</option>
                                                    <option value="Submissive"<?php if(isset($minfo[0]) AND in_array('Submissive', explode(",",$minfo[0]['willingness']))){echo "selected";}?>>Submissive</option>
                                                    <!--<option value="Escort"<?php if(isset($minfo[0]) AND in_array('Escort', explode(",",$minfo[0]['willingness']))){echo "selected";}?>>Escort</option>-->
                                                </select>													
                                            </div>
                                            <span class = "error" id = "willingnessErr"></span>					
                                        </div>					  
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Language</label>
                                            <p class="mb-0"><small>Select language which preferred</small></p>
                                            <div class="input-group">								
                                            <select multiple class="form-control form-control-lg js-example-basic-multiple"  id = "language">
                                                    <option value="" >Select...</option>
                                                    <option value="Spanish"<?php if(isset($minfo[0]) AND in_array('Spanish', explode(",",$minfo[0]['language']))){echo "selected";}?>>Spanish</option>
                                                    <option value="German"<?php if(isset($minfo[0]) AND in_array('German', explode(",",$minfo[0]['language']))){echo "selected";}?>>German</option>
                                                    <option value="Italian"<?php if(isset($minfo[0]) AND in_array('Italian', explode(",",$minfo[0]['language']))){echo "selected";}?>>Italian</option>
                                                    <option value="French"<?php if(isset($minfo[0]) AND in_array('French', explode(",",$minfo[0]['language']))){echo "selected";}?>>French</option>
                                                    <option value="English"<?php if(isset($minfo[0]) AND in_array('English', explode(",",$minfo[0]['language']))){echo "selected";}?>>English</option>
                                                </select>	
                                            </div>
                                            <span class = "error" id = "languageErr"></span>
                                        </div>
                                    
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Age</label>
                                            <p class="mb-0"><small>Type your actual age</small></p>
                                            <div class="input-group">
                                            <input type="number" class="form-control form-control-lg" id="age"  placeholder="...year" value= "<?php if(isset($minfo[0])){ echo $minfo[0]['age']; } ?>">	
                                            </div>	
                                            <div><span class = "error" id = "ageErr"></span></div>
                                        </div>
                            
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Ethnicity</label>
                                            <p class="mb-0"><small>Select Your Ethnicity</small></p>
                                            <div class="input-group">
                                                <select class="form-control form-control-lg" id = "ethnicity">
                                                    <option value="" >Select...</option>
                                                    <option value="Asian"<?php if(isset($minfo[0]) AND $minfo[0]['ethnicity']=='Asian'){echo "selected";}?>>Asian</option>                                                                           
                                                    <option value="Ebony"<?php if(isset($minfo[0]) AND $minfo[0]['ethnicity']=='Ebony'){echo "selected";}?>>Ebony</option>                                                                           
                                                    <option value="Latin"<?php if(isset($minfo[0]) AND $minfo[0]['ethnicity']=='Latin'){echo "selected";}?>>Latin</option>                                                                           
                                                    <option value="White"<?php if(isset($minfo[0]) AND $minfo[0]['ethnicity']=='White'){echo "selected";}?>>White</option>                                                                           
                                                </select>	
                                            </div>
                                            <span class = "error" id = "ethnicityErr"></span>
                                        </div>
                                    </div>
                                    <input type="button" name="next" id="next-1" class="next btn btn-primary" value="Next" />
                                </fieldset> 
                                <fieldset>
                                     <h4 class="mb-4">APPEARANCE</h4>
                                    <div class="row">  
                                        <div class="form-group col-sm-6">
                                       <!-- hiddn tha ab nhi hai -->
                                            <label for="exampleInputEmail">Appearance</label>
                                            <p class="mb-0"><small>Select Your Appearance</small></p>
                                            <div class="input-group">
                                            <select multiple class=" js-example-basic-multiple form-control form-control-lg"  id = "appearance" style = "width: 529px;">
                                                    <option value="" >Select...</option>
                                                    <option value="BBW"<?php if(isset($minfo[0]) AND in_array('BBW', explode(",",$minfo[0]['appearance']))){echo "selected";}?>>BBW</option>                                                   
                                                    <option value="Petite"<?php if(isset($minfo[0]) AND in_array('Petite', explode(",",$minfo[0]['appearance']))){echo "selected";}?>>Petite</option>                                                                                                     
                                                    <option value="Stockings"<?php if(isset($minfo[0]) AND in_array('Stockings', explode(",",$minfo[0]['appearance']))){echo "selected";}?>>Stockings</option>                                                   
                                                    <option value="Tattoo"<?php if(isset($minfo[0]) AND in_array('Tattoo', explode(",",$minfo[0]['appearance']))){echo "selected";}?>>Tattoo</option>                                                   
                                                    <option value="Piercing"<?php if(isset($minfo[0]) AND in_array('Piercing', explode(",",$minfo[0]['appearance']))){echo "selected";}?>>Piercing</option>                                                   
                                                </select>	
                                            </div>
                                            <span class = "error" id = "appearanceErr"></span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <?php
                                                $gen = $modelUser[0]["gender"];
                                                
                                                $size = "";
                                                if($gen == "male")
                                                {
                                                    $size = "Dick Size";
                                            
                                                }
                                                else
                                                {
                                                    $size = "Breast Size";
                                                }
                                            ?>
                                            <label for="exampleInputEmail"><?php echo $size; ?></label>
                                            <p class="mb-0"><small>Select <?php echo $size; ?> </small></p>
                                            <div class="input-group">
                                            <select class="form-control form-control-lg"  id = "bSize">
                                                    <option value="" >Select...</option>
                                                    <option value="Tiny"<?php if(isset($minfo[0]) AND $minfo[0]['bSize']=='Tiny'){echo "selected";}?>>Tiny</option>
                                                    <option value="Normal"<?php if(isset($minfo[0]) AND $minfo[0]['bSize']=='Normal'){echo "selected";}?>>Normal</option>
                                                    <option value="Big"<?php if(isset($minfo[0]) AND $minfo[0]['bSize']=='Big'){echo "selected";}?>>Big</option>
                                                    <option value="Huge"<?php if(isset($minfo[0]) AND $minfo[0]['bSize']=='Huge'){echo "selected";}?>>Huge</option>
                                                </select>	
                                            </div>
                                            <span class = "error" id = "bSizeErr"></span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Hair</label>
                                            <p class="mb-0"><small>Select hair Color</small></p>
                                            <div class="input-group">
                                                <select class="form-control form-control-lg"  id = "hair">
                                                    <option value="" >Select...</option>
                                                    <option value="Black"<?php if(isset($minfo[0]) AND $minfo[0]['hair']=='Black'){echo "selected";}?>>Black</option>
                                                    <option value="Blonde"<?php if(isset($minfo[0]) AND $minfo[0]['hair']=='Blonde'){echo "selected";}?>>Blonde</option>
                                                    <option value="Brunette"<?php if(isset($minfo[0]) AND $minfo[0]['hair']=='Brunette'){echo "selected";}?>>Brunette</option>
                                                    <option value="Redhead"<?php if(isset($minfo[0]) AND $minfo[0]['hair']=='Redhead'){echo "selected";}?>>Redhead</option>
                                                    <option value="Long"<?php if(isset($minfo[0]) AND $minfo[0]['hair']=='Long'){echo "selected";}?>>Long</option>
                                                    <option value="Short"<?php if(isset($minfo[0]) AND $minfo[0]['hair']=='Short'){echo "selected";}?>>Short</option>
                                                </select>													
                                            </div>
                                            <span class = "error" id = "hairErr"></span>					
                                        </div>					  
                                                   
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Eye color</label>
                                            <p class="mb-0"><small>Select Eyes color  </small></p>
                                            <div class="input-group">
                                                <select class="form-control form-control-lg"  id = "eye">
                                                    <option value="" >Select...</option>
                                                    <option value="blue"<?php if(isset($minfo[0]) AND $minfo[0]['eyecolor']=='blue'){echo "selected";}?>>blue</option>
                                                    <option value="black"<?php if(isset($minfo[0]) AND $minfo[0]['eyecolor']=='black'){echo "selected";}?>>black</option>
                                                    <option value="brownish"<?php if(isset($minfo[0]) AND $minfo[0]['eyecolor']=='brownish'){echo "selected";}?>>brownish</option>
                                                </select>	
                                            </div>	
                                            <div><span class = "error" id = "eyeErr"></span></div>
                                        </div>
                            
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Broadcasting Place</label>
                                            <p class="mb-0"><small>Where you'll be Broadcasting From</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="place" 
                                                value = "<?php if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>">
                                            </div>
                                            <span class = "error" id = "placeErr"></span>
                                        </div>
                                    </div>
                                    <input type="button" name="previous" class="previous btn btn-primary" value="Previous"/>
                                    <input type="button" name="next" id="next-2" class="next btn btn-primary" id="next-2" value="Next"/>
                                </fieldset>  
                                <?php 
                                    
                                    
                                    if($modelUser[0]["parent_id"] == 0)
                                    {
                                ?>
                                <fieldset>
                                     <h4 class="mb-4">PAYMENT DETAILS</h4>
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
                                        
                                    </div>
                                    <input type="button" name="previous" class="previous btn btn-primary" value="Previous"/>
                                    <input type="button" name="next" id="next-3" class="next btn btn-primary" id="next-3"  value="Next"/>
                                </fieldset> 
                                <?php } ?>
                                <fieldset>
                                     <h4 class="mb-4">SHOW PREFERENCE</h4>
                                    <div class="row">  
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">PRIVATE</label>
                                            <p class="mb-0"><small>How many tokens per minutes </small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="private_tokens" 
                                                value = "<?php if(isset($preference[0])){ echo $preference[0]['private'];}?>">
                                                <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                            </div>
                                            <span class = "error" id = "private_nameErr"></span>
                                        </div>
                                        
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">CAM TO CAM</label>
                                            <p class="mb-0"><small>How many tokens per minutes</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="cam_tokens" 
                                                value = "<?php if(isset($preference[0])){ echo $preference[0]['camtocam'];}?>">
                                                <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                            </div>
                                            <span class = "error" id = "cam_noErr"></span>
                                        </div>
                                        
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Spy</label>
                                            <p class="mb-0"><small>How many tokens per minutes</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="Spy" 
                                                value = "<?php if(isset($preference[0])){ echo $preference[0]['spy'];}?>">
                                                <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                            </div>
                                            <span class = "error" id = "spy_codeErr"></span>
                                        </div>
                                        
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Paid picture price</label>
                                            <p class="mb-0"><small>How many tokens for Paid pictures</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="picture_price" 
                                                value = "<?php if(isset($preference[0])){ echo $preference[0]['picture_price'];}?>">
                                                <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                            </div>
                                            <span class = "error" id = "picture_price_codeErr"></span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Paid video price</label>
                                            <p class="mb-0"><small>How many tokens for Paid videos </small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="video_price" 
                                                value = "<?php if(isset($preference[0])){ echo $preference[0]['video_price'];}?>">
                                                <!--<?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>-->
                                            </div>
                                            <span class = "error" id = "video_price_codeErr"></span>
                                        </div>
                                        <!--<div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">ACCOUNT TYPE</label>
                                            <p class="mb-0"><small>Enter Account type</small></p>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="account_type" 
                                                value = "<?php if(isset($pinfo[0])){ echo $pinfo[0]['account_type'];}?>">
                                                <?php //if(isset($minfo[0])){ echo $minfo[0]['broadcastplace'];}?>
                                            </div>
                                            <span class = "error" id = "account_typeErr"></span>
                                        </div>-->
                                        
                                    </div>
                                    <input type="button" name="previous" class="previous btn btn-primary" value="Previous"/>
                                    <input type="button" name="next" id="next-4" class="next btn btn-primary" id="next-4"  value="Next"/>
                                </fieldset>
                                <fieldset>
                                     <h4 class="mb-4">LOCATION</h4>
                                    <div class="row"> 
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Region</label>
                                            <p class="mb-0"><small>Select your region </small></p>
                                            <div class="input-group">								
                                            <select class="form-control form-control-lg"  id = "region">
                                                    <option value="" >Select...</option>
                                                    <option value="America_uk_Australia"<?php if(isset($minfo[0]) AND $minfo[0]['region']=='America_uk_Australia'){echo "selected";}?>>North America/UK/Australia</option>
                                                    <option value="Europe"<?php if(isset($minfo[0]) AND $minfo[0]['region']=='Europe'){echo "selected";}?>>Europe</option>
                                                    <option value="s_america"<?php if(isset($minfo[0]) AND $minfo[0]['region']=='s_america'){echo "selected";}?>>South America</option>
                                                    <option value="Asia"<?php if(isset($minfo[0]) AND $minfo[0]['region']=='Asia'){echo "selected";}?>>Asia</option>
                                                    <option value="Africa"<?php if(isset($minfo[0]) AND $minfo[0]['region']=='Africa'){echo "selected";}?>>Africa</option>
                                                </select>	
                                            </div>
                                            <span class = "error" id = "regionErr"></span>
                                        </div> 
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Country</label>
                                            <p class="mb-0"><small>Select country</small></p>
                                            <div class="input-group">                                               
                                                <select  class="form-control form-control-lg" name = "country" id = "countrySelect" onchange="getState(this.value)">
                                                    <option value="">Select...</option>
                                                    <?php 
                                                        $country   = $conn -> getRow("country");
                                                        $modelinfo = $conn -> getRow("modelinfo",["model_id" => $_SESSION['id']]);
                                                        foreach($country as $ind => $row)
                                                        {
                                                            $blonkedCountry = $modelinfo[0]["country_code"];
                                                            $selected = "";
                                                            if(in_array($row["code"], explode(",",$blonkedCountry)))
                                                            {
                                                                $selected = "selected";
                                                            }
                                                            echo '<option value="'.$row["code"].'" '.$selected.'>'.$row["name"].'</option>';
                                                            
                                                        }
                                                    ?>
                                                    
                                                </select>	
                                            </div>
                                            <span class = "error" id = "countryErr"></span>
                                        </div>
                                        <div class="form-group col-sm-6">                                       
                                            <label for="exampleInputEmail">Province</label>
                                            <p class="mb-0"><small>Select province</small></p>
                                            <div class="input-group">
                                            <select class="form-control form-control-lg" name = "province" id = "province" onchange="">
                                                    <!--<option value="" >Select...</option>
                                                    <option value="Eastern_Cape"<?php if(isset($minfo[0]) AND in_array('Eastern_Cape', explode(",",$minfo[0]['province']))){echo "selected";}?> >Eastern Cape</option>
                                                    <option value="Free_State"<?php if(isset($minfo[0]) AND in_array('Free_State', explode(",",$minfo[0]['province']))){echo "selected";}?> >Free State</option>
                                                    <option value="Gauteng"<?php if(isset($minfo[0]) AND in_array('Gauteng', explode(",",$minfo[0]['province']))){echo "selected";}?> >Gauteng</option>
                                                    <option value="KwaZulu_Natal"<?php if(isset($minfo[0]) AND in_array('KwaZulu_Natal', explode(",",$minfo[0]['province']))){echo "selected";}?> >KwaZulu-Natal</option>
                                                    <option value="Limpopo"<?php if(isset($minfo[0]) AND in_array('Limpopo', explode(",",$minfo[0]['province']))){echo "selected";}?> >Limpopo</option>
                                                    <option value="Mpumalanga"<?php if(isset($minfo[0]) AND in_array('Mpumalanga', explode(",",$minfo[0]['province']))){echo "selected";}?> >Mpumalanga</option>
                                                    <option value="Northern_Cape"<?php if(isset($minfo[0]) AND in_array('Northern_Cape', explode(",",$minfo[0]['province']))){echo "selected";}?> >Northern Cape</option>
                                                    <option value="North_West"<?php if(isset($minfo[0]) AND in_array('North_West', explode(",",$minfo[0]['province']))){echo "selected";}?> >North West</option>
                                                    <option value="Western_Cape"<?php if(isset($minfo[0]) AND in_array('Western_Cape', explode(",",$minfo[0]['province']))){echo "selected";}?> >Western Cape</option>-->
                                                </select>
                                            </div>
                                            <span class = "error" id = "provinceErr"></span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                        <label for="exampleInputEmail">City</label>
                                            <p class="mb-0"><small>Select city</small></p>
                                            <div class="input-group">
                                            <select class="form-control form-control-lg" name = "city" id = "city">
                                                    <option value="" >Select...</option>
                                                    <option value="Durban"<?php if(isset($minfo[0]) AND in_array('Durban', explode(",",$minfo[0]['city']))){echo "selected";}?> >Durban</option>
                                                    <option value="Johannesburg"<?php if(isset($minfo[0]) AND in_array('Johannesburg', explode(",",$minfo[0]['city']))){echo "selected";}?> >Johannesburg</option>
                                                    <option value="Cape_Town"<?php if(isset($minfo[0]) AND in_array('Cape_Town', explode(",",$minfo[0]['city']))){echo "selected";}?> >Cape Town</option>
                                                    <option value="Pretoria"<?php if(isset($minfo[0]) AND in_array('Pretoria', explode(",",$minfo[0]['city']))){echo "selected";}?> >Pretoria & Centurion</option>
                                                    <option value="Pietermaritzburg"<?php if(isset($minfo[0]) AND in_array('Pietermaritzburg', explode(",",$minfo[0]['city']))){echo "selected";}?>>Pietermaritzburg</option>
                                                    <option value="RSA"<?php if(isset($minfo[0]) AND in_array('RSA', explode(",",$minfo[0]['city']))){echo "selected";}?>>Others</option>
                                                </select>
                                            </div>
                                            <span class = "error" id = "cityErr"></span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                        <label for="exampleInputEmail">Area</label>
                                            <p class="mb-0"><small>Select area</small></p>
                                            <div class="input-group">
                                            <input type="text" class="form-control form-control-lg" name = "area" id = "area"
                                                value = "<?php if(isset($minfo[0])){ echo $minfo[0]['area'];}?>" />
                                            <!--<select class="form-control form-control-lg" name = "area" id = "area">
                                                    <option value="" >Select...</option>
                                                    <option value="Durban_North"<?php if(isset($minfo[0]) AND in_array('Durban_North', explode(",",$minfo[0]['area']))){echo "selected";}?>  >Durban North</option>
                                                    <option value="Windemere"<?php if(isset($minfo[0]) AND in_array('Windemere', explode(",",$minfo[0]['area']))){echo "selected";}?> >Windemere</option>
                                                    <option value="Verulam"<?php if(isset($minfo[0]) AND in_array('Verulam', explode(",",$minfo[0]['area']))){echo "selected";}?> >Verulam</option>
                                                    <option value="Glen_Ashley"<?php if(isset($minfo[0]) AND in_array('Glen_Ashley', explode(",",$minfo[0]['area']))){echo "selected";}?> >Glen Ashley</option>
                                                    <option value="Overport"<?php if(isset($minfo[0]) AND in_array('Overport', explode(",",$minfo[0]['area']))){echo "selected";}?> >Overport</option>
                                                    <option value="Chartsworth"<?php if(isset($minfo[0]) AND in_array('Chartsworth', explode(",",$minfo[0]['area']))){echo "selected";}?> >Chartsworth</option>
                                                    <option value="Tongaat"<?php if(isset($minfo[0]) AND in_array('Tongaat', explode(",",$minfo[0]['area']))){echo "selected";}?> >Tongaat</option>
                                                    <option value="Gateway"<?php if(isset($minfo[0]) AND in_array('Gateway', explode(",",$minfo[0]['area']))){echo "selected";}?> >Gateway</option>
                                                    <option value="Phoenix"<?php if(isset($minfo[0]) AND in_array('Phoenix', explode(",",$minfo[0]['area']))){echo "selected";}?> >Phoenix</option>
                                                    <option value="Res_Hills"<?php if(isset($minfo[0]) AND in_array('Res_Hills', explode(",",$minfo[0]['area']))){echo "selected";}?> >Res Hills</option>
                                                    <option value="RSA"<?php if(isset($minfo[0]) AND in_array('RSA', explode(",",$minfo[0]['area']))){echo "selected";}?> >Other</option>
                                                </select>-->
                                            </div>
                                            <span class = "error" id = "areaErr"></span>					
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail">Bio</label>
                                            <p class="mb-0"><small>Enter Short Description</small></p>
                                            <div class="input-group">
                                                <textarea fprm="msform" class="form-control form-control-lg" id="bio" rows="4" cols="50" 
                                                value = ""><?php if(isset($minfo[0])){ echo $minfo[0]['bio'];}?></textarea >
                                            </div>
                                            <span class = "error" id = "bioErr"></span>
                                        </div>
                                    
                                       <!-- <div class="form-group col-sm-6">
                                        <label for="exampleInputEmail">Select</label>
                                            <p class="mb-0"><small>Select</small></p>
                                            <div class="input-group">
                                            <select class="form-control form-control-lg" name = "gender" id = "gender">
                                                    <option value="" >Select...</option>
                                                    <option value=""></option>
                                                    <option value=""></option>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div><span class = "error" id = "contErr"></span></div>
                                        </div>
                            
                                        <div class="form-group col-sm-6">
                                        <label for="exampleInputEmail">Select</label>
                                            <p class="mb-0"><small>Select</small></p>
                                            <div class="input-group">
                                            <select class="form-control form-control-lg" name = "gender" id = "gender">
                                                    <option value="" >Select...</option>
                                                    <option value=""></option>
                                                    <option value=""></option>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <span class = "error" id = "idNErr"></span>
                                        </div>-->
                                    </div>
                                    <input type="button" name="previous" class="previous btn btn-primary" value="Previous"/>
                                    <input type="button" name="next" id="next-7" class="next btn btn-primary" value="Save" />
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
        <!-- <script src="https://fintranxect.com/testing/assets/js/jquery.min.js"></script> -->
        <script src="assets/js/vendor.bundle.base.js"></script>
        <script src="assets/js/off-canvas.js"></script>
        <script src="assets/js/hoverable-collapse.js"></script>
        <script src="assets/js/misc.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <!--<script src="assets/js/img-upload.js"></script> -->
        <script src="assets/js/step-jquery.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script>
            
            function getState(country_id)
            {
                $('#province').empty();
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
                        var x = document.getElementById("province");
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
                xhttp.open("POST", "getCountry.php", true);
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
                
                var country  = $( "#countrySelect option:selected" ).text();
                //var country = document.createElement("countrySelect").value;
                var province = $( "#province option:selected" ).text();
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
        <!-- <script> 
         var xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function ()
        {
          if (this.readyState == 4 && this.status == 200)
          {
          var response = this.responseText;
         // console.log(response);
          var row = JSON.parse(response);
          // alert(row[0]['registration_type']);
          //console.log(row[0]);
           // console.log(JSON.parse(response)[0]);       
          }
            $(function() {
              if(row[0]['registration_type']!=null){
                $("#myModal").modal("hide");
                
              }else{
                $("#myModal").modal();
              }          	       	
            });                
            $('#myModal input').on('change', function() {
              var ty = $('input[name=userType]:checked', '#myModal').val(); 
              $("#myModal").modal("hide");
            });  
        }; 
        xhttp.open("POST", "ajaxdata.php", true);
        xhttp.send();   
        
        </script> -->
  </body>
</html>