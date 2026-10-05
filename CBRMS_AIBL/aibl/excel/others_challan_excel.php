<?php
include_once ("../../config.php");
require_once 'Spreadsheet/Excel/Writer.php';
$id=$_REQUEST['id'];	
$len=count($id);

//setTextWrap ()

        $workbook = new Spreadsheet_Excel_Writer();
		        
        $worksheet =& $workbook->addWorksheet('Challan');		
							
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
		
		$worksheet->setColumn(0,0,4); 
		$worksheet->setColumn(1,1,10);
		$worksheet->setColumn(2,2,11); 
		$worksheet->setColumn(3,3,12);
		$worksheet->setColumn(4,4,12); 
		$worksheet->setColumn(5,5,12);
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
		$titleRow->setSize(10);	
		$titleRow->setBold();		
		$titleRow->setBorder(1);		
		
		
		$commonRow =& $workbook->addFormat();	
		$commonRow->setAlign('top');
		$commonRow->setAlign('left');
		$commonRow->setSize(10);			
		$commonRow->setBorder(1);		
		
		$statusTitle =& $workbook->addFormat();			
		//$statusTitle->setPattern(6);		
		$statusTitle->setSize(10);
		$statusTitle->setBold();	
		$statusTitle->setBorder(1);
		
		$statusRow =& $workbook->addFormat();			
		$statusRow->setSize(10);	
		$statusRow->setAlign('left');	
		$statusRow->setBorder(1);
						
		
		$cusName =& $workbook->addFormat();
		$cusName->setAlign('top');
		$cusName->setSize(10);	
		$cusName->setTextWrap();		
		$cusName->setBorder(1);		
		
		
		//$get_challan_no = mysql_fetch_array(mysql_query("select *from challan_no"));	
		//$challan_no=$get_challan_no['challan_no'];
		
		$get_challan_no = mysql_fetch_array(mysql_query("select MAX(challan_no) AS MaxChallanNo from del_challan"));	
		$challan_no=$get_challan_no['MaxChallanNo']+1;
		
		$top=5;
		$page=0;
		for($c=0;$c<$len;$c++){
		
		$BranchNameQuery ="select *from aibl_others_rqst where others_collecting_branch_code='$id[$c]'"; 	
		//$BranchNameQuery ="select *from aibl_chq_rqst where collecting_branch_code='4009'"; 	
		$BranchNameResult=mysql_query($BranchNameQuery);
		$row1 =mysql_fetch_assoc($BranchNameResult);
							
		$cur_date=date('F d, Y');
		$ref_date=date('ym');
		
		$worksheet->write($page+0+$top, 0,$cur_date, $topRow);
		$worksheet->write($page+1+$top, 1, "NO.NW/CB/aibl/EMAIL".$ref_date.($challan_no+$c), $topRow);
		$worksheet->write($page+2+$top, 0, "To",$topRow);				
		$worksheet->write($page+3+$top, 0, "Manger",$topRow);
		$worksheet->write($page+4+$top, 0,$row1[others_collecting_branch].' Branch',$topRow);
		$worksheet->write($page+5+$top, 0, "United Commercial Bank Ltd.",$topRow);
		$worksheet->write($page+10+$top, 3, "DELIVERY CHALLAN", $abRow);
		
							
        $worksheet->write($page+11+$top, 0, "Sl #", $titleRow);
        $worksheet->write($page+11+$top, 1, "Item Name", $titleRow);
        $worksheet->write($page+11+$top, 2, "Start No", $titleRow);       
		$worksheet->write($page+11+$top, 3, "Books X Lvs", $titleRow);          
        $worksheet->write($page+11+$top, 4, "End No", $titleRow);
		$worksheet->write($page+11+$top, 5, "Qty. of Books", $titleRow);
        $worksheet->write($page+11+$top, 6, "Status", $titleRow);
       
       	
		
		
		$g_total=mysql_fetch_assoc(mysql_query("select sum(others_books) as g_total from aibl_others_rqst where others_collecting_branch_code='$id[$c]' and others_rqst_status='ordered'"));
		$g_p_total=mysql_fetch_assoc(mysql_query("select sum(others_books) as g_p_total from aibl_others_rqst where others_collecting_branch_code='$id[$c]' and others_rqst_status='ordered' and others_severity='Priority'"));
		
		$no_PO=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_PO from aibl_others_rqst where others_collecting_branch_code='$id[$c]' and others_rqst_status='ordered' and item_type='PO'"));
		$no_DD=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_DD from aibl_others_rqst where others_collecting_branch_code='$id[$c]' and others_rqst_status='ordered' and item_type='DD'"));
		$no_SDR=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_SDR from aibl_others_rqst where others_collecting_branch_code='$id[$c]' and others_rqst_status='ordered' and item_type='SDR'"));
		$no_FDD=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_FDD from aibl_others_rqst where others_collecting_branch_code='$id[$c]' and others_rqst_status='ordered' and item_type='FDD'"));
		$no_FDR=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_FDR from aibl_others_rqst where others_collecting_branch_code='$id[$c]' and others_rqst_status='ordered' and item_type='FDR'"));
						
		$no_p_PO=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_p_PO from aibl_others_rqst where others_collecting_branch_code='$id[$c]' and others_rqst_status='ordered' and others_severity='Priority' and item_type='PO'"));
		$no_p_DD=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_p_DD from aibl_others_rqst where others_collecting_branch_code='$id[$c]' and others_rqst_status='ordered' and others_severity='Priority' and item_type='DD'"));
		$no_p_SDR=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_p_SDR from aibl_others_rqst where others_collecting_branch_code='$id[$c]' and others_rqst_status='ordered' and others_severity='Priority' and item_type='SDR'"));
		$no_p_FDD=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_p_FDD from aibl_others_rqst where others_collecting_branch_code='$id[$c]' and others_rqst_status='ordered' and others_severity='Priority' and item_type='FDD'"));
		$no_p_FDR=mysql_fetch_assoc(mysql_query("select sum(others_books) as no_p_FDR from aibl_others_rqst where others_collecting_branch_code='$id[$c]' and others_rqst_status='ordered' and others_severity='Priority' and item_type='FDR'"));
		
	   
	   $i=12+$top;
	   $sl=1;
	  
	   $query ="select *from aibl_others_rqst where others_collecting_branch_code='$id[$c]' and others_rqst_status='ordered' order by others_collecting_branch asc, item_type desc, others_start_no asc, others_total_leaf asc, others_approval_date_time desc";  	
	   $result=mysql_query($query);	 
																																						
	   while ($row =mysql_fetch_assoc($result))
		{	
		
				$date=str_replace('-','/',$row['others_approval_date_time']); 
				$date=date('M d, Y h:i a', strtotime($date));
								
                $worksheet->write($page+$i, 0, "$sl", $commonRow);
                $worksheet->write($page+$i, 1, "$row[item_type]", $cusName);                
                $worksheet->write($page+$i, 2, "$row[others_start_no]", $commonRow);
                $worksheet->write($page+$i, 3, "$row[others_books]"."X"."$row[others_total_leaf]", $commonRow);
				$worksheet->write($page+$i, 4, "$row[others_end_no]", $commonRow);
				$worksheet->write($page+$i, 5, "$row[others_books]", $commonRow);
				$worksheet->write($page+$i, 6, "$row[others_severity]", $commonRow);
						            
       		$i++;
			$sl++;
	    }
		//$worksheet->mergeCells($page+$i,0,$page+$i+3,6);
		
		if($no_PO['no_PO']>0) $no_PO=" PO Books: $no_PO[no_PO]"; else $no_PO=" ";  
		if($no_DD['no_DD']>0) $no_DD=" DD Books: $no_DD[no_DD]"; else $no_DD=" "; 
		if($no_SDR['no_SDR']>0) $no_SDR=" SDR Books: $no_SDR[no_SDR]"; else $no_SDR=" "; 
		if($no_FDD['no_FDD']>0) $no_FDD=" FDD Books: $no_FDD[no_FDD]"; else $no_FDD=" "; 
		if($no_FDR['no_FDR']>0) $no_FDR=" FDR Books: $no_FDR[no_FDR]"; else $no_FDR=" "; 
		
		if($no_p_PO['no_p_PO']>0) $no_p_PO="(P- $no_p_PO[no_p_PO])  "; else $no_p_PO=" ";  
		if($no_p_DD['no_p_DD']>0) $no_p_DD="(P- $no_p_DD[no_p_DD])  "; else $no_p_DD=" "; 
		if($no_p_SDR['no_p_SDR']>0) $no_p_SDR="(P- $no_p_SDR[no_p_SDR])  "; else $no_p_SDR=" "; 
		if($no_p_FDD['no_p_FDD']>0) $no_p_FDD="(P- $no_p_FDD[no_p_FDD])  "; else $no_p_FDD=" "; 
		if($no_p_FDR['no_p_FDR']>0) $no_p_FDR="(P- $no_p_FDR[no_p_FDR])  "; else $no_p_FDR=" "; 
		
		
		$sumRow =& $workbook->addFormat();			
		$sumRow->setSize(10);	
		//$sumRow->setMerge(($page+$i), 0, ($page+$i), 9);
		$sumRow->setBorder(0);			
		$worksheet->write($page+$i, 0,"Total Quantity - $g_total[g_total]: ".$no_PO.$no_p_PO."  ".$no_DD.$no_p_DD."  ".$no_SDR.$no_p_SDR."  ".$no_FDD.$no_p_FDD."  ".$no_FDR.$no_p_FDR."  ".$no_MTD.$no_p_MTD,$sumRow);
								
		$worksheet->write($page+55+2, 0, " ______________________", $topRow);	
		$worksheet->write($page+55+3, 0, " Authorized Signature ", $topRow);	
		
		$worksheet->write($page+55+2, 5, "_________________________", $topRow);	
		$worksheet->write($page+55+3, 5, "Received By", $topRow);
		$worksheet->write($page+55+4, 5, "(Name, Designation & Seal)", $topRow);	
		
		$page=$page+61;
		}
		
		$worksheet->hideGridLines();
        $workbook->send($cllanch_date.'_aibl_Others_Challan.xls');
        $workbook->close();
?>



