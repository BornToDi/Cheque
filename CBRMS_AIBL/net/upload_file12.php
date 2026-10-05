<?php
include_once ("../tex_common.php");

if (empty($_SESSION['user_name']))
{	
	redirectUrl('net_signin.php?msg=signin');
}

$task=$_REQUEST['task'];
$option=$_REQUEST['option'];

if($_REQUEST['option']=='upload_file')
 { 
 ?>
				  
				  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Upload CHEQUE Excel File</B>
							</TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
 				</TABLE><BR>
<?
require_once __DIR__ . '/../excel_reader2.php';
// attempt a connection
try {
   $pdo = cbrms_pdo();
} catch (PDOException $e) {
   die("ERROR: Could not connect: " . $e->getMessage());
}


if(isset($_POST['submit']))

{

$file_name=$_FILES['filename']['name']; 
$filename=$_FILES['filename']['tmp_name']; 
//$handle = fopen("$filename", "r");
// initialize reader object
$excel = new Spreadsheet_Excel_Reader();

// read spreadsheet data
$excel->read($filename);
 
			$approval_date_time=date("Y-m-d H:i:s");

			$req_date=date("Y-m-d");
			$order_date_time=date("Y-m-d H:i:s");

// iterate over spreadsheet rows and columns
// convert into INSERT query

$query="select file_name from aibl_chq_rqst where file_name='$file_name'";
$result=$pdo->prepare($query);
$result->execute();
 
$numrows=$result->rowCount();

$check=true;

if($numrows>0) {
	echo" <script>alert('Sorry that File ($file_name) already exists!')</script> ";
  	$check=false;
  	
	?>
	<script language="javascript">
		document.location.href="index.php?option=upload_file";
	</script>
   <?
   exit;
} 
			
 	
	$copy = copy($_FILES['filename']['tmp_name'],"aibl data/".$file_name);
	$sql = "INSERT INTO aibl_chq_rqst (account_no,start_no,total_leaf,end_no,micr,routing_no,tran_code,cus_name,collecting_branch_code,ac_type,rqst_branch,severity,rqst_status,rqst_by,approve_by,approval_date_time,file_name,collecting_branch_code,collecting_branch,rqst_date,books,ac_no_branch,ac_no_cus_no,ac_no_suffix,order_date_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Normal', 'Pending', 'aibl', 'aibl', '$approval_date_time', '$file_name', ?, ?, '$req_date', '1', ?, ?, ?, '$order_date_time')";									
									
	  if ($stmt = $pdo->prepare($sql)) {
  		$x=5;
  		while($x<=$excel->sheets[0]['numRows']) {
				
		$stmt->bindValue(1, trim($excel->sheets[0]['cells'][$x][2]));
		$stmt->bindValue(2, trim($excel->sheets[0]['cells'][$x][3]));
		$stmt->bindValue(3, trim($excel->sheets[0]['cells'][$x][4]));
		$stmt->bindValue(4, trim($excel->sheets[0]['cells'][$x][5]));
		$stmt->bindValue(5, trim($excel->sheets[0]['cells'][$x][6]));
		$stmt->bindValue(6, trim($excel->sheets[0]['cells'][$x][7]));
		$stmt->bindValue(7, trim($excel->sheets[0]['cells'][$x][8]));
		$stmt->bindValue(8, trim($excel->sheets[0]['cells'][$x][9]));
		$stmt->bindValue(9, trim($excel->sheets[0]['cells'][$x][10]));
		$stmt->bindValue(10, trim($excel->sheets[0]['cells'][$x][11]));
		$stmt->bindValue(11, trim($excel->sheets[0]['cells'][$x][12]));
		$stmt->bindValue(12, trim($excel->sheets[0]['cells'][$x][13]));	
		//$stmt->bindValue(13, trim($excel->sheets[0]['cells'][$x][14]));	
		$stmt->bindValue(13, trim($excel->sheets[0]['cells'][$x][14]));
		$stmt->bindValue(14, trim($excel->sheets[0]['cells'][$x][15]));
		//$stmt->bindValue(14, substr($excel->sheets[0]['cells'][$x][2], 0, 13));
		//$stmt->bindValue(14, trim($excel->sheets[0]['cells'][$x][15]));
		//$stmt->bindValue(14, substr($excel->sheets[0]['cells'][$x][2], 3, 4));	
		$stmt->bindValue(15, substr($excel->sheets[0]['cells'][$x][2], 7, 7));
		$stmt->bindValue(16, substr($excel->sheets[0]['cells'][$x][2], 4, 3));
		
		
		//echo substr($excel->sheets[0]['cells'][$x][2], 0, 4);

    		if (!$stmt->execute()) {
      		echo "ERROR: Could not execute query: $sql. " . print_r($pdo->errorInfo());
    		}  			
    	$x++;
  		}		
		echo '<center><b>'.$file_name.' Successfully Uploaded '.($x-5).' Requisition </b></center><br>';
		flush();
		sleep(2);
	
		redirectUrl("index.php?option=upload_file");
			
	} 
   
	else {
  		echo "ERROR: Could not prepare query: $sql. " . print_r($pdo->errorInfo());
	}
  

// close connection
unset($pdo);

}

?>


<table width="50%" border="1" cellspacing="0" cellpadding="3" align="center" vspace="50">
  <form action="index.php?option=upload_file" method="post" enctype="multipart/form-data">
  <tr> 
    <td colspan="2"><div align="center"><strong><font size="+2" face="Verdana, Arial, Helvetica, sans-serif">Upload Cheque
       Excel File</font></strong></div></td>
  </tr>
  <tr> 
    <td width="22%" align="right">File</td>
    <td width="78%"><input type="file" name="filename" size="40"></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value=" Submit "></td>
  </tr>
  </form>
</table>
	
</TABLE>
<?

}
?>