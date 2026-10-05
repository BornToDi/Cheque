<?
session_cache_limiter('nocache');
session_start();
include_once ('../tex_common.php');
if (empty($_SESSION['username'])||($_SESSION['user_type']!='admin'))
{	
	redirectUrl('user_signin.php');
}


		$query="select *from aibl_branch order by branch_code asc";				
		$get_branch_code = mysql_query($query) or
		die('Server Connection Error!');
							
?>

			
				<script language="javascript" type="text/javascript">
					function validate()
					{
						var msghdr = "Please enter value for the following field:-\n";
						var msg = "";
						var err = 0;
						var minLength = 6;
						var invalid = " ";						
						var frm  =  document.frmUser;
																	
																			
																														
							if(frm.user_id.value=="")
							{
								msg += "-> User Id\n";
								alert(msghdr+msg);
								frm.user_id.focus();
							 	return false;
								
							}		
							
																																																							
							if(frm.pass.value=="")	
							{
								msg += "-> User Password\n";
								alert(msghdr+msg);
								frm.pass.focus();
							 	return false;									
							}	
							//if ((frm.pass.value.length < 6) || (frm.pass.value.length > 16)) {
							if (frm.pass.value.length < 6) {
								msg += "-> Your password must be at least " + minLength + " characters long. Try again.\n";
								alert(msghdr+msg);
								frm.pass.focus();
							 	return false;            					
         						}
								// check for spaces
							if (frm.pass.value.indexOf(invalid) > -1) {
								msg += "-> Sorry, spaces are not allowed. Try again.\n";
								alert(msghdr+msg);
								frm.pass.focus();								
								return false;
								}
															
								/*if (/[\W_]g/.test(frm.pass.value)) {
           							alert("The password contains illegal characters.");

         						}*/

								//var re = /^\w*(?=\w*\d)(?=\w*[a-zA-Z]\w*$)/
            				if ((!/[0-9]/.test(frm.pass.value))||(!/[a-zA-Z]/.test(frm.pass.value))) {             						
									msg += "-> The password must contain at least 1 letter and 1 numeral\n";
									alert(msghdr+msg);
									frm.pass.focus();								
									return false;
            					}
																												
							if(frm.username.value=="")
							{
								msg += "-> User Name\n";
								alert(msghdr+msg);
								frm.username.focus()
							 	return false;								
							}
							
							if(frm.user_type[0].checked==true || frm.user_type[1].checked==true)			
							{																																							
								if(frm.branch_code.value=="")	
								{
									msg += "-> User Branch Code\n";
									alert(msghdr+msg);
									frm.branch_code.focus();	
							 		return false;
									
								}
								
							}																																													
							
					  return true;
					}
					
					
					function check_user_type(val)
					{
						
					
						if(val == "user" || val == "manager")
						{
							document.getElementById('row_url').style.display = '';
							//document.getElementById('row_url').style.display = 'none';
							
						}
						
						if((val == "admin")||(val == "gsd"))
						{
							document.getElementById('row_url').style.display = 'none';
						}
						else
						{
							document.getElementById('row_url').style.display = '';
						}
					}

					
					</script> 
					 <SCRIPT language=javascript1.2 src="js/common.js" type=text/javascript></SCRIPT>
			<!--- Add User Information ------->
			<? if($_REQUEST['task']=='add_user')  { 
			
				$branch_query  ="select  *from aibl_branch";				
				$get_branch_name = mysql_query($branch_query) or
				die(mysql_error());
				
				$user_query  ="select  *from aibl_branch";				
				$get_branch_user_name = mysql_query($user_query) or
				die(mysql_error());
			
			?>
						  				                    				
				<TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				  
				  <?
				  	
					if(isset($_POST['adduser']))
					{
						$user_id = strtoupper($_POST["user_id"]);
						$userpass = md5($_POST['pass']); 
						$check=true;		
						
						$query_branch_name="select branch_name from aibl_branch where branch_code='".$_POST['branch_code']."'";
						$branch_name_result=mysql_query($query_branch_name);
						$get_branch_name = mysql_fetch_array($branch_name_result);
						$branch_name=$get_branch_name['branch_name']; 
										
						$query="select user_id from aibl_login where user_id='$user_id' ";
						$result=mysql_query($query);
						if($row=mysql_fetch_array($result))
							{
							echo" <script>alert('Sorry that User Id ($_POST[user_id]) already exists!')</script> ";
							$check=false;
						}
						if($check==true)
							{
							$id= mysql_insert_id();
							 
							$user_create_date=date("Y-m-d H:i:s a");
							$query ="insert into aibl_login (userid,user_id,pass,branch_code,branch_name,branch_user_name,user_email,active,user_type,user_create_by,user_create_date) 
									values($id,'$user_id','$userpass','$_POST[branch_code]','$branch_name','$_POST[username]','$_POST[email]','$_POST[isactive]','$_POST[user_type]','$_SESSION[user_id]','$user_create_date')";							
							mysql_query($query) or
							die (mysql_error());
							
							redirectUrl("index.php?option=aibl_user&task=modify_user"); 														
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
                  <form name="frmUser" method='post' action='index.php?option=aibl_user&task=add_user'>
                  <TABLE class="border" cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">				                       
					<TR>                    
					  <TD>					  
                        <TABLE cellSpacing="1" cellPadding="5" width="100%" border="0">
                          <TBODY>
                          <TR>
                            <TD class=info align=left colSpan=4>
								<B>Add User Information</B>							
								</TD>
						  </TR>
						  
						  	<TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">User Type</span>:</TD>
                            <TD class=back colspan="3">
							<input type="radio" name="user_type" value="user" checked="checked" onfocus="check_user_type(this.value);" />									
							Maker 
							<input type="radio" name="user_type" value="manager"  onfocus="check_user_type(this.value);" />
							Checker
							<input type="radio" name="user_type" value="admin"  onfocus="check_user_type(this.value);"/>
							Admin
							<input type="radio" name="user_type" value="gsd"  onfocus="check_user_type(this.value);"/>
							GSD
												
							</TD>
						    </TR>	  
						  <TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">User Id</span>:
							</TD>
                            <TD class="back" colspan="3">							
								<input type='text'  name='user_id' size="27" value='<?php echo $_POST['user_id']; ?>' >																						
							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">User Password</span>:
							</TD>
                            <TD class="back" colspan="3">							
								<input type="password"  name='pass' size="27" value='<?php echo $_POST['pass']; ?>' >																						
							</TD>
						  </TR>
						  
						  <!--
						   <TR>						   
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">Confirm Password</span>:
							</TD>
                            <TD class="back" colspan="3">							
								<input type="password"  name='con_pass' size="27" value='' >																						
							</TD>
						  </TR>
						  -->
						  
						   <TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">User Name</span>:
							</TD>
                            <TD class="back" colspan="3">							
								<input type='text'  name='username' size="27" value='<?php echo $_POST['username']; ?>' >																						
							</TD>
						  </TR>

						  <TR id="row_url">
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">User Branch Code</span>:
							</TD>
                            <TD class="back" colspan="3">							
																
								<SELECT name="branch_code">
									<option  value="">Please Select</OPTION> 
								  	<?									
									while ($row =mysql_fetch_array($get_branch_code))
									{																			
									?>
									<option value='<? echo $row['branch_code']; ?>'><? echo $row['branch_code'].'-'.$row['branch_name']; ?></option>																	
									<?
									}
									?>
                            	</SELECT>	
							</TD>
						  </TR>

						  <TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">User E-mail</span>:
							</TD>
                            <TD class="back" colspan="3">							
								<input type="text"  name='email' size="27" value='<?php echo $_POST['email']; ?>' >																						
							</TD>
						  </TR>
						  
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">User Status</span>:</TD>
                            <TD class=back colspan="3">
							
							<input type="radio" name="isactive" value="1" checked="checked">Active  
							<input type="radio" name="isactive" value="0"> Inactive	
														
						 
						 </TD>
						  </TR>
						  
					 </TABLE></TD></TR></TBODY></TABLE><br>
                			<div style="float:right; width:760;">
							<input type="submit" value="Submit" name="adduser" onclick='return validate();'/>														
							<INPUT TYPE="button" onClick="window.location='index.php?option=aibl_user&task=add_user';" VALUE="Refresh">
							</div>    			
						</FORM>	
					 </TD></TR></TBODY></TABLE>																																				  
				<? } ?>
				<!--- End Add User Information ---------------->
                 
                <!--- Update User Information Start Hrere ------->
					
				<? if($_REQUEST['task']=='modify_user')  { ?>
				
					<script language="javascript">
						function OpenLivePic(user_id) {		
						window.open('../aibl/body_content/aibl_user_details.php?user_id=' +user_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
					}
					</script>
				  <FORM name="frmUser" action="index.php?option=aibl_user&task=modify_user" method="post">
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				
				  
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
								<B>Search User Information</B>							</TD>
						  </TR>
						  <TR>
                          <TD class=back2 align=right width="27%">User ID: </TD>
                            <TD class=back colspan="3" align=left>
							<input type="text" value="<? echo $_POST['user_id']; ?>" name="user_id" size="30" /></TD>
						  </TR>
                          <TR>
						  <TD class=back2 align=right width="27%">Branch Code: </TD>
                            <TD class=back colspan="3" align=left>
							
							<SELECT name="branch_code">
									<option  value="">Please Select</OPTION> 
								  	<?									
									while ($row =mysql_fetch_array($get_branch_code))
									{																			
									$sel = "";							
									if ($row['branch_code'] ==  $get_branch_info['branch_code']) $sel = "selected";
									?>
									<option value='<? echo $row['branch_code']; ?>'  <? echo "$sel"; ?>><? echo $row['branch_code']; ?></option>																	
									<?
									}
									?>
                            	</SELECT>	
							</TD>
						  </TR>
                          <TD class=back2 align=right width="27%">Branch Name: </TD>
                            <TD class=back colspan="3" align=left>
							<input type="text" value="<? echo $_POST['branch_name']; ?>" name="branch_name" size="30" /></TD>
						  </TR>
                         
 						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">User Type</span>:</TD>
                            <TD class=back colspan="3">
							<input type="radio" name="user_type" value="user" <? if($_POST[user_type]=='user'){?> checked<? }?>/>									
							User 
							<input type="radio" name="user_type" value="manager" <? if($_POST[user_type]=='manager'){?> checked<? }?>/>									
							Manager 
							<input type="radio" name="user_type" value="admin" <? if($_POST[user_type]=='admin'){?> checked<? }?>  />
							Admin
							<input type="radio" name="user_type" value="gsd" <? if($_POST[user_type]=='gsd'){?> checked<? }?>/>
							GSD					
							</TD>
						    </TR>
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">User Status</span>:</TD>
                            <TD class=back colspan="3">
							
							<input type="radio" name="isactive" value="1" <? if($_POST[isactive]=='1'){?> checked<? }?>>Active  
							<input type="radio" name="isactive" value="0" <? if($_POST[isactive]=='0'){?> checked<? }?>> Inactive	
														
						 
						 </TD>
						  </TR>
						 
					 </TABLE></TD></TR></TBODY></TABLE><BR>
                			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Search User" name="submit"/>				
							<INPUT TYPE="button" onClick="window.location='index.php?option=aibl_user&task=modify_user';" VALUE="Refresh">
					</FORM>				
				  															  
				  
                <!-- Display User Information------------->
				  <form id ="frmChk" name="frmChk" method="post" action="index.php?option=aibl_user&task=modify_user">
				  
				  <?
				  	if($_POST['submit_mult_delete']=='Delete') { 
						$chk=$_POST['chk'];
						$c=count($chk);		
	  
	  					for ($i=0; $i<$c; $i++)
						{	  						
							$query = "delete from aibl_login where userid='$chk[$i]'";
		 					$result=mysql_query($query) or
							die (mysql_error());					
						}
						redirectUrl("index.php?option=aibl_user&task=modify_user"); 					
					} 				
				  	if($_POST['submit_mult_update']=='Inactive') { 
						 
						$user_modified_date=date("Y-m-d H:i:s a");
						$chk=$_POST['chk'];					
						$c=count($chk);						
						$active=1;	
	  					if ($active==1) $get_active=0; else $get_active=1;
	  					for ($i=0; $i<$c; $i++)
						{	  						
							$query ="Update aibl_login set active=$get_active,user_modified_by='$_SESSION[user_id]',user_modified_date='$user_modified_date' where userid='$chk[$i]'";							
							mysql_query($query) or
							die (mysql_error());					
						}						
						//redirectUrl("index.php?option=aibl_user&task=modify_user"); 					
					}
					if($_POST['submit_mult_update']=='Active'){ 
						 
						$user_modified_date=date("Y-m-d H:i:s a");
						$chk=$_POST['chk'];					
						$c=count($chk);						
						$active=0;
	  					if ($active==0) $get_active=1; else $get_active=0;
	  					for ($i=0; $i<$c; $i++)
						{	  						
							$query ="Update aibl_login set active=$get_active,user_modified_by='$_SESSION[user_id]',user_modified_date='$user_modified_date' where userid='$chk[$i]'";							
							mysql_query($query) or
							die (mysql_error());					
						}					
						//redirectUrl("index.php?option=aibl_user&task=modify_user"); 					
					}
					
 				?>
				 
				 <DIV class=syntax_hilite>
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
							<TD  align=center class=hf>
								<B>User Id</B>							
							</TD>
							<TD  align=center class=hf>
								<B>Branch Code</B>							
							</TD>
							<TD  align=center class=hf>
								<B>Branch Name</B>							
							</TD>
							<TD align=center class=hf>
								<B>User Type</B>							
							</TD>
							
							<TD  align=center class=hf>
								<B>User Status</B>							
							</TD>
							<TD align=center class=hf>
								<B>Created Time</B>							
							</TD>
							<TD align=center class=hf>
								<B>Modified Time</B>							
							</TD>
							<TD class=hf align=center colspan="2">
								<B>Action</B>
							</TD>
						  </TR>
						  <?
						  	
						  	$user_id=trim($_POST['user_id']);
							$branch_code=trim($_POST['branch_code']);
							$branch_name=trim($_POST['branch_name']);
							$user_type=trim($_POST['user_type']);
							$isactive=trim($_POST['isactive']);
						
						
					  //if((!empty($user_id)) || (!empty($logon_user_name)))
					  //{	
					  if(isset($_POST['submit']))
					{
					  						
						$searchcriteria = array();
																								
						if(!empty($user_id))
							$searchcriteria[] = "user_id like '%$user_id%'";
							
						if(!empty($branch_code))
							$searchcriteria[] = "branch_code like '%$branch_code%'";
							
						if(!empty($branch_name))
							$searchcriteria[] = "branch_name like '%$branch_name%'";
							
						if(!empty($user_type))
							$searchcriteria[] = "user_type='$user_type'";
						
						if((!empty($isactive))||($isactive=='0'))
							$searchcriteria[] = "active='$isactive'";
						
						$searchtext = array();
		
						if(count($searchcriteria)>0)
						{
							$searchtext[] = ($searchcriteria)?" (".join(" and ",$searchcriteria)." )":"";;
						}
						
						$querystring = "";
						$querystring = ($searchtext)?join(" and ",$searchtext):"";
						if(!empty($querystring))
							$querystring = " where ".$querystring;
					}	
						  	//include_once ('../config.php');
							$query1="select *from aibl_login ".$querystring." ORDER BY  user_create_date desc";								
							$result1 = mysql_query($query1) or
							die(mysql_error());
							
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							$sl=1;
							while ($row =mysql_fetch_assoc($result1))
							{
							
							$create_date=str_replace('-','/',$row['user_create_date']); 
							$modified_date=str_replace('-','/',$row['user_modified_date']);
							/*if(($get_modified_date)=='Jan 01, 1970 12:00'){
							echo "no";
							}
							else
							$modified_date='Not yet modified';
							*/
							?>
								<tr>
								<td class=<? echo $class; ?> align=center>&nbsp;<? echo $sl; ?>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="chk[]" value="<? echo $row['userid']; ?>" style=" border-style:none"></td>
								<td class=<? echo $class; ?> align=center><? echo "<a href=\"javascript:OpenLivePic(".$row['userid'].")\" style='text-decoration:underline'>".$row['user_id'];?> </a></td>
								<td class=<? echo $class; ?> align=center><? echo $row['branch_code']; ?> </td>
								<td class=<? echo $class; ?> align=center><? echo $row['branch_name']; ?> </td>
								<td class=<? echo $class; ?> align=center><? echo $row['user_type']; ?> </td>																
								<td class=<? echo $class; ?> align=center><?  if($row['user_id']!='ADMIN'){ ?><A href="index.php?option=aibl_user&task=update_user&user_id=<? echo $row['userid'];?>&active=<? echo $row['active'];?>"><? if($row['active']==1){ ?><img src='images/publish_g.png' border='0' align='absmiddle' alt="Active"/> <? } else {?> <img src='images/publish_x.png' border='0' align='absmiddle' alt="Inactive"/></A><? }?> <? } else echo 'No Action'; ?> </td>								
								<td class=<? echo $class; ?> align=center><? echo date('M d, Y h:i a', strtotime($create_date)); ?> </td>	
								<td class=<? echo $class; ?> align=center><? 
								if(($row['user_modified_date'])!=0){
								echo date('M d, Y h:i a', strtotime($modified_date)); 
								}
								else 
								echo "Not yet modified";
								?> 
								</td>							
								<td width="15%" align=center class=<? echo $class; ?>><?  if($row['user_id']!='ADMIN'){ ?> <span class=green>[<a class=edit href="index.php?option=aibl_user&task=edit_user&user_type=<? echo $row['user_type'];?>&userid=<? echo $row['userid'];?>">Edit</a>]</span>&nbsp;
								<span class=red>[<a onclick="return confirm('Are you sure?');"  class="edit" href="index.php?option=aibl_user&task=delete_user&user_id=<? echo $row['userid'];?>">Delete</a>]</span><? } else echo 'No Action'; ?></span></td>
								
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
			
				<input type="submit" name="submit_mult_update" value="Active" onclick="return isChk();" class="favorite" />
				<input type="submit" name="submit_mult_update" value="Inactive" onclick="return isChk();" class="favorite" />														
				</form>				  				  
				<!----- End ------------------------------->  
					
				  </TD></TR></TBODY></TABLE>
				 <?				 
 			}
		
		?>	
<!-- Edit User/Admin,Active/Inactive User information ---------------------->
					
				<? if($_REQUEST['task']=='edit_user')  { ?>
			
				  <FORM name="frmUser" action="index.php?option=aibl_user&task=edit_user&userid=<? echo $_REQUEST['userid']; ?>" method="post">
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				  
				  <?
					
					$sql = "select *from aibl_login  where userid= '".$_REQUEST['userid']."' ";
					$sql_result = mysql_query($sql)
					or die("Couldn't execute query.");
					if (!$sql_result) {
					echo "<P>Couldn't get result!";
					} 
					else
					{
					
						$get_update=mysql_fetch_array($sql_result);
						$by_user_id=$get_update['userid'];
						if(isset($_POST['submit']))
						{													
							$pass= md5($_POST['pass']);							
							$query_branch_name="select branch_name from aibl_branch where branch_code='".$_POST['branch_code']."'";
							$branch_name_result=mysql_query($query_branch_name);
							$get_branch_name = mysql_fetch_array($branch_name_result);
							$branch_name=$get_branch_name['branch_name'];
														
							 
							$user_modified_date=date("Y-m-d H:i:s a");
							
							$query ="Update aibl_login set branch_code='$_POST[branch_code]',branch_name='$branch_name',branch_user_name='$_POST[username]',user_email='$_POST[email]',  active='$_POST[isactive]', user_modified_by='$_SESSION[user_id]', user_modified_date='$user_modified_date' where userid='$by_user_id'";							
							mysql_query($query) or
							die (mysql_error());
													
							redirectUrl("index.php?option=aibl_user&task=modify_user"); 														
																																	
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
                          <TD class=back2 align=right width="27%">User Id: </TD>
                            <TD class=back colspan="3" align=left><input type="text" readonly="yes" value="<? echo $get_update['user_id']; ?>" name="user_id" size="27" /></TD>
						  </TR>
						  						  
						   <TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">User Name</span>:							</TD>
                            <TD class="back" colspan="3">							
								<input type='text'  name='username' size="27" value='<?php echo $get_update['branch_user_name']; ?>' >							</TD>
						  </TR>
						  
						
						<? 
							if (($_REQUEST[user_type]=='user')||($_REQUEST[user_type]=='manager')){?>
							<TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">User Branch Code</span>:							</TD>
                            <TD class="back" colspan="3">
							<select name="branch_code">
                              <option  value="">Please Select</option>
                              <?									
									while ($row =mysql_fetch_array($get_branch_code))
									{																			
									$sel = "";							
									if ($row['branch_code'] ==  $get_update['branch_code']) $sel = "selected";
									?>
                              <option value='<? echo $row['branch_code']; ?>'  <? echo "$sel"; ?>><? echo $row['branch_code'].'-'.$row['branch_name']; ?></option>
                              <?
									}
									?>
                            </select></TD>
						  </TR>
						<? }?>

						  <TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">User E-mail</span>:							</TD>
                            <TD class="back" colspan="3">							
								<input type="text"  name='email' size="27" value='<?php echo $get_update['user_email']; ?>' >							</TD>
						  </TR>
						  
                          
						  <TR>
                            <TD class=back2 align=right width="27%"><span class="bodytext">User Status</span>:</TD>
                            <TD class=back colspan="3">
							<input type="radio" name="isactive" value="1" <? if($get_update['active']==1){?> checked<? }?>>Active  
							<input type="radio" name="isactive" value="0" <? if($get_update['active']==0){?> checked<? }?>> Inactive							</TD>
						  </TR>
					 </TABLE></TD></TR></TBODY></TABLE><BR>
                			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Update" name="submit" onclick='return validate();'  />
                  			<input type="Reset" value="Reset">
                 			
							</FORM>				
				   </TD></TR></TBODY></TABLE>
				<?   } 
					}
				?>	
				
<!-- End Edit User/Admin, Active/Inactive User information ---------------------->

<!-- Update Active/Inactive User information ---------------------->
<? if($_REQUEST['task']=='update_user')  
				{ 				
					$user_id=$_REQUEST['user_id'];
					$active=$_REQUEST['active'];
					
					if ($active==1) $get_active=0; else $get_active=1;
					
					$sql = "select *from aibl_login  where userid= '".$user_id."' ";
					$sql_result = mysql_query($sql)
					or die("Couldn't execute query.");
					if (!$sql_result) {
					echo "<P>Couldn't get item!";
					} 
					else
					{
						 
						$user_modified_date=date("Y-m-d H:i:s a");
						$get_update=mysql_fetch_array($sql_result);
						$by_user_id=$get_update['userid'];
						
								$query ="Update aibl_login set active=$get_active,user_modified_by='$_SESSION[user_id]',user_modified_date='$user_modified_date' where userid='".$by_user_id."'";							
								mysql_query($query) or
								die (mysql_error());
							
							redirectUrl("index.php?option=aibl_user&task=modify_user"); 														
							}																											
						}													
				
				?>	
				
				<!--- End Update User Information ----------------> 
				
				  <?
				  	if($_REQUEST['task']=='delete_user') { 

					$query = "delete from aibl_login where userid = {$_REQUEST['user_id']}";				
					mysql_query($query) or
					die (mysql_error());			
					redirectUrl("index.php?option=aibl_user&task=modify_user"); 
				}
				?>  