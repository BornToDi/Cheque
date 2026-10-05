<? 
	include_once ('../tex_common.php');
	$task=$_REQUEST['task'];
	$option=$_REQUEST['option'];
	
if (empty($_SESSION['username'])||($_SESSION['user_type']!='user'))
{
	redirectUrl('user_signin.php');
}

if(($option=='chk_request')&&($task!='chk_request_confirm'))
{
	
			$query_collect  ="select  *from aibl_branch order by branch_name asc";				
			$get_collecting_branch_info = mysql_query($query_collect) or
			die('Server Connection Error!');
			
			 $query_branch_info ="select branch_code,branch_name from aibl_branch where branch_code='".$_SESSION['branch_code']."'";			
			 $sql_result = mysql_query($query_branch_info) or
			 die('Server Connection Error!');
			 $get_branch_info = mysql_fetch_array($sql_result);
							
	
?>
<link href="style/user-style.css" rel="stylesheet" type="text/css">
<SCRIPT language=javascript1.2 src="js/common.js" type=text/javascript></SCRIPT>
<script src="js/selectcustomer.js"></script>
<script language="javascript" type="text/javascript"> 

var desc_div=new Array();

function showTable(val) {
	if((val == '121')||(val == '122')||(val == '123'))
		{
			document.frmCheque.total_leaf[0].checked=true;
			document.getElementById('tblShowOptionSavings').style.display = '';
			document.getElementById('tblShowOptionCurrent').style.display = 'none';
			document.getElementById('tblShowOptionImperial').style.display = 'none';
			document.getElementById('tblShowDefault').style.display = 'none';		
		}
		
	else if((val == '111')||(val == '131')||(val == '132')||(val == '710')||(val == '711')||(val == '747')||(val == '748'))
		{
			document.frmCheque.total_leaf[1].checked=true;
			document.getElementById('tblShowOptionCurrent').style.display = '';
			document.getElementById('tblShowOptionSavings').style.display = 'none';
			document.getElementById('tblShowOptionImperial').style.display = 'none';			
			document.getElementById('tblShowDefault').style.display = 'none';				
		}
	else if((val == '130'))
		{
			document.frmCheque.total_leaf[0].checked=true;
			document.getElementById('tblShowOptionImperial').style.display = '';
			document.getElementById('tblShowOptionSavings').style.display = 'none';
			document.getElementById('tblShowOptionCurrent').style.display = 'none';
			document.getElementById('tblShowDefault').style.display = 'none';		
		}
		
		
	else
		{
			document.frmCheque.total_leaf[0].checked=false;
			document.frmCheque.total_leaf[1].checked=false;
			document.getElementById('tblShowDefault').style.display = '';
			document.getElementById('tblShowOptionSavings').style.display = 'none';
			document.getElementById('tblShowOptionCurrent').style.display = 'none';
			document.getElementById('tblShowOptionImperial').style.display = 'none';
		}
   
}

</script>
	

				<FORM name="frmCheque" action="index.php?task=chk_request_confirm" method="post">
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				  
				  <?
				  	
					$req_by_query = "select * from aibl_login where user_id= '".$_SESSION['user_id']."'"; 
 					$get_req_by= mysql_query($req_by_query);
					$get_user = mysql_fetch_array($get_req_by);
																	
					?>	
					<input type="hidden"  name="req_user_id" value="<? echo $get_user['user_id'];?>"/>
					<input type="hidden"  name="branch_code" value="<? echo $get_branch_info['branch_code'];?>"/>
				  
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Cheque Book Request Form</B>
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
                            <TD class=info align=left colSpan=5>
								<B>Request Information </B>							</TD>
						  </TR>
						  <TR height="30">
						  <TD vAlign="middle" width="3%" class=back >
                            <DIV class=icon id=divimg_na>&nbsp;</DIV></TD>
								
                          <TD class=back2 align=right width="35%">Requested By: </TD>
                            <TD class=back colspan="3" align=left>
								<input type="hidden" value="<? echo $get_user['branch_user_name'];?>" name="req_by"/>							
								<b><? echo $get_user['branch_user_name'];?>	</b>
							</TD>
						  </TR>
                          
						  <TR height="30">
						  	<TD vAlign="middle" width="3%" class=back>
                            <DIV class=icon id=divimg_req_branch>&nbsp;</DIV></TD>
								
                            <TD class=back2 align=right width="35%"><span class="bodytext">Branch Name:</span></TD>
                            
							<TD class=back colspan="3">
							 <input type="hidden" name="req_branch" value="<? echo $get_branch_info['branch_name']; ?>"/>	
							 <b><? echo $get_branch_info['branch_name']; ?></b>
							</TD>
						  </TR>
						  
						  <TR height="30">
						  	<TD vAlign="middle"  width="3%" class=back>
                            <DIV class=icon id=divimg_ac_no>&nbsp;</DIV></TD>
								
                            <TD class=back2 align=right width="35%"><span class="bodytext">Account No</span>:</TD>
                            <TD class=back colSpan=3>
								<input type="text" readonly="readonly"  name="ac_no_branch" size="4" maxlength="4" value="<? echo $get_branch_info['branch_code']; ?>"/>                                
								
							    -&nbsp;
								<input type="text" name="ac_no_suffix" size="3" maxlength="3" value="<? echo $_REQUEST[ac_no_suffix]; ?>" 
								onKeyUp="req_advance_ac_no_cus_no(this,'ac_no_cus_no');" 
								onkeypress="return isNumberKey(event);"
								onblur="showProduct(this,this.value); showTable(this.value);"							
								onfocus="javascript:showdiv_temp(desc_div,'divimg_ac_no');"																							
								>	
								-&nbsp;
                                <input type="text" id="ac_no_cus_no"  name="ac_no_cus_no" size="8" maxlength="8" value="<? echo $_REQUEST[ac_no_cus_no]; ?>"  															
								onkeypress="return isNumberKey(event)" 										
								onfocus="javascript:showdiv_temp(desc_div,'divimg_ac_no');" 
								onblur="showCustomerAddress(this,ac_no_branch.value,ac_no_suffix.value,this.value);"	
								onKeyUp="advance_req_cus_name(this,'books');" 													 
								>	

								<span id="txtPro">
									&nbsp;
								</span>			
										
							</TD>
						  </TR>						  						 	
						  
						  <TR height="30">
						  	<TD vAlign="middle" width="3%" class=back>
                            <DIV class=icon id=divimg_cus_name>&nbsp;</DIV></TD>
								
                            <TD class=back2 align=right width="35%"><span class="bodytext">Customer Name:</span></TD>
                            
							<TD class=back colspan="3">
								
							<div id="txtHint">							 
							 <input type="text" name="cus_name" size="31" readonly="yes" value="<? echo $_REQUEST[cus_name]; ?>"/>
							</div>	
							</TD>
						  </TR>
						  						  																					 
						  <TR height="30">
						  	<TD vAlign="middle" width="3%" class=back>
                            <DIV class=icon id=divimg_date>&nbsp;</DIV></TD>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Customer Requisition Date</span>:</TD>
                            <TD class=back colSpan=3>
							
              				<?
								
								//$cur_date=date("M d, Y g:i a"); 
								$cur_date=date("M d, Y"); 
								 
								?>
																	
							
								<input type="text" name="req_date" size="12" value="<? echo $cur_date ?>"   id="sel2" onFocus="javascript:showdiv_temp(desc_div,'divimg_date');"/>
              				<a  onclick="javascript:showdiv_temp(desc_div,'divimg_date');" href="javascript:return false;">
							<img src="body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button2" style="cursor: pointer;" alt="Calendar" title="Date selector" /></a>
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
									
										var cal = new Zapatec.Calendar.setup({
											
											inputField     :    "sel2",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											//ifFormat       :    '%a, %b %e, %Y [%I:%M %p]',     // format of the input field
											ifFormat       :    '%b %e, %Y',     // format of the input field
											//ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											//showsTime      :     true,     // show time as well as date
											button         :    "button2"  // trigger button 

										});
		
									</script>							
							</TD>
						  </TR>
						  
						  
						  
						  <TR height="30">
						  	<TD vAlign="middle" width="3%" class=back>
                            <DIV class=icon id=divimg_ac_type>&nbsp;</DIV></TD>
								
                            <TD class=back2 align=right width="35%"><span class="bodytext">Account Type </span>:</TD>
                            <TD colspan="3" class=back>
							<span id="tblShowDefault" style="DISPLAY:block;">
								<INPUT type="text"  readonly="yes" size="6" value="<? echo $_REQUEST[ac_type]; ?>">
								<? if($_REQUEST[ac_type]=='Savings'){?>													
									<INPUT type="radio"  name="total_leaf1" value="20" <? if ($_REQUEST['total_leaf']=='20') echo 'checked'; ?>>20 Leaves						
								<? }?>
								
								<? if($_REQUEST[ac_type]=='Imperial'){?>													
									<INPUT type="radio"  name="total_leaf1" value="20" <? if ($_REQUEST['total_leaf']=='20') echo 'checked'; ?>>20 Leaves						
								<? }?>
								
								<? if($_REQUEST[ac_type]=='Current'){?>													
									<INPUT type="radio" name="total_leaf1"  value="25" <? if ($_REQUEST['total_leaf']=='25') echo 'checked'; ?>>25 Leaves
									<INPUT type="radio"  name="total_leaf1" value="50" <? if ($_REQUEST['total_leaf']=='50') echo 'checked'; ?>>50 Leaves					
								<? }?>
							</span>
							<span id="tblShowOptionSavings" style="DISPLAY:none;">
								<INPUT type="text" value="Savings" readonly="yes" size="6"   name="ac_type">	
								<!--<INPUT type="text" value="20" readonly="yes" size="1" name="total_leaf"> Leaves	-->
								<INPUT type="radio"  name="total_leaf" value="20">20 Leaves
							</span>
							<span id="tblShowOptionImperial" style="DISPLAY:none;">
								<INPUT type="text" value="Imperial" readonly="yes" size="6"   name="ac_type">	
								<!--<INPUT type="text" value="20" readonly="yes" size="1" name="total_leaf"> Leaves	-->
								<INPUT type="radio"  name="total_leaf" value="20">20 Leaves
							</span>
							<span id="tblShowOptionCurrent" style="DISPLAY:none;">
								<INPUT type="text" value="Current" readonly="yes" size="6"  name="ac_type">
								<INPUT type="radio" name="total_leaf"  value="25">25 Leaves
								<INPUT type="radio"  name="total_leaf" value="50" >50 Leaves								
							</span>	
																				
							</TD>
						  </TR>
						 												 
						  <TR height="30">
						  	<TD vAlign="middle" width="3%" class=back>
                            <DIV class=icon id=divimg_books>&nbsp;</DIV></TD>								
                            <TD class=back2 align=right width="35%"><span class="bodytext">Number of Books</span>:</TD>
                            
							<TD class=back colspan="3">
						
							 <SELECT name="books"  onfocus="javascript:showdiv_temp(desc_div,'divimg_books');" >							 
							  <OPTION value="1" <? if ('1'==$_REQUEST['books']) echo 'selected'; ?>>1</OPTION> 
							  <OPTION value="2" <? if ('2'==$_REQUEST['books']) echo 'selected'; ?>>2</OPTION> 	
							  <OPTION value="3" <? if ('3'==$_REQUEST['books']) echo 'selected'; ?>>3</OPTION> 
							  <OPTION value="4" <? if ('4'==$_REQUEST['books']) echo 'selected'; ?>>4</OPTION> 
							  <OPTION value="5" <? if ('5'==$_REQUEST['books']) echo 'selected'; ?>>5</OPTION> 
							  <OPTION value="6" <? if ('6'==$_REQUEST['books']) echo 'selected'; ?>>6</OPTION> 
							  <OPTION value="7" <? if ('7'==$_REQUEST['books']) echo 'selected'; ?>>7</OPTION> 
							  <OPTION value="8" <? if ('8'==$_REQUEST['books']) echo 'selected'; ?>>8</OPTION> 
							  <OPTION value="9" <? if ('9'==$_REQUEST['books']) echo 'selected'; ?>>9</OPTION> 
							  <OPTION value="10" <? if ('10'==$_REQUEST['books']) echo 'selected'; ?>>10</OPTION> 							  
                            </SELECT>							
							</TD>
						  </TR>
						  						  
						  <TR height="30">
						  	<TD vAlign="middle" width="3%" class=back>
                            <DIV class=icon id=divimg_collecting>&nbsp;</DIV></TD>
								
                            <TD class=back2 align=right width="35%"><span class="bodytext">Collecting Branch</span>:</TD>
                            
							<TD class=back colspan="3">
							  <SELECT  name="collecting_branch" onFocus="javascript:showdiv_temp(desc_div,'divimg_collecting');">
							  <option  value="">Please Select</OPTION> 
                              <?
								
								while ($row =mysql_fetch_array($get_collecting_branch_info))
									{
									$sel = "";
							
									if ($row['branch_code'] ==  $get_branch_info['branch_code']) $sel = "selected";
							?>
							<option value='<? echo $row['branch_name']; ?>' <? echo "$sel"; ?>><? echo $row['branch_name']; ?></option>
																
							<?
							}
							?>
                            </SELECT>							
							</TD>
						  </TR>
						 
						  
						  <TR height="30">
						  	<TD vAlign="middle" width="3%" class=back>
                            <DIV class=icon id=divimg_severity>&nbsp;</DIV></TD>
								
                            <TD class=back2 align=right width="35%"><span class="bodytext">Delivery Type</span>:</TD>
                            
							<TD class=back colspan="3">
							 <SELECT name="severity"  onfocus="javascript:showdiv_temp(desc_div,'divimg_severity');" >							 
							  <OPTION value="Normal" <? if ('Normal'==$_REQUEST['severity']) echo 'selected'; ?>>Normal-72 Hrs</OPTION> 
							  <OPTION value="Priority" <? if ('Priority'==$_REQUEST['severity']) echo 'selected'; ?>>Priority-24 Hrs</OPTION>  				  
                            </SELECT>							
							</TD>
						  </TR>
						  
						  <TR height="30">
						  	<TD vAlign="middle" width="3%" class=back>
                            <DIV class=icon id=divimg_name>&nbsp;</DIV></TD>
								
                            <TD class=back2 align=right width="35%"><span class="bodytext">Order Date and Time </span>:</TD>
                            <TD class=back colspan="3">
							<? $cur_date=date("M d, Y g:i a"); ?>														
								<input type="text"  readonly="yes" style="font-weight:bold" name="order_date_time" size="21" value="<? echo $cur_date; ?>">							</TD>
						  </TR>
						  	
						  
						  <TR height="30">
						  	<TD class=back vAlign="middle" width="3%">
                            <DIV class=icon id=divimg_remarks>&nbsp;</DIV></TD>
								
                            <TD class=back2 vAlign="middle" align=right width="35%">Remarks: </TD>
                            <TD class=back colSpan=3>
							  <TEXTAREA name="remarks" rows=2 cols=30 onFocus="javascript:showdiv_temp(desc_div,'divimg_remarks');"><? echo $_REQUEST[remarks]; ?></TEXTAREA>						    
							 </TD>
						  </TR>				  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
                  
                   <div style="float:left">
				   		<input type="button" onclick="showLastRequest(ac_no_branch.value,ac_no_suffix.value,ac_no_cus_no.value); return UserInput_validate();" value="View Last 10 Requisitions" />
					</div>
				  	<div style="float:right; width:500">			 				 
                  	<input type="submit" value="Submit" name="submit" onclick='return UserInput_validate(); showCustomerAddress(ac_no_cus_no.value,ac_no_branch.value,ac_no_suffix.value,ac_no_cus_no.value);' />
				  	<INPUT TYPE="button" onClick="history.go(0)" VALUE="Refresh">
                  </div>
				  
				</FORM>
				
				 
				  
				  <div id="txtLast">&nbsp;</div>
				  </TD></TR></TBODY></TABLE>
		<?
		}

	
		if(($option!='chk_request')&&($task=='chk_request_confirm'))
				  	 { 
					
					?>
					
				<FORM action="index.php?task=chk_request_confirm" method="post">
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				  
				  <?
				  							 						
					if(isset($_POST['confirm']))
					{						
						
						$query_routing_no ="select routing_no from aibl_branch where branch_code='".$_SESSION['branch_code']."'";			
			 			$sql_routing_no = mysql_query($query_routing_no) or
			 			die('Server Connection Error!');
			 			$get_routing_no = mysql_fetch_array($sql_routing_no);
						$routing_no=$get_routing_no['routing_no'];
						
						$query_collecting_branch_code ="select branch_code from aibl_branch where branch_name='".$_POST['collecting_branch']."'";			
			 			$sql_collecting_branch_code = mysql_query($query_collecting_branch_code) or
			 			die('Server Connection Error!');
			 			$get_collecting_branch_code = mysql_fetch_array($sql_collecting_branch_code);
						$collecting_branch_code=$get_collecting_branch_code['branch_code'];
			 			
						
						
						$req_date=date('Y-m-d', strtotime($_POST['req_date'])); 						 
						$order_date_time=date('Y-m-d H:i:s a', strtotime($_POST['order_date_time']));	
											 									 						 						
						$req_by= trim($_POST['req_by']);
						
							$order_date=date("d-m-Y, H:i:s a");
							$rqst_id= mysql_insert_id();
							
							$query ="insert into aibl_chq_rqst(rqst_id,rqst_by,collecting_branch,collecting_branch_code,routing_no,collecting_branch,collecting_branch_code,rqst_date,cus_name,ac_no_branch,ac_no_cus_no,ac_no_suffix,
									ac_type,total_leaf,books,severity,rqst_status,order_date_time,remarks)  
									values('$rqst_id','$_POST[req_user_id]','$_POST[branch_name]','$_POST[branch_code]','$routing_no','$_POST[collecting_branch]','$collecting_branch_code','$req_date','$_POST[customer_name]',
									'$_POST[ac_no_branch]','$_POST[ac_no_cus_no]','$_POST[ac_no_suffix]','$_POST[ac_type]',
									'$_POST[total_leaf]','$_POST[books]','$_POST[severity]','approval','$order_date_time','$_POST[remarks]')";						
							mysql_query($query) or
							die (mysql_error());
							
							//redirectUrl("index.php?option=manage_chk_request&order=order_date_time"); 	
							redirectUrl("index.php?option=total_request&task=total_request_manager"); 																																										
					}													
					?>	
					
				  
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Cheque Book Request Form</B>
							</TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
  			</TABLE>
                  <BR>
                  
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=6 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=left colSpan=4>
								<B>Request Information </B>							
							
							</TD>
						  </TR>
						  <TR>
                          <TD class=back2 align=right width="24%">Requested By: </TD>
                            <TD class=back colspan="3" align=left>
								<? echo $_POST[req_by]; ?>						
							</TD>
						  </TR>
                          <TR>
                            <TD class=back2 align=right width="24%"><span class="bodytext">Account No</span>:</TD>
                            <TD class=back colSpan=3>
								 
								 <? 								 								
								echo $_POST[ac_no_branch]; ?>                               
								-&nbsp;
								<? echo $_POST[ac_no_suffix];?>                                 
							    -&nbsp; 								
								 <? echo $_POST[ac_no_cus_no]; 								
								?>	
								
															
								</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="24%">Request Branch Name:</TD>							
							
                            <TD class=back colspan="3"><? echo $_POST[req_branch];?></TD>
							</TR>
							<TR>
                            <TD class=back2 align=right width="24%">Customer Name:</TD>
                            <TD class=back colSpan=3>
							 <? echo $_POST[cus_name]; ?>							
							</TD>
						    </TR>
							
							<TR>
                            <TD class=back2 align=right width="24%">Requisition Date:</TD>
                            <TD class=back colSpan=3>
							  <? echo $_POST[req_date]; ?>							
							</TD>
						    </TR>
							<TR>
                            <TD class=back2 align=right width="24%">Account Type:</TD>
                            <TD class=back colspan="3">								
							 	<? 
								if(($_POST['ac_no_suffix'] ==121)||($_POST['ac_no_suffix'] ==122)||($_POST['ac_no_suffix'] ==123)) {
									$actype='Savings';
								 	echo $actype; 
								 }
								 if(($_POST['ac_no_suffix'] ==130)) {
									$actype='Imperial';
								 	echo $actype; 
								 }
								if(($_POST['ac_no_suffix'] ==111)||($_POST['ac_no_suffix'] ==131)||($_POST['ac_no_suffix'] ==132)||($_POST['ac_no_suffix'] ==710)||($_POST['ac_no_suffix'] ==711)||($_POST['ac_no_suffix'] ==747)||($_POST['ac_no_suffix'] ==748)) {
									$actype='Current';
								 	echo $actype; 
								 }
								 
								 
								?> - 																					
								<? echo $_POST[total_leaf]." Leaves"; ?>							
							</TD>
						   </TR>
						   <TR>
                            <TD class=back2 align=right width="24%"><span class="bodytext">Number of Books </span>:</TD>
                            <TD class=back colspan="3">
								<? echo $_POST[books]; ?>								
							</TD>
						  </TR>
							<TR>
                            <TD class=back2 align=right width="24%"><span class="bodytext">Collecting Branch</span>:</TD>
                            
							<TD class=back colspan="3">
							  	<? echo $_POST[collecting_branch]; ?>							
							</TD>
						  </TR>						  						 
						  <TR>
                            <TD class=back2 align=right width="24%">Delivery Type:</TD>
                            
							<TD class=back colspan="3">
							  	<? echo $_POST[severity]; ?> - <? if($_POST[severity]=="Normal") echo "72 Hrs"; else if($_POST[severity]=="Priority") echo "24 Hrs"; ?> 							
							</TD>
						  </TR>
						  
						  <TR>
                            <TD class=back2 align=right width="24%"><span class="bodytext">Order Date and Time </span>:</TD>
                            <TD class=back colspan="3">
								<? echo $_POST[order_date_time]; ?>
								
							</TD>
						  </TR>
						  	
						  
						  <TR>
                            <TD class=back2 vAlign="middle" align=right width="24%">Remarks: </TD>
                            <TD class=back colSpan=3>
							  <? echo $_POST[remarks]; ?>							 
							</TD>
						  </TR>				  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
					<input type="hidden" name="req_user_id" value="<? echo $_POST[req_user_id]; ?>"/>
					 <input type="hidden" name="req_by" value="<? echo $_POST[req_by]; ?>"/>
					  <input type="hidden" name="ac_no_branch" value="<? echo $_POST[ac_no_branch]; ?>"/>
					   <input type="hidden" name="ac_no_cus_no" value="<? echo $_POST[ac_no_cus_no]; ?>"/>
					  	<input type="hidden" name="ac_no_suffix" value="<? echo $_POST[ac_no_suffix]; ?>"/>
						 <input type="hidden" name="branch_name" value="<? echo $_POST[req_branch];?>"/>
						  <input type="hidden" name="branch_code" value="<? echo $_POST[branch_code];?>"/>
						  <input type="hidden" name="customer_name" value="<? echo $_POST[cus_name]; ?>"/>					       						  
						    <input type="hidden" name="req_date" value="<? echo $_POST[req_date]; ?>"/>
							 <input type="hidden" name="ac_type" value="<? echo $actype; ?>"/>
							  <input type="hidden" name="total_leaf" value="<? echo $_POST[total_leaf]; ?>"/>
							  <input type="hidden" name="books" value="<? echo $_POST[books]; ?>"/>
					   		   <input type="hidden" name="collecting_branch" value="<? echo $_POST[collecting_branch];?>"/>							   
							    <input type="hidden" name="severity" value="<? echo $_POST[severity]; ?>"/>
								 <input type="hidden" name="order_date_time" value="<? echo $_POST[order_date_time]; ?>"/>
								  <input type="hidden" name="remarks" value="<? echo $_POST[remarks]; ?>"/>
					   					 						  						   							  							  							    								 
													                    
                  <CENTER>
				  <INPUT type="button" value="<<Back" onClick="document.location.href='index.php?option=chk_request&ac_no_cus_no=<? echo $_POST[ac_no_cus_no]; ?>&ac_no_suffix=<? echo $_POST[ac_no_suffix]; ?>
								&cus_name=<? echo $_POST[cus_name]; ?>&req_date=<? echo $_POST[req_date]; ?>
								&ac_type=<? echo $actype; ?>&total_leaf=<? echo $_POST[total_leaf]; ?>&books=<? echo $_POST[books]; ?>&collecting_brach=<? echo $_POST[collecting_branch];?>&severity=<? echo $_POST[severity]; ?>&remarks=<? echo $_POST[remarks]; ?>'; ">
				  &nbsp;&nbsp;&nbsp;
                  <input type="submit" value="Confirm>>" name="confirm"/>
                  
				  			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
				  			<?
								$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=650,height=570,directories=no,location=no';
								$link = 'popups/chk_request_print.php';
							?>

							<a href="<?php echo $link; ?>" target="_blank" onClick="window.open('popups/chk_request_print.php?req_by=<? echo $_POST[req_by]; ?>
								&ac_no_branch=<? echo $_POST[ac_no_branch]; ?>&ac_no_cus_no=<? echo $_POST[ac_no_cus_no]; ?>&ac_no_suffix=<? echo $_POST[ac_no_suffix]; ?>&branch_name=<? echo $_POST[req_branch];?>
								&customer_name=<? echo $_POST[cus_name]; ?>&req_date=<? echo $_POST[req_date]; ?>
								&ac_type=<? echo $actype; ?>&total_leaf=<? echo $_POST[total_leaf]; ?>&books=<? echo $_POST[books]; ?>&collecting_brach=<? echo $_POST[collecting_branch];?>&severity=<? echo $_POST[severity]; ?>&order_date_time=<? echo $_POST[order_date_time]; ?>&remarks=<? echo $_POST[remarks]; ?>','win2','<?php echo $status; ?>'); return false;" title="Print Version">
								<img src="images/printer.gif" border="0" align="absmiddle" />
							</a>
				  </CENTER>
				</FORM>
					
							
				  </TD></TR></TBODY></TABLE>
					
					<?
					}
 			
		
	?>