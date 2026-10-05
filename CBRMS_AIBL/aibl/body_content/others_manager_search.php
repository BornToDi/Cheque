<?php
include_once ("../config.php");
include_once ("../tex_common.php");

if (empty($_SESSION['username'])||($_SESSION['user_type']!='manager'))
{
	redirectUrl('manager_signin.php');
}

$task=$_REQUEST['task'];
$option=$_REQUEST['option'];
?>
	<SCRIPT language=javascript1.2 src="js/common.js" type=text/javascript></SCRIPT>
    <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Requested Security Item Information </B>
							</TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
 				</TABLE><br />
<?
//--------------------------------SEARCH ALL ----------------------------------------------------
if(($option=='others_manager_search_criteria')&&($task=='search_all'))
{
?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=450');
}
</script>
                  
				<FORM name="frmSearch" action="index.php?option=others_manager_search_criteria&task=search_all" method="post">
				<TABLE class=border cellSpacing=1 cellPadding=2 width="100%" border=0>
						
                          <TBODY>
						   <TR>
                            <TD class=info align=left colSpan=4>
								<B>Serach for all criteria </B>											
							</TD>
						  </TR>
						  <TR>						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Logon User Id</span>:</TD>
                            <TD class=back colSpan=3>
								<input type="text" name="logon_user_id" size="35"  value="<? echo $_POST[logon_user_id]; ?>" />								 																					
							</TD>
						  </TR>
						  
						  <TR height="25">						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Item Type</span>:</TD>
                            <TD class=back colSpan=3>
							<SELECT name="item_type">							 
							  <OPTION value="">Please Select an Item</OPTION> 
							  <OPTION value="PO">PO-Pay Order</OPTION> 
							  <OPTION value="DD">DD-Demand Draft</OPTION>
							  <OPTION value="SDR">SDR-Security Deposit Receipt</OPTION>
							  <OPTION value="FDD">FDD-Foreign Deposit Draft</OPTION> 	
							  <OPTION value="FDR">FDR-Fixed Deposit Receipt</OPTION>								  						   						  
                            </SELECT>							 						
															
							</TD>
						  </TR>
						  						  						  						  
						  <TR>
                          <TD class=back2 align=right><label for="search_searchword">Status of Request: </label></TD>
                            <TD class=back align=left>
							<SELECT name="req_status">							  
							  <OPTION value="pending" <? if ('pending'==$_POST[req_status]) echo 'selected'; ?>>Approved(Pending)</OPTION> 
							  <OPTION value="ordered" <? if ('ordered'==$_POST[req_status]) echo 'selected'; ?>>Ordered</OPTION> 														  					 							  						  
							  <OPTION value="dispatched" <? if ('dispatched'==$_POST[req_status]) echo 'selected'; ?>>Dispatched</OPTION>
							  <OPTION value="delivered" <? if ('delivered'==$_POST[req_status]) echo 'selected'; ?>>Delivered</OPTION>  
                             </SELECT>
							<span class="bodytext">Date From</span>:							
              				<?
								if(isset($_POST['search']))								
								$date_from=$_POST[order_date_from];							
								//else
								//$date_from=date("M d, Y"); 
								//$cur_date=date("M d, Y"); 
								 
								?>
																	
							
								<input type="text" name="order_date_from" size="11" value="<? echo $date_from ?>"   id="sel2"/>
              				<a href="javascript:return false;">
							<img src="body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button2" style="cursor: pointer;" alt="Calendar" title="Date selector" /></a>
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
									
										var cal = new Zapatec.Calendar.setup({
											
											inputField     :    "sel2",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											//ifFormat       :    '%a, %b %e, %Y [%I:%M %p]',     // format of the input field
											ifFormat       :    '%b %e, %Y',     // format of the input field
											//ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											showsTime      :     true,     // show time as well as date
											button         :    "button2"  // trigger button 

										});
		
									</script>
							
							<span class="bodytext">&nbsp;&nbsp;To</span>:
              				<?
								
								if(isset($_POST['search']))								
								$date_to=$_POST[order_date_to];							
								//else
								//$date_to=date("M d, Y"); 
								//$cur_date=date("M d, Y g:i"); 
								//$cur_date=date("M d, Y"); 
								 
								?>
																	
							
								<input type="text" name="order_date_to" size="11" value="<? echo $date_to ?>"   id="sel3"/>
              				<a  href="javascript:return false;">
							<img src="body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button3" style="cursor: pointer;" alt="Calendar" title="Date selector" /></a>
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
									
										var cal = new Zapatec.Calendar.setup({
											
											inputField     :    "sel3",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											//ifFormat       :    '%a, %b %e, %Y [%I:%M %p]',     // format of the input field
											ifFormat       :    '%b %e, %Y',     // format of the input field
											//ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											showsTime      :     true,     // show time as well as date
											button         :    "button3"  // trigger button 

										});
		
									</script>							
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
							
							<TD class=hf align=left width='67'>
								<B>Maker Id</B>
							</TD>
							 <TD class=hf align=left width='75'>
								<B>Req. Branch </B>
								
								</TD>
							 	
							 <TD class=hf align=lef width='90'>
								<B>Item Type </B>
							</TD>
							<TD class=hf align=lef width='80'>
								<B>Delivery Type </B>
							</TD>
							<TD class=hf align=lef width='100'>
								<B>Status </B>
							</TD>
							<TD class=hf align=lef width='110'>
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
			  				  				  
				  <DIV class=syntax_hilite>
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
						$order_date_to=date ("M d, Y", $_POST['order_date_to']+strtotime("+1 day"));
						$item_type=trim($_POST['item_type']);													
						$req_status=trim($_POST['req_status']);
						$severity=trim($_POST['severity']);
						$sort_by=trim($_POST['sort_by']);
						
					  if((!empty($order_date_from)) || (!empty($order_date_to))|| (!empty($item_type))||(!empty($logon_user_id))|| (!empty($req_status)||(!empty($severity))))
					  {						  						
						$searchcriteria = array();
						
						if(!empty($logon_user_id))
							$searchcriteria[] = "aibl_others_rqst.others_rqst_by like '%$logon_user_id%'";	
																																				
						if(!empty($item_type))
							$searchcriteria[] = "item_type like '%$item_type%'";
																									
						if(!empty($severity))
							$searchcriteria[] = "others_severity like '$severity%'";	
							
							
						$searchdate = array();														
						//if(!empty($order_date_from) && !empty($order_date_to))
						//{							
							$date_from=date('Y-m-d', strtotime($order_date_from));							
							$date_to=date('Y-m-d', strtotime($order_date_to));		
																			
							if($req_status=='ordered')
							$searchdate[] = "others_order_date_time between '$date_from' AND '$date_to'";
							
							if($req_status=='dispatched')	
							$searchdate[] = "others_dispatch_datetime between '$date_from' AND '$date_to'";
							
							if($req_status=='pending')	
							$searchdate[] = "others_approval_date_time between '$date_from' AND '$date_to'";
							
							if($req_status=='delivered')		
							$searchdate[] = "others_delivered_datetime between '$date_from' AND '$date_to'";
							
							if(count($searchdate)>0)
								{
							$searchcriteria[] = ($searchdate)?" (".join(" or ",$searchdate)." )":"";;
							}
																					
						//}						
						
						
						
						$searchtext = array();
		
						if(count($searchcriteria)>0)
						{
							$searchtext[] = ($searchcriteria)?" (".join(" and ",$searchcriteria)." )":"";;
						}
						
						if($sort_by=="approved_date") 
							$order = " order by others_approval_date_time desc ";
						if($sort_by=="req_status") 
							$order = " order by others_rqst_status ";
						if($sort_by=="delivery_type") 
							$order = " order by others_severity ";
						if($sort_by=="branch") 
							$order = " order by others_collecting_branch ";
						
						$querystring = "";
						$querystring = ($searchtext)?join(" and ",$searchtext):"";
						if(!empty($querystring))
							$querystring = " where ".$querystring;
																				
							$query1="select * from aibl_others_rqst".$querystring." && others_collecting_branch_code='".$_SESSION['branch_code']."'".$order;
							
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
								if(($row['others_approval_date_time'])!=0){
								$date=str_replace('-','/',$row['others_approval_date_time']); 
								$date=date('M d, Y H:i', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if(($row['others_dispatch_datetime'])!=0){
								$dis_date=str_replace('-','/',$row['others_dispatch_datetime']); 
								$dis_date=date('M d, Y H:i', strtotime($dis_date));								
								}
								else 
								$dis_date= "Not yet Dispached";
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								
								$req_id[]=$row['others_rqst_id'];
								echo "<tr>								
								<td class=$class width='65'>".$row['others_rqst_by']."</td>
								<td class=$class width='75'>".strtok($row['others_collecting_branch'], " ")."</td>
								<td class=$class width='90'>".$row['item_type']."- ".$row['others_total_leaf']." Lvs</td>
								<td class=$class width='80'>".$row['others_severity']."</td>
								<td class=$class width='100'>$status</td>
								<td class=$class width='110'>$date</td>	
								<td class=$class>$dis_date</td>	
												
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
					$alart="There are no results to disply. Please re-check and try again";

			    	echo "<tr><td class=hf colspan=4><font size=3px><b>$alart</b></font></td></tr>";
				}
				else{
					foreach($req_id as $key=>$value) {
						$strArray .= "id[$key]=$value&";
					}
				}
				$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1000,height=570,directories=no,location=no';
				$link = 'popups/search_request_print.php';
				?>  
						  
											  	 			  
					   </TBODY>
					 </TABLE>
				   </TD></TR>
				</TBODY>
			  </TABLE>
			  </DIV>
               <br />
                 <div>				 						
					<a  style="float:left; width:200px;"href="excel/others_search_excel.php?<? echo $strArray; ?>"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download</font></b></a>				 				 
				  	<a style="float:right; width:100px;" href="<?php echo $link; ?>" target="_blank" onClick="window.open('popups/others_search_request_print.php?<? echo $strArray; ?>','win2','<?php echo $status; ?>'); return false;" title="Print Version">
					 	<img src="images/printer.gif" border="0" align="absmiddle" />
					</a>	
				 </div>   
			
<?
 }
}
?>
				</TD></TR>
			</TBODY>
		</TABLE>