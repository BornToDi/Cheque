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
                            
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Item Type </B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Books </B>
							</TD>
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Start No - End No</B>
							</TD>
														 						 								 
							<TD class=hf align=lef style='font-size : 7.5pt;'>
								<B>Delivery Type </B>
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
								$query ="select *from aibl_others_rqst where others_rqst_id='$id[$i]'";  	
								$result=mysql_query($query);																		
								$row=mysql_fetch_array($result);
								//echo $row['collecting_branch'];																							
								
								$date=str_replace('-','/',$row['others_approval_date_time']); 																	
								if(($row['approval_date_time'])!=0){
								$approve_date= date('M d, Y h:i a', strtotime($date)); 
								}
								else 
								$approve_date="Not yet approved";
																
								if($i%31==30){
						
									echo"<tr style=\"page-break-after: always;\">"; 
								}
								else{
								echo "<tr valign='top'>
								<td class=$class style='font-size : 7.5pt;'>$approve_date</td>																
								<td class=$class style='font-size : 7.5pt;'>".$row['item_type']."-".$row['others_total_leaf']." Lvs</td>
								<td class=$class style='font-size : 7.5pt;' align='center'>".$row['others_books']."</td>
								<td class=$class style='font-size : 7.5pt;'>".$row['others_start_no']." - ".$row['others_end_no']."</td>								
								<td class=$class style='font-size : 7.5pt;'>".$row['others_severity']."</td>								
								<td class=$class style='font-size : 7.5pt;'>".$row['others_rqst_status']."</td>	
								<td class=$class style='font-size : 7.5pt;'>".ucwords(strtolower($row['others_rqst_by']))."</td>
								<td class=$class style='font-size : 7.5pt;'>".ucwords(strtolower($row['others_approve_by']))."</td>
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