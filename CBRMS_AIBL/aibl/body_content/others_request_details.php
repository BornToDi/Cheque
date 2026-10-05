<?php
include_once ("../../config.php");
include_once ("../../tex_common.php");
//$task=$_REQUEST['task'];
//$option=$_REQUEST['option'];

					$req_id=$_REQUEST['rsqt_id'];
					$sql = "select *from aibl_others_rqst  where others_rqst_id= '".$req_id."' ";
    				$sql_result = mysql_query($sql)
					or die("Couldn't execute query.");
					if (!$sql_result) {
					echo "<P>Couldn't get item!";
					} 
					else {
						$get_req = mysql_fetch_array($sql_result);
						$last_leaf_no = $get_req['others_first_leaf_no']+$get_req['others_total_leaf'];
						$req_branch = $get_req['others_collecting_branch'];
						
					// Max Leaf Count
				  		//$max_leaf_query="select max(first_leaf_no) from aibl_chq_rqst";
						//$max_leaf_result=mysql_query($max_leaf_query);
						//$max_leaf=mysql_result($max_leaf_result,0,"max(first_leaf_no)");
															
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
							<B>Requested Security Items Information</B>						
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
							<? echo $get_req['others_rqst_by'];?></TD>
						  </TR>
                          <TR>
                          <TD class=back2 align=right width="35%">Approved By: </TD>
                            <TD class=back colspan="3" align=left>
							<? echo $get_req['others_approve_by'];?></TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Requester Branch </span>:</TD>
                            <TD class=back colSpan=3>
                        							
								<? echo $get_req['others_collecting_branch']; ?>
						
                           					
							</TD>
						  </TR>
						  						 
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Start No.- End No.</span>:</TD>
                            <TD class=back colSpan=3>
							<? echo $get_req['others_start_no']; ?> -
                            <? echo $get_req['others_end_no']; ?>
							</TD>
						  </TR>
						  
						  
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Item Type </span>:</TD>
                            <TD class=back colspan="3">
							  	<? echo $get_req['item_type']; ?>(<? echo $get_req['others_total_leaf']; ?>)
							  	</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">No of Book</span>:</TD>
                            
							<TD class=back colspan="3">
							  <? echo $get_req['others_books']; ?> 
							 </TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Delivery Type</span>:</TD>
                            
							<TD class=back colspan="3">
							  <? echo $get_req['others_severity']; ?> 
							 </TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Status of request</span>:</TD>
                            
							<TD class=back colspan="3">
							 <? 
							  if($get_req['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$get_req['others_rqst_status'];
							  echo $status; 
							  ?> 
							</TD>
						  </TR>	
						   <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Request Date and Time: </span>:</TD>
                            <TD class=back colspan="3">
							  
							  <? 
									$date=str_replace('-','/',$get_req['others_order_date_time']); 
									echo date('M d, Y h:i a', strtotime($date));
								?>
							</TD>
						  </TR>
						   <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Approval Date and Time: </span>:</TD>
                            <TD class=back colspan="3">
							  
							  <? 
								$date=str_replace('-','/',$get_req['others_approval_date_time']); 																	
								if(($get_req['others_approval_date_time'])!=0){
								echo date('M d, Y h:i a', strtotime($date)); 
								}
								else 
								echo "Not yet approved";
								?>
							</TD>
						  </TR>
						  						 
						  <TR>
                          	<TD class=back2 align=right width="35%">Dispatch Date & Time: </TD>
                            <TD class=back colspan="3">
								
								
								<? 
								if(($get_req['others_dispatch_datetime'])!=0){
								$date=str_replace('-','/',$get_req['others_dispatch_datetime']); 
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
								if(($get_req['others_delivered_datetime'])!=0){
								$date=str_replace('-','/',$get_req['others_delivered_datetime']); 
								echo date('M d, Y h:i', strtotime($date));
								}
								else 
								echo "Not yet Delivered";
							
								?>							
															
							</TD>
						  </TR>	
						 
						  <TR>
                            <TD class=back2 vAlign=top align=right width="35%">Remarks: </TD>
                            <TD class=back colSpan=3>
							  <? echo $get_req['others_remarks']; ?>
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



