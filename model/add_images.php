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
$row = $conn->getRow('users',['id'=>$_SESSION['id']]);
$row1 = $conn->getRow('modelinfo',['model_id'=>$_SESSION['id']]);
$pic = $conn->getRow('modelpictures',['model_id'=>$_SESSION['id']]);
$video = $conn->getRow('users',['id'=>$_SESSION['id']]);
//print_r($video[0]['model_video']);die;
?>
<?php
$lockErr = "";
$imageErr = "";
if($_SERVER['REQUEST_METHOD']=='POST'){
	$error = true;
	//print_r($_POST);die;
	//print_r($_FILES);die;
	$image = $_FILES['modelimage']['name'];
	$ext  = strtolower(pathinfo($image, PATHINFO_EXTENSION));
	if(empty($_POST['is_lock'])){
		$error = false;
		$lockErr = "Select Type";
	}elseif(empty($image)){
		$error = false;
		$imageErr = "Choose File First!!";
	}elseif(($ext=="png") || ($ext =="jpg")||($ext=="jpeg")||($ext=="gif")){
		$image = time().$_FILES['modelimage']['name'];
		move_uploaded_file($_FILES["modelimage"]["tmp_name"],'../model-images/'.$image);            
	}else{
		$error = false;
		$imageErr = "UnSupport File Format!!!";
	}
	if($error){
		$data = ['model_id'=>$_SESSION['id'],'image_name'=>$image,'is_locked'=>$_POST['is_lock']];
		$go = $conn->insData('modelpictures',$data);
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
	<link rel="icon" type="image/png" sizes="16x16" href="favicon1.png">
    <title>Pondacam | Profile</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
	
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.6.55/css/materialdesignicons.min.css">
    <!-- End layout styles -->
   
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
					  <li><h3>Add</h3><p><a style ="color : white; font-family: sans-serif;" href="add_images.php">Images</a></p></li>
					  <li><h3>Add&nbsp;Cover</h3><p><a style ="color : white; font-family: sans-serif;" href="#" onclick="addCoverImg()">Images</a></p></li>
					  <li><h3>Add</h3><p><a style ="color : white; font-family: sans-serif;" href="add_profile_videos.php">Video</a></p></li>
					  <li><h3>Add&nbsp;Cover</h3><p><a style ="color : white; font-family: sans-serif;" href="add_video.php">Video</a></p></li>
					  <li><h3>Update</h3><p><a style ="color : white; font-family: sans-serif;" href="updateInfo.php">Info</a></p></li>
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
            <progress style = "margin-left: 35px;" id="file" value="100" max="100"></progress>
            <?php
          }
          ?>
          
					<!-- <p class="mobile-no"><i class="mdi mdi-cellphone"></i> +23470xxxxx700</p> --> 
					<p class="user-mail"><i class="mdi mdi-email"></i> <?php if(isset($row[0])){echo $row[0]['email'];}else{ echo "";} ?></p>
					<div class="user-bio">
					  <h3>Bio</h3>
					  <p class="bio">
					 <?php if(isset($row1)){echo $row1[0]['bio'];} ?>
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
					  <li onclick="tabs(0)" class="user-post active">Add Image</li>
					  <!-- <li onclick="tabs(1)" class="user-review">Videos</li> -->
					</ul>
				  </div>
				  <div class="profile-body">
					  <div class="profile-posts tab">
					    <h1>ADD</h1>
                <form method="post" enctype="multipart/form-data"> 										
                    <div class="form-group">
                    <label style="" for="">Choose you want to lock or Unlock images</label>
                        <select name="is_lock" id="" class="form-control">
                            <option value="">Select....</option>
                            <option value="lock">Paid</option>
                            <option value="unlock">Free</option>
                        </select>                                              
                    </div> 
                    <span style="margin-left: -743px;"><?php echo $lockErr ?></span>                                        
                    <div class="form-group files">
                        <input type="file" name = "modelimage" class="form-control">
                    </div> 	
                    <span style="margin-left: -743px;"><?php echo $imageErr ?></span>			  
                    <div class = "text-center">     
                    <div id="loadDivS" style = "display:none;" class="text-center">
                        <div class="loader"></div>
                        <p>Uploading...</p>
                    </div>
                    <button class = " button card-profile card-rofile text-center mt-2 whitecolor mb-0" type = "submit" onclick="load()">Submit</button>
                    <script>
                        function load()
                        {
                          var loadDivS = document.getElementById("loadDivS");
                          loadDivS.style.display = "block";
                        }
                   </script>
                    </div>                     
                </form>   					                          					  
            </div>
					<!--  -->					
				  </div>
				</div>
			  </div>             
             </div>
			</div>           
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
                          <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                            <input id="upload" type="file" onchange="readURL(this);" class="form-control border-0">
                            <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                            <div class="input-group-append">
                              <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> 
                              <i class="mdi mdi-cloud-upload mr-2 text-muted"></i>
                              <small class="text-uppercase font-weight-bold text-muted">Profile Image</small></label>
                            </div>
                          </div>
                          <!-- Uploaded image area-->
                          <div class="image-area mt-4">
                            <img id="imageResult" src="../documents/<?php if(isset($row[0])){echo $row[0]['selfie'];}?>" alt="" width="300" height="400" class="img-fluid rounded shadow-sm  d-block">
                          </div>
                          <span class = "error" id ="selfieErr"></span>
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
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html 
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 
			  <a href="" target="_blank">Pondacam</a>. All rights reserved.</span>
             
            </div>
          </footer>-->
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
	    
	    var imgType = "profile";
        function addCoverImg()
        {
             
            $('#imageResult')
                .attr('src', '../documents/<?php if(isset($row[0])){echo $row[0]["cover_photo"];}?>');
            imgType = "cover";
            $("#myModal").modal();
        }
    $('.profileedit').click(function() {
        var imageResult = document.getElementById("imageResult");
            imageResult.src = "../documents/<?php if(isset($row[0])){echo $row[0]['selfie'];}?>"
            imgType = "profile";
		    $("#myModal").modal();
    });
    $('#img_upload_button').click(function() {
      //loadDiv
      var avatar  = document.getElementById('upload').files[0];
      var loadDiv = document.getElementById('loadDiv');
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
      var formdata = new FormData();
			formdata.append('avatar',avatar);
			formdata.append('type',imgType);
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
  
</body>
</html>