<?php
include_once ("../config.php");
include_once ("../tex_common.php");
$task=$_REQUEST['task'];
$option=$_REQUEST['option'];
?>
    <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Search for Requested Cheque Book Information</B>
							</TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
 				</TABLE><BR>
<?
//--------------------------------SEARCH ALL ----------------------------------------------------
if(($option=='search_criteria')&&($task=='search_all'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=600');
}
</script>
                  
				<FORM name="frmSearch" action="index.php?option=search_criteria&task=search_all" method="post">
				<TABLE class=border cellSpacing=1 cellPadding=2 width="100%" border=0>
						
                          <TBODY>
						   <TR>
                            <TD class=info align=left colSpan=4>
								<B>Serach for all criteria </B>											
							</TD>
						  </TR>
						  <TR height="25">						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Logon User Id</span>:</TD>
                            <TD class=back colSpan=3>
								<input type="text" name="logon_user_id" size="35"  value="<? echo $_POST[logon_user_id]; ?>" />								 																					
							</TD>
						  </TR>
						  <TR height="25">						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Account No</span>:</TD>
                            <TD class=back colSpan=3>
								<input type="text" name="ac_no_branch" size="4" maxlength="4" value="<? echo $_POST[ac_no_branch]; ?>"
								 onKeyUp="advance_ac_no_suffix(this,'ac_no_suffix');" 									 								 
								 onkeypress="return isNumberKey(event);" 								 
								>                                
								-&nbsp;
								<input type="text" name="ac_no_suffix" size="3" maxlength="3" value="<? echo $_POST[ac_no_suffix]; ?>" 
								onKeyUp="advance_ac_no_cus_no(this,'ac_no_cus_no');" 
								onkeypress="return isNumberKey(event);"	                                							
								>
							    -&nbsp;
								<input type="text"  name="ac_no_cus_no" size="7" maxlength="7" value="<? echo $_POST[ac_no_cus_no]; ?>" 														
								onkeypress="return isNumberKey(event);" 							
								>												
							</TD>
						  </TR>
						  <TR height="25">						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Account Name</span>:</TD>
                            <TD class=back colSpan=3>
								<input type="text" name="ac_name" size="35"  value="<? echo $_POST[ac_name]; ?>" />								 						
															
							</TD>
						  </TR>
						  <TR height="25">						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Branch Name</span>:</TD>
                            <TD class=back colSpan=3>
								<input type="text" name="req_branch" size="35"  value="<? echo $_POST[req_branch]; ?>" />								 																					
							</TD>
						  </TR>
						  <TR height="25">						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Status of Request</span>:</TD>
                            <TD class=back colSpan=3>
							  <SELECT name="req_status">
							  <OPTION value="" >ALL...</option>		
							  <OPTION value="approval" <? if ('approval'==$_POST[req_status]) echo 'selected'; ?>>Awaiting approval</OPTION>
							  <OPTION value="reject" <? if ('reject'==$_POST[req_status]) echo 'selected'; ?>>Reject</OPTION>	
							  <OPTION value="pending" <? if ('pending'==$_POST[req_status]) echo 'selected'; ?>>Pending</OPTION> 					 
							  <OPTION value="ordered" <? if ('ordered'==$_POST[req_status]) echo 'selected'; ?>>Ordered</OPTION> 							  
							  <OPTION value="dispatched" <? if ('dispatched'==$_POST[req_status]) echo 'selected'; ?>>Dispatched</OPTION>
							  <OPTION value="delivered" <? if ('delivered'==$_POST[req_status]) echo 'selected'; ?>>Delivered</OPTION>  
                             </SELECT>															 																					
							</TD>
						  </TR>
						  <TR height="25">						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Delivery Type</span>:</TD>
                            <TD class=back colSpan=3>
							  <SELECT name="severity">
							  <OPTION value="" >ALL...</option>		
							  <OPTION value="Normal" <? if ('Normal'==$_POST[severity]) echo 'selected'; ?>>Normal</OPTION>
							  <OPTION value="Priority" <? if ('Priority'==$_POST[severity]) echo 'selected'; ?>>Priority</OPTION> 					 							  
                             </SELECT>															 																					
							</TD>
						  </TR>
						  <TR>
                          <TD class=back2 align=right><label for="search_searchword">Date: </label></TD>
                            <TD class=back align=left><span class="bodytext">From</span>:
							
              				<?
								if(isset($_POST['search']))								
								$date_from=$_POST[order_date_from];							
								else
								$date_from=date("M d, Y h:i a"); 
								//$cur_date=date("M d, Y"); 
								 
								?>
																	
							
								<input type="text" name="order_date_from" size="21" value="<? echo $date_from ?>"   id="sel2"/>
              				<a href="javascript:return false;">
							<img src="../aibl/body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button2" style="cursor: pointer;" alt="Calendar" title="Date selector" /></a>
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
									
										var cal = new Zapatec.Calendar.setup({
											
											inputField     :    "sel2",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											//ifFormat       :    '%a, %b %e, %Y [%I:%M %p]',     // format of the input field
											ifFormat       :    '%b %e, %Y %I:%M %P',     // format of the input field
											//ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											showsTime      :     true,     // show time as well as date
											button         :    "button2"  // trigger button 

										});
		
									</script>
							
							<span class="bodytext">&nbsp;&nbsp;To</span>:
              				<?
								
								if(isset($_POST['search']))								
								$date_to=$_POST[order_date_to];							
								else
								$date_to=date("M d, Y h:i a"); 
								//$cur_date=date("M d, Y g:i"); 
								//$cur_date=date("M d, Y"); 
								 
								?>
																	
							
								<input type="text" name="order_date_to" size="21" value="<? echo $date_to ?>"   id="sel3"/>
              				<a  href="javascript:return false;">
							<img src="../aibl/body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button3" style="cursor: pointer;" alt="Calendar" title="Date selector" /></a>
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
									
										var cal = new Zapatec.Calendar.setup({
											
											inputField     :    "sel3",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											//ifFormat       :    '%a, %b %e, %Y [%I:%M %p]',     // format of the input field
											ifFormat       :    '%b %e, %Y %I:%M %P',     // format of the input field
											//ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											
											showsTime      :     true,     // show time as well as date
											button         :    "button3"  // trigger button 

										});
		
									</script>							
							</TD>							
						  </TR>
                          <TR height="25">						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Sort By</span>:</TD>
                            <TD class=back colSpan=3>
							  <SELECT name="sort_by">							  
							  <OPTION value="approved_date" <? if ('approved_date'==$_POST[sort_by]) echo 'selected'; ?>>Approved Date</OPTION> 					 
							  <OPTION value="req_status" <? if ('req_status'==$_POST[sort_by]) echo 'selected'; ?>>Status of Request</OPTION> 							  
							  <OPTION value="delivery_type" <? if ('delivery_type'==$_POST[sort_by]) echo 'selected'; ?>>Delivery Type</OPTION>
							  <OPTION value="branch" <? if ('branch'==$_POST[sort_by]) echo 'selected'; ?>>Branch</OPTION>  
                             </SELECT>															 																					
							</TD>
						  </TR>
						  
						 
						  
						 </TBODY>
						 		
						 </TABLE> 
						 <BR />
						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Search" name="search"/>
							<input type="reset" value="Reset" />
                  </FORM>
				  <?
				   if(isset($_POST['search']))
					{
				  ?>
				  
				  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>                   		                        						
						<TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
							<?
							echo"
							<TR>
                              <TD class=hf align=left width='112'>
								<B>Account Number</B>
							</TD>
							<TD class=hf align=left width='65'>
								<B>Maker Id</B>
							</TD>
							 <TD class=hf align=left width='75'>
								<B>Req. Branch </B>
								
								</TD>
							 	
							 <TD class=hf align=lef width='95'>
								<B>Account Type </B>
							</TD>
							<TD class=hf align=lef width='100'>
								<B>Start - End Chq No </B>
							</TD>
							<TD class=hf align=lef width='40'>
								<B>D. Type </B>
							</TD>
							<TD class=hf align=lef width='60'>
								<B>Status </B>
							</TD>
							<TD class=hf align=lef width='115'>
								<B>Approved Date</B>
							</TD>
							<TD class=hf align=lef>
								<B>Dispatched Date</B>
							</TD>
							
						  </TR>
						  ";
						?>
						  
											  	 			  
					   </TBODY>
					 </TABLE>
				   </TD></TR>
				</TBODY>
			  </TABLE>
	  				  
				 
				
				  <form name="theform"  method="post"> 
				   <DIV class="syntax_hilite" style="width:100%">
				   <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>                   		                        						
						<TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
						  
					 <? 					
						$logon_user_id=trim($_POST['logon_user_id']);
						$order_date_from=trim($_POST['order_date_from']);
						//$order_date_to=trim($_POST['order_date_to']);
						//$order_date_to=date ("M d, Y", $_POST['order_date_to']+strtotime("+1 day"));
						$order_date_to=date('Y-m-d-H-i',strtotime($_POST['order_date_to']));	
						$ac_name=trim($_POST['ac_name']);
						$ac_no_branch=trim($_POST['ac_no_branch']);
						$ac_no_cus_no=trim($_POST['ac_no_cus_no']);
					 	$ac_no_suffix=trim($_POST['ac_no_suffix']);	
						$req_branch=trim($_POST['req_branch']);
						$req_status=trim($_POST['req_status']);
						$severity=trim($_POST['severity']);
						$sort_by=trim($_POST['sort_by']);
						
					  if((!empty($order_date_from)) || (!empty($order_date_to))|| (!empty($ac_name))||(!empty($logon_user_id))|| (!empty($ac_no_branch))||(!empty($ac_no_cus_no))|| (!empty($ac_no_suffix))||(!empty($req_branch))||(!empty($req_status)||(!empty($severity))))
					  {						  						
						$searchcriteria = array();
						
						if(!empty($logon_user_id))
							$searchcriteria[] = "aibl_chq_rqst.rqst_by like '$logon_user_id%'";	
								
						if(!empty($ac_no_branch))
							$searchcriteria[] = "ac_no_branch like '$ac_no_branch%'";	
							
						if(!empty($ac_no_cus_no))
							$searchcriteria[] = "ac_no_cus_no like '$ac_no_cus_no%'";
							
						if(!empty($ac_no_suffix))
							$searchcriteria[] = "ac_no_suffix like '$ac_no_suffix%'";		
																					
						if(!empty($ac_name))
							$searchcriteria[] = "cus_name like '%$ac_name%'";
						
						if(!empty($req_branch))
							$searchcriteria[] = "collecting_branch like '%$req_branch%'";
							
						if(!empty($req_status))
							$searchcriteria[] = "rqst_status like '$req_status%'";
							
						if(!empty($severity))
							$searchcriteria[] = "severity like '$severity%'";
																					
						
						/*if(!empty($order_date_from) && !empty($order_date_to))
						{							
							$date_from=date('Y-m-d h:i:s', strtotime($order_date_from));							
							$date_to=date('Y-m-d h:i:s', strtotime($order_date_to));							
							$searchcriteria[] = "order_date_time between '$date_from' AND '$date_to'";	
						}*/		
						$searchdate = array();														
						if(!empty($order_date_from) && !empty($order_date_to))
						{							
							$date_from=date('Y-m-d H:i', strtotime($order_date_from));							
							$date_to=date('Y-m-d H:i', strtotime($order_date_to));	
							$date=explode("-", "$order_date_to");					 		
							$i=$date[4];
							$h=$date[3];
							$d=$date[2];
							$m=$date[1];						
							$y=$date[0];					
							//$date_to=date('Y-m-d H:i',mktime($h, $i, 0, $m, $d+1, $y));													
							$searchdate[] = "order_date_time between '$date_from' AND '$date_to'";	
							$searchdate[] = "dispatch_datetime between '$date_from' AND '$date_to'";
							$searchdate[] = "approval_date_time between '$date_from' AND '$date_to'";	
							$searchdate[] = "delivered_datetime between '$date_from' AND '$date_to'";
							if(count($searchdate)>0)
								{
							$searchcriteria[] = ($searchdate)?" (".join(" or ",$searchdate)." )":"";;
							}
																					
						}			
						
						
						
						$searchtext = array();
		
						if(count($searchcriteria)>0)
						{
							$searchtext[] = ($searchcriteria)?" (".join(" and ",$searchcriteria)." )":"";;
						}
						
						if($sort_by=="approved_date") 
							$order = " order by approval_date_time desc ";
						if($sort_by=="req_status") 
							$order = " order by rqst_status ";
						if($sort_by=="delivery_type") 
							$order = " order by severity ";
						if($sort_by=="branch") 
							$order = " order by collecting_branch ";
						
						$querystring = "";
						$querystring = ($searchtext)?join(" and ",$searchtext):"";
						if(!empty($querystring))
							$querystring = " where ".$querystring;
						
							$query1="select * from aibl_chq_rqst".$querystring.$order;	
							//$query1="select *from aibl_chq_rqst".$querystring;	
							
							$result1 = mysql_query($query1) or
							die(mysql_error());
							
							if (mysql_num_rows($result1) != 0){
							
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;

							while ($row =mysql_fetch_assoc($result1))
							{
								//$order_date=str_replace('-','/',$row['approval_date_time']); 																							
								if(($row['approval_date_time'])!=0){
								$date=str_replace('-','/',$row['approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if(($row['dispatch_datetime'])!=0){
								$dis_date=str_replace('-','/',$row['dispatch_datetime']); 
								$dis_date=date('M d, Y h:i a', strtotime($dis_date));								
								}
								else 
								$dis_date= "Not yet Dispached";
								
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								
								$req_id[]=$row['rqst_id'];
								echo "<tr>
								<input type='hidden' name='id[]' value=".$row['rqst_id'].">
								<td class=$class width='99'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\" style='text-decoration:underline'>".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>
								<td class=$class width='65'>".$row['rqst_by']."</td>
								<td class=$class width='75'>".strtok($row['collecting_branch'], " ")."</td>
								<td class=$class width='95'>".$row['ac_type']."- ".$row['total_leaf']."X".$row['books']." Lvs</td>
								<td class=$class width='100' align='center'>".$row['start_no']."- ".$row['end_no']."</td>
								<td class=$class width='40'>".$row['severity']."</td>
								<td class=$class width='60'>$status</td>
								<td class=$class width='115'>".$row['approval_date_time']."</td>	
								<td class=$class>".$row['dispatch_datetime']."</td>						
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}
								
							  }
							  $result_search_order_date=true;
							}													
						}
					
					
				if ($result_search_order_date==false)
				{
					$alart="There are no results to display. Please re-check and try again";

			    	echo "<tr><td class=hf colspan=4><font size=3px><b>$alart</b></font></td></tr>";
				}				
				else{
					foreach($req_id as $key=>$value) {
						$strArray .= "id[$key]=$value&";
					}
				}
				$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1000,height=570,directories=no,location=no';
				$link = '../aibl/popups/search_request_print.php';
				?>  
						  
											  	 			  
					   </TBODY>
					 </TABLE>
				   </TD></TR>
				</TBODY>
			  </TABLE>
			  </DIV>
              <br />
                
				 <div style="float:left; width:200px;">				 						
					
				  <input name="chkExcel"  type="image" src="../aibl/images/excel.gif" width="23" height="22" border="0"  align="absmiddle" onClick="document.theform.action='../aibl/excel/report_search_excel.php';"> 
				  </div>
				 
				  <div style="float:right; width:230px;"> 		
					<input name="ckkPrint"  type="image" src="../aibl/images/printer.gif" border="0" align="absmiddle" onclick="PopSearchPrint(this.form);" title="Print Version"> 
					
				 </div>  
				 </form>       
			
<?
 }
}
//--------------------------------SEARCH AS PER LOGON USER ----------------------------------------------------
if(($option=='search_criteria')&&($task=='search_logon_user'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=500');
}
</script>
                  
				<FORM name="frmSearch" action="index.php?option=search_criteria&task=search_logon_user" method="post">
				<TABLE class=border cellSpacing=1 cellPadding=2 width="100%" border=0>
						
                          <TBODY>
						   <TR>
                            <TD class=info align=left colSpan=4>
								<B>Serach for Login User</B>											
							</TD>
						  </TR>
						  <TR height="25">
						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">User Id</span>:</TD>
                            <TD class=back colSpan=3>
								<input type="text" name="logon_user_id" size="35"  value="<? echo $_POST[logon_user_id]; ?>" />								 						
															
							</TD>
						  </TR>
						  <TR height="25">
						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">User Name</span>:</TD>
                            <TD class=back colSpan=3>
								<input type="text" name="logon_user_name" size="35"  value="<? echo $_POST[logon_user_name]; ?>" />								 						
															
							</TD>
						  </TR>
						  
						  
						  
						 </TBODY>
						 		
						 </TABLE> 
						 <BR />
						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Search" name="search"/>
							<input type="reset" value="Reset" />
                  </FORM>
				  <?
				   if(isset($_POST['search']))
					{
				  ?>
				   <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                   		
                        
						
						<TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
					 <? 					
						
						$logon_user_id=trim($_POST['logon_user_id']);
						$logon_user_name=trim($_POST['logon_user_name']);
						
						
					  if((!empty($logon_user_id)) || (!empty($logon_user_name)))
					  {						  						
						$searchcriteria = array();
																		
						
						if(!empty($logon_user_id))
							$searchcriteria[] = "aibl_chq_rqst.rqst_by like '$logon_user_id%'";
							
						if(!empty($logon_user_name))
							$searchcriteria[] = "aibl_login.branch_user_name like '$logon_user_name%'";
						
						$searchtext = array();
		
						if(count($searchcriteria)>0)
						{
							$searchtext[] = ($searchcriteria)?" (".join(" and ",$searchcriteria)." )":"";;
						}
						
						$querystring = "";
						$querystring = ($searchtext)?join(" and ",$searchtext):"";
						if(!empty($querystring))
							$querystring = " where ".$querystring;
						
						
							$query1="select aibl_chq_rqst.*,aibl_login.*  from aibl_chq_rqst,aibl_login".$querystring." && aibl_chq_rqst.rqst_by=aibl_login.user_id";	
							$result1 = mysql_query($query1) or
							die(mysql_error());
							
							if (mysql_num_rows($result1) != 0){
							echo"
							<TR>
                            <TD class=hf align=left>
								<B>Account Number</B>
							</TD>
							 <TD class=hf align=left>
								<B>Requester Branch </B>
								
								</TD>
							 	
							 <TD class=hf align=lef>
								<B>Account Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Delivery Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Status of request </B>
							</TD>
							<TD class=hf align=lef>
								<B>Order Date and Time</B>
							</TD>
							<TD class=hf align=center>
								<B>Action</B>
							</TD>
						  </TR>
						  ";
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;

							while ($row =mysql_fetch_assoc($result1))
							{																
								$date=str_replace('-','/',$row['order_date_time']); 
								
								echo "<tr>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\" style='text-decoration:underline'>".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>
								<td class=$class>".$row['collecting_branch']."</td>
								<td class=$class>".$row['ac_type']."- ".$row['total_leaf']." Leaves</td>
								<td class=$class>".$row['severity']."</td>
								<td class=$class>".$row['rqst_status']."</td>
								<td class=$class>".date('M d, Y h:i', strtotime($date))."</td>
								<td class=$class align=center><span class=red>[<a onclick=\"return confirm('Are you sure?');\"  class=edit href=index.php?task=delete_chk_request_admin&rqst_id=".$row['rqst_id'].">Delete</a>]</span></td>
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}
								
							  }
							  $result_search_order_date=true;
							}													
						}
					/*else
					{
					 $result_search_all=false;
					 echo "<tr><td class=hf><font size=3px><b>Search criteria is empty</b></font></td></tr>";
					}*/
					
				if ($result_search_order_date==false)
				{
					$alart="There are no results to display. Please re-check and try again";

			    	echo "<tr><td class=hf colspan=4><font size=3px><b>$alart</b></font></td></tr>";
				}
				
				
				?>  
						  
											  	 			  
					   </TBODY>
					 </TABLE>
				   </TD></TR>
				</TBODY>
			  </TABLE>
                  
			
<?
 }
}

//--------------------------------SEARCH ACCOUNT NUMBER ----------------------------------------------------
if(($option=='search_criteria')&&($task=='search_account_name'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=500');
}
</script>
                  
				<FORM name="frmSearch" action="index.php?option=search_criteria&task=search_account_name" method="post">
				<TABLE class=border cellSpacing=1 cellPadding=2 width="100%" border=0>
						
                          <TBODY>
						   <TR>
                            <TD class=info align=left colSpan=4>
								<B>Serach for Account Name </B>											
							</TD>
						  </TR>
						  <TR height="25">
						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Account Name</span>:</TD>
                            <TD class=back colSpan=3>
								<input type="text" name="ac_name" size="35"  value="<? echo $_POST[ac_name]; ?>" />								 						
															
							</TD>
						  </TR>
						  
						  <TR>
                          <TD class=back2 align=right><label for="search_searchword">Ordered Date: </label></TD>
                            <TD class=back align=left><span class="bodytext">From</span>:
							
              				<?
								if(isset($_POST['search']))								
								$date_from=$_POST[order_date_from];							
								else
								$date_from=date("M d, Y g:i"); 
								//$cur_date=date("M d, Y"); 
								 
								?>
																	
							
								<input type="text" name="order_date_from" size="18" value="<? echo $date_from ?>"   id="sel2"/>
              				<a href="javascript:return false;">
							<img src="../aibl/body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button2" style="cursor: pointer;" alt="Calendar" title="Date selector" /></a>
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
									
										var cal = new Zapatec.Calendar.setup({
											
											inputField     :    "sel2",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											//ifFormat       :    '%a, %b %e, %Y [%I:%M %p]',     // format of the input field
											ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											//ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											showsTime      :     true,     // show time as well as date
											button         :    "button2"  // trigger button 

										});
		
									</script>
							
							<span class="bodytext">&nbsp;&nbsp;To</span>:
              				<?
								
								if(isset($_POST['search']))								
								$date_to=$_POST[order_date_to];							
								else
								$date_to=date("M d, Y g:i"); 
								//$cur_date=date("M d, Y g:i"); 
								//$cur_date=date("M d, Y"); 
								 
								?>
																	
							
								<input type="text" name="order_date_to" size="18" value="<? echo $date_to ?>"   id="sel3"/>
              				<a  href="javascript:return false;">
							<img src="../aibl/body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button3" style="cursor: pointer;" alt="Calendar" title="Date selector" /></a>
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
									
										var cal = new Zapatec.Calendar.setup({
											
											inputField     :    "sel3",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											//ifFormat       :    '%a, %b %e, %Y [%I:%M %p]',     // format of the input field
											ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											//ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											showsTime      :     true,     // show time as well as date
											button         :    "button3"  // trigger button 

										});
		
									</script>
							
							</TD>
							
						  </TR>
                          
						  
						 
						  
						 </TBODY>
						 		
						 </TABLE> 
						 <BR />
						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Search" name="search"/>
							<input type="reset" value="Reset" />
                  </FORM>
				  <?
				   if(isset($_POST['search']))
					{
				  ?>
				   <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                   		
                        
						
						<TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
					 <? 					
						
						$order_date_from=trim($_POST['order_date_from']);
						$order_date_to=trim($_POST['order_date_to']);
						$ac_name=trim($_POST['ac_name']);
						
					  if((!empty($order_date_from)) || (!empty($order_date_to))|| (!empty($ac_name)))
					  {						  						
						$searchcriteria = array();
																		
						
						if(!empty($ac_name))
							$searchcriteria[] = "cus_name like '%$ac_name%'";
							
							
						if(!empty($order_date_from) && !empty($order_date_to))
						{
							
							$date_from=date('Y-m-d h:i:s', strtotime($order_date_from));
							
							$date_to=date('Y-m-d h:i:s', strtotime($order_date_to));
							
							$searchcriteria[] = "order_date_time between '$date_from' AND '$date_to'";	
						}						
						
						$searchtext = array();
		
						if(count($searchcriteria)>0)
						{
							$searchtext[] = ($searchcriteria)?" (".join(" and ",$searchcriteria)." )":"";;
						}
						
						$querystring = "";
						$querystring = ($searchtext)?join(" and ",$searchtext):"";
						if(!empty($querystring))
							$querystring = " where ".$querystring;
						
						
							$query1="select *from aibl_chq_rqst".$querystring;	
							$result1 = mysql_query($query1) or
							die(mysql_error());
							
							if (mysql_num_rows($result1) != 0){
							echo"
							<TR>
                            <TD class=hf align=left>
								<B>Account Number</B>
							</TD>
							 <TD class=hf align=left>
								<B>Requester Branch </B>
								
								</TD>
							 	
							 <TD class=hf align=lef>
								<B>Account Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Delivery Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Status of request </B>
							</TD>
							<TD class=hf align=lef>
								<B>Order Date and Time</B>
							</TD>
							<TD class=hf align=center>
								<B>Action</B>
							</TD>
						  </TR>
						  ";
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;

							while ($row =mysql_fetch_assoc($result1))
							{
								
								
								$date=str_replace('-','/',$row['order_date_time']); 
								
								echo "<tr>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\" style='text-decoration:underline'>".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>
								<td class=$class>".$row['collecting_branch']."</td>
								<td class=$class>".$row['ac_type']."- ".$row['total_leaf']." Leaves</td>
								<td class=$class>".$row['severity']."</td>
								<td class=$class>".$row['rqst_status']."</td>
								<td class=$class>".date('M d, Y h:i', strtotime($date))."</td>
								<td class=$class align=center><span class=red>[<a onclick=\"return confirm('Are you sure?');\"  class=edit href=index.php?task=delete_chk_request_admin&rqst_id=".$row['rqst_id'].">Delete</a>]</span></td>
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}
								
							  }
							  $result_search_order_date=true;
							}													
						}
					/*else
					{
					 $result_search_all=false;
					 echo "<tr><td class=hf><font size=3px><b>Search criteria is empty</b></font></td></tr>";
					}*/
					
				if ($result_search_order_date==false)
				{
					$alart="There are no results to display. Please re-check and try again";

			    	echo "<tr><td class=hf colspan=4><font size=3px><b>$alart</b></font></td></tr>";
				}
				
				
				?>  
						  
											  	 			  
					   </TBODY>
					 </TABLE>
				   </TD></TR>
				</TBODY>
			  </TABLE>
                  
			
<?
 }
}


//--------------------------------SEARCH CUSTOMER NAME/ACCOUNT NAME ----------------------------------------------------
if(($option=='search_criteria')&&($task=='search_account_no'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=500');
}
</script>
                  
				<FORM name="frmCheque" action="index.php?option=search_criteria&task=search_account_no" method="post">
				<TABLE class=border cellSpacing=1 cellPadding=2 width="100%" border=0>
						
                          <TBODY>
						   <TR>
                            <TD class=info align=left colSpan=4>
								<B>Serach for Account Number </B>											
							</TD>
						  </TR>
						  <TR height="25">
						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Account No</span>:</TD>
                            <TD class=back colSpan=3>
								<input type="text" name="ac_no_branch" size="4" maxlength="4" value="<? echo $_POST[ac_no_branch]; ?>"
								 onKeyUp="advance_ac_no_cus_no(this,'ac_no_cus_no');" 								 
								 onkeypress="return isNumberKey(event)" 								 
								>                                
								-&nbsp;
                                <input type="text"  name="ac_no_cus_no" size="6" maxlength="6" value="<? echo $_POST[ac_no_cus_no]; ?>" 
								onKeyUp="advance_ac_no_suffix(this,'ac_no_suffix');" 								
								onkeypress="return isNumberKey(event)" 								
								>
							    -&nbsp;<input type="text" name="ac_no_suffix" size="3" maxlength="3" value="<? echo $_POST[ac_no_suffix]; ?>" 
								onkeypress="return isNumberKey(event)"								
								>							
							</TD>
						  </TR>
						  
						  <TR>
                          <TD class=back2 align=right><label for="search_searchword">Ordered Date: </label></TD>
                            <TD class=back align=left><span class="bodytext">From</span>:
							
              				<?
								if(isset($_POST['search']))								
								$date_from=$_POST[order_date_from];							
								else
								$date_from=date("M d, Y g:i"); 
								//$cur_date=date("M d, Y"); 
								 
								?>
																	
							
								<input type="text" name="order_date_from" size="18" value="<? echo $date_from ?>"   id="sel2"/>
              				<a href="javascript:return false;">
							<img src="../aibl/body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button2" style="cursor: pointer;" alt="Calendar" title="Date selector" /></a>
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
									
										var cal = new Zapatec.Calendar.setup({
											
											inputField     :    "sel2",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											//ifFormat       :    '%a, %b %e, %Y [%I:%M %p]',     // format of the input field
											ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											//ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											showsTime      :     true,     // show time as well as date
											button         :    "button2"  // trigger button 

										});
		
									</script>
							
							<span class="bodytext">&nbsp;&nbsp;To</span>:
              				<?
								
								if(isset($_POST['search']))								
								$date_to=$_POST[order_date_to];							
								else
								$date_to=date("M d, Y g:i"); 
								//$cur_date=date("M d, Y g:i"); 
								//$cur_date=date("M d, Y"); 
								 
								?>
																	
							
								<input type="text" name="order_date_to" size="18" value="<? echo $date_to ?>"   id="sel3"/>
              				<a  href="javascript:return false;">
							<img src="../aibl/body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button3" style="cursor: pointer;" alt="Calendar" title="Date selector" /></a>
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
									
										var cal = new Zapatec.Calendar.setup({
											
											inputField     :    "sel3",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											//ifFormat       :    '%a, %b %e, %Y [%I:%M %p]',     // format of the input field
											ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											//ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											showsTime      :     true,     // show time as well as date
											button         :    "button3"  // trigger button 

										});
		
									</script>
							
							</TD>
							
						  </TR>
                          
						  
						 
						  
						 </TBODY>
						 		
						 </TABLE> 
						 <BR />
						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Search" name="search"/>
							<input type="reset" value="Reset" />
                  </FORM>
				  <?
				   if(isset($_POST['search']))
					{
				  ?>
				   <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                   		
                        
						
						<TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
					 <? 					
						
						$order_date_from=trim($_POST['order_date_from']);
						$order_date_to=trim($_POST['order_date_to']);
						$ac_no_branch=trim($_POST['ac_no_branch']);
						$ac_no_cus_no=trim($_POST['ac_no_cus_no']);
					 	$ac_no_suffix=trim($_POST['ac_no_suffix']);		
									  
					  if((!empty($order_date_from)) || (!empty($order_date_to))|| (!empty($ac_no_branch))|| (!empty($ac_no_cus_no))|| (!empty($ac_no_suffix)))
					  {						  						
						$searchcriteria = array();
																		
						if(!empty($ac_no_branch))
							$searchcriteria[] = "ac_no_branch like '$ac_no_branch%'";	
							
						if(!empty($ac_no_cus_no))
							$searchcriteria[] = "ac_no_cus_no like '$ac_no_cus_no%'";
							
						if(!empty($ac_no_suffix))
							$searchcriteria[] = "ac_no_suffix like '$ac_no_suffix%'";
							
							
						if(!empty($order_date_from) && !empty($order_date_to))
						{
							
							$date_from=date('Y-m-d h:i:s', strtotime($order_date_from));
							
							$date_to=date('Y-m-d h:i:s', strtotime($order_date_to));
							
							$searchcriteria[] = "order_date_time between '$date_from' AND '$date_to'";	
						}						
						
						$searchtext = array();
		
						if(count($searchcriteria)>0)
						{
							$searchtext[] = ($searchcriteria)?" (".join(" and ",$searchcriteria)." )":"";;
						}
						
						$querystring = "";
						$querystring = ($searchtext)?join(" and ",$searchtext):"";
						if(!empty($querystring))
							$querystring = " where ".$querystring;
						
						
							$query1="select *from aibl_chq_rqst".$querystring;	
							$result1 = mysql_query($query1) or
							die(mysql_error());
							
							if (mysql_num_rows($result1) != 0){
							echo"
							<TR>
                            <TD class=hf align=left>
								<B>Account Number</B>
							</TD>
							 <TD class=hf align=left>
								<B>Requester Branch </B>
								
								</TD>
							 	
							 <TD class=hf align=lef>
								<B>Account Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Delivery Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Status of request </B>
							</TD>
							<TD class=hf align=lef>
								<B>Order Date and Time</B>
							</TD>
							<TD class=hf align=center>
								<B>Action</B>
							</TD>
						  </TR>
						  ";
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;

							while ($row =mysql_fetch_assoc($result1))
							{
								
								
								$date=str_replace('-','/',$row['order_date_time']); 
								
								echo "<tr>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\" style='text-decoration:underline'>".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>
								<td class=$class>".$row['collecting_branch']."</td>
								<td class=$class>".$row['ac_type']."- ".$row['total_leaf']." Leaves</td>
								<td class=$class>".$row['severity']."</td>
								<td class=$class>".$row['rqst_status']."</td>
								<td class=$class>".date('M d, Y h:i', strtotime($date))."</td>
								<td class=$class align=center><span class=red>[<a onclick=\"return confirm('Are you sure?');\"  class=edit href=index.php?task=delete_chk_request_admin&rqst_id=".$row['rqst_id'].">Delete</a>]</span></td>
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}
								
							  }
							  $result_search_order_date=true;
							}													
						}
					/*else
					{
					 $result_search_all=false;
					 echo "<tr><td class=hf><font size=3px><b>Search criteria is empty</b></font></td></tr>";
					}*/
					
				if ($result_search_order_date==false)
				{
					$alart="There are no results to display. Please re-check and try again";

			    	echo "<tr><td class=hf colspan=4><font size=3px><b>$alart</b></font></td></tr>";
				}
				
				
				?>  
						  
											  	 			  
					   </TBODY>
					 </TABLE>
				   </TD></TR>
				</TBODY>
			  </TABLE>
                  
			
<?
 }
}


// ----------------------------------------SEARCH FOR ORDERED DATE AND TIME-------------------------------


if(($option=='search_criteria')&&($task=='search_order_date'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=500');
}
</script>
                  
				<FORM name="frmSearch" action="index.php?option=search_criteria&task=search_order_date" method="post">
				<TABLE class=border cellSpacing=1 cellPadding=2 width="100%" border=0>
						
                          <TBODY>
						    <TR>
                            <TD class=info align=left colSpan=4>
								<B>Serach for Order Date </B>											
							</TD>
						  </TR>
						  <TR>
                          <TD class=back2 align=right><label for="search_searchword">Ordered Date: </label></TD>
                            <TD class=back align=left><span class="bodytext">From</span>:
							
              				<?
								if(isset($_POST['search']))								
								$date_from=$_POST[order_date_from];							
								else
								$date_from=date("M d, Y g:i"); 
								//$cur_date=date("M d, Y"); 
								 
								?>
																	
							
								<input type="text" name="order_date_from" size="18" value="<? echo $date_from ?>"   id="sel2"/>
              				<a href="javascript:return false;">
							<img src="../aibl/body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button2" style="cursor: pointer;" alt="Calendar" title="Date selector" /></a>
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
									
										var cal = new Zapatec.Calendar.setup({
											
											inputField     :    "sel2",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											//ifFormat       :    '%a, %b %e, %Y [%I:%M %p]',     // format of the input field
											ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											//ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											showsTime      :     true,     // show time as well as date
											button         :    "button2"  // trigger button 

										});
		
									</script>
							
							<span class="bodytext">&nbsp;&nbsp;To</span>:
              				<?
								
								if(isset($_POST['search']))								
								$date_to=$_POST[order_date_to];							
								else
								$date_to=date("M d, Y g:i"); 
								//$cur_date=date("M d, Y g:i"); 
								//$cur_date=date("M d, Y"); 
								 
								?>
																	
							
								<input type="text" name="order_date_to" size="18" value="<? echo $date_to ?>"   id="sel3"/>
              				<a  href="javascript:return false;">
							<img src="../aibl/body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button3" style="cursor: pointer;" alt="Calendar" title="Date selector" /></a>
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
									
										var cal = new Zapatec.Calendar.setup({
											
											inputField     :    "sel3",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											//ifFormat       :    '%a, %b %e, %Y [%I:%M %p]',     // format of the input field
											ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											//ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											showsTime      :     true,     // show time as well as date
											button         :    "button3"  // trigger button 

										});
		
									</script>
							
							</TD>
							
						  </TR>
						  
						 
						  
						 </TBODY>
						 		
						 </TABLE> 
						 <BR />
						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Search" name="search"/>
							<input type="reset" value="Reset" />
                  </FORM>
				  <?
				   if(isset($_POST['search']))
					{
				  ?>
				   <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                   		
                        
						
						<TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
					 <? 					
						
						$order_date_from=trim($_POST['order_date_from']);
						$order_date_to=trim($_POST['order_date_to']);
					 						  
					  if((!empty($order_date_from)) || (!empty($order_date_to)))
					  {						  						
						$searchcriteria = array();
						
						if(!empty($searchword))
							$searchcriteria[] = "collecting_branch like '%$searchword%'";	
						if(!empty($searchword) && $key=='any')
							$searchcriteria[] = "collecting_branch like '%$searchword%'";							
						if(!empty($searchword) && $key=='any_words')
							$searchcriteria[] = "collecting_branch like '$searchword%'";
						if(!empty($searchword) && $key=='all_words')
							$searchcriteria[] = "collecting_branch='$searchword'";	
						
						if(!empty($severity))
							$searchcriteria[] = "severity like '$severity%'";	
							
							
							
							
						if(!empty($order_date_from) && !empty($order_date_to))
						{
							
							$date_from=date('Y-m-d h:i:s', strtotime($order_date_from));
							
							$date_to=date('Y-m-d h:i:s', strtotime($order_date_to));
							
							$searchcriteria[] = "order_date_time between '$date_from' AND '$date_to'";	
						}						
						
						$searchtext = array();
		
						if(count($searchcriteria)>0)
						{
							$searchtext[] = ($searchcriteria)?" (".join(" and ",$searchcriteria)." )":"";;
						}
						
						$querystring = "";
						$querystring = ($searchtext)?join(" and ",$searchtext):"";
						if(!empty($querystring))
							$querystring = " where ".$querystring;
						
						
							$query1="select * from aibl_chq_rqst".$querystring;	
							$result1 = mysql_query($query1) or
							die(mysql_error());
							
							if (mysql_num_rows($result1) != 0){
							echo"
							<TR>
                            <TD class=hf align=left>
								<B>Account Number</B>
							</TD>
							 <TD class=hf align=left>
								<B>Requester Branch </B>
								
								</TD>
							 	
							 <TD class=hf align=lef>
								<B>Account Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Delivery Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Status of request </B>
							</TD>
							<TD class=hf align=lef>
								<B>Order Date and Time</B>
							</TD>
							<TD class=hf align=center>
								<B>Action</B>
							</TD>
						  </TR>
						  ";
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;

							while ($row =mysql_fetch_assoc($result1))
							{
								
								
								$date=str_replace('-','/',$row['order_date_time']); 
								
								echo "<tr>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\" style='text-decoration:underline'>".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>
								<td class=$class>".$row['collecting_branch']."</td>
								<td class=$class>".$row['ac_type']."- ".$row['total_leaf']." Leaves</td>
								<td class=$class>".$row['severity']."</td>
								<td class=$class>".$row['rqst_status']."</td>
								<td class=$class>".date('M d, Y h:i', strtotime($date))."</td>
								<td class=$class align=center><span class=red>[<a onclick=\"return confirm('Are you sure?');\"  class=edit href=index.php?task=delete_chk_request_admin&rqst_id=".$row['rqst_id'].">Delete</a>]</span></td>
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}
								
							  }
							  $result_search_order_date=true;
							}													
						}
					/*else
					{
					 $result_search_all=false;
					 echo "<tr><td class=hf><font size=3px><b>Search criteria is empty</b></font></td></tr>";
					}*/
					
				if ($result_search_order_date==false)
				{
					$alart="There are no results to display. Please re-check and try again";

			    	echo "<tr><td class=hf colspan=4><font size=3px><b>$alart</b></font></td></tr>";
				}
				
				
				?>  
						  
											  	 			  
					   </TBODY>
					 </TABLE>
				   </TD></TR>
				</TBODY>
			  </TABLE>
                  
			
<?
 }
}

//--------------------------------SEARCH AS Request Status ----------------------------------------------------
if(($option=='search_criteria')&&($task=='search_status'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=500');
}
</script>
                  
				<FORM name="frmSearch" action="index.php?option=search_criteria&task=search_status" method="post">
				<TABLE class=border cellSpacing=1 cellPadding=2 width="100%" border=0>
						
                          <TBODY>
						   <TR>
                            <TD class=info align=left colSpan=4>
								<B>Serach for Request Status</B>											
							</TD>
						  </TR>
						  <TR height="25">
						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Branch Name</span>:</TD>
                            <TD class=back colSpan=3>
								<input type="text" name="req_branch" size="35"  value="<? echo $_POST[req_branch]; ?>" />								 						
															
							</TD>
						  </TR>
						  <TR height="25">
						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Status of Request</span>:</TD>
                            <TD class=back colSpan=3>
							  <SELECT name="req_status">
							  <OPTION value="" >ALL...</option>		
							  <OPTION value="pending" <? if ('pending'==$_POST[req_status]) echo 'selected'; ?>>Pending</OPTION> 					 
							  <OPTION value="ordered" <? if ('ordered'==$_POST[req_status]) echo 'selected'; ?>>Ordered</OPTION> 							  
							  <OPTION value="dispatched" <? if ('dispatched'==$_POST[req_status]) echo 'selected'; ?>>Dispatched</OPTION> 
                              <OPTION value="delivered" <? if ('delivered'==$_POST[req_status]) echo 'selected'; ?>>Delivered</OPTION>  
							  </SELECT>															 						
															
							</TD>
						  </TR>
						  
						  
						  
						 </TBODY>
						 		
						 </TABLE> 
						 <BR />
						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Search" name="search"/>
							<input type="reset" value="Reset" />
                  </FORM>
				  <?
				   if(isset($_POST['search']))
					{
				  ?>
				   <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                   		
                        
						
						<TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
					 <? 					
						
						$req_branch=trim($_POST['req_branch']);
						$req_status=trim($_POST['req_status']);
						
						
					  if((!empty($req_branch)) || (!empty($req_status)))
					  {						  						
						$searchcriteria = array();
																		
						
						if(!empty($req_branch))
							$searchcriteria[] = "collecting_branch like '$req_branch%'";
							
						if(!empty($req_status))
							$searchcriteria[] = "rqst_status like '$req_status%'";
						
						$searchtext = array();
		
						if(count($searchcriteria)>0)
						{
							$searchtext[] = ($searchcriteria)?" (".join(" and ",$searchcriteria)." )":"";;
						}
						
						$querystring = "";
						$querystring = ($searchtext)?join(" and ",$searchtext):"";
						if(!empty($querystring))
							$querystring = " where ".$querystring;
						
						
							$query1="select * from aibl_chq_rqst".$querystring;		
							$result1 = mysql_query($query1) or
							die(mysql_error());
							
							if (mysql_num_rows($result1) != 0){
							echo"
							<TR>
                            <TD class=hf align=left>
								<B>Account Number</B>
							</TD>
							 <TD class=hf align=left>
								<B>Requester Branch </B>
								
								</TD>
							 	
							 <TD class=hf align=lef>
								<B>Account Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Delivery Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Status of request </B>
							</TD>
							<TD class=hf align=lef>
								<B>Order Date and Time</B>
							</TD>
							<TD class=hf align=center>
								<B>Action</B>
							</TD>
						  </TR>
						  ";
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;

							while ($row =mysql_fetch_assoc($result1))
							{
								
								
								$date=str_replace('-','/',$row['order_date_time']); 
								
								echo "<tr>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\" style='text-decoration:underline'>".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>
								<td class=$class>".$row['collecting_branch']."</td>
								<td class=$class>".$row['ac_type']."- ".$row['total_leaf']." Leaves</td>
								<td class=$class>".$row['severity']."</td>
								<td class=$class>".$row['rqst_status']."</td>
								<td class=$class>".date('M d, Y h:i', strtotime($date))."</td>
								<td class=$class align=center><span class=red>[<a onclick=\"return confirm('Are you sure?');\"  class=edit href=index.php?task=delete_chk_request_admin&rqst_id=".$row['rqst_id'].">Delete</a>]</span></td>
								</tr>";
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}
								
							  }
							  $result_search_order_date=true;
							}													
						}
					/*else
					{
					 $result_search_all=false;
					 echo "<tr><td class=hf><font size=3px><b>Search criteria is empty</b></font></td></tr>";
					}*/
					
				if ($result_search_order_date==false)
				{
					$alart="There are no results to display. Please re-check and try again";

			    	echo "<tr><td class=hf colspan=4><font size=3px><b>$alart</b></font></td></tr>";
				}
				
				
				?>  
						  
											  	 			  
					   </TBODY>
					 </TABLE>
				   </TD></TR>
				</TBODY>
			  </TABLE>
                  
			
<?
 }
}
?>

				</TD></TR>
			</TBODY>
		</TABLE>
	