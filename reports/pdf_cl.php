<?php
session_start();
require_once("../config/dbconfig.php");
require_once("../config/settings.php");

if(isset($_GET['id']) && isset($_GET['sy'])){
	$id = $_GET['id'];
	$sy = $_GET['sy'];

	$result = $conn->query("SELECT * FROM section
		WHERE (section_no = '$id' 
		AND section_sy = '$sy ')");
	$row = $result->fetch_assoc();


	if($result->num_rows > 0) {
		header("Location: pdf_cl.php?enrol_sy=".$sy."&classProfile=".$row['section_name']."&classProfile=".$row['section_name']);
	} 
}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Class List</title>
	<style>
	table {
	
	}
	
	th{
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.6em;
	} 
	
	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.5em;		
	}

	@media print {
	  #printPageButton {
		display: none;
	  }
	}
	</style>
</head>	
<p align="right"><button id="printPageButton" style="background-color:green; color: white;" onClick="window.print();">Print</button></p>
<table border="0" cellspacing="0" cellpadding="0" width="750">
	<tr>
		<td width="60" valign="top"><img src="../assets/images/deped_logo.png" width="80"></td>
		<td align="center" valign="top">
		Republic of the Philippines<br>
		Department of Education<br>
		<?php echo $sch_regionname;?><br>
		<strong>Division of <?php echo $sch_division;?></strong><br>
		<strong>DISTRICT OF <?php echo strtoupper($sch_district);?></strong><br><br>
		<strong><?php echo $sch_name;?></strong><br>
		<i><?php echo $sch_fulladdress;?></i><br>
		<h2>CLASS LIST </h2>
		School Year <?php echo $_SESSION['current_sy'] ;?>-<?php echo $_SESSION['current_sy']+1;?>, <?php echo ($_SESSION['current_sem'] ==1?"First":"Second");?> Semester<br>
		<?php 
		$checkLevel = $conn->query("select * from section where (section_name='".$_GET['classProfile']."' and section_sy='".$_GET['enrol_sy']."')");
		$dataLevel = $checkLevel->fetch_assoc();
		?>
		<u><h1><?php echo "Grade ".$dataLevel['section_level']." - ".$_GET['classProfile'];?></h1></u>
		</td>
		<td width="60" valign="top"><img src="../assets/images/logo.png" width="80"></td>
	</tr>
</table>
<?php
$resultTeacher = $conn->query("SELECT * FROM section INNER JOIN users ON section.section_adviser=users.user_no WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
$dataTeacher = $resultTeacher->fetch_assoc();
?>
	
<table border="0" cellspacing="0" cellpadding="0" width="750">
<tr>
<?php
$result= $conn->query("SELECT * FROM studenroll INNER JOIN student ON studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='MALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
$rows = $result->num_rows;
?>
<td valign="top" width="375">Males (<?php echo  $rows; ?>)
<table border="0" cellspacing="0" cellpadding="1" width="100%">
	<tr>
		<th width="1%">#</th>
		<th>FULLNAME</th>	
		<th  width="30%">LRN / Stud No</th>
		<th  width="20%"></th>
	</tr>
	<?php
	$i=1;
	while($data = $result->fetch_assoc()){
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".($data['stud_mname']=="-"?"":substr($data['stud_mname'],0,1).".")); ?></td>
		<td align="center"><strong><?php echo $data['stud_lrn'];?> / <?php echo $data['stud_no'];?></strong></td>
		<td align="center"></td>
	</tr>	
	<?php 
	$i++;
	} ?>
</table>
</td>
<td>&nbsp;</td>
<?php
$result= $conn->query("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='FEMALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
$rows = $result->num_rows;
?>
<td valign="top" width="375">Females (<?php echo  $rows; ?>)
<table border="0" cellspacing="0" cellpadding="1" width="100%">
	<tr>
		<th width="1%">#</th>
		<th width="38%">FULLNAME</th>
		<th  width="30%">LRN / Stud No</th>
		<th  width="20%"></th>
	</tr>
	<?php
	$i=1;
	while($data = $result->fetch_assoc()){
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".($data['stud_mname']=="-"?"":substr($data['stud_mname'],0,1).".")); ?></td>
		<td align="center"><strong><?php echo $data['stud_lrn'];?> / <?php echo $data['stud_no'];?></strong></td>
		<td align="center"></td>
	</tr>
	<?php 
	$i++;
	} ?>
</table>
</td>
</tr>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="800">
	<tr>
		<td width="30%"></td>
		<td></td>
		<td width="30%">Prepared by:<br><br><br></td>
	</tr>
	<tr>
		<?php
		$checkUser = $conn->query("SELECT * FROM users WHERE user_no='".$dataTeacher['user_no']."'");
		$dataUser = $checkUser->fetch_assoc();
		?>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"><b><?php echo strtoupper($dataUser['user_fullname']);?></b><br>Class Adviser</td>
		
	</tr>	
	<tr>
		<td width="30%">Approval Recommended:<br><br><br></td>
		<td></td>
		<td width="30%"><br><br></td>
	</tr>	
	<tr>
		<td align="center"><b><?php echo strtoupper($current_principal);?></b><br>School Principal</td>
		<td align="center"></td>
		<td align="center"></td>
		
	</tr>	
	<tr>
		<td width="30%"><br><br><br>Contents Noted:<br><br><br></td>
		<td></td>
		<td width="30%"><br><br><br>Approved:<br><br><br></td>
	</tr>	
	<tr>
		<td align="center"><b><?php echo strtoupper($current_supervisor);?></b><br>Public Schools District Supervisor</td>
		<td align="center"></td>
		<td align="center"><b><?php echo strtoupper($current_superintendent);?></b><br>Schools Division Superintendent</td>
		
	</tr>	
	<tr>
		<?php
		$checkUser = $conn->query("SELECT * FROM users WHERE user_name='".$_SESSION["user_name"]."'");
		$dataUser = $checkUser->fetch_assoc();
		?>
		<td colspan="3"></td>
	</tr>			
</table>