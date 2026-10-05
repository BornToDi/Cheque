<html>
<head>
<link href="../style/style.css" rel="stylesheet" type="text/css"><link rel="stylesheet" href="../../ui/modern.css"><meta name="viewport" content="width=device-width, initial-scale=1"><script src="../../ui/popup.js" defer></script>

</head>
<body onLoad="javascript:window.print();">
<br>
<TABLE class=border cellSpacing=0 cellPadding=0 width="98%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle>
							<B>Cheque Book Request Form</B></TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
  				 </TABLE><BR>
                  
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="98%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=8 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=left colSpan=4>
								<B>Details Request Information</B>							</TD>
						  </TR>
						  <TR>
                          <TD class=back2 align=right width="35%">Requested By: </TD>
                            <TD class=back colspan="3" align=left>
								<? echo $_REQUEST[req_by]; ?>						
							</TD>
						  </TR>
                          <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Account No</span>:</TD>
                            <TD class=back colSpan=3>
								 <? 
								 
								echo $_REQUEST[ac_no_branch]; ?>                               
								-&nbsp;
								<? echo $_REQUEST[ac_no_suffix];?>                                 
							    -&nbsp; 								
								 <? echo $_REQUEST[ac_no_cus_no]; 
								
								?>								
								</TD>
						  </TR>
						  <TR>
                            <TD class=back2 align=right width="35%">Requester Branch Name:</TD>							
							
                            <TD class=back colspan="3"><? echo $_REQUEST[branch_name];?></TD>
							</TR>
							<TR>
                            <TD class=back2 align=right width="35%">Customer Name:</TD>
                            <TD class=back colSpan=3>
							 <? echo $_REQUEST[customer_name]; ?>							
							</TD>
						    </TR>
							<TR>
                            <TD class=back2 align=right width="35%">Customer Address:</TD>
                            <TD class=back colSpan=3>
							 <? echo $_REQUEST[customer_address]; ?>							
							</TD>
						    </TR>
							<TR>
                            <TD class=back2 align=right width="35%">Requisition Date:</TD>
                            <TD class=back colSpan=3>
							  <? echo $_REQUEST[req_date]; ?>							
							</TD>
						    </TR>
							<TR>
                            <TD class=back2 align=right width="35%">Account Type:</TD>
                            <TD class=back colspan="3">								
							 	<? echo $_REQUEST[ac_type]; ?> - 																					
								<? echo $_REQUEST[total_leaf]." Leaves"; ?>							
							</TD>
						   </TR>
							<TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Collecting Branch</span>:</TD>
                            
							<TD class=back colspan="3">
							  	<? echo $_REQUEST[collecting_brach]; ?>							
							</TD>
						  </TR>						  						 
						  <TR>
                            <TD class=back2 align=right width="35%">Delivery Type:</TD>
                            
							<TD class=back colspan="3">
							  	<? echo $_REQUEST[severity]; ?> - <? if($_REQUEST[severity]="Normal") echo "72 Hrs"; else echo "24 Hrs"; ?> 							
							</TD>
						  </TR>
						  
						  <TR>
                            <TD class=back2 align=right width="35%"><span class="bodytext">Order Date and Time </span>:</TD>
                            <TD class=back colspan="3">
								<? echo $_REQUEST[order_date_time]; ?>
								
							</TD>
						  </TR>
						  
						  <TR>
                            <TD class=back2 vAlign=top align=right width="35%">Remarks: </TD>
                            <TD class=back colSpan=3>
							  <? echo $_REQUEST[remarks]; ?>							 
							</TD>
						  </TR>
						  
						  </TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
                  
				 <CENTER>&nbsp;&nbsp;&nbsp;
                  <input type="button"  value="Close" name="close" onclick='javascript:window.close();'/>
                  
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
							<a href="#" onClick="javascript:window.print();" title="Print Version">
							<img src="../images/printer.gif" border="0" align="absmiddle" /></a>
				  
				  
				  </CENTER>
				  </TD></TR></TBODY></TABLE>

</body>
</html>