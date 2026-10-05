<?php
include_once ("../../config.php");
require_once 'Spreadsheet/Excel/Writer.php';
$challan_date_from=$_POST['challan_date_from'];
$challan_date_to=$_POST['challan_date_to'];	

$date_from=date('Y-m-d', strtotime($challan_date_from));	
$date_to=date('Y-m-d', strtotime($challan_date_to));						
							//$date_to=date('Y-m-d', strtotime($order_date_to));	

// attempt a connection

//setTextWrap ()

        $workbook = new Spreadsheet_Excel_Writer();
		        
        $worksheet =& $workbook->addWorksheet('aibl_Summery_Report');		
							
		$worksheet->setPaper(9);		
		//$worksheet->setPortrait();
		$worksheet->setLandscape();
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
		
		$worksheet->setColumn(0,0,17); 
		$worksheet->setColumn(1,1,20); 
		$worksheet->setColumn(2,2,10); 
		$worksheet->setColumn(3,3,3);		 	
		$worksheet->setColumn(4,4,3); 
		$worksheet->setColumn(5,5,3);
		$worksheet->setColumn(6,6,3);
		$worksheet->setColumn(7,7,3); 
		$worksheet->setColumn(8,8,3);
		$worksheet->setColumn(9,9,3);
		$worksheet->setColumn(10,10,3); 
		$worksheet->setColumn(11,11,3);
		$worksheet->setColumn(12,12,5); 
		$worksheet->setColumn(13,13,3);
		$worksheet->setColumn(14,14,3); 
		$worksheet->setColumn(15,15,3);
		$worksheet->setColumn(16,16,3);
		$worksheet->setColumn(17,17,3); 
		$worksheet->setColumn(18,18,3);
		$worksheet->setColumn(19,19,3);
		$worksheet->setColumn(20,20,3); 			
		$worksheet->setColumn(21,21,5);
		
		
		
		
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
		$titleRow->setAlign('right');			
		$titleRow->setBold();		
		$titleRow->setBorder(1);		
		
		
		$commonRow =& $workbook->addFormat();	
		$commonRow->setAlign('top');
		$commonRow->setAlign('right');
		$commonRow->setSize(8);			
		$commonRow->setBorder(1);		
		
		$statusTitle =& $workbook->addFormat();			
		//$statusTitle->setPattern(6);	
		$statusTitle->setAlign('right');	
		$statusTitle->setSize(8);
		$statusTitle->setBold();	
		$statusTitle->setBorder(1);
		
		$statusRow =& $workbook->addFormat();			
		$statusRow->setSize(8);	
		$statusRow->setAlign('right');	
		$statusRow->setBorder(1);
		
		
		$title =& $workbook->addFormat();
		$title->setAlign('left');
		$title->setSize(8);	
		//$title->setTextWrap();		
		$title->setBorder(1);
		
		
		
		$top=5;
		$page=0;
		$cur_date=date('F d, Y');
		$ref_date=date('ym');
		$date = date('F d, Y', mktime(0, 0, 0, date('m'), date('d') + 3, date('Y')));
		$worksheet->write($page+2, 1, "AIBL Summery Report", $topRow);
		$worksheet->write($page+3, 1, $cur_date, $topRow);
							
        $worksheet->write($top, 0, "Sl #", $title);
		$worksheet->write($top, 1, "Branch Name", $title);
		//$worksheet->write($top, 1, "Challan No.", $title);
		$worksheet->write($top, 2, "Challan Date", $title);
        $worksheet->write($top, 3, "Remarks", $titleRow);
		//$worksheet->write($top, 4, "CD", $titleRow);
       
		
       
        //$worksheet->write($top, 5, "Total", $titleRow);
		$g_total=mysql_fetch_assoc(mysql_query("select sum(books) as g_total from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered'"));
		$g_p_total=mysql_fetch_assoc(mysql_query("select sum(books) as g_p_total from aibl_chq_rqst where collecting_branch_code='$id[$c]' and rqst_status='ordered' and severity='Priority'"));
       
    
	   $i=6;
	   $sl=1;
	   	  
	  $no_sb=mysql_fetch_assoc(mysql_query("select sum(books) as no_sb from aibl_chq_rqst where rqst_status='ordered' and ac_type='10' and total_leaf=20"));
		$no_cd=mysql_fetch_assoc(mysql_query("select sum(books) as no_cd from aibl_chq_rqst where rqst_status='ordered' and ac_type='11' and total_leaf=50"));
	   	
		
		$result=mysql_query("select *from aibl_chq_rqst where rqst_status='ordered' GROUP BY collecting_branch");	
																																														
			
			
			//$total_10=0; $total_11=0; $total_cd_25=0; $total_cd_50=0; $total_po=0; $total_dd=0; $total_fdd=0; $total_sdr=0; $total_fdr=0; $total_total=0; 
			while ($row =mysql_fetch_assoc($result))
				{	
				
				$get_challan_no = mysql_fetch_array(mysql_query("select MAX(challan_no) AS MaxChallanNo from del_challan"));	
		$challan_no=$get_challan_no['MaxChallanNo']+1;									  		
				
				//if(($row['challan_date'])!=0){
				//$challan_date=str_replace('-','/',$row['challan_date']); 
				//$date=date('d-M-Y', strtotime($challan_date));	
				//$challan_no="NW/CB/aibl/MICR/EMAIL/".date('ym', strtotime($challan_date)).$row['challan_no'];
				//}
																		
                $worksheet->write($i, 0, "$sl", $title);
				$worksheet->write($i, 1, "$row[collecting_branch]", $title);
				//$worksheet->write($i, 2, "$challan_no", $title);
				$worksheet->write($i, 2, "$row[rqst_date]", $title);
                //$worksheet->write($page+3+$top, 3, "$g_total[g_total]", $titleRow);
				$worksheet->write($page+$i+1, 3, "$no_sb[no_sb]", $statusRow);
				$worksheet->write($page+3+$top, 3, "$no_50_cd[no_50_cd]", $titleRow);	
				//$worksheet->write($i, 5, "$row[CD]", $commonRow);
                
				
                
				//$worksheet->write($i, 6, "$row[total]", $commonRow);
				
				
				$total_sb+=$row[sb];
				$total_imp+=$row[imp];
				$total_cd_25+=$row[cd_25];
				$total_cd_50+=$row[cd_50];	
							
				$total_po+=$row[po];
				$total_dd+=$row[dd];
				$total_sdr+=$row[sdr];
				$total_fdr+=$row[fdr];
				$total_fdd+=$row[fdd];
				$total_total+=$row[total];
				

       		$i++;
			$sl++;
	    }
		//$worksheet->mergeCells($page+$i,0,$page+$i+3,6);
		
		$leaves_sb='20';
		$leaves_imp='20';
		$leaves_cd_25='25';
		$leaves_cd_50='50';
		;
		$leaves_po='100';	
		$leaves_dd='100';
		$leaves_fdd='100';
		$leaves_sdr='100';
		$leaves_fdr='100';
		
		
		
		//$worksheet->write($i, 2, "Grand Total (Books Qty)", $statusTitle);
		//$worksheet->write($i, 3, "$total_sb", $statusTitle);
		//$worksheet->write($i, 4, "$total_cd", $statusTitle);
		
		
		
		//$worksheet->write($i, 5, "$total_total", $statusTitle);		
			

					
		
										
		$worksheet->write($i+12, 0, " ______________________", $topRow);	
		$worksheet->write($i+13, 0, " Authorized Signature ", $topRow);	
				
		$cllanch_date=date('d-m-y');
		$worksheet->hideGridLines();
        $workbook->send($cur_date.'_AIBL_Summery_Report.xls');
        $workbook->close();
?>



