</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed sidebar-collapse">
<div class="wrapper">
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
			</li>
			<li class="nav-item">
				<a href="?p=my" class="nav-link active">Employee</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link active">
					 <span class="d-none d-md-inline"><i class="fas fa-toggle-on"></i> SY <?php echo $_SESSION['current_sy']."-".($_SESSION['current_sy']+1);?>,
					Sem <?php echo $_SESSION['current_sem'];?></span>
				</a>
			</li>
		</ul>

		<ul class="navbar-nav ml-auto">
			<!--
			<li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<i class="far fa-comments"></i>
					<span class="badge badge-danger navbar-badge">3</span>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<a href="#" class="dropdown-item">
					<div class="media">
						<img src="../assets/images/logo.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
						<div class="media-body">
							<h3 class="dropdown-item-title">
								Brad Diesel
								<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
							</h3>
							<p class="text-sm">Call me whenever you can...</p>
							<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
						</div>
					</div>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
				</div>
			</li>
			
			<li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<i class="far fa-bell"></i>
					<span class="badge badge-warning navbar-badge">15</span>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<span class="dropdown-item dropdown-header">15 Notifications</span>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item">
						<i class="fas fa-file mr-2"></i> 3 new reports
						<span class="float-right text-muted text-sm">2 days</span>
					</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
				</div>
			</li>
			-->
			<?php
			$withImage = "../assets/images/teachers/".$_SESSION['user_no'].".jpg";
			$noImage = "../assets/avatars/".$_SESSION['user_gender'].".jpg";
			?>
			<li class="nav-item dropdown user-menu">
				<a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">
				  <img src="<?php echo (file_exists($withImage) ? $withImage : $noImage); ?>" class="user-image img-circle elevation-2" alt="User Image">
				  <span class="d-none d-md-inline"><?php echo $_SESSION['user_fullname'];?></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<li class="user-header bg-info">
						<img src="<?php echo (file_exists($withImage) ? $withImage : $noImage); ?>" class="img-circle elevation-2" alt="User Image">
						<p>
							<?php echo $_SESSION['user_fullname'];?>
							<small id="nav-position"><?php echo $_SESSION['user_position'];?></small>
							<small>School Year <?php echo $_SESSION['current_sy']." - ".($_SESSION['current_sy']+1);?>,
							Sem <?php echo $_SESSION['current_sem'];?></small>
						</p>
					</li>
					<li class="user-body">
						<div class="row">
							<div class="col-4 text-center">
								<a href="?p=tools" class="btn btn-default btn-flat">Tools</a>
							</div>
							<div class="col-4 text-center">
								<?php $_SESSION['prev_url'] = $_SESSION['baseURL']."$_SERVER[REQUEST_URI]";?>
								<a href="?p=lock" class="btn btn-default btn-flat">Lock</a>
							</div>
							<div class="col-4 text-center">
								<a href="?p=logout" class="btn btn-default btn-flat">Logout</a>
							</div>
						</div>
					</li>
				</ul>
			</li>
			<li class="nav-item nav-item">
				<a href="../support/" target="_blank" class="nav-link" title="help"><i class="fas fa-question-circle"></i></a>
			</li>
		</ul>
	</nav>
	
	<aside class="main-sidebar sidebar-dark-info elevation-4">
		<a href="?p=my" class="brand-link">
			<img src="../assets/images/logo.png" alt="School Logo" class="brand-image img-circle elevation-3"
				style="opacity: .8">
			<span class="brand-text font-weight-light"><?php echo $app_acronym;?></span>
		</a>
	
		<div class="sidebar">	  
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item">
						<a href="?p=my" class="nav-link <?php echo($_GET['p'] == "my"?"active":"");?>">
							<i class="nav-icon fas fa-home"></i>
							<p>Home</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="?p=academics" class="nav-link <?php echo($_GET['p'] ==  "academics" || $_GET['p'] ==  "admissions" ? "active" : "");?>">
							<i class="nav-icon fas fa-book-reader"></i>
							<p>My Academics</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="?p=services" class="nav-link <?php echo($_GET['p'] ==  "services" ? "active" : "");?>">
							<i class="nav-icon fas fa-concierge-bell"></i> 
							<p>Personnel Services</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="../admin/" class="nav-link">
							<i class="nav-icon fas fa-cogs"></i> 
							<p>Access</p>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</aside>