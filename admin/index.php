<?php
session_start();

require_once("../config/dbconfig.php");
require_once("../config/settings.php");
if(isset($_GET['p'])){
	if ($_GET['p'] == "verify"){
		if(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['SANHSMIS_Employee'] == true){
			$_SESSION['user_type'] = 1;
			$user_no = $_SESSION['user_no'];
			$user_type = $_SESSION['user_type'];
			echo '<script>window.location = "verify.php?user_no='.$user_no.'&user_type='.$user_type.'";</script>';
		} else if(isset($_SESSION['SANHSMIS_Student']) && $_SESSION['SANHSMIS_Student'] == true){
			$_SESSION['user_type'] = 2;
			$_SESSION['SANHSMIS_Employee'] = $_SESSION['SANHSMIS_Student'];
			$_SESSION['user_no'] = $_SESSION['stud_no'];
			$user_no = $_SESSION['user_no'];
			$user_type = $_SESSION['user_type'];
			echo '<script>window.location = "verify.php?user_no='.$user_no.'&user_type='.$user_type.'";</script>';			
		} else {
			echo '<script>window.location = "../";</script>';
		}
		
	} else if ($_GET['p'] == "lock"){
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		$title = "User | Locked";
		$_SESSION['SANHSMIS_Locked'] = true;
		require_once("_header.php");
		require_once("_navbar_auth.php");
		require_once("auth/lock.php");	
		
	} else if ($_GET['p'] == "auth"){
		 header("Location: ../");
		
	} else if ($_GET['p'] == "initial"){
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		$title = "User | Initial Login";
		require_once("_header.php");
		require_once("_navbar_auth.php");
		require_once("auth/initial.php");
		
	} else if ($_GET['p'] == "logout"){
		unset($_SESSION['SANHSMIS_Employee']);
		unset($_SESSION['SANHSMIS_Student']);
		unset($_SESSION['SANHSMIS_Locked']);
		unset($_SESSION['user_no']);
		unset($_SESSION['user_name']);
		unset($_SESSION['user_role']);
		unset($_SESSION['user_fullname']);
		unset($_SESSION['user_position']);
		unset($_SESSION['user_gender']);
		unset($_SESSION['user_type']);		
		echo '<script> window.location = "../"; </script>';	
		
	} else if ($_GET['p'] == "my"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");
		$title = "Dashboard";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("my/index.php");	
		
	} else if ($_GET['p'] == "home"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");
		$title = "Dashboard";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("my/home.php");	
		
	} else if ($_GET['p'] == "classes"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");
		if(isset($_GET['show'])){
			$title = "Classes | Dashboard";
			require_once("_header.php");
			require_once("_navbar_my.php");
			require_once("classes/show/index.php");		
		} else {
			$title = "Classes Management | Dashboard";
			require_once("_header.php");
			require_once("_navbar_my.php");
			require_once("classes/index.php");				
		}
		
	} else if ($_GET['p'] == "admissions"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");
		$title = "Users | Dashboard";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("classes/admissions/index.php");	
		
	} else if ($_GET['p'] == "users"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");
		$title = "Users | Dashboard";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("users/index.php");	
		
	} else if ($_GET['p'] == "users-access"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");
		$title = "Users Access | Dashboard";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("users/access/index.php");	
		
	} else if ($_GET['p'] == "employees"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");
		if(isset($_GET['show'])){
			$title = "Employee | Dashboard";
			require_once("_header.php");
			require_once("_navbar_my.php");
			require_once("employees/show/index.php");			
		} else if(isset($_GET['new'])){
			$title = "New Employee | Dashboard";
			require_once("_header.php");
			require_once("_navbar_my.php");
			require_once("employees/show/new.php");			
		} else if(isset($_GET['modify'])){
			$title = "Manage Employee | Dashboard";
			require_once("_header.php");
			require_once("_navbar_my.php");
			require_once("employees/show/modify.php");			
		} else {
			$title = "Employees | Dashboard";
			require_once("_header.php");
			require_once("_navbar_my.php");
			require_once("employees/index.php");	
		}			
		
	} else if ($_GET['p'] == "students"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");
		if(isset($_GET['show'])){
			$title = "Student | Dashboard";
			require_once("_header.php");
			require_once("_navbar_my.php");			
			require_once("students/show/index.php");	
			
		} else if(isset($_GET['new'])){
			$title = "New Student | Dashboard";
			require_once("_header.php");
			require_once("_navbar_my.php");
			require_once("students/show/new.php");
			
		} else if(isset($_GET['modify'])){
			$title = "Manage Student | Dashboard";
			require_once("_header.php");
			require_once("_navbar_my.php");
			require_once("students/show/modify.php");
			
		} else {
			$title = "Students | Dashboard";
			require_once("_header.php");
			require_once("_navbar_my.php");
			require_once("students/index.php");		
		}
		
	} else if ($_GET['p'] == "schmgmt"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");
		$title = "School Management | Dashboard";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("schmgmt/index.php");
		
	} else if($_GET['p'] == "schmgmt-acadcurr"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");		
		$title = "Curriculum Management | Dashboard";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("schmgmt/acadcurr/index.php");		
			
	} else if($_GET['p'] == "schmgmt-acadoffer"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");				
		$title = "Offerings Management | Dashboard";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("schmgmt/acadoffer/index.php");	
	
	} else if($_GET['p'] == "schmgmt-acadload"){	
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");			
		$title = "Load Assignment Management | Dashboard";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("schmgmt/acadload/index.php");	
		
	} else if ($_GET['p'] == "siteconfig"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");
		$title = "Site Management | Dashboard";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("siteconfig/index.php");	
		
	} else if ($_GET['p'] == "employees-saln"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");
		$title = "SALN Management | Dashboard";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("employees/saln/index.php");	
		
	} else if ($_GET['p'] == "employees-dtr"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");
		$title = "DTR Management | Dashboard";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("employees/dtr/index.php");	
		
	} else if ($_GET['p'] == "reports"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee']) ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");
		$title = "Reports | Dashboard";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("reports/index.php");	
		
	} else if ($_GET['p'] == "tools"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee'])  ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");
		$title = "User | Tools";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("my/tools.php");	
		
	} else if ($_GET['p'] == "denied"){
		$_SESSION['SANHSMIS_Locked'] = false;
		(isset($_SESSION['SANHSMIS_Employee']) && $_SESSION['user_pass'] == MD5($default_pass) ? header("Location: ?p=initial") : "");
		(!isset($_SESSION['SANHSMIS_Employee'])  ? header("Location: ?p=auth") : "");
		($_SESSION['SANHSMIS_Locked'] == true ? header("Location: ?p=lock") : "");
		$title = "Access 401";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("_401.php");	
		
	} else {	
		$title = "Error 404";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("_404.php");		
	}
} else {
	echo '<script>window.location = "?p=verify";</script>';
}
?>
<a id="back-to-top" href="#" class="btn btn-secondary back-to-top" role="button" aria-label="Scroll to top">
	<i class="fas fa-chevron-up"></i>
</a>

<script type="text/javascript">	
setTimeout(function(){window.location = '?p=lock';}, 1800000);
</script>
<?php
include("_footer.php");
?>