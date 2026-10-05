<?php
// Connect database. 
include_once ("../../config.php");

/// Get data records from table. 
$id=$_REQUEST['id'];	
$len=count($id);
//$result=mysql_query("select * from aibl_others_rqst where others_rqst_status='ordered'");
//$result=mysql_query("select * from aibl_others_rqst where others_rqst_status='ordered' order by others_collecting_branch desc, item_type desc, others_total_leaf asc, others_approval_date_time desc");


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

xlsWriteLabel(0,0,"Requested Security Items Information.");

// Make column labels. (at line 3)

xlsWriteLabel(2,0,"Account No");
xlsWriteLabel(2,1,"Start No");
xlsWriteLabel(2,2,"Leaves");
xlsWriteLabel(2,3,"End No");
xlsWriteLabel(2,4,"Item Type");
xlsWriteLabel(2,5,"Books");
xlsWriteLabel(2,6,"Approved Date and Time");
xlsWriteLabel(2,7,"Requester Branch");
xlsWriteLabel(2,8,"Delivery Type");
xlsWriteLabel(2,9,"Status of Request");

$xlsRow = 3;

for($i=0;$i<$len;$i++){
$result=mysql_query("select * from aibl_others_rqst where others_rqst_id='$id[$i]' order by others_collecting_branch desc, item_type desc, others_total_leaf asc, others_approval_date_time desc");
// Put data records from mysql by while loop.
while($row=mysql_fetch_array($result)){

$date=str_replace('-','/',$row['others_approval_date_time']); 
$ac_no="0000000000000";

xlsWriteLabel($xlsRow,0,$ac_no);
xlsWriteLabel($xlsRow,1,$row['others_start_no']);
xlsWriteNumber($xlsRow,2,$row['others_total_leaf']);
xlsWriteLabel($xlsRow,3,$row['others_end_no']);
xlsWriteLabel($xlsRow,4,$row['item_type']);
xlsWriteLabel($xlsRow,5,$row['others_books']);
xlsWriteLabel($xlsRow,6,date('M d, Y h:i', strtotime($date)));
xlsWriteLabel($xlsRow,7,$row['others_collecting_branch']);
xlsWriteLabel($xlsRow,8,$row['others_severity']);
xlsWriteLabel($xlsRow,9,$row['others_rqst_status']);

$xlsRow++;
} 
}
xlsEOF();
exit();

?>

