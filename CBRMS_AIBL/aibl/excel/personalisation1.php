<?php
// Connect database. 
include_once ("../../config.php");

/// Get data records from table. 
$result=mysql_query("select *from aibl_chq_rqst where rqst_status='ordered' and ac_type='$_REQUEST[ac_type]' order by collecting_branch asc, ac_type desc, start_no asc, total_leaf asc, approval_date_time desc");

// Functions for export to excel.
function xlsBOF() { 
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0); 
return; 
} 
function xlsEOF() { 
echo pack("ss", 0x0A, 0x00); 
return; 
} 
function xlsWriteNumber($Row, $Col, $Value) { 
echo pack("sssss", 0x203, 14, $Row, $Col, 0x0); 
echo pack("d", $Value); 
return; 
} 
function xlsWriteLabel($Row, $Col, $Value ) { 
$L = strlen($Value); 
echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L); 
echo $Value; 
return; 
} 

if($_REQUEST[ac_type]=='Imperial')
$filename=date('d-m-y').'-aibl_Imp';
else if($_REQUEST[ac_type]=='Current')
$filename=date('d-m-y').'-aibl_CD';
else
$filename=date('d-m-y').'-aibl_SB';

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=$filename.xls"); 
header("Content-Transfer-Encoding: binary ");

xlsBOF();

/*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/

//xlsWriteLabel(0,0,"Requested Cheque Book Information.");

// Make column labels. (at line 3)

xlsWriteLabel(0,0,"Account no");
xlsWriteLabel(0,1,"Start no");
xlsWriteLabel(0,2,"No of leaves");
xlsWriteLabel(0,3,"End no");
xlsWriteLabel(0,4,"MICR Account");
xlsWriteLabel(0,5,"Routing no");
xlsWriteLabel(0,6,"Transaction Code");
xlsWriteLabel(0,7,"Name");
xlsWriteLabel(0,8,"Branch_code");
xlsWriteLabel(0,9,"Delivery Branch");

$xlsRow = 1;

// Put data records from mysql by while loop.
while($row=mysql_fetch_array($result)){
$date=str_replace('-','/',$row['approval_date_time']); 


	$micr_ac_no=$row['micr'];
	$ac_no=$row['account_no'];	
	$ac_no=$row['collecting_branch_code'].$row['ac_no_suffix'].$row['ac_no_cus_no'];
	
$routing_no=$row['routing_no'];

if(trim($row['ac_type'])=='Imperial')
	$trn_code=10;

	

xlsWriteLabel($xlsRow,0,$ac_no);
xlsWriteLabel($xlsRow,1,$row['start_no']);
xlsWriteLabel($xlsRow,2,$row['total_leaf']*$row['books']);
xlsWriteLabel($xlsRow,3,$row['end_no']);
xlsWriteLabel($xlsRow,4,$micr_ac_no);
xlsWriteLabel($xlsRow,5,$routing_no);
xlsWriteLabel($xlsRow,6,$trn_code);
xlsWriteLabel($xlsRow,7,stripslashes($row['cus_name']));
xlsWriteLabel($xlsRow,8,$row['collecting_branch_code']);
xlsWriteLabel($xlsRow,9,$row['books'].'X'.$row['total_leaf'].'-'.$row['ac_type'].'-'.$row['collecting_branch']);

$xlsRow++;
} 
xlsEOF();
exit();

?>

