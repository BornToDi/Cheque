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
			$query_collect  ="select *from aibl_branch order by branch_name asc";				
			$get_collecting_branch_info = mysql_query($query_collect) or
			die('Server Connection Error!');
			
			 $query_branch_info ="select branch_code,branch_name from aibl_branch where branch_code='".$_SESSION['branch_code']."'";			
			 $sql_result = mysql_query($query_branch_info) or
			 die('Server Connection Error!');
			 $get_branch_info = mysql_fetch_array($sql_result);
		
if(($option!='manage_chk_request')&&($task=='update_chq_request'))
	{
			
	?>


<link href="style/user-style.css" rel="stylesheet" type="text/css">
<SCRIPT language=javascript1.2 src="js/common.js" type=text/javascript></SCRIPT>
<script src="js/selectcustomer.js"></script>
<script language="javascript" type="text/javascript"> 
function UserInput_validate()
{
	var msghdr = "Please enter value for the following fields:-\n";
  	var msg = "";
	var err = 0;
	var frm  =  document.frmCheque;

	
	if((frm.ac_no_suffix.value=="") || (frm.ac_no_cus_no.value==""))
	{
		msg+= "-> Account No\n";
		err++;	
		if(frm.ac_no_suffix.value=="")
		frm.ac_no_suffix.focus();	
		if(frm.ac_no_cus_no.value=="")
		frm.ac_no_cus_no.focus();			
	}
	
	if((frm.ac_no_cus_no.value.length<8) || (frm.ac_no_suffix.value.length<3))	
	{
		msg += "-> Input Valid A/C No\n";
		err++;	
		if(frm.ac_no_suffix.value.length<3)
		frm.ac_no_suffix.focus();	
		if(frm.ac_no_cus_no.value.length<8)
		frm.ac_no_cus_no.focus();
	}
	
	if(frm.req_date.value=="")
	{
		msg+= "-> Request Date\n";
		err++;		
	}
	
	if(frm.cus_name.value=="")
	{
		msg+= "-> Name of Customer\n";		
		err++;
	}
			
	if(frm.ac_type.value=="")
	{
		msg+= "-> Account type\n";
		err++;						
	}
				
	var radio_choice = false;  	
	for (var i=0; i<frm.total_leaf.length; i++)    
	{      
		if (frm.total_leaf[i].checked) {        
			radio_choice = true;         
			//break;      
		}     
	}    
	if(!radio_choice)  {
		msg+= "-> Account Type / Total Leaves\n";
		err++;
	}					
	
	if(err>0){
     alert(msghdr+msg);
     return false;
	 }
  
  return true;
}

function showTable(val) {
	if((val == '121')||(val == '122')||(val == '123'))
		{
			document.frmCheque.total_leaf[0].checked=true;
			document.getElementById('tblShowOptionSavings').style.display = '';
			document.getElementById('tblShowOptionCurrent').style.display = 'none';
			document.getElementById('tblShowDefault').style.display = 'none';

			document.getElementById('tblShowOptionCur').style.display = 'none';
			document.getElementById('tblShowOptionSav').style.display = 'none';
						
		}
		
	else if((val == '111')||(val == '131')||(val == '132')||(val == '710')||(val == '711')||(val == '747')||(val == '748'))
		{
			document.frmCheque.total_leaf[1].checked=true;
			document.getElementById('tblShowOptionCurrent').style.display = '';
			document.getElementById('tblShowOptionSavings').style.display = 'none';			
			document.getElementById('tblShowDefault').style.display = 'none';
						
			document.getElementById('tblShowOptionCur').style.display = 'none';
			document.getElementById('tblShowOptionSav').style.display = 'none';									
		}


	else
		{
			document.frmCheque.total_leaf[0].checked=false;
			document.frmCheque.total_leaf[1].checked=false;
			document.getElementById('tblShowDefault').style.display = '';
			document.getElementById('tblShowOptionSavings').style.display = 'none';
			document.getElementById('tblShowOptionCurrent').style.display = 'none';

			document.getElementById('tblShowOptionCur').style.display = 'none';
			document.getElementById('tblShowOptionSav').style.display = 'none';

			  
			
		}

   
}

</script>

				<FORM name="frmCheque" action="index.php?task=update_chq_request&rqst_id=<? echo  $_REQUEST['rqst_id']; ?>" method="post">
                 <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				  
				  <?
				  	 
				
					
					$req_id=$_REQUEST['rqst_id'];
					$sql = "select *from aibl_chq_rqst  where rqst_id= '".$req_id."' ";
    				$sql_result = mysql_query($sql)
					or die("Couldn't execute query.");
					if (!$sql_result) {
					echo "<P>Couldn't get item!";
					} 
					else {
						$get_req = mysql_fetch_array($sql_result);						
						$by_req_id = $get_req['rqst_id'];
						
																																																				
					if(isset($_POST['submit']))
					{																		
			
							$query_collecting_branch_code ="select branch_code from aibl_branch where branch_name='".$_POST['collecting_branch']."'";			
			 				$sql_collecting_branch_code = mysql_query($query_collecting_branch_code) or	die('Server Connection Error!');
			 				$get_collecting_branch_code = mysql_fetch_array($sql_collecting_branch_code);
							$collecting_branch_code=$get_collecting_branch_code['branch_code'];
							
							$branch_name=$_POST[req_branch];																	
							$req_date=date('Y-m-d', strtotime($_POST['req_date'])); 
							$dispatch_date_time=date('Y-m-d H:i:s a', strtotime($_POST['dispatch_date_time'])); 
							$req_edit_date=date('Y-m-d H:i:s a', strtotime($_POST['edit_order_date_time']));
							
							$update_req_query ="Update aibl_chq_rqst set rqst_by='$_POST[req_user_id]',collecting_branch='$branch_name',collecting_branch_code='$_POST[ac_no_branch]',collecting_branch='$collecting_branch_name',collecting_branch_code='$collecting_branch_code',rqst_date='$req_date',
							cus_name='$_POST[cus_name]',cus_address='$_POST[cus_address]',ac_no_branch='$_POST[ac_no_branch]',ac_no_cus_no='$_POST[ac_no_cus_no]',ac_no_suffix='$_POST[ac_no_suffix]',
							ac_type='$_POST[ac_type]',total_leaf='$_POST[total_leaf]',books='$_POST[books]',severity='$_POST[severity]',rqst_status='approval',rqst_edit_by='$_POST[req_edit_user_id]',rqst_edit_datetime='$req_edit_date',remarks='$_POST[remarks]' where rqst_id='".$by_req_id."'";  										
							mysql_query($update_req_query) or
							die (mysql_error());
							//echo "????".$update_req_query;
							//redirectUrl("index.php?option=manage_chk_request&order=order_date_time"); 	
							redirectUrl("index.php?option=total_request&task=total_request_manager"); 													
																																
					}													
					?>	
				   <?
				  	
					$req_edit_by_query = "select * from aibl_login where user_id= '".$_SESSION['user_id']."'"; 
 					$get_req_edit_by= mysql_query($req_edit_by_query);
					$get_edit_user = mysql_fetch_array($get_req_edit_by);
					
					$req_by_query = "select *from aibl_login where user_id= '$get_req[rqst_by]'"; 
 					$get_req_by= mysql_query($req_by_query);
					$get_user = mysql_fetch_array($get_req_by);
																	
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
                        <TABLE cellSpacing=1 cellPadding=4 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=left colSpan=4>
								<B>Edit Request Information </B>							</TD>
						  </TR>
						  <TR>
                          <TD class=back2 align=right width="27%">Requested By: </TD>
                            <TD class=back colspan="3" align=left>
								<input type="hidden" name="req_user_id" value="<? echo $get_user['user_id']; ?>">									
							 	<b><? echo $get_user['branch_user_name'];?></b>
							 </TD>
						  </TR>
						  <TR>
                          <TD class=back2 align=right width="27%">Request Edit By: </TD>
                            <TD class=back colspan="3" align=left>
								<input type="hidden"  name="req_edit_user_id" value="<? echo $get_edit_user['user_id'];?>"/>								
							 	<b><? echo $get_edit_user['branch_user_name'];?></b>
							 </TD>
						  </TR>
						  <TR>						  	
                            <TD class=back2 align=right width="24%">Request Branch Name:
                            <TD class=back colspan="3" >   
								<input type="hidden" name="req_branch" value="<? echo $get_req['collecting_branch']; ?>" />                       
								<b><? echo $get_req['collecting_branch']; ?></b>						 																		
							</TD>
							</TR>
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Account No</span>:</TD>
                            <TD class=back colSpan=3>							
								<input type="text" value="<? echo $get_req['ac_no_branch']; ?>" readonly="readonly"  name="ac_no_branch" size="4" maxlength="4" />                                
								
							    -&nbsp;
								<input type="text"  name="ac_no_suffix" value="<? echo $get_req['ac_no_suffix']; ?>" size="3" maxlength="3" 
								onKeyUp="req_advance_ac_no_cus_no(this,'ac_no_cus_no');" 
								onkeypress="return isNumberKey(event);"
								onblur="showProduct(this,this.value); showTable(this.value);"																																				
								>	
								-&nbsp;
                                <input type="text" name="ac_no_cus_no" value="<? echo $get_req['ac_no_cus_no']; ?>" id="ac_no_cus_no"  size="8" maxlength="8"  															
								onkeypress="return isNumberKey(event)" 																		
								onblur="showCustomerAddress(this,ac_no_branch.value,ac_no_suffix.value,this.value);"	
								onKeyUp="advance_req_cus_name(this,'cus_name');" 													 
								>	

								<span id="txtPro">
									&nbsp;
								</span>		
												
							</TD>
						  </TR>                      						  						  
						  <TR>						  	
                            <TD class=back2 align=right width="24%">Customer Name:
                            <TD class=back colspan="3" > 
							<div id="txtHint">                         							
								<input type="text" name="cus_name" size="31" value="<? echo $get_req['cus_name']; ?>" />																					
							</div>
							</TD>
							</TR>						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Request Date</span>:</TD>
                            <TD class=back colSpan=3>
								<? $date=str_replace('-','/',$get_req['rqst_date']);?>
								<input type="text" name="req_date" value="<? echo date('M d, Y', strtotime($date));?>"  class="dead" id="sel1"/>
								<img src="body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button1" style="cursor: pointer;" alt="Calendar" title="Date selector" />
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
										var cal = new Zapatec.Calendar.setup({
		
											inputField     :    "sel1",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											//ifFormat       :    '%a, %b %e, %Y [%I:%M %p]',     // format of the input field
											ifFormat       :    '%b %e, %Y',     // format of the input field
											//showsTime      :     false,     // show time as well as date
											button         :    "button1"  // trigger button 

										});
		
									</script>							</TD>
						  </TR>						  
						   
						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Account Type </span>:</TD>
                            
							<TD class=back colspan="3" width="70%">
								<span id="tblShowDefault" style="DISPLAY:none;">
								<INPUT type="text"  readonly="yes" size="6" >
							   </span>

								<span id="tblShowOptionSavings" style="DISPLAY:none;">
									<INPUT type="text" value="Savings" readonly="yes" size="6"   name="ac_type">								
									<INPUT type="radio"  name="total_leaf" value="20">20 Leaves
								</span>
								<span id="tblShowOptionCurrent" style="DISPLAY:none;">
									<INPUT type="text" value="Current" readonly="yes" size="6"  name="ac_type">
									<INPUT type="radio" name="total_leaf"  value="25">25 Leaves
									<INPUT type="radio"  name="total_leaf" value="50" >50 Leaves								
								</span>	


								<span id="tblShowOptionSav" <? if ($get_req['ac_type']=='Savings'){?>style="DISPLAY:block;"<? }  else ?>style="DISPLAY:none;">
									<INPUT type="text" value="<? echo $get_req['ac_type'] ?>" readonly="yes" size="6"   name="ac_type">
									<INPUT type=radio  value=20 <? if ($get_req['ac_type']=='Savings') echo 'checked'; ?>  name="total_leaf">20 Leaves
								</span>
							   <span id="tblShowOptionCur" <? if ($get_req['ac_type']=='Current'){?>style="DISPLAY:block;"<? } else?>style="DISPLAY:none;">
									<INPUT type="text" value="<? echo $get_req['ac_type'] ?>" readonly="yes" size="6"  name="ac_type">
									<INPUT type=radio value=25 <? if (($get_req['ac_type']=='Current')&&($get_req['total_leaf']=='25')) echo 'checked'; ?>  name="total_leaf">25 Leaves								
									<INPUT type=radio value=50 <? if (($get_req['ac_type']=='Current')&&($get_req['total_leaf']=='50')) echo 'checked'; ?>  name="total_leaf">50 Leaves									
								</span>

								
								
							</TD>
						  </TR>
						  
						   <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Number of Books</span>:</TD>                            
							<TD class=back colspan="3">							 
							<SELECT name="books">							 
							  <OPTION value="1" <? if ('1'==$get_req['books']) echo 'selected'; ?>>1</OPTION> 
							  <OPTION value="2" <? if ('2'==$get_req['books']) echo 'selected'; ?>>2</OPTION> 	
							  <OPTION value="3" <? if ('3'==$get_req['books']) echo 'selected'; ?>>3</OPTION> 
							  <OPTION value="4" <? if ('4'==$get_req['books']) echo 'selected'; ?>>4</OPTION> 
							  <OPTION value="5" <? if ('5'==$get_req['books']) echo 'selected'; ?>>5</OPTION> 
							  <OPTION value="6" <? if ('6'==$get_req['books']) echo 'selected'; ?>>6</OPTION> 
							  <OPTION value="7" <? if ('7'==$get_req['books']) echo 'selected'; ?>>7</OPTION> 
							  <OPTION value="8" <? if ('8'==$get_req['books']) echo 'selected'; ?>>8</OPTION> 
							  <OPTION value="9" <? if ('9'==$get_req['books']) echo 'selected'; ?>>9</OPTION> 
							  <OPTION value="10" <? if ('10'==$get_req['books']) echo 'selected'; ?>>10</OPTION> 						  
                            </SELECT>								
							</TD>
						  </TR>
						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Collecting Branch </span>:</TD>
                            <TD class=back colSpan=3>
							
							<SELECT  name="collecting_branch">
							  <option  value="">Please Select</OPTION> 
                              <?
								
								while ($row =mysql_fetch_array($get_collecting_branch_info))
									{
									$sel = "";
							
									if ($row['branch_code'] == $get_req['collecting_branch_code']) $sel = "selected";
							?>
							<option value='<? echo $row['branch_name']; ?>' <? echo "$sel"; ?>><? echo $row['branch_name']; ?></option>
																
							<?
							}
							?>
                            </SELECT>							
							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Delivery Type</span>:</TD>
                            
							<TD class=back colspan="3">
							  <SELECT name="severity">							 
							  <OPTION value="Normal" <? if ('Normal'==$get_req['severity']) echo 'selected'; ?>>Normal-72 Hrs</OPTION> 
							  <OPTION value="Priority" <? if ('Priority'==$get_req['severity']) echo 'selected'; ?>>Priority-24 Hrs</OPTION> 							 
                            </SELECT>							
							</TD>
						  </TR>
						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Order Date and Time: </span>:</TD>
                            <TD class=back colspan="3">
								<? $date=str_replace('-','/',$get_req['order_date_time']);?>
								<input type="text" readonly="yes" style="font-weight:bold;" name="order_date_time" size="30" value="<? echo date('M d, Y h:i a', strtotime($date));?>" >							</TD>
						  </TR>
						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Edit Order Date and Time: </span>:</TD>
                            <TD class=back colspan="3">
								<? $cur_date=date("M d, Y g:i a"); ?>
								<input type="text" readonly="yes" style="font-weight:bold;" name="edit_order_date_time" size="30" value="<? echo $cur_date; ?>" >							</TD>
						  </TR>
						    							  
						  <TR>
                            <TD class=back2 vAlign=top align=right width="27%">Remarks: </TD>
                            <TD class=back colSpan=3>
							  <TEXTAREA name=remarks rows=1 cols=30><? echo $get_req['remarks']; ?></TEXTAREA>							 </TD>
						  </TR>				  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
                  
                  <CENTER>&nbsp;&nbsp;&nbsp;
                  <input type="submit" value="Update" name="submit" onclick='return UserInput_validate();'/>
                  <INPUT type="Reset" value="Reset">
				  </CENTER>
				</FORM>
				  </TD></TR></TBODY></TABLE>

<?	
	}	
  }	






if(($option=='manage_chk_request')&&($task!='update_chk_request') &&($task!='delete_chk_request'))
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
                  <?
				  	$order=$_REQUEST['order'];
	
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
								<B>Account Number</B>
							</TD>
							 <TD class=hf align=left>
								<A href="index.php?option=manage_chk_request&order=<? echo $collecting_branch; ?>"><B>Branch </B>
								
								</A>							
								
								</TD>
							 	
							 <TD class=hf align=left>
								<A href="index.php?option=manage_chk_request&order=<? echo $ac_type; ?>"><B>Account Type </B></A>
							</TD>
							<TD class=hf align=left>
								<B>Books </B>
							</TD>
							<TD class=hf align=left>
								<A href="index.php?option=manage_chk_request&order=<? echo $severity; ?>"><B>Delivery Type </B></A>
							</TD>
							<TD class=hf align=left>
								<A href="index.php?option=manage_chk_request&order=<? echo $rqst_status; ?>"><B>Status of request </B></A>
							</TD>
							<TD class=hf align=left>
								<A href="index.php?option=manage_chk_request&order=<? echo $order_date_time; ?>"><B>Order Date and Time</B></A>
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
																								
								$query = "select * from aibl_chq_rqst where collecting_branch_code ='".$_SESSION['branch_code']."' and rqst_status='reject'".$order1."";
							
							
							$result = mysql_query($query);
							while ($row =mysql_fetch_assoc($result))
							{
								$date=str_replace('-','/',$row['order_date_time']); 
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								
								$ac_no=$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no'];
								
								echo "<tr>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$ac_no</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['collecting_branch']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."- ".$row['total_leaf']." Lvs</a></td>
								<td class=$class align='center'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['books']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$status</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">". date('M d, Y h:i a', strtotime($date))."</a></td>
								";
								//if($row['rqst_status']=='approval'){
								if($_SESSION['user_type']=='user'){
								echo"
								<td class=$class align=center>	
									<span class=green>[<a class=edit href=index.php?task=update_chq_request&rqst_id=".$row['rqst_id'].">Edit</a>]</span>								
									
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

if(($option=='manage_chk_request')&&($task=='delete_chk_request'))
				  	 { 

					$query = "delete from aibl_chq_rqst where rqst_id = {$_REQUEST['rqst_id']}";				
					mysql_query($query) or
					die (mysql_error());								
					redirectUrl("index.php?option=manage_chk_request&order=order_date_time"); 
					}
?>
