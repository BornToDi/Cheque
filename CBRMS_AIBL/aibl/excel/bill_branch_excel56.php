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
		        
        $worksheet =& $workbook->addWorksheet('aibl_Branch_wise_Bill');		
							
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
		
							
        $worksheet->write($top, 0, "Branch Name", $title);
		$worksheet->write($top, 1, "Challan No.", $title);
		$worksheet->write($top, 2, "Challan Date", $title);
        $worksheet->write($top, 3, "SB", $titleRow);
		$worksheet->write($top, 4, "Imperial", $titleRow);
        $worksheet->write($top, 5, "CD-25", $titleRow);
		$worksheet->write($top, 6, "CD-50", $titleRow);
		
        $worksheet->write($top, 7, "PO", $titleRow);  
		$worksheet->write($top, 8, "DD", $titleRow);          
        $worksheet->write($top, 9, "FDD", $titleRow);
		$worksheet->write($top, 10, "FDR", $titleRow);
		$worksheet->write($top, 11, "SDR", $titleRow);
        $worksheet->write($top, 12, "Total", $titleRow);
		
       
    
	   $i=6;
	   $sl=1;
	   	  
	   $result_branch=mysql_query("select branch_name,SUM(sb) as sb,SUM(imp) as imp,SUM(cd_25) as cd_25,SUM(cd_50) as cd_50,SUM(po) as po,SUM(dd) as dd,SUM(fdd) as fdd,SUM(fdr) as fdr,SUM(sdr) as sdr,SUM(total) as total, from del_challan where challan_date between '$date_from' AND '$date_to' GROUP BY branch_name");
	   	
		
		$result=mysql_query("select *from del_challan where challan_date between '$date_from' AND '$date_to' order by branch_name");																																													
			
			
			$total_sb=0; $total_imp=0; $total_cd_25=0; $total_cd_50=0; $total_po=0; $total_dd=0; $total_fdd=0; $total_sdr=0; $total_fdr=0; $total_total=0; 
			while ($row =mysql_fetch_assoc($result))
				{										  		
				
				//if(($row['challan_date'])!=0){
				$challan_date=str_replace('-','/',$row['challan_date']); 
				$date=date('d-M-Y', strtotime($challan_date));	
				$challan_no="NW/CB/aibl/MICR/EMAIL/".date('ym', strtotime($challan_date)).$row['challan_no'];
				//}
																		
                $worksheet->write($i, 0, "$row[branch_name]", $title);
				$worksheet->write($i, 1, "$challan_no", $title);
				$worksheet->write($i, 2, "$date", $title);
                $worksheet->write($i, 3, "$row[sb]", $commonRow);
				$worksheet->write($i, 4, "$row[imp]", $commonRow);
                $worksheet->write($i, 5, "$row[cd_25]", $commonRow);
				$worksheet->write($i, 6, "$row[cd_50]", $commonRow);
				
                $worksheet->write($i, 7, "$row[po]", $commonRow);
                $worksheet->write($i, 8, "$row[dd]", $commonRow);
				$worksheet->write($i, 9, "$row[fdd]", $commonRow);
				$worksheet->write($i, 10, "$row[fdr]", $commonRow);
				$worksheet->write($i, 11, "$row[sdr]", $commonRow);
				$worksheet->write($i, 12, "$row[total]", $commonRow);
				
				
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
		
		
		
		$worksheet->write($i, 2, "Grand Total (Books Qty)", $statusTitle);
		$worksheet->write($i, 3, "$total_sb", $statusTitle);
		$worksheet->write($i, 4, "$total_imp", $statusTitle);
		$worksheet->write($i, 5, "$total_cd_25", $statusTitle);	
		$worksheet->write($i, 6, "$total_cd_50", $statusTitle);
		
		$worksheet->write($i, 7, "$total_po", $statusTitle);
		$worksheet->write($i, 8, "$total_dd", $statusTitle);
		$worksheet->write($i, 9, "$total_fdd", $statusTitle);	
		$worksheet->write($i, 10, "$total_fdr", $statusTitle);
		$worksheet->write($i, 11, "$total_sdr", $statusTitle);	
		$worksheet->write($i, 12, "$total_total", $statusTitle);		
			

					
		
										
		$worksheet->write($i+12, 0, " ______________________", $topRow);	
		$worksheet->write($i+13, 0, " Authorized Signature ", $topRow);	
				
		$cllanch_date=date('d-m-y');
		$worksheet->hideGridLines();
        $workbook->send($cllanch_date.'_Branch_wise_Bill.xls');
        $workbook->close();
?>



