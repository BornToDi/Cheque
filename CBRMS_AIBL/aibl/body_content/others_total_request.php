<?php
//include_once ("../config.php");
//include_once ("../tex_common.php");
$task=$_REQUEST['task'];
$option=$_REQUEST['option'];

if(($option=='others_total_request')&&($task=='others_total_request_admin'))

{
include ("pagging/others_pagging_excel.php");		
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=450');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Security Items Information </B>
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
								<B>Item Type </B>
							</TD>
							<TD class=hf align=center>
								<B>Start No. - End No. </B>
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
							
							$result = select_others_entries_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
								//$date=str_replace('-','/',$row['order_date_time']); 
								if(($row['others_approval_date_time'])!=0){
								$date=str_replace('-','/',$row['others_approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_approval_date_time']."</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['item_type']."-".$row['others_total_leaf']."X".$row['others_books']." Lvs</a></td>
								<td class=$class align='center'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_start_no']." - ".$row['others_end_no']."</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$status</a></td>																
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
										<?php nav_others_excel($offset); ?> 
							</TD>
						</TR>
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					 </TD></TR></TBODY></TABLE>
					 <div align="center"><a href="excel/total_request_excel.php?offset=<? echo $_REQUEST['offset']?>"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download as per page</font></b></a>
					 <a href="excel/excel.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
<?
}

if(($option=='others_total_request')&&($task=='others_total_request_ordered'))
{
include ("pagging/others_ordered_pagging_excel.php");
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=450');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Security Items Information </B>
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
								<B>Item Type </B>
							</TD>
							<TD class=hf width="100">
								<B>Star No. - End No. </B>
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
								if(($row['others_approval_date_time'])!=0){
								$date=str_replace('-','/',$row['others_approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_approval_date_time']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['item_type']."-".$row['others_total_leaf']."X".$row['others_books']." Lvs</a></td>
								<td class=$class width='100'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_start_no']." - ".$row['others_end_no']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$status</a></td>																
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
					 <div align="center"><a href="excel/ordered_pagging.php?offset=<? echo $_REQUEST['offset']?>"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download as per page</font></b></a>
					 <a href="excel/ordered_all.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
<?
}
					
if(($option=='others_total_request')&&($task=='others_total_request_pending'))
{
include ("pagging/others_pending_pagging_excel.php");
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=450');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Security Items Information </B>
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
								<B>Pending Information</B>											
							</TD>
						  </TR>
                          
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
								<B>Item Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Books </B>
							</TD>
							<TD class=hf align=lef>
								<B>Delilery Type </B>
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
							
							$result = select_entries_pending_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
									//$date=str_replace('-','/',$row['order_date_time']); 
								if(($row['others_approval_date_time'])!=0){
								$date=str_replace('-','/',$row['others_approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_approval_date_time']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['item_type']."-".$row['others_total_leaf']." Lvs</a></td>
								<td class=$class align='center'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_books']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$status</a></td>																
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
										<?php nav_pending_excel($offset); ?> 
							</TD>
						</TR>
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					 </TD></TR></TBODY></TABLE>
					 <div align="center"><a href="excel/pending_pagging.php?offset=<? echo $_REQUEST['offset']?>"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download as per page</font></b></a>
					 <a href="excel/pending_all.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
<?
}		

if(($option=='others_total_request')&&($task=='others_total_request_dispatched'))
{
include ("pagging/others_dispatched_pagging_excel.php");
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=450');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Security Items Information </B>
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
								<B>Item Type </B>
							</TD>
							<TD class=hf>
								<B>Star No. - End No. </B>
							</TD>
							<TD class=hf align=lef>
								<B>Delivery Type </B>
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
								if(($row['others_approval_date_time'])!=0){
								$date=str_replace('-','/',$row['others_approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_approval_date_time']."</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['item_type']."-".$row['others_total_leaf']."X".$row['others_books']." Lvs</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_start_no']." - ".$row['others_end_no']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_severity']."</a></td>									
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_dispatch_datetime']."</a></td>												
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
					 <div align="center"><a href="excel/dispatched_pagging.php?offset=<? echo $_REQUEST['offset']?>"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download as per page</font></b></a>
					 <a href="excel/dispatched_all.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
<?
}								
if(($option=='others_total_request')&&($task=='others_total_request_delivered'))
{
include ("pagging/others_delivered_pagging_excel.php");
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=450');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Security Items Information </B>
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
								if(($row['others_approval_date_time'])!=0){
								$date=str_replace('-','/',$row['others_approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$date</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['item_type']."-".$row['others_total_leaf']."X".$row['others_books']." Lvs</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_start_no']." - ".$row['others_end_no']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$status</a></td>																
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
					 <div align="center"><a href="excel/delivered_pagging.php?offset=<? echo $_REQUEST['offset']?>"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download as per page</font></b></a>
					 <a href="excel/delivered_all.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
<?
}

if(($option=='others_total_request')&&($task=='others_total_request_approval'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=450');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Security Items Information </B>
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
								<B>Item Type </B>
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
							$query = "select * from aibl_others_rqst where others_rqst_status='approval'  order by  others_order_date_time desc";
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
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$date</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['item_type']."-".$row['others_total_leaf']." Lvs</a></td>
								<td class=$class align='center'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_books']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$status</a></td>																
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
					 <a href="excel/delivered_all.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
					-->
<?
}	

if(($option=='others_total_request')&&($task=='others_total_request_reject'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=450');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Security Items Information </B>
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
								<B>Item Type </B>
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
							$query = "select * from aibl_others_rqst where others_rqst_status='reject' order by  others_order_date_time desc";
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
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$date</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['item_type']."-".$row['others_total_leaf']." Lvs</a></td>
								<td class=$class align='center'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_books']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$status</a></td>																
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
					 <a href="excel/delivered_all.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
					-->
<?
}	

if(($option=='others_total_request')&&($task=='others_total_request_manager'))

{
include ("pagging/others_pagging_excel.php");		
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=450');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Security Items Information </B>
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
								<B>Item Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Books </B>
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
							
							$result = select_others_entries_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
								//$date=str_replace('-','/',$row['order_date_time']); 
								if(($row['others_approval_date_time'])!=0){
								$date=str_replace('-','/',$row['others_approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$date</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['item_type']."-".$row['others_total_leaf']." Lvs</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_books']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$status</a></td>																
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
										<?php nav_others_excel($offset); ?> 
							</TD>
						</TR>
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					 </TD></TR></TBODY></TABLE>
					 <!--<div align="center"><a href="excel/total_request_excel.php?offset=<? //echo $_REQUEST['offset']?>"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download as per page</font></b></a>
					 <a href="excel/excel.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
					-->
<?
}
							
?>
								
