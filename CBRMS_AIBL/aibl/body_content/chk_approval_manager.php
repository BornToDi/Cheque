<? 
session_cache_limiter('nocache');
session_start();
include_once ("../config.php");
include_once ("../tex_common.php");

if (empty($_SESSION['username'])||($_SESSION['user_type']!='manager'))
{
	redirectUrl('manager_signin.php');
}
//echo "??".$_SESSION['username'].$_SESSION['user_type'];

	$option=$_REQUEST['option'];
	?>
	<link href="<?php echo isset($uiPortal) ? 'style/style.css' : '../style/style.css'; ?>" rel="stylesheet" type="text/css"><link rel="stylesheet" href="../../ui/modern.css"><meta name="viewport" content="width=device-width, initial-scale=1"><script src="../../ui/popup.js" defer></script>
	<SCRIPT language=javascript1.2 src="<?php echo isset($uiPortal) ? 'js/common.js' : '../js/common.js'; ?>" type=text/javascript></SCRIPT>
	<?
					
			//if($_REQUEST['option']=='req_confirm')  { ?>
											  
				  
                <!-- Display User Information------------->
				  <form id ="frmChk" name="frmChk" method="post" action="index.php?option=chk_approval_manager">
				  
				  <?
				  				
				  	if($_POST['submit_mult_update']=='Approve') { 
					
						 
						$approval_date_time=date("Y-m-d H:i:s a");
						$chk=$_POST['chk'];					
						$c=count($chk);						
						//$approve='approval';	
	  					//if ($approve=='approval') $get_approve='pending'; else $get_active=1;
	  					for ($i=0; $i<$c; $i++)
						{	  						
							$query ="Update aibl_chq_rqst set approve_by='$_SESSION[user_id]', approval_date_time='$approval_date_time', rqst_status='pending' where rqst_id='$chk[$i]'";							
							mysql_query($query) or
							die (mysql_error());					
						}						
						redirectUrl("index.php?option=chk_approval_manager"); 					
					}
					
					if($_POST['submit_mult_update']=='Resend') { 
											 
						$approval_date_time=date("Y-m-d H:i:s a");
						$chk=$_POST['chk'];					
						$c=count($chk);											
						//$approve='approval';	
	  					//if ($approve=='approval') $get_approve='pending'; else $get_active=1;
	  					for ($i=0; $i<$c; $i++)
						{	  						
							$query ="Update aibl_chq_rqst set rqst_status='reject' where rqst_id='$chk[$i]'";							
							mysql_query($query) or
							die (mysql_error());											
						}					
						redirectUrl("index.php?option=chk_approval_manager"); 					
					}
					
 				?>
				 
			
			
				  <TABLE  class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info><div align="left"><B>Requested Cheque Book Information </B></div>
							</TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
 				</TABLE>
				  <TABLE  class=border2 cellSpacing=0 cellPadding=0 width="100%" align=center border=0></br>
                    <TBODY>
                    <TR>
                      <TD>
					  <DIV>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0 class=border>
                          <TBODY>                          
                            <TR>
                            <TD class=info align=left colSpan=11>
								<B>Total Request Information for Approval</B>											
							</TD>
						  </TR>
                          <TR>
							 
							 <TD width="7%" align="center" class="hf">
							 
								&nbsp;<B>#</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkall" onclick="checkedAll(frmChk);">						
							</TD>
							<TD  class=hf>
								<B>Requested By</B>							
							</TD>
							<TD  class=hf>
								<B>Account No</B>							
							</TD>
							<TD class=hf>
								<B>Branch Name</B>							
							</TD>
							
							<TD  class=hf>
								<B>Customer Name</B>							
							</TD>
							
							<TD  class=hf>
								<B>Requisition Date</B>							
							</TD>
							<TD  class=hf>
								<B>Account Type-Lvs</B>							
							</TD>
							<TD  class=hf>
								<B>Books</B>							
							</TD>
							<TD class=hf>
								<B>Collecting Branch</B>
							</TD>
							<TD class=hf>
								<B>Delivery Type</B>							
							</TD>
							<TD class=hf>
								<B>Order Date</B>
							</TD>
							
						  </TR>
						  <?						  	
							$query="select * from aibl_chq_rqst where rqst_status='approval' and collecting_branch_code='".$_SESSION['branch_code']."'";															
												
							$result = mysql_query($query) or
							die(mysql_error());
							
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							$sl=0;
							while ($row =mysql_fetch_assoc($result))
							{
							$req_date=str_replace('-','/',$row['rqst_date']);							
							$order_date=str_replace('-','/',$row['order_date_time']);							
							?>
								<tr>
								<td class=<? echo $class; ?> align="center" width="7%">&nbsp;<? echo $sl; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="chk[]" value="<? echo $row['rqst_id']; ?>" style=" border-style:none"></td>
								<td class=<? echo $class; ?>><? echo $row['rqst_by'];?> </a></td>
								<td class=<? echo $class; ?>><? echo $row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no']; ?> </td>
								<td class=<? echo $class; ?>><? echo $row['collecting_branch']; ?> </td>																
								<td class=<? echo $class; ?>><? echo $row['cus_name']; ?> </td>								
								<td class=<? echo $class; ?>><? echo date('M d, Y', strtotime($req_date)); ?></td>									
								<td class=<? echo $class; ?>><? echo $row['ac_type']."- ".$row['total_leaf']; ?> </td>
								<td class=<? echo $class; ?>><? echo $row['books']; ?> </td>
								<td class=<? echo $class; ?>><? echo $row['collecting_branch']; ?> </td>
								<td class=<? echo $class; ?>><? echo $row['severity']; ?> </td>
								<td class=<? echo $class; ?>><? echo date('M d, Y h:i a', strtotime($order_date)); ?> </td>															
								</tr>
								<?
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
				<div align="justify"><br />	  
				<input type="submit" name="submit_mult_update" value="Approve" onclick="return isChk();"  />
				<input type="submit" name="submit_mult_update" value="Resend" onclick="return isChk();"  />
				</div>
				</form>				  				  
				<!----- End ------------------------------->  
				
				 <?				 
 			//}
		
		?>	
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=550');
}
</script>
                  
				<FORM name="frmSearch" action="index.php?option=chk_approval_manager" method="post">
				<TABLE class=border cellSpacing=1 cellPadding=2 width="100%" border=0>
						
                          <TBODY>
						   <TR>
                            <TD class=info align=left colSpan=4>
								<B>Serach for Customer information (Last 10 Requisitions) </B>										
							</TD>
						  </TR>						  
						  <TR height="25">						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Account No</span>:</TD>
                            <TD class=back colSpan=3>
								
                                <input type="text" readonly="readonly"  name="ac_no_branch" size="4" maxlength="4" value="<? echo $_SESSION['branch_code']; ?>"/>
								 -&nbsp 
								<input type="text" name="ac_no_suffix" size="3" maxlength="3" value="<? echo $_POST[ac_no_suffix]; ?>" 
								onkeypress="return isNumberKey(event)"								
								>	
							    -&nbsp;
								<input type="text"  name="ac_no_cus_no" size="8" maxlength="8" value="<? echo $_POST[ac_no_cus_no]; ?>" 															
								onkeypress="return isNumberKey(event)" 								
								>
														
							</TD>
						  </TR>
						  <TR height="25">						  	
                            <TD class=back2 align=right width="24%"><span class="bodytext">Account Name</span>:</TD>
                            <TD class=back colSpan=3>
								<input type="text" name="ac_name" size="35"  value="<? echo $_POST[ac_name]; ?>" />								 						
															
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
                              <TD class=hf align=left width='99'>
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
								<B>Start - End No. </B>
							</TD>
							<TD class=hf align=lef width='55'>
								<B>Del. Type </B>
							</TD>
							<TD class=hf align=lef width='60'>
								<B>Status </B>
							</TD>
							<TD class=hf align=lef width='100'>
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
			  				  				  
				  <DIV class=syntax_hilite style="height:200">
				   <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>                   		                        						
						<TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
					 <? 											
						
						$ac_name=trim($_POST['ac_name']);
						$ac_no_branch=trim($_POST['ac_no_branch']);
						$ac_no_cus_no=trim($_POST['ac_no_cus_no']);
					 	$ac_no_suffix=trim($_POST['ac_no_suffix']);							
						
					  if((!empty($ac_name))|| (!empty($ac_no_branch))||(!empty($ac_no_cus_no))|| (!empty($ac_no_suffix)))
					  {						  						
						$searchcriteria = array();
													
						if(!empty($ac_no_branch))
							$searchcriteria[] = "ac_no_branch like '$ac_no_branch%'";	
							
						if(!empty($ac_no_cus_no))
							$searchcriteria[] = "ac_no_cus_no like '$ac_no_cus_no%'";
							
						if(!empty($ac_no_suffix))
							$searchcriteria[] = "ac_no_suffix like '$ac_no_suffix%'";		
																					
						if(!empty($ac_name))
							$searchcriteria[] = "cus_name like '%$ac_name%'";
												
						
						
						$searchdate = array();														
						if(!empty($order_date_from) && !empty($order_date_to))
						{							
							$date_from=date('Y-m-d', strtotime($order_date_from));							
							//$date_to=date('Y-m-d', strtotime($order_date_to));	
							$date=explode("-", "$order_date_to");					 									
							$d=$date[2];
							$m=$date[1];						
							$y=$date[0];					
							$date_to=date('Y-m-d',mktime(0, 0, 0, $m, $d+1, $y));													
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
						
						
						
						$querystring = "";
						$querystring = ($searchtext)?join(" and ",$searchtext):"";
						if(!empty($querystring))
							$querystring = " where ".$querystring;
													
								$query1="select * from aibl_chq_rqst".$querystring." && collecting_branch_code ='".$_SESSION['branch_code']."' limit 1,10";	
							
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
								$date=date('M d, Y H:i', strtotime($date));								
								}
								else 
								$date= "Not yet approved";
								
								if(($row['dispatch_datetime'])!=0){
								$dis_date=str_replace('-','/',$row['dispatch_datetime']); 
								$dis_date=date('M d, Y H:i', strtotime($dis_date));								
								}
								else 
								$dis_date= "Not yet Dispached";
								
								if($row['rqst_status']=='approval')$status='Awaiting approval';
								else $status=$row['rqst_status'];
								
								$req_id[]=$row['rqst_id'];
								
								
									$ac_no=$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no'];
									
								echo "<tr>
								<td class=$class width='97'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\" style='text-decoration:underline'>$ac_no</a></td>
								<td class=$class width='65'>".$row['rqst_by']."</td>
								<td class=$class width='75'>".strtok($row['collecting_branch'], " ")."</td>
								<td class=$class width='95'>".$row['ac_type']."- ".$row['total_leaf']."X".$row['books']." Lvs</td>
								<td class=$class width='100' align='center'>".$row['start_no']."- ".$row['end_no']."</td>
								<td class=$class width='55'>".$row['severity']."</td>
								<td class=$class width='60'>$status</td>
								<td class=$class width='100'>$date</td>	
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
					$alart="There are no results to display. Please re-check and try again";

			    	echo "<tr><td class=hf colspan=4><font size=3px><b>$alart</b></font></td></tr>";
				}
				else{
					foreach($req_id as $key=>$value) {
						$strArray .= "id[$key]=$value&";
					}
				}
				$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=850,height=470,directories=no,location=no';
				$link = 'popups/search_request_print.php';
				?>  
						  
											  	 			  
					   </TBODY>
					 </TABLE>
				   </TD></TR>
				</TBODY>
			  </TABLE>
			  
<?
 }


?>

				</TD></TR>
			</TBODY>
		</TABLE>