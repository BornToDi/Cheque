<?php
include_once ("../tex_common.php");
if (empty($_SESSION['user_name']))
{	
	redirectUrl('net_signin.php?msg=signin');
}
?>
<script language="javascript" type="text/javascript">
	function validate()
	{													
		var frm  =  document.frmChqSl;
																					
			
			//return false;
			if(frm.challan_date.value=="")
			{				
				alert("Please Set the Challan Date with Respect to Downloaded Challan Date");
				frm.challan_date.focus()
				return false;								
			}
			confirm('Are you sure you want to set challan no.?')
																																																													
	  return true;
	}
	
	function SetEnable() {   	
        if(document.frmChqSl.chk.checked==true){
		document.frmChqSl.ch_no.disabled=false;
		document.frmChqSl.ch_no.focus()
		}
		else{
		document.frmChqSl.ch_no.disabled=true;
		document.frmChqSl.ch_no.value="";
		}
}
</script>
<TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=middle><B>Manage Challan Number</B>
							</TD>
						  </TR>
						  </TBODY>
						</TABLE>
					</TD>
				   </TR>
				   </TBODY>
 				</TABLE><BR>		
<?
if(($_REQUEST['option']=='others_challan_no')&&($_REQUEST['task']!='report'))
{
	$get_challan_no = mysql_fetch_array(mysql_query("select MAX(challan_no) AS MaxChallanNo from del_challan"));	
	$challan_no=$get_challan_no['MaxChallanNo'];						
	$cur_date=date('F d, Y');
	$ref_date=date('ym');	
	$last_no=$_POST['last_sl_no'];
	$challan_date=date('Y-m-d', strtotime($_POST['challan_date'])); 
	$dispatch_date_time=date('Y-m-d H:i:s a', strtotime($_POST['challan_date'])); 
		
	$query2="select distinct others_collecting_branch_code from aibl_others_rqst where others_rqst_status='ordered' order by others_collecting_branch asc";
	$result2 = mysql_query($query2) or
	die(mysql_error());

	if(isset($_POST['set_challan_no']))

	{													  		 	
		if((mysql_num_rows($result2)==0))
				{	
				echo "<script>
						alert('Delivery Challan Information is Empty.');						
					 </script>";	
					redirectUrl("index.php?option=challan_no");		
				//echo "??".$last_no[$i];
		 }	
		
		if($_POST['ch_no']>0) $no_ch_no=($_POST['ch_no']-1); else $no_ch_no=""; 
		$c=1+$no_ch_no;
		
		//$challan_no=$challan_no+$c;	
			while ($row=mysql_fetch_assoc($result2))
			{				
				
				//$last_sl_no=mysql_fetch_assoc(mysql_query("select MAX(others_end_no) as last_sl_no from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered'"));
						
				$g_others_total=mysql_fetch_assoc(mysql_query("select sum(others_books) as g_others_total from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered'"));
				$g_others_p_total=mysql_fetch_assoc(mysql_query("select sum(others_books) as g_others_p_total from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and others_severity='Priority'"));
				
				$no_PO=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_PO from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='PO'"));
				$no_DD=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_DD from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='DD'"));
				$no_FDD=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_FDD from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='FDD'"));
				$no_FDR=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_FDR from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='FDR'"));
				$no_SDR=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_SDR from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='SDR'"));
				
				
				$no_p_PO=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_p_PO from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='PO' and others_severity='Priority'"));
				$no_p_DD=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_p_DD from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='DD' and others_severity='Priority'"));
				$no_p_FDD=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_p_FDD from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='FDD' and others_severity='Priority'"));
				$no_p_FDR=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_p_FDR from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='FDR' and others_severity='Priority'"));
				$no_p_SDR=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_p_SDR from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='SDR' and others_severity='Priority'"));
				
				$branch_name=mysql_fetch_assoc(mysql_query("select others_collecting_branch from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]'"));
								
				$ChallanNo=($challan_no+$c);
				//echo "??".$row['collecting_branch_code'].$row['collecting_branch']."NO.NW/CB/aibl/".$ref_date.($challan_no+$c)."----".$g_total['g_total']."<br>";
				//$bran??ch_code[]=$row['collecting_branch_code'];
				
				
	  		 	$query ="insert into del_challan(challan_no,branch_code,branch_name,challan_date,po,dd,fdd,sdr,fdr,total,priority,p_po,p_dd,p_fdd,p_sdr,p_fdr,last_sl_no,product_type)  
									values('$ChallanNo','$row[others_collecting_branch_code]','".mysql_real_escape_string($branch_name[others_collecting_branch])."','$challan_date','$no_PO[no_PO]','$no_DD[no_DD]','$no_FDD[no_FDD]','$no_SDR[no_SDR]','$no_FDR[no_FDR]','$g_others_total[g_others_total]','$g_others_p_total[g_others_p_total]','$no_p_PO[no_p_PO]','$no_p_DD[no_p_DD]','$no_p_FDD[no_p_FDD]','$no_p_SDR[no_p_SDR]','$no_p_FDR[no_p_FDR]','$last_sl_no[last_sl_no]','others')";						
				mysql_query($query) or die (mysql_error());					
			 $c++;
			  $value='yes';
			}
				
			    $update_req_query ="Update aibl_others_rqst set others_rqst_status='dispatched',others_dispatch_datetime='$dispatch_date_time' where others_rqst_status='ordered'";  										

				mysql_query($update_req_query) or
			    die (mysql_error());
										
		redirectUrl("index.php?option=others_challan_no&task=report&value=$value");																		
	}	
												
	else{				
	?>	
					<FORM name="frmChqSl" action="index.php?option=others_challan_no" method="post">			  																					  		                                                      							
				  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=left colSpan=16>
								<B>Set Other Items Challan Number </B>							
							</TD>
						  </TR>	
						  <TR>	                          	
                            <TD class=back colspan="14">Challan Date:	
							<?							
								$cur_date=date("M d, Y g:i a");  
								 
								?>	
																										
								<input type="text" name="challan_date" id="sel2" size="25" readonly="yes">
								<img src="../aibl/body_content/calender/themes/icons/b_calendar.png" align="absmiddle" id="button2" style="cursor: pointer;" alt="Calendar" title="Date selector" />	
								<!--<input type="reset" value=" ... " id='button2'>-->

									<script type="text/javascript">
										var cal = new Zapatec.Calendar.setup({
		
											inputField     :    "sel2",     // id of the input field
											singleClick    :     true,     // require two clicks to submit
											ifFormat       :    '%b %e, %Y %I:%M %P',     // format of the input field the input field
											showsTime      :     true,     // show time as well as date
											button         :    "button2"  // trigger button 

										});
		
									</script>
									&nbsp; <input type="checkbox" name="chk" onclick="return SetEnable();" />Set Challan No. if required(Optional).&nbsp; Last Challan No. <? echo $challan_no?> +<input type="text" name="ch_no" disabled="disabled" size="5">= Your required No.
							</TD>
						  </TR>	
						 <TR>                            							 
							 <TD class=hf align=left>
								<B>Challan No. </B>						
							</TD>
							 <TD class=hf align=lef>
								<B>Branch Name</B>								
							</TD>	
							<TD class=hf align=lef>
								<B>PO </B>
							</TD>							
							<TD class=hf align=lef>
								<B>DD </B>
							</TD>
							<TD class=hf align=lef>
								<B>FDD </B>
							</TD>
							<TD class=hf align=lef>
								<B>FDR </B>
							</TD>
							<TD class=hf align=lef>
								<B>SDR </B>
							</TD>															
							<TD class=hf align=lef>
								<B>Total </B>
							</TD>
							<TD class=hf align=lef>
								<B>Priority </B>
							</TD>
							<TD class=hf align=lef>
								<B>PO </B>
							</TD>							
							<TD class=hf align=lef>
								<B>DD </B>
							</TD>
							<TD class=hf align=lef>
								<B>FDD </B>
							</TD>
							<TD class=hf align=lef>
								<B>FDR </B>
							</TD>
							<TD class=hf align=lef>
								<B>SDR </B>
							</TD>	
																
						  </TR>
											  						 						  						  
						 


<?
//-----------------------------------------------------------------------------
//*****************************************************************************************************************************************							
		
									
	if (mysql_num_rows($result2) != 0){
		
		$c=1;
		$class1 = "back2";
		$class2 = "back";
		$class = $class1;
		//$challan_no=$challan_no+$c;	
		while ($row =mysql_fetch_assoc($result2))
		{
			//$last_sl_no=mysql_fetch_assoc(mysql_query("select MAX(others_end_no) as last_sl_no from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered'"));
						
			$g_others_total=mysql_fetch_assoc(mysql_query("select sum(others_books) as g_others_total from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered'"));
			$g_others_p_total=mysql_fetch_assoc(mysql_query("select sum(others_books) as g_others_p_total from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and others_severity='Priority'"));
		
			
			$no_PO=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_PO from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='PO'"));
			$no_DD=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_DD from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='DD'"));
			$no_FDD=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_FDD from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='FDD'"));
			$no_FDR=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_FDR from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='FDR'"));
			$no_SDR=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_SDR from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='SDR'"));
						
			$no_p_PO=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_p_PO from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='PO' and others_severity='Priority'"));
			$no_p_DD=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_p_DD from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='DD' and others_severity='Priority'"));
			$no_p_FDD=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_p_FDD from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='FDD' and others_severity='Priority'"));
			$no_p_FDR=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_p_FDR from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='FDR' and others_severity='Priority'"));
			$no_p_SDR=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_p_SDR from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]' and others_rqst_status='ordered' and item_type='SDR' and others_severity='Priority'"));
			
			$branch_name=mysql_fetch_assoc(mysql_query("select others_collecting_branch from aibl_others_rqst where others_collecting_branch_code='$row[others_collecting_branch_code]'"));
			
			$ChallanNo="NW/CB/aibl/EMAIL".$ref_date.($challan_no+$c);	
			//echo "??".$row['collecting_branch_code'].$row['collecting_branch']."NO.NW/CB/aibl/".$ref_date.($challan_no+$c)."----".$g_total['g_total']."<br>";
			//$bran??ch_code[]=$row['collecting_branch_code'];
			
			echo "<tr>
			<input type='hidden' name='last_sl_no[]' value=".$last_sl_no['last_sl_no'].">	
			<td class=$class>$ChallanNo</td>											
			<td class=$class>".$branch_name['others_collecting_branch']."</td>										
			<td class=$class>".$no_PO['no_PO']."</td>
			<td class=$class>".$no_DD['no_DD']."</td>
			<td class=$class>".$no_FDD['no_FDD']."</td>
			<td class=$class>".$no_FDR['no_FDR']."</td>
			<td class=$class>".$no_SDR['no_SDR']."</td>		
			<td class=$class>".$g_others_total['g_others_total']."</td>
			<td class=$class>".$g_others_p_total['g_others_p_total']."</td>	
			<td class=$class>".$no_p_PO['no_p_PO']."</td>
			<td class=$class>".$no_p_DD['no_p_DD']."</td>
			<td class=$class>".$no_p_FDD['no_p_FDD']."</td>
			<td class=$class>".$no_p_FDR['no_p_FDR']."</td>
			<td class=$class>".$no_p_SDR['no_p_SDR']."</td>
																						
			</tr>";

			if($class == $class1){
				$class = $class2;
			} else {
				$class = $class1;
			}
			
		$c++;
		}
		//foreach($branch_code as $key=>$value) {
			//$strArray .= "id[$key]=$value&";
		//}
	}

		
	?>										
	
	<TR>
									
		<TD class=back colspan="16" align="center">							  																		
			<input type="submit" value="Set Others Challan No & Dispatch" name="set_challan_no" onclick="return validate();"/>												
		</TD>	
															 
	 </TR>		
		
		</TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
        </FORM>	              
	  
	<?	
   }
}										  
//---------------------------------------------------------------------------------------


  if(($_REQUEST['option']=='others_challan_no')&&($_REQUEST['task']=='report')){
	  if($_REQUEST[value]=='yes')
		echo "<div align='center'><b><h1>Successfully Inserted Delivery Challan Information.</b></div>".$_POST['set_challan_no'];		  
	  else		
		echo "<div align='center'><b><h1>Delivery Challan Information is Empty.</b></div>".$_POST['set_challan_no'];	
   }	
  ?>			
 </TD></TR></TBODY></TABLE>		