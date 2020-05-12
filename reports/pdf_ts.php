<?php
session_start();
require_once("../config/dbconfig.php");
require_once("../config/settings.php");
require_once("../plugins/phptopdfapp/code128.php");
require_once("../employee/academics/controller.php");

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
	
	/*
	function Footer(){
		global $sch_address1, $sch_address2, $sch_citymun, $sch_province, $sch_country, $sch_phone, $sch_email;
		
		$this->SetY(-20);
		$this->SetFont('Arial','',8);
		$this->Cell(0,2,mb_convert_encoding('_________________________________________________________________________________________________________________________','ISO-8859-1', 'UTF-8'),0,1,'C');
		$this->Image('../../assets/images/logo.png',15, $this->GetY()+3, 10);
		$this->Ln(3);
		$this->SetFont('Arial','I',6);
		$this->Cell(12,3,'',0,0,'L');
		$this->Cell(0,3,mb_convert_encoding($sch_address1.', '.$sch_address2,'ISO-8859-1', 'UTF-8'),0,1,'L');
		$this->Cell(12,3,'',0,0,'L');
		$this->Cell(0,3,mb_convert_encoding($sch_citymun.', '.$sch_province.', '.$sch_country,'ISO-8859-1', 'UTF-8'),0,1,'L');
		$this->Cell(12,3,'',0,0,'L');
		$this->Cell(0,3,mb_convert_encoding('Phone: '.$sch_phone.' | Email: '.$sch_email,'ISO-8859-1', 'UTF-8'),0,1,'L');
		$this->SetY(-28);
		$this->Image('../../assets/images/province_banner.png',180, $this->GetY()+3, 20);
		$this->SetY(-20);
		$this->SetFont('Arial','BI',6);
		$this->Cell(0,3,'Page '.$this->PageNo().' of {nb}',0,0,'C');
	}
	*/
	
	function TableData($header, $col_width, $data){
		global $controller;
		global $conn;
		
		$this->SetFont('Arial','B',6);
		for($i = 0; $i < count($header); $i++){
			$this->Cell($col_width[$i],4,$header[$i],1,0,'C');
		}
		$this->Ln();
		
		$i = 1;
		while($row = $data->fetch_assoc()){
			$class = $row['class_no'];
			$class_name = $row['section_name'];
			
			$getGrades = "SELECT * FROM grade
				WHERE grade_class_no = '$class'";
			$getGradesRS = $conn->query($getGrades);
			$countGrades = (!$getGradesRS ? $conn->error: $getGradesRS->num_rows);
			
			$getInactive = "SELECT * FROM studenroll
				WHERE enrol_status1 = 'INACTIVE' AND enrol_section = '$class_name' AND enrol_sy = '2019'";
			$getInactiveRS = $conn->query($getInactive);
			$countInactive = (!$getInactiveRS ? $conn->error: $getInactiveRS->num_rows);
			
			$getWithGradesQ1 = "SELECT * FROM grade
				WHERE grade_class_no = '$class' AND grade_q1 >= 60";
			$getWithGradesQ1RS = $conn->query($getWithGradesQ1);
			$countWithGradesQ1RS = (!$getWithGradesQ1RS ? $conn->error: $getWithGradesQ1RS->num_rows);
			
			$getWithGradesQ2 = "SELECT * FROM grade
				WHERE grade_class_no = '$class' AND grade_q2 >= 60";
			$getWithGradesQ2RS = $conn->query($getWithGradesQ2);
			$countWithGradesQ2RS = (!$getWithGradesQ2RS ? $conn->error: $getWithGradesQ2RS->num_rows);
			
			$getWithGradesQ3 = "SELECT * FROM grade
				WHERE grade_class_no = '$class' AND grade_q3 >= 60";
			$getWithGradesQ3RS = $conn->query($getWithGradesQ3);
			$countWithGradesQ3RS = (!$getWithGradesQ3RS ? $conn->error: $getWithGradesQ3RS->num_rows);
			
			$getWithGradesQ4 = "SELECT * FROM grade
				WHERE grade_class_no = '$class' AND grade_q4 >= 60";
			$getWithGradesQ4RS = $conn->query($getWithGradesQ4);
			$countWithGradesQ4RS = (!$getWithGradesQ4RS ? $conn->error: $getWithGradesQ4RS->num_rows);
			
			$this->SetFont('Arial','B',7);
			$this->Cell($col_width['0'],4,mb_convert_encoding($i++,'ISO-8859-1', 'UTF-8'),1,0,'R');
			$this->Cell($col_width['1'],4,mb_convert_encoding($row['user_fullname'],'ISO-8859-1', 'UTF-8'),1,0,'L');
			$this->Cell($col_width['2'],4,mb_convert_encoding(($row['class_sem'] == 12 ? "Full Year" : "Sem ".$row['class_sem']),'ISO-8859-1', 'UTF-8'),1,0,'L');
			$this->Cell($col_width['3'],4,mb_convert_encoding($row['section_level']."-".$row['section_name'],'ISO-8859-1', 'UTF-8'),1,0,'L');
			$this->Cell($col_width['4'],4,mb_convert_encoding($row['pros_title'],'ISO-8859-1', 'UTF-8'),1,0,'L');
			$this->Cell($col_width['5'],4,mb_convert_encoding((round($countWithGradesQ1RS/($countGrades-$countInactive)*100,0) > 100 ? 100 : round($countWithGradesQ1RS/($countGrades-$countInactive)*100,0)).'%','ISO-8859-1', 'UTF-8'),1,0,'R');
			$this->Cell($col_width['6'],4,mb_convert_encoding((round($countWithGradesQ2RS/($countGrades-$countInactive)*100,0) > 100 ? 100 : round($countWithGradesQ2RS/($countGrades-$countInactive)*100,0)).'%','ISO-8859-1', 'UTF-8'),1,0,'R');		
			$this->Cell($col_width['7'],4,mb_convert_encoding(($row['section_level'] > 10 ? "" : (round($countWithGradesQ3RS/($countGrades-$countInactive)*100,0) > 100 ? 100 : round($countWithGradesQ3RS/($countGrades-$countInactive)*100,0)).'%'),'ISO-8859-1', 'UTF-8'),1,0,'R');		
			$this->Cell($col_width['8'],4,mb_convert_encoding(($row['section_level'] > 10 ? "" : (round($countWithGradesQ4RS/($countGrades-$countInactive)*100,0) > 100 ? 100 : round($countWithGradesQ4RS/($countGrades-$countInactive)*100,0)).'%'),'ISO-8859-1', 'UTF-8'),1,0,'R');		
			$this->Cell($col_width['9'],4,mb_convert_encoding('','ISO-8859-1', 'UTF-8'),1,0,'L');		
			$this->Ln();
		}		
	}
}

$pdf = new PDF('P','mm',array(215.9,330.2));
$pdf->SetMargins(12.70,12.70,12.70,5.70);
$pdf->AddPage();
$pdf->AliasNbPages();

$controller  = new Controller();

$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,4,mb_convert_encoding('TEACHER GRADE SUBMISSION COMPLIANCE','ISO-8859-1', 'UTF-8'),0,1,'C');
$pdf->Cell(0,4,mb_convert_encoding('SCHOOL YEAR 2019-2020','ISO-8859-1', 'UTF-8'),0,1,'C');
$pdf->SetFont('Arial','i',8);
$pdf->Cell(0,3,mb_convert_encoding('as of '.date('M 2, Y h:iA', strtotime(date('M 2, Y h:iA'))+ (7*3600)),'ISO-8859-1', 'UTF-8'),0,1,'C');
$pdf->Ln(4);

$sql = "SELECT * FROM class
	INNER JOIN users ON class_user_name = user_no
	INNER JOIN prospectus ON class_pros_no = pros_no
	INNER JOIN section ON class_section_no = section_no
	WHERE class_sy = '2019'
	GROUP BY class_sem, user_no, class_section_no, class_pros_no
	ORDER BY user_fullname ASC, class_sem ASC, section_level ASC, section_name ASC, pros_sort ASC";
$rs = $conn->query($sql);

if(!$rs){
	echo $conn->error;
} else {
	$row = $rs->fetch_assoc();
	$header = array('#', 'NAME', 'SEM', 'SECTION', 'SUBJECT', 'Q1', 'Q2', 'Q3', 'Q4', 'Remarks');
	$col_width = array(6,45,15,28,21,10,10,10,10,35);
	
	$pdf->TableData($header, $col_width, $rs);	
}


$pdf->Ln();
$pdf->SetFont('Arial','I',7);
$pdf->Cell(0,3,'Note: This document is system-generated. No signature is required.',0,1,'L');		
$pdf->Output();
?>