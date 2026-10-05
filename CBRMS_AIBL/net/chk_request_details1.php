<?php
include_once ("../../config.php");
include_once ("../../tex_common.php");

if (empty($_SESSION['user_name']))
{	
	redirectUrl('net_signin.php?msg=signin');
}

$task=$_REQUEST['task'];
$option=$_REQUEST['option'];

//include ("../aibl/pagging/pagging_excel.php");
//include ("../aibl/pagging/ordered_pagging_excel.php");
//include ("../aibl/pagging/pending_pagging_excel.php");
//include ("../aibl/pagging/dispatched_pagging_excel.php");
//include ("../aibl/pagging/delivered_pagging_excel.php");
?>
<SCRIPT language=javascript1.2 src="../aibl/js/common.js" type=text/javascript></SCRIPT>
<SCRIPT type=text/javascript>
function advance_end_no(currentField,nextField) {   
	if (currentField.value.length == 7)
        document.frmSl[nextField].focus();
}

</SCRIPT>
<?
if(($option=='total_request')&&($task=='total_request_admin'))

{
		
?>
<script language="javascript">

function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
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
								<B>Account No </B>
							</TD>							
							 <TD class=hf align=lef>
								<B>Account Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Start - End Chq. No </B>
							</TD>
							<TD class=hf align=lef>
								<B>Del. Type </B>
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
								<td class=$class width='137'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['approval_date_time']."</a></td>
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
					 <div align="center"><a href="../aibl/excel/total_request_excel.php?offset=<? echo $_REQUEST['offset']?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download as per page</font></b></a>
					 <a href="../aibl/excel/excel.php"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
<?
}

if(($option=='total_request')&&($task=='total_request_ordered'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
}
</script>
                 
                  <form name="frmChk" method="post" action="index.php?option=total_request&task=change_status"> 
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
		$fieldlist[0] = "collecting_branch";
		$fieldlist[1] = "severity"; 
		$fieldlist[2] = "ac_type"; 
		$fieldlist[3] = "rqst_status"; 
		$fieldlist[4] = "approval_date_time";			
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
		$fieldlist[0] = "collecting_branch";
		$fieldlist[1] = "severity"; 
		$fieldlist[2] = "ac_type"; 
		$fieldlist[3] = "rqst_status"; 
		$fieldlist[4] = "approval_date_time";
		
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
                             <TD width="57"  class="hf" align="center">							 
								&nbsp;<B>#</B>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkall" onclick="checkedAll(frmChk);">						
							</TD>
							 <TD class=hf  width="65">
								<B>Maker ID </B>
							</TD>
							 <TD class=hf  width="80">
								<A href="index.php?option=total_request&task=total_request_ordered&order=<? echo $collecting_branch; ?>" style="text-decoration:underline"><B>Req. Branch </B>						
								</A>
							</TD>
							 <TD class=hf width="115">
								<A href="index.php?option=total_request&task=total_request_ordered&order=<? echo $approval_date_time; ?>" style="text-decoration:underline"><B>Approved Date</B>
								<? if ($approval_date_time =="approval_date_time_up") {?> <img src="<? echo $s_asc ?>" border="0" align="absmiddle" /><? 
								}
								if ($approval_date_time =="approval_date_time_down")
									{
								?>
									 <img src="<? echo $s_desc ?>" border="0" align="absmiddle" />
									 <?
									 }
								?>
								</A>								
							</TD>	
							<TD class=hf width="100">
								<B>Account No </B>
							</TD>							
							 <TD class=hf width="60">
								<A href="index.php?option=total_request&task=total_request_ordered&order=<? echo $ac_type; ?>" style="text-decoration:underline"><B>A/C Type </B>
								</A>
							</TD>
							<TD class=hf width="60">
								<B>Leaves </B>
							</TD>
							<TD class=hf width="100">
								<B>Star - End No </B>
							</TD>
							<TD class=hf width="60">
								<A href="index.php?option=total_request&task=total_request_ordered&order=<? echo $severity; ?>" style="text-decoration:underline"><B>Del. Type </B>
								</A>
							</TD>
							<TD class=hf align=lef>
								<B>Status</B>
							</TD>														
						  </TR>
					
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					<DIV class="syntax_hilite" style="width:100%;">
                  
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
								$query1="select * from aibl_chq_rqst where rqst_status='ordered' order by collecting_branch desc, ac_type desc, total_leaf asc, approval_date_time desc";		
							else
								$query1="select * from aibl_chq_rqst where rqst_status='ordered' order by ".$order1;		
					
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
								if(($row['approval_date_time'])!=0){
								$date=str_replace('-','/',$row['approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								
								echo "<tr>	
								<td class=$class  align='center' width='55'>&nbsp;$sl&nbsp;&nbsp;&nbsp;<input type='checkbox' name='chk[]' value=".$row['rqst_id']." style='border-style:none'></td>							
								<td class=$class width='65'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>							
								<td class=$class width='80'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class width='137'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['approval_date_time']."</a></td>
								<td class=$class width='100'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."".$row['ac_no_suffix']."".$row['ac_no_cus_no']."</a></td>								
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."</a></td>
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['total_leaf']." X ".$row['books']." Lvs</a></td>
								<td class=$class width='100'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['start_no']." - ".$row['end_no']."</a></td>
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$status</a></td>																
								</tr>";
								$sl++;
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}
						}
						
						$query2="select distinct collecting_branch_code from aibl_chq_rqst where rqst_status='ordered' order by collecting_branch asc";
						$result2 = mysql_query($query2) or
						die(mysql_error());
						if (mysql_num_rows($result2) != 0){
							while ($row =mysql_fetch_assoc($result2))
							{
								$branch_code[]=$row['collecting_branch_code'];
							}
							foreach($branch_code as $key=>$value) {
								$strArray .= "id[$key]=$value&";
							}
						}
						?>  
						</TBODY></TABLE></TD></TR></TBODY></TABLE>
					  
					  </DIV>
					  <TABLE width="100%">
						  <TR>
							<TD  class=back colspan="9">
							<DIV  style="float:left; width:600;" align="center">
							
							
							<a href="../aibl/excel/challan_excel.php?<? echo $strArray; ?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Excel Challan</font></b></a>
							
							<a href="../aibl/excel/personalisation.php?ac_type=<? echo 'Current' ?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">CD MICR</font></b></a>
							<a href="../aibl/excel/personalisation.php?ac_type=<? echo 'Savings' ?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">SB MICR</font></b></a>
							<a href="../aibl/excel/personalisation.php?ac_type=<? echo 'Imperial' ?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Imperial MICR</font></b></a>	
													
						
							<a href="../aibl/excel/ordered_all.php"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">PSI</font></b></a>
							<a href="../aibl/excel/ordered_all_imp.php"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">PSI_imperial</font></b></a>
							</DIV>			
							</TD>
						</TR>											  	 			  
					  </TABLE>
					   </form>
					 </TD></TR></TBODY></TABLE>
					 
<?
}
					
if(($option=='total_request')&&($task=='total_request_pending'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
}

</script> 
                  
				 <form name="frmChk" method="post" action="index.php?option=total_request&task=change_status"> 
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
		$fieldlist[0] = "collecting_branch";
		$fieldlist[1] = "severity"; 
		$fieldlist[2] = "ac_type"; 
		$fieldlist[3] = "rqst_status"; 
		$fieldlist[4] = "approval_date_time";			
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
		$fieldlist[0] = "collecting_branch";
		$fieldlist[1] = "severity"; 
		$fieldlist[2] = "ac_type"; 
		$fieldlist[3] = "rqst_status"; 
		$fieldlist[4] = "approval_date_time";
		
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
                             <TD width="56"  class="hf" align="center">							 
								&nbsp;<B>#</B>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkall" onclick="checkedAll(frmChk);">						
							</TD>
							 <TD class=hf  width="65">
								<B>Maker ID </B>
							</TD>
							 <TD class=hf  width="80">
								<A href="index.php?option=total_request&task=total_request_pending&order=<? echo $collecting_branch; ?>" style="text-decoration:underline"><B>Req. Branch </B>						
								</A>
							</TD>
							 <TD class=hf width="137">
								<A href="index.php?option=total_request&task=total_request_pending&order=<? echo $approval_date_time; ?>" style="text-decoration:underline"><B>Approved Date & Time</B>
								<? if ($approval_date_time =="approval_date_time_up") {?> <img src="<? echo $s_asc ?>" border="0" align="absmiddle" /><? 
								}
								if ($approval_date_time =="approval_date_time_down")
									{
								?>
									 <img src="<? echo $s_desc ?>" border="0" align="absmiddle" />
									 <?
									 }
								?>
								</A>								
							</TD>	
							<TD class=hf width="100">
								<B>Account No </B>
							</TD>							
							 <TD class=hf width="60">
								<A href="index.php?option=total_request&task=total_request_pending&order=<? echo $ac_type; ?>" style="text-decoration:underline"><B>A/C Type </B>
								</A>
							</TD>
							<TD class=hf width="60">
								<B>Start No. </B>
							</TD>
							<TD class=hf width="60">
								<B>Leaves </B>
							</TD>
							<TD class=hf width="60">
								<B>End No. </B>
							</TD>
							<TD class=hf width="80">
								<A href="index.php?option=total_request&task=total_request_pending&order=<? echo $severity; ?>" style="text-decoration:underline"><B>Delivery Type </B>
								</A>
							</TD>
							<TD class=hf align=lef>
								<B>Status</B>
							</TD>														
						  </TR>
					
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					<DIV class="syntax_hilite" style="width:100%">
                  
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
								$query1="select * from aibl_chq_rqst where rqst_status='pending' order by collecting_branch asc, ac_type desc, total_leaf asc, approval_date_time desc";		
							else
								$query1="select * from aibl_chq_rqst where rqst_status='pending' order by ".$order1;	
			
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
								<td class=$class  align='center' width='54'>&nbsp;$sl&nbsp;&nbsp;&nbsp;<input type='checkbox' name='chk[]' value=".$row['rqst_id']." style='border-style:none'></td>							
								<td class=$class width='65'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>							
								<td class=$class width='80'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class width='137'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['approval_date_time']."</a></td>
								<td class=$class width='101'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>								
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."</a></td>
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['start_no']."</a></td>
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['total_leaf']." X ".$row['books']." Lvs</a></td>
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['end_no']."</a></td>
								<td class=$class width='80'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$status</a></td>																
								</tr>";
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
					  <TABLE width="100%">
					  
						  <TR>
							<TD  class=back colspan="9">
							<DIV  style="float:left; width:300;">										
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img class="selectallarrow" width="38" height="22" src="../aibl/images/arrow_ltr.png" alt="With selected:" />
							<i>With selected:</i>	
							<input type="hidden" name="do_order" value="do_order" />													
							<input type="submit" name="edit" value="Update Status" onclick="return isChk();"/>							
							</DIV>
							<DIV style="float:right; width:500;"><a href="../aibl/excel/pending_all.php"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download</font></b></a>
							</DIV>
							</TD>
						</TR>
					  </TABLE>
					  </form>
					 </TD></TR></TBODY></TABLE>
					
<?
}		

if(($option=='total_request')&&($task=='total_request_dispatched'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
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
																							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class width='137'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['approval_date_time']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."-".$row['total_leaf']."X".$row['books']." Lvs</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['start_no']." - ".$row['end_no']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$status</a></td>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".date('M d, Y h:i a', strtotime($dis_date))."</a></td>																
								</tr>";
								$sl++;
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
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
					 <a href="../aibl/excel/dispatched_all.php"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
<?
}								
?>
<?php

if(($option=='total_request')&&($task=='change_status'))
{
  															
					//$update_chk=$_POST['update_chk'];										
					//$c=count($update_chk);												
	  				
					if(isset($_POST['submit']))
					{	
								
						$ac_type=$_POST['ac_type'];
						$update_ch=$_POST['update_chk'];	
						$start_no=$_POST['start_no'];
						$end_no=$_POST['end_no'];									
						$c=count($update_ch);	
																
						$dispatch_date_time=date('Y-m-d H:i:s a', strtotime($_POST['dispatch_date_time'])); 							
						
						//echo  "type".$ac_type."s--".$start_no[$i]."e".$end_no[$i]."----"."sss".max($start_no)."eee".max($end_no)."<br>";
						
							if($_POST['req_status']=='ordered'){							
							
							for ($i=0; $i<$c; $i++)
							{						
								$update_req_query ="Update aibl_chq_rqst set rqst_status='$_POST[req_status]' where rqst_id='$update_ch[$i]'";  																	
								mysql_query($update_req_query) or
								die (mysql_error());								
							}
							
							
														
								redirectUrl("index.php?option=psi_print&task=total_request_pending&order=approval_date_time");
							}
							
							if($_POST['req_status']=='dispatched'){
							
								for ($i=0; $i<$c; $i++)
								{
									$update_req_query ="Update aibl_chq_rqst set rqst_status='$_POST[req_status]',dispatch_datetime='$dispatch_date_time' where rqst_id='$update_ch[$i]'";  										
									//echo "aaa".$_POST['req_status'];
							
									mysql_query($update_req_query) or
									die (mysql_error());	
									redirectUrl("index.php?option=total_request&task=total_request_ordered&order=approval_date_time");
								}
							
							}	
																																		
					}													
					?>	
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
                  
                  <FORM name="frmSl" action="index.php?option=total_request&task=change_status" method="post">
                  
							
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
										$get_max_no = mysql_fetch_array(mysql_query("select start_no from aibl_chq_rqst where ac_type='Savings'"));										
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(end_no) AS MaxNo from aibl_chq_rqst where ac_type='Savings'"));										
										$result=mysql_query("select *from aibl_chq_rqst where ac_type='Savings' and total_leaf='20' and rqst_id in ($idlist) order by collecting_branch");
										$get_count_Savings= mysql_num_rows($result);
																				
										while ($row=mysql_fetch_array($result))
										{										
											$br_sav[]=$row['collecting_branch'];
											$lv[]=$row['total_leaf'];
											$kv[]=$row['rqst_id'];
											$av[]=$row['ac_type'];	
											$books_Savings[]=$row['books'];																						  											
										}
										$t=$get_max_no['MaxNo']+1;
										$a_SAV[0]=$t;																		
										$b_SAV[0]=($t+($row['total_leaf']*$books_Savings[0]))+1;
																				
										for ($i=1; $i<$get_count_Savings; $i++){											
											$a_SAV[$i]=$a_SAV[$i-1]+($lv[$i-1]*$books_Savings[$i-1]);						
										}								
										for ($i=1; $i<$get_count_Savings+1; $i++){																			
											$b_SAV[$i-1]=$a_SAV[$i-1]+($lv[$i-1]*$books_Savings[$i-1])-1;
										}							
																																	
										for ($i=0; $i<$get_count_Savings; $i++){										
											//echo "<br>ID".$get_count_Current;
											//echo "<br>ID".$kv[$i];
											//echo ",  A/C Type :".$av[$i].",  Leaves :".$lv[$i].",  Start No :".($get_max_no['MaxNo']+1).",  End No :".($get_max_no['MaxNo']+$lv[$i])."<br>";
										?>
										<input type="hidden" name="update_chk[]" value="<? echo $kv[$i]; ?>" />	
										<input type="hidden" name="ac_type[]" value="Savings" />
										 <input type="hidden" name="sav_end_no" value="<? echo max($b_SAV); ?>"/>
										 <TR>
                              				<TD class=back2 align=right width="35%"><span style="color:#0000FF;">SB 20 Cheque Serial</span>:</TD>							
							  				<TD class=back colspan="3">
							  					<span style="color:#0000FF;">Start No.</span> <input type="text" name="start_no[]" maxlength="7" value="<? echo $row['start_no'] ?>" size="7" onKeyUp="advance_end_no(this,'end_no');" />	
							  					&nbsp;<span style="color:#0000FF;">End No. </span><input type="text" maxlength="7" size="7" value="<? echo $row['end_no'] ?>" name="end_no[]" />															 		
												= <? echo $lv[$i]."X".$books_Savings[$i]."=".$lv[$i]*$books_Savings[$i]."-".$av[$i]."-".$br_sav[$i];?>
											</TD>							 
						  				 </TR>
										<?
										}
				//*******************************************************************************************************************************************************			
		
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from aibl_chq_rqst where ac_type='Current'"));										
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(end_no) AS MaxNo from aibl_chq_rqst where ac_type='Current'"));										
										$result=mysql_query("select *from aibl_chq_rqst where ac_type='Current' and total_leaf='25' and rqst_id in ($idlist) order by collecting_branch");
										$get_count_Current= mysql_num_rows($result);
																				
										while ($row=mysql_fetch_array($result))
										{										
											$br[]=$row['collecting_branch'];
											$lc[]=$row['total_leaf'];
											$kc[]=$row['rqst_id'];
											$ac[]=$row['ac_type'];	
											$books_Current[]=$row['books'];																					  											
										}
										$t=$get_max_no['MaxNo']+1;
										$a[0]=$t;																	
										$b[0]=($t+($row['total_leaf']*$books_Current[0]))+1;	
																				
										for ($i=1; $i<$get_count_Current; $i++){										
											$a[$i]=$a[$i-1]+($lc[$i-1]*$books_Current[$i-1]);						
										}								
										for ($i=1; $i<$get_count_Current+1; $i++){																			
											$b[$i-1]=$a[$i-1]+($lc[$i-1]*$books_Current[$i-1])-1;
										}							
																																	
										for ($i=0; $i<$get_count_Current; $i++){										
											//echo "<br>ID".$get_count_Current;
											//echo "<br>ID".$kc[$i];
											//echo ",  A/C Type :".$ac[$i].",  Leaves :".$lc[$i].",  Start No :".($get_max_no['MaxNo']+1).",  End No :".($get_max_no['MaxNo']+$lc[$i])."<br>";
										?>
										<input type="hidden" name="update_chk[]" value="<? echo $kc[$i]; ?>" />	
										 <input type="hidden" name="ac_type[]" value="Current" />
										 <input type="hidden" name="cur_end_no" value="<? echo max($b); ?>"/>
										 <TR>
                              				<TD class=back2 align=right width="35%"><span class="bodytext">CD 25 Cheque Serial</span>:</TD>							
							  				<TD class=back colspan="3">
							  					Start No. <input type="text" name="start_no[]" maxlength="7" value="<? echo $row['start_no'] ?>" size="7" onKeyUp="advance_end_no(this,'end_no');" />	
							  					&nbsp;End No. <input type="text" maxlength="7" size="7" value="<? echo $row['end_no'] ?>" name="end_no[]" />															 		
												= <? echo $lc[$i]."X".$books_Current[$i]."=".$lc[$i]*$books_Current[$i]."-".$ac[$i]."-".$br[$i];?>
											</TD>							 
						  				 </TR>
										<?
										}
											
										//*******************************************************************************************************************************************************			
		
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from aibl_chq_rqst where ac_type='Current50'"));										
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(end_no) AS MaxNo from aibl_chq_rqst where ac_type='Current'"));										
										$result=mysql_query("select *from aibl_chq_rqst where ac_type='Current' and total_leaf='50' and rqst_id in ($idlist) order by collecting_branch");
										$get_count_Current= mysql_num_rows($result);
																				
										while ($row=mysql_fetch_array($result))
										{										
											$br_50[]=$row['collecting_branch'];
											$lc_50[]=$row['total_leaf'];
											$kc_50[]=$row['rqst_id'];
											$ac_50[]=$row['ac_type'];	
											$books_Current50[]=$row['books'];																					  											
										}
										$t=$get_max_no['MaxNo']+1;
										$a_50[0]=$t;																	
										$b_50[0]=($t+($row['total_leaf']*$books_Current50[0]))+1;	
																				
										for ($i=1; $i<$get_count_Current; $i++){										
											$a_50[$i]=$a_50[$i-1]+($lc_50[$i-1]*$books_Current50[$i-1]);						
										}								
										for ($i=1; $i<$get_count_Current+1; $i++){																			
											$b_50[$i-1]=$a_50[$i-1]+($lc_50[$i-1]*$books_Current50[$i-1])-1;
										}							
																																	
										for ($i=0; $i<$get_count_Current; $i++){										
											//echo "<br_50>ID".$get_count_Current;
											//echo "<br_50>ID".$kc_50[$i];
											//echo ",  A/C Type :".$ac_50[$i].",  Leaves :".$lc_50[$i].",  Start No :".($get_max_no['MaxNo']+1).",  End No :".($get_max_no['MaxNo']+$lc_50[$i])."<br_50>";
										?>
										<input type="hidden" name="update_chk[]" value="<? echo $kc_50[$i]; ?>" />	
										 <input type="hidden" name="ac_type[]" value="Current50" />
										 <input type="hidden" name="cur50_end_no" value="<? echo max($b_50); ?>"/>
										 <TR>
                              				<TD class=back2 align=right width="35%"><span style="color:#990000;">CD 50 Cheque Serial</span>:</TD>							
							  				<TD class=back colspan="3">
							  					<span style="color:#990000;">Start No.</span> <input type="text" name="start_no[]" maxlength="7" value="<?  echo $row['start_no'] ?>" size="7" onKeyUp="advance_end_no(this,'end_no');" />	
							  					&nbsp;<span style="color:#990000;">End No. </span><input type="text" maxlength="7" size="7" value="<? echo $row['end_no']  ?>" name="end_no[]" />															 		
												= <? echo $lc_50[$i]."X".$books_Current50[$i]."=".$lc_50[$i]*$books_Current50[$i]."-".$ac_50[$i]."-".$br_50[$i];?>
											</TD>							 
						  				 </TR>
										<?
										}	
															  
						  //---------------------------------------------------------------------------------------
						  //*******************************************************************************************************************************************************			
		
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from aibl_chq_rqst where ac_type='Imperial'"));										
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(end_no) AS MaxNo from aibl_chq_rqst where ac_type='Imperial'"));										
										$result=mysql_query("select *from aibl_chq_rqst where ac_type='Imperial' and total_leaf='20' and rqst_id in ($idlist) order by collecting_branch");
										$get_count_Imperial= mysql_num_rows($result);
																				
										while ($row=mysql_fetch_array($result))
										{										
											$br_20[]=$row['collecting_branch'];
											$lc_20[]=$row['total_leaf'];
											$kc_20[]=$row['rqst_id'];
											$ac_20[]=$row['ac_type'];	
											$books_Imperial[]=$row['books'];																					  											
										}
										$t=$get_max_no['MaxNo']+1;
										$a_20[0]=$t;																	
										$b_20[0]=($t+($row['total_leaf']*$books_Imperial[0]))+1;	
																				
										for ($i=1; $i<$get_count_Imperial; $i++){										
											$a_20[$i]=$a_20[$i-1]+($lc_20[$i-1]*$books_Imperial[$i-1]);						
										}								
										for ($i=1; $i<$get_count_Imperial+1; $i++){																			
											$b_20[$i-1]=$a_20[$i-1]+($lc_20[$i-1]*$books_Imperial[$i-1])-1;
										}							
																																	
										for ($i=0; $i<$get_count_Imperial; $i++){										
											//echo "<br_20>ID".$get_count_Imperial;
											//echo "<br_20>ID".$kc_20[$i];
											//echo ",  A/C Type :".$ac_20[$i].",  Leaves :".$lc_20[$i].",  Start No :".($get_max_no['MaxNo']+1).",  End No :".($get_max_no['MaxNo']+$lc_20[$i])."<br_20>";
										?>
										<input type="hidden" name="update_chk[]" value="<? echo $kc_20[$i]; ?>" />	
										 <input type="hidden" name="ac_type[]" value="Imperial" />
										 <input type="hidden" name="card20_end_no" value="<? echo max($b_20); ?>"/>
										 <TR>
                              				<TD class=back2 align=right width="35%"><span style="color:#000099">Imperial 20 Serial</span>:</TD>							
							  				<TD class=back colspan="3">
							  					<span style="color:#000099;">Start No.</span> <input type="text" name="start_no[]" maxlength="7" value="<?  echo $row['start_no'] ?>" size="7" onKeyUp="advance_end_no(this,'end_no');" />	
							  					&nbsp;<span style="color:#000099;">End No. </span><input type="text" maxlength="7" size="7" value="<? echo $row['end_no']  ?>" name="end_no[]" />															 		
												= <? echo $lc_20[$i]."X".$books_Imperial[$i]."=".$lc_20[$i]*$books_Imperial[$i]."-".$ac_20[$i]."-".$br_20[$i];?>
											</TD>							 
						  				 </TR>
										<?
										}
																			  
									  
						  //---------------------------------------------------------------------------------------
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
								$cur_date=date("M d, Y g:i a"); 
								 
								?>	
																										
								<input type="text" name="dispatch_date_time" value="<? echo $cur_date; ?>" id="sel2" size="30">
								<img src="../aibl/body_content/calender/themes/icons/b_calendar.png" align="absmiddle" id="button2" style="cursor: pointer;" alt="Calendar" title="Date selector" />	
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
if(($option=='total_request')&&($task=='total_request_delivered'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
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
								<B>Account No </B>
							</TD>
							
							 <TD class=hf align=lef>
								<B>Account Type </B>
							</TD>
							<TD class=hf width="100">
								<B>Star - End No </B>
							</TD>
							<TD class=hf align=lef>
								<B>Del. Type </B>
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
								//$date=str_replace('-','/',$row['order_date_time']); 
								$del_date=str_replace('-','/',$row['delivered_datetime']); 
								
								//$date=str_replace('-','/',$row['order_date_time']); 
								if(($row['approval_date_time'])!=0){
								$date=str_replace('-','/',$row['approval_date_time']); 
								$date=date('M d, Y h:i', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								echo "<tr>	
																							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$date</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."-".$row['total_leaf']."X".$row['books']." Lvs</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['start_no']." - ".$row['end_no']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$status</a></td>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".date('M d, Y h:i', strtotime($del_date))."</a></td>																
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
					 <div align="center"><a href="../aibl/excel/delivered_pagging.php?offset=<? echo $_REQUEST['offset']?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download as per page</font></b></a>
					 <a href="../aibl/excel/delivered_all.php"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
<?
}	

if(($option=='total_request')&&($task=='total_request_approval'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
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
							$query = "select * from aibl_chq_rqst where rqst_status='approval'  order by  order_date_time desc";
							$result = mysql_query($query);
							//$result = select_entries_delivered_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
								//$date=str_replace('-','/',$row['order_date_time']); 
								if(($row['order_date_time'])!=0){
								$date=str_replace('-','/',$row['order_date_time']); 
								$date=date('M d, Y h:i', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$date</a></td>
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
					 <a href="excel/delivered_all.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
					-->
<?
}								
	
if(($option=='total_request')&&($task=='total_request_reject'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
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
							$query = "select * from aibl_chq_rqst where rqst_status='reject'  order by  order_date_time desc";
							$result = mysql_query($query);
							//$result = select_entries_delivered_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
								//$date=str_replace('-','/',$row['order_date_time']); 
								if(($row['order_date_time'])!=0){
								$date=str_replace('-','/',$row['order_date_time']); 
								$date=date('M d, Y h:i', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								
								echo "<tr>	
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>							
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$date</a></td>
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
					 <a href="excel/delivered_all.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
					-->
<?
}								
?>	  
