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
$minfo = $conn->getRow('modelinfo',['model_id'=>$_SESSION['id']]);
//print_r($minfo);die;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
                    <a class="nav-link" href="models.php">
                      <span class="menu-title">Models</span>
                      <i class="mdi mdi-account-multiple menu-icon "></i>
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
                                <ul id="progressbar">
                                    <li class="active">Categories-1</li>
                                    <li>Categories-2</li>
                                    <li>Categories-3</li>
                                </ul> 
                                <fieldset>
                                     <h4 class="mb-4">Categories-1</h4>
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
                                        <div class="form-group col-sm-6">                                          
                                            <label for="exampleInputEmail">Price</label>
                                            <p class="mb-0"><small>Set your Price</small></p>
                                            <div class="input-group">
                                               <input type="number" class="form-control form-control-lg" id="price"  placeholder="..$" value= "<?php if(isset($minfo[0])){ echo $minfo[0]['price']; } ?>">	
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
                                     <h4 class="mb-4">Categories-1</h4>
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
                                            
                                            <label for="exampleInputEmail">Breast size</label>
                                            <p class="mb-0"><small>Select Breast Size </small></p>
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
                                            <p class="mb-0"><small>Select hair look</small></p>
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
                                            <label for="exampleInputEmail">Eye color</label>
                                            <p class="mb-0"><small>Enter color of Eyes </small></p>
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
                                            <label for="exampleInputEmail">Broad Caste Plcae</label>
                                            <p class="mb-0"><small>Enter Place from where you'll online</small></p>
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
                                <fieldset>
                                     <h4 class="mb-4">Categories-2</h4>
                                    <div class="row">  
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
                                            <span class = "error" id = "genderErr"></span>
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
                                            <span class = "error" id = "genderErr"></span>
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
                                            <span class = "error" id = "genErr"></span>					
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
                                            <span class = "error" id = "dobErr"></span>
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
                                        </div>
                                    </div>
                                    <input type="button" name="previous" class="previous btn btn-primary" value="Previous"/>
                                    <input type="submit" name="next" id="next-1" class="next btn btn-primary" value="submit" />
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
        <script src="assets/js/img-upload.js"></script>
        <script src="assets/js/step-jquery.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script>
        
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