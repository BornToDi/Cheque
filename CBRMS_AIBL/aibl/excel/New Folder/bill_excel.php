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
		        
        $worksheet =& $workbook->addWorksheet('aibl_Bill');		
							
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
		
		$worksheet->setColumn(0,0,20); 
		$worksheet->setColumn(1,1,4);
		$worksheet->setColumn(2,2,4); 
		$worksheet->setColumn(3,3,4);
		$worksheet->setColumn(4,4,4);
		$worksheet->setColumn(5,5,4); 
		$worksheet->setColumn(6,6,4);
		$worksheet->setColumn(7,7,4);
		$worksheet->setColumn(8,8,4);
		$worksheet->setColumn(9,9,7);
		$worksheet->setColumn(10,10,4);
		$worksheet->setColumn(11,11,4);
		$worksheet->setColumn(12,12,4); 
		$worksheet->setColumn(13,13,4);
		$worksheet->setColumn(14,14,4);
		$worksheet->setColumn(15,15,4); 
		$worksheet->setColumn(16,16,4);
		$worksheet->setColumn(17,17,4);
		$worksheet->setColumn(18,18,5); 
		
		
		
		
		
		//Setup different styles
		//$sheetTitleFormat =& $workbook->addFormat(array('bold'=>1,'size'=>10));
		//$columnTitleFormat =& $workbook->addFormat(array('bold'=>1,'top'=>1,'bottom'=>1 ,'size'=>9));
		
		$topRow=& $workbook->addFormat();	
		$topRow->setSize(9);
		$topRow->setBold();	
	
		
		  
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
        $worksheet->write($top, 1, "SB", $titleRow);
        $worksheet->write($top, 2, "CD-25", $titleRow);
		$worksheet->write($top, 3, "CD-50", $titleRow);
        $worksheet->write($top, 4, "PO", $titleRow);  
		$worksheet->write($top, 5, "DD", $titleRow);   
		$worksheet->write($top, 6, "FDD", $titleRow);       
        $worksheet->write($top, 7, "FDR", $titleRow);
		$worksheet->write($top, 8, "SDR", $titleRow);
        $worksheet->write($top, 9, "Total", $titleRow);
		$worksheet->write($top, 10, "SB", $titleRow);
        $worksheet->write($top, 11, "CD-25", $titleRow);
		$worksheet->write($top, 12, "CD-50", $titleRow);
        $worksheet->write($top, 13, "PO", $titleRow);  
		$worksheet->write($top, 14, "DD", $titleRow);   
		$worksheet->write($top, 15, "FDD", $titleRow);       
        $worksheet->write($top, 16, "FDR", $titleRow);
		$worksheet->write($top, 17, "SDR", $titleRow);
		$worksheet->write($top, 18, "Priority", $titleRow);
       
    
	   $i=6;
	   $sl=1;
	   
	   //$result=mysql_query("select branch_name,SUM(sb) as sb,SUM(cd_25) as cd_25,SUM(po) as po,SUM(dd) as dd,SUM(fdd) as fdd,SUM(sdr) as sdr,SUM(fdr) as fdr,SUM(total) as total, SUM(priority) as priority from del_challan where challan_date between '$date_from' AND '$date_to' GROUP BY branch_name");								
	   $result=mysql_query("select branch_name,SUM(sb) as sb,SUM(cd_25) as cd_25,SUM(cd_50) as cd_50,SUM(po) as po,SUM(dd) as dd,SUM(fdd) as fdd,SUM(fdr) as fdr,SUM(sdr) as sdr,SUM(total) as total, SUM(priority) as priority, SUM(p_sb) as p_sb,SUM(p_cd_25) as p_cd_25,SUM(p_cd_50) as p_cd_50,SUM(p_po) as p_po,SUM(p_dd) as p_dd,SUM(p_fdd) as p_fdd,SUM(p_fdr) as p_fdr,SUM(p_sdr) as p_sdr from del_challan where challan_date between '$date_from' AND '$date_to' GROUP BY branch_name");
		
		//$result=mysql_query("select branch_name,SUM(sb) as sb,SUM(cd_25) as cd_25,SUM(po) as po,SUM(dd) as dd,SUM(sdr) as sdr,SUM(fdr) as fdr,SUM(total) as total, SUM(priority) as priority from del_challan where challan_date between '$date_from' AND '$date_to'");																																													
			$total_sb=0; $total_cd_25=0; $total_cd_50=0; $total_po=0; $total_dd=0; $total_fdd=0; $total_sdr=0; $total_fdr=0; $total_total=0; $total_priority=0;						
		    $total_p_sb=0; $total_p_cd_25=0; $total_p_cd_50=0; $total_p_po=0; $total_p_dd=0; $total_p_sdr=0; $total_p_fdr=0; $total_p_fdd=0; 
			
			while ($row =mysql_fetch_assoc($result))
				{										  		
																		
                $worksheet->write($i, 0, "$row[branch_name]", $title);
                $worksheet->write($i, 1, "$row[sb]", $commonRow);
                $worksheet->write($i, 2, "$row[cd_25]", $commonRow);
				$worksheet->write($i, 3, "$row[cd_50]", $commonRow);
                $worksheet->write($i, 4, "$row[po]", $commonRow);
                $worksheet->write($i, 5, "$row[dd]", $commonRow);
				$worksheet->write($i, 6, "$row[fdd]", $commonRow);
				$worksheet->write($i, 7, "$row[fdr]", $commonRow);
				$worksheet->write($i, 8, "$row[sdr]", $commonRow);				
				$worksheet->write($i, 9, "$row[total]", $commonRow);
				
				$worksheet->write($i, 10, "$row[p_sb]", $commonRow);
				$worksheet->write($i, 11, "$row[p_cd_25]", $commonRow);
				$worksheet->write($i, 12, "$row[p_cd_50]", $commonRow);			
				$worksheet->write($i, 13, "$row[p_po]", $commonRow);
				$worksheet->write($i, 14, "$row[p_dd]", $commonRow);
				$worksheet->write($i, 15, "$row[p_fdd]", $commonRow);
				$worksheet->write($i, 16, "$row[p_fdr]", $commonRow);
				$worksheet->write($i, 17, "$row[p_sdr]", $commonRow);
				
				$worksheet->write($i, 18, "$row[priority]", $commonRow);
				
				$total_sb+=	$row[sb];
				$total_cd_25+=$row[cd_25];
				$total_cd_50+=$row[cd_50];
				$total_po+=	$row[po];
				$total_dd+=	$row[dd];
				$total_fdd+= $row[fdd];
				$total_sdr+=$row[sdr];
				$total_fdr+=$row[fdr];
				$total_total+=$row[total];
				$total_priority+=$row[priority];
				
				$total_p_sb+=$row[p_sb];
				$total_p_cd_25+=$row[p_cd_25];
				$total_p_cd_50+=$row[p_cd_50];			
				$total_p_po+=$row[p_po];
				$total_p_dd+=$row[p_dd];
				$total_p_sdr+=$row[p_sdr];
				$total_p_fdr+=$row[p_fdr];
				$total_p_fdd+=$row[p_fdd];
			
					            
       		$i++;
			$sl++;
	    }
		//$worksheet->mergeCells($page+$i,0,$page+$i+3,6);
		
		$total_sb+=$row[sb];
		$total_cd_25+=$row[cd_25];
		$total_cd_50+=$row[cd_50];	
		$total_po+=$row[po];
		$total_dd+=$row[dd];
		$total_sdr+=$row[sdr];
		$total_fdr+=$row[fdr];
		$total_fdd+=$row[fdd];		
		$total_total+=$row[total];
		$total_priority+=$row[priority];
		
		$total_p_sb+=$row[p_sb];
		$total_p_cd_25+=$row[p_cd_25];
		$total_p_cd_50+=$row[p_cd_50];		
		$total_p_po+=$row[p_po];
		$total_p_dd+=$row[p_dd];
		$total_p_sdr+=$row[p_sdr];
		$total_p_fdr+=$row[p_fdr];
		$total_p_fdd+=$row[p_fdd];			
		
		$worksheet->write($i, 0, "Grand Total (Books Qty)", $statusTitle);
		$worksheet->write($i, 1, "$total_sb", $statusTitle);
		$worksheet->write($i, 2, "$total_cd_25", $statusTitle);
		$worksheet->write($i, 3, "$total_cd_50", $statusTitle);			
		$worksheet->write($i, 4, "$total_po", $statusTitle);
		$worksheet->write($i, 5, "$total_dd", $statusTitle);	
		$worksheet->write($i, 6, "$total_fdd", $statusTitle);
		$worksheet->write($i, 7, "$total_fdr", $statusTitle);
		$worksheet->write($i, 8, "$total_sdr", $statusTitle);				
		$worksheet->write($i, 9, "$total_total", $statusTitle);
		
		$worksheet->write($i, 10, "$total_p_sb", $statusTitle);
		$worksheet->write($i, 11, "$total_p_cd_25", $statusTitle);	
		$worksheet->write($i, 12, "$total_p_cd_50", $statusTitle);	
		$worksheet->write($i, 13, "$total_p_po", $statusTitle);
		$worksheet->write($i, 14, "$total_p_dd", $statusTitle);
		$worksheet->write($i, 15, "$total_p_fdd", $statusTitle);	
		$worksheet->write($i, 16, "$total_p_fdr", $statusTitle);
		$worksheet->write($i, 17, "$total_p_sdr", $statusTitle);					
		$worksheet->write($i, 18, "$total_priority", $statusTitle);		

		
		$leaves_sb='20';
		$leaves_cd_25='25';
		$leaves_cd_50='50';
		$leaves_po='100';	
		$leaves_dd='100';
		$leaves_fdd='100';
		$leaves_sdr='100';
		$leaves_fdr='100';
		
		$leaves_p_sb='20';
		$leaves_p_cd_25='25';
		$leaves_p_cd_50='50';		
		$leaves_p_po='100';
		$leaves_p_dd='100';
		$leaves_p_sdr='100';
		$leaves_p_fdd='100';
		$leaves_p_fdr='100';
		
		
		
		$worksheet->write($i+1, 0, "Leaves Per Book", $statusRow);
		$worksheet->write($i+1, 1, "$leaves_sb", $statusRow);
		$worksheet->write($i+1, 2, "$leaves_cd_25", $statusRow);
		$worksheet->write($i+1, 3, "$leaves_cd_50", $statusRow);			
		$worksheet->write($i+1, 4, "$leaves_po", $statusRow);	
		$worksheet->write($i+1, 5, "$leaves_dd", $statusRow);
		$worksheet->write($i+1, 6, "$leaves_fdd", $statusRow);
		$worksheet->write($i+1, 7, "$leaves_fdr", $statusRow);
		$worksheet->write($i+1, 8, "$leaves_sdr", $statusRow);			
		$worksheet->write($i+1, 9, "", $statusRow);	
		
		$worksheet->write($i+1, 10, "$leaves_p_sb", $statusRow);
		$worksheet->write($i+1, 11, "$leaves_p_cd_25", $statusRow);
		$worksheet->write($i+1, 12, "$leaves_p_cd_50", $statusRow);				
		$worksheet->write($i+1, 13, "$leaves_p_po", $statusRow);	
		$worksheet->write($i+1, 14, "$leaves_p_dd", $statusRow);
		$worksheet->write($i+1, 15, "$leaves_p_fdd", $statusRow);
		$worksheet->write($i+1, 16, "$leaves_p_fdr", $statusRow);
		$worksheet->write($i+1, 17, "$leaves_p_sdr", $statusRow);					
		$worksheet->write($i+1, 18, "", $statusRow);
						
		$worksheet->write($i+2, 0, "Total Leaves", $statusTitle);
		$worksheet->write($i+2, 1, $total_sb*$leaves_sb, $statusTitle);
		$worksheet->write($i+2, 2, $total_cd_25*$leaves_cd_25, $statusTitle);
		$worksheet->write($i+2, 3, $total_cd_50*$leaves_cd_50, $statusTitle);			
		$worksheet->write($i+2, 4, $total_po*$leaves_po, $statusTitle);
		$worksheet->write($i+2, 5, $total_dd*$leaves_dd, $statusTitle);
		$worksheet->write($i+2, 6, $total_fdd*$leaves_fdd, $statusTitle);
		$worksheet->write($i+2, 7, $total_fdr*$leaves_fdr, $statusTitle);	
		$worksheet->write($i+2, 8, $total_sdr*$leaves_sdr, $statusTitle);				
		$worksheet->write($i+2, 9, ($total_sb*$leaves_sb)+($total_cd_25*$leaves_cd_25)+($total_cd_50*$leaves_cd_50)+($total_std*$leaves_std)+($total_po*$leaves_po)+($total_dd*$leaves_dd)+($total_fdd*$leaves_fdd)+($total_sdr*$leaves_sdr)+($total_mtd*$leaves_mtd)+($total_fdr*$leaves_fdr), $statusTitle);
		
		$worksheet->write($i+2, 10, $total_p_sb*$leaves_p_sb, $statusTitle);
		$worksheet->write($i+2, 11, $total_p_cd_25*$leaves_p_cd_25, $statusTitle);
		$worksheet->write($i+2, 12, $total_p_cd_50*$leaves_p_cd_50, $statusTitle);			
		$worksheet->write($i+2, 13, $total_p_po*$leaves_p_po, $statusTitle);
		$worksheet->write($i+2, 14, $total_p_dd*$leaves_p_dd, $statusTitle);
		$worksheet->write($i+2, 15, $total_p_fdd*$leaves_p_fdd, $statusTitle);
		$worksheet->write($i+2, 16, $total_p_fdr*$leaves_p_fdr, $statusTitle);	
		$worksheet->write($i+2, 17, $total_p_sdr*$leaves_p_sdr, $statusTitle);					
		$worksheet->write($i+2, 18, ($total_p_sb*$leaves_p_sb)+($total_p_cd_25*$leaves_p_cd_25)+($total_p_cd_50*$leaves_p_cd_50)+($total_p_std*$leaves_p_std)+($total_p_po*$leaves_p_po)+($total_p_dd*$leaves_p_dd)+($total_p_fdd*$leaves_p_fdd)+($total_p_sdr*$leaves_p_sdr)+($total_p_mtd*$leaves_p_mtd)+($total_p_fdr*$leaves_p_fdr), $statusTitle);
										
		$worksheet->write($i+12, 0, " ______________________", $topRow);	
		$worksheet->write($i+13, 0, " Authorized Signature ", $topRow);	
				
		$cllanch_date=date('d-m-y');
		$worksheet->hideGridLines();
        $workbook->send($cllanch_date.'_Bill.xls');
        $workbook->close();
?>



