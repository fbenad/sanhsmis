</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed sidebar-collapse">
<div class="wrapper">
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
			</li>
			<li class="nav-item">
				<a href="?p=my" class="nav-link active">Student</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link active">
					 <span class="d-none d-md-inline"><i class="fas fa-toggle-on"></i> SY <?php echo $_SESSION['current_sy']."-".($_SESSION['current_sy']+1);?>,
					Sem <?php echo $_SESSION['current_sem'];?></span>
				</a>
			</li>
		</ul>

		<ul class="navbar-nav ml-auto">
			<?php
			$withImage = "../assets/images/students/".$_SESSION['stud_no'].".jpg";
			$noImage = "../assets/avatars/".$_SESSION['stud_gender'].".jpg";
			?>
			<li class="nav-item dropdown user-menu">
				<a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">
				  <img src="<?php echo (file_exists($withImage) ? $withImage : $noImage); ?>" class="user-image img-circle elevation-2" alt="User Image">
				  <span class="d-none d-md-inline"><?php echo $_SESSION['stud_fullname'];?></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<li class="user-header bg-info">
						<img src="<?php echo (file_exists($withImage) ? $withImage : $noImage); ?>" class="img-circle elevation-2" alt="User Image">
						<p>
							<?php echo $_SESSION['stud_fullname'];?>
							<small><?php echo 'Grade '.$_SESSION['enrol_level'].' - '.$_SESSION['enrol_track'];?></small>
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
						<a href="?p=academics" class="nav-link <?php echo($_GET['p'] ==  "academics" ? "active" : "");?>">
							<i class="nav-icon fas fa-book-reader"></i> 
							<p>My Academics</p>
						</a>
					</li>
					<?php
					$stud_no = $_SESSION['stud_no'];
					
					$sql = "SELECT * FROM users
						WHERE (user_no = $stud_no
							AND user_status = '1')";
					
					$rs = $conn->query($sql);
					
					if($rs->num_rows > 0){
						?>
						<li class="nav-item">
							<a href="../admin" class="nav-link">
								<i class="nav-icon fas fa-cogs"></i> 
								<p>Access</p>
							</a>
						</li>
						<?php
					}
					?>
				</ul>
			</nav>
		</div>
	</aside>