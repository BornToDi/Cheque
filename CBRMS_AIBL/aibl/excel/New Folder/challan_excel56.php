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
		$worksheet->setColumn(1,1,25);
		$worksheet->setColumn(2,2,13); 
		$worksheet->setColumn(3,3,8);
		$worksheet->setColumn(4,4,11); 
		$worksheet->setColumn(5,5,8);
		$worksheet->setColumn(6,6,8); 
		
		
		
		
		
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
		$titleRow->setSize(7.5);	
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
		
		$BranchNameQuery ="select *from aibl_chq_rqst where ac_no_branch='$id[$c]'"; 	
		//$BranchNameQuery ="select *from aibl_chq_rqst where ac_no_branch='4009'"; 	
		$BranchNameResult=mysql_query($BranchNameQuery);
		$row1 =mysql_fetch_assoc($BranchNameResult);
		
		//$challan_no=$challan_no+$c;					
		$cur_date=date('F d, Y');
		$ref_date=date('ym');
		
		$worksheet->write($page+0+$top, 0,$cur_date, $topRow);
		$worksheet->write($page+1+$top, 1, "NO.NW/CB/aibl/EMAIL/".$ref_date.($challan_no+$c), $topRow);
		$worksheet->write($page+2+$top, 0, "To",$topRow);				
		$worksheet->write($page+3+$top, 0, "Manger",$topRow);
		$worksheet->write($page+4+$top, 0,$row1[collecting_branch],$topRow);
		$worksheet->write($page+5+$top, 0, "United Commercial Bank Ltd.",$topRow);
		$worksheet->write($page+7+$top, 3, "DELIVERY CHALLAN", $abRow);
		
							
        $worksheet->write($page+8+$top, 0, "Sl #", $titleRow);
        $worksheet->write($page+8+$top, 1, "Account Name.", $titleRow);
        $worksheet->write($page+8+$top, 2, "Account No.", $titleRow);
        $worksheet->write($page+8+$top, 3, "Start No", $titleRow);  
		$worksheet->write($page+8+$top, 4, "Books X Leaves", $titleRow);          
        $worksheet->write($page+8+$top, 5, "End No", $titleRow);
		$worksheet->write($page+8+$top, 6, "A/C Type", $titleRow);
        $worksheet->write($page+8+$top, 7, "Status", $titleRow);
       
       	
		
		$g_total=mysql_fetch_assoc(mysql_query("select sum(books) as g_total from aibl_chq_rqst where ac_no_branch='$id[$c]' and rqst_status='ordered'"));
		
		
		$no_sb=mysql_fetch_assoc(mysql_query("select sum(books) as no_sb from aibl_chq_rqst where ac_no_branch='$id[$c]' and rqst_status='ordered' and ac_type='savings'"));
		$no_imp=mysql_fetch_assoc(mysql_query("select sum(books) as no_imp from aibl_chq_rqst where ac_no_branch='$id[$c]' and rqst_status='ordered' and ac_type='imperial'"));
		$no_25_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_25_cd from aibl_chq_rqst where ac_no_branch='$id[$c]' and rqst_status='ordered' and ac_type='current' and total_leaf=25"));
		$no_50_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_50_cd from aibl_chq_rqst where ac_no_branch='$id[$c]' and rqst_status='ordered' and ac_type='current' and total_leaf=50"));		
			
	   
	   $i=9+$top;
	   $sl=1;
	   //$query ="select *from aibl_chq_rqst where ac_no_branch='$id[$c]' and rqst_status='ordered' order by collecting_branch desc, ac_type desc, total_leaf asc, approval_date_time desc";  	
	   $result=mysql_query("select *from aibl_chq_rqst where ac_no_branch='$id[$c]' and rqst_status='ordered' order by collecting_branch asc, ac_type desc, start_no asc, total_leaf asc, approval_date_time desc");						
		
		//$result=mysql_query($query);	 
																																						
			while ($row =mysql_fetch_assoc($result))
				{										  		
				$date=str_replace('-','/',$row['order_date_time']); 
				$date=date('M d, Y h:i a', strtotime($date));				
				$ac_no=$row['ac_no_branch'].'-'.$row['ac_no_suffix'].'-'.$row['ac_no_cus_no'];															
                $worksheet->write($page+$i, 0, "$sl", $commonRow);
                $worksheet->write($page+$i, 1, "$row[cus_name]", $cusName);
                $worksheet->write($page+$i, 2, "$ac_no", $commonRow);
                $worksheet->writeString($page+$i, 3, "$row[start_no]", $commonRow);
                $worksheet->write($page+$i, 4, "$row[books]". "X" ."$row[total_leaf]", $commonRow);
				$worksheet->writeString($page+$i, 5, "$row[end_no]", $commonRow);
				$worksheet->write($page+$i, 6, "$row[ac_type]", $commonRow);
				$worksheet->write($page+$i, 7, "$row[severity]", $commonRow);
						            
       		$i++;
			$sl++;
	    }
		//$worksheet->mergeCells($page+$i,0,$page+$i+3,6);
		
		$worksheet->write($page+$i, 0, " ", $statusTitle);
		$worksheet->write($page+$i, 1, "Savings", $statusTitle);
		$worksheet->write($page+$i, 2, "Imperial", $statusTitle);
		$worksheet->write($page+$i, 3, "Current-25", $statusTitle);	
		$worksheet->write($page+$i, 4, "Current-50", $statusTitle);	
		
		$worksheet->write($page+$i, 5, "Grant Total", $statusTitle);	
		
		$worksheet->write($page+$i+1, 0, "Total", $statusTitle);
		$worksheet->write($page+$i+1, 1, "$no_sb[no_sb]", $statusRow);
		$worksheet->write($page+$i+1, 2, "$no_imp[no_imp]", $statusRow);
		$worksheet->write($page+$i+1, 3, "$no_25_cd[no_25_cd]", $statusRow);
		$worksheet->write($page+$i+1, 4, "$no_50_cd[no_50_cd]", $statusRow);	
					
		$worksheet->write($page+$i+1, 5, "$g_total[g_total]", $statusRow);	
		
		
		
		
				
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
		
		
		}
		$cllanch_date=date('d-m-y');
		$worksheet->hideGridLines();
        $workbook->send($cllanch_date.'_aibl_Challan.xls');
        $workbook->close();
?>



