<?php
include_once ('../tex_common.php');
include_once ("../config.php");	

if (empty($_SESSION['username'])||($_SESSION['user_type']=='admin')||($_SESSION['user_type']=='gsd'))
{	
	redirectUrl('user_signin.php');
}
	
$task=$_REQUEST['task'];
$option=$_REQUEST['option'];
include ("pagging/pagging_excel.php");
		
if(($option!='manage_others_request')&&($task=='update_others_request'))
	{
	?>


<script language="javascript" type="text/javascript"> 

function OthersInput_validate()
{
	var msghdr = "Please enter value for the following fields:-\n";
  	var msg = "";
	var err = 0;
	var frm  =  document.frmCheque;

	if(frm.item_type.value=="")
	{
		msg+= "-> Item Type\n";
		err++;		
	}	
	if(frm.books.value=="")
	{
		msg+= "-> No. of Books\n";
		err++;		
	}		
	if(err>0){
     alert(msghdr+msg);
     return false;
	 }
  return true;
}
</script>

<link href="style/user-style.css" rel="stylesheet" type="text/css">
<script src="js/selectcustomer.js"></script>
<SCRIPT language=javascript1.2 src="js/common.js" type=text/javascript></SCRIPT>


				<FORM name="frmCheque" action="index.php?task=update_others_request&others_rqst_id=<? echo  $_REQUEST['others_rqst_id']; ?>" method="post">
                 <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				  
				  <?
				  	 
				 	
					$req_id=$_REQUEST['others_rqst_id'];
					$sql = "select *from aibl_others_rqst  where others_rqst_id= '".$req_id."' ";
    				$sql_result = mysql_query($sql)
					or die("Couldn't execute query.");
					if (!$sql_result) {
					echo "<P>Couldn't get item!";
					} 
					else {
						$get_req = mysql_fetch_array($sql_result);						
						$by_req_id = $get_req['others_rqst_id'];
						
																																																				
					if(isset($_POST['submit']))
					{
						
							$dispatch_date_time=date('Y-m-d H:i:s a', strtotime($_POST['dispatch_date_time'])); 
							
							$update_req_query ="Update aibl_others_rqst set item_type='$_POST[item_type]',others_total_leaf='$_POST[total_leaf]',others_books='$_POST[books]',others_severity='$_POST[severity]',others_rqst_status='approval',others_remarks='$_POST[remarks]' where others_rqst_id='".$by_req_id."'";  										
							mysql_query($update_req_query) or
							die (mysql_error());							
							redirectUrl("index.php?option=manage_others_request&order=others_order_date_time"); 														
																																
					}													
					?>	
				   <?
				  	
					$req_by_query = "select * from aibl_login where user_id= '".$_SESSION['user_id']."'"; 
 					$get_req_by= mysql_query($req_by_query);
					$get_user = mysql_fetch_array($get_req_by);
																	
					?>	
				<input type="hidden"  name="req_user_id" value="<? echo $get_user['user_id'];?>"/>
				<input type="hidden" name="req_id" value="<? $get_req['others_rqst_id']; ?>">	
				<input type="hidden"  name="branch_code" value="<? echo $get_hvbbn['HVBBN'];?>"/>
				<input type="hidden"  name="total_leaf" value="100"/>					
				  		
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Security Item Request From</B>
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
							<input type="hidden" value="<? echo $get_user['branch_user_name'];?>" name="req_by" />
							<b><? echo $get_user['branch_user_name'];?></b>
							
							</TD>
						  </TR>
						                        						  						  						  						  
						  <TR>						  									
                            <TD class=back2 align=right width="24%">Request Branch Name:
                            <TD class=back colspan="3" >                          	
							<input type="hidden" name="req_branch" value="<? echo $_SESSION['branch_name']; ?>"/>
							<b><? echo $_SESSION['branch_name']; ?></b>		 
							</TD>
						  </TR>	
						  
						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Item Type </span>:</TD>
                            <TD class=back >
								
							  <SELECT name="item_type">							  							  
							  <OPTION value="">Please Select an Item</OPTION> 
							  <OPTION value="PO" <? if ('PO'==$get_req['item_type']) echo 'selected'; ?>>PO-Pay Order</OPTION> 
							  <OPTION value="DD" <? if ('DD'==$get_req['item_type']) echo 'selected'; ?>>DD-Demand Draft</OPTION>							  
							  <OPTION value="FDD" <? if ('FDD'==$get_req['item_type']) echo 'selected'; ?>>FDD-Foreign Deposit Draft</OPTION> 	
							  <OPTION value="FDR" <? if ('FDR'==$get_req['item_type']) echo 'selected'; ?>>FDR-Fixed Deposit Receipt</OPTION>	
							 							   						  							
							</SELECT>							
							</TD>
														
						  </TR>
						  
						   <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Number of others_books</span>:</TD>                            
							<TD class=back colspan="3">							
								<input type="text"  name="books" size="1" maxlength="2" value="<? echo $get_req['others_books']; ?>" onkeypress="return isNumberKey(event);"  onfocus="javascript:showdiv_temp(desc_div,'divimg_books');">							
							</TD>
							
						  </TR>
						  						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Delivery Type</span>:</TD>
                            
							<TD class=back colspan="3">
							  <SELECT name="severity">							 
							  <OPTION value="Normal" <? if ('Normal'==$get_req['others_severity']) echo 'selected'; ?>>Normal-72 Hrs</OPTION> 
							  <OPTION value="Priority" <? if ('Priority'==$get_req['others_severity']) echo 'selected'; ?>>Priority-24 Hrs</OPTION> 							 
                            </SELECT>							
							</TD>
						  </TR>
						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Order Date and Time: </span>:</TD>
                            <TD class=back colspan="3">
								<? $date=str_replace('-','/',$get_req['others_order_date_time']);?>
								<input type="text" readonly="yes" style="font-weight:bold;" name="order_date_time" size="30" value="<? echo date('M d, Y h:i a', strtotime($date));?>" >							</TD>
						  </TR>
						    							  
						  <TR>
                            <TD class=back2 vAlign=top align=right width="27%">Remarks: </TD>
                            <TD class=back colSpan=3>
							  <TEXTAREA name=remarks rows=2 cols=30><? echo $get_req['others_remarks']; ?></TEXTAREA>							 
							</TD>
						  </TR>				  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
                  
				<div align="right" style="float:left; width:400">
                  <input type="submit" value="Update" name="submit" onclick='return OthersInput_validate();'/>
                  <input type="Reset" value="Reset">
				</div>
				</FORM>
				 </TD></TR></TBODY></TABLE>

<?	
	}	
  }	






if(($option=='manage_others_request')&&($task!='update_chk_request') &&($task!='delete_chk_request'))
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
                  <?
				  	$order=$_REQUEST['order'];
	
  function str($order){	
		$fieldlist = array();
		$fieldlist[0] = "others_collecting_branch";
		$fieldlist[1] = "others_severity"; 
		$fieldlist[2] = "item_type"; 
		$fieldlist[3] = "others_rqst_status"; 
		$fieldlist[4] = "others_order_date_time";
			
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
		$fieldlist[4] = "others_order_date_time";
		
		for($i=0;$i<count($fieldlist);$i++)
		{
			if($order == $fieldlist[$i]." desc")
			{
				$$fieldlist[$i] = $fieldlist[$i]."_up";	
						
			}
			else
			{
				$$fieldlist[$i] = $fieldlist[$i]."_down";
				
			}
		}
		
		?>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
					     <TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
                          <TBODY>
                          <TR>
                            
							 <TD class=hf align=left>
								<A href="index.php?option=manage_others_request&order=<? echo $others_collecting_branch; ?>"><B>Branch </B>
								
								</A>							
								
								</TD>
							 	
							 <TD class=hf align=left>
								<A href="index.php?option=manage_others_request&order=<? echo $item_type; ?>"><B>Account Type </B></A>
							</TD>
							<TD class=hf align=left>
								<B>No. of books </B>
							</TD>
							<TD class=hf align=left>
								<A href="index.php?option=manage_others_request&order=<? echo $others_severity; ?>"><B>Delivery Type </B></A>
							</TD>
							<TD class=hf align=left>
								<A href="index.php?option=manage_others_request&order=<? echo $others_rqst_status; ?>"><B>Status of request </B></A>
							</TD>
							<TD class=hf align=left>
								<A href="index.php?option=manage_others_request&order=<? echo $others_order_date_time; ?>"><B>Order Date and Time</B></A>
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
                         
			
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;	
														
																			
							$query = "select * from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."' and others_rqst_status='reject'".$order1."";
							
							$result = mysql_query($query);
							while ($row =mysql_fetch_assoc($result))
							{
								$date=str_replace('-','/',$row['others_order_date_time']); 
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
																
								echo "<tr>								
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_collecting_branch']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['item_type']."- ".$row['others_total_leaf']." Lvs</a></td>
								<td class=$class align='center'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_books']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$status</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">". date('M d, Y h:i a', strtotime($date))."</a></td>
								";
								//if($row['others_rqst_status']=='approval'){
								if($_SESSION['user_type']=='user'){
								echo"
								<td class=$class align=center>
									<span class=green>[<a class=edit href=index.php?task=update_others_request&others_rqst_id=".$row['others_rqst_id'].">Edit</a>]</span>									
								</td>
								";
								}
								else{
								echo"
								<td class=$class align=center><span class=green>[No Action]</span></td>
								";
								}
								
								echo"
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
							<TD  class=back colspan="8" align="center">
										<?php //nav_excel($offset); ?> 
							</TD>
						</TR>
						-->					  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					 </TD></TR></TBODY></TABLE>
<?
}

if(($option=='manage_others_request')&&($task=='delete_chk_request'))
				  	 { 

					$query = "delete from aibl_others_rqst where others_rqst_id = {$_REQUEST['others_rqst_id']}";				
					mysql_query($query) or
					die (mysql_error());								
					redirectUrl("index.php?option=manage_others_request&order=others_order_date_time"); 
					}
?>
