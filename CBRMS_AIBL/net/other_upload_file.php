<?php
include_once ("../tex_common.php");

if (empty($_SESSION['user_name']))
{	
	redirectUrl('net_signin.php?msg=signin');
}

$task=$_REQUEST['task'];
$option=$_REQUEST['option'];

if($_REQUEST['option']=='other_upload_file')
 { 
 ?>
				  
				  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Upload Others Item Excel File</B>
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
 
			$others_approval_date_time=date("Y-m-d H:i:s");

			$others_req_date=date("Y-m-d");
			$others_order_date_time=date("Y-m-d H:i:s");

// iterate over spreadsheet rows and columns
// convert into INSERT query

$query="select file_name from aibl_others_rqst where file_name='$file_name'";
$result=$pdo->prepare($query);
$result->execute();
 
$numrows=$result->rowCount();

$check=true;

if($numrows>0) {
	echo" <script>alert('Sorry that File ($file_name) already exists!')</script> ";
  	$check=false;
  	
	?>
	<script language="javascript">
		document.location.href="index.php?option=other_upload_file";
	</script>
   <?
   exit;
} 
			
 	
	$copy = copy($_FILES['filename']['tmp_name'],"aibl others data/".$file_name);
	$sql = "insert into aibl_others_rqst(others_account_no,others_start_no,others_total_leaf,others_end_no,others_micr,others_routing_no,others_tran_code,others_cus_name,others_collecting_branch_code,item_type,others_collecting_branch,others_severity,others_rqst_status,others_rqst_by,others_approve_by,others_approval_date_time,file_name,stock_code,others_rqst_date,others_books,others_ac_no_branch,others_ac_no_cus_no,others_ac_no_suffix,others_order_date_time) values(?, ?, '100', ?, ?, ?, ?, ?, ?, ?, ?, 'Normal', 'Ordered', 'aibl', 'aibl', '$others_approval_date_time', '$file_name', ?, '$others_req_date', ?, ?, ?, ?, '$others_order_date_time')";
												
									
	  if ($stmt = $pdo->prepare($sql)) {
  		$x=5;
  		while($x<=$excel->sheets[0]['numRows']) {
				
		$stmt->bindValue(1, trim($excel->sheets[0]['cells'][$x][2])); //Account Number
		$stmt->bindValue(2, trim($excel->sheets[0]['cells'][$x][3])); //start No
		//$stmt->bindValue(2, trim($excel->sheets[0]['cells'][$x][4]/100)); //No of Books
		$stmt->bindValue(3, trim($excel->sheets[0]['cells'][$x][4]));    //No of Leaf
		$stmt->bindValue(4, trim($excel->sheets[0]['cells'][$x][5])); //end No
		$stmt->bindValue(5, trim($excel->sheets[0]['cells'][$x][6])); //micr ac
		$stmt->bindValue(6, trim($excel->sheets[0]['cells'][$x][7])); //Books
		$stmt->bindValue(7, trim($excel->sheets[0]['cells'][$x][8])); //Routing Number
		$stmt->bindValue(8, trim($excel->sheets[0]['cells'][$x][9])); //Transaction Code		
		$stmt->bindValue(9, trim($excel->sheets[0]['cells'][$x][10])); //Type
		$stmt->bindValue(10, trim($excel->sheets[0]['cells'][$x][11])); //Branch Name
		$stmt->bindValue(11, trim($excel->sheets[0]['cells'][$x][12])); //Print Status
		$stmt->bindValue(12, trim($excel->sheets[0]['cells'][$x][13])); //Print Status
		//$stmt->bindValue(13, trim($excel->sheets[0]['cells'][$x][10])); //Books
		//$stmt->bindValue(13, substr($excel->sheets[0]['cells'][$x][2], 5, 8));
		//$stmt->bindValue(14, substr($excel->sheets[0]['cells'][$x][2], 2, 3)); //Print Status
		//$stmt->bindValue(12, trim($excel->sheets[0]['cells'][$x][10]));	//Branch code
		//$stmt->bindValue(10, trim($excel->sheets[0]['cells'][$x][10]));	//Branch code
		//$stmt->bindValue(11, substr($excel->sheets[0]['cells'][$x][2], 5, 8)); // customer no
		//$stmt->bindValue(12, substr($excel->sheets[0]['cells'][$x][2], 2, 3)); // suffix no
		
		//echo substr($excel->sheets[0]['cells'][$x][2], 0, 4);

    		if (!$stmt->execute()) {
      		echo "ERROR: Could not execute query: $sql. " . print_r($pdo->errorInfo());
    		}  			
    	$x++;
  		}		
		echo '<center><b>'.$file_name.' Successfully Uploaded '.($x-5).' Requisition </b></center><br>';
		flush();
		sleep(2);
	
		redirectUrl("index.php?option=other_upload_file");
			
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
