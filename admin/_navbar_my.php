</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
<div class="wrapper">
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
			</li>
			<li class="nav-item">
				<a href="?p=my" class="nav-link active">User</a>
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
			if($_SESSION['user_type'] == 2){
				$withImage = "../assets/images/students/".$_SESSION['user_no'].".jpg";
				$noImage = "../assets/avatars/".$_SESSION['user_gender'].".jpg";				
			} else {
				$withImage = "../assets/images/teachers/".$_SESSION['user_no'].".jpg";
				$noImage = "../assets/avatars/".$_SESSION['user_gender'].".jpg";				
			}

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
						<a href="<?php echo ($_SESSION['user_type'] == 1 ? "../employee/?p=my" : "../student/?p=my");?>" class="nav-link">
							<i class="nav-icon fas fa-reply"></i>
							<p>Back to profile</p>
						</a>
					</li>
				</ul>
			</nav>	
			<hr>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item" id="access-my">
						<a href="?p=my" class="nav-link <?php echo($_GET['p'] == "my" ? "active" : "");?>">
							<i class="nav-icon fas fa-tachometer-alt"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li class="nav-item" id="access-siteconfig">
						<a href="?p=siteconfig" class="nav-link <?php echo($_GET['p'] == "siteconfig" ? "active" : "");?>">
							<i class="nav-icon fas fa-cogs"></i>
							<p>Site Administration</p>
						</a>
					</li>					
					<li class="nav-item has-treeview" id="access-schmgmt0">
						<a href="#" class="nav-link <?php echo($_GET['p'] == "schmgmt" || $_GET['p'] == "schmgmt-acadcurr" || $_GET['p'] == "schmgmt-acadoffer" || $_GET['p'] == "schmgmt-acadload" ? "active" : "");?>">
							<i class="nav-icon fas fa-school"></i>
							<p>School Management<i class="right fas fa-angle-left"></i></p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item" id="access-schmgmt">
								<a href="?p=schmgmt" class="nav-link <?php echo($_GET['p'] == "schmgmt" ? "active" : "");?>">
									<i class="far fa-circle nav-icon"></i>
									<p>School Information</p>
								</a>
							</li>
							<li class="nav-item" id="access-schmgmt-acadcurr">
								<a href="?p=schmgmt-acadcurr" class="nav-link <?php echo($_GET['p'] == "schmgmt-acadcurr"  ? "active" : "");?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Manage Curriculum</p>
								</a>
							</li>
							<li class="nav-item" id="access-schmgmt-acadoffer">
								<a href="?p=schmgmt-acadoffer" class="nav-link <?php echo($_GET['p'] == "schmgmt-acadoffer"  ? "active" : "");?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Manage Offerings</p>
								</a>
							</li>
							<li class="nav-item" id="access-schmgmt-acadload">
								<a href="?p=schmgmt-acadload" class="nav-link <?php echo($_GET['p'] == "schmgmt-acadload"  ? "active" : "");?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Manage Loads</p>
								</a>
							</li>
						</ul>
					</li>		
					<li class="nav-item has-treeview" id="access-users">
						<a href="#" class="nav-link <?php echo($_GET['p'] == "users" || $_GET['p'] == "users-access" ? "active" : "");?>">
							<i class="nav-icon fas fa-user-tie"></i>
							<p>User Administration<i class="right fas fa-angle-left"></i></p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="?p=users" class="nav-link <?php echo($_GET['p'] == "users" ? "active" : "");?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Users</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="?p=users-access" class="nav-link <?php echo($_GET['p'] == "users-access" ? "active" : "");?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Access</p>
								</a>
							</li>
						</ul>
					 </li>
					<li class="nav-item has-treeview" id="access-employees">
						<a href="#" class="nav-link <?php echo($_GET['p'] == "employees" || $_GET['p'] == "employees-saln" || $_GET['p'] == "employees-dtr" ? "active" : "");?>">
							<i class="nav-icon fas fa-user-tie"></i>
							<p>Manage Employee<i class="right fas fa-angle-left"></i></p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="?p=employees" class="nav-link <?php echo($_GET['p'] == "employees" ? "active" : "");?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Dashboard</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="?p=employees-saln" class="nav-link <?php echo($_GET['p'] == "employees-saln" ? "active" : "");?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Manage SALN</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="?p=employees-dtr" class="nav-link <?php echo($_GET['p'] == "employees-dtr" ? "active" : "");?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Manage DTR</p>
								</a>
							</li>
						</ul>
					 </li>
					 <li class="nav-item" id="access-students">
						<a href="?p=students" class="nav-link <?php echo($_GET['p'] == "students" ? "active" : "");?>">
							<i class="nav-icon fas fa-user-graduate"></i>
							<p>Manage Student</p>
						</a>
					</li>
					<li class="nav-item has-treeview" id="access-classes0">
						<a href="#" class="nav-link <?php echo($_GET['p'] == "classes" || $_GET['p'] == "admissions" ? "active" : "");?>">
							<i class="nav-icon fas fa-user-tie"></i>
							<p>Class Management<i class="right fas fa-angle-left"></i></p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item" id="access-classes">
								<a href="?p=classes" class="nav-link <?php echo($_GET['p'] == "classes" ? "active" : "");?>">
									<i class="far fa-circle nav-icon" id="classes-01"></i>
									<p>Dashboard</p>
									<span id="classes01"></span>
								</a>
							</li>
							<li class="nav-item" id="access-admissions">
								<a href="?p=admissions" class="nav-link <?php echo($_GET['p'] == "admissions" ? "active" : "");?>">
									<i class="far fa-circle nav-icon" id="classes-02"></i>
									<p>Admissions</p>
									<span id="classes02"></span>
								</a>
							</li>
						</ul>
					 </li>					
					<li class="nav-item" id="access-reports">
						<a href="?p=reports" class="nav-link <?php echo($_GET['p'] == "reports" ? "active" : "");?>">
							<i class="nav-icon fas fa-file-alt"></i>
							<p>Report</p>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</aside>
	
<script>
var user_role = <?php echo $_SESSION['user_role'];?>;
var modacc_user_no = <?php echo $_SESSION['user_no'];?>;
var modacc_role = 0;

setTimeout(function(){displayMenu();}, 1);
setTimeout(function(){checkAccess();}, 2);

function displayMenu(){
	var action = 'checkAccess';
	var counter = 0;
	
	var data = [action, modacc_user_no, 'my'];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || user_role == 1){
				$('#access-my').show();
			} else {
				$('#access-my').hide();
			}
		}
	});
	
	var data = [action, modacc_user_no, 'siteconfig'];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || user_role == 1){
				$('#access-siteconfig').show();
			} else {
				$('#access-siteconfig').hide();
			}
		}
	});
	
	var data = [action, modacc_user_no, 'schmgmt'];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || user_role == 1){
				$('#access-schmgmt').show();
			} else {
				$('#access-schmgmt').hide();
			}
		}
	});
	
	var data = [action, modacc_user_no, 'schmgmt-acadcurr'];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || user_role == 1){
				$('#access-schmgmt-acadcurr').show();
			} else {
				$('#access-schmgmt-acadcurr').hide();
			}
		}
	});
	
	var data = [action, modacc_user_no, 'schmgmt-acadoffer'];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || user_role == 1){
				$('#access-schmgmt-acadoffer').show();
			} else {
				$('#access-schmgmt-acadoffer').hide();
			}
		}
	});
	
	var data = [action, modacc_user_no, 'schmgmt-acadload'];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || user_role == 1){
				$('#access-schmgmt-acadload').show();
			} else {
				$('#access-schmgmt-acadload').hide();
			}
		}
	});
	
	var data = [action, modacc_user_no, 'users'];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || user_role == 1){
				$('#access-users').show();
			} else {
				$('#access-users').hide();
			}
		}
	});
	
	var data = [action, modacc_user_no, 'employees'];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || user_role == 1){
				$('#access-employees').show();
			} else {
				$('#access-employees').hide();
			}
		}
	});
	
	var data = [action, modacc_user_no, 'students'];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || user_role == 1){
				$('#access-students').show();
			} else {
				$('#access-students').hide();
			}
		}
	});
	
	var data = [action, modacc_user_no, 'classes'];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || user_role == 1){
				$('#access-classes').show();
			} else {
				$('#access-classes').hide();
			}
		}
	});
	
	var data = [action, modacc_user_no, 'admissions'];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || user_role == 1){
				$('#access-admissions').show();
			} else {
				$('#access-admissions').hide();
			}
		}
	});
	
	
	var data = [action, modacc_user_no, 'reports'];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || user_role == 1){
				$('#access-reports').show();
			} else {
				$('#access-reports').hide();
			}
		}
	});
}	


function checkAccess(){
	var action = 'checkAccess';
	var slug = '<?php echo $_GET['p'];?>';
	
	if(slug != 'denied'){
		var data = [action, modacc_user_no, slug];
		$.ajax({
			type: 'POST',
			url: 'users/access/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1 || user_role == 1 || slug == 'home' || slug == 'auth' || slug == 'tools' ){
					if(user_role == 1){
						modacc_role = 1;
					} else {
						modacc_role = result[2].modacc_role;
					}
				} else {
					window.location = '?p=denied';
				}
			}
		});
		
	} else {}
}
</script>