<?
//include_once ('../tex_common.php');
include_once ("../config.php");
?>
<SCRIPT src="js/clmenuh.js" type=text/javascript></SCRIPT>
<LINK href="style/clmenu.css" type=text/css rel=stylesheet>
<TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Task Manager Options</B>
							</TD></TR>
                          <TR>
                            <TD class=cat><B>Task Options</B></TD></TR>
							
						  <? if($_SESSION['user_type']=='admin'){ ?>
                          <TR>
                            <TD class=subcat>                              							  
							 <DIV class="mH">
								<LI><A a href="javascript:;" onclick="toggleMenu('admin_user_menu')" >Manage User</A></LI>
							</DIV>
      						<? if($_REQUEST['option']=='aibl_user') {?>
							<DIV id="admin_user_menu" class="mC">	  							      							
								<A class="mO" href="index.php?option=aibl_user&task=add_user"><span style="color:#2852A1"> - </span>Add User</A>  	  														
								<A class="mO" href="index.php?option=aibl_user&task=modify_user"><span style="color:#2852A1"> - </span>Modify User </A> 																							 
							 </DIV>	
							<? }
							 	else {
							?>
								<DIV id="admin_user_menu" class="mL">	  							      							
								<A class="mO" href="index.php?option=aibl_user&task=add_user"><span style="color:#2852A1"> - </span>Add User</A>  	  														
								<A class="mO" href="index.php?option=aibl_user&task=modify_user"><span style="color:#2852A1"> - </span>Modify User </A> 																							 
							 </DIV>	
							<?	
								}
							 ?>	
							</TD>
						  </TR>
						  
						  <TR>
                            <TD class=subcat>
                              
							  <DIV class="mH">
								<LI><A a href="javascript:;" onclick="toggleMenu('admin_branch_menu')" >Manage Branch</A></LI>
							</DIV>
      						<? if($_REQUEST['option']=='manage_branch') {?>
							<DIV id="admin_branch_menu" class="mC">	  							      							
								<A class="mO" href="index.php?option=manage_branch&task=add_branch"><span style="color:#2852A1"> - </span>Add Branch</A>  	  														
								<A class="mO" href="index.php?option=manage_branch&task=modify_branch"><span style="color:#2852A1"> - </span>Modify Branch</A> 																							 
							 </DIV>	
							<? }
							 	else {
							?>
							<DIV id="admin_branch_menu" class="mL">	  							      							
								<A class="mO" href="index.php?option=manage_branch&task=add_branch"><span style="color:#2852A1"> - </span>Add Branch</A>  	  														
								<A class="mO" href="index.php?option=manage_branch&task=modify_branch"><span style="color:#2852A1"> - </span>Modify Branch</A> 																						 
							 </DIV>	
							<?	
								}
							 ?>	
							</TD>
						  </TR>
						  
						  <? } 
						   //if(($_SESSION['user_type']=='admin')||($_SESSION['user_type']=='user'))
						   if($_SESSION['user_type']=='user')
						   {
						  ?>						  
						  <TR>
						  	<TD class=subcat>	  
                              <LI><A href="#">Cheque Book Request</A> 
							</TD>
						  </TR>	
						  <TR>
						  	<TD class=subcat>	  
                              <LI><A href="#">Others Request</A> 
							</TD>
						  </TR>	
						  <? } 
						    if($_SESSION['user_type']=='gsd'){ 
						  ?>
						   <TR>
						  	<TD class=subcat>	  
														      						
							<DIV class="mH">
								<LI><A a href="javascript:;" onclick="toggleMenu('admin_search_menu')" >Search</A></LI>
							</DIV>
      						<? if(($_REQUEST['option']=='search_criteria')||($_REQUEST['option']=='others_search_criteria')) {?>
							<DIV id="admin_search_menu" class="mC">	  							      							
								<A class="mO" href="index.php?option=search_criteria&task=search_all"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_search_criteria&task=others_search_all"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<? }
							 	else {
							?>
								<DIV id="admin_search_menu" class="mL">	  							      							
								<A class="mO" href="index.php?option=search_criteria&task=search_all"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_search_criteria&task=others_search_all"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<?	
								}
							 ?>				
							  </TD>
						  </TR>
                          <?
						  }		
						  if($_SESSION['user_type']=='user'){ 
						  ?>
						   <TR>
						  	<TD class=subcat>	  
							
							<DIV class="mH">
								<LI><A a href="javascript:;" onclick="toggleMenu('search_menu')" >Search</A></LI>
							</DIV>
      						<? if(($_REQUEST['option']=='user_search_criteria')||($_REQUEST['option']=='others_user_search_criteria')) {?>
							<DIV id="search_menu" class="mC">	  							      							
								<A class="mO" href="index.php?option=user_search_criteria&task=search_all"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_user_search_criteria&task=others_search_all"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<? }
							 	else {
							?>
								<DIV id="search_menu" class="mL">	  							      							
								<A class="mO" href="index.php?option=user_search_criteria&task=search_all"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_user_search_criteria&task=others_search_all"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<?	
								}
							 ?>						
							  </TD>
						  </TR>
						   
                          <?
						  }	
						  if($_SESSION['user_type']=='manager'){ 
						  ?>
						  <TR>
						  	<TD class=subcat>	  
							
							<DIV class="mH">
								<LI><A a href="javascript:;" onclick="toggleMenu('approval_menu')" >Awaiting Approval</A></LI>
							</DIV>
      						<? if(($_REQUEST['option']=='chk_approval_manager')||($_REQUEST['option']=='others_approval_manager')) {?>
							<DIV id="approval_menu" class="mC">	  							      							
								<A class="mO" href="index.php?option=chk_approval_manager"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_approval_manager"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<? }
							 	else {
							?>
								<DIV id="approval_menu" class="mL">	  							      							
								<A class="mO" href="index.php?option=chk_approval_manager"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_approval_manager"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<?	
								}
							 ?>		
							
							  </TD>
						  </TR>
						   <TR>
						  	<TD class=subcat>	  
															      						
							<DIV class="mH">
								<LI><A a href="javascript:;" onclick="toggleMenu('manager_search_menu')" >Search</A></LI>
							</DIV>
      						<? if(($_REQUEST['option']=='manager_search_criteria')||($_REQUEST['option']=='others_manager_search_criteria')) {?>
							<DIV id="manager_search_menu" class="mC">	  							      							
								<A class="mO" href="index.php?option=manager_search_criteria&task=search_all"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_manager_search_criteria&task=search_all"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<? }
							 	else {
							?>
								<DIV id="manager_search_menu" class="mL">	  							      							
								<A class="mO" href="index.php?option=manager_search_criteria&task=search_all"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_manager_search_criteria&task=search_all"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<?	
								}
							 ?>		
							
							  </TD>
						  </TR>
                          <?
						  }							  				  
						  ?>
						  <TR>
						  	<TD class=subcat>	  
                              <LI><A href="index.php?option=change_password">Change Password</A> 
							</TD>
						 </TR>
                          <? if(($_SESSION['user_type']=='user')||($_SESSION['user_type']=='manager')||($_SESSION['user_type']=='gsd')){ ?>
                          <TR>
                            <TD class=cat><B>Task Manager Options</B></TD>
						 </TR>
							
						<? 
						}
						if($_SESSION['user_type']=='user'){ ?>
                          						  
						  						  						  
						  <TR>
                            <TD class=subcat>
                              							  
							  <DIV class="mH">
								<LI><A a href="javascript:;" onclick="toggleMenu('ack_menu')" >Acknowledgement</A></LI>
							</DIV>
      						<? if(($_REQUEST['option']=='chk_ack')||($_REQUEST['option']=='others_ack')) {?>
							<DIV id="ack_menu" class="mC">	  							      							
								<A class="mO" href="index.php?option=chk_ack"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_ack"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<? }
							 	else {
							?>
								<DIV id="ack_menu" class="mL">	  							      							
								<A class="mO" href="index.php?option=chk_ack"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_ack"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<?	
								}
							 ?>		
							  
        					</TD>
						  </TR>						  
						  <? 
						  }
						  if($_SESSION['user_type']=='gsd'){ ?>
						  <TR>
                            <TD class=subcat>
                              							 
        					<DIV class="mH">
								<LI><A a href="javascript:;" onclick="toggleMenu('admin_view_menu')" >View Request</A></LI>
							</DIV>
      						<? if(($_REQUEST['option']=='total_request')||($_REQUEST['option']=='others_total_request')) {?>
							<DIV id="admin_view_menu" class="mC">	  							      							
								<A class="mO" href="index.php?option=total_request&task=total_request_admin&order=order_date_time"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_total_request&task=others_total_request_admin&order=order_date_time"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<? }
							 	else {
							?>
								<DIV id="admin_view_menu" class="mL">	  							      							
								<A class="mO" href="index.php?option=total_request&task=total_request_admin&order=order_date_time"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_total_request&task=others_total_request_admin&order=order_date_time"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<?	
								}
							 ?>	
							
							</TD>
						  </TR>
						  
						  <? }
						  
						  if(($_SESSION['user_type']=='manager')||($_SESSION['user_type']=='user')){ 
						  	$query="select rqst_status from aibl_chq_rqst where collecting_branch_code ='".$_SESSION['branch_code']."' and rqst_status='reject'";															
							$no_req_reject=mysql_num_rows(mysql_query($query));	
							
							$query1="select others_rqst_status from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."' and others_rqst_status='reject'";																					
							$no_others_reject=mysql_num_rows(mysql_query($query1));	
						  ?>
						  <TR>
                            <TD class=subcat>                                     												
								<LI><A a href="index.php?option=manage_chk_request&order=order_date_time">Rejected Cheque Request: <B><? echo $no_req_reject;?></B></A></LI>
								<LI><A a href="index.php?option=manage_others_request&order=others_order_date_time">Rejected Others Request: <B><? echo $no_others_reject;?></A></LI>																														
							</TD>
						  </TR>	
						  <? }
						  
						  if(($_SESSION['user_type']=='manager')||($_SESSION['user_type']=='user')){ 						  
						  ?>						  						  
						  <TR>
                            <TD class=subcat>
                             
							<DIV class="mH">
								<LI><A a href="javascript:;" onclick="toggleMenu('manager_view_menu')" >View Request</A></LI>
							</DIV>
      						<? if(($_REQUEST['option']=='total_request')||($_REQUEST['option']=='others_total_request')) {?>
							<DIV id="manager_view_menu" class="mC">	  							      							
								<A class="mO" href="index.php?option=total_request&task=total_request_manager"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_total_request&task=others_total_request_manager"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<? }
							 	else {
							?>
								<DIV id="manager_view_menu" class="mL">	  							      							
								<A class="mO" href="index.php?option=total_request&task=total_request_manager"><span style="color:#2852A1"> - </span>Cheque Request</A>  	  														
								<A class="mO" href="index.php?option=others_total_request&task=others_total_request_manager"><span style="color:#2852A1"> - </span>Other Items Request </A> 																							 
							 </DIV>	
							<?	
								}
							 ?>		
							
							</TD>
						  </TR>
						  
						  <? }
						  ?>
						  
					  </TBODY>
				  </TABLE></TD></TR></TBODY></TABLE><BR>
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <? if(($_SESSION['user_type']=='user')||($_SESSION['user_type']=='manager')||($_SESSION['user_type']=='gsd')){ ?>
						  <TR>
                            <TD class=info align=middle>
							<B>Cheque Book Status</B>
							</TD>
						  </TR>
						  <?
						  }						  
						  if($_SESSION['user_type']=='user'){
												
								$query1="select rqst_status from aibl_chq_rqst where collecting_branch_code ='".$_SESSION['branch_code']."'";																											  							
								$no_req=mysql_num_rows(mysql_query($query1));													
								
								$query2="select rqst_status from aibl_chq_rqst where collecting_branch_code ='".$_SESSION['branch_code']."' and rqst_status='ordered'";															
								$no_order=mysql_num_rows(mysql_query($query2));
														
								$query3="select rqst_status from aibl_chq_rqst where collecting_branch_code ='".$_SESSION['branch_code']."' and rqst_status='pending'";															
								$no_pending=mysql_num_rows(mysql_query($query3));
														
								$query4="select rqst_status from aibl_chq_rqst where collecting_branch_code ='".$_SESSION['branch_code']."' and rqst_status='dispatched'";								
								$no_dispatched=mysql_num_rows(mysql_query($query4));
														
								$query5="select rqst_status from aibl_chq_rqst where collecting_branch_code ='".$_SESSION['branch_code']."' and rqst_status='delivered'";							
								$no_delivered=mysql_num_rows(mysql_query($query5));
														
								$query6="select rqst_status from aibl_chq_rqst where collecting_branch_code ='".$_SESSION['branch_code']."' and rqst_status='approval'";								
							
								$no_approval=mysql_num_rows(mysql_query($query6));
							//---------------------------------------------------------
						  ?>
                          <TR>
                            <TD class=cat>
							 <B>Total Request : <? echo $no_req;?></B><BR>
							 <B>Awaiting approval : <? echo $no_approval;?></B><BR>
							 <B>Under Process : <? echo ($no_pending+$no_order);?></B><BR>                            			 
							 <B>Dispatched : <? echo $no_dispatched;?></B><BR>
							 <B>Delivered : <? echo $no_delivered;?></B><BR>
							</TD>
						  </TR>
						  <?
						  }
						  						  
						  if(($_SESSION['user_type']=='gsd') ||($_SESSION['user_type']=='vendor')) {
							
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
							 <a href="index.php?option=total_request&task=total_request_reject"><B>Rejected Request : <? echo $no_req_reject;?></B></a><BR>
							 
							 <a href="index.php?option=total_request&task=total_request_pending"><B>Pending : <? echo $no_pending;?></B></a><BR>
                             <a href="index.php?option=total_request&task=total_request_ordered"><B>Ordered : <? echo $no_order;?></B></a><BR>							 							 
							 <a href="index.php?option=total_request&task=total_request_dispatched"><B>Dispatched : <? echo $no_dispatched;?></B></a><BR>
							 
							</TD>
						  </TR>
						  <?
						  }
						   if($_SESSION['user_type']=='manager'){
						   
								$query1="select rqst_status from aibl_chq_rqst where collecting_branch_code ='".$_SESSION['branch_code']."'";																													
								$no_req=mysql_num_rows(mysql_query($query1));
														
								$query2="select rqst_status from aibl_chq_rqst where collecting_branch_code ='".$_SESSION['branch_code']."' and rqst_status='ordered'";															
								$no_order=mysql_num_rows(mysql_query($query2));
														
								$query3="select rqst_status from aibl_chq_rqst where collecting_branch_code ='".$_SESSION['branch_code']."' and rqst_status='pending'";																						
								$no_pending=mysql_num_rows(mysql_query($query3));
														
								$query4="select rqst_status from aibl_chq_rqst where collecting_branch_code ='".$_SESSION['branch_code']."' and rqst_status='dispatched'";																					
								$no_dispatched=mysql_num_rows(mysql_query($query4));
														
								$query5="select rqst_status from aibl_chq_rqst where collecting_branch_code ='".$_SESSION['branch_code']."' and rqst_status='delivered'";																						
								$no_delivered=mysql_num_rows(mysql_query($query5));
														
								$query6="select rqst_status from aibl_chq_rqst where collecting_branch_code ='".$_SESSION['branch_code']."' and rqst_status='approval'";																						
								$no_approval=mysql_num_rows(mysql_query($query6));
						  ?>
                          <TR> 
                            <TD class=cat>
							 <B>Total Request : <? echo $no_req;?></B><BR>
							 <B>Awaiting approval : <? echo $no_approval;?></B><BR>
							 <B>Under Process : <? echo ($no_pending+$no_order);?></B><BR>                             					 							
							 <B>Dispatched : <? echo $no_dispatched;?></B><BR>
							 <B>Delivered : <? echo $no_delivered;?></B><BR>
							</TD>
						  </TR>
						  <?
						  }
	//------------------For Security Instrument Status -------------------------------------------------------------					  
						   if(($_SESSION['user_type']=='user')||($_SESSION['user_type']=='manager')||($_SESSION['user_type']=='gsd')){ ?>
						  
						  
						 <TR>
                            <TD class=info align=middle>
							<B>PO, DD, FDD, FDR, SDR Status</B>
							</TD>
						  </TR>
						  <?	
						  }					  
						  if($_SESSION['user_type']=='user'){
							
							$query1="select others_rqst_status from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."'";																														
							$no_req=mysql_num_rows(mysql_query($query1));						
								
							$query2="select others_rqst_status from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."' and others_rqst_status='ordered'";																					
							$no_order=mysql_num_rows(mysql_query($query2));
														
							$query3="select others_rqst_status from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."' and others_rqst_status='pending'";																					
							$no_pending=mysql_num_rows(mysql_query($query3));
														
							$query4="select others_rqst_status from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."' and others_rqst_status='dispatched'";																					
							$no_dispatched=mysql_num_rows(mysql_query($query4));
														
							$query5="select others_rqst_status from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."' and others_rqst_status='delivered'";																						
							$no_delivered=mysql_num_rows(mysql_query($query5));
													
							$query6="select others_rqst_status from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."' and others_rqst_status='approval'";																						
							$no_approval=mysql_num_rows(mysql_query($query6));
							//---------------------------------------------------------
						  ?>
                          <TR>
                            <TD class=cat>
							 <B>Total Request : <? echo $no_req;?></B><BR>
							 <B>Awaiting approval : <? echo $no_approval;?></B><BR>
							 <B>Under Process : <? echo ($no_pending+$no_order);?></B><BR>                             				 
							 <B>Dispatched : <? echo $no_dispatched;?></B><BR>
							 <B>Delivered : <? echo $no_delivered;?></B><BR>
							</TD>
						  </TR>
						  <?
						  }
						  						  
						  if($_SESSION['user_type']=='gsd') {
							
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
							 
							 <a href="index.php?option=others_total_request&task=others_total_request_pending"><B>Pending : <? echo $no_pending;?></B></a><BR>
                             <a href="index.php?option=others_total_request&task=others_total_request_ordered"><B>Ordered : <? echo $no_order;?></B></a><BR>							 							 
							 <a href="index.php?option=others_total_request&task=others_total_request_dispatched"><B>Dispatched : <? echo $no_dispatched;?></B></a><BR>
							 	
							</TD>
						  </TR>
						  <?
						  }
						   if($_SESSION['user_type']=='manager'){
							
							$query_hvbbn ="select branch_name from aibl_login where branch_name='".$_SESSION['branch_code']."'";			
							$sql_result = mysql_query($query_hvbbn) or
			 				die('Server Connection Error!');
			 				$get_hvbbn = mysql_fetch_array($sql_result);
							//echo $get_hvbbn['branch_name'];
														
							$query1="select others_rqst_status from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."'";																														
							$no_req=mysql_num_rows(mysql_query($query1));						
								
							$query2="select others_rqst_status from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."' and others_rqst_status='ordered'";																					
							$no_order=mysql_num_rows(mysql_query($query2));
														
							$query3="select others_rqst_status from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."' and others_rqst_status='pending'";																					
							$no_pending=mysql_num_rows(mysql_query($query3));
														
							$query4="select others_rqst_status from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."' and others_rqst_status='dispatched'";																					
							$no_dispatched=mysql_num_rows(mysql_query($query4));
														
							$query5="select others_rqst_status from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."' and others_rqst_status='delivered'";																						
							$no_delivered=mysql_num_rows(mysql_query($query5));
													
							$query6="select others_rqst_status from aibl_others_rqst where others_collecting_branch_code='".$_SESSION['branch_code']."' and others_rqst_status='approval'";																						
							$no_approval=mysql_num_rows(mysql_query($query6));
						  ?>
                          <TR> 
                            <TD class=cat>
							 <B>Total Request : <? echo $no_req;?></B><BR>
							 <B>Awaiting approval : <? echo $no_approval;?></B><BR>
							 <B>Under Process : <? echo ($no_pending+$no_order);?></B><BR>                            							 							
							 <B>Dispatched : <? echo $no_dispatched;?></B><BR>
							 <B>Delivered : <? echo $no_delivered;?></B><BR>
							</TD>
						  </TR>
						  <?
						  }
						  ?>
 
						  
						  
						 </TBODY>
					</TABLE>
					</TD>
					</TR>
					</TBODY>
				   </TABLE>
