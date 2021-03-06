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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon1.png">
    <title>Pondacam | Home</title>
    
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
	
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.6.55/css/materialdesignicons.min.css">
    <!-- End layout styles -->
    <link rel="stylesheet" href="assets/css/stepForm.css">
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/img-upload.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.6.55/css/materialdesignicons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    
	<script src="https://use.fontawesome.com/0f43fe6a33.js"></script>
  </head>
  <style>
  .grid-margin {
    margin-bottom: 15px;
  }.card .card-body {
    padding: 2.5rem 1.5rem;
}
.padr200 {padding-right: 206px;}
.bg-gradient-danger {
    background: linear-gradient(to right, #d1b700, #fac400) !important;
    background: linear-gradient(to right, #d1b700, #fac400) !important;
}
.card.card-img-holder .card-img-absolute {
    position: absolute;
    top: 106px;
    right: 0;
    height: 70%;
    bottom: 0px;
}
.card.card-img-holder .card-img-absolute1 {
    position: absolute;
    top: 65px;
    right: 0;
    height: 75%;
    bottom: 0px;
}
.bg-gradient-danger1 {
    background: linear-gradient(to right, #fb0101, #d20000) !important;
    background: linear-gradient(to right, #fb0101, #d20000) !important;
}
.table th, .jsgrid .jsgrid-table th, .table td, .jsgrid .jsgrid-table td {
    border-top: none;
}
</style>
  
<body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="#"><img src="logo-compact1.png" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="#"><img src="favicon1.png" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          
          <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item nav-profile" >
				        
		        <a class="nav-link " id="profileDropdown" href="tipHistory.php" data-toggle="dropdown" aria-expanded="false">
					<div class="nav-profile-text">
						<p class="mb-1">
						    
						    <?php 
						        $usr = $conn->getRow('users',["id" => $_SESSION['id'] ]);
						    ?>
						    <i class="fa fa-database" aria-hidden="true"></i>
							 <?php if(isset($usr)){echo $usr[0]["money"]; }else{echo 0; }?> tk
						</p>
					</div>
				</a>
		    </li>
		    <li class="nav-item nav-profile dropdown" >
		        
		        <a class="nav-link " id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
					<div class="nav-profile-text">
						<p class="mb-1">
						    
						    <?php 
						        $favorites = $conn->getRow('favorites',["model" => $_SESSION['id'] ]);
						        $usr = $conn->getRow('users',["id" => $_SESSION['id'] ]);
						    ?>
						    <i class="fa fa-heart" aria-hidden="true"></i>
							 <?php if(isset($favorites)){echo count($favorites); }else{echo 0; }?>
						</p>
					</div>
				</a>
		    </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-text">
                  <p class="mb-1"><?php echo $_SESSION['name'] ?></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-cached mr-2"></i> Activity Log </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../logout.php">
                  <i class="mdi mdi-logout mr-2"></i> Signout </a>
              </div>
            </li>
         </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
             <li class="nav-item">
                <a class="nav-link" href="home.php">
                  <span class="menu-title">Home</span>
                  <i class="mdi mdi-home menu-icon"></i>
                </a>
             </li>
            <li class="nav-item">
                <a class="nav-link" href="livesession.php">
                  <span class="menu-title">Live Session</span>
                  <i class="mdi mdi-chart-line menu-icon "></i>
                </a>
            </li>
			        <li class="nav-item">
                <a class="nav-link" href="index.php">
                  <span class="menu-title">Statistic</span>
                  <i class="mdi mdi-chart-line menu-icon "></i>
                </a>
              </li>
			      <li class="nav-item">
              <a class="nav-link" href="profile.php">
                <span class="menu-title">Personal Data</span>
                <i class="mdi mdi-settings menu-icon "></i>
              </a>
            </li>			
            <li class="nav-item">
              <a class="nav-link" href="tipHistory.php" > <span class="menu-title">Earnings</span>  <i class="mdi mdi-buffer menu-icon"></i> </a>
						
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">
                <span class="menu-title">Security & Privacy</span>
                <i class="mdi mdi-bullhorn menu-icon "></i>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#helpinfo" aria-expanded="false" aria-controls="page-layouts">
                  <span class="menu-title">Help & Info </span>
                  <i class="menu-arrow"></i>
                  <i class="mdi mdi-information-outline menu-icon"></i>
                </a>
                <div class="collapse" id="helpinfo" style="color:white;">
                    Email  <a href = "mailto: admin@pondacams.com" style="color:yellow;"><b style="color:yellow;">admin@pondacams.com</b> </a> for help
                  <!--<ul class="nav flex-column sub-menu">
                    <li class="nav-item" style="color:yellow"> <a class="nav-link" href="#">Contact</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Chat</a></li>
                  </ul>-->
                </div>
            </li>           
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Token History </h3>
            </div>		
            <div class="row">
                
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                        <form id="msform">
                             <!-- progressbar -->
                            <!--<ul id="progressbar">
                                <li class="active">Categories-1</li>
                                <li>Categories-2</li>
                                <li>Categories-3</li>
                            </ul>    -->
                            <fieldset>
                                 <h4 class="mb-4">Block countries</h4>
                                <div class="row">  
                                    <div class="form-group col-sm-6">
                                        <input type="hidden" id = "id" value = "<?php if(isset($_SESSION['id'])){ echo $_SESSION['id'];} ?>">
                                        <label for="exampleInputEmail">Block countries</label>
                                        <p class="mb-0"><small>Select countries you want to block</small></p>
                                        <div class="input-group">                                               
                                            <select  multiple class="form-control form-control-lg js-example-basic-multiple" name = "showType" id = "countrySelect">
                                                <option value="">Select...</option>
                                                <?php 
                                                    $country   = $conn -> getRow("country");
                                                    $modelinfo = $conn -> getRow("modelinfo",["model_id" => $_SESSION['id']]);
                                                    foreach($country as $ind => $row)
                                                    {
                                                        $blonkedCountry = $modelinfo[0]["blocked_countries"];
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
                                        <span class = "error" id = "showTypeErr"></span>
                                    </div>
                                    
                                    				  
                                    
                                
                        
                                </div>
                                <script>
                                    function saveBlocked()
                                    {
                                        var selectC = document.getElementById("countrySelect");
                                        var options = selectC.selectedOptions;
                                        var values = Array.from(options).map(({ value }) => value);
                                        console.log(values);
                                        
                                        $.get('./saveBlocked.php', 
                                        {   
                                            id:"<?php echo $_SESSION['id']; ?>",
                                            blocked:values.toString()
                                        }, 
                                        function(response)
                                        {
                                            
                                            console.log(response);
                                            
                                        });
                                    }
                                </script>
                                <input type="button" name="Save" id="next-1" class="next btn btn-primary" value="Save" onclick="saveBlocked()" />
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
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ?? 2020 
          <a href="" target="_blank">Pondacam</a>. All rights reserved.</span>  
        </div>
      </footer>
          <!-- partial -->
    </div>
        <!-- main-panel ends -->
  </div>
      <!-- page-body-wrapper ends -->
  </div>
    <!-- container-scroller -->
<script src="assets/js/vendor.bundle.base.js"></script>
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<script src="assets/js/pondacam-main.js"></script>

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
    <!-- endinject -->
</body>
</html>