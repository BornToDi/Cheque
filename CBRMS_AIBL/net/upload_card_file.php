<?php
include_once ("../tex_common.php");

if (empty($_SESSION['user_name']))
{	
	redirectUrl('net_signin.php?msg=signin');
}

$task=$_REQUEST['task'];
$option=$_REQUEST['option'];

if($_REQUEST['option']=='upload_card_file')
 { 
 ?>
				  
				  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Upload CARD Excel File</B>
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
 
$approved_date_time=date("Y-m-d H:i:s");

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
		document.location.href="index.php?option=upload_card_file";
	</script>
   <?
   exit;
} 
			
 	
	$copy = copy($_FILES['filename']['tmp_name'],"aibl card data/".$file_name);
	
	$sql = "INSERT INTO aibl_chq_rqst (rqst_by,approve_by,approval_date_time,filename,account_no,total_leaf,routing_no,tran_code,cus_name,ac_type,collecting_branch,severity,rqst_status,collecting_branch_code,ac_no_branch,ac_no_cus_no,ac_no_suffix,books) 
			VALUES ('aibl', 'NETWORLD', '$approved_date_time', '$file_name', ?, ?, '245272680', '10', ?, 'Imperial', 'Imperial Division', ?, 'pending', '9001', '9001', ?, ?, '1')";									
			//VALUES ('aibl', 'NETWORLD', '$approved_date_time', '$file_name', ?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?, ?, ?, ?, '1')";									
			
	//$sql = "INSERT INTO aibl_chq_rqst (rqst_by,approve_by,approval_date_time,filename,account_no,total_leaf,routing_no,tran_code,cus_name,ac_type,collecting_branch,severity,rqst_status,collecting_branch_code,ac_no_branch,ac_no_cus_no,ac_no_suffix,books) 
			//VALUES ('aibl', 'NETWORLD', '$approved_date_time', '$file_name', ?, ?, '245272680', '10', ?, 'Imperial', 'Imperial Division', ?, 'pending', '9001', '9001', ?, ?, '1')";									
									
	  if ($stmt = $pdo->prepare($sql)) {
  		$x=5;
  		while($x<=$excel->sheets[0]['numRows']) {
				
		$stmt->bindValue(1, trim($excel->sheets[0]['cells'][$x][2]));
		$stmt->bindValue(2, trim($excel->sheets[0]['cells'][$x][4]));
		//$stmt->bindValue(3, trim($excel->sheets[0]['cells'][$x][7]));
		//$stmt->bindValue(4, trim($excel->sheets[0]['cells'][$x][8]));
		$stmt->bindValue(3, trim($excel->sheets[0]['cells'][$x][9]));
		//$stmt->bindValue(6, trim($excel->sheets[0]['cells'][$x][11]));
		//$stmt->bindValue(7, trim($excel->sheets[0]['cells'][$x][12]));
		$stmt->bindValue(4, trim($excel->sheets[0]['cells'][$x][13]));
		//$stmt->bindValue(9, trim($excel->sheets[0]['cells'][$x][10]));	
		//$stmt->bindValue(10, trim($excel->sheets[0]['cells'][$x][10]));	
		$stmt->bindValue(5, substr($excel->sheets[0]['cells'][$x][2], 5, 8));
		$stmt->bindValue(6, substr($excel->sheets[0]['cells'][$x][2], 2, 3));
		
		//echo substr($excel->sheets[0]['cells'][$x][2], 0, 4);

    		if (!$stmt->execute()) {
      		echo "ERROR: Could not execute query: $sql. " . print_r($pdo->errorInfo());
    		}  			
    	$x++;
  		}		
		echo '<center><b>'.$file_name.' Successfully Uploaded '.($x-5).' Requisition </b></center><br>';
		//echo '<img src=../aibl/images/pic_processing_355x20.gif border=0/>';
		flush();
		sleep(2);
	
		redirectUrl("index.php?option=upload_card_file");
			
	} 
   
	else {
  		echo "ERROR: Could not prepare query: $sql. " . print_r($pdo->errorInfo());
	}
  

// close connection
unset($pdo);

}

?>


<?php include __DIR__.'/../ui/import-form.php'; ?>
	
</TABLE>
<?

}
?>