<?php
session_cache_limiter('nocache');
session_start();
include_once ("../tex_common.php");

if (empty($_SESSION['user_name']))
{	
	redirectUrl('net_signin.php?msg=signin');
}

$task=$_REQUEST['task'];
$option=$_REQUEST['option'];

 if(($option=='manage_order')&&($task!='change_status'))
 { 
 ?>
				
			<FORM name="frmPrint" action="index.php?option=manage_order&order=approval_date_time" method="post">
				<TABLE class=border cellSpacing=1 cellPadding=2 width="100%" border=0>
						
                          <TBODY>
						   <TR>
                            <TD class=info align=left colSpan=4>
								<B>Order Serach Criteria </B>											
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
                                <input type="text" name="ac_no_suffix" size="3" maxlength="3" value="<? echo $_POST[ac_no_suffix]; ?>" 
								onkeypress="return isNumberKey(event)"																
								>
							    -&nbsp;								
								<input type="text"  name="ac_no_cus_no" size="6" maxlength="6" value="<? echo $_POST[ac_no_cus_no]; ?>" 
								onKeyUp="advance_ac_no_suffix(this,'ac_no_suffix');" 								
								onkeypress="return isNumberKey(event)" 							
								>	
								&nbsp; Name: 
								<input type="text" name="ac_name" size="35"  value="<? echo $_POST[ac_name]; ?>" />							
							</TD>
						  </TR>
						  
						  <TR height="25">						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Branch Name</span>:</TD>
                            <TD class=back colSpan=3>
								<input type="text" name="req_branch" size="22"  value="<? echo $_POST[req_branch]; ?>" />								 																					
							</TD>
						  </TR>						  						  
						  <TR>
                          <TD class=back2 align=right><label for="search_searchword">Date: </label></TD>
                            <TD class=back align=left><span class="bodytext">From</span>:
							
              				<?
								if(isset($_POST['search']))								
								$date_from=$_POST[order_date_from];							
								
								 
								?>
																	
							
								<input type="text" name="order_date_from" size="22" value="<? echo $date_from ?>"   id="sel2"/>
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
								
								 
								?>
																	
							
								<input type="text" name="order_date_to" size="22" value="<? echo $date_to ?>"   id="sel3"/>
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
                            <TD class=back2 align=right width="24%"><span class="bodytext">A/C Type </span>:</TD>
                            <TD class=back colSpan=3>
							  <SELECT name="ac_type">
							  <OPTION value="" >ALL...</option>		
							  <OPTION value="Savings" <? if ('Savings'==$_POST[ac_type]) echo 'selected'; ?>>Savings</OPTION>
							  <OPTION value="Current" <? if ('Current'==$_POST[ac_type]) echo 'selected'; ?>>Current</OPTION>
							  <OPTION value="STD" <? if ('STD'==$_POST[ac_type]) echo 'selected'; ?>>STD</OPTION>  					 							  
                             </SELECT>	
							 &nbsp;Delivery Type:
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
							  <SELECT name="sort_by_1">
							  <OPTION value="branch" <? if ('branch'==$_POST[sort_by_1]) echo 'selected'; ?>>Branch</OPTION>							  							  					 
							  <OPTION value="AcType" <? if ('AcType'==$_POST[sort_by_1]) echo 'selected'; ?>>Account Type</OPTION> 							  
							  <OPTION value="leaf" <? if ('leaf'==$_POST[sort_by_1]) echo 'selected'; ?>>Leaf</OPTION>							    
                             </SELECT>	
							  &nbsp;Then by	
							  <SELECT name="sort_by_2">
							  <OPTION value="AcType" <? if ('AcType'==$_POST[sort_by_2]) echo 'selected'; ?>>Account Type</OPTION>
							  <OPTION value="branch" <? if ('branch'==$_POST[sort_by_2]) echo 'selected'; ?>>Branch</OPTION>							  							  					 							   							  
							  <OPTION value="leaf" <? if ('leaf'==$_POST[sort_by_2]) echo 'selected'; ?>>Leaf</OPTION>							    
                             </SELECT>
							 &nbsp;Then by	
							  <SELECT name="sort_by_3">
							  <OPTION value="leaf" <? if ('leaf'==$_POST[sort_by_3]) echo 'selected'; ?>>Leaf</OPTION>
							  <OPTION value="AcType" <? if ('AcType'==$_POST[sort_by_3]) echo 'selected'; ?>>Account Type</OPTION>
							  <OPTION value="branch" <? if ('branch'==$_POST[sort_by_3]) echo 'selected'; ?>>Branch</OPTION>							  							  					 							   							  							  							    
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
                <!-- Display User Information------------->
				 <form name="frmChk" method="post" action="index.php?option=manage_order&task=change_status"> 
				 <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
        				
                        <TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
                          <TBODY>
						  <TR>
                            <TD class=info align=left colSpan=11>
								<B>Ordered Cheque Book Information</B>											
							</TD>
						  </TR>

                          <TR>
                             <TD width="57"  class="hf" align="center">							 
								&nbsp;<B>#</B>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkall" onclick="checkedAll(frmChk);">						
							</TD>
							 
							 <TD class=hf  width="79">
								<B>Maker ID </B>
							</TD>
							 <TD class=hf  width="80">
								<B>Req. Branch </B>						
								
							</TD>
							 <TD class=hf width="115">
								<B>Approved Date</B>
															
							</TD>	
							<TD class=hf width="98">
								<B>Account No </B>
							</TD>							
							 <TD class=hf width="55">
								<B>A/C Type </B>
								
							</TD>
							<TD class=hf width="60">
								<B>Books </B>
							</TD>
							<TD class=hf width="100">
								<B>Star - End No </B>
							</TD>
							<TD class=hf width="55">
								<B>Del. Type </B>
								
							</TD>
							<TD class=hf align=lef>
								<B>Status</B>
							</TD>														
						  </TR>
					
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					<DIV class="syntax_hilite" style="width:100%" >
                  
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
        
                        <TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
                          <TBODY>

						  <?						  							  
						$order_date_from=trim($_POST['order_date_from']);
						//$order_date_to=trim($_POST['order_date_to']);
						//$order_date_to=date ("M d, Y", $_POST['order_date_to']+strtotime("+1 day"));
						$order_date_to=date('Y-m-d-H-i',strtotime($_POST['order_date_to']));	
						$ac_name=trim($_POST['ac_name']);
						$ac_no_branch=trim($_POST['ac_no_branch']);
						$ac_no_cus_no=trim($_POST['ac_no_cus_no']);
					 	$ac_no_suffix=trim($_POST['ac_no_suffix']);	
						$req_branch=trim($_POST['req_branch']);					
						$ac_type=trim($_POST['ac_type']);
						$severity=trim($_POST['severity']);
						$sort_by_1=trim($_POST['sort_by_1']);
						$sort_by_2=trim($_POST['sort_by_2']);
						$sort_by_3=trim($_POST['sort_by_3']);
						
					  //if((!empty($user_id)) || (!empty($logon_user_name)))
					  //{	
					
					  						
						$searchcriteria = array();
																				
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
							
						if(!empty($ac_type))
							$searchcriteria[] = "ac_type like '$ac_type%'";
																									
						if(!empty($severity))
							$searchcriteria[] = "severity like '$severity%'";
					
						$searchdate = array();														
						if(!empty($order_date_from) && !empty($order_date_to))
						{							
							$date_from=date('Y-m-d H:i', strtotime($order_date_from));							
							//$date_to=date('Y-m-d', strtotime($order_date_to));	
							$date=explode("-", "$order_date_to");					 		
							$i=$date[4];
							$h=$date[3];
							$d=$date[2];
							$m=$date[1];						
							$y=$date[0];					
							$date_to=date('Y-m-d H:i',mktime($h, $i, 0, $m, $d+1, $y));													
							$searchdate[] = "approval_date_time between '$date_from' AND '$date_to'";	
							$searchdate[] = "dispatch_datetime between '$date_from' AND '$date_to'";							
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
						
						// SORT BY---------------------------------------------------------
						if($sort_by_1=="branch") 
							$order_1 = " collecting_branch asc,";
						if($sort_by_1=="AcType") 
							$order_1 = " ac_type asc,";
						if($sort_by_1=="leaf") 
							$order_1 = " total_leaf asc,";
						
						if($sort_by_2=="branch") 
							$order_2 = " collecting_branch asc,";
						if($sort_by_2=="AcType") 
							$order_2 = " ac_type asc,";
						if($sort_by_2=="leaf") 
							$order_2 = " total_leaf asc,";	
							
						if($sort_by_3=="branch") 
							$order_3 = " collecting_branch asc,";
						if($sort_by_3=="AcType") 
							$order_3 = " ac_type asc,";
						if($sort_by_3=="leaf") 
							$order_3 = " total_leaf asc";	
						// END SORT BY ----------------------------------------
						
						$querystring = "";
						$querystring = ($searchtext)?join(" and ",$searchtext):"";
						if(!empty($querystring))
							$querystring =" and".$querystring;
												  					  
							$query1="select * from aibl_chq_rqst where rqst_status='ordered'".$querystring."  order by ".$order_1."".$order_2."".$order_3;		
							
							//$query1="select * from aibl_chq_rqst where rqst_status='ordered' order by collecting_branch desc, ac_type desc, total_leaf asc, approval_date_time desc";	
							
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
								<td class=$class  align='center' width='55'>&nbsp;$sl&nbsp;&nbsp;&nbsp;<input type='checkbox' name='chk[]' value=".$row['rqst_id']." style='border-style:none'></td>							
								<td class=$class width='79'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>							
								<td class=$class width='80'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class width='115'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$date</a></td>
								<td class=$class width='98'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>								
								<td class=$class width='55'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."</a></td>
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['books']." X ".$row['total_leaf']." Lvs</a></td>
								<td class=$class width='100'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['start_no']." - ".$row['end_no']."</a></td>
								<td class=$class width='55'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$status</a></td>																
								</tr>";
								$sl++;
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}

						}
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
								<td class=$class  align='center' width='44'>&nbsp;$sl&nbsp;&nbsp;&nbsp;<input type='checkbox' name='chk[]' value=".$row['rqst_id']." style='border-style:none'></td>							
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_id']."</a></td>							
								<td class=$class width='65'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>							
								<td class=$class width='80'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".strtok($row['collecting_branch'], " ")."</a></td>
								<td class=$class width='110'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$date</a></td>
								<td class=$class width='90'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>								
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
					 		<DIV  style="float:right; width:480;">
							<a href="../aibl/excel/challan_excel.php?<? echo $strArray; ?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Excel Challan</font></b></a>
							<a href="../aibl/excel/personalisation.php?ac_type=<? echo 'Current' ?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">CD MICR</font></b></a>
							<a href="../aibl/excel/personalisation.php?ac_type=<? echo 'Savings' ?>"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">SB MICR</font></b></a>							
							<a href="../aibl/excel/ordered_all.php"><img src="../aibl/images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">PSI</font></b></a>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="<?php echo $link; ?>" target="_blank" onClick="window.open('../aibl/popups/challan.php','win2','<?php echo $status; ?>'); return false;" style="text-decoration:underline">
					 				<img src="../aibl/images/challan-icon.jpg" width="23" height="25" hspace="2"  border="0"/>&nbsp;<b>CHALLAN</b>							
							</a>
														
							</DIV>							
							</TD>
						</TR>											  	 			  
					  </TABLE>
					  
					  
				</form>
					

				 <?	
				 }			 
 			}
		
	
if(($option=='manage_order')&&($task=='change_status'))
{
  															
					//$update_chk=$_POST['update_chk'];										
					//$c=count($update_chk);												
	  				
					if(isset($_POST['submit']))
					{	
								
						$update_ch=$_POST['update_chk'];	
						$start_no=$_POST['start_no'];
						$end_no=$_POST['end_no'];									
						$c=count($update_ch);	
						
						$get_challan_no = mysql_fetch_array(mysql_query("select *from challan_no"));	
						$challan_no=($get_challan_no['challan_no']+$c);
						//echo "???".$challan_no;
																
						$dispatch_date_time=date('Y-m-d H:i:s a', strtotime($_POST['dispatch_date_time'])); 							
						
						for ($i=0; $i<$c; $i++)
						{														
							
							if($_POST['req_status']=='dispatched'){
							$update_req_query ="Update aibl_chq_rqst set rqst_status='$_POST[req_status]',dispatch_datetime='$dispatch_date_time' where rqst_id='$update_ch[$i]'";  										
							//echo "aaa".$_POST['req_status'];
							
							mysql_query($update_req_query) or
							die (mysql_error());	
							redirectUrl("index.php?option=total_request&task=total_request_ordered&order=approval_date_time");
							}
							//mysql_query($update_req_query) or
							//die (mysql_error());		
						}	
											
						//redirectUrl("index.php?option=total_request&task=total_request_pending&order=approval_date_time"); 
																																												
					}													
					?>	
					<TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=5 width="100%" border=0>
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
                        <TABLE cellSpacing=1 cellPadding=5 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=left colSpan=4>
								<B>Edit Request Status </B>							
							</TD>
						  </TR>	
						 <?
						   if ($_POST['do_dispached']=='do_dispached'){
						  
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
				  </CENTER>
<?

}
						
?>
	
	  

			 </TD></TR>
			</TBODY>
		</TABLE>