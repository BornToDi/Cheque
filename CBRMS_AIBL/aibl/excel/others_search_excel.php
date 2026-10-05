<?php
// Connect database. 
include_once ("../../config.php");

/// Get data records from table. 



//$result=mysql_query("select * from aibl_chq_rqst");

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
xlsWriteLabel(2,1,"Approved Date");
xlsWriteLabel(2,2,"Item Type");
xlsWriteLabel(2,3,"Books");
xlsWriteLabel(2,4,"Leaves");
xlsWriteLabel(2,5,"Delivery Type");
xlsWriteLabel(2,6,"Status of Request");


$xlsRow = 3;

// Put data records from mysql by while loop.
//while($row=mysql_fetch_array($result)){

$id=$_REQUEST['id'];	
$len=count($id);								
for($i=0;$i<$len;$i++){
$query ="select *from aibl_others_rqst where others_rqst_id='$id[$i]'";  	
$result=mysql_query($query);																		
$row=mysql_fetch_array($result);
 
if(($row['others_approval_date_time'])!=0){
	$date=str_replace('-','/',$row['others_approval_date_time']); 
	$date=date('M d, Y h:i a', strtotime($date));								
}
else 
	$date= "Not yet approved";

xlsWriteLabel($xlsRow,0,$row['others_collecting_branch']);
xlsWriteLabel($xlsRow,1,$date);
xlsWriteLabel($xlsRow,2,$row['item_type']);
xlsWriteLabel($xlsRow,3,$row['others_books']);
xlsWriteNumber($xlsRow,4,$row['others_total_leaf']);
xlsWriteLabel($xlsRow,5,$row['others_severity']);
xlsWriteLabel($xlsRow,6,$row['others_rqst_status']);

$xlsRow++;
} 
xlsEOF();
exit();

?>

