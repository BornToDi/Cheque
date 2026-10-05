<?
include_once ("../../config.php");
//include_once ("../../tex_common.php");
$id=$_REQUEST['id'];	
$len=count($id);
?>
<html>
<head>
<link href="../style/style.css" rel="stylesheet" type="text/css"><link rel="stylesheet" href="../../ui/modern.css"><meta name="viewport" content="width=device-width, initial-scale=1"><script src="../../ui/popup.js" defer></script>
<link href="../style/print.css" rel="stylesheet" type="text/css" media="print">

</head>
<body onLoad="javascript:window.print();">


<TABLE class=border cellSpacing=0 cellPadding=0 width="98%" align=center border=0>
                     <TR>
                            <TD height="21" class=back>							
								Branch Name :<? echo $_SESSION['branch_name']."<br>"."User Name :".$_SESSION['branch_user_name'].""; ?>
							</TD>
							<TD height="21" align="center" class=back>
							<b>United Commercial Bank Ltd.</b><br>Cheque Book Requesition Managment System
							</TD>
							<TD height="21" align=right class=back>
							Date :<? echo date("M d, Y")."<br>Total Request:".$len; ?>
							</TD>
						 </TR>
					<TBODY>
                    <TR>
                      <TD colspan="2">
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
  				 </TABLE>
                  
                  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" 
                  align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=1 style="border-collapse: collapse">
                          <TBODY>
                          <TR>
                            <TD class=info align=left colSpan=12>
								<B>Details Request Information</B>							
							</TD>
						  </TR>
						  
						<? 
																						
								
							echo"
							<TR valign='top' style='font-size : 7.5pt;'>
                           <TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Approved Date</B>
							</TD>							
                            <TD class=hf align=left style='font-size : 7.5pt;'>
								<B>Account No</B>
							</TD>
							<TD class=hf align=left style='font-size : 7.5pt;'>
								<B>Customer Name</B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>A/C Type </B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Books </B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Start / End No</B>
							</TD>
							
							 <TD class=hf align=left style='font-size : 7.5pt;'>
								<B>Branch </B>								
							</TD>							 								 
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Del. Type </B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Status</B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Maker ID </B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Checker ID </B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;' width='80'>
								<B>Cus. Signature</B>
							</TD>
							
						  </TR>
						  ";
		
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							
																
							for($i=0;$i<$len;$i++){
							
							if($i%31==30){
						
									echo"<tr style=\"page-break-after: always;\">"; 
									
							echo"
							<TR valign='top' style='font-size : 7.5pt;'>
                           <TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Approved Date</B>
							</TD>							
                            <TD class=hf align=left style='font-size : 7.5pt;'>
								<B>Account No</B>
							</TD>
							<TD class=hf align=left style='font-size : 7.5pt;'>
								<B>Customer Name</B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>A/C Type </B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Books </B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Start / End No</B>
							</TD>
							
							 <TD class=hf align=left style='font-size : 7.5pt;'>
								<B>Branch </B>								
							</TD>							 								 
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Del. Type </B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Status</B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Maker ID </B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Checker ID </B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;' width='80'>
								<B>Cus. Signature</B>
							</TD>
							
						  </TR>
						  ";
						}
								
								$query ="select *from aibl_chq_rqst where rqst_id='$id[$i]'";  	
								$result=mysql_query($query);																		
								//$row=mysql_fetch_array($result);
								//echo $row['collecting_branch'];
								while ($row =mysql_fetch_assoc($result))
								{							
								$date=str_replace('-','/',$row['approval_date_time']); 		
								
									
									$ac_no=$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no'];
																								
								echo "<tr valign='top'>
								<td class=$class style='font-size : 7.5pt;'>".date('M d, Y h:i a', strtotime($date))."</td>
								<td class=$class style='font-size : 7.5pt;'>$ac_no</td>
								<td class=$class style='font-size : 7.5pt;'>".$row['cus_name']."</td>
								<td class=$class style='font-size : 7.5pt;'>".$row['ac_type']."-".$row['total_leaf']."</td>
								<td class=$class style='font-size : 7.5pt;' align='center'>".$row['books']."</td>
								<td class=$class style='font-size : 7.5pt;'>".$row['start_no']."-".$row['end_no']."</td>
								<td class=$class style='font-size : 7.5pt;'>".ucwords(strtolower(strtok($row['collecting_branch'], " ")))."</td>	
								<td class=$class style='font-size : 7.5pt;'>".$row['severity']."</td>								
								<td class=$class style='font-size : 7.5pt;'>".$row['rqst_status']."</td>	
								<td class=$class style='font-size : 7.5pt;'>".ucwords(strtolower($row['rqst_by']))."</td>
								<td class=$class style='font-size : 7.5pt;'>".ucwords(strtolower($row['approve_by']))."</td>
								<td class=$class>&nbsp;</td>					
								</tr>";
									if($class == $class1){
									$class = $class2;
									} else {
									$class = $class1;
									}
								
								}																		
							}	
								
							?>						
							
						  
						  </TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
                  
				
				  </TD></TR></TBODY></TABLE>
				 	<div>&nbsp;</div>
					<div align="center"> 
					 	<span style="float:left; width:200px;">
						___________________<br>
					 	Account Opening
					 	</span>
						
						<span style="float:right; width:200px;">
						____________________<br>
					 	Manager/Sub Manger
					 	</span>
					 </div>
					
				   <CENTER>&nbsp;&nbsp;&nbsp;
                 <input id="close" type="button"  value="Close" name="close" onclick='javascript:window.close();'/>
                  
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
							<a href="#" id="print_button" onClick="javascript:window.print();" title="Print Version">
							<img src="../images/printer.gif" border="0" align="absmiddle" />
							</a>
				  
				  
				  </CENTER>

</body>
</html>