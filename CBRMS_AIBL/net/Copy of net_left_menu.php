<?
//include_once ('../tex_common.php');
include_once ("../config.php");
?>
<SCRIPT src="../aibl/js/clmenuh.js" type=text/javascript></SCRIPT>
<LINK href="../aibl/style/clmenu.css" type=text/css rel=stylesheet>
<TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Task Manager Options</B>
							</TD></TR>
                          <TR>
                            <TD class=cat><B>Task Options</B></TD>
						  </TR>
													 
						  <?  
						   if($_SESSION['net_user_type']=='admin'){ ?>
                          <TR>
                            <TD class=subcat>
                              <LI><A href="index.php?option=net_user">Create User </A>
							</TD>
						  </TR>
						  <? } 						   
						   ?>
						   <TR>
						  	<TD class=subcat>	  
							
							  <DIV class="mH">
								<LI><A a href="javascript:;" onclick="toggleMenu('net_search_menu')" >Search</A></LI>
							</DIV>
      						<? if(($_REQUEST['option']=='search_criteria')||($_REQUEST['option']=='others_search_criteria')) {?>
							<DIV id="net_search_menu" class="mC">	  							      							
								<A class="mO" href="index.php?option=search_criteria&task=search_all"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_search_criteria&task=others_search_all"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<? }
							 	else {
							?>
								<DIV id="net_search_menu" class="mL">	  							      							
								<A class="mO" href="index.php?option=search_criteria&task=search_all"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_search_criteria&task=others_search_all"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<?	
								}
							 ?>				
							  							  
							  </TD>
						  </TR>
                          <TR>
                            <TD class=subcat>                            
							  <DIV class="mH">
								<LI><A a href="javascript:;" onclick="toggleMenu('psi_print_menu')" >To be printed</A></LI>
							</DIV>
      						<? if(($_REQUEST['option']=='psi_print')||($_REQUEST['option']=='others_psi_print')) {?>
							<DIV id="psi_print_menu" class="mC">	  							      							
								<A class="mO" href="index.php?option=psi_print&order=approval_date_time"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_psi_print&order=others_approval_date_time"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<? }
							 	else {
							?>
								<DIV id="psi_print_menu" class="mL">	  							      							
								<A class="mO" href="index.php?option=psi_print&order=approval_date_time"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_psi_print&order=others_approval_date_time"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<?	
								}
							 ?>									  
							</TD>
						  </TR>
						  <TR>
                            <TD class=subcat>
                              <LI><A href="index.php?option=manage_order">Manage Order</A>
							</TD>
						  </TR>
						  <TR>
                            <TD class=subcat>
                              <LI><A href="index.php?option=serial_no">Manage Serial No. </A>
							</TD>
						  </TR>
						  <TR>
                            <TD class=cat><B>Challan Options</B></TD>
						  </TR>
                          <TR>
                            <TD class=subcat>
                              <LI><A href="">Manage Challan No. </A>
							</TD>
						  </TR>						  
                           <TR>
                            <TD class=subcat>
                              
							   <DIV class="mH">
								<LI><A a href="javascript:;" onclick="toggleMenu('delivery_challan')" >Set Challan No.</A></LI>
							</DIV>
      						<? if(($_REQUEST['option']=='challan_no')||($_REQUEST['option']=='others_challan_no')) {?>
							<DIV id="delivery_challan" class="mC">	  							      							
								<A class="mO" href="index.php?option=challan_no"><span style="color:#2852A1"> - </span>Cheque Challan No.</A>  	  														
								<A class="mO" href="index.php?option=others_challan_no"><span style="color:#2852A1"> - </span>Others Challan No </A> 																							 
							 </DIV>	
							<? }
							 	else {
							?>
								<DIV id="delivery_challan" class="mL">	  							      							
								<A class="mO" href="index.php?option=challan_no"><span style="color:#2852A1"> - </span>Set Challan No.</A>  	  														
								<A class="mO" href="index.php?option=others_challan_no"><span style="color:#2852A1"> - </span>Others Challan No </A> 																					 
							 </DIV>	
							<?	
								}
							 ?>			
							  
							</TD>
						  </TR>
						  
						  <TR>
                            <TD class=subcat>                             	  														
								<LI><A href="index.php?option=download_bill">Download Bill/Challan </A></LI> 																					 							
							</TD>
						  </TR>
						
					  </TBODY>
				  </TABLE></TD></TR></TBODY></TABLE><BR>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle>
							<B>Cheque Book Request Status</B>
							</TD>
						  </TR>
						  
						  <?						  						 					  
						  if(($_SESSION['net_user_type']=='vendor')||($_SESSION['net_user_type']=='admin')) {
							
						  	$query1="select rqst_status from aibl_chq_rqst";								
							$no_req=mysql_num_rows(mysql_query($query1));
							
							$query2="select rqst_status from aibl_chq_rqst where rqst_status='ordered'";								
							$no_order=mysql_num_rows(mysql_query($query2));
							
							$query3="select rqst_status from aibl_chq_rqst where rqst_status='pending'";								
							$no_pending=mysql_num_rows(mysql_query($query3));
							
							$query4="select rqst_status from aibl_chq_rqst where rqst_status='dispatched'";								
							$no_dispatched=mysql_num_rows(mysql_query($query4));
							
							$query5="select rqst_status from aibl_chq_rqst where rqst_status='delivered'";								
							$no_delivered=mysql_num_rows(mysql_query($query5));
							
							$query6="select rqst_status from aibl_chq_rqst where rqst_status='approval'";								
							$no_approval=mysql_num_rows(mysql_query($query6));
							
							$query7="select rqst_status from aibl_chq_rqst where rqst_status='reject'";															
							$no_req_reject=mysql_num_rows(mysql_query($query7));	
							
						  ?>
                          <TR>
                            <TD class=cat>
							 <a href="index.php?option=total_request&task=total_request_admin"><B>Total Request : <? echo $no_req;?></B></a><BR>
							 <a href="index.php?option=total_request&task=total_request_reject"><B>Resend Request : <? echo $no_req_reject;?></B></a><BR>							 
							 <a href="index.php?option=total_request&task=total_request_approval"><B>Awaiting approval : <? echo $no_approval;?></B></a><BR>
							 <a href="index.php?option=total_request&task=total_request_pending"><B>Pending : <? echo $no_pending;?></B></a><BR>                            							 
							 <a href="index.php?option=total_request&task=total_request_ordered"><B>Ordered : <? echo $no_order;?></B></a><BR>
							 <a href="index.php?option=total_request&task=total_request_dispatched"><B>Dispatched : <? echo $no_dispatched;?></B></a><BR>
							 <a href="index.php?option=total_request&task=total_request_delivered"><B>Delivered : <? echo $no_delivered;?></B></a><BR>	
							</TD>
						  </TR>
						  <?
						  }
						  ?>
						  
						  <TR>
                            <TD class=info align=middle>
							<B>Security Items Request Status</B>
							</TD>
						  </TR>						 
						  <?						  						  						  
						  
							
						  	$query1="select others_rqst_status from aibl_others_rqst";								
							$no_req=mysql_num_rows(mysql_query($query1));
							
							$query2="select others_rqst_status from aibl_others_rqst where others_rqst_status='ordered'";								
							$no_order=mysql_num_rows(mysql_query($query2));
							
							$query3="select others_rqst_status from aibl_others_rqst where others_rqst_status='pending'";								
							$no_pending=mysql_num_rows(mysql_query($query3));
							
							$query4="select others_rqst_status from aibl_others_rqst where others_rqst_status='dispatched'";								
							$no_dispatched=mysql_num_rows(mysql_query($query4));
							
							$query5="select others_rqst_status from aibl_others_rqst where others_rqst_status='delivered'";								
							$no_delivered=mysql_num_rows(mysql_query($query5));
							
							$query6="select others_rqst_status from aibl_others_rqst where others_rqst_status='approval'";								
							$no_approval=mysql_num_rows(mysql_query($query6));
							
							$query7="select others_rqst_status from aibl_others_rqst where others_rqst_status='reject'";																					
							$no_others_reject=mysql_num_rows(mysql_query($query7));	
							
						  ?>
                          <TR>
                            <TD class=cat>
							 <a href="index.php?option=others_total_request&task=others_total_request_admin"><B>Total Request : <? echo $no_req;?></B></a><BR>
							 <a href="index.php?option=others_total_request&task=others_total_request_reject"><B>Resend Request : <? echo $no_others_reject;?></B></a><BR>
							 <a href="index.php?option=others_total_request&task=others_total_request_approval"><B>Awaiting approval : <? echo $no_approval;?></B></a><BR>
							 <a href="index.php?option=others_total_request&task=others_total_request_pending"><B>Pending : <? echo $no_pending;?></B></a><BR>
                             <a href="index.php?option=others_total_request&task=others_total_request_ordered"><B>Ordered : <? echo $no_order;?></B></a><BR>							 							 
							 <a href="index.php?option=others_total_request&task=others_total_request_dispatched"><B>Dispatched : <? echo $no_dispatched;?></B></a><BR>
							 <a href="index.php?option=others_total_request&task=others_total_request_delivered"><B>Delivered : <? echo $no_delivered;?></B></a><BR>	
							</TD>
						  </TR>
						 

						 </TBODY>
					</TABLE>
					</TD>
					</TR>
					</TBODY>
				   </TABLE>
