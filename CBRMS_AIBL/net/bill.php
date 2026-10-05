<?php
session_cache_limiter('nocache');
session_start();
include_once ("../tex_common.php");

if (empty($_SESSION['user_name']))
{	
	redirectUrl('net_signin.php?msg=signin');
}

$task=$_REQUEST['task'];
$option=$_REQUEST['option'];

if($_REQUEST['option']=='download_bill')
 { 
 ?>
				  
				  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=5 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Download Bill</B>
							</TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
 				</TABLE><BR>		
				  <FORM name="frmBill" action="#" method="post">
				<TABLE class=border cellSpacing=1 cellPadding=2 width="100%" border=0>
						
                          <TBODY>
						   <TR>
                            <TD class=info align=left colSpan=4>
								<B>Search by date</B>							</TD>
						  </TR>
						  						  						  
						 					  						  
						  <TR>
                          <TD class=back2 align=right><label for="search_searchword">Date: </label></TD>
                            <TD class=back align=left><span class="bodytext">From</span>:
							
              				<?
								if(isset($_POST['search']))								
								$date_from=$_POST[order_date_from];							
								else
								$date_from=date("M d, Y"); 
								 
								?>
              				<input type="text" name="challan_date_from" size="11" value="<? echo $date_from ?>"   id="sel2"/>
              				<a href="javascript:return false;">
							<img src="../aibl/body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button2" style="DDsor: pointer;" alt="Calendar" title="Date selector" /></a>
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
									
										var cal = new Zapatec.Calendar.setup({
											
											inputField     :    "sel2",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											//ifFormat       :    '%a, %b %e, %Y [%I:%M %p]',     // format of the input field
											ifFormat       :    '%b %e, %Y',     // format of the input field									
											showsTime      :     true,     // show time as well as date
											button         :    "button2"  // trigger button 

										});
		
									</script>
							
							<span class="bodytext">&nbsp;&nbsp;To</span>:
              				<?
								
								if(isset($_POST['search']))								
								$date_to=$_POST[order_date_to];							
								else
								$date_to=date("M d, Y"); 
								 
								?>
																	
							
								<input type="text" name="challan_date_to" size="11" value="<? echo $date_to ?>"   id="sel3"/>
              				<a  href="javascript:return false;">
							<img src="../aibl/body_content/calender/themes/icons/b_calendar.png" border="0" align="absmiddle" id="button3" style="DDsor: pointer;" alt="Calendar" title="Date selector" /></a>
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
									
										var cal = new Zapatec.Calendar.setup({
											
											inputField     :    "sel3",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											//ifFormat       :    '%a, %b %e, %Y [%I:%M %p]',     // format of the input field
											ifFormat       :    '%b %e, %Y',     // format of the input field
											//ifFormat       :    '%b %e, %Y %I:%M',     // format of the input field
											
											showsTime      :     true,     // show time as well as date
											button         :    "button3"  // trigger button 

										});
		
									</script>							</TD>							
						  </TR>
						 </TBODY>
						 </TABLE> 
						 <BR />
						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
							<input type="submit" value="Summery for Courier" onclick="document.frmBill.action='../aibl/excel/bill_excel.php'"/>
							&nbsp;&nbsp;<input type="submit" value="Branch wise Bill" onclick="document.frmBill.action='../aibl/excel/bill_branch_excel.php'"/>
							&nbsp;&nbsp;<input type="reset" value="Reset" />
                  </FORM>		
				  															  				 
               <TD></TR></TBODY></TABLE>
<?
}
?>