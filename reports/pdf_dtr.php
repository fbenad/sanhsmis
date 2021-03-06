<?php
session_start();
require_once("../config/dbconfig.php");
require_once("../config/settings.php");

$checkTeacher = $conn->query("select * from teacher where teach_bio_no='".($_GET['id'] == "%" ? -1 : $_GET['id'])."'");
$dataTeacher = $checkTeacher->fetch_assoc();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Form 48 - Daily Time Record</title>
	<style>
	.borderdraw {
		position:fixed;
		border-style:solid;
		height:0;
		line-height:0;
		width:0;
		z-index:-1;
	}

	.tag1{ z-index:9999;position:absolute;top:40px; }
	.tag2 { z-index:9999;position:absolute;left:40px; }
	.diag { position: relative; width: 50px; height: 50px; }
	.outerdivslant { position: absolute; top: 0px; left: 0px; border-color: transparent transparent transparent rgb(64, 0, 0); border-width: 50px 0px 0px 60px;}
	.innerdivslant {position: absolute; top: 1px; left: 0px; border-color: transparent transparent transparent #fff; border-width: 49px 0px 0px 59px;}                  

	table {
	
	}
	
	th{
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.5em;
	} 

	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.7em;		
	}

	@media print {
	  #printPageButton {
		display: none;
	  }
	}
	</style>	
</head>
<p align="right"><button id="printPageButton" style="background-color:green; color: white;" onClick="window.print();">Print</button></p>
<br><br><br>
<table border="0" cellspacing="0" cellpadding="1" width="800">
<tr>
	<td width="50%" align="center">
		<table border="0" cellspacing="0" cellpadding="1" width="90%">
			<tr><td colspan="7" >CIVIL SERVICE FORM No. 48<br><br></td></tr>
			<tr><td colspan="7" align="center"><font size="3"><strong>DAILY TIME RECORD</strong></font></td></tr>
			<tr><td colspan="7" align="center" style="BORDER-BOTTOM: black solid 1px"><br><font size="2"><strong><?php echo strtoupper($dataTeacher['teach_fname']." ".substr($dataTeacher['teach_mname'],0,1).($dataTeacher['teach_mname']=="-"?"":".")." ".$dataTeacher['teach_lname']." ".$dataTeacher['teach_xname']);?></strong></td></tr>
			<tr><td colspan="7" align="center"><i>(Name)</i></td></tr>
			<tr>
				<td colspan="3" width="35%">For the month of </td>
				<td colspan="4" align="center" style="BORDER-BOTTOM: black solid 1px"><strong><?php echo date('F, Y',strtotime($_GET['year']."-".$_GET['month']."-01")); ?></strong></td>
			</tr>
			<tr>
				<td colspan="3">Office hours for arrival</td>
				<td colspan="2" align="center">Regular Days</td>
				<td colspan="2" align="center" style="BORDER-BOTTOM: black solid 1px"><small>
					<?php echo date('h:iA', strtotime($office_timeIn));?>-<?php echo date('h:iA', strtotime($office_timeOut));?>
					</small>
				</td>
			</tr>
			<tr>
				<td colspan="3" align="center">and departure</td>
				<td colspan="2" align="center">Saturdays</td>
				<td colspan="2" align="center" style="BORDER-BOTTOM: black solid 1px"><small>As Required</small></td>
			</tr>
			<tr>
				<td colspan="7"></td>
			</tr>
			<tr>
				<td align="center" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"></td>
				<td colspan="2" align="center" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>AM</strong></td>
				<td colspan="2" align="center" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>PM</strong></td>
				<td colspan="2" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>UNDERTIME</strong></td>
			</tr>
			<tr height="2">
				<td align="center" width="5%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>DAY</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Arrival</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Departure</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Arrival</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Departure</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Hours</small></td>
				<td align="center" width="13%" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Minutes</small></td>
			</tr>
			<?php
			$checkTeacherData = $conn->query("SELECT * FROM teacherappointments INNER JOIN dropdowns ON teacherappointments_position=field_name WHERE teacherappointments_teach_no='".$dataTeacher['teach_no']."'");
			$dataTeacherData = $checkTeacherData->fetch_assoc();
			$total_undertime_minutes=0;
			for($i=1;$i<=31;$i++){
				$undertime_minutes=0;
				$exceedMinutes=0;
				$am_in= (substr($dataTeacherData['field_ext'],0,1)=="1"?strtotime($_GET['year']."-".$_GET['month']."-".$i." 07:45:00"):strtotime($_GET['year']."-".$_GET['month']."-".$i." 08:00:00"));
				$am_out= strtotime($_GET['year']."-".$_GET['month']."-".$i." 12:00:00");
				$pm_in= strtotime($_GET['year']."-".$_GET['month']."-".$i." 13:00:00");
				if($_GET['year']=="2019" && $_GET['month']=="09" && $i==23)
					$pm_out= strtotime($_GET['year']."-".$_GET['month']."-".$i." 14:00:00");
				else
					$pm_out= strtotime($_GET['year']."-".$_GET['month']."-".$i." 17:00:00");
			?>
			<tr height="20">
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo $i;?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 00:00:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 11:59:59";
				$checkAMIn = $conn->query("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='I' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME asc");
				$dataAMIn = $checkAMIn->fetch_assoc();
				$countAMIn = $checkAMIn->num_rows;
				$exceedMinutes = ($countAMIn==0?0: strtotime($dataAMIn['CHECKTIME']) - $am_in);
				$undertime = ($exceedMinutes>60?$exceedMinutes:0);
				$undertime_minutes_AMIn = floor($undertime/60);
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataAMIn['CHECKTIME']==""?"":date('g:ia', strtotime($dataAMIn['CHECKTIME'])));?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 8:00:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 13:00:00";
				$checkAMOut = $conn->query("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='O' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME desc");
				$dataAMOut = $checkAMOut->fetch_assoc();
				$countAMOut = $checkAMOut->num_rows;
				$exceedMinutes = ($countAMOut==0?0:$am_out - strtotime($dataAMOut['CHECKTIME']));
				$undertime = ($exceedMinutes<0?0:$exceedMinutes);
				$undertime_minutes_AMOut = floor($undertime/60);
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataAMOut['CHECKTIME']==""?"":date('g:ia', strtotime($dataAMOut['CHECKTIME'])));?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 12:30:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 16:59:59";
				$checkPMIn = $conn->query("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='I' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME asc");
				$dataPMIn = $checkPMIn->fetch_assoc();
				$countPMIn = $checkPMIn->num_rows;
				$exceedMinutes = ($countPMIn==0?0:strtotime($dataPMIn['CHECKTIME'])-$pm_in);
				$undertime = ($exceedMinutes>60?$exceedMinutes:0);
				$undertime_minutes_PMIn = floor($undertime/60);
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataPMIn['CHECKTIME']==""?"":date('g:ia', strtotime($dataPMIn['CHECKTIME'])));?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 14:00:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 23:59:59";
				$checkPMOut = $conn->query("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='O' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME desc");
				$dataPMOut = $checkPMOut->fetch_assoc();
				$countPMOut = $checkPMOut->num_rows;
				$exceedMinutes = ($countPMOut==0?0:$pm_out - strtotime($dataPMOut['CHECKTIME']));
				$undertime = ($exceedMinutes<0?0:$exceedMinutes);
				$undertime_minutes_PMOut = floor($undertime/60);
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataPMOut['CHECKTIME']==""?"":date('g:ia', strtotime($dataPMOut['CHECKTIME'])));?></td>
				<?php
				$undertime_minutes = $undertime_minutes_AMIn + $undertime_minutes_AMOut + $undertime_minutes_PMIn + $undertime_minutes_PMOut;
				?>
				<!-- for UNDERTIME column -->
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font color="pink"><?php echo (floor($undertime_minutes/60)==0?"":(floor($undertime_minutes/60)==0?"":floor($undertime_minutes/60)));?></font></td>
				<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font color="pink"><?php echo (floor($undertime_minutes/60)>0?($undertime_minutes%60==0?"":$undertime_minutes%60):($undertime_minutes==0?"":$undertime_minutes));?></font></td>
			</tr>
			<?php
				$total_undertime_minutes = $total_undertime_minutes + $undertime_minutes;
			}
			?>
			<tr>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
			</tr>
			<tr height="25">
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="left" colspan="4" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"><strong>TOTAL</strong></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"><font color="pink"><?php echo (floor($total_undertime_minutes/60)==0?"":floor($total_undertime_minutes/60));?></font></td>
				<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"><font color="pink"><?php echo (floor($total_undertime_minutes/60)>0?$total_undertime_minutes%60:($total_undertime_minutes==0?"":$total_undertime_minutes));?></font></td>
			</tr>
			<tr>
				<td align="center" colspan="7">
				<i>I CERTIFY on my honor that the above is a true and correct report of the hours of work perform, record of which was made daily at the time of arrival and departure from office.</i>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="7" style="BORDER-BOTTOM: black solid 1px">
				<font size="2"><br><strong><?php echo strtoupper($dataTeacher['teach_fname']." ".substr($dataTeacher['teach_mname'],0,1).($dataTeacher['teach_mname']=="-"?"":".")." ".$dataTeacher['teach_lname']." ".$dataTeacher['teach_xname']);?></strong>
				</td>
			</tr>
			<tr>
				<td align="left" colspan="7" style="">
				<i>Verified as to the prescribed office hours.</i>				
				</td>
			</tr>
			<tr>
				<td align="left" colspan="7" style="">			
				</td>
			</tr>
			<tr>
				<td align="left" colspan="3" style=""></td>
				<td align="center" colspan="4" style="BORDER-BOTTOM: black solid 1px">
				<?php
				$checkSupervisor = $conn->query("select * from teacherappointments where (teacherappointments_teach_no='".$dataTeacher['teach_no']."' and teacherappointments_active='1')");
				$dataSupervisor = $checkSupervisor->fetch_assoc();
				if(substr($dataSupervisor['teacherappointments_position'],0,9)=="PRINCIPAL"){
					$supervisor = $current_psds;					
				}
				else {
					$supervisor = $current_principal;					
				}
				?>
				<strong><font size="2"><?php echo $supervisor;?></strong></font>
				</td>
			</tr>
			<tr>
				<td align="left" colspan="3" style=""></td>
				<td align="center" colspan="4">
				In Charge
				</td>
			</tr>
		</table>
	</td>
	<td width="50%" align="center">
		<table border="0" cellspacing="0" cellpadding="1" width="90%">
			<tr><td colspan="7" >CIVIL SERVICE FORM No. 48<br><br></td></tr>
			<tr><td colspan="7" align="center"><font size="3"><strong>DAILY TIME RECORD</strong></font></td></tr>
			<tr><td colspan="7" align="center" style="BORDER-BOTTOM: black solid 1px"><br><font size="2"><strong><?php echo strtoupper($dataTeacher['teach_fname']." ".substr($dataTeacher['teach_mname'],0,1).($dataTeacher['teach_mname']=="-"?"":".")." ".$dataTeacher['teach_lname']." ".$dataTeacher['teach_xname']);?></strong></td></tr>
			<tr><td colspan="7" align="center"><i>(Name)</i></td></tr>
			<tr>
				<td colspan="3" width="35%">For the month of </td>
				<td colspan="4" align="center" style="BORDER-BOTTOM: black solid 1px"><strong><?php echo date('F, Y',strtotime($_GET['year']."-".$_GET['month']."-01")); ?></strong></td>
			</tr>
			<tr>
				<td colspan="3">Office hours for arrival</td>
				<td colspan="2" align="center">Regular Days</td>
				<td colspan="2" align="center" style="BORDER-BOTTOM: black solid 1px"><small>
					<?php echo date('h:iA', strtotime($office_timeIn));?>-<?php echo date('h:iA', strtotime($office_timeOut));?>
					</small>
				</td>
			</tr>
			<tr>
				<td colspan="3" align="center">and departure</td>
				<td colspan="2" align="center">Saturdays</td>
				<td colspan="2" align="center" style="BORDER-BOTTOM: black solid 1px"><small>As Required</small></td>
			</tr>
			<tr>
				<td colspan="7"></td>
			</tr>
			<tr>
				<td align="center" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"></td>
				<td colspan="2" align="center" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>AM</strong></td>
				<td colspan="2" align="center" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>PM</strong></td>
				<td colspan="2" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>UNDERTIME</strong></td>
			</tr>
			<tr height="2">
				<td align="center" width="5%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>DAY</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Arrival</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Departure</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Arrival</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Departure</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Hours</small></td>
				<td align="center" width="13%" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Minutes</small></td>
			</tr>
			<?php
			$checkTeacherData = $conn->query("SELECT * FROM teacherappointments INNER JOIN dropdowns ON teacherappointments_position=field_name WHERE teacherappointments_teach_no='".$dataTeacher['teach_no']."'");
			$dataTeacherData = $checkTeacherData->fetch_assoc();
			$total_undertime_minutes=0;
			for($i=1;$i<=31;$i++){
				$undertime_minutes=0;
				$exceedMinutes=0;
				$am_in= (substr($dataTeacherData['field_ext'],0,1)=="1"?strtotime($_GET['year']."-".$_GET['month']."-".$i." 07:45:00"):strtotime($_GET['year']."-".$_GET['month']."-".$i." 08:00:00"));
				$am_out= strtotime($_GET['year']."-".$_GET['month']."-".$i." 12:00:00");
				$pm_in= strtotime($_GET['year']."-".$_GET['month']."-".$i." 13:00:00");
				if($_GET['year']=="2019" && $_GET['month']=="09" && $i==23)
					$pm_out= strtotime($_GET['year']."-".$_GET['month']."-".$i." 14:00:00");
				else
					$pm_out= strtotime($_GET['year']."-".$_GET['month']."-".$i." 17:00:00");
			?>
			<tr height="20">
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo $i;?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 00:00:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 11:59:59";
				$checkAMIn = $conn->query("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='I' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME asc");
				$dataAMIn = $checkAMIn->fetch_assoc();
				$countAMIn = $checkAMIn->num_rows;
				$exceedMinutes = ($countAMIn==0?0: strtotime($dataAMIn['CHECKTIME']) - $am_in);
				$undertime = ($exceedMinutes>60?$exceedMinutes:0);
				$undertime_minutes_AMIn = floor($undertime/60);
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataAMIn['CHECKTIME']==""?"":date('g:ia', strtotime($dataAMIn['CHECKTIME'])));?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 8:00:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 13:00:00";
				$checkAMOut = $conn->query("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='O' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME desc");
				$dataAMOut = $checkAMOut->fetch_assoc();
				$countAMOut = $checkAMOut->num_rows;
				$exceedMinutes = ($countAMOut==0?0:$am_out - strtotime($dataAMOut['CHECKTIME']));
				$undertime = ($exceedMinutes<0?0:$exceedMinutes);
				$undertime_minutes_AMOut = floor($undertime/60);
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataAMOut['CHECKTIME']==""?"":date('g:ia', strtotime($dataAMOut['CHECKTIME'])));?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 12:30:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 16:59:59";
				$checkPMIn = $conn->query("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='I' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME asc");
				$dataPMIn = $checkPMIn->fetch_assoc();
				$countPMIn = $checkPMIn->num_rows;
				$exceedMinutes = ($countPMIn==0?0:strtotime($dataPMIn['CHECKTIME'])-$pm_in);
				$undertime = ($exceedMinutes>60?$exceedMinutes:0);
				$undertime_minutes_PMIn = floor($undertime/60);
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataPMIn['CHECKTIME']==""?"":date('g:ia', strtotime($dataPMIn['CHECKTIME'])));?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 14:00:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 23:59:59";
				$checkPMOut = $conn->query("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='O' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME desc");
				$dataPMOut = $checkPMOut->fetch_assoc();
				$countPMOut = $checkPMOut->num_rows;
				$exceedMinutes = ($countPMOut==0?0:$pm_out - strtotime($dataPMOut['CHECKTIME']));
				$undertime = ($exceedMinutes<0?0:$exceedMinutes);
				$undertime_minutes_PMOut = floor($undertime/60);
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataPMOut['CHECKTIME']==""?"":date('g:ia', strtotime($dataPMOut['CHECKTIME'])));?></td>
				<?php
				$undertime_minutes = $undertime_minutes_AMIn + $undertime_minutes_AMOut + $undertime_minutes_PMIn + $undertime_minutes_PMOut;
				?>
				<!-- for UNDERTIME column -->
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font color="pink"><?php echo (floor($undertime_minutes/60)==0?"":(floor($undertime_minutes/60)==0?"":floor($undertime_minutes/60)));?></font></td>
				<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font color="pink"><?php echo (floor($undertime_minutes/60)>0?($undertime_minutes%60==0?"":$undertime_minutes%60):($undertime_minutes==0?"":$undertime_minutes));?></font></td>
			</tr>
			<?php
				$total_undertime_minutes = $total_undertime_minutes + $undertime_minutes;
			}
			?>
			<tr>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
			</tr>
			<tr height="25">
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="left" colspan="4" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"><strong>TOTAL</strong></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"><font color="pink"><?php echo (floor($total_undertime_minutes/60)==0?"":floor($total_undertime_minutes/60));?></font></td>
				<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"><font color="pink"><?php echo (floor($total_undertime_minutes/60)>0?$total_undertime_minutes%60:($total_undertime_minutes==0?"":$total_undertime_minutes));?></font></td>
			</tr>
			<tr>
				<td align="center" colspan="7">
				<i>I CERTIFY on my honor that the above is a true and correct report of the hours of work perform, record of which was made daily at the time of arrival and departure from office.</i>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="7" style="BORDER-BOTTOM: black solid 1px">
				<font size="2"><br><strong><?php echo strtoupper($dataTeacher['teach_fname']." ".substr($dataTeacher['teach_mname'],0,1).($dataTeacher['teach_mname']=="-"?"":".")." ".$dataTeacher['teach_lname']." ".$dataTeacher['teach_xname']);?></strong>
				</td>
			</tr>
			<tr>
				<td align="left" colspan="7" style="">
				<i>Verified as to the prescribed office hours.</i>				
				</td>
			</tr>
			<tr>
				<td align="left" colspan="7" style="">			
				</td>
			</tr>
			<tr>
				<td align="left" colspan="3" style=""></td>
				<td align="center" colspan="4" style="BORDER-BOTTOM: black solid 1px">
				<?php
				$checkSupervisor = $conn->query("select * from teacherappointments where (teacherappointments_teach_no='".$dataTeacher['teach_no']."' and teacherappointments_active='1')");
				$dataSupervisor = $checkSupervisor->fetch_assoc();
				if(substr($dataSupervisor['teacherappointments_position'],0,9)=="PRINCIPAL"){
					$supervisor = $current_psds;					
				}
				else {
					$supervisor = $current_principal;					
				}
				?>
				<strong><font size="2"><?php echo $supervisor;?></strong></font>
				</td>
			</tr>
			<tr>
				<td align="left" colspan="3" style=""></td>
				<td align="center" colspan="4">
				In Charge
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>

