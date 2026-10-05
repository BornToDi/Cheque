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
														
							$BranchNameQuery ="select *from aibl_chq_rqst where collecting_branch_code='$id[$i]'"; 	
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
								$row1[collecting_branch]<br>
								United Commercial Bank Ltd.<br>Bangladesh
								<div align=center><b><u><h3>Delivery challan</h3></u></b></div>						
							";
							?>						
                        	<TABLE cellSpacing=1 cellPadding=2 width="100%" border=1 class=border style="border-collapse: collapse">
                          	
							<TR valign='top' style='font-size : 8pt;'>
                           	<TD class=hf align=left style='font-size : 8pt;'>
								<B>Sl #</B>
							</TD>
							<TD class=hf align=left style='font-size : 8pt;'>
								<B>Name</B>
							</TD>					
                            <TD class=hf align=left style='font-size : 8pt;'>
								<B>Account No</B>
							</TD>
							
							<TD class=hf align=lef style='font-size : 8pt;'>
								<B>Start No</B>
							</TD>
							<TD class=hf align=lef style='font-size : 8pt;'>
								<B>Books X Leaves </B>
							</TD>
							<TD class=hf align=lef style='font-size : 8pt;'>
								<B>End No</B>
							</TD>
							 							 								 
							<TD class=hf align=lef style='font-size : 8pt;'>
								<B>A/C Type </B>
							</TD>
							<TD class=hf align=lef style='font-size : 8pt;'>
								<B>Status</B>
							</TD>
							
							
							
							
						  </TR>
						  <?
																
								$no_sb=mysql_fetch_assoc(mysql_query("select sum(books) as no_sb from aibl_chq_rqst where collecting_branch_code='$id[$i]' and rqst_status='ordered' and ac_type='savings'"));
								$no_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_cd from aibl_chq_rqst where collecting_branch_code='$id[$i]' and rqst_status='ordered' and ac_type='current'"));
								$no_std=mysql_fetch_assoc(mysql_query("select sum(books) as no_std from aibl_chq_rqst where collecting_branch_code='$id[$i]' and rqst_status='ordered' and ac_type='STD'"));
							
								$no_50_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_50_cd from aibl_chq_rqst where collecting_branch_code='$id[$i]' and rqst_status='ordered' and ac_type='current' and total_leaf=50"));
								$no_20_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_20_cd from aibl_chq_rqst where collecting_branch_code='$id[$i]' and rqst_status='ordered' and ac_type='current' and total_leaf=20"));
								
								$query ="select *from aibl_chq_rqst where collecting_branch_code='$id[$i]' and rqst_status='ordered' order by collecting_branch desc, ac_type desc, total_leaf asc, approval_date_time desc";  	
								$result=mysql_query($query);	 
								$sl=1;																														
								while ($row =mysql_fetch_assoc($result))
								{							
								$date=str_replace('-','/',$row['approval_date_time']); 	
								
									
									$ac_no=$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no'];
																																	
								echo "<tr valign='top'>
								<td class=$class style='font-size : 8pt;'>&nbsp;$sl&nbsp;</td>							
								<td class=$class style='font-size : 8pt;'>".$row['cus_name']."</td>
								<td class=$class style='font-size : 8pt;'>$ac_no</td>																							
								<td class=$class style='font-size : 8pt;'>".$row['start_no']."</td>
								<td class=$class style='font-size : 8pt;' align='center'>".$row['books']." X ".$row['total_leaf']."</td>
								<td class=$class style='font-size : 8pt;'>".$row['end_no']."</td>							
								<td class=$class style='font-size : 8pt;'>".$row['ac_type']."</td>	
								<td class=$class style='font-size : 8pt;'>".$row['severity']."</td>																													
								</tr>";
								$sl++;
									if($class == $class1){
									$class = $class2;
									} else {
									$class = $class1;
									}
								 
								}		
								if($no_sb['no_sb']>0) $no_sb_books=$no_sb['no_sb'];
								if($no_cd['no_cd']>0) $no_cd_books=$no_sb['no_cd'];
								if($no_std['no_std']>0) $no_std_books=$no_std['no_sb'];
								?>	
								<tr valign='top'>																											
								<td class=back style='font-size : 8pt;' colspan=12><? echo "<b>Total Quantity:</b> "; if($no_sb['no_sb']>0) echo " SB Cheque Book(s): $no_sb[no_sb] ,";  if($no_cd['no_cd']>0) echo " Current Cheque Book(s): $no_cd[no_cd] (50->$no_50_cd[no_50_cd] | 20->$no_20_cd[no_20_cd])"; if($no_std['no_std']>0) echo ", STD Cheque Book(s): $no_std[no_std]"; ?></td>																																				
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