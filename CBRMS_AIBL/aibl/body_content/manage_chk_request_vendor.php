<?php
include_once ("../config.php");
include_once ("../tex_common.php");
$task=$_REQUEST['task'];
$option=$_REQUEST['option'];

if(($option!='manage_chk_request_vendor')&&($task=='update_chq_request_vendor'))
	{
	?>
	
	<link href="style/user-style.css" rel="stylesheet" type="text/css">
	<SCRIPT language=javascript1.2 src="js/common.js" type=text/javascript></SCRIPT>	
	
	<script language="javascript" type="text/javascript"> 
function showTable(theTable)
{     	  
	 if (document.getElementById(theTable).style.display == 'none')
     {
          document.getElementById(theTable).style.display = 'block';		 
     }
}


function hideTable(theTable)
{
     
	 if (document.getElementById(theTable).style.display == 'none')
     {
          document.getElementById(theTable).style.display = 'none';
		  
     }
	 
     else
     {
          document.getElementById(theTable).style.display = 'none';
	 	//document.frmCheque.dispatch_date_time.value=" ";
     }
}
</SCRIPT>
	
				<FORM name="frmCheque" action="index.php?task=update_chq_request_vendor&rqst_id=<? echo  $_REQUEST['rqst_id']; ?>" method="post">
                 <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				  
				  <?
				
					$req_id=$_REQUEST['rqst_id'];
					$sql = "select *from aibl_chq_rqst  where rqst_id= '".$req_id."'";
    				$sql_result = mysql_query($sql)
					or die("Couldn't execute query.");
															
					
					if (!$sql_result) {
					echo "<P>Couldn't get item!";
					} 
					else {
						$get_req = mysql_fetch_array($sql_result);
						$req_by = $get_req['rqst_by'];
						$by_req_id = $get_req['rqst_id'];
					
						$query  ="select  *from aibl_login where user_id='".$req_by."'";				
						$get_req_result = mysql_query($query) or
						die(mysql_error());
						$get_req_by = mysql_fetch_array($get_req_result);
					
					if(isset($_POST['submit']))
					{													
							$dispatch_date_time=date('Y-m-d h:i:s a', strtotime($_POST['dispatch_date_time'])); 							
							$update_req_query ="Update aibl_chq_rqst set rqst_status='$_POST[req_status]',dispatch_datetime='$dispatch_date_time' where rqst_id='".$by_req_id."'";  										
							mysql_query($update_req_query) or
							die (mysql_error());							
							redirectUrl("index.php?option=manage_chk_request_vendor&order=order_date_time"); 																																													
					}													
					?>	
					
									
				  		
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Cheque Book Request From</B>
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
								<B>Request Info </B>							
							</TD>
						  </TR>
						  
						  <TR>
                          <TD class=back2 align=right width="27%">Requested By: </TD>
                            <TD class=back colspan="3" align=left>
							<? echo $get_req_by['branch_user_name'];?></TD>
						  </TR>
                          <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Account No</span>:</TD>
                            <TD class=back colSpan=3>
								<? echo $get_req['ac_no_branch']; ?>
                                -&nbsp;<? echo $get_req['ac_no_cus_no']; ?>
							    -&nbsp;<? echo $get_req['ac_no_suffix']; ?>							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Requester Branch Name</span>:</TD>
                            <TD class=back colSpan=3>							
								<? echo $get_req['collecting_branch'];?>																				
							</TD>							
						  </TR>						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Customer Name</span></TD>
                            <TD class=back colSpan=3>							
							<? echo $get_req['cus_name']; ?>   																			
							</TD>
						  </TR>
						  <TR>
                            <TD valign="top" class=back2 align=right width="27%"><span class="bodytext">Customer Address</span>:</TD>
                            <TD class=back colSpan=3>
														
							<? echo $get_req['cus_address']; ?>
							</TD>
						  </TR>
						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Requisition Date</span>:</TD>
                            <TD class=back colSpan=3>
							<? $date=str_replace('-','/',$get_req['rqst_date']);							
							echo date('M d, Y', strtotime($date));
							?>              				
							</TD>
						  </TR>
						  						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Account Type </span>:</TD>
                            <TD class=back colspan="3">
								<? echo $get_req['ac_type']; ?>- <? echo $get_req['total_leaf']; ?> Leaves 
							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Delivery Type</span>:</TD>
                            
							<TD class=back colspan="3">							 
							  <? echo $get_req['severity']; ?>			
							</TD>
						  </TR>
						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Status of request</span>:</TD>
                            
							<TD class=back colspan="3">
							  <SELECT name="req_status" onchange="
									if (this.options[this.selectedIndex].value== 'dispatched') {																																																																																																																																																															
											showTable('tblShowOptionDispatched');	

										}																				
										else if (this.options[this.selectedIndex].value== 'ordered')	{																																																																																																																																																														
																															 
											hideTable('tblShowOptionDispatched');																					
										}	
										else if (this.options[this.selectedIndex].value== 'pending') {
						
											hideTable('tblShowOptionDispatched'); 
		                       
									}																														
												
							  "	 
							    
							   onfocus="
							  		if (this.value== 'dispatched')	{																																																																																																																																																																																													 
											showTable('tblShowOptionDispatched');																					
										}	
							  "						  							  
							  >
							  
							  <OPTION value="ordered" <? if ('ordered'==$get_req['rqst_status']) echo 'selected'; ?>>Ordered</OPTION> 
							  <OPTION value="pending" <? if ('pending'==$get_req['rqst_status']) echo 'selected'; ?>>Pending</OPTION> 
							  <OPTION value="dispatched" <? if ('dispatched'==$get_req['rqst_status']) echo 'selected'; ?>>Dispatched</OPTION> 
                             </SELECT>							</TD>
						  </TR>	
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Order Date and Time: </span>:</TD>
                            <TD class=back colspan="3">
								<? $date=str_replace('-','/',$get_req['order_date_time']);?>
								<? echo date('M d, Y h:i a', strtotime($date));?>
							</TD>
						  </TR>
						 
						  <TR id="tblShowOptionDispatched" style="DISPLAY:none;">
                          	<TD class=back2 align=right width="27%">Dispatch Date & Time: </TD>
                            <TD class=back colspan="3">
								
								<? 
								if($_REQUEST['rqst_status']=='dispatched')	{
								$date=str_replace('-','/',$get_req['dispatch_datetime']);	
								$dispatch_datetime=date('M d, Y h:i a', strtotime($date));		
								}				
								?>
								<input type="text" name="dispatch_date_time" id="sel2" size="30" value="<? echo $dispatch_datetime;?>">
								<img src="body_content/calender/themes/icons/b_calendar.png" align="absmiddle" id="button2" style="cursor: pointer;" alt="Calendar" title="Date selector" />	
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
										var cal = new Zapatec.Calendar.setup({
		
											inputField     :    "sel2",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											showsTime      :     true,     // show time as well as date
											button         :    "button2"  // trigger button 

										});
		
									</script>
					
							</TD>
						  </TR>	
						  
						  <TR>
                            <TD class=back2 vAlign=top align=right width="27%">Remarks: </TD>
                            <TD class=back colSpan=3>
							  <? echo $get_req['remarks']; ?>
							 </TD>
						  </TR>				  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
                  
                  <CENTER>&nbsp;&nbsp;&nbsp;
                  <input type="submit" value="Update Task" name="submit"/>
				  
				  <!--<input type="submit" value="Update Task" name="submit" onclick='return VendorInput_validate();'/>-->
                  <INPUT type="Reset" value="Reset">
				</FORM>
				  </CENTER></TD></TR></TBODY></TABLE>

<?	
	}	
  }	




if(($option=='manage_chk_request_vendor')&&($task!='update_chk_request_vendor'))
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
                        <?
						
								
		
		$order=$_REQUEST['order'];
		
		//echo "test--".$order;
	
	function str($order){
	
		$fieldlist = array();
		$fieldlist[0] = "collecting_branch";
		$fieldlist[1] = "severity"; 
		$fieldlist[2] = "ac_type"; 
		$fieldlist[3] = "rqst_status"; 
		$fieldlist[4] = "order_date_time";			
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
		$fieldlist[4] = "order_date_time";
		
		for($i=0;$i<count($fieldlist);$i++)
		{
			if($order == $fieldlist[$i]." desc")
			{
				$$fieldlist[$i] = $fieldlist[$i]."_up";	
				$s_asc="images/s_asc.png";			
			}
			else
			{
				$$fieldlist[$i] = $fieldlist[$i]."_down";
				$s_desc="images/s_desc.png";
			}
		}
		
		?>
					  
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=hf align=left>
								<B>Requested Id</B>
							</TD>
							 <TD class=hf align=left>
								<A href="index.php?option=manage_chk_request_vendor&order=<? echo $collecting_branch; ?>"><B>Requester Branch </B>
								
								</A>							
								
								</TD>
							 	
							 <TD class=hf align=lef>
								<A href="index.php?option=manage_chk_request_vendor&order=<? echo $ac_type; ?>"><B>Account Type </B></A>
							</TD>
							<TD class=hf align=lef>
								<A href="index.php?option=manage_chk_request_vendor&order=<? echo $severity; ?>"><B>Severity </B></A>
							</TD>
							<TD class=hf align=lef>
								<A href="index.php?option=manage_chk_request_vendor&order=<? echo $rqst_status; ?>"><B>Status of request </B></A>
							</TD>
							<TD class=hf align=lef>
								<A href="index.php?option=manage_chk_request_vendor&order=<? echo $order_date_time; ?>"><B>Order Date and Time</B>
								<? if ($order_date_time=="order_date_time_up") {?> <img src="<? echo $s_asc ?>" border="0" align="absmiddle" /><? 
								}
								if ($order_date_time=="order_date_time_down")
									{
								?>
									 <img src="<? echo $s_desc ?>" border="0" align="absmiddle" />
									 <?
									 }
								?>
								</A>
							</TD>
							<TD class=hf align=center>
								<B>Action</B>
							</TD>
						  </TR>
						  <?
						//$order=$_REQUEST['order'];
		
	
		
				
				
				str($order);
				
				//echo "testkkkk".$order;
				$order1=" order by $order";
						  
							$query1="select * from aibl_chq_rqst".$order1;		
							$result1 = mysql_query($query1) or
							die(mysql_error());
							
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;

							while ($row =mysql_fetch_assoc($result1))
							{
								$date=str_replace('-','/',$row['order_date_time']); 
								
								echo "<tr>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\" style='text-decoration:underline'>".$row['rqst_id']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\" style='text-decoration:underline'>".$row['collecting_branch']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\" style='text-decoration:underline'>".$row['ac_type']."- ".$row['total_leaf']." Leaves</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\" style='text-decoration:underline'>".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\" style='text-decoration:underline'>".$row['rqst_status']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\" style='text-decoration:underline'>".date('M d, Y h:i', strtotime($date))."</td>
								<td class=$class align=center><span class=green>[<a class=edit href=index.php?task=update_chq_request_vendor&rqst_id=".$row['rqst_id']."&rqst_status=".$row['rqst_status'].">Edit</a>]</span></td>
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}

						}
						?>  
						<!--  
						<td class=$class align=center><span class=green>[<a class=edit href=index.php?task=update_chq_request_vendor&rqst_id=".$row['rqst_id'].">Edit</a>]</span> <span class=red>[<a onclick=\"return confirm('Are you sure?');\"  class=edit href=index.php?task=delete_chk_request_vendor&rqst_id=".$row['rqst_id'].">Delete</a>]</span></td>
						-->					  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					 </TD></TR></TBODY></TABLE>
<?
}
					
					if(($option!='manage_chk_request_admin')&&($task=='delete_chk_request_admin'))
				  	 { 

					$query = "delete from aibl_chq_rqst where rqst_id = {$_REQUEST['rqst_id']}";				
					mysql_query($query) or
					die (mysql_error());			
					
					redirectUrl("index.php?option=manage_chk_request_admin&order=order_date_time"); 
					}
 			

?>
