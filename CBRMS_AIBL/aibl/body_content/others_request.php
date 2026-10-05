<? 
include_once ('../tex_common.php');

if (empty($_SESSION['username'])||($_SESSION['user_type']!='user'))
{
	redirectUrl('user_signin.php');
}

	$task=$_REQUEST['task'];
	$option=$_REQUEST['option'];
	
	if(($option=='others_request')&&($task!='others_request_confirm'))
	{
		
?>
<link href="style/user-style.css" rel="stylesheet" type="text/css">
<script src="js/selectcustomer.js"></script>
<SCRIPT language=javascript1.2 src="js/common.js" type=text/javascript></SCRIPT>
<SCRIPT language=javascript1.2 src="js/ajax-tooltip.js" type=text/javascript></SCRIPT>


<script language="javascript" type="text/javascript"> 

var desc_div=new Array();

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
	

				<FORM name="frmCheque" action="index.php?task=others_request_confirm" method="post">
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				  
				  <?
				  	
					$req_by_query = "select *from aibl_login where user_id= '".$_SESSION['user_id']."'"; 
 					$get_req_by= mysql_query($req_by_query);
					$get_user = mysql_fetch_array($get_req_by);
																	
					?>	
					<input type="hidden"  name="req_user_id" value="<? echo $get_user['user_id'];?>"/>					
				  	<input type="hidden"  name="total_leaf" value="100"/>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Others Item  Request Form</B>
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
                            <TD class=info align=left colSpan=5>
								<B>Others Request Info </B>							</TD>
						  </TR>
						  <TR height="30">
						  <TD vAlign=top width="4%" class=back >
                                <DIV class=icon id=divimg_na>&nbsp;</DIV></TD>
								
                          <TD class=back2 align=right width="24%">Requested By: </TD>
                            <TD class=back colspan="3" align=left>
								<input type="hidden" value="<? echo $get_user['branch_user_name'];?>" name="req_by"/>		
								<b><? echo $get_user['branch_user_name'];?></b>				
							</TD>
						  </TR>
                          <TR>
						  	<TD vAlign=top width="4%" class=back>&nbsp;</TD>								
                            <TD class=back2 align=right width="24%">Request Branch Name:
                            <TD class=back colspan="3" >                          	
							<input type="hidden" name="branch_name" value="<? echo $get_user['branch_name']; ?>"/>	
							<b><? echo $get_user['branch_name'];?></b>				 
							</TD>
						  </TR>						 							 						  						  						  
						  <TR height="30">
						  	<TD vAlign=top width="4%" class=back>
                                <DIV class=icon id=divimg_item_type>&nbsp;</DIV></TD>
								
                            <TD class=back2 align=right width="24%"><span class="bodytext">Item Type </span>:</TD>
                            <TD colspan="3" class=back>
							<SELECT name="item_type"  onfocus="javascript:showdiv_temp(desc_div,'divimg_item_type');" >							 
							  <OPTION value="">Please Select an Item</OPTION> 
							  <OPTION value="PO" <? if ('PO'==$_REQUEST['item_type']) echo 'selected'; ?>>PO-Pay Order</OPTION> 
							  <OPTION value="DD" <? if ('DD'==$_REQUEST['item_type']) echo 'selected'; ?>>DD-Demand Draft</OPTION>							  
							  <OPTION value="FDD" <? if ('FDD'==$_REQUEST['item_type']) echo 'selected'; ?>>FDD-Foreign Deposit Draft</OPTION> 	
							  <OPTION value="FDR" <? if ('FDR'==$_REQUEST['item_type']) echo 'selected'; ?>>FDR-Fixed Deposit Receipt</OPTION>								  						   						  
                            </SELECT>
							</TD>
						  </TR>
						  
						  <TR height="30">
						  	<TD vAlign=top width="4%" class=back>
                                <DIV class=icon id=divimg_books>&nbsp;</DIV></TD>								
                            <TD class=back2 align=right width="24%"><span class="bodytext">Number of Books</span>:</TD>
                            
							<TD class=back colspan="3">							
								<input type="text"  name="books" size="1" maxlength="2" value="<? echo $_REQUEST[books]; ?>" onkeypress="return isNumberKey(event);"  onfocus="javascript:showdiv_temp(desc_div,'divimg_books');">							
							</TD>
						  </TR>
						  						  						  
						  <TR height="30">
						  	<TD vAlign=top width="4%" class=back>
                                <DIV class=icon id=divimg_severity>&nbsp;</DIV></TD>
								
                            <TD class=back2 align=right width="24%"><span class="bodytext">Delivery Type</span>:</TD>
                            
							<TD class=back colspan="3">
							 <SELECT name="severity"  onfocus="javascript:showdiv_temp(desc_div,'divimg_severity');" >							 
							  <OPTION value="Normal" <? if ('Normal'==$_REQUEST['severity']) echo 'selected'; ?>>Normal-72 Hrs</OPTION> 
							  <OPTION value="Priority" <? if ('Priority'==$_REQUEST['severity']) echo 'selected'; ?>>Priority-24 Hrs</OPTION> 							  
                            </SELECT>							
							</TD>
						  </TR>
						  
						  <TR height="30">
						  	<TD vAlign=top width="4%" class=back>
                                <DIV class=icon id=divimg_name>&nbsp;</DIV></TD>
								
                            <TD class=back2 align=right width="24%"><span class="bodytext">Order Date and Time </span>:</TD>
                            <TD class=back colspan="3">
							<?
								 
								$cur_date=date("M d, Y g:i a"); 
								 
								?>
							
							
								<input type="text"  readonly="yes" style="font-weight:bold" name="order_date_time" size="21" value="<? echo $cur_date; ?>">							</TD>
						  </TR>
						  	
						  
						  <TR height="30">
						  	<TD class=back vAlign=top width="4%">
                                <DIV class=icon id=divimg_remarks>&nbsp;</DIV></TD>
								
                            <TD class=back2 vAlign=top align=right width="24%">Remarks: </TD>
                            <TD class=back colSpan=3>
							  <TEXTAREA name="remarks" rows=1 cols=30 onFocus="javascript:showdiv_temp(desc_div,'divimg_remarks');"><? echo $_REQUEST[remarks]; ?></TEXTAREA>						    
							 </TD>
						  </TR>				  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
                  
                  <CENTER>&nbsp;&nbsp;&nbsp;
                  <input type="submit" value="Submit" name="submit" onclick='return OthersInput_validate();'  />
				  <INPUT TYPE="button" onClick="history.go(0)" VALUE="Refresh">                  
				  </CENTER> 
				</FORM>
				
				 </TD></TR></TBODY></TABLE>
				  
		<?
		}
		
		if(($option!='others_request')&&($task=='others_request_confirm'))
				  	 { 
					
					?>
					
				<FORM action="index.php?task=others_request_confirm" method="post">
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				  
				  <?
				 											
					
					if(isset($_POST['confirm']))
					{						
						
							$query_routing_no ="select routing_no from aibl_branch where branch_code='".$_SESSION['branch_code']."'";			
							$sql_routing_no = mysql_query($query_routing_no) or
							die('Server Connection Error!');
							$get_routing_no = mysql_fetch_array($sql_routing_no);
							$routing_no=$get_routing_no['routing_no'];
							
							$req_date=date('Y-m-d', strtotime($_POST['req_date'])); 						 
							$order_date_time=date('Y-m-d H:i:s a', strtotime($_POST['order_date_time']));												 									 						 						
							$req_by= trim($_POST['req_by']);
							$books= trim($_POST['books']);
							
							$order_date=date("d-m-Y, H:i:s a");
							$rqst_id= mysql_insert_id();
							
							$query ="insert into aibl_others_rqst(others_rqst_id,others_rqst_by,others_collecting_branch,others_collecting_branch_code,others_routing_no,item_type,others_total_leaf,
											others_books,others_severity,others_rqst_status,others_order_date_time,others_remarks)  
											values('$rqst_id','$_POST[req_user_id]','$_POST[branch_name]','$_SESSION[branch_code]','$routing_no','$_POST[item_type]',
											'$_POST[total_leaf]','$books','$_POST[severity]','approval','$order_date_time','$_POST[remarks]')";						
							mysql_query($query) or
							die (mysql_error());
							//redirectUrl("index.php?option=manage_others_request&order=others_order_date_time");
							redirectUrl("index.php?option=others_total_request&task=others_total_request_manager"); 	
																																																		
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
								<B>Request Info </B>							
							
							</TD>
						  </TR>
						  <TR>
                          <TD class=back2 align=right width="24%">Requested By: </TD>
                            <TD class=back colspan="3" align=left>
								<? echo $_POST[req_by]; ?>						
							</TD>
						  </TR>
                          
						  <TR>
                            <TD class=back2 align=right width="24%">Requester Branch Name:</TD>							
							
                            <TD class=back colspan="3"><? echo $_POST[branch_name];?></TD>
							</TR>							
							<TR>
                            <TD class=back2 align=right width="24%">Item Type:</TD>
                            <TD class=back colspan="3">								
							 	  																					
								<? echo $_POST[item_type]."-".$_POST[total_leaf]." Leaves"; ?>							
							</TD>
						   </TR>
						   <TR>
                            <TD class=back2 align=right width="24%"><span class="bodytext">Number of Books </span>:</TD>
                            <TD class=back colspan="3">
								<? echo $_POST[books]; ?>								
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
                            <TD class=back2 vAlign=top align=right width="24%">Remarks: </TD>
                            <TD class=back colSpan=3>
							  <? echo $_POST[remarks]; ?>							 
							</TD>
						  </TR>				  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
					<input type="hidden" name="req_user_id" value="<? echo $_POST[req_user_id]; ?>"/>
					 <input type="hidden" name="req_by" value="<? echo $_POST[req_by]; ?>"/>					  
						 <input type="hidden" name="branch_name" value="<? echo $_POST[branch_name];?>"/>
						  <input type="hidden" name="branch_code" value="<? echo $_POST[branch_code];?>"/>						  
							 <input type="hidden" name="item_type" value="<? echo $_POST[item_type]; ?>"/>
							  <input type="hidden" name="total_leaf" value="<? echo $_POST[total_leaf]; ?>"/>
							  <input type="hidden" name="books" value="<? echo $_POST[books]; ?>"/>					   		   
							    <input type="hidden" name="severity" value="<? echo $_POST[severity]; ?>"/>
								 <input type="hidden" name="order_date_time" value="<? echo $_POST[order_date_time]; ?>"/>
								  <input type="hidden" name="remarks" value="<? echo $_POST[remarks]; ?>"/>
					   					 						  						   							  							  							    								 
													                    
                  <CENTER>
				  <INPUT type="button" value="<<Back" onClick="document.location.href='index.php?option=others_request&item_type=<? echo $_POST[item_type]; ?>&books=<? echo $_POST[books]; ?>&severity=<? echo $_POST[severity]; ?>&remarks=<? echo $_POST[remarks]; ?>'; ">
				  &nbsp;&nbsp;&nbsp;
                  <input type="submit" value="Confirm>>" name="confirm"/>
                  
				  			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
				  			<?
								$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=650,height=570,directories=no,location=no';
								$link = 'popups/others_request_print.php';
							?>

							<a href="<?php echo $link; ?>" target="_blank" onClick="window.open('popups/others_request_print.php?req_by=<? echo $_POST[req_by]; ?>
								&ac_no_branch=<? echo $_POST[ac_no_branch]; ?>&ac_no_cus_no=<? echo $_POST[ac_no_cus_no]; ?>&ac_no_suffix=<? echo $_POST[ac_no_suffix]; ?>&branch_name=<? echo $_POST[branch_name];?>
								&customer_name=<? echo $_POST[cus_name]; ?>&customer_address=<? echo $_POST[cus_address]; ?>&req_date=<? echo $_POST[req_date]; ?>
								&ac_type=<? echo $actype; ?>&total_leaf=<? echo $_POST[total_leaf]; ?>&books=<? echo $_POST[books]; ?>&collecting_brach=<? echo $collecting_branch_name;?>&severity=<? echo $_POST[severity]; ?>&order_date_time=<? echo $_POST[order_date_time]; ?>&remarks=<? echo $_POST[remarks]; ?>','win2','<?php echo $status; ?>'); return false;" title="Print Version">
								<img src="images/printer.gif" border="0" align="absmiddle" />
							</a>
				   </CENTER>
				</FORM>
					
							
				 </TD></TR></TBODY></TABLE>
					
					<?
					}
 			
		
	?>