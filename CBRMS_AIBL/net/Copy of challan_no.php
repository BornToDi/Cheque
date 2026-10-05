<?php
include_once ("../tex_common.php");
if (empty($_SESSION['user_name']))
{	
	redirectUrl('net_signin.php?msg=signin');
}
?>
<TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=5 width="100%" border=0>
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
if(($_REQUEST['option']=='challan_no')&&($_REQUEST['task']!='report'))
{
	$get_challan_no = mysql_fetch_array(mysql_query("select MAX(challan_no) AS MaxChallanNo from del_challan"));	
	$challan_no=$get_challan_no['MaxChallanNo'];						
	$cur_date=date('F d, Y');
	$ref_date=date('ym');
	$last_no=$_POST['last_sl_no'];
	$challan_date=date("Y-m-d");
	
	$query2="select distinct collecting_branch_code,collecting_branch from aibl_chq_rqst where rqst_status='ordered' order by collecting_branch asc";
	$result2 = mysql_query($query2) or
	die(mysql_error());

	if(isset($_POST['set_challan_no']))

	{													  		 	
		for ($i=0; $i<count($last_no); $i++)
		  {
			$query="select last_sl_no from del_challan where last_sl_no='$last_no[$i]' and product_type='cheque'";
			$result=mysql_query($query);
			if((mysql_num_rows($result)!=0))
				{	
				echo "<script>
						alert('You have already set Cheque challan no. Please dispatch before set the challan no.');						
					 </script>";	
					redirectUrl("index.php?option=challan_no");		
				//echo "??".$last_no[$i];
				}
		}
		
		if (mysql_num_rows($result) == 0){
		$c=1;
		//$challan_no=$challan_no+$c;	
			while ($row=mysql_fetch_assoc($result2))
			{				
				
				$last_sl_no=mysql_fetch_assoc(mysql_query("select MAX(end_no) as last_sl_no from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered'"));
				$check_challan_no=mysql_query("select last_sl_no from del_challan where branch_code='".$row['collecting_branch_code']."'");						
																
				$g_total=mysql_fetch_assoc(mysql_query("select sum(books) as g_total from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered'"));
				$g_p_total=mysql_fetch_assoc(mysql_query("select sum(books) as g_p_total from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered' and severity='Priority'"));
				
				$no_sb=mysql_fetch_assoc(mysql_query("select sum(books) as no_sb from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered' and ac_type='savings'"));
				$no_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_cd from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered' and ac_type='current'"));
				
				$no_p_sb=mysql_fetch_assoc(mysql_query("select sum(books) as no_p_sb from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered' and severity='Priority' and ac_type='savings'"));
				$no_p_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_p_cd from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered' and ac_type='current' and severity='Priority'"));
	
				$ChallanNo=($challan_no+$c);	
				//echo "??".$row['collecting_branch_code'].$row['collecting_branch']."NO.NW/CB/aibl/".$ref_date.($challan_no+$c)."----".$g_total['g_total']."<br>";
				//$bran??ch_code[]=$row['collecting_branch_code'];
				
				
	  		 	$query ="insert into del_challan(challan_no,branch_code,branch_name,challan_date,sb,cd_20,cd_50,std,po,dd,fd,sdr,fdr,total,priority,last_sl_no,product_type)  
									values('$ChallanNo','$row[collecting_branch_code]','$row[collecting_branch]','$challan_date','$no_sb[no_sb]','$no_cd[no_cd]','','','','','','','','$g_total[g_total]','$g_p_total[g_p_total]','$last_sl_no[last_sl_no]','cheque')";						
				mysql_query($query) or die (mysql_error());					
			 $c++;
			  $value='yes';
			}
								
		}	
		redirectUrl("index.php?option=challan_no&task=report&value=$value");																		
	}	
												
	else{				
	?>	
					<FORM name="frmChqSl" action="index.php?option=challan_no" method="post">			  																					  		                                                      							
				  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=5 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=left colSpan=8>
								<B>Set Challan Number </B>							
							</TD>
						  </TR>	
						 <TR>
                            
							 <TD class=hf align=lef>
								<B>Date</B>
							</TD>
							 <TD class=hf align=left>
								<B>Challan No. </B>						
							</TD>
							 <TD class=hf align=lef>
								<B>Branch Name</B>								
							</TD>	
							<TD class=hf align=lef>
								<B>Savings </B>
							</TD>							
							 <TD class=hf align=lef>
								<B>Current </B>
							</TD>
							<TD class=hf align=lef>
								<B>Total </B>
							</TD>
							<TD class=hf align=lef>
								<B>Priority </B>
							</TD>
							<TD class=hf align=lef>
								<B>Last Sl No </B>
							</TD>
														
						  </TR>
											  						 						  						  
						 


<?
//-----------------------------------------------------------------------------
//*****************************************************************************************************************************************							
	
	
	
	/*$g_total=mysql_fetch_assoc(mysql_query("select sum(books) as g_total from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered'"));
	$g_p_total=mysql_fetch_assoc(mysql_query("select sum(books) as g_p_total from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered' and severity='Priority'"));
	
	$no_sb=mysql_fetch_assoc(mysql_query("select sum(books) as no_sb from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered' and ac_type='savings'"));
	$no_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_cd from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered' and ac_type='current'"));
	
	$no_p_sb=mysql_fetch_assoc(mysql_query("select sum(books) as no_p_sb from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered' and severity='Priority' and ac_type='savings'"));
	$no_p_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_p_cd from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered' and ac_type='current' and severity='Priority'"));
*/
									
	if (mysql_num_rows($result2) != 0){
		
		$c=1;
		$class1 = "back2";
		$class2 = "back";
		$class = $class1;
		//$challan_no=$challan_no+$c;	
		while ($row =mysql_fetch_assoc($result2))
		{
			$last_sl_no=mysql_fetch_assoc(mysql_query("select MAX(end_no) as last_sl_no from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered'"));
			
			$g_total=mysql_fetch_assoc(mysql_query("select sum(books) as g_total from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered'"));
			$g_p_total=mysql_fetch_assoc(mysql_query("select sum(books) as g_p_total from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered' and severity='Priority'"));
			
			$no_sb=mysql_fetch_assoc(mysql_query("select sum(books) as no_sb from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered' and ac_type='savings'"));
			$no_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_cd from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered' and ac_type='current'"));
			
			$no_p_sb=mysql_fetch_assoc(mysql_query("select sum(books) as no_p_sb from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered' and severity='Priority' and ac_type='savings'"));
			$no_p_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_p_cd from aibl_chq_rqst where collecting_branch_code='$row[collecting_branch_code]' and rqst_status='ordered' and ac_type='current' and severity='Priority'"));

			$ChallanNo="NW/CB/aibl/MICR/".$ref_date.($challan_no+$c);	
			//echo "??".$row['collecting_branch_code'].$row['collecting_branch']."NO.NW/CB/aibl/".$ref_date.($challan_no+$c)."----".$g_total['g_total']."<br>";
			//$bran??ch_code[]=$row['collecting_branch_code'];
			
			echo "<tr>
			<input type='hidden' name='last_sl_no[]' value=".$last_sl_no['last_sl_no'].">	
			<td class=$class>$cur_date</td>							
			<td class=$class>$ChallanNo</td>	
			<td class=$class>".$row['collecting_branch']."</td>										
			<td class=$class>".$no_sb['no_sb']."</td>
			<td class=$class>".$no_cd['no_cd']."</td>
			<td class=$class>".$g_total['g_total']."</td>
			<td class=$class>".$g_p_total['g_p_total']."</td>	
			<td class=$class>".$last_sl_no['last_sl_no']."</td>																
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
									
		<TD class=back colspan="8" align="center">							  																		
			<input type="submit" value="Set Cheque Challan No" name="set_challan_no" onclick="return confirm('Are you sure you want to set challan no.?');"/>												
		</TD>	
															 
	 </TR>		
		
		</TBODY></TABLE></TD></TR></TBODY></TABLE><BR>
        </FORM>	              
	  
	<?	
   }
}										  
//---------------------------------------------------------------------------------------


  if(($_REQUEST['option']=='challan_no')&&($_REQUEST['task']=='report')){
  	 if($_REQUEST[value]=='yes')
		echo "<div align='center'><b><h1>Successfully Inserted Delivery Challan Information.</b></div>".$_POST['set_challan_no'];		  
	  else		
		echo "<div align='center'><b><h1>Delivery Challan Information is Empty.</b></div>".$_POST['set_challan_no'];	
  }		
  ?>			
 </TD></TR></TBODY></TABLE>		