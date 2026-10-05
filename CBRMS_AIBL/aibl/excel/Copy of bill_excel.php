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
		
		$worksheet->setColumn(0,0,20); 
		$worksheet->setColumn(1,1,7);
		$worksheet->setColumn(2,2,7); 
		$worksheet->setColumn(3,3,7);
		$worksheet->setColumn(4,4,7);
		$worksheet->setColumn(5,5,7); 
		$worksheet->setColumn(6,6,8);
		$worksheet->setColumn(7,7,8); 
		
		
		
		
		
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
		
		
		
		$top=2;
		
							
        $worksheet->write($top, 0, "Branch Name", $title);
        $worksheet->write($top, 1, "SB", $titleRow);
        $worksheet->write($top, 2, "CD_25", $titleRow);
		$worksheet->write($top, 3, "CD_50", $titleRow);
        $worksheet->write($top, 4, "PO", $titleRow);  
		$worksheet->write($top, 5, "DD", $titleRow);   
		$worksheet->write($top, 6, "FDD", $titleRow);       
        $worksheet->write($top, 7, "FDR", $titleRow);
		$worksheet->write($top, 8, "SDR", $titleRow);
        $worksheet->write($top, 9, "Total", $titleRow);
		$worksheet->write($top, 10, "Priority", $titleRow);
       
    
	   $i=3;
	   $sl=1;
	   
	   $result=mysql_query("select branch_name,SUM(sb) as sb,SUM(cd_25) as cd_25,SUM(cd_50) as cd_50,SUM(po) as po,SUM(dd) as dd,SUM(fd) as fd,SUM(sdr) as sdr,SUM(fdr) as fdr,SUM(total) as total, SUM(priority) as priority from del_challan where challan_date between '$date_from' AND '$date_to' GROUP BY branch_name");								
	   	
		//$result=mysql_query("select branch_name,SUM(sb) as sb,SUM(cd_20) as cd_20,SUM(po) as po,SUM(dd) as dd,SUM(sdr) as sdr,SUM(fdr) as fdr,SUM(total) as total, SUM(priority) as priority from del_challan where challan_date between '$date_from' AND '$date_to'");																																													
			$total_sb=0; $total_cd_25=0; $total_cd_50=0; $total_po=0; $total_dd=0; $total_fdd=0; $total_sdr=0; $total_fdr=0; $total_total=0; $total_priority=0;
			while ($row =mysql_fetch_assoc($result))
				{										  		
																		
                $worksheet->write($i, 0, "$row[branch_name]", $title);
                $worksheet->write($i, 1, "$row[sb]", $commonRow);
                $worksheet->write($i, 2, "$row[cd_25]", $commonRow);
				$worksheet->write($i, 3, "$row[cd_50]", $commonRow);
                $worksheet->write($i, 4, "$row[po]", $commonRow);
                $worksheet->write($i, 5, "$row[dd]", $commonRow);
				$worksheet->write($i, 6, "$row[fd]", $commonRow);
				$worksheet->write($i, 7, "$row[sdr]", $commonRow);
				$worksheet->write($i, 8, "$row[fdr]", $commonRow);
				$worksheet->write($i, 9, "$row[total]", $commonRow);
				$worksheet->write($i, 10, "$row[priority]", $commonRow);
				
				$total_sb+=	$row[sb];
				$total_cd_25+=$row[cd_25];
				$total_cd_50+=$row[cd_50];
				$total_po+=	$row[po];
				$total_dd+=	$row[dd];
				$total_fdd+= $row[fd];
				$total_sdr+=$row[sdr];
				$total_fdr+=$row[fdr];
				$total_total+=$row[total];
				$total_priority+=$row[priority];
					            
       		$i++;
			$sl++;
	    }
		//$worksheet->mergeCells($page+$i,0,$page+$i+3,6);
		
		$leaves_sb='20';
		$leaves_cd_25='25';
		$leaves_cd_50='50';
		$leaves_po='50';	
		$leaves_dd='50';
		$leaves_fdd='50';
		$leaves_sdr='50';
		$leaves_fdr='20';
		
		
		$worksheet->write($i, 0, "Grand Total (Books Qty)", $statusTitle);
		$worksheet->write($i, 1, "$total_sb", $statusTitle);
		$worksheet->write($i, 2, "$total_cd_25", $statusTitle);	
		$worksheet->write($i, 3, "$total_cd_50", $statusTitle);	
		$worksheet->write($i, 4, "$total_po", $statusTitle);
		$worksheet->write($i, 5, "$total_dd", $statusTitle);	
		$worksheet->write($i, 6, "$total_fdd", $statusTitle);	
		$worksheet->write($i, 7, "$total_sdr", $statusTitle);	
		$worksheet->write($i, 8, "$total_fdr", $statusTitle);	
		$worksheet->write($i, 9, "$total_total", $statusTitle);
		$worksheet->write($i, 10, "$total_priority", $statusTitle);		
		
		$worksheet->write($i+1, 0, "Leaves Per Book", $statusRow);
		$worksheet->write($i+1, 1, "$leaves_sb", $statusRow);
		$worksheet->write($i+1, 2, "$leaves_cd_25", $statusRow);	
		$worksheet->write($i+1, 3, "$leaves_cd_50", $statusRow);	
		$worksheet->write($i+1, 4, "$leaves_po", $statusRow);	
		$worksheet->write($i+1, 5, "$leaves_dd", $statusRow);
		$worksheet->write($i+1, 6, "$leaves_fdd", $statusRow);
		$worksheet->write($i+1, 7, "$leaves_sdr", $statusRow);
		$worksheet->write($i+1, 8, "$leaves_fdr", $statusRow);
		$worksheet->write($i+1, 9, "", $statusRow);
		$worksheet->write($i+1, 10, "", $statusRow);
		
		$worksheet->write($i+2, 0, "Total Leaves", $statusTitle);
		$worksheet->write($i+2, 1, $total_sb*$leaves_sb, $statusTitle);
		$worksheet->write($i+2, 2, $total_cd_25*$leaves_cd_25, $statusTitle);
		$worksheet->write($i+2, 3, $total_cd_50*$leaves_cd_50, $statusTitle);		
		$worksheet->write($i+2, 4, $total_po*$leaves_po, $statusTitle);
		$worksheet->write($i+2, 5, $total_dd*$leaves_dd, $statusTitle);	
		$worksheet->write($i+2, 6, $total_fdd*$leaves_fdd, $statusTitle);	
		$worksheet->write($i+2, 7, $total_sdr*$leaves_sdr, $statusTitle);	
		$worksheet->write($i+2, 8, $total_fdr*$leaves_fdr, $statusTitle);	
		$worksheet->write($i+2, 9, ($total_sb*$leaves_sb)+($total_cd_25*$leaves_cd_25)+($total_cd_50*$leaves_cd_50)+($total_po*$leaves_po)+($total_dd*$leaves_dd)+($total_fdd*$leaves_fdd)+($total_sdr*$leaves_sdr)+($total_fdr*$leaves_fdr), $statusTitle);
		$worksheet->write($i+2, 10, "", $statusTitle);		
										
		$worksheet->write($i+12, 0, " ______________________", $topRow);	
		$worksheet->write($i+13, 0, " Authorized Signature ", $topRow);	
				
		$cllanch_date=date('d-m-y');
		$worksheet->hideGridLines();
        $workbook->send($cllanch_date.'_Bill.xls');
        $workbook->close();
?>



