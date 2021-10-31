<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
			<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
				<a class="navbar-brand brand-logo" href="index.php"><img src="images/logo-compact1.png" alt="logo" /></a>
				<a class="navbar-brand brand-logo-mini" href="#"><img src="images/favicon1.png" alt="logo" /></a>
			</div>
			<div class="navbar-menu-wrapper d-flex align-items-stretch">
				<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize"> <span class="mdi mdi-menu"></span> </button>
				<ul class="navbar-nav navbar-nav-right">
					<li class="nav-item nav-profile dropdown">
						<a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
							<div class="nav-profile-text">
								<p class="mb-1">
									<?php echo $_SESSION['name'] ?>
								</p>
							</div>
						</a>
						<div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
							<a class="dropdown-item" href="#"> <i class="mdi mdi-cached mr-2"></i>Activity Log </a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="logout.php"> <i class="mdi mdi-logout mr-2"></i> Signout </a>
						</div>
					</li>
				</ul>
				<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas"> <span class="mdi mdi-menu"></span> </button>
			</div>
    </nav>