<?php
session_start();
require_once("../config/dbconfig.php");
require_once("../config/settings.php");
require_once("../plugins/phptopdfapp/code128.php");
require_once("controller.php");

class PDF extends FPDF{
	
	function Header(){
		global $sch_region, $sch_regionname, $sch_division, $sch_district, $sch_fullname;
		
		$this->Image('../assets/images/deped_seal.png',100,10,15);
		$this->Ln(14);
		$this->SetFont('Arial','',8);
		$this->Cell(190,3,mb_convert_encoding('Republic of the Philippines','ISO-8859-1', 'UTF-8'),0,1,'C');
		$this->SetFont('Arial','B',9);
		$this->Cell(190,3,mb_convert_encoding('Department of Education','ISO-8859-1', 'UTF-8'),0,1,'C');
		$this->SetFont('Arial','',8);
		$this->Cell(190,3,mb_convert_encoding($sch_region.' - '.$sch_regionname ,'ISO-8859-1', 'UTF-8'),0,1,'C');
		$this->SetFont('Arial','',8);
		$this->Cell(190,3,mb_convert_encoding('Schools Division of '.$sch_division,'ISO-8859-1', 'UTF-8'),0,1,'C');	
		$this->SetFont('Arial','',8);
		$this->Cell(190,3,mb_convert_encoding('District of '.$sch_district,'ISO-8859-1', 'UTF-8'),0,1,'C');
		$this->SetFont('Arial','B',9);
		$this->Cell(190,3,mb_convert_encoding(strtoupper($sch_fullname),'ISO-8859-1', 'UTF-8'),0,1,'C');	
		$this->SetFont('Arial','',8);
		$this->Cell(190,-2,mb_convert_encoding('_________________________________________________________________________________________________________________________','ISO-8859-1', 'UTF-8'),0,1,'C');	
		$this->Ln(8);		
	}
	
	function Footer(){
		global $sch_address1, $sch_address2, $sch_citymun, $sch_province, $sch_country, $sch_phone, $sch_email;
		
		$this->SetY(-25);
		$this->SetFont('Arial','',8);
		$this->Cell(0,2,mb_convert_encoding('_________________________________________________________________________________________________________________________','ISO-8859-1', 'UTF-8'),0,1,'C');
		$this->Image('../assets/images/logo.png',15, $this->GetY()+3, 10);
		$this->Ln(3);
		$this->SetFont('Arial','I',6);
		$this->Cell(12,3,'',0,0,'L');
		$this->Cell(0,3,mb_convert_encoding($sch_address1.', '.$sch_address2,'ISO-8859-1', 'UTF-8'),0,1,'L');
		$this->Cell(12,3,'',0,0,'L');
		$this->Cell(0,3,mb_convert_encoding($sch_citymun.', '.$sch_province.', '.$sch_country,'ISO-8859-1', 'UTF-8'),0,1,'L');
		$this->Cell(12,3,'',0,0,'L');
		$this->Cell(0,3,mb_convert_encoding('Phone: '.$sch_phone.' | Email: '.$sch_email,'ISO-8859-1', 'UTF-8'),0,1,'L');
		$this->SetY(-28);
		$this->Image('../assets/images/province_banner.png',180, $this->GetY()+3, 20);
		$this->SetY(-20);
		$this->SetFont('Arial','BI',6);
		$this->Cell(0,3,'Page '.$this->PageNo().' of {nb}',0,0,'C');
	}
	
	function TableData($header, $col_width, $data, $delimiter){
		global $controller;
		$level = ($delimiter == "" ? 0 : 1);
		
		$this->SetFont('Arial','B',6);
		for($i = 0; $i < count($header); $i++){
			$this->Cell($col_width[$i],4,$header[$i],1,0,'C');
		}
		$this->Ln();
		
		for($i = 0; $i < count($header); $i++){
			$this->Cell($col_width[$i],4,'',1,0,'C');
		}
		$this->Ln();
		
		$this->SetFont('Arial','',7);
		$i = 1;
		while($row = $data->fetch_assoc()){
			$getStatusData = array(array('getStatus', $row['grade_stud_no'], $row['grade_sy']));
			$getStatus = $controller->getStatus($getStatusData);
			if($getStatus['0'] == 1){ $getStatusRow = $getStatus['2']->fetch_assoc();
				$getStatusLabel = $getStatusRow['enrol_status1']." as of ".date('M d, Y', strtotime($getStatusRow['enrol_updatedate']));
			} else {
				$getStatusLabel = $getStatus['1']; 
			}
			
			$fullname = $row['stud_lname'].', '.$row['stud_fname'].' '.$row['stud_xname'].' '.($row['stud_mname'] == "-" ? $row['stud_mname'] : substr($row['stud_mname'], 0, 1).".");
			$this->Cell($col_width['0'],4,mb_convert_encoding($i,'ISO-8859-1', 'UTF-8'),1,0,'R');
			$this->Cell($col_width['1'],4,mb_convert_encoding($fullname,'ISO-8859-1', 'UTF-8'),1,0,'L');
			$this->Cell($col_width['2'],4,mb_convert_encoding(($row['grade_q1'] == 0 ? "" : $row['grade_q1']),'ISO-8859-1', 'UTF-8'),1,0,'R');
			$this->Cell($col_width['3'],4,mb_convert_encoding(($row['grade_q2'] == 0 ? "" : $row['grade_q2']),'ISO-8859-1', 'UTF-8'),1,0,'R');
			$this->Cell($col_width['4'],4,mb_convert_encoding(($row['grade_q3'] == 0 ? "" : $row['grade_q3']),'ISO-8859-1', 'UTF-8'),1,0,'R');
			$this->Cell($col_width['5'],4,mb_convert_encoding(($row['grade_q4'] == 0 ? "" : $row['grade_q4']),'ISO-8859-1', 'UTF-8'),1,0,'R');
			$this->SetFont('Arial','B',7);
			if($level == 0){
				$this->Cell($col_width['6'],4,mb_convert_encoding(($row['grade_q1'] == 0 || $row['grade_q2'] == 0 ? "" : $row['grade_final']),'ISO-8859-1', 'UTF-8'),1,0,'R');
			} else {
				$this->Cell($col_width['6'],4,mb_convert_encoding(($row['grade_q1'] == 0 || $row['grade_q2'] == 0 || $row['grade_q3'] == 0 || $row['grade_q4'] == 0 ? "" : $row['grade_final']),'ISO-8859-1', 'UTF-8'),1,0,'R');
			}
			$this->SetFont('Arial','',7);
			if($level == 0){
				$this->Cell($col_width['7'],4,mb_convert_encoding(($row['grade_q1'] == 0 || $row['grade_q2'] == 0 ? $getStatusLabel : ($row['grade_remarks'] == 1 ? "Passed" : "Failed")),'ISO-8859-1', 'UTF-8'),1,0,'L');
			} else {
				$this->Cell($col_width['7'],4,mb_convert_encoding(($row['grade_q1'] == 0 || $row['grade_q2'] == 0 || $row['grade_q3'] == 0 || $row['grade_q4'] == 0 ? $getStatusLabel : ($row['grade_remarks'] == 1 ? "Passed" : "Failed")),'ISO-8859-1', 'UTF-8'),1,0,'L');
			}
			$this->Ln();
			
			if($delimiter > 0 && $i == $delimiter){
				for($i = 0; $i < count($header); $i++){
					$this->Cell($col_width[$i],4,'',1,0,'C');
				}
				$this->Ln();
				$i = 1;
				$delimiter = 0;
			} else {
				$i++;
			}
		}		
	}
}

$pdf = new PDF('P','mm',array(215.9,330.2));
$pdf->SetMargins(12.70,12.70,12.70,12.70);
$pdf->AddPage();
$pdf->AliasNbPages();

$controller  = new Controller();

if(isset($_GET['id'])){
	$id = $_GET['id'];	
	
	$data = array(array('getClass', $id));
	$resultClass = $controller->getClassInfo($data);

	$data = array(array('getClassList', $id, '%'));
	$resultTotal = $controller->getClassList($data, ' ');

	$data = array(array('getClassList', $id, 'MALE'));
	$resultMale = $controller->getClassList($data, ' ');

	$data = array(array('getClassList', $id, 'FEMALE'));
	$resultFemale = $controller->getClassList($data, ' ');
		
	if($resultClass['0'] == 1){
		$row = $resultClass['2']->fetch_assoc();
		$subjSec = $row['pros_title'].", ".$row['section_name'];
		$termSY = ($row['class_sem'] == "12" ? "" : "Sem ".$row['class_sem'].", ")."SY ".$row['class_sy']."-".($row['class_sy'] + 1);
		$schedule = $row['class_timeslots']." (".$row['class_days'].")";	
		$teacher = $row['teach_lname'].", ".$row['teach_fname']." ".$row['teach_xname']." ".($row['teach_mname'] == "-" ? $row['teach_mname'] : substr($row['teach_mname'], 0, 1).".");

		if($resultTotal['0'] == 1 && $resultMale['0'] == 1 && $resultFemale['0'] == 1){
			$total = $resultMale['3']."(M) | ".$resultFemale['3']."(F) | ".$resultTotal['3']."(T)";
		} else {
			$total = $resultMale['1'];
		}
		
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(0,3,mb_convert_encoding('GRADE SHEET','ISO-8859-1', 'UTF-8'),0,1,'C');
		$pdf->Ln(4);

		$pdf->SetFont('Arial','',8);
		$pdf->Cell(28,3,mb_convert_encoding('Subject & Section','ISO-8859-1', 'UTF-8'),0,0,'L');
		$pdf->Cell(5,3,':',0,0,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(87,3,mb_convert_encoding($subjSec,'ISO-8859-1', 'UTF-8'),0,0,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(30,3,'Term & School Year',0,0,'R');
		$pdf->Cell(5,3,':',0,0,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(35,3,mb_convert_encoding($termSY,'ISO-8859-1', 'UTF-8'),0,1,'L');

		$pdf->SetFont('Arial','',8);
		$pdf->Cell(28,3,mb_convert_encoding('Schedule & Teacher','ISO-8859-1', 'UTF-8'),0,0,'L');
		$pdf->Cell(5,3,':',0,0,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(87,3, mb_convert_encoding($schedule ,'ISO-8859-1', 'UTF-8'),0,0,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(30,3,'Number of Students',0,0,'R');
		$pdf->Cell(5,3,':',0,0,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(35,3,$total,0,1,'L');

		$pdf->SetFont('Arial','',8);
		$pdf->Cell(28,3,mb_convert_encoding('Teacher','ISO-8859-1', 'UTF-8'),0,0,'L');
		$pdf->Cell(5,3,':',0,0,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(87,3, mb_convert_encoding($teacher ,'ISO-8859-1', 'UTF-8'),0,1,'L');
		$pdf->Ln();

		$header = array('#', 'NAME (Last Name, First Name, MI)', ($row['section_level'] > 10 ? 'Midterm' : 'Q1'), ($row['section_level'] > 10 ? 'Final' : 'Q2'), ($row['section_level'] > 10 ? '' : 'Q3'), ($row['section_level'] > 10 ? '' : 'Q4'), 'Ave', 'Remarks');
		$col_width = array(5,60,10,10,10,10,15,70);
		
		if($row['section_level'] > 10){
			$data = array(array('getClassList', $id, '%'));
			$resultTotal = $controller->getClassList($data, '');
			$pdf->TableData($header, $col_width, $resultTotal['2'], 0);
		} else if($row['section_level'] <= 10){
			$data = array(array('getClassList', $id, '%'));
			$resultTotal = $controller->getClassList($data, ' stud_gender DESC, ');
			$pdf->TableData($header, $col_width, $resultTotal['2'], $resultMale['3']);
		} else {
			$pdf->Cell(100,3,$resultClass['1'],0,1,'L');
		}
		
	} else {
		$pdf->Cell(0,3,mb_convert_encoding('Critical error encountered due to an attempt to manipulate URL values, please close the window and try again!','ISO-8859-1', 'UTF-8'),0,1,'C');
	}
	
} else {
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(0,3,mb_convert_encoding('Critical error encountered due to an attempt to manipulate URL values, please close the window and try again!','ISO-8859-1', 'UTF-8'),0,1,'C');
}

$pdf->Ln();
$pdf->SetFont('Arial','I',7);
$pdf->Cell(0,3,'Note: This document is system-generated. No signature is required.',0,1,'L');	
$pdf->Output();
?>