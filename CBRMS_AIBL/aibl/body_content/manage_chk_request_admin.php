<?php
//include_once ("../config.php");
include_once ("../tex_common.php");
$task=$_REQUEST['task'];
$option=$_REQUEST['option'];

if(($option!='manage_chk_request_admin')&&($task=='update_chq_request_admin'))
	{
	?>


<script language="javascript" type="text/javascript"> 
function showTableSavings(inrow) {
   rowArr = inrow.split(",")
   for (x=0; x<rowArr.length; x++){
	 if( theRow = document.getElementById(rowArr[x]).style.display == 'none')
	   document.getElementById(rowArr[x]).style.display = 'block';
   }
}

function showTableCurrent(inrow) {
   rowArr = inrow.split(",")
   for (x=0; x<rowArr.length; x++){
	 if( theRow = document.getElementById(rowArr[x]).style.display == 'none')
	   document.getElementById(rowArr[x]).style.display = 'block';
   }
}
function hideTable(inrow) {


   rowArr = inrow.split(",")
   for (x=0; x<rowArr.length; x++){
     if( theRow = document.getElementById(rowArr[x]).style.display == 'none')
	   document.getElementById(rowArr[x]).style.display = 'none';
	 else 
	  	document.getElementById(rowArr[x]).style.display = 'none';
		
		/*for (i=0;i<document.frmCheque.total_leaf.length;i++)
		 {
		 	document.frmCheque.total_leaf[i].checked=false;
		
		 }	*/
		 
   }
   
  
}

</script>


	
	<link href="style/user-style.css" rel="stylesheet" type="text/css">
	<SCRIPT language=javascript1.2 src="js/common.js" type=text/javascript></SCRIPT>
	



				<FORM name="frmCheque" action="index.php?task=update_chq_request_admin&rqst_id=<? echo  $_REQUEST['rqst_id']; ?>" method="post">
                 <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				  
				  <?
				  
				  
					$query  ="select  *from aibl_branch";				
					$get_branch_info = mysql_query($query) or
					die(mysql_error());
			
					$cus_info_query  ="select  *from aibl_cus_info";				
					$get_cutomer_info = mysql_query($cus_info_query) or
					die(mysql_error());

				  
					$req_id=$_REQUEST['rqst_id'];
					$sql = "select *from aibl_chq_rqst  where rqst_id= '".$req_id."' ";
    				$sql_result = mysql_query($sql)
					or die("Couldn't execute query.");
					if (!$sql_result) {
					echo "<P>Couldn't get item!";
					} 
					else {
						$get_req = mysql_fetch_array($sql_result);
						$req_by = $get_req['rqst_by'];
						$by_req_id = $get_req['rqst_id'];
						$req_branch = $get_req['collecting_branch'];
					
					if(isset($_POST['submit']))
					{
						
						//$first_leaf_no=$max_leaf+$_POST['total_leaf'];
						
						$branch_name_query = "select * from aibl_branch where branch_code = '".$_POST[req_branch]."'"; 
 						$result_branch_name_query= mysql_query($branch_name_query);
						$get_branch_name = mysql_fetch_array($result_branch_name_query);
						$branch_name=$get_branch_name['branch_name'];
						$branch_code=$get_branch_name['branch_code'];
						//echo "???".$branch_name;
						
						$customer_name_query = "select * from aibl_cus_info where cus_no = '".$_POST[cus_name]."'"; 
 						$result_customer_name_query= mysql_query($customer_name_query);
						$get_customer_name = mysql_fetch_array($result_customer_name_query);
						$customer_name=$get_customer_name['cus_name'];
						
						
						
						
						$cus_no= trim($_POST['cus_no']);
						$check=true;
						
		
						
						$query="select cus_no from aibl_chq_rqst where rqst_by='".$cus_no."' ";
						$result=mysql_query($query);
						
						if(($row=mysql_fetch_array($result)) && ($cus_no!=$_POST['ac_no1'])) 							
						{
							echo" <tr><td colspan=3 align=center> Sorry that Customer No <font color=#FF0000><i> ($cus_no) </i></font>  already exists!</td></tr> ";
							$check=false;
						}
						if($check==true)
							{
							$req_date=date('Y-m-d', strtotime($_POST['req_date'])); 
							$dispatch_date_time=date('Y-m-d H:i:s a', strtotime($_POST['dispatch_date_time'])); 
							
							//$order_date=date("d-m-Y, h:i:sa");$first_leaf_no','$_POST[ac_type]','$_POST[total_leaf]'first_leaf_no,ac_type,total_leaf,dispatch_day,dispatch_month,dispatch_year,dispatch_time,'$_POST[dispatch_day]','$_POST[dispatch_month]','$_POST[dispatch_year]',order_date_time='$_POST[order_date_time]'							
							$update_req_query ="Update aibl_chq_rqst set rqst_by='$_POST[req_by]',collecting_branch='$branch_name',collecting_branch_code='$_POST[req_code]',rqst_date='$req_date',
							cus_name='$customer_name',cus_no='$_POST[cus_no]',ac_no_branch='$_POST[ac_no_branch]',ac_no_cus_no='$_POST[ac_no_cus_no]',ac_no_suffix='$_POST[ac_no_suffix]',
							severity='$_POST[severity]',rqst_status='$_POST[req_status]',dispatch_datetime='$dispatch_date_time',remarks='$_POST[remarks]' where rqst_id='".$by_req_id."'";  										
							mysql_query($update_req_query) or
							die (mysql_error());
							//echo "????".$update_req_query;
							redirectUrl("index.php?option=manage_chk_request_admin&order=order_date_time"); 														
						}																											
					}													
					?>	
					
				  <INPUT type="hidden" name="req_id" value="<? $get_req['rqst_id']; ?>">						
				  		
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
								<B>Request Info </B>							</TD>
						  </TR>
						  <TR>
                          <TD class=back2 align=right width="27%">Requested By: </TD>
                            <TD class=back colspan="3" align=left>
							<input type="text" value="<? echo $get_req['rqst_by'];?>" name="req_by" size="30" /></TD>
						  </TR>
                          
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Requester Branch </span>:</TD>
                            <TD width="10%"  align=left class=back>
							
								<input type="text"  name="req_code" value="<? echo $get_req['collecting_branch_code'];?>" 
								onkeyup="if(this.value)BranchNameSelect(event,this,req_branch)" onkeypress="return isNumberKey(event)" 
								/>							
							</TD>
							<TD width="9%" align=right class=back2><span class="bodytext">Branch</span>:</TD>
                            <TD width="57%" class=back>
                          
							  <SELECT  name="req_branch"   
							  onchange="get_branch_code('req_branch','req_code');" >
							  <option  value="">Please Select</OPTION> 
                              <?
								
								while ($row =mysql_fetch_array($get_branch_info))
									{
									$sel = "";
							
									if ($row['branch_name'] == $get_req['collecting_branch']) $sel = "selected";
							?>
							<option value='<? echo $row['branch_code']; ?>' <? echo "$sel"; ?>><? echo $row['branch_name']; ?></option>
																
							<?
							}
							?>
                            </SELECT>							
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
											showsTime      :     false,     // show time as well as date
											button         :    "button1"  // trigger button 

										});
		
									</script>
							
							</TD>
						  </TR>
						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Customer No</span></TD>
                            <TD class=back colSpan=3>
							
							<input type="text"  name="cus_no" value="<? echo $get_req['cus_no']; ?>"   size="6" maxlength="6"     
								onKeyUp="if(this.value)CusNameSelect(event,this,cus_name)" 
								onBlur="copyField('cus_no','ac_no_cus_no','ac_no_branch')" 
								onkeypress="return isNumberKey(event)"
								>
							
							</TD>
						  </TR>

						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Name of Customer </span>:</TD>
                            <TD class=back colSpan=3>
							
							<SELECT  name="cus_name"  
							onchange="get_cus_info('cus_name','cus_no','ac_no_cus_no')"
							>
							  <option  value="">Please Select</OPTION> 
                              <?
								
								while ($row =mysql_fetch_array($get_cutomer_info))
									{
									$sel = "";
							
									if ($row['cus_no'] == $get_req['cus_no']) $sel = "selected";
							?>
							<option value='<? echo $row['cus_no']; ?>' <? echo "$sel"; ?>><? echo $row['cus_name']; ?></option>
																
							<?
							}
							?>
                            </SELECT>	
							
							</TD>
						  </TR>
						  						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Account No</span>:</TD>
                            <TD class=back colSpan=3>
								<input type="text" value="<? echo $get_req['ac_no_branch']; ?>" name="ac_no_branch" size="4" maxlength="4">
                                -&nbsp;<input type="text" value="<? echo $get_req['ac_no_cus_no']; ?>" name="ac_no_cus_no" size="6" maxlength="6">
							    -&nbsp;<input type="text" value="<? echo $get_req['ac_no_suffix']; ?>" name="ac_no_suffix" size="3" maxlength="3">							</TD>
						  </TR>
						  
						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">No of Total Leaf </span>:</TD>
                            <TD class=back >
								
							  <SELECT name="ac_type" disabled="disabled" style="font-weight:bold;"
							  	<? //if ($get_req['ac_type']="") {?>
							  	onchange="
										if (this.options[this.selectedIndex].value== 'Savings') {																																																																																																																																																															
											showTableSavings('tblShowOptionSavings');	
											
											hideTable('tblShowOptionCurrent');
											
										}
										else if (this.options[this.selectedIndex].value== 'Current')	{																																																																																																																																																														
											showTableCurrent('tblShowOptionCurrent');	
																																											 
											hideTable('tblShowOptionSavings');
																					
										}	
										else if (this.options[this.selectedIndex].value== '') {
						
											hideTable('tblShowOptionSavings'); 
											hideTable('tblShowOptionCurrent');
											
						                       
									}																														
												
							  ">
							  <OPTION value="">Please Select</OPTION> 
							  <OPTION value="Savings"  <? if ('Savings'==$get_req['ac_type']) echo 'selected'; ?>>Savings</OPTION> 
							  <OPTION value="Current" <? if ('Current'==$get_req['ac_type']) echo 'selected'; ?>>Current</OPTION> 
                            </SELECT>							</TD>
							
							<TD class=back colspan="2" width="70%">
								
								<span id="tblShowOptionSavings" style="DISPLAY:none;">
									<INPUT type=radio  value=20 <? if ('20'==$get_req['total_leaf']) echo 'checked'; ?>  id="total_leaf" name="total_leaf">20 Leaves
									<INPUT type=radio value=10 <? if ('10'==$get_req['total_leaf']) echo 'checked'; ?> id="total_leaf" name="total_leaf">10 Leaves								</span>
							  <span id="tblShowOptionCurrent" style="DISPLAY:none;">
									<INPUT type=radio value=50 <? if ('50'==$get_req['total_leaf']) echo 'checked'; ?> id="total_leaf" name="total_leaf">50 Leaves
									<INPUT type=radio value=20 <? if ('20'==$get_req['total_leaf']) echo 'checked'; ?> id="total_leaf" name="total_leaf">20 Leaves								</span><span>
									<input type=text style="font-weight:bold;"  value="<? echo $get_req['total_leaf']; ?>" disabled="disabled" name="show_total_leaf" size="2" />
									</span></TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Severity</span>:</TD>
                            
							<TD class=back colspan="3">
							  <SELECT name="severity">
							  <OPTION value="">Please Select</OPTION> 
							  <OPTION value="low" <? if ('low'==$get_req['severity']) echo 'selected'; ?>>Low</OPTION> 
							  <OPTION value="medium" <? if ('medium'==$get_req['severity']) echo 'selected'; ?>>Medium</OPTION> 
							  <OPTION value="high" <? if ('high'==$get_req['severity']) echo 'selected'; ?>>High</OPTION> 
                            </SELECT>							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Status of request</span>:</TD>
                            
							<TD class=back colspan="3">
							  <SELECT name="req_status">
							  <OPTION value="">Please Select</OPTION> 
							  <OPTION value="ordered" <? if ('ordered'==$get_req['rqst_status']) echo 'selected'; ?>>Ordered</OPTION> 
							  <OPTION value="pending" <? if ('pending'==$get_req['rqst_status']) echo 'selected'; ?>>Pending</OPTION> 
							  <OPTION value="dispatched" <? if ('dispatched'==$get_req['rqst_status']) echo 'selected'; ?>>Dispatched</OPTION> 
                             </SELECT>							</TD>
						  </TR>	
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Order Date and Time: </span>:</TD>
                            <TD class=back colspan="3">
								<? $date=str_replace('-','/',$get_req['order_date_time']);?>
								<input type="text" disabled="disabled" style="font-weight:bold;" name="order_date_time" size="30" value="<? echo date('M d, Y h:i a', strtotime($date));?>" >							</TD>
						  </TR>
						  <TR>
                          	<TD class=back2 align=right width="27%">Dispatch Date & Time: </TD>
                            <TD class=back colspan="3">
								
								<? $date=str_replace('-','/',$get_req['dispatch_datetime']);?>
								<input type="text" name="dispatch_date_time" id="sel2" size="30" value="<? echo date('M d, Y h:i a', strtotime($date));?>">
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
							  <TEXTAREA name=remarks rows=5 cols=60><? echo $get_req['remarks']; ?></TEXTAREA>							 </TD>
						  </TR>				  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
                  
                  <CENTER>&nbsp;&nbsp;&nbsp;
                  <input type="submit" value="Update Task" name="submit" onclick='return UserInput_validate();'/>
                  <INPUT type="Reset" value="Reset">
				</FORM>
				  </CENTER></TD></TR></TBODY></TABLE>

<?	
	}	
  }	




if(($option=='manage_chk_request_admin')&&($task!='update_chk_request_admin'))
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
                          
						  <?
				
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							
							$result = select_entries_admin($offset);

							while ($row =mysql_fetch_assoc($result))
							{
								$date=str_replace('-','/',$row['order_date_time']); 
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								
								echo "<tr>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['collecting_branch']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."- ".$row['total_leaf']." Lvs</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$status</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".date('M d, Y H:i', strtotime($date))."</td>
								
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
										<?php nav_admin($offset); ?> 
							</TD>
						</TR>
						
					 <!--
					 <td class=$class align=center><span class=green>[<a class=edit href=index.php?task=update_chq_request_admin&rqst_id=".$row['rqst_id'].">Edit</a>]</span> <span class=red>[<a onclick=\"return confirm('Are you sure?');\"  class=edit href=index.php?task=delete_chk_request_admin&rqst_id=".$row['rqst_id'].">Delete</a>]</span></td>	  
					-->						  	 			  
						  </TBODY></TABLE></TD></TR></TBODY></TABLE>
			 </TD></TR></TBODY></TABLE>
			 <!--
			 <div align="center"><a href="excel/excel.php"><img src="images/excel.gif" width="28" height="28" border="0" hspace="2"/>&nbsp;<b><font size="2">Download</font></b></a></div>
			-->		 
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
