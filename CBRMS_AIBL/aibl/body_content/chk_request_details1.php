<?php
include_once ("../../config.php");
include_once ("../../tex_common.php");
//$task=$_REQUEST['task'];
//$option=$_REQUEST['option'];
//$task=$_REQUEST['task'];
//$option=$_REQUEST['option'];

//if(($option!='chk_request_details1')&&($task=='update_request'))
	
				   $req_id=$_REQUEST['rsqt_id'];
					$sql = "select *from aibl_chq_rqst  where rqst_id= '".$req_id."' ";
    				$sql_result = mysql_query($sql)
					or die("Couldn't execute query.");
					if (!$sql_result) {
					echo "<P>Couldn't get item!";
					} 
					else {
						$get_req = mysql_fetch_array($sql_result);
						//$last_leaf_no = $get_req['first_leaf_no']+$get_req['total_leaf'];
						$by_req_id = $get_req['rqst_id'];
						
																																																				
					if(isset($_POST['submit']))
					{	
//hobbies
//$hob=implode(",",$arr);
	
	$update_req_query ="update aibl_chq_rqst set collecting_branch='$_POST[collecting_branch]',cus_name='$_POST[cus_name]',ac_type='$_POST[ac_type]',severity='$_POST[severity]',rqst_status='$_POST[rqst_status]' where rqst_id='".$by_req_id."'";
	mysql_query($update_req_query) or
							die (mysql_error());
							//echo "????".$update_req_query;
							//redirectUrl("index.php?option=manage_chk_request&order=order_date_time"); 	
							header('location:chk_request_details.php');													
																																
							
					}															
				


						?>	
					<link href="<?php echo isset($uiPortal) ? 'style/style.css' : '../style/style.css'; ?>" rel="stylesheet" type="text/css"><link rel="stylesheet" href="../../ui/modern.css"><meta name="viewport" content="width=device-width, initial-scale=1"><script src="../../ui/popup.js" defer></script>
					<script language="javascript">
					function CallPrint()
					{
						self.focus()
						self.print()
					}
					</script>
					<FORM method="post">

				   <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				 
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle>
							<B>CBRMS</B>
						

							</TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
  				 </TABLE><BR>
                  
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=left colSpan=4>
								<B>Details Request Information</B>							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Requester Branch </span>:</TD>
                            <TD class=back colSpan=3>
							<input type="text" readonly="yes" value="<? echo $get_req['collecting_branch']; ?>" name="collecting_branch" size="40" />
                        							
								
						
                           					
							</TD>
						  </TR>
						  
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Name of Customer </span>:</TD>
                            <TD class=back colSpan=3>
							<input type="text" readonly="yes" value="<? echo $get_req['cus_name']; ?>" name="cus_name" size="70" />
							</TD>
						  </TR>						  
						  
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Account Type </span>:</TD>
                            <TD class=back colspan="3">
							<input type="text" readonly="yes"  value="<? echo $get_req['ac_type']; ?>" name="ac_type" size="10" />
							  	
										
							  	</TD>
						  </TR>
						  
						   <TR>   <TD class=back2 align=right width="35%"><span class="bodytext">Request Status</span>:</TD>
						   <TD class=back colspan="3">Normal<input type="radio" name="severity" value="Normal" <?php if($get_req['severity']=="Normal"){ echo "checked";}?>/><BR/>
						    Priority <input type="radio" name="severity" value="Priority" <?php if($get_req['severity']=="Priority"){ echo "checked";}?>/>  </TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Status of request</span>:</TD>
                            
							<TD class=back colspan="3">Reject<input type="radio" name="rqst_status" value="Reject" <?php if($get_req['rqst_status']=="Reject"){ echo "checked";}?>/><BR/>
							Pending<input type="radio" name="rqst_status" value="Pending" <?php if($get_req['rqst_status']=="Pending"){ echo "checked";}?>/>  </TD>
						  </TR>	
						   
											  
					  </TBODY></TABLE>
					 
					  </TD></TR></TBODY></TABLE><BR>
                  
                 <!-- <CENTER>&nbsp;&nbsp;&nbsp;
                  <input type="submit" value="Update Task" name="submit" onclick='return validate();'  />
                  <INPUT type="Reset" value="Reset">
				</FORM>
				  </CENTER>-->
				  <CENTER>
                  <input type="submit" value="Update" name="submit" />
				  
				  <!--<input type="submit" value="Update Task" name="submit" onclick='return VendorInput_validate();'/>-->
                  <input type="button"  value="Close" name="close" onclick='javascript:window.close();'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</FORM>
				  </CENTER>
				  
				  </TD></TR></TBODY></TABLE>
				  <?  }
				  
				  	?>
					
				