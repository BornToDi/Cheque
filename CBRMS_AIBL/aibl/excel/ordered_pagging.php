<?
include ("../pagging/ordered_pagging_excel.php");

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
//echo pack("ssssss", 0x204, 8 + $d, $Row, $Col, 0x0, $d); 
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

xlsWriteLabel(2,0,"Account No");
xlsWriteLabel(2,1,"Start No");
xlsWriteLabel(2,2,"Leaves");
xlsWriteLabel(2,3,"End No");
xlsWriteLabel(2,4,"Account Name");
xlsWriteLabel(2,5,"Address");
xlsWriteLabel(2,6,"Account Type");
xlsWriteLabel(2,7,"Approved Date and Time");
xlsWriteLabel(2,8,"Requester Branch");
xlsWriteLabel(2,9,"Collecting Branch");
xlsWriteLabel(2,10,"Delivery Type");
xlsWriteLabel(2,11,"Status of Request");

$xlsRow = 3;
$result = select_entries_ordered_excel($offset);
// Put data records from mysql by while loop.
while($row=mysql_fetch_array($result)){
$date=str_replace('-','/',$row['approval_date_time']); 

xlsWriteLabel($xlsRow,0,$row['ac_no_branch'].$row['ac_no_suffix'].$row['ac_no_cus_no']);
xlsWriteNumber($xlsRow,1,$row['start_no']);
xlsWriteNumber($xlsRow,2,$row['total_leaf']);
xlsWriteNumber($xlsRow,3,$row['end_no']);
xlsWriteLabel($xlsRow,4,$row['cus_name']);
xlsWriteLabel($xlsRow,5,$row['cus_address']);
xlsWriteLabel($xlsRow,6,$row['ac_type']);
xlsWriteLabel($xlsRow,7,date('M d, Y h:i a', strtotime($date)));
xlsWriteLabel($xlsRow,8,$row['collecting_branch']);
xlsWriteLabel($xlsRow,9,$row['collecting_branch']);
xlsWriteLabel($xlsRow,10,$row['severity']);
xlsWriteLabel($xlsRow,11,$row['rqst_status']);




$xlsRow++;
} 
xlsEOF();
exit();
?>
