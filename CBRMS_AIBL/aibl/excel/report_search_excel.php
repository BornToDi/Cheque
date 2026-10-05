<?php
include_once ("../../config.php");

require_once 'Spreadsheet/Excel/Writer.php';
$id=$_REQUEST['id'];	
$len=count($id);
// attempt a connection

//setTextWrap ()

        $workbook = new Spreadsheet_Excel_Writer();
		        
        $worksheet =& $workbook->addWorksheet('CRRMS');		
		
		$worksheet->hideGridlines();
		$worksheet->setPaper(9);		
		$worksheet->setLandscape();
		//$worksheet->setMargins(0.6);
		$worksheet->setMarginLeft(0.75);
		$worksheet->setMarginRight(0.2);
		$worksheet->setMarginTop(0.5);
		$worksheet->setMarginBottom(0.5);
		//$worksheet->setHPagebreaks();
		//$worksheet->setVPagebreaks();
		
		$worksheet->setColumn(0,0,14); 
		$worksheet->setColumn(1,1,12);
		$worksheet->setColumn(2,2,26); 
		$worksheet->setColumn(3,3,26);
		$worksheet->setColumn(4,4,30); 
		$worksheet->setColumn(5,5,11);
		$worksheet->setColumn(6,6,30); 
		$worksheet->setColumn(7,7,6);
		$worksheet->setColumn(8,8,8); 
		$worksheet->setColumn(9,9,9);
		$worksheet->setColumn(10,10,9); 
		$worksheet->setColumn(11,11,16);
		
		
		
		
		//Setup different styles
		//$sheetTitleFormat =& $workbook->addFormat(array('bold'=>1,'size'=>10));
		//$columnTitleFormat =& $workbook->addFormat(array('bold'=>1,'top'=>1,'bottom'=>1 ,'size'=>9));
		
		$topRow=& $workbook->addFormat();	
		$topRow->setSize(10);
	
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
		$commonRow->setSize(7.5);		
		$commonRow->setBorder(1);		
		
		
		$cusName =& $workbook->addFormat();
		$cusName->setAlign('top');
		$cusName->setSize(7);	
		$cusName->setTextWrap();		
		$cusName->setBorder(1);		
		//$query ="select *from aibl_chq_rqst";
		//$worksheet->write(0, 0, "Branch Name :".$_SESSION['branch_name'], $topRow);
		//$worksheet->write(1, 0, "User Name :".$_SESSION['branch_user_name'], $topRow);
		
		$worksheet->write(0, 2, "Networld Bangladesh Limited", $abRow);
		$worksheet->write(1, 2, "Delivery Challan for Reconcilation", $abRow);
		
		$worksheet->write(0, 4, "Date:".date("M d, Y"), $topRow);
		$worksheet->write(1, 4, "Total Request:".$len, $topRow);
		
        $worksheet->write(3, 0, "SL No.#", $titleRow);
		$worksheet->write(3, 1, "Rqst Br. Code", $titleRow);
		$worksheet->write(3, 2, "Account No.", $titleRow);
        $worksheet->write(3, 3, "Customer Name", $titleRow);
		$worksheet->write(3, 4, "Requesting Date", $titleRow);
        $worksheet->write(3, 5, "No. of Leaves", $titleRow);  
		$worksheet->write(3, 6, "Requesting Branch", $titleRow);
		
       
	   $i=4;
	   $sl=1;
	   for($j=0;$j<$len;$j++)
		{
		$query ="select *from aibl_chq_rqst where rqst_id='$id[$j]' order by collecting_branch desc, ac_type desc, total_leaf asc, approval_date_time desc";
		$result = mysql_query($query) or die('Error, query failed');
		$row=mysql_fetch_assoc($result);

        
       // while($row=mysql_fetch_assoc($result)){
		
				if(($row['approval_date_time'])!=0){
				$date=str_replace('-','/',$row['approval_date_time']); 
				$date=date('M d, Y h:i a', strtotime($date));								
				}
				else 
				$date= "Not yet approved";
				
				$ac_no=$row['ac_no_branch']."-".$row['ac_no_suffix']."-".$row['ac_no_cus_no'];
				$start_end=($row['end_no']-$row['start_no']+1);				
				$branch_name=strtok($row['collecting_branch'], " ");
				
                $worksheet->writeString($i, 0, "$sl", $commonRow);
				$worksheet->writeString($i, 1, "$row[collecting_branch_code]", $commonRow);
                $worksheet->write($i, 2, "$ac_no", $commonRow);
                $worksheet->write($i, 3, "$row[cus_name]", $cusName);
				$worksheet->write($i, 4, "$row[approval_date_time]", $commonRow);
                $worksheet->write($i, 5, "$row[total_leaf]", $commonRow);
				$worksheet->write($i, 6, "$row[collecting_branch]", $commonRow);
                            
       		$i++;
			$sl++;
	    }		
		$worksheet->write($i+2, 0, "		    __________________________ ", $topRow);	
		$worksheet->write($i+3, 0, "		             Account Opening ", $topRow);	
		
		$worksheet->write($i+2, 4, "__________________________", $topRow);	
		$worksheet->write($i+3, 4, "	      Manager/Sub Manager", $topRow);	
		
        $workbook->send('CBRMS_orderlist.xls');
        $workbook->close();
?>



