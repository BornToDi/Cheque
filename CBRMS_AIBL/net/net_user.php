<?
session_cache_limiter('nocache');
session_start();
if (empty($_SESSION['access_id']))
{	
	redirectUrl('net_signin.php?msg=signin');
}
include_once ("../config.php");
include_once ('../tex_common.php');
?>

			
			<!--- Add User Information ------->
			<? if($_REQUEST['option']=='net_user')  { ?>
				<script language="javascript" type="text/javascript">
					function validate()
					{
						var msghdr = "Please enter value for the following fields:-\n";
						var msg = "";
						var err = 0;
						var frm  =  document.frmUser;
					
						if(frm.user_name.value=="")
						{
							msg += "-> User Name\n";
							err++;
						}
						
						if(frm.user_pass.value=="")	
						{
							msg += "-> User Password\n";
							err++;		
						}
											
						if(err>0){
						 alert(msghdr+msg);
						 return false;
						 }
					
					  return true;
					}
					</script> 

			
				  <FORM name="frmUser" action="index.php?option=net_user&task=add_user" method="post">
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				  
				  <?
				  	
					if(isset($_POST['submit']))
					{
						
						$user_name= trim($_POST['user_name']);
						$check=true;						
						$query="select user from net_user where user_name='".$user_name."' ";
						$result=mysql_query($query);
						if($row=mysql_fetch_array($result))
							{
							echo" <tr><td colspan=3 align=center> Sorry that User Id <font color=#FF0000><i> ($user_name) </i></font>  already exists!</td></tr> ";
							$check=false;
						}
						if($check==true)
							{
							$user_id= mysql_insert_id();
							
							$query ="insert into net_user (user_id,user_name,user_pass,active,user_type) values($user_id,'$_POST[user_name]','$_POST[user_pass]', '$_POST[isactive]','vendor')";							
							mysql_query($query) or
							die (mysql_error());
							
							//redirectUrl("index.php?option=aibl_user"); 														
						}																											
					}													
					?>	
					
				  
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Manage User Information</B></TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
  				</TABLE><BR>
                  
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0>				   
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=left colSpan=4>
								<B>Add NetWorld User Information</B>							
							</TD>
						  </TR>
						  <TR>
                          <TD class=back2 align=right width="27%">User Id: </TD>
                            <TD class=back colspan="3" align=left><input type="text" name="user_name" size="30" /></TD>
						  </TR>
                          
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Password </span>:</TD>
                            <TD class=back colSpan=3><input type="password" name="user_pass" size="30"> </TD>
						  </TR>
						 
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Is Active</span>:</TD>
                            <TD class=back colspan="3">
							<input type="radio" name="isactive" value="1" checked="checked">Active  
							<input type="radio" name="isactive" value="0"> Not Active
							</TD>
						  </TR>
						  
						  	  			  
					 </TABLE></TD></TR></TBODY></TABLE><BR>
                			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Submit" name="submit" onclick='return validate();'  />
                  			<input type="Reset" value="Reset">
                 			
							</FORM>				
				  
				<? } ?>
				<!--- End Add User Information ---------------->
                 

                <!--- Update User Information Start Hrere ------->
					
				<? if($_REQUEST['task']=='update_user_1')  { ?>
				<script language="javascript" type="text/javascript">
					function validate()
					{
						var msghdr = "Please enter value for the following fields:-\n";
						var msg = "";
						var err = 0;
						var frm  =  document.frmUser;
					
						if(frm.user_name.value=="")
						{
							msg += "-> User Name\n";
							err++;
						}
						
						if(frm.user_pass.value=="")	
						{
							msg += "-> User Password\n";
							err++;		
						}
						
						if(err>0){
						 alert(msghdr+msg);
						 return false;
						 }
					
					  return true;
					}
					</script> 

				  <FORM name="frmUser" action="index.php?option=net_user&amp;task=update_user&amp;user_id=<? echo $_REQUEST['user_id']; ?>" method="post">
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				  
				  <?
					$user_id=$_REQUEST['user_id'];
					$sql = "select *from net_user where user_id= '".$user_id."' ";
					$sql_result = mysql_query($sql)
					or die("Couldn't execute query.");
					if (!$sql_result) {
					echo "<P>Couldn't get item!";
					} 
					else
					{
					
						$get_update=mysql_fetch_array($sql_result);
						$by_user_id=$get_update['user_id'];
						if(isset($_POST['submit']))
						{
						
							$user_name= trim($_POST['user_name']);
							$check=true;						
							$query="select user_id from net_user where user_id='".$user_id."' ";
							$result=mysql_query($query);
							if(($row=mysql_fetch_array($result))&&($user_name!=$_POST['user_name']))
								{
								echo" <tr><td colspan=3 align=center> Sorry that User Id <font color=#FF0000><i> ($user_name) </i></font>  already exists!</td></tr> ";
								$check=false;
							}
							if($check==true)
							{
								
								$query ="Update net_user set  user_name='$_POST[user_name]',user_pass='$_POST[user_pass]', active='$_POST[isactive]' where user_id='".$by_user_id."'";							
								mysql_query($query) or
								die (mysql_error());
							
							redirectUrl("index.php?option=net_user&task=add_user"); 														
							}																											
						}													
					?>	
					
				  
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Manage User Information</B></TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
  				</TABLE><BR>
                  
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0>				   
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=left colSpan=4>
								<B>Update User Information</B>							</TD>
						  </TR>
						  <TR>
                          <TD class=back2 align=right width="27%">User Name: </TD>
                            <TD class=back colspan="3" align=left><input type="text" value="<? echo $get_update['user_name']; ?>" name="user_name" size="30" /></TD>
						  </TR>
                          
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">Password </span>:</TD>
                            <TD class=back colSpan=3><input type="password" value="<? echo $get_update['user_pass']; ?>" name="user_pass" size="30"> </TD>
						  </TR>
						 <? if($get_update['user_type']!='admin') {?>
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">User Status</span>:</TD>
                            <TD class=back colspan="3">
							<input type="radio" name="isactive" value="1" <? if($get_update['active']==1){?> checked="checked"<? }?>>Active  
							<input type="radio" name="isactive" value="0" <? if($get_update['active']==0){?> checked="checked"<? }?>> Not Active							</TD>
						  </TR>
						  <? } else { ?>
  									<input type="hidden" name="isactive" value="1">
  							<? }?>
					 </TABLE></TD></TR></TBODY></TABLE><BR>
                			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Update" name="submit" onclick='return validate();'  />
                  			<input type="Reset" value="Reset">
                 			
							</FORM>				
				  
				<?   } 
					}
				?>	
				
				<? if($_REQUEST['task']=='update_user')  
				{ 				
					$user_id=$_REQUEST['user_id'];
					$active=$_REQUEST['active'];
					
					if ($active==1) $get_active=0; else $get_active=1;
					
					$sql = "select *from net_user  where user_id= '".$user_id."' ";
					$sql_result = mysql_query($sql)
					or die("Couldn't execute query.");
					if (!$sql_result) {
					echo "<P>Couldn't get item!";
					} 
					else
					{
					
						$get_update=mysql_fetch_array($sql_result);
						$by_user_id=$get_update['user_id'];
						
								$query ="Update net_user set   active=$get_active where user_id='".$by_user_id."'";							
								mysql_query($query) or
								die (mysql_error());
							
							redirectUrl("index.php?option=net_user&task=add_user"); 														
							}																											
						}													
				
				?>	
				
				<!--- End Update User Information ----------------> 
				  
				  
                <!-- Display User Information------------->
				  
				  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0></br>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            
							 
							 <TD width="7%" align=center class=hf>
								<B>#</B>							
							</TD>
							<TD width="24%" align=center class=hf>
								<B>User Id</B>							
							</TD>
							<TD width="24%" align=center class=hf>
								<B>User Type</B>							
							</TD>
							
							<TD width="20%" align=center class=hf>
								<B>User Status</B>							
							</TD>
							<TD class=hf align=center colspan="2">
								<B>Action</B>
							</TD>
						  </TR>
						  <?
						  	//include_once ('../config.php');
							$query1="select *from net_user  ORDER BY  user_name asc  ";		
							$result1 = mysql_query($query1) or
							die(mysql_error());
							
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							$sl=0;
							while ($row =mysql_fetch_assoc($result1))
							{
							
								
							?>
								<tr>
								<td class=<? echo $class; ?> align=center><? echo $sl; ?></td>
								
								<td class=<? echo $class; ?> align=center><? echo $row['user_name']; ?> </td>
								<td class=<? echo $class; ?> align=center><? echo $row['user_type']; ?> </td>							
								<td class=<? echo $class; ?> align=center><A href="index.php?option=net_user&amp;task=update_user&amp;user_id=<? echo $row['user_id'];?>&amp;active=<? echo $row['active'];?>"><? if($row['active']==1){ ?><img src='../aibl/images/publish_g.png' border='0' align='absmiddle'/> <? } else {?> <img src='../aibl/images/publish_x.png' border='0' align='absmiddle' /></A><? }?>  </td>
								<td width="13%" align=center class=<? echo $class; ?>><span class=green>[<a class=edit href="index.php?option=net_user&amp;task=update_user&amp;user_id=<? echo $row['user_id'];?>">Edit</a>]</span></td>
								<td width="15%" align=center class=<? echo $class; ?>><span class=red><?  if($row['user_type']!='admin'){ ?> [<a onclick="return confirm('Are you sure?');"  class="edit" href="index.php?option=net_user&amp;task=delete_user&amp;user_id=<? echo $row['user_id'];?>">Delete</a>]<? } else echo 'No Action'; ?></span></td>
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
					  				  				  
					<!----- End ------------------------------->  
					
				  </TD></TR></TBODY></TABLE>
				 
				 
				 
				 
				  <?
				  	if($_REQUEST['task']=='delete_user') { 

					$query = "delete from net_user where user_id = {$_REQUEST['user_id']}";				
					mysql_query($query) or
					die (mysql_error());			
					redirectUrl("index.php?option=net_user&task=add_user"); 
				}
 				?>

				  