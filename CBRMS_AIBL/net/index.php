<?
session_cache_limiter('nocache');
session_start();
include_once ("../config.php");
if (empty($_SESSION['user_name']))
{	
	include_once ('../tex_common.php');
	redirectUrl('net_signin.php?msg=signin');
	exit;
}
//include ("pagging_admin.php");
// set timeout period in seconds
$inactive = 66000;

// check to see if $_SESSION['timeout'] is set
if(isset($_SESSION['timeout']) ) {
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive)
        { session_destroy(); header("Location: net_signin.php?msg=signin"); exit; }
}
$_SESSION['timeout'] = time();


$query3="select rqst_status from aibl_chq_rqst where rqst_status='pending'";								
$no_pending=mysql_num_rows(mysql_query($query3));
?>


<?php
$uiPortal = 'vendor';
require_once __DIR__.'/../ui/shell.php';
ui_header($uiPortal);
$task=$_REQUEST['task'];
					 $option=$_REQUEST['option'];
					 
					 if($task=='aboutus')
					 {
						include "main_body/aboutus_body.php";
					 }	
					 
					 else if($option=='net_user')
					 { 						
		       				include "net_user.php";		    			
					 }
					else if($option=='upload_file')
					 { 						
		       				include "upload_file.php";		    			
					 }
					 else if($option=='upload_card_file')
					 { 						
		       				include "upload_card_file.php";		    			
					 }
	
	                 else if($option=='other_upload_file')
					 { 						
		       				include "other_upload_file.php";		    			
					 }
	//---------- START VENDOR CHEQUE REQUEST MANAGE OPTION --------------------------------------
					  elseif($option=='manage_chk_request_vendor')
					 {
						include "manage_chk_request_vendor.php";
					 }						 
					 
					 elseif($task=='update_chq_request_vendor')
					 {
						include "manage_chk_request_vendor.php";
					 }	
					 elseif($option=='serial_no')
					 {
						include "serial_no.php";
					 }	
					 elseif($option=='psi_print')
					 {
						include "psi_print.php";
					 }
					 elseif($option=='others_psi_print')
					 {
						include "others_psi_print.php";
					 }
					 elseif($option=='manage_order')
					 {
						include "manage_order.php";
					 }
					 elseif($option=='challan_no')
					 {
						include "challan_no.php";
					 }
					 elseif($option=='others_challan_no')
					 {
						include "others_challan_no.php";
					 }
					 elseif($option=='download_bill')
					 {
						include "bill.php";
					 }
	//---------- END VENDOR CHEQUE REQUEST MANAGE OPTION --------------------------------------
					 
					 elseif($option=='total_request')
					 {
						include "net_total_request.php";
					 }	
					 elseif($option=='others_total_request')
					 {
						include "others_net_total_request.php";
					 }	
					 
					 elseif($option=='search_criteria')
					 {
						include "net_search.php";
					 }
					 elseif($option=='others_search_criteria')
					 {
						include "others_net_search.php";
					 }
					 
					 else
						include __DIR__."/../ui/dashboard.php";
					 
					
ui_footer();
?>