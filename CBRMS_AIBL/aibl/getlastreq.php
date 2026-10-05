<?php 
include_once ('../config.php');
 
?>
<br>
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
			  				  				  
				  <DIV class=syntax_hilite style="height:120">
				   <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>                   		                        						
						<TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
					 <? 											
						
						
							$pro=$_GET['l'];
							$req_branch=substr($_GET['l'], 0, 4); 
							$ac_no_suffix=substr($_GET['l'], 4, 3); 	
							$cus_no=substr($_GET['l'], 7, 8); 

							//echo "??".$pro;
							
							$query1="select * from aibl_chq_rqst where collecting_branch_code='$req_branch' and ac_no_suffix='$ac_no_suffix' and ac_no_cus_no='$cus_no' limit 1,10";	
							
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
						}
						else
						echo "<tr><td class=back>No Previous Record Available</td></tr>";
									
				?>  
						  
											  	 			  
					   </TBODY>
					 </TABLE>
				   </TD></TR>
				</TBODY>
			  </TABLE>
			  