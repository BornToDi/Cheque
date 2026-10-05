<? 
session_cache_limiter('nocache');
session_start();
include_once ("../../config.php");
include_once ("../../tex_common.php");

if (empty($_SESSION['username'])||($_SESSION['user_type']!='manager'))
{
	redirectUrl('../manager_signin.php');
}

// set timeout period in seconds
$inactive = 3600;
// check to see if $_SESSION['timeout'] is set
if(isset($_SESSION['timeout']) ) {
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive)
        { session_destroy(); header("Location: ../manager_signin.php?msg=signin"); }
}
$_SESSION['timeout'] = time();
	
	
	$task=$_REQUEST['task'];
	$option=$_REQUEST['option'];
	?>
	<link href="<?php echo isset($uiPortal) ? 'style/style.css' : '../style/style.css'; ?>" rel="stylesheet" type="text/css"><link rel="stylesheet" href="../../ui/modern.css"><meta name="viewport" content="width=device-width, initial-scale=1"><script src="../../ui/popup.js" defer></script>
	<SCRIPT language=javascript1.2 src="<?php echo isset($uiPortal) ? 'js/common.js' : '../js/common.js'; ?>" type=text/javascript></SCRIPT>
	<?
					
			//if($_REQUEST['option']=='req_confirm')  { ?>
											  
				  
                <!-- Display User Information------------->
				  <form id ="frmChk" name="frmChk" method="post" action="../body_content/chk_request_confirm.php">
				  
				  <?
				  				
				  	if($_POST['submit_mult_update']=='Approve') { 
					
					
						ini_set("SMTP","mail.abbank.com.bd");
						ini_set("sendmail_from","ChequeRequisition@abbank.com.bd");
						$user_name=$_SESSION['branch_user_name'];
						$user_email=$_SESSION['user_email'];
						$user_branch_name=$_SESSION['branch_name'];
						$str=strtolower($_SESSION['branch_name']).x;
						//$to = "$str"."@abbank.com.bd"; //This is the email address you want to send the email to						
						//$to = "sales@networld-bd.com"; //This is the email address you want to send the email to		
						//$to = "alamc@abbank.com.bd";
						$to = "ChequeRequisition@abbank.com.bd";
						//$to  = 'sales@networld-bd.com' . ', '; // note the comma
						//$to .= 'lipon@abbank.com.bd';
						$email = "test@abbank.com.bd";
						//$email = "$user_email@abbank.com.bd";
						$subject_prefix = ""; //Use this if you want to have a prefix before the subject						
						$subject = "aibl Cheque book requisition"; //The senders subject
						$message="\t User $user_name from $user_branch_name  has been issued a Cheque book request.Please click the following link\n";					
						$message.="\t http://abdhksms2.aibl.org/cbrms_aibl/net/index.php?option=total_request&task=total_request_pending \n";
						$s=mail($to,$subject,$message,"From: ".$email.""); //a very simple send
						/*if($s){ 

							echo "
								<tr>
									<td>
										<p class='content5pad'>Thank you very much $name for sending mail. 
											</p>				
									</td>
								</tr>
							";
							}
							else
							echo "not send";
							*/
					
						 
						$approval_date_time=date("Y-m-d H:i:s a");
						$chk=$_POST['chk'];					
						$c=count($chk);						
						//$approve='approval';	
	  					//if ($approve=='approval') $get_approve='pending'; else $get_active=1;
	  					for ($i=0; $i<$c; $i++)
						{	  						
							$query ="Update aibl_chq_rqst set approve_by='$_SESSION[user_id]', approval_date_time='$approval_date_time', rqst_status='pending' where rqst_id='$chk[$i]'";							
							mysql_query($query) or
							die (mysql_error());					
						}						
						//redirectUrl("index.php?option=aibl_user&task=modify_user"); 					
					}
					/*if($_POST['submit_mult_update']=='Active'){ 
						 
						$user_modified_date=date("Y-m-d h:i:s a");
						$chk=$_POST['chk'];					
						$c=count($chk);						
						$active=0;
	  					if ($active==0) $get_active=1; else $get_active=0;
	  					for ($i=0; $i<$c; $i++)
						{	  						
							$query ="Update aibl_login set active=$get_active,user_modified_by='$_SESSION[user_id]',user_modified_date='$user_modified_date' where userid='$chk[$i]'";							
							mysql_query($query) or
							die (mysql_error());					
						}					
						//redirectUrl("index.php?option=aibl_user&task=modify_user"); 					
					}
					*/
 				?>
				 
			<DIV align=center>
				<br />
				you are logged in as <B><? echo $_SESSION['branch_user_name']."(".$_SESSION['branch_name'].")"; ?></B> 
				<A class=hf href="../mg_signout.php" style="text-decoration:underline"><font color="#FF0000"><b>LOGOUT</b></font></A>&nbsp;
			</DIV>
			
				  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info><div align="left"><B>Requested Cheque Book Information </B></div>
							</TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
 				</TABLE>
				  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0></br>
                    <TBODY>
                    <TR>
                      <TD>
					  <DIV class=syntax_manager>
                        <TABLE cellSpacing=1 cellPadding=2 width="1250" border=0>
                          <TBODY>                          
                            <TR>
                            <TD class=info align=left colSpan=11>
								<B>Total Request Information for Approval</B>											
							</TD>
						  </TR>
                          <TR>
							 
							 <TD width="5%" align="center" class="hf">
							 
								&nbsp;<B>#</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkall" onclick="checkedAll(frmChk);">						
							</TD>
							<TD  class=hf>
								<B>Requested By</B>							
							</TD>
							<TD  class=hf>
								<B>Account No</B>							
							</TD>
							<TD class=hf>
								<B>Branch Name</B>							
							</TD>
							
							<TD  class=hf>
								<B>Customer Name</B>							
							</TD>
							
							<TD  class=hf>
								<B>Requisition Date</B>							
							</TD>
							<TD  class=hf>
								<B>Account Type-Lvs</B>							
							</TD>
							<TD  class=hf>
								<B>Books</B>							
							</TD>
							<TD class=hf>
								<B>Collecting Branch</B>
							</TD>
							<TD class=hf>
								<B>Delivery Type</B>							
							</TD>
							<TD class=hf>
								<B>Order Date</B>
							</TD>
							
						  </TR>
						  <?
						  	$query_hvbbn ="select HVBBN from HVPF where HVBRNM='".$_SESSION['branch_name']."'";			
							$sql_result = mssql_query($query_hvbbn) or
			 				die('Server Connection Error!');
							$get_hvbbn = mssql_fetch_array($sql_result);							
							$branch_code=$get_hvbbn['HVBBN'];
						 
						 	if($_SESSION['branch_name']!='KIBB')
							$query="select * from aibl_chq_rqst where rqst_status='approval' and collecting_branch_code='$branch_code'";															
							else
							$query="select * from aibl_chq_rqst where rqst_status='approval' and collecting_branch_code='4027'";
						 
							//$query="select * from aibl_chq_rqst where rqst_status='approval' and collecting_branch_code='$branch_code'";								
							//$query="select * from aibl_chq_rqst where rqst_status='approval' and collecting_branch_code='4005' order by rqst_date desc";								
							$result = mysql_query($query) or
							die(mysql_error());
							
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							$sl=0;
							while ($row =mysql_fetch_assoc($result))
							{
							$req_date=str_replace('-','/',$row['rqst_date']);							
							$order_date=str_replace('-','/',$row['order_date_time']);							
							?>
								<tr>
								<td class=<? echo $class; ?> align="center" width="5%">&nbsp;<? echo $sl; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="chk[]" value="<? echo $row['rqst_id']; ?>" style=" border-style:none"></td>
								<td class=<? echo $class; ?>><? echo $row['rqst_by'];?> </a></td>
								<td class=<? echo $class; ?>><? echo $row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']; ?> </td>
								<td class=<? echo $class; ?>><? echo $row['collecting_branch']; ?> </td>																
								<td class=<? echo $class; ?>><? echo $row['cus_name']; ?> </td>								
								<td class=<? echo $class; ?>><? echo date('M d, Y', strtotime($req_date)); ?></td>									
								<td class=<? echo $class; ?>><? echo $row['ac_type']."- ".$row['total_leaf']; ?> </td>
								<td class=<? echo $class; ?>><? echo $row['books']; ?> </td>
								<td class=<? echo $class; ?>><? echo $row['collecting_branch']; ?> </td>
								<td class=<? echo $class; ?>><? echo $row['severity']; ?> </td>
								<td class=<? echo $class; ?>><? echo date('M d, Y h:i a', strtotime($order_date)); ?> </td>															
								</tr>
								<?
								$sl++;
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}
							}
						
						?>  
						  
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					  </DIV>
					  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img class="selectallarrow" width="38" height="22" src="../images/arrow_ltr.png" alt="With selected:" />
				<i>With selected User:</i>
				<!--
				<input type="image" name="submit_mult_delete" value="Delete"  title="Change" onclick="return isChk();"  src="images/b_edit.png" />
				<input type="image" name="submit_mult_update" value="Update"  title="Delete" onclick="return isChk();" src="images/b_drop.png" />
				<input type="image" name="submit_mult_export" value="Export" title="Export" src="images/b_tblexport.png" />
				-->
				<input type="submit" name="submit_mult_update" value="Approve" onclick="return isChk();" class="favorite" />
				<!--
				<input type="submit" name="submit_mult_update" value="Disapprove" onclick="return isChk();" class="favorite" />
				<input type="submit" name="submit_mult_delete" value="Delete" onclick="return isChk();" class="favorite" />												
				-->
				</form>				  				  
				<!----- End ------------------------------->  
					
				  </TD></TR></TBODY></TABLE>
				 <?				 
 			//}
		
		?>	
