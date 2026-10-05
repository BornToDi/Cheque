<?php

// Connect database. 
//include('connect.php');
include_once ("../../config.php");
/*$db = mysql_connect("localhost", "root", "netcbrms") or die("Could not connect.");

if(!$db) 

	die("no db");

if(!mysql_select_db("cbrms",$db))

 	die("No database selected.");*/
/// Get data records from table. 

//$result=mysql_query("select * from abbl_chq_rqst where rqst_status='ordered'");
//$result=mysql_query("select * from abbl_chq_rqst where rqst_status='ordered' order by collecting_branch desc, ac_type desc, total_leaf asc, approval_date_time desc");

$result=mysql_query("select * from aibl_chq_rqst where rqst_status='ordered' and ac_type!='Imperial' order by collecting_branch asc, start_no asc, total_leaf asc, approval_date_time desc");
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
$filename=date('d-m-y').'-aibl_PSI';
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=$filename.xls "); 
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
xlsWriteLabel(2,5,"Account Type");
xlsWriteLabel(2,6,"Branch");
xlsWriteLabel(2,7,"Approved Date and Time");
xlsWriteLabel(2,8,"Books");
xlsWriteLabel(2,9,"Delivery Type");
xlsWriteLabel(2,10,"Status of Request");
xlsWriteLabel(2,11,"Collecting Branch");
xlsWriteLabel(2,12,"Address");
$xlsRow = 3;

// Put data records from mysql by while loop.
while($row=mysql_fetch_array($result)){
$date=str_replace('-','/',$row['approval_date_time']); 

	
	$ac_no=$row['account_no'];
	//$ac_no=$row['ac_no_branch']."-".$row['ac_no_suffix'].$row['ac_no_cus_no'];


	$t=$row['start_no'];
	$a[0]=$t;							
	//$b[0]=$t+($row['total_leaf']-1);	
						
	for ($j=1; $j<$row['books']; $j++){
		$a[$j]=$a[$j-1]+$row['total_leaf'];							
	}								
	for ($j=0; $j<$row['books']; $j++){								
		$b[$j]=$a[$j]+($row['total_leaf']-1);
	}	

for ($i=0; $i<$row['books']; $i++){
xlsWriteLabel($xlsRow+$i,0,$ac_no);
xlsWriteLabel($xlsRow+$i,1,$a[$i]);
//xlsWriteNumber($xlsRow+$i,1,$row['start_no']);
xlsWriteLabel($xlsRow+$i,2,$row['total_leaf']*$row['books']);
//xlsWriteNumber($xlsRow+$i,3,$row['end_no']);
xlsWriteLabel($xlsRow+$i,3,substr($b[$i]+10000000,1));
xlsWriteLabel($xlsRow+$i,4,$row['cus_name']);
xlsWriteLabel($xlsRow+$i,5,$row['ac_type']);
xlsWriteLabel($xlsRow+$i,6,$row['rqst_branch']." ".'('.$row['routing_no'].')');
xlsWriteLabel($xlsRow+$i,7,$row['approval_date_time']);
xlsWriteLabel($xlsRow+$i,8,$row['books']);
xlsWriteLabel($xlsRow+$i,9,$row['severity']);
xlsWriteLabel($xlsRow+$i,10,$row['rqst_status']);
xlsWriteLabel($xlsRow+$i,11,$row['collecting_branch']);
xlsWriteLabel($xlsRow+$i,12,$row['cus_address']);
}

$xlsRow=$xlsRow+$i;

} 
xlsEOF();
exit();

?>

