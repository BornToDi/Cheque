<?php
include_once ("../../config.php");
require_once 'Spreadsheet/Excel/Writer.php';
$id=$_REQUEST['id'];	
$len=count($id);
// attempt a connection

//setTextWrap ()

        $workbook = new Spreadsheet_Excel_Writer();
		        
        $worksheet =& $workbook->addWorksheet('aibl_Challan');		
							
		$worksheet->setPaper(9);		
		$worksheet->setPortrait();
		//$worksheet->setMargins(0.6);
		//$worksheet->setHPagebreaks();
		//$worksheet->setHeader(1.0);
		//$worksheet->setHeader(1.0);
		
		$worksheet->setMarginLeft(0.5);
		$worksheet->setMarginRight(0.5);
		$worksheet->setMarginTop(0.5);
		$worksheet->setMarginBottom(0.5);
		//$worksheet->setHPagebreaks();
		//$worksheet->setVPagebreaks();
		
		$worksheet->setColumn(0,0,5); 
		$worksheet->setColumn(1,1,15);
		$worksheet->setColumn(2,2,20); 
		$worksheet->setColumn(3,3,7);
		$worksheet->setColumn(4,4,9); 
		$worksheet->setColumn(5,5,7);
		$worksheet->setColumn(6,6,7); 
		
		
		
		
		
		//Setup different styles
		//$sheetTitleFormat =& $workbook->addFormat(array('bold'=>1,'size'=>10));
		//$columnTitleFormat =& $workbook->addFormat(array('bold'=>1,'top'=>1,'bottom'=>1 ,'size'=>9));
		
		$topRow=& $workbook->addFormat();	
		$topRow->setSize(9);
		$topRow->setBold();	
	
		$abRow=& $workbook->addFormat();
		$abRow->setAlign('center');
		$abRow->setSize(12);	
		$abRow->setBold();	
		  
		$titleRow =& $workbook->addFormat();	
		$titleRow->setSize(8);	
		$titleRow->setBold();		
		$titleRow->setBorder(1);		
		
		
		$commonRow =& $workbook->addFormat();	
		$commonRow->setAlign('top');
		$commonRow->setAlign('left');
		$commonRow->setSize(7.5);			
		$commonRow->setBorder(1);		
		
		$statusTitle =& $workbook->addFormat();			
		//$statusTitle->setPattern(6);		
		$statusTitle->setSize(7.5);
		$statusTitle->setBold();	
		$statusTitle->setBorder(1);
		
		$statusRow =& $workbook->addFormat();			
		$statusRow->setSize(7.5);	
		$statusRow->setAlign('left');	
		$statusRow->setBorder(1);
		
		
		$cusName =& $workbook->addFormat();
		$cusName->setAlign('top');
		$cusName->setSize(7);	
		$cusName->setTextWrap();		
		$cusName->setBorder(1);		
		
		
		$get_challan_no = mysql_fetch_array(mysql_query("select MAX(challan_no) AS MaxChallanNo from del_challan"));	
		$challan_no=$get_challan_no['MaxChallanNo']+1;
		
		$top=5;
		$page=0;
		for($c=0;$c<$len;$c++){
		
		$BranchNameQuery ="select *from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered' order by rqst_date desc"; 	
		//$BranchNameQuery ="select *from aibl_chq_rqst where rqst_branch_code='4009'"; 	
		$BranchNameResult=mysql_query($BranchNameQuery);
		$row1 =mysql_fetch_assoc($BranchNameResult); 
		
		//$challan_no=$challan_no+$c;					
		$cur_date=date('F d, Y');
		$ref_date=date('ym');
		$date = date('F d, Y', mktime(0, 0, 0, date('m'), date('d') + 3, date('Y')));
        
		//$worksheet->write($page+0+$top, 0, "STR/03/005", $topRow);
		//$worksheet->write($page+1+$top, 0,$cur_date, $topRow);
		//$worksheet->write($page+2+$top, 1, "NO.NW/CB/aibl/EMAIL/".$ref_date.($challan_no+$c), $topRow);
		

		//$worksheet->write($page+3+$top, 0, "To",$topRow);
		//$worksheet->write($page+3+$top, 2, "Total Books Qty",$titleRow);				
		//$worksheet->write($page+4+$top, 0, "Manager",$topRow);
		//$worksheet->write($page+5+$top, 0, "Delivery Branch:--".$row1[collecting_branch],$topRow);
		//$worksheet->write($page+6+$top, 0, "Customer Branch Name:--".$row1[collecting_branch],$topRow);
		
		//$worksheet->write($page+6+$top, 0, "Al-Arafa Islami Bank Limited",$topRow);
		//$worksheet->write($page+7+$top, 3, "DELIVERY CHALLAN", $abRow);
		
		/*					
        $worksheet->write($page+8+$top, 0, "Sl #", $titleRow);
        $worksheet->write($page+8+$top, 1, "Account No..", $titleRow);
        $worksheet->write($page+8+$top, 2, "Account Name", $titleRow);
        $worksheet->write($page+8+$top, 3, "Start No", $titleRow);  
		$worksheet->write($page+8+$top, 4, "Books X Lvs", $titleRow);          
        $worksheet->write($page+8+$top, 5, "End No", $titleRow);
		$worksheet->write($page+8+$top, 6, "A/C Type", $titleRow);
        $worksheet->write($page+8+$top, 7, "Status", $titleRow);
		$worksheet->write($page+8+$top, 8, "Cus.Branch", $titleRow);
       
       	*/
		
		$g_total=mysql_fetch_assoc(mysql_query("select sum(books) as g_total from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered'"));
		$g_p_total=mysql_fetch_assoc(mysql_query("select sum(books) as g_p_total from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered' and severity='Priority'"));
		
		$no_sb=mysql_fetch_assoc(mysql_query("select sum(books) as no_sb from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered' and ac_type='10' and total_leaf=20"));
		$no_sb_25=mysql_fetch_assoc(mysql_query("select sum(books) as no_sb_25 from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered' and ac_type='10' and total_leaf=10"));
		$no_card=mysql_fetch_assoc(mysql_query("select sum(books) as no_card from aibl_chq_rqst where rqst_branch_code='$id[$c]' and rqst_status='ordered' and ac_type='CARD' and total_leaf=10 "));
		$no_25_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_25_cd from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered' and ac_type='current' and total_leaf=25"));
		$no_50_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_50_cd from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered' and ac_type='11' and total_leaf=50"));
		$no_100_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_100_cd from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered' and ac_type='current' and total_leaf=100"));		
		
		$no_p_sb=mysql_fetch_assoc(mysql_query("select sum(books) as no_p_sb from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered' and severity='Priority' and ac_type='savings'"));
		$no_p_sb_25=mysql_fetch_assoc(mysql_query("select sum(books) as no_p_sb_25 from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered' and severity='Priority' and ac_type='savings'"));
		$no_p_imp=mysql_fetch_assoc(mysql_query("select sum(books) as no_p_imp from aibl_chq_rqst where rqst_branch_code='$id[$c]' and rqst_status='ordered' and severity='Priority' and ac_type='CARD'"));
		$no_p_25_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_p_25_cd from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered' and ac_type='current' and severity='Priority' and total_leaf=25"));
		$no_p_50_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_p_50_cd from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered' and ac_type='current' and severity='Priority' and total_leaf=50"));
		$no_p_100_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_p_100_cd from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered' and ac_type='current' and severity='Priority' and total_leaf=100"));
		
	  // $i=9+$top;
	  // $sl=1;
	   //$query ="select *from aibl_chq_rqst where rqst_branch_code='$id[$c]' and rqst_status='ordered' order by collecting_branch desc, ac_type desc, total_leaf asc, approval_date_time desc";  	
	   $result=mysql_query("select *from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered' order by rqst_branch asc, collecting_branch asc, ac_type desc, start_no asc, total_leaf asc, approval_date_time desc");						
		
		//$result=mysql_query($query);	
																																					
			while ($row =mysql_fetch_assoc($result))
				{
				/*										  		
				$date=str_replace('-','/',$row['order_date_time']); 
				$date=date('M d, Y h:i a', strtotime($date));				
				$ac_no=$row['account_no'];
				
				if(trim($row['ac_type'])=='10' )
				$value='Savings';
				elseif(trim($row['ac_type'])=='11')
				$value='Current';
				//$ac_no=$row['ac_no_branch']."-".$row['ac_no_suffix'].$row['ac_no_cus_no'];															
                $worksheet->write($page+$i, 0, "$sl", $commonRow);
                $worksheet->writeString($page+$i, 1, "$ac_no", $commonRow);
                $worksheet->write($page+$i, 2, "$row[cus_name]", $cusName);
                $worksheet->writeString($page+$i, 3, "$row[start_no]", $commonRow);
                $worksheet->write($page+$i, 4, "$row[books]". "X" ."$row[total_leaf]", $commonRow);
				$worksheet->writeString($page+$i, 5, "$row[end_no]", $commonRow);
				$worksheet->write($page+$i, 6, $value, $commonRow);
				$worksheet->write($page+$i, 7, "$row[severity]", $commonRow);*/
				$worksheet->write($page+$i+2, 1, "$row[rqst_branch]", $cusName);
				
				
						            
       		$i++;
			$sl++;
	    }
		
		//$worksheet->mergeCells($page+$i,0,$page+$i+3,6);
		
		//$worksheet->write($page+$i, 0, " ", $statusTitle);
		//$worksheet->write($page+$i, 1, "SB-(20)", $statusTitle);
		//$worksheet->write($page+$i, 2, "SB-(10)", $statusTitle);
		//$worksheet->write($page+$i, 3, "CD-(25)", $statusTitle);	
		//$worksheet->write($page+$i, 4, "CD-(50)", $statusTitle);	
		//$worksheet->write($page+$i, 5, "CD-(100)", $statusTitle);	
		//$worksheet->write($page+$i, 6, "CARD", $statusTitle);
		$worksheet->write($page+$i, 0, "SL No#", $statusTitle);
		$worksheet->write($page+$i, 1, "Br. Name", $statusTitle);
		$worksheet->write($page+$i, 2, "Books QTY", $statusTitle);		
		
		//$worksheet->write($page+$i+1, 0, "Total", $statusTitle);
		$worksheet->write($page+$i+1, 0, "$row[rqst_branch]", $cusName);
		
		$worksheet->write($page+$i+1, 1, "$no_sb[no_sb]", $statusRow);
		$worksheet->write($page+$i+1, 2, "$no_sb_25[no_sb_25]", $statusRow);
		$worksheet->write($page+$i+1, 3, "$no_25_cd[no_25_cd]", $statusRow);
		$worksheet->write($page+$i+1, 4, "$no_50_cd[no_50_cd]", $statusRow);
		$worksheet->write($page+$i+1, 5, "$no_100_cd[no_100_cd]", $statusRow);	
		$worksheet->write($page+$i+1, 6, "$no_card[no_card]", $statusRow);
		$worksheet->write($page+$i+1, 2, "$g_total[g_total]", $statusRow);	
		$worksheet->write($page+3+$top, 3, "$g_total[g_total]", $titleRow);
		
			
		
		/*
				
		if($i>57){		
		$worksheet->write($page+$i+55+2, 0, " ______________________", $topRow);	
		$worksheet->write($page+$i+55+3, 0, " Authorized Signature ", $topRow);	
		
		$worksheet->write($page+$i+55+2, 5, "_________________________", $topRow);	
		$worksheet->write($page+$i+55+3, 5, "Received By", $topRow);
		$worksheet->write($page+$i+55+4, 5, "(Name, Designation & Seal)", $topRow);	
		
		$page=$page+$i+61;
		}
		else
		{
		$worksheet->write($page+55+2, 0, " ______________________", $topRow);	
		$worksheet->write($page+55+3, 0, " Authorized Signature ", $topRow);	
		
		$worksheet->write($page+55+2, 5, "_________________________", $topRow);	
		$worksheet->write($page+55+3, 5, "Received By", $topRow);
		$worksheet->write($page+55+4, 5, "(Name, Designation & Seal)", $topRow);	
		
		$page=$page+61;
		}
		*/
		
		}
		$cllanch_date=date('d-m-y');
		$worksheet->hideGridLines();
        $workbook->send($cllanch_date.'_aibl_Challan.xls');
        $workbook->close();
?>



