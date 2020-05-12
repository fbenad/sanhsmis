<?php
require_once("dbconfig.php");
// Organization
/** Retrieving database info **/
$sql = "SELECT * FROM license";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sch_code =  $row['current_school_code'];
$sch_name = $row['current_school_full'];
$sch_fullname = $row['current_school_full'];
$sch_shortname = $row['current_school_short'];
$sch_acronym = $row['current_school_short'];
$sch_phone = $row['current_school_contact'];
$sch_email = $row['current_school_email'];
$sch_web = "www.sanagustinnhs.net";
$sch_address1 = "Purok 2";
$sch_address2 = "San Agustin";
$sch_fulladdress = $row['current_school_address'];
$sch_district = $row['current_school_district'];
$sch_citymun = $row['current_school_district'];
$sch_division = $row['current_school_division'];
$sch_province = $row['current_school_division'];
$sch_region = "Region ".$row['current_school_reg_code'];
$sch_regionname = $row['current_school_region'];
$sch_country = "Philippines";
$sch_foundyear = "1994";
$sch_type = "Public Sector";
$min_level = $row['current_school_minlevel'];
$max_level = $row['current_school_maxlevel'];

$office_timeIn = "08:00:00";
$office_timeOut = "17:00:00";

// Application
$app_fullname = "$sch_acronym Management Information System";
$app_acronym = "$sch_acronym MIS";
$app_author = "Fernando B. Enad";
$app_authoremail = "fbenad@up.edu.ph";
$app_authorphone = "+63.917.626.8262";
$app_devtdate = "2020-01-01";
$app_lastdate = "2020-04-14";
$app_copyyear = "2020";
$app_version = "1.20.1";
$app_copynotice = "The license of this web application falls under the public domain.";

// Base URL and current date
$_SESSION['baseURL'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$_SESSION['today_date'] = date('Y-m-d');

// School Settings
/** Retrieving database info **/
$sql = "SELECT * FROM settings
	WHERE activated = '1'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$_SESSION['current_currYear'] = $row['settings_pros'];
$_SESSION['current_sy'] = $row['settings_sy'];
$_SESSION['current_sem'] = $row['settings_sem'];
$_SESSION['current_month'] = $row['settings_month'];
$_SESSION['bosy_date'] = $row['settings_bosy'];
$_SESSION['eosy_date'] = $row['settings_eosy'];
$_SESSION['eosy'] = ($row['settings_eosynow'] == 1 ? true : false);
$current_registrar = $row['settings_registrar'];
$current_principal = $row['settings_principal'];
$current_supervisor = $row['settings_supervisor'];
$current_represenatative = $row['settings_representative'];
$current_superintendent = $row['settings_superintendent'];
$loginmessage = $row['settings_loginmessage'];
$admission_message = $row['settings_admissionmessage'];


// Grade Settings
$max_grade = 100;
$min_grade = 60;
$pass_grade = 75;
$promo_status2 = 0;
$conditional_status2 = 1;
$retained_status2 = 3;
$tier1_grade = 97.500;
$tier2_grade = 94.500;
$tier3_grade = 89.500;

// Default Password
$default_pass = "P@ssw0rd";

?>