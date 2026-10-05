<?
session_cache_limiter('nocache');
session_start();
include_once ("../config.php");
if (empty($_SESSION['username'])&&($_REQUEST['option_mg']!='chk_approval_manager'))
{	
	include_once ('../tex_common.php');
	redirectUrl('user_signin.php');
	exit;
}
if (empty($_SESSION['username'])&&($_REQUEST['option_mg']=='chk_approval_manager'))
{	
	include_once ('../tex_common.php');
	redirectUrl('manager_signin.php');
	exit;
}
include ("pagging_admin.php");
// set timeout period in seconds
$inactive = 3600;

// check to see if $_SESSION['timeout'] is set
if(isset($_SESSION['timeout']) ) {
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive)
        { session_destroy(); header("Location: user_signin.php?msg=signin"); exit; }
}
$_SESSION['timeout'] = time();
?>


<?php
$uiPortal = 'bank';
require_once __DIR__.'/../ui/shell.php';
ui_header($uiPortal);
$task=$_REQUEST['task'];
					 $option=$_REQUEST['option'];
					 
					 if($task=='aboutus')
					 {
						include "main_body/aboutus_body.php";
					 }	
					 
					 else if($option=='aibl_user')
					 { 						
		       				include "body_content/midland_user.php";		    			
					 }
					 
					 else if($option=='change_password')
					 { 						
		       			include "body_content/change_password.php";		    			
					 }
					 else if($option=='manage_branch')
					 { 						
		       			include "body_content/manage_branch.php";		    			
					 }
				
	//---------- START CHEQUE REQUEST FORM OPTION --------------------------------------
					 elseif($option=='chk_request')
					 {
						include "body_content/chk_request.php";
					 }	
					 
					 elseif($task=='chk_request_confirm')
					 {
						include "body_content/chk_request.php";
					 }						
					elseif($option=='chk_approval_manager')
					 {
						include "body_content/chk_approval_manager.php";
					 }	
					 elseif($option=='others_approval_manager')
					 {
						include "body_content/others_approval_manager.php";
					 }	
					 
					  elseif($option=='others_request')
					 {
						include "body_content/others_request.php";
					 }	
					  elseif($task=='others_request_confirm')
					 {
						include "body_content/others_request.php";
					 }	
	//---------- END CHEQUE REQUEST FORM OPTION --------------------------------------
					 
	//---------- START USER CHEQUE REQUEST MANAGE OPTION --------------------------------------
					 elseif($option=='manage_chk_request')
					 {
						include "body_content/manage_chk_request.php";
					 }						 
					  elseif($task=='update_chq_request')
					 {
						include "body_content/manage_chk_request.php";
					 }
					 elseif($option=='chk_request_details1')
					 {
						include "body_content/chk_request_details.php";
					 }						 
					  elseif($task=='update_request')
					 {
						include "body_content/chk_request_details.php";
					 }
					 elseif($option=='manage_others_request')
					 {
						include "body_content/manage_others_request.php";
					 }
					 elseif($task=='update_others_request')
					 {
						include "body_content/manage_others_request.php";
					 }
						
					 elseif($option=='chk_ack')
					 {
						include "body_content/chk_ack.php";
					 }	
					 elseif($option=='others_ack')
					 {
						include "body_content/others_ack.php";
					 }
	//---------- END USER CHEQUE REQUEST MANAGE OPTION -------------------------------------- 		
	
	//---------- START ADMIN CHEQUE REQUEST MANAGE OPTION --------------------------------------			 
					
					 elseif($option=='manage_chk_request_admin')
					 {					 	
							include "body_content/manage_chk_request_admin.php";					 	
					 }
					 
					
	//---------- END ADMIN CHEQUE REQUEST MANAGE OPTION --------------------------------------
	
	//---------- START VENDOR CHEQUE REQUEST MANAGE OPTION --------------------------------------
					  elseif($option=='manage_chk_request_vendor')
					 {
						include "body_content/manage_chk_request_vendor.php";
					 }						 
					 
					
	//---------- END VENDOR CHEQUE REQUEST MANAGE OPTION --------------------------------------
					 
					 elseif($option=='total_request')
					 
					 {
						include "body_content/total_request.php";
					 }	
					 					 
					 elseif($option=='others_total_request')
					 {
						include "body_content/others_total_request.php";
					 }	
					 
					 elseif($option=='search_criteria')
					 {
						include "body_content/search.php";
					 }
					 elseif($option=='others_search_criteria')
					 {
						include "body_content/others_search.php";
					 }
					 
					 elseif($option=='user_search_criteria')
					 {
						include "body_content/user_search.php";
					 }
					 elseif($option=='others_user_search_criteria')
					 {
						include "body_content/others_user_search.php";
					 }
					 
					 elseif($option=='manager_search_criteria')
					 {
						include "body_content/manager_search.php";
					 }
					 elseif($option=='others_manager_search_criteria')
					 {
						include "body_content/others_manager_search.php";						
					 }
					 
					 elseif($option=='aibl_start')
					 {
						include __DIR__."/../ui/dashboard.php";
					 }	
					  elseif($option=='test_chk_request')
					 {
						include "body_content/test_chk_request.php";
					 }	
					 else
						include __DIR__."/../ui/dashboard.php";
						
					if($option!='aibl_start')
					 {
						echo "<div style='float:right; width:80px;'><input type='button' name='close' value='Close' onClick='javascript:document.location.href=\"index.php?option=aibl_start\"'></div><br>";
					 }
					
ui_footer();
?>