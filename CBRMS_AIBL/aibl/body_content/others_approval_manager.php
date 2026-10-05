<? 
session_cache_limiter('nocache');
session_start();
include_once ("../config.php");
include_once ("../tex_common.php");

if (empty($_SESSION['username'])||($_SESSION['user_type']!='manager'))
{
	redirectUrl('manager_signin.php');
}


	$option=$_REQUEST['option'];
	?>
	<link href="<?php echo isset($uiPortal) ? 'style/style.css' : '../style/style.css'; ?>" rel="stylesheet" type="text/css"><link rel="stylesheet" href="../../ui/modern.css"><meta name="viewport" content="width=device-width, initial-scale=1"><script src="../../ui/popup.js" defer></script>
	<SCRIPT language=javascript1.2 src="<?php echo isset($uiPortal) ? 'js/common.js' : '../js/common.js'; ?>" type=text/javascript></SCRIPT>
	<?
					
			//if($_REQUEST['option']=='req_confirm')  { ?>
											  
				  
                <!-- Display User Information------------->
				  <form id ="frmChk" name="frmChk" method="post" action="index.php?option=others_approval_manager">
				  
				  <?
				  				
				  	if($_POST['submit_mult_update']=='Approve') { 
					
					
						$approval_date_time=date("Y-m-d H:i:s a");
						$chk=$_POST['chk'];					
						$c=count($chk);						
						//$approve='approval';	
	  					//if ($approve=='approval') $get_approve='pending'; else $get_active=1;
	  					for ($i=0; $i<$c; $i++)
						{	  													
							$query ="Update aibl_others_rqst set others_approve_by='$_SESSION[user_id]', others_approval_date_time='$approval_date_time', others_rqst_status='pending' where others_rqst_id='$chk[$i]'";							
							mysql_query($query) or
							die (mysql_error());					
						}						
						redirectUrl("index.php?option=others_approval_manager"); 					
					}
					
					if($_POST['submit_mult_update']=='Resend') { 
											 
						$approval_date_time=date("Y-m-d H:i:s a");
						$chk=$_POST['chk'];					
						$c=count($chk);																	
	  					for ($i=0; $i<$c; $i++)
						{	  						
							$query ="Update aibl_others_rqst set others_rqst_status='reject' where others_rqst_id='$chk[$i]'";							
							mysql_query($query) or
							die (mysql_error());											
						}					
						redirectUrl("index.php?option=others_approval_manager"); 					
					}
					
 				?>
				 
			
			
				  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info><div align="left"><B>Requested Security Instrument Information </B></div>
							</TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
 				</TABLE>
				  <TABLE class=border2 cellSpacing=0 cellPadding=0 width="100%" align=center border=0></br>
                    <TBODY>
                    <TR>
                      <TD>
					  <DIV class=syntax_manager1 style="width:100%">
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0 class=border>
                          <TBODY>                          
                            <TR>
                            <TD class=info align=left colSpan=11>
								<B>Total Request Information for Approval</B>											
							</TD>
						  </TR>
                          <TR>
							 
							 <TD width="8%" align="center" class="hf">
							 
								&nbsp;<B>#</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkall" onclick="checkedAll(frmChk);">						
							</TD>
							<TD  class=hf>
								<B>Requested By</B>							
							</TD>
							
							<TD class=hf>
								<B>Branch Name</B>							
							</TD>
														<TD  class=hf>
								<B>Item Type-Lvs</B>							
							</TD>
							<TD  class=hf>
								<B>Books</B>							
							</TD>
							
							<TD class=hf>
								<B>Delivery Type</B>							
							</TD>
							<TD class=hf>
								<B>Order Date</B>
							</TD>
							
						  </TR>
						  <?
						  
							$query="select *from aibl_others_rqst where others_rqst_status='approval' and others_collecting_branch_code='".$_SESSION['branch_code']."'";								
							$result = mysql_query($query) or
							die(mysql_error());
							
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							$sl=0;
							while ($row =mysql_fetch_assoc($result))
							{
														
							$order_date=str_replace('-','/',$row['others_order_date_time']);							
							?>
								<tr>
								<td class=<? echo $class; ?> align="center" width="5%">&nbsp;<? echo $sl; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="chk[]" value="<? echo $row['others_rqst_id']; ?>" style=" border-style:none"></td>
								<td class=<? echo $class; ?>><? echo $row['others_rqst_by'];?> </a></td>								
								<td class=<? echo $class; ?>><? echo $row['others_collecting_branch']; ?> </td>																																
								<td class=<? echo $class; ?>><? echo $row['item_type']."- ".$row['others_total_leaf']; ?> </td>
								<td class=<? echo $class; ?>><? echo $row['others_books']; ?> </td>								
								<td class=<? echo $class; ?>><? echo $row['others_severity']; ?> </td>
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
					 
				
				<input type="submit" name="submit_mult_update" value="Approve" onclick="return isChk();" class="favorite" />
				<input type="submit" name="submit_mult_update" value="Resend" onclick="return isChk();" />
				</form>				  				  
				<!----- End ------------------------------->  
					
				  </TD></TR></TBODY></TABLE>
				 <?				 
 			//}
		
		?>	
