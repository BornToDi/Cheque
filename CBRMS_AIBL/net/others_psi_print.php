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

 if(($option=='others_psi_print')&&($task!='change_status'))
 { 
 ?>
				
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('../aibl/body_content/others_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=450');
}
</script>
				  <FORM name="frmPrint" action="index.php?option=others_psi_print&order=others_approval_date_time" method="post">
				<TABLE class=border cellSpacing=1 cellPadding=2 width="100%" border=0>
						
                          <TBODY>
						   <TR>
                            <TD class=info align=left colSpan=4>
								<B>Serach for all criteria </B>											
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
							<img src="../aibl/body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button2" style="DDsor: pointer;" alt="Calendar" title="Date selector" /></a>
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
							<img src="../aibl/body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button3" style="DDsor: pointer;" alt="Calendar" title="Date selector" /></a>
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
                            <TD class=back2 align=right width="24%"><span class="bodytext">Item Type </span>:</TD>
                            <TD class=back colSpan=3>
							  <SELECT name="item_type">
							  <OPTION value="" >ALL...</option>		
							  <OPTION value="PO" <? if ('PO'==$_POST['item_type']) echo 'selected'; ?>>PO-Pay Order</OPTION> 
							  <OPTION value="DD" <? if ('DD'==$_POST['item_type']) echo 'selected'; ?>>DD-Demand Draft</OPTION>
							  <OPTION value="SDR" <? if ('SDR'==$_POST['item_type']) echo 'selected'; ?>>SDR-SeDDity Deposit Receipt</OPTION>
							  <OPTION value="FDD" <? if ('FDD'==$_POST['item_type']) echo 'selected'; ?>>FDD-Foreign Deposit Draft</OPTION> 	
							  <OPTION value="FDR" <? if ('FDR'==$_POST['item_type']) echo 'selected'; ?>>FDR-Fixed Deposit Receipt</OPTION>								 					 							  
                             </SELECT>	
							 &nbsp;Delivery Type:
							 <SELECT name="others_severity">
							  <OPTION value="" >ALL...</option>		
							  <OPTION value="Normal" <? if ('Normal'==$_POST[others_severity]) echo 'selected'; ?>>Normal</OPTION>
							  <OPTION value="Priority" <? if ('Priority'==$_POST[others_severity]) echo 'selected'; ?>>Priority</OPTION> 					 							  
                             </SELECT>								 														 																					
							</TD>
						  </TR>						  						  
                          <TR height="25">						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Sort By</span>:</TD>
                            <TD class=back colSpan=3>							 
							  <SELECT name="sort_by_1">
							  <OPTION value="branch" <? if ('branch'==$_POST[sort_by_1]) echo 'selected'; ?>>Branch</OPTION>							  							  					 
							  <OPTION value="ItemType" <? if ('ItemType'==$_POST[sort_by_1]) echo 'selected'; ?>>Item Type</OPTION> 							  
							  <OPTION value="leaf" <? if ('leaf'==$_POST[sort_by_1]) echo 'selected'; ?>>Leaf</OPTION>							    
                             </SELECT>	
							  &nbsp;Then by	
							  <SELECT name="sort_by_2">
							  <OPTION value="ItemType" <? if ('ItemType'==$_POST[sort_by_2]) echo 'selected'; ?>>Item Type</OPTION>
							  <OPTION value="branch" <? if ('branch'==$_POST[sort_by_2]) echo 'selected'; ?>>Branch</OPTION>							  							  					 							   							  
							  <OPTION value="leaf" <? if ('leaf'==$_POST[sort_by_2]) echo 'selected'; ?>>Leaf</OPTION>							    
                             </SELECT>
							 &nbsp;Then by	
							  <SELECT name="sort_by_3">
							  <OPTION value="leaf" <? if ('leaf'==$_POST[sort_by_3]) echo 'selected'; ?>>Leaf</OPTION>
							  <OPTION value="ItemType" <? if ('ItemType'==$_POST[sort_by_3]) echo 'selected'; ?>>Item Type</OPTION>
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
				  															  
				  
                <!-- Display User Information------------->
				 <form name="frmChk" method="post" action="index.php?option=others_psi_print&task=change_status"> 
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
						  <?																
	$order=$_REQUEST['order'];			
	function str($order){
	
		$fieldlist = array();
		$fieldlist[0] = "others_collecting_branch";
		$fieldlist[1] = "others_severity"; 
		$fieldlist[2] = "item_type"; 
		$fieldlist[3] = "others_rqst_status"; 
		$fieldlist[4] = "others_approval_date_time";			
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
		$fieldlist[4] = "others_approval_date_time";
		
		for($i=0;$i<count($fieldlist);$i++)
		{
			if($order == $fieldlist[$i]." desc")
			{
				$$fieldlist[$i] = $fieldlist[$i]."_up";	
				$s_asc="../aibl/images/s_asc.png";			
			}
			else
			{
				$$fieldlist[$i] = $fieldlist[$i]."_down";
				$s_desc="../aibl/images/s_desc.png";
			}
		}
		
		?>
                          <TR>
                             <TD width="46"  class="hf" align="center">							 
								&nbsp;<B>#</B>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkall" onclick="checkedAll(frmChk);">						
							</TD>
							 <TD class=hf  width="65">
								<B>Maker ID </B>
							</TD>
							 <TD class=hf  width="80">
								<A href="index.php?option=others_psi_print&order=<? echo $others_collecting_branch; ?>" style="text-decoration:underline"><B>Req. Branch </B>						
								</A>
							</TD>
							 <TD class=hf width="137">
								<A href="index.php?option=others_psi_print&order=<? echo $others_approval_date_time; ?>" style="text-decoration:underline"><B>Approved Date & Time</B>
								<? if ($others_approval_date_time =="approval_date_time_up") {?> <img src="<? echo $s_asc ?>" border="0" align="absmiddle" /><? 
								}
								if ($others_approval_date_time =="approval_date_time_down")
									{
								?>
									 <img src="<? echo $s_desc ?>" border="0" align="absmiddle" />
									 <?
									 }
								?>
								</A>								
							</TD>										
							 <TD class=hf width="60">
								<A href="index.php?option=others_psi_print&order=<? echo $item_type; ?>" style="text-decoration:underline"><B>Item Type </B>
								</A>
							</TD>
							<TD class=hf width="60">
								<B>Leaves </B>
							</TD>
							<TD class=hf width="80">
								<A href="index.php?option=others_psi_print&order=<? echo $others_severity; ?>" style="text-decoration:underline"><B>Delivery Type </B>
								</A>
							</TD>
							<TD class=hf align=lef>
								<B>Status</B>
							</TD>														
						  </TR>
					
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					<DIV class=syntax_hilite>
                  
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
						$req_branch=trim($_POST['req_branch']);					
						$item_type=trim($_POST['item_type']);
						$others_severity=trim($_POST['others_severity']);
						$sort_by_1=trim($_POST['sort_by_1']);
						$sort_by_2=trim($_POST['sort_by_2']);
						$sort_by_3=trim($_POST['sort_by_3']);
						
					  //if((!empty($user_id)) || (!empty($logon_user_name)))
					  //{	
					if(isset($_POST['search']))
					{
					  						
						$searchcriteria = array();
																										
						if(!empty($req_branch))
							$searchcriteria[] = "others_collecting_branch like '%$req_branch%'";
							
						if(!empty($item_type))
							$searchcriteria[] = "item_type like '$item_type%'";
																									
						if(!empty($others_severity))
							$searchcriteria[] = "others_severity like '$others_severity%'";
					
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
							$searchdate[] = "others_approval_date_time between '$date_from' AND '$date_to'";	
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
							$order_1 = " others_collecting_branch desc,";
						if($sort_by_1=="ItemType") 
							$order_1 = " item_type asc,";
						if($sort_by_1=="leaf") 
							$order_1 = " others_total_leaf asc,";
						
						if($sort_by_2=="branch") 
							$order_2 = " others_collecting_branch desc,";
						if($sort_by_2=="ItemType") 
							$order_2 = " item_type asc,";
						if($sort_by_2=="leaf") 
							$order_2 = " others_total_leaf asc,";	
							
						if($sort_by_3=="branch") 
							$order_3 = " others_collecting_branch desc,";
						if($sort_by_3=="ItemType") 
							$order_3 = " item_type asc,";
						if($sort_by_3=="leaf") 
							$order_3 = " others_total_leaf asc,";	
						// END SORT BY ----------------------------------------
						
						$querystring = "";
						$querystring = ($searchtext)?join(" and ",$searchtext):"";
						if(!empty($querystring))
							$querystring =" and".$querystring;

					}	
						  	//include_once ('../config.php');
							//$query1="select *from aibl_login ".$querystring." ORDER BY  user_create_date desc";								
							//$result1 = mysql_query($query1) or
							//die(mysql_error());
							
							str($order);				
							//echo "testkkkk".$order;
							$order_coulmn="$order";						  
							$query1="select * from aibl_others_rqst where others_rqst_status='pending'".$querystring."  order by ".$order_1."".$order_2."".$order_3."".$order_coulmn;		
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
								if(($row['others_approval_date_time'])!=0){
								$date=str_replace('-','/',$row['others_approval_date_time']); 
								$date=date('M d, Y h:i a', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if($row['others_rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['others_rqst_status'];
								
								echo "<tr>	
								<td class=$class  align='center' width='44'>&nbsp;$sl&nbsp;&nbsp;&nbsp;<input type='checkbox' name='chk[]' value=".$row['others_rqst_id']." style='border-style:none'></td>							
								<td class=$class width='65'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_rqst_by']."</a></td>							
								<td class=$class width='80'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".strtok($row['others_collecting_branch'], " ")."</a></td>
								<td class=$class width='137'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$date</a></td>								
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['item_type']."</a></td>
								<td class=$class width='60'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_total_leaf']." X ".$row['others_books']." Lvs</a></td>
								<td class=$class width='80'><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">".$row['others_severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['others_rqst_id'].")\">$status</a></td>																
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
					 </TD></TR></TBODY></TABLE>

				 <?				 
 			}
		
	
if(($option=='others_psi_print')&&($task=='change_status'))
{
  															
					//$update_chk=$_POST['update_chk'];										
					//$c=count($update_chk);												
	  				
					if(isset($_POST['submit']))
					{	
								
						$update_ch=$_POST['update_chk'];	
						$others_start_no=$_POST['others_start_no'];
						$others_end_no=$_POST['others_end_no'];									
						$c=count($update_ch);	
																
						$dispatch_date_time=date('Y-m-d H:i:s a', strtotime($_POST['dispatch_date_time'])); 																														
							
						if($_POST['req_status']=='ordered')
						{
						    for ($i=0; $i<$c; $i++)
						     {	
							   $update_req_query ="Update aibl_others_rqst set others_rqst_status='$_POST[req_status]',others_start_no='$others_start_no[$i]',others_end_no='$others_end_no[$i]' where others_rqst_id='$update_ch[$i]'";  																	
							   mysql_query($update_req_query) or die (mysql_error());								   
							 }
							 
							if($_POST['po_end_no']!=0){
									//echo 'PO'.$_POST['po_end_no'];
									$update_po_sl_query ="Update serial_no set end_no='$_POST[po_end_no]' where ac_type='PO'";  																
									mysql_query($update_po_sl_query) or die (mysql_error());
							 }
							 
							if($_POST['dd_end_no']!=0){
								   //echo 'DD'.$_POST['dd_end_no'];							
									$update_dd_sl_query ="Update serial_no set end_no='$_POST[dd_end_no]' where ac_type='DD'";  																
									mysql_query($update_dd_sl_query) or die (mysql_error());	
							 }
							 	
							 if($_POST['fdd_end_no']!=0){
									//echo 'FDD'.$_POST['fdd_end_no'];							
									$update_fdd_sl_query ="Update serial_no set end_no='$_POST[fdd_end_no]' where ac_type='FDD'";  																
									mysql_query($update_fdd_sl_query) or die (mysql_error());	
							 }	
							 
							 if($_POST['fdr_end_no']!=0){
									//echo 'FDR'.$_POST['fdr_end_no'];							
									$update_fdr_sl_query ="Update serial_no set end_no='$_POST[fdr_end_no]' where ac_type='FDR'";  																
									mysql_query($update_fdr_sl_query) or die (mysql_error());	
							 }	
							 
							 if($_POST['sdr_end_no']!=0){
									//echo 'SDR'.$_POST['sdr_end_no'];							
									$update_sdr_sl_query ="Update serial_no set end_no='$_POST[sdr_end_no]' where ac_type='SDR'";  																
									mysql_query($update_sdr_sl_query) or die (mysql_error());	
							 }	
							 							 							 
							 redirectUrl("index.php?option=others_psi_print&task=total_request_pending&order=others_approval_date_time");							 							
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
                  
                  <FORM name="frmSl" action="index.php?option=others_psi_print&task=change_status" method="post">
                  
							
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
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from serial_no where ac_type='PO'"));
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(others_end_no) AS MaxNo from aibl_others_rqst where item_type='PO'"));										
										$result=mysql_query("select *from aibl_others_rqst where item_type='PO' and others_rqst_id in ($idlist) order by others_collecting_branch");
										$get_count_PO= mysql_num_rows($result);
																				
										while ($row=mysql_fetch_array($result))
										{										
											$lv[]=$row['others_total_leaf'];
											$kv[]=$row['others_rqst_id'];
											$av[]=$row['item_type'];	
											$books_PO[]=$row['others_books'];																						  											
										}
										$t=$get_max_no['MaxNo']+1;
										$a[0]=$t;																		
										$b[0]=($t+($row['others_total_leaf']*$books_PO[0]))+1;
																				
										for ($i=1; $i<$get_count_PO; $i++){											
											$a[$i]=$a[$i-1]+($lv[$i-1]*$books_PO[$i-1]);						
										}								
										for ($i=1; $i<$get_count_PO+1; $i++){																			
											$b[$i-1]=$a[$i-1]+($lv[$i-1]*$books_PO[$i-1])-1;
										}							
																																	
										for ($i=0; $i<$get_count_PO; $i++){										
											
										?>
										<input type="hidden" name="update_chk[]" value="<? echo $kv[$i]; ?>" />	
										<input type="hidden" name="po_end_no" value="<? echo max($b); ?>"/>
										 <TR>
                              				<TD class=back2 align=right width="35%"><span class="bodytext">PO Serial</span>:</TD>							
							  				<TD class=back colspan="3">
							  					Start No. <input type="text" name="others_start_no[]" maxlength="7" value="<? echo substr($a[$i]+10000000,1) ?>" size="7" onKeyUp="advance_end_no(this,'others_end_no');" />	
							  					&nbsp;End No. <input type="text" maxlength="7" size="7" value="<? echo substr($b[$i]+10000000,1) ?>" name="others_end_no[]" />															 		
												= <? echo $lv[$i]."X".$books_PO[$i]."=".$lv[$i]*$books_PO[$i];?>
											</TD>							 
						  				 </TR>
										<?
										}
				//*****************************************************************************************************************					
									
						 //*****************************************************************************************************************					
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from serial_no where ac_type='DD'"));
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(others_end_no) AS MaxNo from aibl_others_rqst where item_type='DD'"));										
										$result=mysql_query("select *from aibl_others_rqst where item_type='DD' and others_rqst_id in ($idlist) order by others_collecting_branch");
										$get_count_DD= mysql_num_rows($result);
																				
										while ($row=mysql_fetch_array($result))
										{										
											$lc[]=$row['others_total_leaf'];
											$kc[]=$row['others_rqst_id'];
											$ac[]=$row['item_type'];	
											$books_DD[]=$row['others_books'];																					  											
										}
										$t=$get_max_no['MaxNo']+1;
										$a_DD[0]=$t;																	
										$b_DD[0]=($t+($row['others_total_leaf']*$books_DD[0]))+1;	
																				
										for ($i=1; $i<$get_count_DD; $i++){										
											$a_DD[$i]=$a_DD[$i-1]+($lc[$i-1]*$books_DD[$i-1]);						
										}								
										for ($i=1; $i<$get_count_DD+1; $i++){																			
											$b_DD[$i-1]=$a_DD[$i-1]+($lc[$i-1]*$books_DD[$i-1])-1;
										}							
																																	
										for ($i=0; $i<$get_count_DD; $i++){										
											
										?>
										<input type="hidden" name="update_chk[]" value="<? echo $kc[$i]; ?>" />	
										<input type="hidden" name="dd_end_no" value="<? echo max($b_DD); ?>"/>
										 <TR>
                              				<TD class=back2 align=right width="35%"><span class="bodytext">DD Serial</span>:</TD>							
							  				<TD class=back colspan="3">
							  					Start No. <input type="text" name="others_start_no[]" maxlength="7" value="<? echo substr($a_DD[$i]+10000000,1) ?>" size="7" onKeyUp="advance_end_no(this,'others_end_no');" />	
							  					&nbsp;End No. <input type="text" maxlength="7" size="7" value="<? echo substr($b_DD[$i]+10000000,1) ?>" name="others_end_no[]" />															 		
												= <? echo $lc[$i]."X".$books_DD[$i]."=".$lc[$i]*$books_DD[$i];?>
											</TD>							 
						  				 </TR>
										<?
										}
																			  
						  //---------------------------------------------------------------------------------------------------------------------

						  //*****************************************************************************************************************					
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from serial_no where ac_type='FDD'"));
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(others_end_no) AS MaxNo from aibl_others_rqst where item_type='FDD'"));										
										$result=mysql_query("select *from aibl_others_rqst where item_type='FDD' and others_rqst_id in ($idlist) order by others_collecting_branch desc, item_type desc, others_total_leaf asc, others_approval_date_time desc");
										$get_count_FDD= mysql_num_rows($result);
																				
										while ($row=mysql_fetch_array($result))
										{										
											$lc_FDD[]=$row['others_total_leaf'];
											$kc_FDD[]=$row['others_rqst_id'];
											$ac_FDD[]=$row['item_type'];	
											$books_FDD[]=$row['others_books'];																					  											
										}
										$t=$get_max_no['MaxNo']+1;
										$a_FDD[0]=$t;																	
										$b_FDD[0]=($t+($row['others_total_leaf']*$books_FDD[0]))+1;	
																				
										for ($i=1; $i<$get_count_FDD; $i++){										
											$a_FDD[$i]=$a_FDD[$i-1]+($lc_FDD[$i-1]*$books_FDD[$i-1]);						
										}								
										for ($i=1; $i<$get_count_FDD+1; $i++){																			
											$b_FDD[$i-1]=$a_FDD[$i-1]+($lc_FDD[$i-1]*$books_FDD[$i-1])-1;
										}							
																																	
										for ($i=0; $i<$get_count_FDD; $i++){										
											
										?>
										<input type="hidden" name="update_chk[]" value="<? echo $kc_FDD[$i]; ?>" />
										<input type="hidden" name="fdd_end_no" value="<? echo max($b_FDD); ?>"/>	
										 <TR>
                              				<TD class=back2 align=right width="35%"><span class="bodytext">FDD Serial</span>:</TD>							
							  				<TD class=back colspan="3">
							  					Start No. <input type="text" name="others_start_no[]" maxlength="7" value="<? echo substr($a_FDD[$i]+10000000,1) ?>" size="7" onKeyUp="advance_end_no(this,'others_end_no');" />	
							  					&nbsp;End No. <input type="text" maxlength="7" size="7" value="<? echo substr($b_FDD[$i]+10000000,1) ?>" name="others_end_no[]" />															 		
												= <? echo $lc_FDD[$i]."X".$books_FDD[$i]."=".$lc_FDD[$i]*$books_FDD[$i];?>
											</TD>							 
						  				 </TR>
										<?
										}
										
								//*****************************************************************************************************************					
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from serial_no where ac_type='FDR'"));
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(others_end_no) AS MaxNo from aibl_others_rqst where item_type='FDR'"));										
										$result=mysql_query("select *from aibl_others_rqst where item_type='FDR' and others_rqst_id in ($idlist) order by others_collecting_branch");
										$get_count_FDR= mysql_num_rows($result);
																				
										while ($row=mysql_fetch_array($result))
										{										
											$lc_FDR[]=$row['others_total_leaf'];
											$kc_FDR[]=$row['others_rqst_id'];
											$ac_FDR[]=$row['item_type'];	
											$books_FDR[]=$row['others_books'];																					  											
										}
										$t=$get_max_no['MaxNo']+1;
										$a_FDR[0]=$t;																	
										$b_FDR[0]=($t+($row['others_total_leaf']*$books_FDR[0]))+1;	
																				
										for ($i=1; $i<$get_count_FDR; $i++){										
											$a_FDR[$i]=$a_FDR[$i-1]+($lc_FDR[$i-1]*$books_FDR[$i-1]);						
										}								
										for ($i=1; $i<$get_count_FDR+1; $i++){																			
											$b_FDR[$i-1]=$a_FDR[$i-1]+($lc_FDR[$i-1]*$books_FDR[$i-1])-1;
										}							
																																	
										for ($i=0; $i<$get_count_FDR; $i++){										
											
										?>
										<input type="hidden" name="update_chk[]" value="<? echo $kc_FDR[$i]; ?>" />
										<input type="hidden" name="fdr_end_no" value="<? echo max($b_FDR); ?>"/>	
										 <TR>
                              				<TD class=back2 align=right width="35%"><span class="bodytext">FDR Serial</span>:</TD>							
							  				<TD class=back colspan="3">
							  					Start No. <input type="text" name="others_start_no[]" maxlength="7" value="<? echo substr($a_FDR[$i]+10000000,1) ?>" size="7" onKeyUp="advance_end_no(this,'others_end_no');" />	
							  					&nbsp;End No. <input type="text" maxlength="7" size="7" value="<? echo substr($b_FDR[$i]+10000000,1) ?>" name="others_end_no[]" />															 		
												= <? echo $lc_FDR[$i]."X".$books_FDR[$i]."=".$lc_FDR[$i]*$books_FDR[$i];?>
											</TD>							 
						  				 </TR>
										<?
										}
																			  
						  //---------------------------------------------------------------------------------------------------------------------------------------
	
							 //*****************************************************************************************************************************************							
										$get_max_no = mysql_fetch_array(mysql_query("select end_no AS MaxNo from serial_no where ac_type='SDR'"));
										//$get_max_no = mysql_fetch_array(mysql_query("select MAX(others_end_no) AS MaxNo from aibl_others_rqst where item_type='SDR'"));										
										$result=mysql_query("select *from aibl_others_rqst where item_type='SDR' and others_rqst_id in ($idlist) order by others_collecting_branch");
										$get_count_SDR= mysql_num_rows($result);
																				
										while ($row=mysql_fetch_array($result))
										{										
											$l[]=$row['others_total_leaf'];
											$k[]=$row['others_rqst_id'];
											$h[]=$row['item_type'];
											$others_books[]=$row['others_books'];																						  											
										}
										$t=$get_max_no['MaxNo']+1;
										$a_SDR[0]=$t;							
										$b_SDR[0]=($t+($row['others_total_leaf']*$others_books[0]))+1;	
															
										for ($i=1; $i<$get_count_SDR; $i++){
											$a_SDR[$i]=$a_SDR[$i-1]+($l[$i-1]*$others_books[$i-1]);							
										}								
										for ($i=1; $i<$get_count_SDR+1; $i++){								
											$b_SDR[$i-1]=$a_SDR[$i-1]+($l[$i-1]*$others_books[$i-1])-1;
										}							
																																	
										for ($i=0; $i<$get_count_SDR; $i++){		
											
										?>
										<input type="hidden" name="update_chk[]" value="<? echo $k[$i]; ?>" />	
										<input type="hidden" name="sdr_end_no" value="<? echo max($b_SDR); ?>"/>
										<TR>
                              				<TD class=back2 align=right width="35%"><span class="bodytext">SDR Serial</span>:</TD>							
							  				<TD class=back colspan="3">
							  					Start No. <input type="text" name="others_start_no[]" maxlength="7" value="<? echo substr($a_SDR[$i]+10000000,1) ?>" size="7" onKeyUp="advance_end_no(this,'others_end_no');" />	
							  					&nbsp;End No. <input type="text" maxlength="7" size="7" value="<? echo substr($b_SDR[$i]+10000000,1) ?>" name="others_end_no[]" />					
										 		= <? echo $l[$i]."X".$others_books[$i]."=".$l[$i]*$others_books[$i];?>
											</TD>							 
						  				 </TR>										
										 <?
										// }
										 
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
				 </TD></TR></TBODY></TABLE>
<?
}
?>