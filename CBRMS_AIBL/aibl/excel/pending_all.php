<?php
// Connect database. 
include_once ("../../config.php");

/// Get data records from table. 

$result=mysql_query("select * from aibl_chq_rqst where rqst_status='pending'");

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
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=orderlist.xls "); 
header("Content-Transfer-Encoding: binary ");

xlsBOF();

/*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/

xlsWriteLabel(0,0,"Requested Cheque Book Information.");

// Make column labels. (at line 3)
xlsWriteLabel(2,0,"Requester Branch");
xlsWriteLabel(2,1,"Order Date and Time");
xlsWriteLabel(2,2,"Account No");
xlsWriteLabel(2,3,"Account Name");
xlsWriteLabel(2,4,"Account Type");
xlsWriteLabel(2,5,"Leaves");
xlsWriteLabel(2,6,"Books");
xlsWriteLabel(2,7,"Address");
xlsWriteLabel(2,8,"Delivery Type");
xlsWriteLabel(2,9,"Status of Request");
xlsWriteLabel(2,10,"Collecting Branch");


$xlsRow = 3;

// Put data records from mysql by while loop.
while($row=mysql_fetch_array($result)){
$date=str_replace('-','/',$row['order_date_time']); 

xlsWriteLabel($xlsRow,0,$row['collecting_branch']);
xlsWriteLabel($xlsRow,1,date('M d, Y h:i', strtotime($date)));
xlsWriteLabel($xlsRow,2,$row['ac_no_branch'].$row['ac_no_suffix'].$row['ac_no_cus_no']);
xlsWriteLabel($xlsRow,3,$row['cus_name']);
xlsWriteLabel($xlsRow,4,$row['ac_type']);
xlsWriteNumber($xlsRow,5,$row['total_leaf']);
xlsWriteNumber($xlsRow,6,$row['books']);
xlsWriteLabel($xlsRow,7,$row['cus_address']);
xlsWriteLabel($xlsRow,8,$row['severity']);
xlsWriteLabel($xlsRow,9,$row['rqst_status']);
xlsWriteLabel($xlsRow,10,$row['collecting_branch']);



$xlsRow++;
} 
xlsEOF();
exit();

?>

