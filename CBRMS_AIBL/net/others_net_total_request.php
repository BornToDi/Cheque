<?php
//include_once ("../config.php");
include_once ("../tex_common.php");

if (empty($_SESSION['user_name']))
{	
	redirectUrl('net_signin.php?msg=signin');
}

$task=$_REQUEST['task'];
$option=$_REQUEST['option'];

include ("../aibl/pagging/others_pagging_excel.php");
include ("../aibl/pagging/others_ordered_pagging_excel.php");
include ("../aibl/pagging/others_pending_pagging_excel.php");
include ("../aibl/pagging/others_dispatched_pagging_excel.php");
include ("../aibl/pagging/others_delivered_pagging_excel.php");
?>
<SCRIPT language=javascript1.2 src="../aibl/js/common.js" type=text/javascript></SCRIPT>
<SCRIPT type=text/javascript>
function advance_end_no(FDDrentField,nextField) {   
	if (FDDrentField.value.length == 7)
        document.frmSl[nextField].focus();
}

</SCRIPT>
<?
if(($option=='others_total_request')&&($task=='others_total_request_admin'))

{
		
?>
<script language="javascript">

function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
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
								<B>Total Request Information</B>											
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
								<B>Item Type </B>
							</TD>
							<TD class=hf align=lef>
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
								//$date=str_replace('-','/',$row['others_order_date_time']); 
								if(($row['others_approval_date_time'])!=0){
								$date=str_replace('-','/',$row['others_approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								$others_req_id[]=$row['others_rqst_id'];
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row[' 	others_approval_date_time']."</a></td>								 
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
						if (mysql_num_rows($result) != 0){
							foreach($others_req_id as $key=>$value) {
								$excelArray .= "id[$key]=$value&";
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
					 <div align="center"><a href="../aibl/excel/others_total_request_excel.php?offset=<? echo $_REQUEST['offset']?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download as per page</font></b></a>
					 <a href="../aibl/excel/others_excel.php?<? echo $excelArray; ?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
<?
}

if(($option=='others_total_request')&&($task=='others_total_request_ordered'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
}
</script>
                 
                  <form name="frmChk" method="post" action="index.php?option=others_total_request&task=change_status"> 
<TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
        				
                        <TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
                          <TBODY>
						  <TR>
                            <TD class=info align=left colSpan=10>
								<B>Ordered Cheque Book Information</B>											
							</TD>
						  </TR>
						  <?																
	$order=$_REQUEST['order'];			
	function str($order){
	
		$fieldlist = array();
		$fieldlist[0] = "others_collecting_branch";
		$fieldlist[1] = "others_severity"; 
		$fieldlist[2] = "item_type"; 
		$fieldlist[3] = "others_rqst_status"; 
		$fieldlist[4] = "others_approval_date_time";			
		for($i=0;$i<count($fieldlist);$i++)
		{
			if($order == $fieldlist[$i])
			{
				$order = $fieldlist[$i]." desc";						
			}			
			if($order == $fieldlist[$i]."_up")
			{
				$order = $fieldlist[$i]."";						
			}
				else if($order == $fieldlist[$i]."_down")
			{
				$order = $fieldlist[$i]." desc";						
			}					
		}
			return $order;	
	}
		 $order=str($order);
						
		$fieldlist = array();
		$fieldlist[0] = "others_collecting_branch";
		$fieldlist[1] = "others_severity"; 
		$fieldlist[2] = "item_type"; 
		$fieldlist[3] = "others_rqst_status"; 
		$fieldlist[4] = "others_approval_date_time";
		
		for($i=0;$i<count($fieldlist);$i++)
		{
			if($order == $fieldlist[$i]." desc")
			{
				$$fieldlist[$i] = $fieldlist[$i]."_up";	
				$s_asc="../aibl/images/s_asc.png";			
			}
			else
			{
				$$fieldlist[$i] = $fieldlist[$i]."_down";
				$s_desc="../aibl/images/s_desc.png";
			}
		}
		
		?>
                          <TR>
                             <TD width="46"  class="hf" align="center">							 
								&nbsp;<B>#</B>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkall" onclick="checkedAll(frmChk);">						
							</TD>
							 <TD class=hf  width="65">
								<B>Maker ID </B>
							</TD>
							 <TD class=hf  width="80">
								<A href="index.php?option=others_total_request&task=others_total_request_ordered&order=<? echo $others_collecting_branch; ?>" style="text-decoration:underline"><B>Req. Branch </B>						
								</A>
							</TD>
							 <TD class=hf width="110">
								<A href="index.php?option=others_total_request&task=others_total_request_ordered&order=<? echo $others_approval_date_time; ?>" style="text-decoration:underline"><B>Approved Date</B>
								<? if ($others_approval_date_time =="approval_date_time_up") {?> <img src="<? echo $s_asc ?>" border="0" align="absmiddle" /><? 
								}
								if ($others_approval_date_time =="approval_date_time_down")
									{
								?>
									 <img src="<? echo $s_desc ?>" border="0" align="absmiddle" />
									 <?
									 }
								?>
								</A>								
							</TD>	
														
							 <TD class=hf width="60">
								<A href="index.php?option=others_total_request&task=others_total_request_ordered&order=<? echo $item_type; ?>" style="text-decoration:underline"><B>Item Type </B>
								</A>
							</TD>
							<TD class=hf width="60">
								<B>Leaves </B>
							</TD>
							<TD class=hf width="100">
								<B>Star No. - End No. </B>
							</TD>
							<TD class=hf width="80">
								<A href="index.php?option=others_total_request&task=others_total_request_ordered&order=<? echo $others_severity; ?>" style="text-decoration:underline"><B>Delivery Type </B>
								</A>
							</TD>
							<TD class=hf align=lef>
								<B>Status</B>
							</TD>														
						  </TR>
					
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					<DIV class=syntax_hilite>
                  
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
        
                        <TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
                          <TBODY>
						  

						  <?
						
							str($order);				
							//echo "testkkkk".$order;
							$order1="$order";						  
							if($order1=="")
								$query1="select * from aibl_others_rqst where others_rqst_status='ordered' order by others_collecting_branch desc, item_type desc, others_total_leaf asc, others_approval_date_time desc";		
							else
								$query1="select * from aibl_others_rqst where others_rqst_status='ordered' order by ".$order1;		
					
							$result1 = mysql_query($query1) or
							die(mysql_error());
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							$sl=1;
							//$result = select_entries_pending_excel($offset);
							while ($row =mysql_fetch_assoc($result1))
							{
								if(($row['others_approval_date_time'])!=0){
								$date=str_replace('-','/',$row['others_approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								
								$others_req_id[]=$row['others_rqst_id'];
								
								echo "<tr>	
								<td class=$class  align='center' width='44'>&nbsp;$sl&nbsp;&nbsp;&nbsp;<input type='checkbox' name='chk[]' value=".$row['others_rqst_id']." style='border-style:none'></td>							
								<td class=$class width='65'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_rqst_by']."</a></td>							
								<td class=$class width='80'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row[' 	others_approval_date_time']."</a></td>								
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['item_type']."</a></td>
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_total_leaf']." X ".$row['others_books']." Lvs</a></td>
								<td class=$class width='100'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_start_no']." - ".$row['others_end_no']."</a></td>
								<td class=$class width='80'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$status</a></td>																
								</tr>";
								$sl++;
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}
						}
						
						if (mysql_num_rows($result1) != 0){
							foreach($others_req_id as $key=>$value) {
								$excelArray .= "id[$key]=$value&";
							}
						}
						
						//$query2="select distinct collecting_branch_code from aibl_others_rqst where others_rqst_status='ordered'";
						$query2="select distinct others_collecting_branch_code from aibl_others_rqst where others_rqst_status='ordered' order by others_collecting_branch asc";
						$result2 = mysql_query($query2) or
						die(mysql_error());
						if (mysql_num_rows($result2) != 0){
							while ($row =mysql_fetch_assoc($result2))
							{
								$others_collecting_branch_code[]=$row['others_collecting_branch_code'];
							}
							foreach($others_collecting_branch_code as $key=>$value) {
								$strArray .= "id[$key]=$value&";
							}
						}
						?>  
						</TBODY></TABLE></TD></TR></TBODY></TABLE>
					  
					  </DIV>
					  <TABLE width="100%">
						  <TR>
							<TD  class=back colspan="8">
							<DIV  style="float:left; width:300;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img class="selectallarrow" width="38" height="22" src="../aibl/images/arrow_ltr.png" alt="With selected:" />
							<i>With selected:</i>	
							<input type="hidden" name="do_dispached" value="do_dispached" />													
							<input type="submit" name="edit" value="Update Status" onclick="return isChk();"/>
							<?php //nav_ordered_excel($offset); ?> 
							</DIV>
							<?php
							$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1000,height=570,directories=no,location=no';
							?> 
					 		<DIV  style="float:right; width:450;">
							<a href="../aibl/excel/others_challan_excel.php?<? echo $strArray; ?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Excel Challan</font></b></a>							
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="../aibl/excel/others_personalisation.php"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">MICR</font></b></a>							
							<a href="<?php echo $link; ?>" target="_blank" onClick="window.open('../aibl/popups/others_challan.php?<? echo $strArray; ?>','win2','<?php echo $status; ?>'); return false;" style="text-decoration:underline">
					 			<!--	<img src="../aibl/images/challan-icon.jpg" width="23" height="25" hspace="2"  border="0"/>&nbsp;<b>DELIVERY CHALLAN</b>	-->						</a>							
							</DIV>							
							</TD>
						</TR>											  	 			  
					  </TABLE>
					   </form>
					 </TD></TR></TBODY></TABLE>
					 
<?
}
					
if(($option=='others_total_request')&&($task=='others_total_request_pending'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
}

</script> 
                  
				 <form name="frmChk" method="post" action="index.php?option=others_total_request&task=change_status"> 
				 <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
        				
                        <TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
                          <TBODY>
						  <TR>
                            <TD class=info align=left colSpan=9>
								<B>Pending Cheque Book Information</B>											
							</TD>
						  </TR>
						  <?																
	$order=$_REQUEST['order'];			
	function str($order){
	
		$fieldlist = array();
		$fieldlist[0] = "others_collecting_branch";
		$fieldlist[1] = "others_severity"; 
		$fieldlist[2] = "item_type"; 
		$fieldlist[3] = "others_rqst_status"; 
		$fieldlist[4] = "others_approval_date_time";			
		for($i=0;$i<count($fieldlist);$i++)
		{
			if($order == $fieldlist[$i])
			{
				$order = $fieldlist[$i]." desc";						
			}			
			if($order == $fieldlist[$i]."_up")
			{
				$order = $fieldlist[$i]."";						
			}
				else if($order == $fieldlist[$i]."_down")
			{
				$order = $fieldlist[$i]." desc";						
			}					
		}
			return $order;	
	}
		 $order=str($order);
						
		$fieldlist = array();
		$fieldlist[0] = "others_collecting_branch";
		$fieldlist[1] = "others_severity"; 
		$fieldlist[2] = "item_type"; 
		$fieldlist[3] = "others_rqst_status"; 
		$fieldlist[4] = "others_approval_date_time";
		
		for($i=0;$i<count($fieldlist);$i++)
		{
			if($order == $fieldlist[$i]." desc")
			{
				$$fieldlist[$i] = $fieldlist[$i]."_up";	
				$s_asc="../aibl/images/s_asc.png";			
			}
			else
			{
				$$fieldlist[$i] = $fieldlist[$i]."_down";
				$s_desc="../aibl/images/s_desc.png";
			}
		}
		
		?>
                          <TR>
                             <TD width="46"  class="hf" align="center">							 
								&nbsp;<B>#</B>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkall" onclick="checkedAll(frmChk);">						
							</TD>
							 <TD class=hf  width="65">
								<B>Maker ID </B>
							</TD>
							 <TD class=hf  width="80">
								<A href="index.php?option=others_total_request&task=others_total_request_pending&order=<? echo $others_collecting_branch; ?>" style="text-decoration:underline"><B>Req. Branch </B>						
								</A>
							</TD>
							 <TD class=hf width="137">
								<A href="index.php?option=others_total_request&task=others_total_request_pending&order=<? echo $others_approval_date_time; ?>" style="text-decoration:underline"><B>Approved Date & Time</B>
								<? if ($others_approval_date_time =="approval_date_time_up") {?> <img src="<? echo $s_asc ?>" border="0" align="absmiddle" /><? 
								}
								if ($others_approval_date_time =="approval_date_time_down")
									{
								?>
									 <img src="<? echo $s_desc ?>" border="0" align="absmiddle" />
									 <?
									 }
								?>
								</A>								
							</TD>	
													
							 <TD class=hf width="60">
								<A href="index.php?option=others_total_request&task=others_total_request_pending&order=<? echo $item_type; ?>" style="text-decoration:underline"><B>Item Type </B>
								</A>
							</TD>
							<TD class=hf width="60">
								<B>Leaves </B>
							</TD>
							<TD class=hf width="80">
								<A href="index.php?option=others_total_request&task=others_total_request_pending&order=<? echo $others_severity; ?>" style="text-decoration:underline"><B>Delivery Type </B>
								</A>
							</TD>
							<TD class=hf align=lef>
								<B>Status</B>
							</TD>														
						  </TR>
					
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					<DIV class=syntax_hilite>
                  
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
        
                        <TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
                          <TBODY>
						  
						 
						  <?
							str($order);				
							//echo "testkkkk".$order;
							$order1="$order";						  
							if($order1=="")
								$query1="select * from aibl_others_rqst where others_rqst_status='pending' order by others_collecting_branch desc, item_type desc, others_total_leaf asc, others_approval_date_time desc";		
							else
								$query1="select * from aibl_others_rqst where others_rqst_status='pending' order by ".$order1;	
			
							$result1 = mysql_query($query1) or
							die(mysql_error());
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							$sl=1;
							//$result = select_entries_pending_excel($offset);
							while ($row =mysql_fetch_assoc($result1))
							{
								//$date=str_replace('-','/',$row['others_order_date_time']); 
								if(($row['others_approval_date_time'])!=0){
								$date=str_replace('-','/',$row['others_approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								$others_req_id[]=$row['others_rqst_id'];
								echo "<tr>	
								<td class=$class  align='center' width='44'>&nbsp;$sl&nbsp;&nbsp;&nbsp;<input type='checkbox' name='chk[]' value=".$row['others_rqst_id']." style='border-style:none'></td>							
								<td class=$class width='65'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_rqst_by']."</a></td>							
								<td class=$class width='80'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row[' 	others_approval_date_time']."</a></td>	
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['item_type']."</a></td>
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_total_leaf']." X ".$row['others_books']." Lvs</a></td>
								<td class=$class width='80'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$status</a></td>																
								</tr>";
								$sl++;
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}

						}
						if (mysql_num_rows($result1) != 0){
							foreach($others_req_id as $key=>$value) {
								$excelArray .= "id[$key]=$value&";
							}
						}
						?>  
						
						 
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					  
					  </DIV>
					  <TABLE width="100%">
					  
						  <TR>
							<TD  class=back colspan="9">
							<DIV  style="float:left; width:300;">										
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img class="selectallarrow" width="38" height="22" src="../aibl/images/arrow_ltr.png" alt="With selected:" />
							<i>With selected:</i>	
							<input type="hidden" name="do_order" value="do_order" />													
							<input type="submit" name="edit" value="Update Status" onclick="return isChk();"/>							
							</DIV>
							<DIV style="float:right; width:500;"><a href="../aibl/excel/others_excel.php?<? echo $excelArray; ?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download</font></b></a>
							</DIV>
							</TD>
						</TR>
					  </TABLE>
					  </form>
					 </TD></TR></TBODY></TABLE>
					
<?
}		

if(($option=='others_total_request')&&($task=='others_total_request_dispatched'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
}
</script>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Dispatched Cheque Book Information </B>
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
								<B>Dispatched Information</B>											
							</TD>
						  </TR>
                          <TR>
                            
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
								<B>Status</B>
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
							$sl=0;
							$result = select_entries_dispatched_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
								//$date=str_replace('-','/',$row['others_order_date_time']); 
								$dis_date=str_replace('-','/',$row['dispatch_datetime']); 
								
								//$date=str_replace('-','/',$row['others_order_date_time']); 
								if(($row['others_approval_date_time'])!=0){
								$date=str_replace('-','/',$row['others_approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								
								$others_req_id[]=$row['others_rqst_id'];
								echo "<tr>																								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row[' 	others_approval_date_time']."</a></td>								 
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['item_type']."-".$row['others_total_leaf']."X".$row['others_books']." Lvs</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_start_no']." - ".$row['others_end_no']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$status</a></td>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".date('M d, Y h:i a', strtotime($dis_date))."</a></td>																
								</tr>";
								$sl++;
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}

						}
						if (mysql_num_rows($result) != 0){
							foreach($others_req_id as $key=>$value) {
								$excelArray .= "id[$key]=$value&";
							}
						}
						?>  
						  <TR>
							<TD  class=back colspan="8">
							
							<center><?php nav_dispatched_excel($offset); ?> </center>										
							</TD>
						</TR>
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					  
					 </TD></TR></TBODY></TABLE>
					 <div align="center"><a href="../aibl/excel/dispatched_pagging.php?offset=<? echo $_REQUEST['offset']?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download as per page</font></b></a>
					 <a href="../aibl/excel/others_excel.php?<? echo $excelArray; ?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
<?
}								
?>
<?php

if(($option=='others_total_request')&&($task=='change_status'))
{
  															
					//$update_chk=$_POST['update_chk'];										
					//$c=count($update_chk);												
	  				
					if(isset($_POST['submit']))
					{	
								
						$update_ch=$_POST['update_chk'];	
						$others_start_no=$_POST['others_start_no'];
						$others_end_no=$_POST['others_end_no'];									
						$c=count($update_ch);	
																
						$dispatch_date_time=date('Y-m-d H:i:s a', strtotime($_POST['dispatch_date_time'])); 							
						
						
						if($_POST['req_status']=='ordered'){
							 for ($i=0; $i<$c; $i++)
						     {	
							   $update_req_query ="Update aibl_others_rqst set others_rqst_status='$_POST[req_status]' where others_rqst_id='$update_ch[$i]'";  																	
							   mysql_query($update_req_query) or die (mysql_error());								   
							 }
							 
							if($_POST['po_end_no']!=0){
									//echo 'PO'.$_POST['po_end_no'];
									$update_po_sl_query ="Update serial_no set end_no='$_POST[po_end_no]' where ac_type='PO'";  																
									mysql_query($update_po_sl_query) or die (mysql_error());
							 }
							 
							if($_POST['dd_end_no']!=0){
								   //echo 'DD'.$_POST['dd_end_no'];							
									$update_dd_sl_query ="Update serial_no set end_no='$_POST[dd_end_no]' where ac_type='DD'";  																
									mysql_query($update_dd_sl_query) or die (mysql_error());	
							 }
							 	
							 if($_POST['fdd_end_no']!=0){
									//echo 'FDD'.$_POST['fdd_end_no'];							
									$update_fdd_sl_query ="Update serial_no set end_no='$_POST[fdd_end_no]' where ac_type='FDD'";  																
									mysql_query($update_fdd_sl_query) or die (mysql_error());	
							 }	
							 
							 if($_POST['fdr_end_no']!=0){
									//echo 'FDR'.$_POST['fdr_end_no'];							
									$update_fdr_sl_query ="Update serial_no set end_no='$_POST[fdr_end_no]' where ac_type='FDR'";  																
									mysql_query($update_fdr_sl_query) or die (mysql_error());	
							 }	
							 
							 if($_POST['sdr_end_no']!=0){
									//echo 'SDR'.$_POST['sdr_end_no'];							
									$update_sdr_sl_query ="Update serial_no set end_no='$_POST[sdr_end_no]' where ac_type='SDR'";  																
									mysql_query($update_sdr_sl_query) or die (mysql_error());	
							 }	
							redirectUrl("index.php?option=others_total_request&task=others_total_request_pending&order=others_approval_date_time");
						}
						if($_POST['req_status']=='dispatched'){
						
							for ($i=0; $i<$c; $i++)
						    {
							$update_req_query ="Update aibl_others_rqst set others_rqst_status='$_POST[req_status]',others_dispatch_datetime='$dispatch_date_time' where others_rqst_id='$update_ch[$i]'";  										
							//echo "aaa".$_POST['req_status'];							
							mysql_query($update_req_query) or
							die (mysql_error());	
							redirectUrl("index.php?option=others_total_request&task=others_total_request_ordered&order=others_approval_date_time");
						   }
						
						}
							//mysql_query($update_req_query) or
							//die (mysql_error());		
					}	
											
						//redirectUrl("index.php?option=others_total_request&task=others_total_request_pending&order=others_approval_date_time"); 
																																												
																		
					?>	
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
                  
                  <FORM name="frmSl" action="index.php?option=others_total_request&task=change_status" method="post">
                  
							
				  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=left colSpan=4>
								<B>Edit Request Status </B>							
							</TD>
						  </TR>	
						  <? if ($_POST['do_order']=='do_order') {?>
						  
						  <?
							$ch=$_POST['chk'];										
							$c=count($ch);	
							//for ($i=0; $i<$c; $i++)
							$idlist = "";
							if ($c>0){
								foreach ($_POST[chk] as $key)
								{
									if(empty($idlist))
										{
										$idlist = $key;
										}
									else
										{
										$idlist = $idlist.",".$key;
									}
								
								}																																								
							}
							?>					  						 						  						  
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Status of request</span>:</TD>
							
							<TD class=back colspan="3">							  			
							 <input type="text" name="req_status" readonly="yes" value="<? echo 'ordered'; ?>"\>			
							 </TD>
						  </TR>	
						   
						   
						  <?
						  //-----------------------------------------------------------------------------
						  //*******************************************************************************************************************************************						
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from serial_no where ac_type='PO'"));
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(others_end_no) AS MaxNo from aibl_others_rqst where item_type='PO'"));										
										$result=mysql_query("select *from aibl_others_rqst where item_type='PO' and others_rqst_id in ($idlist) order by others_collecting_branch");
										$get_count_PO= mysql_num_rows($result);
																				
										while ($row=mysql_fetch_array($result))
										{										
											$lv[]=$row['others_total_leaf'];
											$kv[]=$row['others_rqst_id'];
											$av[]=$row['item_type'];	
											$books_PO[]=$row['others_books'];																						  											
										}
										$t=$get_max_no['MaxNo']+1;
										$a[0]=$t;																		
										$b[0]=($t+($row['others_total_leaf']*$books_PO[0]))+1;
																				
										for ($i=1; $i<$get_count_PO; $i++){											
											$a[$i]=$a[$i-1]+($lv[$i-1]*$books_PO[$i-1]);						
										}								
										for ($i=1; $i<$get_count_PO+1; $i++){																			
											$b[$i-1]=$a[$i-1]+($lv[$i-1]*$books_PO[$i-1])-1;
										}							
																																	
										for ($i=0; $i<$get_count_PO; $i++){										
											
										?>
										<input type="hidden" name="update_chk[]" value="<? echo $kv[$i]; ?>" />	
										<input type="hidden" name="po_end_no" value="<? echo max($b); ?>"/>
										 <TR>
                              				<TD class=back2 align=right width="35%"><span class="bodytext">PO Serial</span>:</TD>							
							  				<TD class=back colspan="3">
							  					Start No. <input type="text" name="others_start_no[]" maxlength="7" value="<? echo substr($a[$i]+10000000,1) ?>" size="7" onKeyUp="advance_end_no(this,'others_end_no');" />	
							  					&nbsp;End No. <input type="text" maxlength="7" size="7" value="<? echo substr($b[$i]+10000000,1) ?>" name="others_end_no[]" />															 		
												= <? echo $lv[$i]."X".$books_PO[$i]."=".$lv[$i]*$books_PO[$i];?>
											</TD>							 
						  				 </TR>
										<?
										}
				//*****************************************************************************************************************					
									
						 //*****************************************************************************************************************					
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from serial_no where ac_type='DD'"));
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(others_end_no) AS MaxNo from aibl_others_rqst where item_type='DD'"));										
										$result=mysql_query("select *from aibl_others_rqst where item_type='DD' and others_rqst_id in ($idlist) order by others_collecting_branch");
										$get_count_DD= mysql_num_rows($result);
																				
										while ($row=mysql_fetch_array($result))
										{										
											$lc[]=$row['others_total_leaf'];
											$kc[]=$row['others_rqst_id'];
											$ac[]=$row['item_type'];	
											$books_DD[]=$row['others_books'];																					  											
										}
										$t=$get_max_no['MaxNo']+1;
										$a_DD[0]=$t;																	
										$b_DD[0]=($t+($row['others_total_leaf']*$books_DD[0]))+1;	
																				
										for ($i=1; $i<$get_count_DD; $i++){										
											$a_DD[$i]=$a_DD[$i-1]+($lc[$i-1]*$books_DD[$i-1]);						
										}								
										for ($i=1; $i<$get_count_DD+1; $i++){																			
											$b_DD[$i-1]=$a_DD[$i-1]+($lc[$i-1]*$books_DD[$i-1])-1;
										}							
																																	
										for ($i=0; $i<$get_count_DD; $i++){										
											
										?>
										<input type="hidden" name="update_chk[]" value="<? echo $kc[$i]; ?>" />	
										<input type="hidden" name="dd_end_no" value="<? echo max($b_DD); ?>"/>
										 <TR>
                              				<TD class=back2 align=right width="35%"><span class="bodytext">DD Serial</span>:</TD>							
							  				<TD class=back colspan="3">
							  					Start No. <input type="text" name="others_start_no[]" maxlength="7" value="<? echo substr($a_DD[$i]+10000000,1) ?>" size="7" onKeyUp="advance_end_no(this,'others_end_no');" />	
							  					&nbsp;End No. <input type="text" maxlength="7" size="7" value="<? echo substr($b_DD[$i]+10000000,1) ?>" name="others_end_no[]" />															 		
												= <? echo $lc[$i]."X".$books_DD[$i]."=".$lc[$i]*$books_DD[$i];?>
											</TD>							 
						  				 </TR>
										<?
										}
																			  
						  //---------------------------------------------------------------------------------------------------------------------

						  //*****************************************************************************************************************					
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from serial_no where ac_type='FDD'"));
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(others_end_no) AS MaxNo from aibl_others_rqst where item_type='FDD'"));										
										$result=mysql_query("select *from aibl_others_rqst where item_type='FDD' and others_rqst_id in ($idlist) order by others_collecting_branch desc, item_type desc, others_total_leaf asc, others_approval_date_time desc");
										$get_count_FDD= mysql_num_rows($result);
																				
										while ($row=mysql_fetch_array($result))
										{										
											$lc_FDD[]=$row['others_total_leaf'];
											$kc_FDD[]=$row['others_rqst_id'];
											$ac_FDD[]=$row['item_type'];	
											$books_FDD[]=$row['others_books'];																					  											
										}
										$t=$get_max_no['MaxNo']+1;
										$a_FDD[0]=$t;																	
										$b_FDD[0]=($t+($row['others_total_leaf']*$books_FDD[0]))+1;	
																				
										for ($i=1; $i<$get_count_FDD; $i++){										
											$a_FDD[$i]=$a_FDD[$i-1]+($lc_FDD[$i-1]*$books_FDD[$i-1]);						
										}								
										for ($i=1; $i<$get_count_FDD+1; $i++){																			
											$b_FDD[$i-1]=$a_FDD[$i-1]+($lc_FDD[$i-1]*$books_FDD[$i-1])-1;
										}							
																																	
										for ($i=0; $i<$get_count_FDD; $i++){										
											
										?>
										<input type="hidden" name="update_chk[]" value="<? echo $kc_FDD[$i]; ?>" />
										<input type="hidden" name="fdd_end_no" value="<? echo max($b_FDD); ?>"/>	
										 <TR>
                              				<TD class=back2 align=right width="35%"><span class="bodytext">FDD Serial</span>:</TD>							
							  				<TD class=back colspan="3">
							  					Start No. <input type="text" name="others_start_no[]" maxlength="7" value="<? echo substr($a_FDD[$i]+10000000,1) ?>" size="7" onKeyUp="advance_end_no(this,'others_end_no');" />	
							  					&nbsp;End No. <input type="text" maxlength="7" size="7" value="<? echo substr($b_FDD[$i]+10000000,1) ?>" name="others_end_no[]" />															 		
												= <? echo $lc_FDD[$i]."X".$books_FDD[$i]."=".$lc_FDD[$i]*$books_FDD[$i];?>
											</TD>							 
						  				 </TR>
										<?
										}
										
								//*****************************************************************************************************************					
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from serial_no where ac_type='FDR'"));
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(others_end_no) AS MaxNo from aibl_others_rqst where item_type='FDR'"));										
										$result=mysql_query("select *from aibl_others_rqst where item_type='FDR' and others_rqst_id in ($idlist) order by others_collecting_branch");
										$get_count_FDR= mysql_num_rows($result);
																				
										while ($row=mysql_fetch_array($result))
										{										
											$lc_FDR[]=$row['others_total_leaf'];
											$kc_FDR[]=$row['others_rqst_id'];
											$ac_FDR[]=$row['item_type'];	
											$books_FDR[]=$row['others_books'];																					  											
										}
										$t=$get_max_no['MaxNo']+1;
										$a_FDR[0]=$t;																	
										$b_FDR[0]=($t+($row['others_total_leaf']*$books_FDR[0]))+1;	
																				
										for ($i=1; $i<$get_count_FDR; $i++){										
											$a_FDR[$i]=$a_FDR[$i-1]+($lc_FDR[$i-1]*$books_FDR[$i-1]);						
										}								
										for ($i=1; $i<$get_count_FDR+1; $i++){																			
											$b_FDR[$i-1]=$a_FDR[$i-1]+($lc_FDR[$i-1]*$books_FDR[$i-1])-1;
										}							
																																	
										for ($i=0; $i<$get_count_FDR; $i++){										
											
										?>
										<input type="hidden" name="update_chk[]" value="<? echo $kc_FDR[$i]; ?>" />
										<input type="hidden" name="fdr_end_no" value="<? echo max($b_FDR); ?>"/>	
										 <TR>
                              				<TD class=back2 align=right width="35%"><span class="bodytext">FDR Serial</span>:</TD>							
							  				<TD class=back colspan="3">
							  					Start No. <input type="text" name="others_start_no[]" maxlength="7" value="<? echo substr($a_FDR[$i]+10000000,1) ?>" size="7" onKeyUp="advance_end_no(this,'others_end_no');" />	
							  					&nbsp;End No. <input type="text" maxlength="7" size="7" value="<? echo substr($b_FDR[$i]+10000000,1) ?>" name="others_end_no[]" />															 		
												= <? echo $lc_FDR[$i]."X".$books_FDR[$i]."=".$lc_FDR[$i]*$books_FDR[$i];?>
											</TD>							 
						  				 </TR>
										<?
										}
																			  
						  //---------------------------------------------------------------------------------------------------------------------------------------
	
							 //*****************************************************************************************************************************************							
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from serial_no where ac_type='SDR'"));
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(others_end_no) AS MaxNo from aibl_others_rqst where item_type='SDR'"));										
										$result=mysql_query("select *from aibl_others_rqst where item_type='SDR' and others_rqst_id in ($idlist) order by others_collecting_branch");
										$get_count_SDR= mysql_num_rows($result);
																				
										while ($row=mysql_fetch_array($result))
										{										
											$l[]=$row['others_total_leaf'];
											$k[]=$row['others_rqst_id'];
											$h[]=$row['item_type'];
											$others_books[]=$row['others_books'];																						  											
										}
										$t=$get_max_no['MaxNo']+1;
										$a_SDR[0]=$t;							
										$b_SDR[0]=($t+($row['others_total_leaf']*$others_books[0]))+1;	
															
										for ($i=1; $i<$get_count_SDR; $i++){
											$a_SDR[$i]=$a_SDR[$i-1]+($l[$i-1]*$others_books[$i-1]);							
										}								
										for ($i=1; $i<$get_count_SDR+1; $i++){								
											$b_SDR[$i-1]=$a_SDR[$i-1]+($l[$i-1]*$others_books[$i-1])-1;
										}							
																																	
										for ($i=0; $i<$get_count_SDR; $i++){		
											
										?>
										<input type="hidden" name="update_chk[]" value="<? echo $k[$i]; ?>" />	
										<input type="hidden" name="sdr_end_no" value="<? echo max($b_SDR); ?>"/>
										<TR>
                              				<TD class=back2 align=right width="35%"><span class="bodytext">SDR Serial</span>:</TD>							
							  				<TD class=back colspan="3">
							  					Start No. <input type="text" name="others_start_no[]" maxlength="7" value="<? echo substr($a_SDR[$i]+10000000,1) ?>" size="7" onKeyUp="advance_end_no(this,'others_end_no');" />	
							  					&nbsp;End No. <input type="text" maxlength="7" size="7" value="<? echo substr($b_SDR[$i]+10000000,1) ?>" name="others_end_no[]" />					
										 		= <? echo $l[$i]."X".$others_books[$i]."=".$l[$i]*$others_books[$i];?>
											</TD>							 
						  				 </TR>										
										 <?
										// }
										 
										}									  
						  //---------------------------------------------------------------------------------------

						  }
						   if ($_POST['do_dispached']=='do_dispached'){
						  ?>
						  <?
							$ch=$_POST['chk'];										
							$c=count($ch);	
							//for ($i=0; $i<$c; $i++)
							$idlist = "";
							if ($c>0){
								foreach ($_POST[chk] as $key)
								{
									if(empty($idlist))
										{
										$idlist = $key;
										}
									else
										{
										$idlist = $idlist.",".$key;
									}
									?>
								<input type="hidden" name="update_chk[]" value="<? echo $key; ?>" />
								
								<?
								}																																								
							}
							?>
						  <TR>						  
                            <TD class=back2 align=right width="35%"><span class="bodytext">Status of request</span>:</TD>
							
							<TD class=back colspan="3">
							  <input type="text" name="req_status" readonly="yes" value="<? echo 'dispatched'; ?>"\>								
							 </TD>
						  </TR>	
                          	<TD class=back2 align=right width="35%">Dispatch Date & Time: </TD>
                            <TD class=back colspan="3">		
							<?							
								$FDD_date=date("M d, Y g:i a"); 
								 
								?>	
																										
								<input type="text" name="dispatch_date_time" value="<? echo $FDD_date; ?>" id="sel2" size="30">
								<img src="../aibl/body_content/calender/themes/icons/b_calendar.png" align="absmiddle" id="button2" style="FDDsor: pointer;" alt="Calendar" title="Date selector" />	
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
										var cal = new Zapatec.Calendar.setup({
		
											inputField     :    "sel2",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											ifFormat       :    '%b %e, %Y %I:%M %P',     // format of the input field
											showsTime      :     true,     // show time as well as date
											button         :    "button2"  // trigger button 

										});
		
									</script>
					
							</TD>
						  </TR>	
						  <? } ?>
						  			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
                  
                  <CENTER>
                  <input type="submit" value="Update Status" name="submit"/>
				  
				  <!--<input type="submit" value="Update Task" name="submit" onclick='return VendorInput_validate();'/>-->
                  <INPUT type="Reset" value="Reset">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</FORM>
				  </CENTER></TD></TR></TBODY></TABLE>
<?

}
if(($option=='others_total_request')&&($task=='others_total_request_delivered'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
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
								<B>Delivered Information</B>											
							</TD>
						  </TR>
                          <TR>
                            
							  <TD class=hf align=left>
								<B>Req. Branch </B>						
							</TD>
							 <TD class=hf align=lef>
								<B>Approved Date</B>								
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
							<TD class=hf align=lef>
								<B>Delivered Date</B>
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
								//$date=str_replace('-','/',$row['others_order_date_time']); 
								$del_date=str_replace('-','/',$row['delivered_datetime']); 
								
								//$date=str_replace('-','/',$row['others_order_date_time']); 
								if(($row['others_approval_date_time'])!=0){
								$date=str_replace('-','/',$row['others_approval_date_time']); 
								$date=date('M d, Y h:i', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								
								$others_req_id[]=$row['others_rqst_id'];
								echo "<tr>																								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row[' 	others_approval_date_time']."</a></td>								 
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['item_type']."-".$row['others_total_leaf']."X".$row['others_books']." Lvs</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_start_no']." - ".$row['others_end_no']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$status</a></td>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".date('M d, Y h:i', strtotime($del_date))."</a></td>																
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}

						}
						if (mysql_num_rows($result) != 0){
							foreach($others_req_id as $key=>$value) {
								$excelArray .= "id[$key]=$value&";
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
					 <div align="center"><a href="../aibl/excel/delivered_pagging.php?offset=<? echo $_REQUEST['offset']?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download as per page</font></b></a>
					 <a href="../aibl/excel/others_excel.php?<? echo $excelArray; ?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
<?
}	

if(($option=='others_total_request')&&($task=='others_total_request_approval'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
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
								//$date=str_replace('-','/',$row['others_order_date_time']); 
								if(($row['others_order_date_time'])!=0){
								$date=str_replace('-','/',$row['others_order_date_time']); 
								$date=date('M d, Y h:i', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row[' 	others_order_date_time']."</a></td>								 
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
	window.open('../aibl/body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
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
							$query = "select * from aibl_others_rqst where others_rqst_status='reject'  order by  others_order_date_time desc";
							$result = mysql_query($query);
							//$result = select_entries_delivered_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
								//$date=str_replace('-','/',$row['others_order_date_time']); 
								if(($row['others_order_date_time'])!=0){
								$date=str_replace('-','/',$row['others_order_date_time']); 
								$date=date('M d, Y h:i', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row[' 	others_order_date_time']."</a></td>								 
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
?>
	
	  

	
	  
