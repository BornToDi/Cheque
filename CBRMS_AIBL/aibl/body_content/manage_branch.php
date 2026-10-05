<?
session_cache_limiter('nocache');
session_start();
include_once ('../tex_common.php');
if (empty($_SESSION['username'])||($_SESSION['user_type']!='admin'))
{	
	redirectUrl('user_signin.php');
}
//include_once ("../config.php");
?>

			
			<!--- Add branch Information ------->
			<? if($_REQUEST['task']=='add_branch')  { 
			
				$branch_query  ="select  *from aibl_branch";				
				$get_branch_name = mysql_query($branch_query) or
				die(mysql_error());
				
				$branch_query  ="select  *from aibl_branch";				
				$get_branch_branch_name = mysql_query($branch_query) or
				die(mysql_error());
			
			?>
				<script language="javascript" type="text/javascript">
					function validate()
					{
						var msghdr = "Please enter value for the following fields:-\n";
						var msg = "";
						var err = 0;
						var frm  =  document.frmBranch;
																	
						if(frm.branch_code.value=="")
						{
							msg += "-> Branch Code\n";
							err++;
						}
						
																													
						if(frm.branch_name.value=="")	
						{
							msg += "->Branch Name\n";
							err++;		
						}
						
					
						if(err>0){
						 alert(msghdr+msg);
						 return false;
						 }
					
					  return true;
					}
					</script> 
			  				                    				
				<TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				  
				  <?
				  	
					if(isset($_POST['addbranch']))
					{
						
						$check=true;						
						$query="select branch_code from aibl_branch where branch_code='".$_POST[branch_code]."' ";
						$result=mysql_query($query);
						if($row=mysql_fetch_array($result))
							{
							echo" <script>alert('Sorry that Branch Code ($_POST[branch_code]) already exists!')</script> ";
							$check=false;
						}
						if($check==true)
							{
							$id= mysql_insert_id();
							 
							$branch_create_date=date("Y-m-d H:i:s a");
							$query ="insert into aibl_branch (branch_id,branch_code,routing_no,branch_name,branch_address,branch_email) 
									values($id,'$_POST[branch_code]','$_POST[routing_no]','$_POST[branch_name]','$_POST[branch_address]','$_POST[branch_email]')";							
							mysql_query($query) or
							die (mysql_error());
							
							redirectUrl("index.php?option=manage_branch&task=modify_branch"); 														
						}																											
					}													
					?>	
					
				  <SCRIPT language=javascript1.2 src="js/common.js" type=text/javascript></SCRIPT>
                   
				    <TBODY>
                    <TR>
                      <TD>
					  
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Manage Branch Information</B></TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
  				</TABLE><BR>
                  <form name="frmBranch" method='post' action='index.php?option=manage_branch&task=add_branch'>
                  <TABLE class="border" cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">				                       
					<TR>                    
					  <TD>
					  
                        <TABLE cellSpacing="1" cellPadding="5" width="100%" border="0">
                          <TBODY>
                          <TR>
                            <TD class=info align=left colSpan=4>
								<B>Add Branch Information</B>							
								</TD>
						  </TR>
						  
						  		  
						  <TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">Branch Code</span>:
							</TD>
                            <TD class=back colspan="3">
								<input type="text" name="branch_code" size="3" />
							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">Routing No</span>:
							</TD>
                            <TD class=back colspan="3">
								<input type="text" name="routing_no" size="10" />
							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">Branch Name</span>:
							</TD>
                            <TD class=back colspan="3">
								<input type="text" name="branch_name" size="33" />
							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 valign="top" align=right width="27%">
								<span class="bodytext">Branch Address</span>:
							</TD>
                            <TD class=back colspan="3">
								<TEXTAREA name="branh_address" rows="2" cols="30"></TEXTAREA>
							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">Branch E-mail</span>:
							</TD>
                            <TD class=back colspan="3">
								<input type="text" name="branch_email" size="33" />
							</TD>
						  </TR>
						  
						  
					 </TABLE></TD></TR></TBODY></TABLE><br>
                			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Submit" name="addbranch" onclick='return validate();'/>														
							<INPUT TYPE="button" onClick="window.location='index.php?option=manage_branch&task=add_branch';" VALUE="Refresh">    			
						
					 </TD></TR></TBODY></TABLE>	</FORM>																																				  
				<? } ?>
				<!--- End Add branch Information ---------------->
                 
                <!--- Update branch Information Start Hrere ------->
					
				<? if($_REQUEST['task']=='modify_branch')  { ?>
				<script language="javascript" type="text/javascript">
					function validate()
					{
						var msghdr = "Please enter value for the following fields:-\n";
						var msg = "";
						var err = 0;
						var frm  =  document.frmbranch;
					
						if(frm.branch_name.value=="")
						{
							msg += "-> branch Name\n";
							err++;
						}
						
						if(frm.branch_pass.value=="")	
						{
							msg += "-> branch Password\n";
							err++;		
						}
						
						if(err>0){
						 alert(msghdr+msg);
						 return false;
						 }
					
					  return true;
					}
					</script> 
					<script language="javascript">
						function OpenLivePic(branch_id) {		
						window.open('../aibl/body_content/manage_branch_details.php?branch_id=' +branch_id,'popupwinlive','scrollbars=0,menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrolling=no,width=700,height=565');
					}
					</script>
				  <FORM name="frmbranch" action="index.php?option=manage_branch&task=modify_branch" method="post">
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				
				  
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Manage Branch Information</B></TD>
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
								<B>Search Branch Information</B>							</TD>
						  </TR>
						  <TR>
                          <TD class=back2 align=right width="27%">Branch Code: </TD>
                            <TD class=back colspan="3" align=left>
							<input type="text" value="<? echo $_POST['branch_code']; ?>" name="branch_code" size="30" /></TD>
						  </TR>
                          <TR>
                          <TD class=back2 align=right width="27%">Branch Name: </TD>
                            <TD class=back colspan="3" align=left>
							<input type="text" value="<? echo $_POST['branch_name']; ?>" name="branch_name" size="30" /></TD>
						  </TR>
                         
 						 
					 </TABLE></TD></TR></TBODY></TABLE><BR>
                			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Search branch" name="submit" onclick='return validate();' />				
							<INPUT TYPE="button" onClick="window.location='index.php?option=manage_branch&task=modify_branch';" VALUE="Refresh">
					</FORM>				
				  															  
				  
                <!-- Display branch Information------------->
				  <form id ="frmChk" name="frmChk" method="post" action="index.php?option=manage_branch&task=modify_branch">
				  
				  <?
				  	if($_POST['submit_mult_delete']=='Delete') { 
						$chk=$_POST['chk'];
						$c=count($chk);		
	  
	  					for ($i=0; $i<$c; $i++)
						{	  						
							$query = "delete from aibl_branch where branch_id='$chk[$i]'";
		 					$result=mysql_query($query) or
							die (mysql_error());					
						}
						redirectUrl("index.php?option=manage_branch&task=modify_branch"); 					
					} 				
				  	if($_POST['submit_mult_update']=='Inactive') { 
						 
						$branch_modified_date=date("Y-m-d H:i:s a");
						$chk=$_POST['chk'];					
						$c=count($chk);						
						$active=1;	
	  					if ($active==1) $get_active=0; else $get_active=1;
	  					for ($i=0; $i<$c; $i++)
						{	  						
							$query ="Update aibl_branch set active=$get_active,branch_modified_by='$_SESSION[branch_id]',branch_modified_date='$branch_modified_date' where branch_id='$chk[$i]'";							
							mysql_query($query) or
							die (mysql_error());					
						}						
						//redirectUrl("index.php?option=manage_branch&task=modify_branch"); 					
					}
					if($_POST['submit_mult_update']=='Active'){ 
						 
						$branch_modified_date=date("Y-m-d H:i:s a");
						$chk=$_POST['chk'];					
						$c=count($chk);						
						$active=0;
	  					if ($active==0) $get_active=1; else $get_active=0;
	  					for ($i=0; $i<$c; $i++)
						{	  						
							$query ="Update aibl_branch set active=$get_active,branch_modified_by='$_SESSION[branch_id]',branch_modified_date='$branch_modified_date' where branch_id='$chk[$i]'";							
							mysql_query($query) or
							die (mysql_error());					
						}					
						//redirectUrl("index.php?option=manage_branch&task=modify_branch"); 					
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
								<B>Branch Code</B>							
							</TD>
							<TD  align=center class=hf>
								<B>Routing No</B>							
							</TD>
							<TD  align=center class=hf>
								<B>Branch Name</B>							
							</TD>
							<TD  align=center class=hf>
								<B>Branch Address</B>							
							</TD>
							<TD  align=center class=hf>
								<B>Branch E-mail</B>							
							</TD>
							
							<TD class=hf align=center colspan="2">
								<B>Action</B>
							</TD>
						  </TR>
						  <?
						  	
						  	$branch_code=trim($_POST['branch_code']);
							$branch_name=trim($_POST['branch_name']);							
							$isactive=trim($_POST['isactive']);
						
						
					  
					  if(isset($_POST['submit']))
					{
					  						
						$searchcriteria = array();
																								
						if(!empty($branch_code))
							$searchcriteria[] = "branch_code like '%$branch_code%'";
							
						if(!empty($branch_name))
							$searchcriteria[] = "branch_name like '%$branch_name%'";
																			
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
							$query1="select *from aibl_branch ".$querystring." ORDER BY  branch_code desc";								
							$result1 = mysql_query($query1) or
							die(mysql_error());
							
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							$sl=1;
							while ($row =mysql_fetch_assoc($result1))
							{
														
							?>
								<tr>
								<td class=<? echo $class; ?> align=center>&nbsp;<? echo $sl; ?>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="chk[]" value="<? echo $row['branch_id']; ?>" style=" border-style:none"></td>
								<td class=<? echo $class; ?> align=center><? echo $row['branch_code'];?></td>
								<td class=<? echo $class; ?> align=center><? echo $row['routing_no']; ?> </td>
								<td class=<? echo $class; ?> align=center><? echo $row['branch_name']; ?> </td>
								<td class=<? echo $class; ?> align=center><? echo $row['branch_address']; ?> </td>
								<td class=<? echo $class; ?> align=center><? echo $row['branch_email']; ?> </td>							
								<td width="15%" align=center class=<? echo $class; ?>><span class=green>[<a class=edit href="index.php?option=manage_branch&task=edit_branch&branch_id=<? echo $row['branch_id'];?>">Edit</a>]</span>&nbsp;<span class=red>[<a onclick="return confirm('Are you sure?');"  class="edit" href="index.php?option=manage_branch&task=delete_branch&branch_id=<? echo $row['branch_id'];?>">Delete</a>]</span></td>
								
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
				<input type="submit" name="submit_mult_delete" value="Delete" onclick="return isChk();" class="favorite" />												
				</form>				  				  
				<!----- End ------------------------------->  
					
				  </TD></TR></TBODY></TABLE>
				 <?				 
 			}
		
		?>	
<!-- Edit branch/Admin,Active/Inactive branch information ---------------------->
					
				<? if($_REQUEST['task']=='edit_branch')  { ?>
			
				  <FORM name="frmbranch" action="index.php?option=manage_branch&task=edit_branch&branch_id=<? echo $_REQUEST['branch_id']; ?>" method="post">
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
				  
				  <?
					$branch_id=$_REQUEST['branch_id'];
					$sql = "select *from aibl_branch  where branch_id= '".$branch_id."' ";
					$sql_result = mysql_query($sql)
					or die("Couldn't execute query.");
					if (!$sql_result) {
					echo "<P>Couldn't get item!";
					} 
					else{
						$get_update=mysql_fetch_array($sql_result);
						$by_branch_id=$get_update['branch_id'];
						if(isset($_POST['submit']))
						{													
							$query ="Update aibl_branch set routing_no='$_POST[routing_no]',branch_name='$_POST[branch_name]',branch_address='$_POST[branch_address]',branch_email='$_POST[branch_email]' where branch_id='".$by_branch_id."'";							
							mysql_query($query) or
							die (mysql_error());							
							redirectUrl("index.php?option=manage_branch&task=modify_branch"); 																																																
						}	
					}												
					?>	
					
				  
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Manage branch Information</B></TD>
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
								<B>Update branch Information</B>							</TD>
						  </TR>
						  <TR>
                          <TD class=back2 align=right width="27%">Branch Code: </TD>
                            <TD class=back colspan="3" align=left>
							<input type="text" readonly="yes" value="<? echo $get_update['branch_code']; ?>" name="branch_code" size="3" /></TD>
						  </TR>
						  <TR>
                          <TD class=back2 align=right width="27%">Routing No: </TD>
                            <TD class=back colspan="3" align=left>
							<input type="text"  value="<? echo $get_update['routing_no']; ?>" name="routing_no" size="10" /></TD>
						  </TR>
                           <TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">Branch Name</span>:
							</TD>
                            <TD class=back colspan="3">
								<input type="text" name="branch_name" value="<? echo $get_update['branch_name']; ?>" size="33" />
							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 valign="top" align=right width="27%">
								<span class="bodytext">Branch Address</span>:
							</TD>
                            <TD class=back colspan="3">
								<TEXTAREA name="branch_address" rows="2" cols="30"><? echo $get_update['branch_address']; ?></TEXTAREA>
							</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="27%">
								<span class="bodytext">Branch E-mail</span>:
							</TD>
                            <TD class=back colspan="3">
								<input type="text" name="branch_email" value="<? echo $get_update['branch_email']; ?>" size="33" />
							</TD>
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
				<?   
					}
				?>	
				
<!-- End Edit branch/Admin, Active/Inactive branch information ---------------------->

<!-- Update Active/Inactive branch information ---------------------->
<? if($_REQUEST['task']=='update_branch')  
				{ 				
					$branch_id=$_REQUEST['branch_id'];
					$active=$_REQUEST['active'];
					
					if ($active==1) $get_active=0; else $get_active=1;
					
					$sql = "select *from aibl_branch  where branch_id= '".$branch_id."' ";
					$sql_result = mysql_query($sql)
					or die("Couldn't execute query.");
					if (!$sql_result) {
					echo "<P>Couldn't get item!";
					} 
					else
					{
						 
						$branch_modified_date=date("Y-m-d H:i:s a");
						$get_update=mysql_fetch_array($sql_result);
						$by_branch_id=$get_update['branch_id'];
						
								$query ="Update aibl_branch set active=$get_active,branch_modified_by='$_SESSION[branch_id]',branch_modified_date='$branch_modified_date' where branch_id='".$by_branch_id."'";							
								mysql_query($query) or
								die (mysql_error());
							
							redirectUrl("index.php?option=manage_branch&task=modify_branch"); 														
							}																											
						}													
				
				?>	
				
				<!--- End Update branch Information ----------------> 
				
				  <?
				  	if($_REQUEST['task']=='delete_branch') { 

					$query = "delete from aibl_branch where branch_id = {$_REQUEST['branch_id']}";				
					mysql_query($query) or
					die (mysql_error());			
					redirectUrl("index.php?option=manage_branch&task=modify_branch"); 
				}
				?>  