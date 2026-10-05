<?php 
//include_once ('../config.php');

	
//$myServer="networld";
//$myServer="172.20.10.86\MSSQLSERVER2005";
$myServer="NS2";
$myUser = "sa";
$myPass = "1234567";
$myDB = "aibl_cbrms";

//connection to the database
$dbhandle = mssql_connect($myServer, $myUser, $myPass)
or die("Couldn't connect to SQL Server on $myServer - error.");

//select a database to work with
$selected = mssql_select_db($myDB, $dbhandle)
or die("Couldn't open database $myDB");
	  
	 // echo "You are connected to the ". $myDB . " database on the " . $myServer . ".";

	

	
	$req_branch=substr($_GET['q'], 0, 4); 	
	
	/*$query  ="select *from aibl_chq_rqst where collecting_branch_code ='$req_branch'";
	$get_result = mssql_query($query) or
    die('Server Connection Error!');
	$get_req_branch =mssql_fetch_assoc($get_result);
	*/
	//$cus_no=substr($_GET['q'], 7, 8); 	
	/*
	$cus_no_query  ="select *from aibl_chq_rqst where ac_no_cus_no ='$cus_no'";
	$cus_no_result = mssql_query($cus_no_query) or
    die('Server Connection Error!');
	$get_cus_no=mssql_fetch_assoc($cus_no_result);
	*/
		
	/*$ac_query  ="select aibl_chq_rqst from BranchAccount where Account ='$_GET[q]'";
	$ac_result = mssql_query($ac_query) or
    die('Server Connection Error!');		
	*/

$account_number=$_GET['q'];
//$stmt = mssql_init("GetAccountInfo", $dbhandle);
//mssql_bind($stmt, "@AccountNumber", $AccountNumber, SQLVARCHAR);

$execrtn = mssql_query("set ansi_nulls ON") ;//or die(mssql_get_last_message());
$execrtn = mssql_query("set ansi_warnings ON") ;//or die(mssql_get_last_message()); 
//$execrtn = mssql_query("EXEC kpi_UploadData") or die(mssql_get_last_message()); 

$stmt = mssql_init("display_information", $dbhandle);
mssql_bind($stmt, "@account_number", $account_number, SQLVARCHAR);



//mssql_bind($stmt, "@BranchCode", $req_branch, SQLCHAR);
/* now execute the procedure */
$cus_info_result = mssql_execute($stmt);
/* get the row that is returned */
$get_cus_info = mssql_fetch_assoc($cus_info_result);
/* get my value out */
//$my_name = $row['FirstName'];
?>

	<?
	if((mssql_num_rows($cus_info_result)!=0))
	{	
		if($get_cus_info['account_status']=='A')
		{
		
	?>		
		<input type="text" name="cus_name" size="31" value="<?php echo $get_cus_info['First_name']." ".$get_cus_info['middle_name']." ".$get_cus_info['Last_Name']; ?>" readonly="yes" />			
	<? 
		}
		
		else if($get_cus_info['account_status']=='C'){
		echo "<font color=#FF0000><b> THIS CUSTOMER'S ($get_cus_info[ac_name]) ACCOUNT IS CLOSED </b></font><br />"; ?>
		<input type='text' name='cus_name' size='31' readonly="yes"/>	
		<? }	
		else if($get_cus_info['account_status']=='S'){
		echo "<font color=#FF0000><b> THIS CUSTOMER'S ($get_cus_info[ac_name]) ACCOUNT IS SUSPENDED </b></font><br />"; ?>
		<input type='text' name='cus_name' size='31' readonly="yes"/>	
		<? }		
	}
	else{
		echo "<font color=#FF0000><b>THIS ACCOUNT NUMBER CAN NOT BE FOUND</b></font><br />";?>				
		<input type="text" name="cus_name" size="31" readonly="yes"/>	
	<? } ?>
