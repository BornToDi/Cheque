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
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
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
	$challan_date=date('Y-m-d', strtotime($_POST['challan_date'])); 
	$dispatch_date_time=date('Y-m-d H:i:s a', strtotime($_POST['challan_date'])); 	
		
	$query2="select distinct ac_no_branch from aibl_chq_rqst where rqst_status='ordered' order by collecting_branch asc";
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
				
				//$last_sl_no=mysql_fetch_assoc(mysql_query("select MAX(end_no) as last_sl_no from aibl_chq_rqst where ac_no_branch='$row[ac_no_branch]' and rqst_status='ordered'"));
				//$check_challan_no=mysql_query("select last_sl_no from del_challan where branch_code='".$row['ac_no_branch']."'");						
																
				$g_total=mysql_fetch_assoc(mysql_query("select sum(books) as g_total from aibl_chq_rqst where ac_no_branch='$row[ac_no_branch]' and rqst_status='ordered'"));
				
								
				$no_sb=mysql_fetch_assoc(mysql_query("select sum(books) as no_sb from aibl_chq_rqst where ac_no_branch='$row[ac_no_branch]' and rqst_status='ordered' and ac_type='savings'"));
				$no_imp=mysql_fetch_assoc(mysql_query("select sum(books) as no_imp from aibl_chq_rqst where ac_no_branch='$row[ac_no_branch]' and rqst_status='ordered' and ac_type='imperial'"));				
				$no_25_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_25_cd from aibl_chq_rqst where ac_no_branch='$row[ac_no_branch]' and rqst_status='ordered' and ac_type='current' and total_leaf=25"));
				$no_50_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_50_cd from aibl_chq_rqst where ac_no_branch='$row[ac_no_branch]' and rqst_status='ordered' and ac_type='current' and total_leaf=50"));
			   
				
				$branch_name=mysql_fetch_assoc(mysql_query("select collecting_branch from aibl_chq_rqst where ac_no_branch='$row[ac_no_branch]'"));
				
				$ChallanNo=($challan_no+$c);	
				//echo "??".$row['ac_no_branch'].$row['collecting_branch']."NO.NW/CB/aibl/".$ref_date.($challan_no+$c)."----".$g_total['g_total']."<br>";
				//$bran??ch_code[]=$row['ac_no_branch'];
				
				
	  		 	$query ="insert into del_challan(challan_no,branch_code,branch_name,challan_date,sb,imp,cd_25,cd_50,total,product_type)  
									values('$ChallanNo','$row[ac_no_branch]','$branch_name[collecting_branch]','$challan_date','$no_sb[no_sb]','$no_imp[no_imp]','$no_25_cd[no_25_cd]','$no_50_cd[no_50_cd]','$g_total[g_total]','cheque')";						
				mysql_query($query) or die (mysql_error());					
			 	$c++;
			 	$value='yes';
			  			  			   			  
			}
			    $update_req_query ="Update aibl_chq_rqst set rqst_status='dispatched',dispatch_datetime='$dispatch_date_time' where rqst_status='ordered'";  																	
			    mysql_query($update_req_query) or
			    die (mysql_error());
										
		redirectUrl("index.php?option=challan_no&task=report&value=$value");																		
	}	
												
	else{				
	?>	
				<FORM name="frmChqSl" action="index.php?option=challan_no" method="post">			  																					  		                                                      							
				  <TABLE class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                    <TBODY>
                    <TR>
                      <TD>
                        <TABLE cellSpacing=1 cellPadding=2 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD class=info align=left colSpan=12>
								<B>Set Cheque Challan Number </B>							
							</TD>
						  </TR>	
						  <TR>	                          	
                            <TD class=back colspan="12">Challan Date:	
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
								<B>SB</B>
							</TD>	
							<TD class=hf align=lef>
								<B>Imperial</B>
							</TD>							
							 <TD class=hf align=lef>
								<B>CD 25</B>
							</TD>
							<TD class=hf align=lef>
								<B>CD 50</B>
							</TD>
							
							<TD class=hf align=lef>
								<B>Total </B>
							</TD>
							
											  						 						  						  
						 


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
			//$last_sl_no=mysql_fetch_assoc(mysql_query("select MAX(end_no) as last_sl_no from aibl_chq_rqst where ac_no_branch='$row[ac_no_branch]' and rqst_status='ordered'"));
			
				$g_total=mysql_fetch_assoc(mysql_query("select sum(books) as g_total from aibl_chq_rqst where ac_no_branch='$row[ac_no_branch]' and rqst_status='ordered'"));
				
								
				$no_sb=mysql_fetch_assoc(mysql_query("select sum(books) as no_sb from aibl_chq_rqst where ac_no_branch='$row[ac_no_branch]' and rqst_status='ordered' and ac_type='savings'"));
				$no_imp=mysql_fetch_assoc(mysql_query("select sum(books) as no_imp from aibl_chq_rqst where ac_no_branch='$row[ac_no_branch]' and rqst_status='ordered' and ac_type='imperial'"));				
				$no_25_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_25_cd from aibl_chq_rqst where ac_no_branch='$row[ac_no_branch]' and rqst_status='ordered' and ac_type='current' and total_leaf=25"));
				$no_50_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_50_cd from aibl_chq_rqst where ac_no_branch='$row[ac_no_branch]' and rqst_status='ordered' and ac_type='current' and total_leaf=50"));
				
				$branch_name=mysql_fetch_assoc(mysql_query("select collecting_branch from aibl_chq_rqst where ac_no_branch='$row[ac_no_branch]'"));
				
			$ChallanNo="NW/CB/aibl/MICR/".$ref_date.($challan_no+$c);	
			//echo "??".$row['ac_no_branch'].$row['collecting_branch']."NO.NW/CB/aibl/".$ref_date.($challan_no+$c)."----".$g_total['g_total']."<br>";
			//$bran??ch_code[]=$row['ac_no_branch'];
			
			echo "<tr>
			<input type='hidden' name='last_sl_no[]' value=".$last_sl_no['last_sl_no'].">										
			<td class=$class>$ChallanNo</td>	
			<td class=$class>".$branch_name['collecting_branch']."</td>										
			<td class=$class>".$no_sb['no_sb']."</td>
			<td class=$class>".$no_imp['no_imp']."</td>
			<td class=$class>".$no_25_cd['no_25_cd']."</td>
			<td class=$class>".$no_50_cd['no_50_cd']."</td>	
				
			<td class=$class>".$g_total['g_total']."</td>
																						
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
									
		<TD class=back colspan="12" align="center">							  																					
			<input type="submit" value="Set Cheque Challan No & Dispatch" name="set_challan_no"  onclick="return validate();"/>
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