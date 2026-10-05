<?php
include_once ("../../config.php");
include_once ("../../tex_common.php");
//$task=$_REQUEST['task'];
//$option=$_REQUEST['option'];

					$user_id=$_REQUEST['user_id'];
					$sql = "select *from aibl_login  where userid= '".$user_id."' ";
    				$sql_result = mysql_query($sql)
					or die("Couldn't execute query.");
					if (!$sql_result) {
					echo "<P>Couldn't get item!";
					} 
					else {
						$get_user = mysql_fetch_array($sql_result);					
					?>	
					<link href="<?php echo isset($uiPortal) ? 'style/style.css' : '../style/style.css'; ?>" rel="stylesheet" type="text/css"><link rel="stylesheet" href="../../ui/modern.css"><meta name="viewport" content="width=device-width, initial-scale=1"><script src="../../ui/popup.js" defer></script>
					<script language="javascript">
					function CallPrint()
					{
						self.focus()
						self.print()
					}
					</script>
				   <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle>
							<B>aibl User</B>
						

							</TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
  				 </TABLE><BR>
                  
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=8 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=left colSpan=4>
								<B>aibl User Information</B>							</TD>
						  </TR>
						  <TR>
                          <TD class=back2 align=right width="35%">User Id: </TD>
                            <TD class=back colspan="3" align=left>
							<? echo $get_user['user_id'];?></TD>
						  </TR>
                          <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">User Name </span>:</TD>
                            <TD class=back colSpan=3><? echo $get_user['branch_user_name']; ?></TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Branch Name</span>:</TD>
                            <TD class=back colSpan=3>                        							
								<? echo $get_user['branch_name']; ?>						                           					
							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">User Type </span>:</TD>
                            <TD class=back colSpan=3>
							
							<? 
							if($get_user['user_type']=='user') $user_type='Maker';
							else if ($get_user['user_type']=='manager') $user_type='Checker';
							else if ($get_user['user_type']=='admin') $user_type='Admin';
							else if ($get_user['user_type']=='gsd') $user_type='GSD';
							
							echo $user_type; 							
							?>
							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">User Created By</span>:</TD>
                            
							<TD class=back colspan="3">
							  <? echo $get_user['user_create_by']; ?> 
							 </TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">User Modified By</span>:</TD>
                            
							<TD class=back colspan="3">
							  <? echo $get_user['user_modified_by']; ?> 
							</TD>
						  </TR>	
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">User Create Date</span>:</TD>
                            <TD class=back colSpan=3>
								
								<? 
									$date=str_replace('-','/',$get_user['user_create_date']); 
									echo date('M d, Y', strtotime($date));
								?>
																																							
							</TD>
						  </TR>						  						  						  
						  	
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">User Modified Date </span>:</TD>
                            <TD class=back colspan="3">
							  <? //echo $get_user['order_date_time']; ?>
							  <? 
									//$date=str_replace('-','/',$get_user['user_modified_date']); 
									//echo date('M d, Y h:i', strtotime($date));
									
								if(($get_user['user_modified_date'])!=0){
								$date=str_replace('-','/',$get_user['user_modified_date']); 
								echo date('M d, Y', strtotime($date));
								}
								else 
								echo "Not yet modified";
								?>
							</TD>
						  </TR>						  						 			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
                  
                 <!-- <CENTER>&nbsp;&nbsp;&nbsp;
                  <input type="submit" value="Update Task" name="submit" onclick='return validate();'  />
                  <INPUT type="Reset" value="Reset">
				</FORM>
				  </CENTER>-->
				<CENTER>&nbsp;&nbsp;&nbsp;
                  <input type="button"  value="Close" name="close" onclick='javascript:window.close();'/>
                  
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
							<a href="#" onClick="javascript:window.print();" title="Print Version">
							<img src="../images/printer.gif" border="0" align="absmiddle" /></a>
				  
				  
				  </CENTER>
				  </TD></TR></TBODY></TABLE>

<?		
  }	
?>



