<?php
include_once ("../../config.php");
include_once ("../../tex_common.php");
//$task=$_REQUEST['task'];
//$option=$_REQUEST['option'];

					$req_id=$_REQUEST['rsqt_id'];
					$sql = "select *from aibl_chq_rqst  where rqst_id= '".$req_id."' ";
    				$sql_result = mysql_query($sql)
					or die("Couldn't execute query.");
					if (!$sql_result) {
					echo "<P>Couldn't get item!";
					} 
					else {
						$get_req = mysql_fetch_array($sql_result);
						$last_leaf_no = $get_req['first_leaf_no']+$get_req['total_leaf'];
						$req_branch = $get_req['collecting_branch'];
																				
					?>	
					<link href="<?php echo isset($uiPortal) ? 'style/style.css' : '../style/style.css'; ?>" rel="stylesheet" type="text/css"><link rel="stylesheet" href="../../ui/modern.css"><meta name="viewport" content="width=device-width, initial-scale=1"><script src="../../ui/popup.js" defer></script>
					<script language="javascript">
					function CallPrint()
					{
						self.focus()
						self.print()
					}
					</script>
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
                          <TD class=back2 align=right width="35%">Requested By: </TD>
                            <TD class=back colspan="3" align=left>
							<? echo $get_req['rqst_by'];?></TD>
						  </TR>
                          <TR>
                          <TD class=back2 align=right width="35%">Approved By: </TD>
                            <TD class=back colspan="3" align=left>
							<? echo $get_req['approve_by'];?></TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Requester Branch </span>:</TD>
                            <TD class=back colSpan=3>
                        							
								<? echo $get_req['collecting_branch']; ?>
						
                           					
							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Customer Request Date</span>:</TD>
                            <TD class=back colSpan=3>
								
								<? 
									$date=str_replace('-','/',$get_req['rqst_date']); 
									echo date('M d, Y', strtotime($date));
								?>
								
							
																
								
							</TD>
						  </TR>
						  
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Name of Customer </span>:</TD>
                            <TD class=back colSpan=3><? echo $get_req['cus_name']; ?></TD>
						  </TR>						  
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Account No</span>:</TD>
                            <TD class=back colSpan=3>
								<? echo $get_req['ac_no_branch']; ?>-
                                <? echo $get_req['ac_no_suffix']; ?>-								
								<? echo $get_req['ac_no_cus_no']; ?>	
							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Start-End Chq. No.</span>:</TD>
                            <TD class=back colSpan=3>
							<? echo $get_req['start_no']; ?> -
                            <? echo $get_req['end_no']; ?>
							</TD>
						  </TR>
						  
						  
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Account Type </span>:</TD>
                            <TD class=back colspan="3">
							  	<? echo $get_req['ac_type']; ?>(<? echo $get_req['total_leaf']; ?>)
							  	</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">No of Book</span>:</TD>
                            
							<TD class=back colspan="3">
							  <? echo $get_req['books']; ?> 
							 </TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Delivery Type</span>:</TD>
                            
							<TD class=back colspan="3">
							  <? echo $get_req['severity']; ?> 
							 </TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Status of request</span>:</TD>
                            
							<TD class=back colspan="3">
							 <? 
							  if($get_req['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$get_req['rqst_status'];
							  echo $status; 
							  ?> 
							</TD>
						  </TR>	
						   
						   <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Request Date and Time: </span>:</TD>
                            <TD class=back colspan="3">
							  
							  <? 
									$date=str_replace('-','/',$get_req['order_date_time']); 
									echo date('M d, Y h:i a', strtotime($date));
								?>
							</TD>
						  </TR>
						   
						   <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Approval Date and Time: </span>:</TD>
                            <TD class=back colspan="3">
							  
							  <? 
								  echo $get_req['approval_date_time']; 
								
								
								?>
							</TD>
						  </TR>
						  						 
						  <TR>
                          	<TD class=back2 align=right width="35%">Dispatch Date & Time: </TD>
                            <TD class=back colspan="3">
								
								
								<? 
								if(($get_req['dispatch_datetime'])!=0){
								$date=str_replace('-','/',$get_req['dispatch_datetime']); 
								echo date('M d, Y h:i a', strtotime($date));
								}
								else 
								echo "Not yet Dispached";
							
								?>							
															
							</TD>
						  </TR>	
						  <TR>
                          	<TD class=back2 align=right width="35%">Delivered Date & Time: </TD>
                            <TD class=back colspan="3">																
								<? 
								if(($get_req['delivered_datetime'])!=0){
								$date=str_replace('-','/',$get_req['delivered_datetime']); 
								echo date('M d, Y h:i', strtotime($date));
								}
								else 
								echo "Not yet Delivered";							
								?>																						
							</TD>
						  </TR>	
						 
						 <TR>
                          <TD class=back2 align=right width="35%">Request Edit By: </TD>
                            <TD class=back colspan="3" align=left>
							<? echo $get_req['rqst_edit_by'];?></TD>
						  </TR>
						 <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Edit Order Date and Time: </span>:</TD>
                            <TD class=back colspan="3">
							  
							  <? 								
								if(($get_req['rqst_edit_datetime'])!=0){
								$date=str_replace('-','/',$get_req['rqst_edit_datetime']); 
								echo date('M d, Y h:i', strtotime($date));
								}
								else 
								echo "Not yet Edit Request";							
								?>												
							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 vAlign=top align=right width="35%">Remarks: </TD>
                            <TD class=back colSpan=3>
							  <? echo $get_req['remarks']; ?>
							</TD>
						  </TR>				  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
                  
                 <!-- <CENTER>&nbsp;&nbsp;&nbsp;
                  <input type="submit" value="Update Task" name="submit" onclick='return validate();'  />
                  <INPUT type="Reset" value="Reset">
				</FORM>
				  </CENTER>-->
				<CENTER>&nbsp;&nbsp;&nbsp;
                  <input type="button"  value="Close" name="close" onclick='javascript:window.close();'/>
                  
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
							<a href="#" onClick="javascript:window.print();" title="Print Version">
							<img src="../images/printer.gif" border="0" align="absmiddle" /></a>
				  
				  
				  </CENTER>
				  </TD></TR></TBODY></TABLE>

<?		
  }	
?>



