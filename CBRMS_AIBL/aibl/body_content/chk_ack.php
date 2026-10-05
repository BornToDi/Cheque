<?php
include_once ("../config.php");
include_once ("../tex_common.php");

if (empty($_SESSION['username'])||($_SESSION['user_type']!='user'))
{
	redirectUrl('user_signin.php');
}

include ("pagging/pagging_excel.php");
include ("pagging/ordered_pagging_excel.php");
include ("pagging/pending_pagging_excel.php");
include ("pagging/dispatched_pagging_excel.php");


?>
<script language="javascript">
function OpenLivePic(rsqt_id) {		
	window.open('body_content/chk_request_details.php?rsqt_id=' +rsqt_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
}
</script>
                  <?
				  if(isset($_POST['edit']))
					{	
								
						 
						//$cur_date=date("M d, Y g:i a"); 
						
						$update_chk=$_POST['chk'];										
						$c=count($update_chk);	
																
						$delivered_date_time=date('Y-m-d H:i:s a'); 							
						for ($i=0; $i<$c; $i++)
						{														
							//echo "rabo".$update_chk[$i];
							//echo "aaa".$_POST['req_status'];
							$update_req_query ="Update aibl_chq_rqst set rqst_status='delivered',delivered_datetime='$delivered_date_time' where rqst_id='$update_chk[$i]'";  										
							mysql_query($update_req_query) or
							die (mysql_error());		
						}						
						redirectUrl("index.php?option=chk_ack"); 
																																												
					}		
				  ?>
				  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Acknowledgement Information </B>
							</TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
 				</TABLE><BR>
                  <form name="frmChk" method="post" action="index.php?option=chk_ack">
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
        
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD width="7%" align="center" class="hf">							 
								&nbsp;<B>#</B>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkall" onclick="checkedAll(frmChk);">						
							</TD>
							 <TD class=hf align=left>
								<B>Maker ID </B>						
							</TD>
							 <TD class=hf align=lef>
								<B>Approved Date</B>								
							</TD>	
							<TD class=hf align=lef>
								<B>Account No </B>
							</TD>
							<TD class=hf align=lef>
								<B>Account Name </B>
							</TD>
							<TD class=hf align=lef>
								<B>Start-End Chq. No. </B>
							</TD>
							
							 <TD class=hf align=lef>
								<B>Account Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>D. Type </B>
							</TD>
							<TD class=hf align=lef>
								<B>Dispatched Date</B>
							</TD>
							
							
						  </TR>
						  <?
						
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							$sl=1;
						
								$query = "select * from aibl_chq_rqst where rqst_status='dispatched' and collecting_branch_code ='".$_SESSION['branch_code']."' order by  order_date_time desc";
							
							$result = mysql_query($query);
							//$result = select_entries_dispatched_excel($offset);
							while ($row =mysql_fetch_assoc($result))
							{
								$date=str_replace('-','/',$row['order_date_time']); 
								$dis_date=str_replace('-','/',$row['dispatch_datetime']); 
								
								if($row['ac_no_branch']!=4027)
									$ac_no=$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no'];
								else	
									$ac_no=$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no'];
								
								echo "<tr>	
								<td class=$class align=center>&nbsp;$sl&nbsp;&nbsp;&nbsp;<input type='checkbox' name='chk[]' value=".$row['rqst_id']." style='border-style:none'></td>														
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['rqst_by']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".date('M d, Y h:i a', strtotime($date))."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">$ac_no</a></td>
								<td class=$class style='font-size : 7.5pt;'><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['cus_name']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['start_no']." / ".($row['end_no']-$row['start_no']+1)."</td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['ac_type']."- ".$row['total_leaf']."X".$row['books']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".$row['severity']."</a></td>
								<td class=$class><a href=\"javascript:OpenLivePic(".$row['rqst_id'].")\">".date('M d, Y h:i a', strtotime($dis_date))."</a></td>																
								</tr>";
								$sl++;
								if($class == $class1){
								$class = $class2;
								} else {
								$class = $class1;
								}

						}
						?>  
						  <TR>
							<TD  class=back colspan="9">
																				
							<input type="submit" name="edit" value="Received" onclick="return isChk();"/>
							<center><?php //nav_dispatched_excel($offset); ?> </center>										
							</TD>
						</TR>
											  	 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE>
					  </form>
					 </TD></TR></TBODY></TABLE>
					 <!--
					 <div align="center"><a href="excel/dispatched_pagging.php?offset=<? //echo $_REQUEST['offset']?>"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download as per page</font></b></a>
					 <a href="excel/dispatched_all.php"><img src="images/excel.gif" width="23" height="22" border="0" hspace="2"/>&nbsp;<b><font size="2">Download all</font></b></a></div>
					-->
