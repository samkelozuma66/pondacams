<?php
include 'config.php';
if(!isset($_SESSION['name'])){	
	echo "<script>window.location.href='../login.php'</script>";
}else{
	$row = $conn->getRow('users',['id'=>$_SESSION['id']]);
	if($row[0]['user_type']==1){
		echo "<script>window.location.href='../login.php'</script>";
	}
	elseif($row[0]['status'] !='approved'){
	  echo "<script>window.location.href='../registerUpdate.php'</script>";
	}
}
$row = $conn->getRow('users',['id'=>$_SESSION['id']]);
$row1 = $conn->getRow('modelinfo',['model_id'=>$_SESSION['id']]);
$pic = $conn->getRow('modelpictures',['model_id'=>$_SESSION['id']]);
$video = $conn->getRow('users',['id'=>$_SESSION['id']]);
//print_r($video[0]['model_video']);die;
?>
<?php
$videoErr = "";
if($_SERVER['REQUEST_METHOD']=='POST'){
   // print_r($_FILES);
	 $error = true;
	//print_r($_POST);
	//print_r($_FILES);die;
	$video = $_FILES['modelvideo']['name'];
    $ext  = strtolower(pathinfo($video, PATHINFO_EXTENSION));
   // print_r($ext);die;
    if(empty($video)){
		$error = false;
		$videoErr = "Choose File First!!";
	}elseif(($ext=="mp4") || ($ext =="AVI")||($ext=="MKV")||($ext=="FLV")||($ext=="WMV")||($ext=="MOV")||($ext=="AVCHD")||($ext=="WebM")){
		$video = time().$_FILES['modelvideo']['name'];
		move_uploaded_file($_FILES["modelvideo"]["tmp_name"],'../model_video/'.$video);            
	}else{
		$error = false;
		$videoErr = "UnSupport File Format!!!";
	}
	if($error){
        $data = ['model_video'=>$video];
		$go = $conn->updateData('users',$data,['id'=>$_SESSION['id']]);
		if(isset($go)){
			echo "<script>window.location.href='profile.php'</script>";
		}
	} 
}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pondacam | Profile</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
	
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.6.55/css/materialdesignicons.min.css">
    <!-- End layout styles -->
   
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
          <a class="navbar-brand brand-logo" href="#"><img src="assets/images/logo-compact.png" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="#"><img src="assets/images/favicon.png" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-text">
                  <p class="mb-1"><?php if(isset($row[0])){echo $row[0]['name'];}else{ echo "";} ?></p>
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
             <li class="nav-item ">
              <a class="nav-link" href="home.php">
                <span class="menu-title">Home</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
			<li class="nav-item">
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
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Profile </h3>
            </div>
			
            <div class="row">
			 <div class="col-sm-12">
              <div class="profile-header">
				<div class="profile-img">
				  <img src="../documents/<?php if(isset($row[0])){echo $row[0]['selfie'];}?>" width="200" alt="Profile Image">
				</div>
				<div class="profile-nav-info">
				  <h3 class="user-name"><?php if(isset($row[0])){echo $row[0]['name'];}else{ echo "";} ?></h3>
				  <div class="address">
					<!-- <p class="state">New York,</p> -->
					<span class="country">Country-&nbsp;<?php if(isset($row[0])){echo $row[0]['country'];}else{ echo "";} ?></span>
				  </div>
				   <ul class="pered">
				    <!--  -->
					  <li><h3>Add</h3><p><a style ="color : white; font-family: sans-serif;" href="add_model.php">Model</a></p></li>
					  <li><h3>Add</h3><p><a style ="color : white; font-family: sans-serif;" href="add_video.php">Video</a></p></li>
					  <li><h3>Update</h3><p><a style ="color : white; font-family: sans-serif;" href="updateinfo.php">Info</a></p></li>
				  </ul>
				  
				</div>
				<div class="profile-option">
				  <div class="notification">
					<i class="mdi mdi-grease-pencil"></i>
				  </div>
				  
				  
				  
				</div>
			  </div>

			  <div class="main-bd">
				<div class="left-side">
				  <div class="profile-side">
          <p style = "margin-left: 50px;">Profile Completed</p>
          <?php
          if(isset($row[0]) AND $row[0]['model_video']==""){
            ?>
            <progress style = "margin-left: 35px;" id="file" value="30" max="100"></progress>
            <?php
          }elseif(isset($row1[0]) AND $row1[0]['language']==""){
            ?>
          <progress style = "margin-left: 35px;" id="file" value="50" max="100"></progress>
            <?php
          }else{
            ?>
            <progress style = "margin-left: 35px;" id="file" value="85" max="100"></progress>
            <?php
          }
          ?>
          
					<!-- <p class="mobile-no"><i class="mdi mdi-cellphone"></i> +23470xxxxx700</p> --> 
					<p class="user-mail"><i class="mdi mdi-email"></i> <?php if(isset($row[0])){echo $row[0]['email'];}else{ echo "";} ?></p>
					<div class="user-bio">
					  <h3>Bio</h3>
					  <p class="bio">
					 Lorem ipsum dolor sit amet, hello how consectetur adipisicing elit. Sint consectetur provident magni yohoho consequuntur, voluptatibus ghdfff exercitationem at quis similique. Optio, amet!
					  
            </p>
					</div>
					<div class="user-rating">
					  <h3 class="rating">4.5</h3>
					  <div class="rate">
						<div class="star-outer">
						  <div class="star-inner">
							<i class="mdi mdi-star"></i>
							<i class="mdi mdi-star"></i>
							<i class="mdi mdi-star"></i>
							<i class="mdi mdi-star"></i>
							<i class="mdi mdi-star"></i>
						  </div>
						</div>
						<span class="no-of-user-rate"><span>123</span>&nbsp;&nbsp;reviews</span>
					  </div>

					</div>
				  </div>

				</div>
				<div class="right-side">
				  <div class="nav">
					<ul>
					  <!-- <li onclick="tabs(0)" class="user-post active">Photos</li> -->
					  <li onclick="tabs(1)" class="user-review">Videos</li>
					</ul>
				  </div>
				  <div class="profile-body">
					
					<div class="profile-reviews tab">
					  <h1>My Video</h1>					  
					  <form method="post" enctype="multipart/form-data"> 			                                                                              
                            <div class="form-group files">
                                <label class = "text-white">Upload Video </label>
                                <input type="file" name = "modelvideo" class="form-control">
                            </div> 	
                            <span class = "text-white">*<?php echo $videoErr ?></span>			  
                            <div class = "text-center">
                            
                            <button class = " button card-profile card-rofile text-center mt-2 whitecolor mb-0" type = "submit">Submit</button>
                            </div>                     
                        </form>
					  
					  
					</div>
					
				  </div>
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
    <!-- container-scroller -->
    
	
	<script src="assets/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
	 
	<script src="assets/js/pondacam-main.js"></script>

	
	<script>
	    
	$(".nav ul li").click(function() {
  $(this)
    .addClass("active")
    .siblings()
    .removeClass("active");
});

const tabBtn = document.querySelectorAll(".nav ul li");
const tab = document.querySelectorAll(".tab");

function tabs(panelIndex) {
  tab.forEach(function(node) {
    node.style.display = "none";
  });
  tab[panelIndex].style.display = "block";
}
tabs(0);

let bio = document.querySelector(".bio");
const bioMore = document.querySelector("#see-more-bio");
const bioLength = bio.innerText.length;

function bioText() {
  bio.oldText = bio.innerText;

  bio.innerText = bio.innerText.substring(0, 100) + "...";
  bio.innerHTML += `<span onclick='addLength()' id='see-more-bio'>See More</span>`;
}
//        console.log(bio.innerText)

bioText();

function addLength() {
  bio.innerText = bio.oldText;
  bio.innerHTML +=
    "&nbsp;" + `<span onclick='bioText()' id='see-less-bio'>See Less</span>`;
  document.getElementById("see-less-bio").addEventListener("click", () => {
    document.getElementById("see-less-bio").style.display = "none";
  });
}
if (document.querySelector(".alert-message").innerText > 9) {
  document.querySelector(".alert-message").style.fontSize = ".7rem";
}


    </script>
	
	
	
    <!-- endinject -->
  
</body></html>