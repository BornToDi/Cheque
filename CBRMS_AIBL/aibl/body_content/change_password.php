<?
session_cache_limiter('nocache');
session_start();
include_once ('../tex_common.php');
if (empty($_SESSION['username']))
{	
	redirectUrl('user_signin.php');
}
//include_once ("../config.php");

?>

			
		<script language="javascript" type="text/javascript">

			function validate()
			{
				var msghdr = "Please enter value for the following fields:-\n";
				var msg = "";
				var err = 0;
				var minLength = 6;
				var invalid = " ";	
				var frm  =  document.frmPassword;
			
				if(frm.old_password.value=="")
				{
					msg += "Old password\n";
					alert(msghdr+msg);
					frm.old_password.focus();
					return false; 
				}
				if(frm.new_password.value=="")
				{
					msg += "New password\n";
					alert(msghdr+msg);
					frm.new_password.focus();
					return false;
				}
				

				//if ((frm.pass.value.length < 6) || (frm.pass.value.length > 16)) {
				if (frm.new_password.value.length < 6) {
					msg += "-> Your password must be at least " + minLength + " characters long. Try again.\n";
					alert(msghdr+msg);
					frm.new_password.focus();
					return false;            					
         		}
								// check for spaces
				if (frm.new_password.value.indexOf(invalid) > -1) {
					msg += "-> Sorry, spaces are not allowed. Try again.\n";
					alert(msghdr+msg);
					frm.new_password.focus();								
					return false;
					}
															
								
				if ((!/[0-9]/.test(frm.new_password.value))||(!/[a-zA-Z]/.test(frm.new_password.value))) {             						
						msg += "-> The password must contain at least 1 letter and 1 numeral\n";
						alert(msghdr+msg);
						frm.new_password.focus();								
						return false;
					}

				if(frm.confirm_password.value=="")
				{
					msg += "Confirm password\n";
					alert(msghdr+msg);
					frm.confirm_password.focus();
					return false;
				}
				if(frm.new_password.value != frm.confirm_password.value)
				{
					msg += "New password and Confirm password should be same\n";
					alert(msghdr+msg);
					frm.new_password.focus();
					return false;
				}	
					
			  return true;
			}
								
			</script> 
			<SCRIPT language=javascript1.2 src="js/common.js" type=text/javascript></SCRIPT>
			<!--- Add User Information ------->
			<? if($_REQUEST['option']=='change_password')  { 
			
				$branch_query  ="select  *from aibl_branch";				
				$get_branch_name = mysql_query($branch_query) or
				die(mysql_error());
				
				$user_query  ="select  *from aibl_branch";				
				$get_branch_user_name = mysql_query($user_query) or
				die(mysql_error());
			
					$success = false;
					 if (isset($_POST['submit']))
					 {
						$query="select * from aibl_login where userid = ".$_SESSION["userid"] ." and pass='".md5($_POST["old_password"])."'";
						$result = mysql_query($query);
						$row = @mysql_fetch_assoc($result);		
						//echo $_SESSION["userid"]." ????".$_POST["old_password"];
						if ($row)
						{
							$query ="Update aibl_login set pass = '".md5($_POST["new_password"])."' where userid = ".$_SESSION["userid"];
							$result=mysql_query($query);
							$success =true;
						}
						else
						{
							$errmsg = "You have entered an invalid old pasword";
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
                            <TD class=info align=middle><B>Manage User Information</B></TD>
						  </TR>						  
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
  				</TABLE><BR>
				 <?
  				if($success)
  				{
  				?>
				<TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                    <TBODY>                          						 
						<TR>
                            <TD class=back2 align=middle><B><font size="+1">Your password has been successfully changed.</font></B></TD>
						</TR>						  
					</TBODY>
				</TABLE>
				<?
  				}
 				else
  				{
				?>
			
                  <form name="frmPassword" method='post' action='index.php?option=change_password'>
                  <TABLE class="border" cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">				                       
					<TR>                    
					  <TD>					  
                        <TABLE cellSpacing="1" cellPadding="5" width="100%" border="0">
                          <TBODY>
                          
						 
						 
						  <TR>
                            <TD class=info align=left colSpan=4>
								<B>Change Your Password</B>							
								</TD>
						  </TR>
						   <tr>
          					<td class=back2 align="center"  colspan="4"><span ><font color="red" size="+1"><? echo $errmsg; ?></span></td>
        				 </tr>
						 
						  <TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">Old password</span>:
							</TD>
                            <TD class="back" colspan="3">							
								<input maxlength="25" name="old_password" type="password" size=22>																						
							</TD>
						  </TR>
						  		
						  <TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">New password</span>:
							</TD>
                            <TD class="back" colspan="3">							
								<input maxlength="25" name="new_password" type="password"  size=22>																					
							</TD>
						  </TR>	
						  
						  <TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">Confirm password</span>:
							</TD>
                            <TD class="back" colspan="3">							
								<input maxlength="25" name="confirm_password" type="password" size=22>																			
							</TD>
						  </TR>					
						  						  						  						 
						  
					 </TABLE></TD></TR></TBODY></TABLE><br>
                			<div style="float:right; width:760;">
							<input type="submit" value="Submit" name="submit" onclick='return validate();'/>														
							<input type="reset" />
							</div>    			
						</FORM>	
						<? 
						}
						?>
					 </TD></TR></TBODY></TABLE>																																				  
				<? } ?>
				<!--- End Add User Information ---------------->
                 
