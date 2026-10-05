<?php
// Connect database. 
include_once ("../../config.php");

/// Get data records from table. 
//$result=mysql_query("select *from aibl_chq_rqst where rqst_status='ordered' and ac_type='$_REQUEST[ac_type]' order by collecting_branch asc, ac_type desc, start_no asc, total_leaf asc, approval_date_time desc");
$result=mysql_query("select *from aibl_others_rqst where others_rqst_status='ordered' order by others_collecting_branch asc, item_type desc, others_start_no asc, others_total_leaf asc, others_approval_date_time desc");
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
xlsWriteLabel(2,4,"MICR Account");
xlsWriteLabel(2,5,"Routing No.");
xlsWriteLabel(2,6,"Transaction Code");
xlsWriteLabel(2,7,"Item Type");
xlsWriteLabel(2,8,"Books");
xlsWriteLabel(2,9,"Approved Date and Time");
xlsWriteLabel(2,10,"Requester Branch");
xlsWriteLabel(2,11,"Delivery Type");
xlsWriteLabel(2,12,"Status");

$xlsRow = 3;

// Put data records from mysql by while loop.
while($row=mysql_fetch_array($result)){
$date=str_replace('-','/',$row['others_approval_date_time']); 

/*if($row['item_type']=='PO'){
	$ac_no="0000000000000";
	$trn_code=19;
}
elseif($row['item_type']=='LD'){
	$ac_no="1111111111111";
	$trn_code=15;
}*/	
    //$micr_ac_no="00".$row['ac_no_suffix'].$row['ac_no_cus_no'];
	//$ac_no="00".$row['ac_no_suffix'].$row['ac_no_cus_no'];
	
$ac_no="0000".$row['others_account_no'];
$trn_code=$row['others_tran_code'];	
$routing_no=$row['others_routing_no'];


xlsWriteLabel($xlsRow,0,$ac_no);
xlsWriteLabel($xlsRow,1,$row['others_start_no']);
xlsWriteNumber($xlsRow,2,$row['others_total_leaf']*$row['others_books']);
xlsWriteLabel($xlsRow,3,$row['others_end_no']);
xlsWriteLabel($xlsRow,4,$ac_no);
xlsWriteLabel($xlsRow,5,$routing_no);
xlsWriteLabel($xlsRow,6,$trn_code);
xlsWriteLabel($xlsRow,7,$row['item_type']);
xlsWriteLabel($xlsRow,8,$row['others_books']);
xlsWriteLabel($xlsRow,9,date('M d, Y h:i a', strtotime($date)));
xlsWriteLabel($xlsRow,10,$row['others_collecting_branch']);
xlsWriteLabel($xlsRow,11,$row['others_severity']);
xlsWriteLabel($xlsRow,12,$row['others_rqst_status']);

$xlsRow++;
} 
xlsEOF();
exit();

?>

