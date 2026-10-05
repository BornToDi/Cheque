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




                
                <CENTER>&nbsp;&nbsp;&nbsp;
                	 <input id="close" type="button"  value="Close" name="close" onclick='javascript:window.close();'/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;						
							<a href="#" id="print_button" onClick="javascript:window.print();" title="Print Version">
							<img src="../images/printer.gif" border="0" align="absmiddle" />
							</a>				  				  
</CENTER>
				                                                          
                          
						<? 																																							
							//Set the Rows
							$class1 = "back2";
							$class2 = "back";
							$class = $class1;
							
																
							for($i=0;$i<$len;$i++){
							
							?>
							<TABLE class=border cellSpacing=0 cellPadding=0 width="100%"  border=0 height="950">
                    		
							<?
														
							//$BranchNameQuery ="select *from aibl_others_rqst where others_collecting_branch_code='$id[$i]'"; 	
							$BranchNameQuery ="select *from aibl_others_rqst where others_collecting_branch_code='$id[$i]'"; 
							$BranchNameResult=mysql_query($BranchNameQuery);
							$row1 =mysql_fetch_assoc($BranchNameResult);
							
							$cur_date=date('F d, Y');
							$ref_date=date('ym');
							if($i%2==1){						
									echo"<tr style=\"page-break-after: always;\">"; 									
								}
																													
							echo"							
							<TR valign='top'>
							<TD class=$class2>
								<br><br><br><br><br><br>
								<DIV  style='float:left; width:300;'>$cur_date</div><DIV style='float:right; width:300;'>NO. <b>NW/CB/aibl/$ref_date</div>
								<br><br>
								To<br>
								Manager<br>
								$row1[others_collecting_branch]<br>
								United Commercial Bank Ltd.<br>Bangladesh
								<div align=center><b><u><h3>Delivery challan</h3></u></b></div>						
							";
							?>						
                        	<TABLE cellSpacing=1 cellPadding=2 width="100%" border=1 class=border style="border-collapse: collapse">
                          	
							<TR valign='top' style='font-size : 8pt;'>
                           	<TD class=hf align=left style='font-size : 8pt;'>
								<B>Sl #</B>
							</TD>
							<TD class=hf align=lef style='font-size : 8pt;'>
								<B>Item Name </B>
							</TD>
							<TD class=hf align=lef style='font-size : 8pt;'>
								<B>Start No</B>
							</TD>
							<TD class=hf align=lef style='font-size : 8pt;'>
								<B>End No</B>
							</TD>
							<TD class=hf align=center style='font-size : 8pt;'>
								<B>Books X Leaves </B>
							</TD>
							<TD  class=hf align=center style='font-size : 8pt;'>							
								<B>Qty. of Books</B>	
							</TD>							 								 							
							<TD class=hf align=lef style='font-size : 8pt;'>
								<B>Status</B>
							</TD>
							
							
							
							
						  </TR>
						  <?
																
								$no_PO=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_PO from aibl_others_rqst where others_collecting_branch_code='$id[$i]' and others_rqst_status='ordered' and item_type='PO'"));
								$no_DD=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_DD from aibl_others_rqst where others_collecting_branch_code='$id[$i]' and others_rqst_status='ordered' and item_type='DD'"));
								$no_SDR=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_SDR from aibl_others_rqst where others_collecting_branch_code='$id[$i]' and others_rqst_status='ordered' and item_type='SDR'"));
								$no_FDD=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_FDD from aibl_others_rqst where others_collecting_branch_code='$id[$i]' and others_rqst_status='ordered' and item_type='FDD'"));
								$no_FDR=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_FDR from aibl_others_rqst where others_collecting_branch_code='$id[$i]' and others_rqst_status='ordered' and item_type='FDR'"));
								$no_MTD=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_MTD from aibl_others_rqst where others_collecting_branch_code='$id[$i]' and others_rqst_status='ordered' and item_type='MTD'"));
								
								
								$query ="select *from aibl_others_rqst where others_collecting_branch_code='$id[$i]' and others_rqst_status='ordered' order by others_collecting_branch desc, item_type desc, others_total_leaf asc, others_approval_date_time desc";  	
								$result=mysql_query($query);	 
								$sl=1;																														
								while ($row =mysql_fetch_assoc($result))
								{							
								$date=str_replace('-','/',$row['others_approval_date_time']); 	
																																	
								echo "<tr valign='top'>
								<td class=$class style='font-size : 8pt;'>&nbsp;$sl&nbsp;</td>																							
								<td class=$class style='font-size : 8pt;'>".$row['item_type']."</td>	
								<td class=$class style='font-size : 8pt;'>".$row['others_start_no']."</td>
								<td class=$class style='font-size : 8pt;'>".$row['others_end_no']."</td>
								<td class=$class style='font-size : 8pt;' align='center'>".$row['others_books']." X ".$row['others_total_leaf']."</td>
								<td class=$class style='font-size : 8pt;' align='center'>".$row['others_books']*$row['others_total_leaf']."</td>															
								<td class=$class style='font-size : 8pt;'>".$row['others_severity']."</td>																													
								</tr>";
								$sl++;
									if($class == $class1){
									$class = $class2;
									} else {
									$class = $class1;
									}
								 
								}		
								/*if($no_PO['no_PO']>0) $no_PO_others_books=$no_PO['no_PO'];
								if($no_DD['no_DD']>0) $no_LD_others_books=$no_DD['no_DD'];
								if($no_SDR['no_SDR']>0) $no_SDR_others_books=$no_SDR['no_SDR'];
								if($no_FDD['no_FDD']>0) $no_FDD_others_books=$no_FDD['no_FDD'];
								if($no_FDR['no_FDR']>0) $no_FDR_others_books=$no_FDR['no_FDR'];
								if($no_MTD['no_MTD']>0) $no_MTD_others_books=$no_MTD['no_MTD'];*/
								?>	
								<tr valign='top'>																											
								<td class=back style='font-size : 8pt;' colspan=12>
								<? echo "<b>Total Quantity:</b> ";
								 	if($no_PO['no_PO']>0) echo " PO Book(s): $no_PO[no_PO] ,";  
									if($no_DD['no_DD']>0) echo " DD Book(s): $no_DD[no_DD] ,"; 
									if($no_SDR['no_SDR']>0) echo " SDR Book(s): $no_SDR[no_SDR] ,"; 
									if($no_FDD['no_FDD']>0) echo " FDD Book(s): $no_FDD[no_FDD] ,"; 
									if($no_FDR['no_FDR']>0) echo " FDR Book(s): $no_FDR[no_FDR] ,"; 									
								?>
								</td>																																				
								</tr>
								 
															
							 
							  </TABLE>
							  </TD>
					  		  </TR>
								<tr>
								<td class="back">&nbsp;
								
								</td>
								</tr>
								<tr>
								<td class="back" colspan="12">
								<div>&nbsp;</div>
								<div align="center"> 
					 			<span style="float:left; width:150px;">
								_____________________<br>
					 			Authorized Signature
					 			</span>
						
								<span style="float:right; width:300px;">
								____________________<br>
					 			Received By<br><font size="-2">(Name, Designation & Seal)</font>
					 			</span>
					 			</div>
								</td>
								</tr>
								</TABLE>
								<?	
																						
							}	
								
							?>						
							
						  
				    
				 	
					
				   <CENTER>&nbsp;&nbsp;&nbsp;
                	 <input id="close" type="button"  value="Close" name="close" onclick='javascript:window.close();'/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;						
							<a href="#" id="print_button" onClick="javascript:window.print();" title="Print Version">
							<img src="../images/printer.gif" border="0" align="absmiddle" />
							</a>				  				  
				  </CENTER>
				  

</body>
</html>