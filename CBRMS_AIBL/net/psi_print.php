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

 if(($option=='psi_print')&&($task!='change_status'))
 { 
 ?>
				
				  <FORM name="frmPrint" action="index.php?option=psi_print&order=approval_date_time" method="post">
				<TABLE class=border cellSpacing=1 cellPadding=2 width="100%" border=0>
						
                          <TBODY>
						   <TR>
                            <TD class=info align=left colSpan=4>
								<B>Serach for all criteria </B>											
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
								onkeypress="return isNumberKey(event)">									
							    -&nbsp;
								<input type="text"  name="ac_no_cus_no" size="8" maxlength="8" value="<? echo $_POST[ac_no_cus_no]; ?>" 
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
							  <OPTION value="Card" <? if ('Card'==$_POST[ac_type]) echo 'selected'; ?>>Card</OPTION>							  
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
				 <form name="frmChk" method="post" action="index.php?option=psi_print&task=change_status"> 
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
                          <TR>
                             <TD width="56"  class="hf" align="center">							 
								&nbsp;<B>#</B>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkall" onclick="checkedAll(frmChk);">						
							</TD>
							 <TD class=hf  width="65">
								<B>Maker ID </B>
							</TD>
							 <TD class=hf  width="80">
								<B>Req. Branch </B>														
							</TD>
							 <TD class=hf width="137">
								<B>Approved Date & Time</B>															
							</TD>	
							<TD class=hf width="101">
								<B>Account No </B>
							</TD>							
							 <TD class=hf width="60">
								<B>A/C Type </B>								
							</TD>
							<TD class=hf width="60">
								<B>Leaves </B>
							</TD>
							<TD class=hf width="80">
								<B>Delivery Type </B>								
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
						
						// SORT BY---------------------------------------------------------
						if($sort_by_1=="branch") 
							$order_1 = " collecting_branch asc,";
						if($sort_by_1=="AcType") 
							$order_1 = " ac_type desc,";
						if($sort_by_1=="leaf") 
							$order_1 = " total_leaf asc,";
						
						if($sort_by_2=="branch") 
							$order_2 = " collecting_branch asc,";
						if($sort_by_2=="AcType") 
							$order_2 = " ac_type desc,";
						if($sort_by_2=="leaf") 
							$order_2 = " total_leaf asc,";	
							
						if($sort_by_3=="branch") 
							$order_3 = " collecting_branch asc,";
						if($sort_by_3=="AcType") 
							$order_3 = " ac_type desc,";
						if($sort_by_3=="leaf") 
							$order_3 = " total_leaf asc";	
						// END SORT BY ----------------------------------------
						
						$querystring = "";
						$querystring = ($searchtext)?join(" and ",$searchtext):"";
						if(!empty($querystring))
							$querystring =" and".$querystring;
											  						  
							$query1="select * from aibl_chq_rqst where rqst_status='pending'".$querystring."  order by ".$order_1."".$order_2."".$order_3;		
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
								<td class=$class width='137'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$date</a></td>
								<td class=$class width='101'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']."</a></td>								
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."</a></td>
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['total_leaf']." X ".$row['books']." Lvs</a></td>
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

				 <?		
				 }		 
 			}
		
	
if(($option=='psi_print')&&($task=='change_status'))
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
								$update_req_query ="Update aibl_chq_rqst set rqst_status='$_POST[req_status]',start_no='$start_no[$i]',end_no='$end_no[$i]' where rqst_id='$update_ch[$i]'";  																	
								mysql_query($update_req_query) or
								die (mysql_error());								
							}
							
							//echo "sss".$start_no[$i]."eee".$end_no[$i]."<br>";
								if($_POST['sav_end_no']!=0){
									//echo 'Sav'.$_POST['sav_end_no'];
									$update_sav_sl_query ="Update serial_no set end_no='$_POST[sav_end_no]' where ac_type='Savings'";  																
									mysql_query($update_sav_sl_query) or
									die (mysql_error());
								}
								if($_POST['cur_end_no']!=0){
									//echo 'Cur'.$_POST['cur_end_no'];							
									$update_cur_sl_query ="Update serial_no set end_no='$_POST[cur_end_no]' where ac_type='Current'";  																
									mysql_query($update_cur_sl_query) or
									die (mysql_error());	
								}	
								if($_POST['cur50_end_no']!=0){
									//echo 'Cur50'.substr($_POST['cur50_end_no']+10000000,1);							
									$update_cur50_sl_query ="Update serial_no set end_no='$_POST[cur50_end_no]' where ac_type='Current50'";  																
									mysql_query($update_cur50_sl_query) or
									die (mysql_error());	
								}	
								
								if($_POST['card20_end_no']!=0){
									//echo 'Cur50'.substr($_POST['cur50_end_no']+10000000,1);							
									$update_card20_sl_query ="Update serial_no set end_no='$_POST[card20_end_no]' where ac_type='Card'";  																
									mysql_query($update_card20_sl_query) or
									die (mysql_error());	
								}	
														
								redirectUrl("index.php?option=psi_print&task=total_request_pending&order=approval_date_time");
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
                  
                  <FORM name="frmSl" action="index.php?option=psi_print&task=change_status" method="post">
                  
							
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
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from serial_no where ac_type='Savings'"));										
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(end_no) AS MaxNo from aibl_chq_rqst where ac_type='Savings'"));										
										$result=mysql_query("select *from aibl_chq_rqst where ac_type='Savings' and rqst_id in ($idlist) order by collecting_branch");
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
							  					<span style="color:#0000FF;">Start No.</span> <input type="text" name="start_no[]" maxlength="7" value="<? echo substr($a_SAV[$i]+10000000,1) ?>" size="7" onKeyUp="advance_end_no(this,'end_no');" />	
							  					&nbsp;<span style="color:#0000FF;">End No. </span><input type="text" maxlength="7" size="7" value="<? echo substr($b_SAV[$i]+10000000,1) ?>" name="end_no[]" />															 		
												= <? echo $lv[$i]."X".$books_Savings[$i]."=".$lv[$i]*$books_Savings[$i].$br_sav[$i].max($b_SAV);?>
											</TD>							 
						  				 </TR>
										<?
										}
				//*******************************************************************************************************************************************************			
		
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from serial_no where ac_type='Current'"));										
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
							  					Start No. <input type="text" name="start_no[]" maxlength="7" value="<? echo substr($a[$i]+10000000,1) ?>" size="7" onKeyUp="advance_end_no(this,'end_no');" />	
							  					&nbsp;End No. <input type="text" maxlength="7" size="7" value="<? echo substr($b[$i]+10000000,1) ?>" name="end_no[]" />															 		
												= <? echo $lc[$i]."X".$books_Current[$i]."=".$lc[$i]*$books_Current[$i].$br[$i].max($b);?>
											</TD>							 
						  				 </TR>
										<?
										}
											
								//*******************************************************************************************************************************************************			
		
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from serial_no where ac_type='Current50'"));										
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
							  					<span style="color:#990000;">Start No.</span> <input type="text" name="start_no[]" maxlength="7" value="<?  echo substr($a_50[$i]+10000000,1) ?>" size="7" onKeyUp="advance_end_no(this,'end_no');" />	
							  					&nbsp;<span style="color:#990000;">End No. </span><input type="text" maxlength="7" size="7" value="<? echo substr($b_50[$i]+10000000,1)  ?>" name="end_no[]" />															 		
												= <? echo $lc_50[$i]."X".$books_Current50[$i]."=".$lc_50[$i]*$books_Current50[$i].$br_50[$i].max($b_50);?>
											</TD>							 
						  				 </TR>
										<?
										}
																			  									  
						  //---------------------------------------------------------------------------------------
						  
						  //*******************************************************************************************************************************************************			
		
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from serial_no where ac_type='Card'"));										
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(end_no) AS MaxNo from aibl_chq_rqst where ac_type='Card'"));										
										$result=mysql_query("select *from aibl_chq_rqst where ac_type='Card' and total_leaf='20' and rqst_id in ($idlist) order by collecting_branch");
										$get_count_Card= mysql_num_rows($result);
																				
										while ($row=mysql_fetch_array($result))
										{										
											$br_20[]=$row['collecting_branch'];
											$lc_20[]=$row['total_leaf'];
											$kc_20[]=$row['rqst_id'];
											$ac_20[]=$row['ac_type'];	
											$books_Card[]=$row['books'];																					  											
										}
										$t=$get_max_no['MaxNo']+1;
										$a_20[0]=$t;																	
										$b_20[0]=($t+($row['total_leaf']*$books_Card[0]))+1;	
																				
										for ($i=1; $i<$get_count_Card; $i++){										
											$a_20[$i]=$a_20[$i-1]+($lc_20[$i-1]*$books_Card[$i-1]);						
										}								
										for ($i=1; $i<$get_count_Card+1; $i++){																			
											$b_20[$i-1]=$a_20[$i-1]+($lc_20[$i-1]*$books_Card[$i-1])-1;
										}							
																																	
										for ($i=0; $i<$get_count_Card; $i++){										
											//echo "<br_20>ID".$get_count_Card;
											//echo "<br_20>ID".$kc_20[$i];
											//echo ",  A/C Type :".$ac_20[$i].",  Leaves :".$lc_20[$i].",  Start No :".($get_max_no['MaxNo']+1).",  End No :".($get_max_no['MaxNo']+$lc_20[$i])."<br_20>";
										?>
										<input type="hidden" name="update_chk[]" value="<? echo $kc_20[$i]; ?>" />	
										 <input type="hidden" name="ac_type[]" value="Card" />
										 <input type="hidden" name="card20_end_no" value="<? echo max($b_20); ?>"/>
										 <TR>
                              				<TD class=back2 align=right width="35%"><span style="color:#000099">Card 20 Serial</span>:</TD>							
							  				<TD class=back colspan="3">
							  					<span style="color:#000099;">Start No.</span> <input type="text" name="start_no[]" maxlength="7" value="<?  echo substr($a_20[$i]+10000000,1) ?>" size="7" onKeyUp="advance_end_no(this,'end_no');" />	
							  					&nbsp;<span style="color:#000099;">End No. </span><input type="text" maxlength="7" size="7" value="<? echo substr($b_20[$i]+10000000,1)  ?>" name="end_no[]" />															 		
												= <? echo $lc_20[$i]."X".$books_Card[$i]."=".$lc_20[$i]*$books_Card[$i].$br_20[$i].max($b_20);?>
											</TD>							 
						  				 </TR>
										<?
										}
																			  
									  
						  //---------------------------------------------------------------------------------------
						  }
						  
						?>
						  			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
                  
                  <CENTER>
                  <input type="submit" value="Update Status" name="submit"/>
				  
				  <!--<input type="submit" value="Update Task" name="submit" onclick='return VendorInput_validate();'/>-->
                  <INPUT type="Reset" value="Reset">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 </CENTER>
				</FORM>
				 
<?
}
?>
 				</TD></TR>
			</TBODY>
		</TABLE>