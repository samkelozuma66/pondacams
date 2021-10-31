<?php
include '../config.php';
$country   = $conn -> getRow("country");
?>
<?php
$searchsql = ""; 
$showType = "";
$show = "";
$willingness ="";
$language ="";
$price="";
$age = "";
$ethnicity = "";
$appearance = "";
$bSize = "";
$hair = "";
$region = "";
$gender = "";
$province = "";
$city = "";
$area = "";
if(isset($_GET['search'])){
   $name = $_GET['search'];
   $searchsql =  " AND (`name` LIKE '%{$name}%' OR `d_name` LIKE '%{$name}%' OR `l_name` LIKE '%{$name}%')";
} 
if(isset($_GET['showType'])){
	$type = $_GET['showType'];
    $show = " AND FIND_IN_SET('$type',`modelinfo`.`showType`)";
}
if(isset($_GET['province'])){
	$pro = $_GET['province'];
    $province = " AND `state` = '$pro' ";
}
if(isset($_GET['city'])){
	$cit = $_GET['city'];
    $city = " AND `city` = '$cit'";
}
if(isset($_GET['area'])){
	$are = $_GET['area'];
    $area = " AND `area` =  '$are'";
}
if(isset($_GET['willingness'])){
	$will = $_GET['willingness'];
	$willingness = " AND FIND_IN_SET('$will',`modelinfo`.`willingness`)";
}
if(isset($_GET['language'])){
	$l = $_GET['language'];
	$language  = " AND FIND_IN_SET('$l',`modelinfo`.`language`)";
}
if(isset($_GET['price'])){
	if($_GET['price']=='9.99+'){
		$price = " AND `price` > '9'";
	}else{
		$p =  explode("-",$_GET['price']);
		$price = " AND `price` BETWEEN '$p[0]' AND '$p[1]'";
	}	
}
if(isset($_GET['age'])){
   if($_GET['age']=='40+'){
	   $age = " AND `age` > '40'";
   }else{
	   $a = explode("-",$_GET['age']);
	   $age = " AND `age` BETWEEN '$a[0]' AND '$a[1]'";
   }
}
if(isset($_GET['ethnicity'])){
	$e = $_GET['ethnicity'];
	$ethnicity = " AND ethnicity = '$e'";
	/* $ethnicity = " AND FIND_IN_SET('$e',`modelinfo`.`ethnicity`)"; */
}
if(isset($_GET['appearance'])){
	$ap = $_GET['appearance'];
	$appearance = " AND FIND_IN_SET('$ap',`modelinfo`.`appearance`)";
}
if(isset($_GET['bSize'])){
	$br = $_GET['bSize'];
	$bSize = " AND bSize = '$br'";
}
if(isset($_GET['hair'])){
	$hr = $_GET['hair'];
	$hair = " AND hair = '$hr'";
}
if(isset($_GET['region'])){
	$re = $_GET['region'];
	$region = " AND region = '$re'";
}
if(isset($_GET['gender'])){
	$g = $_GET['gender'];
	$gender = " AND gender = '$g'";
}
$sql = "SELECT * FROM escort 
WHERE `hidden` != '1' "
.$gender.$province.$city.$area;
//print_r($sql);die;
// print_r($sql); 
$conn = new dataBase; 
$conn = $conn->connect();
$res = $conn->query($sql);
//print_r($res);die;
/* $model = $res->fetch_assoc();
print_r($model);die; */
	
$url1 = "https://countriesnow.space/api/v0.1/countries";
$xml1 = file_get_contents($url1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Escorts</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon1.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <!-- Custom Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
	<link href="../css/animate.min.css" rel="stylesheet">
	<link href="../css/bootstrap-select.min.css" rel="stylesheet">
	<link href="../css/metisMenu.min.css" rel="stylesheet">	
	<style>
	.story-box:before{
		z-index:0 !important;
	}
	video {
	border: 1px solid #aaa;
	object-fit: initial;
    }
	::cue {
	font-size: 12px;
	}
	</style>
	<script>
	    let usercountry = "default";
        let modelArr = [];
        var cities = <?php echo json_encode($xml1); ?>;
        var json    = JSON.parse(cities);
        var allCountry = <?php echo json_encode($country); ?>;
        var countryObject = "";
        console.log("Logging allCountry");
        console.log(allCountry);
        console.log("Logging CITIES");
        console.log(json);
	</script>
</head>
<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
            <script>
                myStorage = window.localStorage;
                if(myStorage.getItem('over18') == null)
                {
                    Swal.fire({
                      title: 'WARNING!',
                      text: 'This website provides access to material, information, opinion, content and commentary that includes sexually explicit material (collectively, the "Sexually Explicit Material"). Everyone accessing this site must be at least 18 years of age OR the age of majority in each and every jurisdiction in which you will or may view the Sexually Explicit Material, whichever is higher (the "Age of Majority"). You may not enter this site if Sexually Explicit Material offends you or if the viewing of Sexually Explicit Material is not legal in each and every community in which you choose to access it via this website ',
                      imageUrl: '../uploads/download.png',
                      imageWidth: 200,
                      imageHeight: 200,
                      imageAlt: 'Custom image',
                      showCancelButton: true,
                      confirmButtonText: 'continue',
                      cancelButtonText: 'EXIT',
                    }).then((result) => {
                      if (!result.isConfirmed) {
                        window.location.href = "HTTPS://google.com";
                      
                      }
                      else
                      {
                          myStorage.setItem('over18', 'yes');
                      }
                    })
                }
                
                /*Swal.fire({
                  title: 'What are you looking for?',
                  text: '',
                  imageUrl: 'uploads/download.png',
                  imageWidth: 200,
                  imageHeight: 200,
                  imageAlt: 'Custom image',
                  showCancelButton: true,
                  confirmButtonText: 'Live Chat',
                  cancelButtonText: 'Escort',
                }).then((result) => {
                  if (!result.isConfirmed) {
                    //window.location.href = "HTTPS://google.com";
                  
                  }
                  else
                  {
                      //myStorage.setItem('over18', 'yes');
                  }
                });*/
            </script>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header" id="headerWrapper">    
            <div class="header-content clearfix">
                
                <div class="brand-logo" style="width:65%" id="logoWrapper">
					<a href="index.php">
						<span class="logo-compact"><img src="../images/logo-compact1.png" alt="" style="width:35%;"></span>
					</a>
				</div>
            
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown d-none d-md-flex dn">
                            <a href="javascript:void(0)" class="log-user" onclick="showM()" style="position: relative; top: 0px;">
                                <span>Escape</span>  
                            </a>
                        </li>
                        <li class="icons dropdown d-none d-md-flex dn">
                            <a href="https://www.pondacams.com" class="log-user"  style="position: relative; top: 0px;">
                                <span>Webcam Site</span>  
                            </a>
                        </li>
                        <!-- <li class="icons dn"><a href="javascript:void(0)">Live Cams</a></li>
						<li class="icons dn"><a href="javascript:void(0)">Mobile Live</a></li> -->
						<!-- <li class="icons dn"><a href="javascript:void(0)">By Credit</a></li>
						<li class="icons dn"><a href="javascript:void(0)">Promotions
						  <span class="badge badge-pill gradient-1">2</span></a>
						</li>
						<li class="icons dn"><a href="javascript:void(0)">Story</a></li>
						<li class="icons dn"><a href="javascript:void(0)">Award</a></li>
						
						<li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="fa fa-envelope gradient-4-text"></i>
                                <span class="badge badge-pill gradient-1">3</span>
                            </a>
                        </li>
                        <li class="icons dropdown dn"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="fa fa-heart gradient-3-text"></i>
                                <span class="badge badge-pill gradient-2">3</span>
                            </a>
                        </li> 
                        <li class="icons dropdown d-none d-md-flex dn">
                            <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown" style="position: relative; top: 0px;">
                                <span>English</span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="javascript:void()">English</a></li>
                                        <li><a href="javascript:void()">Dutch</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>-->
						<?php if(isset($_SESSION['name'])){ ?>
							<li class="icons dropdown d-none d-md-flex dn">
                            <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown" style="position: relative; top: 0px;">
                                <span><?= $_SESSION['name']; ?></span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="chatlogout.php">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
						<?php }else{ ?>
						<!--<li class="icons dn"><a href="javascript:void(0)" data-toggle="modal" data-target="#login">
						  <b>Login<b></a></li>-->
						<li class="icons dn"><a href="register.php" class="joinbtn">joinnow</a></li>
						<?php
						}
						?>
						<li class="icons ds-m-dnd">
							<a href="javascript:void(0)" data-toggle="modal" data-target="#searchmobile">
							<b><i class="fas fa-search"></i></b></a>
					    </li>				
						<!-- after lgin profile img div for developer -->
                        <!--<li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="images/avatar-media.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
										<li>
										  <a href=""><i class="icon-settings"></i> <span>Setting</span></a>
										</li>  
                                        <hr class="my-2">
									   
                                        <li><a href="#"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>-->
                    </ul>
                </div>
            </div>
        </div>
        <script>
            
            var logoWrapper = document.getElementById("logoWrapper");
            var headerWrapper = document.getElementById("headerWrapper");
            var  width  = 0;
            var  height = 0;
            resizeLogo()
            function resizeLogo()
            {
                width  = headerWrapper.offsetWidth;
                height = headerWrapper.offsetHeight;
                if(width<600)
                {
                    logoWrapper.style.width = (width) + "px";
                }
                else
                {
                    logoWrapper.style.width = (width * 0.50) + "px";
                }
                
            }
            new ResizeObserver(resizeLogo).observe(logoWrapper);
        </script>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <div class="msh-wl">
					 <a href="https://www.pondacams.com" class="lognbtn-m">WebCam Site</a>
				</div>	
				<ul class="metismenu" id="menu">
				    <div class="mshowd">
					    <li >
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <span class="nav-text">City</span>
                            </a>
                            <ul aria-expanded="false" id="cityList">
                                <!--<li><a href="index.php?city=Durban">Durban </a></li>
    							<li><a href="index.php?city=Johannesburg">Johannesburg</a></li>
    							<li><a href="index.php?city=Pretoria">Pretoria & Centurion</a></li>
    							<li><a href="index.php?city=Cape_Town">Cape Town</a></li>
    							<li><a href="index.php?city=Pietermaritzburg">Pietermaritzburg</a></li>
    							<li><a href="index.php?city=RSA">Other Cities</a></li>-->
                            </ul>
                        </li>
                        <li >
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <span class="nav-text">State/Province</span>
                            </a>
                            <ul aria-expanded="false" >
                                <!--<li><a href="index.php?province=Eastern_Cape">Eastern Cape </a></li>
    							<li><a href="index.php?province=Free_State">Free State</a></li>
    							<li><a href="index.php?province=Gauteng">Gauteng</a></li>
    							<li><a href="index.php?province=KwaZulu_Natal">KwaZulu-Natal</a></li>
    							<li><a href="index.php?province=Limpopo">Limpopo</a></li>
    							<li><a href="index.php?province=Mpumalanga">Mpumalanga</a></li>
    							<li><a href="index.php?province=Northern_Cape">Northern Cape</a></li>
    							<li><a href="index.php?province=North_West">North West</a></li>
    							<li><a href="index.php?province=Western_Cape">Western Cape</a></li>-->
                            </ul>
                        </li>
					</div>
					 <div class="row">
						<!-- <div class="col"> -->
						<li class="nav-label dn"><a href="index.php?gender=female">Girls</a></li>
						<!-- </div> -->
						<!-- <div class="col"> -->
						<li class= "nav-label dn"> <a href="index.php?gender=male">Boys</a></li>
						<!-- </div> -->
						<!-- <div class="col"> -->
						<!-- <li class= "nav-label dn"> <a href="index.php?gender=others">Others</a></li> -->
						<!-- </div> -->
						
						
					 </div>
                    
					<li class="dn">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">City</span>
                        </a>
                        <ul aria-expanded="false" id="cityList1">
                            <!--<li><a href="index.php?city=Durban">Durban </a></li>
							<li><a href="index.php?city=Johannesburg">Johannesburg</a></li>
							<li><a href="index.php?city=Pretoria">Pretoria & Centurion</a></li>
							<li><a href="index.php?city=Cape_Town">Cape Town</a></li>
							<li><a href="index.php?city=Pietermaritzburg">Pietermaritzburg</a></li>
							<li><a href="index.php?city=RSA">Other Cities</a></li>-->
                        </ul>
                    </li>
                    <li class="dn">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">State / Provinces</span>
                        </a>
                        <ul aria-expanded="false" id="stateList1">
                            <!--<li><a href="index.php?province=Eastern_Cape">Eastern Cape </a></li>
							<li><a href="index.php?province=Free_State">Free State</a></li>
							<li><a href="index.php?province=Gauteng">Gauteng</a></li>
							<li><a href="index.php?province=KwaZulu_Natal">KwaZulu-Natal</a></li>
							<li><a href="index.php?province=Limpopo">Limpopo</a></li>
							<li><a href="index.php?province=Mpumalanga">Mpumalanga</a></li>
							<li><a href="index.php?province=Northern_Cape">Northern Cape</a></li>
							<li><a href="index.php?province=North_West">North West</a></li>
							<li><a href="index.php?province=Western_Cape">Western Cape</a></li>-->
                        </ul>
                    </li>
                    <!--<li class="dn">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">Show Type</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="index.php?showType=free_chat">Free Chat</a></li>
							<li><a href="index.php?showType=private_chat">Private Chat</a></li>
							<li><a href="index.php?showType=video_call">Video Call</a></li>
							<li><a href="index.php?showType=mobile_live">Mobile Live</a></li>
							<li><a href="index.php?showType=vip_show">VIP Show</a></li>
							<li><a href="index.php?showType=two_way_audio">Two-way Audio</a></li>
							<li><a href="index.php?showType=story"> Story </a></li>
							<li><a href="index.php?showType=hd"> HD</a></li>
                        </ul>
                    </li>
                    <li class="dn">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                             <span class="nav-text">Price</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="index.php?price=0.01-0.98">0.01 - 0.98</a></li>
                            <li><a href="index.php?price=0.98-2.99">0.98 - 2.99</a></li>
                            <li><a href="index.php?price=2.99-3.99">2.99 - 3.99</a></li>
							<li><a href="index.php?price=3.99-4.99">3.99 - 4.99</a></li>
                            <li><a href="index.php?price=4.99-9.99"> 4.99 - 9.99</a></li>
                            <li><a href="index.php?price=9.99+"> 9.99+</a></li>
                        </ul>
                    </li>
                    <li class="dn">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">Willingness</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="index.php?willingness=Close-up">Close-up</a></li>
                            <li><a href="index.php?willingness=Dominant">Dominant</a></li>
                            <li><a href="index.php?willingness=Toys">Toys</a></li>
							<li><a href="index.php?willingness=Smoking">Smoking</a></li>
                            <li><a href="index.php?willingness=Dancing"> Dancing</a></li>
                            <li><a href="index.php?willingness=Submissive"> Submissive</a></li>
                        </ul>
                    </li>
                    <li class="dn">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">Languag</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="index.php?language=Spanish">Spanish</a></li>
                            <li><a href="index.php?language=German">German</a></li>
                            <li><a href="index.php?language=Italian">Italian</a></li>
							<li><a href="index.php?language=French">French</a></li>
                            <li><a href="index.php?language=English">English</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">Age</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="index.php?age=18-22">18 - 22</a></li>
                            <li><a href="index.php?age=22-30"> 22 - 30 </a></li>
                            <li><a href="index.php?age=30-40">30 - 40</a></li>
							<li><a href="index.php?age=40+">40+</a></li>
                         </ul>
                    </li>
					<li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">Ethnicity</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="index.php?ethnicity=Asian">Asian</a></li>
                            <li><a href="index.php?ethnicity=Ebony"> Ebony </a></li>
                            <li><a href="index.php?ethnicity=Latin">Latin</a></li>
							<li><a href="index.php?ethnicity=White">White</a></li>
						</ul>
                    </li>
					<li class="dn">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">Appearance</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="index.php?appearance=BBW">BBW</a></li>
                            <li><a href="index.php?appearance=Petite">Petite</a></li>
                            <li><a href="index.php?appearance=Piercing">Piercing</a></li>
							<li><a href="index.php?appearance=Stockings">Stockings</a></li>
							<li><a href="index.php?appearance=Tattoo">Tattoo</a></li>
						</ul>
                    </li>
					<li class="dn">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">Breast size</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="index.php?bSize=Tiny">Tiny</a></li>
                            <li><a href="index.php?bSize=Normal">Normal</a></li>
                            <li><a href="index.php?bSize=Big">Big</a></li>
							<li><a href="index.php?bSize=Huge">Huge</a></li>
						</ul>
                    </li>
					<li class="dn">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">Hair</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="index.php?hair=Black">Black hair</a></li>
                            <li><a href="index.php?hair=Blonde">Blonde</a></li>
                            <li><a href="index.php?hair=Brunette">Brunette</a></li>
							<li><a href="index.php?hair=Redhead">Redhead</a></li>
							<li><a href="index.php?hair=Long">Long</a></li>
                            <li><a href="index.php?hair=Short">Short</a></li>
						</ul>
                    </li>
					<li class="dn">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">Region</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="index.php?region=America_uk_Australia">North America/UK/Australia</a></li>
                            <li><a href="index.php?region=Europe">Europe</a></li>
                            <li><a href="index.php?region=s_america">South America</a></li>
							<li><a href="index.php?region=Asia">Asia</a></li>
							<li><a href="index.php?region=Africa">Africa</a></li>
						</ul>
                    </li>-->
					<li>
                        <a href="https://pondacams.com/escorts">
                            <span class="nav-text">Clear all filters</span>
                        </a>
                    </li>
					
					
				</ul>
            </div>
		   
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid">	
                
				<div class="row mfullwidth">
				   <div class="col-sm-12">
				      <div class="box-top">
					     <div class="row">
						 <div class="col-sm-8">
						     <h3>Girls</h3>
							 <!-- Another variation with a button -->
							 <!--  <div class="input-group topsearchbar"> -->
									<form class="input-group topsearchbar" method = "get">
										<input type="text" class="form-control"  name = "search" placeholder="Search for models or categories">
										<div class="input-group-append">
											<button class="btn btn-secondary" type="submit">
												<i class="fa fa-search"></i>
											</button>
										</div>
									</form>
							  <!-- </div> -->
						  </div>
						 <div class="col-sm-4">
						      
                            <ul class="imgsmalllage">
                              <li><a href="#!"><i class="fas fa-th"></i></a></li>
							  <li><a href="#!"><i class="fas fa-th-large"></i></a></li>
							  <li><a href="#!"><i class="fa fa-braille"></i></a></li>
                            </ul>							
						</div>
						 
					    </div>
					  </div>
				   </div>
				</div>
				
				<div class="mshmenutop">
				   <div class="col-sm-12">
				      <ul>
					    <li><a href="" class="active">Girl</a></li>
						<!--<li><a href="">Hot Flirt</a></li>
						<li><a href="">Soul Mate</a></li>
						<li><a href="">Mature Women</a></li>
						<li><a href="">Amateur </a></li>
						<li><a href="">Transgirl</a></li>-->
					  </ul>
				   </div>
				</div>
				
				
				<div class="mfullwidth">
                    <div class="story-postbox">
						<div class="row">
						    <script>
						        function msoFiger(img_id,vid_id)
						        {
						            var img = document.getElementById(img_id);
						            var vid = document.getElementById(vid_id);
						            
						            img.style.display = "none";
						            vid.style.display = "block";
						        }
						        function msoutFiger(img_id,vid_id)
						        {
						            var img = document.getElementById(img_id);
						            var vid = document.getElementById(vid_id);
						            
						            img.style.display = "block";
						            vid.style.display = "none";
						        }
						    </script>
						   <?php
							
							while($model = $res->fetch_assoc()){
									
						    ?>		
								<div class="col-6 col-lg-3 col-md-3 col-sm-4" 
								     id="model<?php echo $model['id'] ?>"
								     onmouseout = "msoutFiger('modelImg<?php echo  $model['id']?>','modelVid<?php echo  $model['id']?>')" 
						             onmouseover= "msoFiger  ('modelImg<?php echo  $model['id']?>','modelVid<?php echo  $model['id']?>')"
								     
								     >
								<a href="video_profile.php?id=<?php echo $model['id'] ?>">
								<div class="story-box attra-box" >
									<a href="video_profile.php?id=<?php echo $model['id'] ?>">
    									<figure>
    									    <img    id ="modelImg<?php echo  $model['id']?>" src="../documents/<?php echo $model['cover_photo']; ?>" alt="" width="320" height="150"  />
											<video  id ="modelVid<?php echo  $model['id']?>" style="display:none;" onmouseover="play()" onmouseout="pause()" id="myVideo" src="../documents/<?php echo $model['cover_video'] ?>" width="320" height="240"  muted></video>
    										<h5 class="girlname"><?php echo  $model['display_name']?> <small>(<?php echo  $model['age']." Year";?>)</small></h5>
    									</figure>
									</a>
									<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="<?php echo  $model['display_name']?>">
									<a href="video_profile.php?id=<?php echo $model['id'] ?>"><img src="../documents/<?php echo $model['selfie'] ?>" alt=""/></a>										
									<!--<span class="status <?php if($model['is_online']){ echo ('f-online');} ?>"></span>-->
									</div>
								</div>
								</a>
							</div>
    							<script>
    							    //alert(usercountry);
    							    
    							    function countrySec(divId,country)
    							    {
    							        var container = document.getElementById(divId);
    							        //console.log((blkCnt.includes(usercountry)));
    							        //console.log(blkCnt + " " + usercountry);
    							        
    							        if(country !== usercountry)
    							        {
    							            container.style.display = "none";
    							        }
    							        //alert(blkCnt + " " + usercountry)
    							    }
    							    //alert("test");
    							    var val ={divId:'model<?php echo $model['id'] ?>',country:'<?php echo $model['country'] ?>'};
    							    modelArr.push(val);
    							    //countrySec("model<?php echo $model['model_id'] ?>");
    							</script>
							<?php
							}
							?>			
						  <!-- <div class="col-6 col-lg-3 col-md-3 col-sm-4">
							<div class="story-box attra-box">
								<figure>
									<img src="images/photo16.jpg" alt="">
									<h5 class="girlname">Nikky Savagoe <small>(22 Year)</small> </h5>
									<span>Chat Now</span>
								</figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Nikky Savagoe">
									<img src="images/photo16.jpg" alt="">
									<span class="status f-away"></span>
								</div>
							 </div>
						   </div>
                           <div class="col-6 col-lg-3 col-md-3 col-sm-4">
							<div class="story-box attra-box">
								<figure>
									<img src="images/photo18.jpg" alt="">
									<h5 class="girlname">Crystalpike <small>(22 Year)</small> </h5>
									<span>Chat Now</span>
								</figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Crystalpike">
									<img src="images/photo18.jpg" alt="">
									<span class="status f-away"></span>
								</div>
							 </div>
						   </div>
						   <div class="col-6 col-lg-3 col-md-3 col-sm-4">
							<div class="story-box attra-box">
								<figure>
									<img src="images/photo8.jpg" alt="">
									<h5 class="girlname">JessaEvan <small>(28 Year)</small> </h5>
									<span>Chat Now</span>
								</figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="JessaEvan">
									<img src="images/photo8.jpg" alt="">
									<span class="status f-away"></span>
								</div>
							 </div>
						   </div>
						   <div class="col-6 col-lg-3 col-md-3 col-sm-4">
							<div class="story-box">
								<figure>
									<img src="images/photo14.jpg" alt="">
									<h5 class="girlname">Demysaboo <small>(28 Year)</small> </h5>
									<span>Chat Now</span>
								</figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Demysaboo">
									<img src="images/photo14.jpg" alt="">
									<span class="status f-away"></span>
								</div>
							 </div>
						   </div>
						   
						  <div class="col-6 col-lg-3 col-md-3 col-sm-4">
							<div class="story-box">
								<figure>
									<img src="images/photo9.jpg" alt="">
									<h5 class="girlname"> BrookeRaye  <small>(20 Year)</small> </h5>
									<span>Chat Now</span>
								</figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title=" BrookeRaye ">
									<img src="images/photo9.jpg" alt="">
									<span class="status f-away"></span>
								</div>
							 </div>
						   </div>
						   <div class="col-6 col-lg-3 col-md-3 col-sm-4">
							<div class="story-box">
								<figure>
									<img src="images/photo15.jpg" alt="">
									<h5 class="girlname">  CarolineSquirrel   <small>(20 Year)</small> </h5>
									<span>Chat Now</span>
								</figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="CarolineSquirrel">
									<img src="images/photo15.jpg" alt="">
									<span class="status f-away"></span>
								</div>
							 </div>
						   </div>
						   <div class="col-6 col-lg-3 col-md-3 col-sm-4">
							<div class="story-box">
								<figure>
									<img src="images/photo11.jpg" alt="">
									<h5 class="girlname"> CandeeLords<small>(20 Year)</small> </h5>
									<span>Chat Now</span>
								</figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="CandeeLords">
									<img src="images/photo11.jpg" alt="">
									<span class="status f-away"></span>
								</div>
							 </div>
						   </div>
						  <div class="col-6 col-lg-3 col-md-3 col-sm-4">
							<div class="story-box">
								<figure>
									<img src="images/date-user9.jpg" alt="">
									<h5 class="girlname">Lorakayden <small>(24 Year)</small>)</h5>
									<span>Chat Now</span>
								</figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Lorakayden">
									<img src="images/date-user9.jpg" alt="">
									<span class="status f-online"></span>
								</div>
							 </div>
						   </div>
						  <div class="col-6 col-lg-3 col-md-3 col-sm-4">
							<div class="story-box">
								<figure>
									<img src="images/photo7.jpg" alt="">
									<h5 class="girlname">Nikky Savagoe <small>(22 Year)</small> </h5>
									<span>Chat Now</span>
								</figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Nikky Savagoe">
									<img src="images/photo7.jpg" alt="">
									<span class="status f-away"></span>
								</div>
							 </div>
						   </div>
                           <div class="col-6 col-lg-3 col-md-3 col-sm-4">
							<div class="story-box">
								<figure>
									<img src="images/date-user16.jpg" alt="">
									<h5 class="girlname">Crystalpike <small>(22 Year)</small> </h5>
									<span>Chat Now</span>
								</figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Crystalpike">
									<img src="images/date-user16.jpg" alt="">
									<span class="status f-away"></span>
								</div>
							 </div>
						   </div>
						   <div class="col-6 col-lg-3 col-md-3 col-sm-4">
							<div class="story-box">
								<figure>
									<img src="images/photo5.jpg" alt="">
									<h5 class="girlname">JessaEvan <small>(28 Year)</small> </h5>
									<span>Chat Now</span>
								</figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="JessaEvan">
									<img src="images/photo5.jpg" alt="">
									<span class="status f-away"></span>
								</div>
							 </div>
						   </div>
						   <div class="col-6 col-lg-3 col-md-3 col-sm-4">
							<div class="story-box">
								<figure>
									<img src="images/photo4.jpg" alt="">
									<h5 class="girlname">Demysaboo <small>(28 Year)</small> </h5>
									<span>Chat Now</span>
								</figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="Demysaboo">
									<img src="images/photo4.jpg" alt="">
									<span class="status f-away"></span>
								</div>
							 </div>
						   </div>
						   
						  <div class="col-6 col-lg-3 col-md-3 col-sm-4">
							<div class="story-box">
								<figure>
									<img src="images/photo3.jpg" alt="">
									<h5 class="girlname"> BrookeRaye  <small>(20 Year)</small> </h5>
									<span>Chat Now</span>
								</figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title=" BrookeRaye ">
									<img src="images/photo3.jpg" alt="">
									<span class="status f-away"></span>
								</div>
							 </div>
						   </div>
						   <div class="col-6 col-lg-3 col-md-3 col-sm-4">
							<div class="story-box">
								<figure>
									<img src="images/photo2.jpg" alt="">
									<h5 class="girlname">  CarolineSquirrel   <small>(20 Year)</small> </h5>
									<span>Chat Now</span>
								</figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="CarolineSquirrel">
									<img src="images/photo2.jpg" alt="">
									<span class="status f-away"></span>
								</div>
							 </div>
						   </div> -->
						   <!-- <div class="col-6 col-lg-3 col-md-3 col-sm-4">
							<div class="story-box">
								<figure>
									<img src="images/photo1.jpg" alt="">
									<h5 class="girlname"> CandeeLords<small>(20 Year)</small> </h5>
									<span>Chat Now</span>
								</figure>
								<div class="story-thumb" data-toggle="tooltip" title="" data-original-title="CandeeLords">
									<img src="images/photo1.jpg" alt="">
									<span class="status f-away"></span>
								</div>
							 </div>
						   </div> -->
						   

						   
						</div>
					</div>
                    
                  
                   
                </div>

                

            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <ul class="footer-menu">
				 
				    <li><a href="">Contact Us</a></li>
				    <li><a href="">Support</a></li>
				 <!--<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
				 <li><a href=""><i class="fab fa-twitter"></i></a></li>
				 <li><a href=""><i class="fab fa-instagram"></i></a></li>-->
				</ul>

            </div>
        </div>
		<div class="terbox">
		   <div class="container">
		       <p>The site contains sexually explicit material, Enter ONLY if you are at least 18 years old and agree to our cookie rules.</p>
			   <p>18 U.S.C. 2257 Record-Keeping Requirements Compliance Statement</p>
			   <p>This site is owned and operated by Pondacam</p>
		   </div>
		</div>
		
		<div class="copyrightbox">
		 <div class="container">
		    <div class="row">
			   <div class="col-12 col-md-4 col-sm-12">
			       <p>Copyright &copy; All Right Recevied pondacam 2020</p>
			   </div>
			   <div class="col-12 col-md-8 col-sm-12">
			       <ul class="footer-menu">
					 <li><a href="">Help</a></li>
					 <li><a href="../documents/pondacams_policies.pdf" target="_blank">Terms &amp; Conditions</a></li>
					 <li><a href="../documents/pondacams_policies.pdf" target="_blank">Ownership Statement</a></li>
					 <li><a href="../documents/pondacams_policies.pdf" target="_blank">Anti-Spam Policy</a></li>
					 <li><a href="../documents/pondacams_policies.pdf" target="_blank">Refund Policy</a></li>
					 <li><a href="../documents/pondacams_policies.pdf" target="_blank">Privacy Policy</a></li>
					 <li><a href="../documents/pondacams_policies.pdf" target="_blank">Cookies Policy</a></li>
					</ul>
			   </div>
			</div>
		 </div>
		</div>
		
		
		
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
	
	
	
	
	
<div class="modal  fade"  id="escape" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
    <div class="col-sm-7">
        <button type="button" class="close" onclick="hipeM()"style="float:right;"><span style="fonth-size:15px;">back to site</span></button>
    </div >
    <div style="width:100%;height:1000px">
        <iframe src="https://www.accuweather.com/" width="100%"  style="border:none;height:inherit" >
        </iframe>
    </div>
	<script>
	    function hipeM()
	    {
	        //alert("hideM");
	        var myM = $('#escape');
	        
	        myM.hide();
	        $('body').removeClass('modal-open'); // For scroll run
	        $('.modal-backdrop').hide();
	        console.log(myM);
	        //document.getElementById("escape").hide();
	        //$('#escape').modal('hide');
	    }
	    function showM()
	    {
	        var myM = $('#escape');
	        myM.attr("aria-hidden","false");
	        myM.addClass('show'); 
	        myM.show();
	        myM.css("padding-right","25.9922px");
	        //myM.style.padding-right = "padding-right: 25.9922px;"
	        $('body').addClass('modal-open'); // For scroll run
	        $('body').css("padding-right","25.9922px");
	        $('.modal-backdrop').show();
	    }
	</script>
</div>	
	<!-- modal (quickViewModal) -->
<div class="modal  fade"  id="searchmobile" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg mobiles-search-box">
		<div class="modal-content ">
			<div class="modal-body">
				 <div class="input-group topsearchbar">
						<form>
							<input type="text" class="form-control" name = "search" placeholder="Search for models or categories">
							<div class="input-group-append">
							<button class="btn btn-secondary" type="button">
								<i class="fa fa-search"></i>
							</button>
						</form>					    
					</div>
				 </div>
			</div>
		</div>
	</div>
</div>
	
	<!-- modal login -->
	
<div class="modal  fade"  id="login" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mobiles-search-box">
		<div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Login <i class="fas fa-lock"></i></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
			<div class="modal-body loginbox-bg">
				 <h5 class="headig-logon">Welcome to Pondacam </h5>
				<form class="mt-3 mb-3 login-input" method ="post">
                    <div class="form-group">
                        <label>Email</label>
						<input type="email" id = "chatemail" name = "email" class="form-control" placeholder="Username">
						<span id = "chatemailErr" >*</span>
                    </div>
                    <div class="form-group">
					    <label>Password</label>
						<input type="password" id = "chatpass" name = "password" class="form-control" placeholder="Password">
						<span id = "chatpassErr">*</span>
                    </div>
                   <button type = "button" id = "chatlogin" class="btn login-form__btn submit">Log In</button>
                </form>				
				<p class="mt-1 login-form__footer">
				   <a href="#" class="text-primary" data-dismiss="modal" data-toggle="modal" data-target="#forgotpassword">Click here</a> 
				   If you fogot password?</p>
				<p class="login-form__footer">Dont have account? <a href="#" class="text-primary" data-dismiss="modal" data-toggle="modal" data-target="#joinnow">Join Now</a></p>
			</div>
		</div>
	</div>
</div>		
<!-- modal Forgot -->
<div class="modal  fade"  id="forgotpassword" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mobiles-search-box">
		<div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Forgot Password <i class="fas fa-lock"></i></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
			<div class="modal-body loginbox-bg">
				 <h6 class="headig-logon">To reset your password, enter your username and email address</h6>
				 <form class="mt-3 mb-3 login-input">
                    <div class="form-group">
                        <label> Name</label>
						<input type="email" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
						<input type="email" class="form-control" placeholder="Email">
                    </div>
                   <button class="btn login-form__btn submit">Send</button>
				   <button class="btn login-form__btnback submit" data-toggle="modal" data-dismiss="modal">Back</button>
                </form>
			</div>
		</div>
	</div>
</div>	
	
	
<!-- modal Join now -->
<div class="modal  fade"  id="joinnow" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
	<div class="modal-dialog model-lg modal-dialog-centered mobiles-search-box">
		<div class="modal-content ">
		    <div class="modal-body joinnowbg">
			     <div class="row">
				   <div class="col-sm-5 image-holderbgjoin"></div>
				   <div class="col-sm-7">
						<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
						<form method="post" class="paddform">
						   <h2 class="headig-logon mb-3">Join Now And Enjoy</h2>
							 <form class="mt-3 mb-3 login-input">
								<div class="form-group">
									<label>Name</label>
									<input type="text" id = "chatName" name = "name" class="form-control" placeholder="Username">
									<span id = "nameErr">*</span>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" id = "chatEmail" name = "email" class="form-control" placeholder="Email">
									<span id = "emailErr">*</span>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" id = "chatPass" name = "password" class="form-control" placeholder="Password">
									<span id = "passErr">*</span>
								</div>
								
							   <button id ="join" type ="button" class="btn login-form__btn submit">Join Now</button>
							   <a href="#" class="join-loginbt" data-dismiss="modal" data-toggle="modal" data-target="#login">Login</a>
							 
								<p class="mt-3 login-form__footer">
								   Your activity could reflect your sexual interests. By enjoying our  
									<a href="#" class="text-primary">services. </a> and by clicking on "Join Now" 
									,You agree to some 
									<a href="#" class="text-primary">sensitive data being processed.</a>
								</p> 
							
						</form>
					</div>				
			</div>
		</div>
	</div>
</div>		
		
    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../js/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
	<script src="../js/gleek.js"></script>
	<script>
		$("button").click(function(){ 			    
			var currentid=$(this).attr('id');
			if(currentid=='chatlogin'){
				document.getElementById('chatpassErr').innerHTML="*";
				document.getElementById('chatemailErr').innerHTML="*";
				var email = document.getElementById('chatemail').value;
				
				//alert(email);
				var password = document.getElementById('chatpass').value;
				if (email == "")
				{
					document.getElementById('chatemailErr').innerHTML = "Input field required";
					return false;
				}else if(/^[a-z0-9][a-z0-9-_\.]+@([a-z]|[a-z0-9]?[a-z0-9-]+[a-z0-9])\.[a-z0-9]{2,10}(?:\.[a-z]{2,10})?$/.test(email)){
                    
                }else{
					document.getElementById('chatemailErr').innerHTML = "Input Valid Email!!";
					return false;
				}
				if (password == "")
				{
					document.getElementById('chatpassErr').innerHTML = "Input field required";
					return false;
				}
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function ()
				{
					if (this.readyState == 4 && this.status == 200)
					{
						var response = this.responseText;
						//alert(response);
					    //console.log(response);
						var row = JSON.parse(response);
						if(row['mailErr']=='ERROR!!'){
							document.getElementById('chatemailErr').innerHTML = "Sorry You are not Registered";
					        return false;

						}else if(row['passErr']=='ERROR!!'){
							document.getElementById('chatpassErr').innerHTML = "Invalid Password";
					        return false;
						}else{
							window.location.href='index.php';
						}
						//console.log(row['mailErr']);
						//console.log(row['passErr']);
					   // console.log(row[0]);
					}
				};
				xhttp.open("POST", "chatlogin.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("email=" + email + "&password=" + password);
			}else if(currentid=='join'){
				//console.log('join');				
				document.getElementById('passErr').innerHTML ="*";
				document.getElementById('emailErr').innerHTML="*";
				document.getElementById('nameErr').innerHTML ="*";
				var name = document.getElementById('chatName').value;
				var email = document.getElementById('chatEmail').value;
				var password = document.getElementById('chatPass').value;
				if (name == "")
				{
					document.getElementById('nameErr').innerHTML = "Input field required";
					return false;
				}else if(/^([a-zA-Z ])+$/.test(name)){
			
				}else{
					document.getElementById('nameErr').innerHTML = "Only Letters and space are allowed";
					return false;
				}
				if (email == "")
				{
					document.getElementById('emailErr').innerHTML = "Input field required";
					return false;
				}else if(/^[a-z0-9][a-z0-9-_\.]+@([a-z]|[a-z0-9]?[a-z0-9-]+[a-z0-9])\.[a-z0-9]{2,10}(?:\.[a-z]{2,10})?$/.test(email)){
                    
                }else{
					document.getElementById('emailErr').innerHTML = "Input Valid Email!!";
					return false;
				}
				if (password == "")
				{
					document.getElementById('passErr').innerHTML = "Input field required";
					return false;
				}
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function ()
				{
					if (this.readyState == 4 && this.status == 200)
					{
						var response = this.responseText;
						if(response == 'Email Already Exist!!!'){
							document.getElementById('emailErr').innerHTML = response;
					        return false;
						}else{
							window.location.href='index.php';
						}
						//alert(response);
						//sconsole.log(response);
						//var row = JSON.parse(response);
					   // console.log(row[0]);
					   // console.log(row[0]);
					}
				};
				xhttp.open("POST", "chatregister.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("name="+name+"&email=" + email + "&password=" + password);
			}			
		});
	</script>
	<script>
	    
        function getDetails()
        {
            return new Promise(function(resolve, reject) {
                $.get('https://ipinfo.io/json', 
                    {   
                        token:"ae18d345d75c70"
                    }, 
                    function(response)
                    {
                        var jsonResponse  = response;
                        usercountry = jsonResponse.country;
                        usercountry = usercountry.trim();
                        console.log("Log jsonResponse");
                        console.log(jsonResponse);
                        console.log(jsonResponse.ip, jsonResponse.country);
                        getState(jsonResponse.country);
                        resolve(response);
                    });
            });
        }
        getDetails().then(function(data) {
          // Run this when your request was successful
          //console.log(modelArr);
          modelArr.forEach(function(value, index, array)
          {
              countrySec(value.divId,value.country)
              console.log(value.divId);
          });
          allCountry.forEach(function (cntry){
            //alert(cntry)
            if(usercountry == cntry.code)
            {
                //alert(cntry.code);
                countryObject = cntry;
                getCities(usercountry);
            }
        });
        }).catch(function(err) {
          // Run this when promise was rejected via reject()
          console.log(err);
        });
        
        function getState(country_id)
        {
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
                    /*var x = document.getElementById("state");
                    var opt = document.createElement("option");
                    opt.text = "Select Province or State";
                    opt.value = "Default";
                    x.add(opt);*/
                    //state
                    //city
                    
                    /*
                    <ul aria-expanded="false" id="stateList">
                            <li><a href="index.php?province=Eastern_Cape">Eastern Cape </a></li>
                    */
                    for(var i = 0; i < countryJson.length; i++) 
                    {
                        var obj = countryJson[i];
                        $("#stateList").append("<li><a href='index.php?province="+obj.state_code+"'>"+obj.name+" </a></li>");
                        $("#stateList1").append("<li><a href='index.php?province="+obj.state_code+"' id='"+obj.state_code+"'>"+obj.name+" </a></li>");
                        
                        /*var option = document.createElement("option");
                        option.text = obj.name;
                        option.value = obj.state_code;
                        if(state == obj.state_code)
                        {
                            option.selected = true;
                        }
                        x.add(option);*/
                        
                        //console.log(obj.name);
                    }
                    //getCities(country_id);
                     
                }
            }; 
            xhttp.open("POST", "../model/getCountry.php", true);
            xhttp.send(formData); 
        }
        
        function getCities(country_id)
        {
            //var x = document.getElementById("city");
            //console.log("lOG countryObject");
            //console.log(countryObject);
            var country  = countryObject.name;
            //var country = document.createElement("countrySelect").value;
            
            //x.add(opt);
            json.data.forEach(function(item)
            {
                if(item.country == country)
                {
                    item.cities.forEach(function(city)
                    {
                        
                        $("#cityList").append("<li><a href='index.php?city="+city+"'>"+city+" </a></li>");
                        $("#cityList1").append("<li><a href='index.php?city="+city+"' '>"+city+" </a></li>");
                        
                    });
                    
                }
                
            });
            //console.log(json.data);
        }
	</script>
	<script>
    </script>
</body>
</html>