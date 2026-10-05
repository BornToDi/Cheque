<?php
//include_once ("../config.php");
include_once ("../tex_common.php");

if (empty($_SESSION['user_name']))
{	
	redirectUrl('net_signin.php?msg=signin');
}
$task=$_REQUEST['task'];
$option=$_REQUEST['option'];
  																				
	if(isset($_POST['set_sav']))
	{						
		$update_sav_query ="Update serial_no set start_no='$_POST[start_no_sav]', end_no='$_POST[end_no_sav]' where ac_type='10'";  	
		mysql_query($update_sav_query) or die (mysql_error());																		
		//redirectUrl("index.php?option=serial_no"); 																																												
	}	
	
	if(isset($_POST['set_cur']))
	{						
		$update_cur_query ="Update serial_no set start_no='$_POST[start_no_cur]', end_no='$_POST[end_no_cur]' where ac_type='11'";  
		mysql_query($update_cur_query) or die (mysql_error());																				
		//redirectUrl("index.php?option=serial_no"); 																																												
	}
	
	if(isset($_POST['set_cur50']))
	{						
		$update_cur50_query ="Update serial_no set start_no='$_POST[start_no_cur50]', end_no='$_POST[end_no_cur50]' where ac_type='Current50'";  
		mysql_query($update_cur50_query) or die (mysql_error());																				
		//redirectUrl("index.php?option=serial_no"); 																																												
	}
	
	if(isset($_POST['set_card20']))
	{						
		$update_card20_query ="Update serial_no set start_no='$_POST[start_no_card20]', end_no='$_POST[end_no_card20]' where ac_type='Card'";  
		mysql_query($update_card20_query) or die (mysql_error());																				
		//redirectUrl("index.php?option=serial_no"); 																																												
	}
	
	if(isset($_POST['set_po']))
	{						
		$update_po_query ="Update serial_no set start_no='$_POST[start_no_po]', end_no='$_POST[end_no_po]' where ac_type='PO'";  	
		mysql_query($update_po_query) or die (mysql_error());																		
		//redirectUrl("index.php?option=serial_no"); 																																												
	}	
	
	if(isset($_POST['set_dd']))
	{						
		$update_dd_query ="Update serial_no set start_no='$_POST[start_no_dd]', end_no='$_POST[end_no_dd]' where ac_type='DD'";  
		mysql_query($update_dd_query) or die (mysql_error());																				
		//redirectUrl("index.php?option=serial_no"); 																																												
	}
	
	if(isset($_POST['set_fdd']))
	{						
		$update_fdd_query ="Update serial_no set start_no='$_POST[start_no_fdd]', end_no='$_POST[end_no_fdd]' where ac_type='FDD'";  	
		mysql_query($update_fdd_query) or die (mysql_error());																		
		//redirectUrl("index.php?option=serial_no"); 																																												
	}	
	
	if(isset($_POST['set_fdr']))
	{						
		$update_fdr_query ="Update serial_no set start_no='$_POST[start_no_fdr]', end_no='$_POST[end_no_fdr]' where ac_type='FDR'";  
		mysql_query($update_fdr_query) or die (mysql_error());																				
		//redirectUrl("index.php?option=serial_no"); 																																												
	}
		
	if(isset($_POST['set_sdr']))
	{						
		$update_sdr_query ="Update serial_no set start_no='$_POST[start_no_sdr]', end_no='$_POST[end_no_sdr]' where ac_type='SDR'";  
		mysql_query($update_sdr_query) or die (mysql_error());																				
		//redirectUrl("index.php?option=serial_no"); 																																												
	}												
	?>	
					<TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Manage Serial Number</B>							</TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
 				</TABLE><BR>				  																					  		
                                                      							
				  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=8 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=hf align=center colSpan=4>
								<B>Set Cheque Serial No. </B>							
							</TD>
						  </TR>							 											  						 						  						  						 
						   						   
						<? 
				    //*********************       SAVINGS          *******************************************************************
						$get_savings_sl_no = mysql_fetch_array(mysql_query("select *from serial_no where ac_type='10'"));
						?>																														
						 <TR>
						 <FORM name="frmSav_SlNo" action="index.php?option=serial_no" method="post">
							<TD class=back2 align=right width="35%"><span style="font-weight:bold">SB 20 Cheque Serial</span>:</TD>							
							<TD class=back colspan="3">							
								Start No. <input type="text" name="start_no_sav" maxlength="7" size="7" value="<? echo substr($get_savings_sl_no['start_no']+10000000,1) ?>" readonly="yes"/>	
								&nbsp;End No. <input type="text" name="end_no_sav" maxlength="7" size="7" value="<? echo substr($get_savings_sl_no['end_no']+10000000,1) ?>" />																				 														
								<input type="submit" value="Set" name="set_sav"/>
							</TD>
							</FORM>							 
						 </TR>
						<?									
				//***********************************    CURRENT 25        ******************************************************************************					
						$get_current_sl_no = mysql_fetch_array(mysql_query("select *from serial_no where ac_type='11'"));
						?>																
						 <TR>
							<FORM name="frmCur_SlNo" action="index.php?option=serial_no" method="post">
							<TD class=back2 align=right width="35%"><span style="font-weight:bold">CD 25 Cheque Serial</span>:</TD>							
							<TD class=back colspan="3">								
								Start No. <input type="text" name="start_no_cur" maxlength="7" size="7" value="<? echo substr($get_current_sl_no['start_no']+10000000,1) ?>" readonly="yes" />	
								&nbsp;End No. <input type="text" name="end_no_cur" maxlength="7" size="7" value="<? echo substr($get_current_sl_no['end_no']+10000000,1) ?>" />																				 																			 														
								<input type="submit" value="Set" name="set_cur"/>
							</TD>	
							</FORM>						 
						 </TR>
						<?	
					//***********************************    CURRENT 50        ******************************************************************************					
						$get_current50_sl_no = mysql_fetch_array(mysql_query("select *from serial_no where ac_type='Current50'"));
						?>																
						 <TR>
							<FORM name="frmCur50_SlNo" action="index.php?option=serial_no" method="post">
							<TD class=back2 align=right width="35%"><span style="font-weight:bold">CD 50 Cheque Serial</span>:</TD>							
							<TD class=back colspan="3">								
								Start No. <input type="text" name="start_no_cur50" maxlength="7" size="7" value="<? echo substr($get_current50_sl_no['start_no']+10000000,1) ?>" readonly="yes" />	
								&nbsp;End No. <input type="text" name="end_no_cur50" maxlength="7" size="7" value="<? echo substr($get_current50_sl_no['end_no']+10000000,1) ?>" />																				 																			 														
								<input type="submit" value="Set" name="set_cur50"/>
							</TD>	
							</FORM>						 
						 </TR>
						<TR>
                            <TD class=hf align=center colSpan=4>
								<B>Set Card Serial No. </B>							
							</TD>
						  </TR>		
						<?		
						
						//***********************************    CARD 20        ******************************************************************************					
						$get_card20_sl_no = mysql_fetch_array(mysql_query("select *from serial_no where ac_type='Card'"));
						?>																
						 <TR>
							<FORM name="frmCard20_SlNo" action="index.php?option=serial_no" method="post">
							<TD class=back2 align=right width="35%"><span style="font-weight:bold">Card 20 Cheque Serial</span>:</TD>							
							<TD class=back colspan="3">								
								Start No. <input type="text" name="start_no_card20" maxlength="7" size="7" value="<? echo substr($get_card20_sl_no['start_no']+10000000,1) ?>" readonly="yes" />	
								&nbsp;End No. <input type="text" name="end_no_card20" maxlength="7" size="7" value="<? echo substr($get_card20_sl_no['end_no']+10000000,1) ?>" />																				 																			 														
								<input type="submit" value="Set" name="set_card20"/>
							</TD>	
							</FORM>						 
						 </TR>
						<TR>
                            <TD class=hf align=center colSpan=4>
								<B>Set Others Serial No. </B>							
							</TD>
						  </TR>		
						<?																																				  						  						  						  						  
																																		  
																																		  
				    //----------------------------   PO         -----------------------------------------------------------
						$get_po_sl_no = mysql_fetch_array(mysql_query("select *from serial_no where ac_type='PO'"));
						?>																
						 <TR>
							<FORM name="frmPO_SlNo" action="index.php?option=serial_no" method="post">
							<TD class=back2 align=right width="35%"><span style="font-weight:bold">PO Serial</span>:</TD>							
							<TD class=back colspan="3">								
								Start No. <input type="text" name="start_no_po" maxlength="7" size="7" value="<? echo substr($get_po_sl_no['start_no']+10000000,1) ?>" readonly="yes" />	
								&nbsp;End No. <input type="text" name="end_no_po" maxlength="7" size="7" value="<? echo substr($get_po_sl_no['end_no']+10000000,1) ?>" />																				 																			 														
								<input type="submit" value="Set" name="set_po"/>
							</TD>	
							</FORM>						 
						 </TR>
						<?	
						//---------------------------------   DD    ------------------------------------------------------																						
						$get_dd_sl_no = mysql_fetch_array(mysql_query("select *from serial_no where ac_type='DD'"));
						?>																
						 <TR>
							<FORM name="frmDD_SlNo" action="index.php?option=serial_no" method="post">
							<TD class=back2 align=right width="35%"><span style="font-weight:bold">DD Serial</span>:</TD>							
							<TD class=back colspan="3">								
								Start No. <input type="text" name="start_no_dd" maxlength="7" size="7" value="<? echo substr($get_dd_sl_no['start_no']+10000000,1) ?>" readonly="yes" />	
								&nbsp;End No. <input type="text" name="end_no_dd" maxlength="7" size="7" value="<? echo substr($get_dd_sl_no['end_no']+10000000,1) ?>" />																				 																			 														
								<input type="submit" value="Set" name="set_dd"/>
							</TD>	
							</FORM>						 
						 </TR>
						<?																													  
						  //---------------------------------  FDD  ------------------------------------------------------
						  $get_fdd_sl_no = mysql_fetch_array(mysql_query("select *from serial_no where ac_type='FDD'"));
						?>																
						 <TR>
							<FORM name="frmFDD_SlNo" action="index.php?option=serial_no" method="post">
							<TD class=back2 align=right width="35%"><span style="font-weight:bold">FDD Serial</span>:</TD>							
							<TD class=back colspan="3">								
								Start No. <input type="text" name="start_no_fdd" maxlength="7" size="7" value="<? echo substr($get_fdd_sl_no['start_no']+10000000,1) ?>" readonly="yes" />	
								&nbsp;End No. <input type="text" name="end_no_fdd" maxlength="7" size="7" value="<? echo substr($get_fdd_sl_no['end_no']+10000000,1) ?>" />																				 																			 														
								<input type="submit" value="Set" name="set_fdd"/>
							</TD>	
							</FORM>						 
						 </TR>
						<?	
						//---------------------------------  FDR  ------------------------------------------------------
						  $get_fdr_sl_no = mysql_fetch_array(mysql_query("select *from serial_no where ac_type='FDR'"));
						?>																
						 <TR>
							<FORM name="frmFDR_SlNo" action="index.php?option=serial_no" method="post">
							<TD class=back2 align=right width="35%"><span style="font-weight:bold">FDR Serial</span>:</TD>							
							<TD class=back colspan="3">								
								Start No. <input type="text" name="start_no_fdr" maxlength="7" size="7" value="<? echo substr($get_fdr_sl_no['start_no']+10000000,1) ?>" readonly="yes" />	
								&nbsp;End No. <input type="text" name="end_no_fdr" maxlength="7" size="7" value="<? echo substr($get_fdr_sl_no['end_no']+10000000,1) ?>" />																				 																			 														
								<input type="submit" value="Set" name="set_fdr"/>
							</TD>	
							</FORM>						 
						 </TR>
						<?	
						//---------------------------------  SDR  ------------------------------------------------------
						  $get_sdr_sl_no = mysql_fetch_array(mysql_query("select *from serial_no where ac_type='SDR'"));
						?>																
						 <TR>
							<FORM name="frmSDR_SlNo" action="index.php?option=serial_no" method="post">
							<TD class=back2 align=right width="35%"><span style="font-weight:bold">SDR Serial</span>:</TD>							
							<TD class=back colspan="3">								
								Start No. <input type="text" name="start_no_sdr" maxlength="7" size="7" value="<? echo substr($get_sdr_sl_no['start_no']+10000000,1) ?>" readonly="yes" />	
								&nbsp;End No. <input type="text" name="end_no_sdr" maxlength="7" size="7" value="<? echo substr($get_sdr_sl_no['end_no']+10000000,1) ?>" />																				 																			 														
								<input type="submit" value="Set" name="set_sdr"/>
							</TD>	
							</FORM>						 
						 </TR>
						<?																																																			  
						  //---------------------------------------------------------------------------------------						  
						  //---------------------------------------------------------------------------------------
					
						?>
						  			  
					  </TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
                  
                  </TD></TR></TBODY></TABLE>
				  

					
