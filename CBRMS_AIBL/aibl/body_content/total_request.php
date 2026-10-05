<?php
$task=$_REQUEST['task'];
$option=$_REQUEST['option'];

if(($option=='total_request')&&($task=='total_request_admin'))

{
include ("pagging/pagging_excel.php");		
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Cheque Book Information </B>
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
        
                        <TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
                          <TBODY>
                          
                          <TR>
                            <TD class=info align=left colSpan=8>
								<B>Total Request Information</B>											
							</TD>
						  </TR>
						  <TD width="11%" align=lef class=hf>
								<B>Maker ID </B>							</TD>
							 <TD width="13%" align=left class=hf>
								<B>Req. Branch </B>							</TD>
							 <TD width="15%" align=lef class=hf>
								<B>Approved Date</B>							</TD>	
							<TD width="12%" align=lef class=hf>
								<B>Account No </B>							</TD>							
							 <TD width="14%" align=lef class=hf>
								<B>Account Type </B>							</TD>
							<TD width="14%" align=lef class=hf>
								<B>Start - End Chq. No </B>							</TD>
							<TD width="14%" align=lef class=hf>
								<B>Del. Type </B>							</TD>
							<TD width="7%" align=lef class=hf>
								<B>Status</B>							</TD>
							
							
						  </TR>
						    <?
						
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							
							$result = select_entries_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
								//$date=str_replace('-','/',$row['order_date_time']); 
								if(($row['approval_date_time'])!=0){
								$date=str_replace('-','/',$row['approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['approval_date_time']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."-".$row['total_leaf']."X".$row['books']." Lvs</a></td>
								<td class=$class align='center'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['start_no']." - ".$row['end_no']."</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$status</a></td>	
																							
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}

						}
						?>  
						  <TR>
							<TD  class=back colspan="8" align="center">
										<?php nav_excel($offset); ?> 
							</TD>
						</TR>
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					 </TD></TR></TBODY></TABLE>
					 <div align="center">					 
					 <a href="excel/excel.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download this page</font></b></a>
					 </div>
<?
}

if(($option=='total_request')&&($task=='total_request_ordered'))
{
include ("pagging/ordered_pagging_excel.php");
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Cheque Book Information </B>
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
                            <TD class=info align=left colSpan=8>
								<B>Ordered Information</B>											
							</TD>
						  </TR>
                          
						  <TD class=hf align=lef>
								<B>Maker ID </B>
							</TD>
							 <TD class=hf align=left>
								<B>Req. Branch </B>						
							</TD>
							 <TD class=hf align=lef>
								<B>Approved Date & Time</B>								
							</TD>	
							<TD class=hf align=lef>
								<B>Account No </B>
							</TD>							
							 <TD class=hf align=lef>
								<B>Account Type </B>
							</TD>
							<TD class=hf width="100">
								<B>Star - End Chq. No </B>
							</TD>
							<TD class=hf align=lef>
								<B>Delivery Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Status</B>
							</TD>
							
							
						  </TR>
						  <?
						
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							
							$result = select_entries_ordered_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
									//$date=str_replace('-','/',$row['order_date_time']); 
								if(($row['approval_date_time'])!=0){
								$date=str_replace('-','/',$row['approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['approval_date_time']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."-".$row['total_leaf']."X".$row['books']." Lvs</a></td>
								<td class=$class width='100'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['start_no']." - ".$row['end_no']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$status</a></td>																
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}

						}
						?>  
						  <TR>
							<TD  class=back colspan="8" align="center">
										<?php nav_ordered_excel($offset); ?> 
							</TD>
						</TR>
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					 </TD></TR></TBODY></TABLE>
					 <div align="center">					 
					 <a href="excel/ordered_all.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download this page</font></b></a>
					 </div>
<?
}
					
if(($option=='total_request')&&($task=='total_request_pending'))
{
include ("pagging/pending_pagging_excel.php");
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
}
</script>
<script language="javascript">
function OpenLivePic1(rsqt_id) {		
	window.open('body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
}
</script>

                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Cheque Book Information </B>
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
        
                        <TABLE cellSpacing=2 cellPadding=3 width="100%" border=0>
                          <TBODY>
						  <TR>
                            <TD class=info align=left colSpan=12>
								<B>Pending Information</B>											
							</TD>
						  </TR>
                          
						  <TD class=hf align=lef>
								<B>Maker ID </B>
							</TD>
							 <TD class=hf align=left>
								<B>Cus. Br. Name </B>						
							</TD>
							 <TD class=hf align=left>
								<B>Cus. Br. Code </B>						
							</TD>
							 <TD class=hf align=lef>
								<B>Approved Date</B>								
							</TD>	
							<TD class=hf align=lef>
								<B>Account No </B>
							</TD>							
							 <TD class=hf align=lef>
								<B>Account Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Books </B>
							</TD>
							<TD class=hf align=lef>
								<B>Del. Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Rqst.Br.Code </B>
							</TD>
							<TD class=hf align=lef>
								<B>Rqst.Br.Name </B>
							</TD>
							<TD class=hf align=lef>
								<B>Status</B>
							</TD>
							<TD class=hf align=lef>
								<B>Action</B>
							</TD>
							
							
						  </TR>
						  
						  <?
						
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							
							$result = select_entries_pending_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
									//$date=str_replace('-','/',$row['order_date_time']); 
								if(($row['approval_date_time'])!=0){
								$date=str_replace('-','/',$row['approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch_code'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['approval_date_time']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."-".$row['total_leaf']." Lvs</a></td>
								<td class=$class align='center'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['books']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['collecting_branch_code']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['collecting_branch']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$status</a></td>	
								<td class=$class ><a href=\"javascript:OpenLivePic1(".$row['rqst_id'].")\" style='text-decoration:underline'>Edit</a></td>															
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}

						}
						?>  
						  <TR>
							<TD  class=back colspan="12" align="center">
										<?php nav_pending_excel($offset); ?> 
							</TD>
						</TR>
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					 </TD></TR></TBODY></TABLE>
					 <div align="center">					 
					 <a href="excel/pending_all.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download this page</font></b></a>
					 </div>
<?
}		

if(($option=='total_request')&&($task=='total_request_dispatched'))
{
include ("pagging/dispatched_pagging_excel.php");
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Cheque Book Information </B>
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
                            <TD class=info align=left colSpan=9>
								<B>Dispatched Information</B>											
							</TD>
						  </TR>
                          <TR>                          
						  <TD class=hf align=lef>
								<B>Maker ID </B>
							</TD>
							 <TD class=hf align=left>
								<B>Req. Branch </B>						
							</TD>
							 <TD class=hf align=lef>
								<B>Approved Date</B>								
							</TD>	
							<TD class=hf align=lef>
								<B>Account No </B>
							</TD>
							
							 <TD class=hf align=lef>
								<B>Account Type </B>
							</TD>
							<TD class=hf>
								<B>Star - End No </B>
							</TD>
							<TD class=hf align=lef>
								<B>Del. Type </B>
							</TD>
							
							<TD class=hf align=lef>
								<B>Dispatched Date</B>
							</TD>
							
							
						  </TR>
						  <?
						
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							
							$result = select_entries_dispatched_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
																	
								//$date=str_replace('-','/',$row['order_date_time']); 
								$dis_date=str_replace('-','/',$row['dispatch_datetime']); 
								
								//$date=str_replace('-','/',$row['order_date_time']); 
								if(($row['approval_date_time'])!=0){
								$date=str_replace('-','/',$row['approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['approval_date_time']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."-".$row['total_leaf']."X".$row['books']." Lvs</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['start_no']." - ".$row['end_no']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>									
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".date('M d, Y h:i a', strtotime($dis_date))."</a></td>												
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}

						}
						?>  
						  <TR>
							<TD  class=back colspan="9" align="center">
										<?php nav_dispatched_excel($offset); ?> 
							</TD>
						</TR>
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					 </TD></TR></TBODY></TABLE>
					 <div align="center">					
					 <a href="excel/dispatched_all.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download this page</font></b></a>
					 </div>
<?
}								
if(($option=='total_request')&&($task=='total_request_delivered'))
{
include ("pagging/delivered_pagging_excel.php");
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Cheque Book Information </B>
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
                            <TD class=info align=left colSpan=8>
								<B>Delivered Information</B>											
							</TD>
						  </TR>
                          <TR>                           
						  <TD class=hf align=lef>
								<B>Maker ID </B>
							</TD>
							 <TD class=hf align=left>
								<B>Req. Branch </B>						
							</TD>
							 <TD class=hf align=lef>
								<B>Approved Date & Time</B>								
							</TD>	
							<TD class=hf align=lef>
								<B>Account No </B>
							</TD>							
							 <TD class=hf align=lef>
								<B>Account Type </B>
							</TD>
							<TD class=hf width="100">
								<B>Star - End No </B>
							</TD>
							<TD class=hf align=lef>
								<B>Delivery Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Status</B>
							</TD>
							
							
						  </TR>
						  <?
						
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							
							$result = select_entries_delivered_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
									//$date=str_replace('-','/',$row['order_date_time']); 
								if(($row['approval_date_time'])!=0){
								$date=str_replace('-','/',$row['approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['approval_date_time']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."-".$row['total_leaf']."X".$row['books']." Lvs</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['start_no']." - ".$row['end_no']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$status</a></td>																
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}

						}
						?>  
						  <TR>
							<TD  class=back colspan="8" align="center">
										<?php nav_delivered_excel($offset); ?> 
							</TD>
						</TR>
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					 </TD></TR></TBODY></TABLE>
					 <div align="center">					 
					 <a href="excel/delivered_all.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download this page</font></b></a></div>
<?
}

if(($option=='total_request')&&($task=='total_request_approval'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Cheque Book Information </B>
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
                            <TD class=info align=left colSpan=8>
								<B>Awaiting approval Information</B>											
							</TD>
						  </TR>
                          <TR>                           
						  <TD class=hf align=lef>
								<B>Maker ID </B>
							</TD>
							 <TD class=hf align=left>
								<B>Req. Branch </B>						
							</TD>
							 <TD class=hf align=lef>
								<B>Order Date & Time</B>								
							</TD>	
							<TD class=hf align=lef>
								<B>Account No </B>
							</TD>							
							 <TD class=hf align=lef>
								<B>Account Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Books</B>
							</TD>
							<TD class=hf align=lef>
								<B>Delivery Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Status</B>
							</TD>
							
							
						  </TR>
						  <?
						
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							$query = "select *from aibl_chq_rqst where rqst_status='approval'  order by  order_date_time desc";
							$result = mysql_query($query);
							//$result = select_entries_delivered_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
									//$date=str_replace('-','/',$row['order_date_time']); 
								if(($row['order_date_time'])!=0){
								$date=str_replace('-','/',$row['order_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['approval_date_time']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."-".$row['total_leaf']." Lvs</a></td>
								<td class=$class align='center'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['books']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$status</a></td>																
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}

						}
						?>
						<!--  
						  <TR>
							<TD  class=back colspan="7" align="center">
										<?php //nav_delivered_excel($offset); ?> 
							</TD>
						</TR>
						-->					  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					 </TD></TR></TBODY></TABLE>
					<!--
					 <div align="center"><a href="excel/delivered_pagging.php?offset=<? echo $_REQUEST['offset']?>"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download as per page</font></b></a>
					 <a href="excel/delivered_all.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download this page</font></b></a></div>
					-->
<?
}	


if(($option=='total_request')&&($task=='total_request_reject'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Cheque Book Information </B>
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
                            <TD class=info align=left colSpan=8>
								<B>Resend Information</B>											
							</TD>
						  </TR>
                          <TR>                           
						  <TD class=hf align=lef>
								<B>Maker ID </B>
							</TD>
							 <TD class=hf align=left>
								<B>Req. Branch </B>						
							</TD>
							 <TD class=hf align=lef>
								<B>Order Date & Time</B>								
							</TD>	
							<TD class=hf align=lef>
								<B>Account No </B>
							</TD>							
							 <TD class=hf align=lef>
								<B>Account Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Books</B>
							</TD>
							<TD class=hf align=lef>
								<B>Delivery Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Status</B>
							</TD>
							
							
						  </TR>
						  <?
						
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							$query = "select *from aibl_chq_rqst where rqst_status='reject'  order by  order_date_time desc";
							$result = mysql_query($query);
							//$result = select_entries_delivered_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
									//$date=str_replace('-','/',$row['order_date_time']); 
								if(($row['order_date_time'])!=0){
								$date=str_replace('-','/',$row['order_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['approval_date_time']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."-".$row['total_leaf']." Lvs</a></td>
								<td class=$class align='center'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['books']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$status</a></td>																
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}

						}
						?>
						<!--  
						  <TR>
							<TD  class=back colspan="7" align="center">
										<?php //nav_delivered_excel($offset); ?> 
							</TD>
						</TR>
						-->					  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					 </TD></TR></TBODY></TABLE>
					<!--
					 <div align="center"><a href="excel/delivered_pagging.php?offset=<? echo $_REQUEST['offset']?>"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download as per page</font></b></a>
					 <a href="excel/delivered_all.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download this page</font></b></a></div>
					-->
<?
}	

if(($option=='total_request')&&($task=='total_request_manager'))

{
include ("pagging/pagging_excel.php");		
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Cheque Book Information </B>
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
        
                        <TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
                          <TBODY>
                          
                          <TR>
                            <TD class=info align=left colSpan=7>
								<B>Branch Total Request Information</B>											
							</TD>
						  </TR>
						  <TD class=hf align=lef>
								<B>Maker ID </B>
							</TD>
							 <TD class=hf align=left>
								<B>Req. Branch </B>						
							</TD>
							 <TD class=hf align=lef>
								<B>Approved Date & Time</B>								
							</TD>	
							<TD class=hf align=lef>
								<B>Account No </B>
							</TD>
							
							 <TD class=hf align=lef>
								<B>Account Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Delivery Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Status</B>
							</TD>
							
							
						  </TR>
						  <?
						
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							
							$result = select_entries_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
								//$date=str_replace('-','/',$row['order_date_time']); 
								if(($row['approval_date_time'])!=0){
								$date=str_replace('-','/',$row['approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['approval_date_time']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."-".$row['total_leaf']." Lvs</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$status</a></td>																
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}

						}
						?>  
						  <TR>
							<TD  class=back colspan="7" align="center">
										<?php nav_excel($offset); ?> 
							</TD>
						</TR>
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					 </TD></TR></TBODY></TABLE>
					 <!--<div align="center"><a href="excel/total_request_excel.php?offset=<? //echo $_REQUEST['offset']?>"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download as per page</font></b></a>
					 <a href="excel/excel.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download this page</font></b></a></div>
					-->
<?
}
							
?>
								
