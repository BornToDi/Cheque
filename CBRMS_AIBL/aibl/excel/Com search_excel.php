<?
//include('connect.php');
$id=$_REQUEST['id'];	
$len=count($id);
$objConnect = mysql_connect("localhost","root","") or die("Error Connect to Database");
$objDB = mysql_select_db("cbrms_aibl");

//*** Get Document Path ***//
$strPath = realpath(basename(getenv($_SERVER["SCRIPT_NAME"]))); // C:/AppServ/www/myphp

//*** Excel Document Root ***//
$strFileName = "CBRMS_Orderlist.xls"; 

//*** Connect to Excel.Application ***//
$xlApp = new COM("Excel.Application");
$xlBook = $xlApp->Workbooks->Add();


//*** Create Sheet 1 ***//
$xlBook->Worksheets(1)->Name = "CBRMS";
$xlBook->Worksheets(1)->Select;



 //Here, we set more Print Setup properties
   //$xlApp->ActiveSheet->PageSetup->LeftHeader = CompanyNamE;
   //$xlApp->ActiveSheet->PageSetup->CenterHeader = ReportName;
   $xlApp->ActiveSheet->PageSetup->RightHeader ="Page: " . "&P of &N";
  
   $xlApp->ActiveSheet->PageSetup->LeftMargin = $xlApp->Application->InchesToPoints(0.50);
   $xlApp->ActiveSheet->PageSetup->RightMargin = $xlApp->Application->InchesToPoints(0.0);
   $xlApp->ActiveSheet->PageSetup->TopMargin = $xlApp->Application->InchesToPoints(1);
   $xlApp->ActiveSheet->PageSetup->BottomMargin = $xlApp->Application->InchesToPoints(0.5);
   $xlApp->ActiveSheet->PageSetup->HeaderMargin = $xlApp->Application->InchesToPoints(0.5);
   $xlApp->ActiveSheet->PageSetup->FooterMargin = $xlApp->Application->InchesToPoints(0);
  
    
   /* $xlApp->ActiveSheet->PageSetup->PrintHeadings = False;
    $xlApp->ActiveSheet->PageSetup->PrintGridlines = True;  //False    
    $xlApp->ActiveSheet->PageSetup->CenterHorizontally = False;
    $xlApp->ActiveSheet->PageSetup->CenterVertically = False;
    */
	//LANDSCAPE  xlPortrait
    
	/*$xlApp->ActiveSheet->PageSetup->Draft = False;
    $xlApp->ActiveSheet->PageSetup->FirstPageNumber = 1;       //xlAutomatic
    //$xlApp->ActiveSheet->PageSetup->Order = xlDownThenOver;
    $xlApp->ActiveSheet->PageSetup->BlackAndWhite = False;
	*/
    //$xlApp->ActiveSheet->PageSetup->Zoom = 80;  //Reduce to 80% when printing

	$xlApp->ActiveSheet->PageSetup->PaperSize = 9; 
	$xlApp->ActiveSheet->PageSetup->Orientation = 2; 
	
	//$xlApp->ActiveSheet->PrintArea = "$I$2:$J$17";
	//$xlApp.ActiveSheet.Range("A2:C2").WrapText = True
	//$xlApp.ActiveSheet.Range("A2:C2").RowHeight = 24



//*** Width & Height (A1:A1) ***//

$xlApp->ActiveSheet->Range("A1:A1")->ColumnWidth = 12.0;
$xlApp->ActiveSheet->Range("B1:B1")->ColumnWidth = 12.0;
$xlApp->ActiveSheet->Range("C1:C1")->ColumnWidth = 27.0;
$xlApp->ActiveSheet->Range("D1:D1")->ColumnWidth = 7.0;
$xlApp->ActiveSheet->Range("E1:E1")->ColumnWidth = 4.0;
$xlApp->ActiveSheet->Range("F1:F1")->ColumnWidth = 9.0;
$xlApp->ActiveSheet->Range("G1:G1")->ColumnWidth = 8.0;
$xlApp->ActiveSheet->Range("H1:H1")->ColumnWidth = 6.0;
$xlApp->ActiveSheet->Range("I1:I1")->ColumnWidth = 8.0;
$xlApp->ActiveSheet->Range("J1:J1")->ColumnWidth = 9.0;
$xlApp->ActiveSheet->Range("K1:K1")->ColumnWidth = 9.0;
$xlApp->ActiveSheet->Range("L1:L1")->ColumnWidth = 15.0;


/*$xlApp->ActiveSheet->Range("A1:A1")->Font->Size = 7.5;
$xlApp->ActiveSheet->Range("B1:B1")->Font->Size = 7.5;
$xlApp->ActiveSheet->Range("C1:C1")->Font->Size = 7.5;
$xlApp->ActiveSheet->Range("D1:D1")->Font->Size = 7.5;
$xlApp->ActiveSheet->Range("E1:E1")->Font->Size = 7.5;
$xlApp->ActiveSheet->Range("F1:F1")->Font->Size = 7.5;
$xlApp->ActiveSheet->Range("G1:G1")->Font->Size = 7.5;
$xlApp->ActiveSheet->Range("H1:H1")->Font->Size = 7.5;
$xlApp->ActiveSheet->Range("I1:I1")->Font->Size = 7.5;
$xlApp->ActiveSheet->Range("J1:J1")->Font->Size = 7.5;
$xlApp->ActiveSheet->Range("K1:K1")->Font->Size = 7.5;
$xlApp->ActiveSheet->Range("L1:L1")->Font->Size = 7.5;
*/
/*
$xlApp->ActiveSheet->Range("A1:A2")->MergeCells = True;
$xlApp->ActiveSheet->Range("B1:B2")->MergeCells = True;
$xlApp->ActiveSheet->Range("B1:B2")->MergeCells = True;
$xlApp->ActiveSheet->Range("C1:C2")->MergeCells = True;
$xlApp->ActiveSheet->Range("D1:D2")->MergeCells = True;
$xlApp->ActiveSheet->Range("E1:E2")->MergeCells = True;
*/
//*** Report Title ***//
/*
$xlApp->ActiveSheet->Range("A1:F1")->MergeCells = True;
$xlApp->ActiveSheet->Range("A1:F1")->Font->Bold = True;
$xlApp->ActiveSheet->Range("A1:F1")->Font->Size = 12;
$xlApp->ActiveSheet->Range("A1:F1")->HorizontalAlignment = -4108;
$xlApp->ActiveSheet->Cells(1,1)->Value = "United Commercial Bank Ltd.";

$xlApp->ActiveSheet->Range("A2:F2")->MergeCells = True;
$xlApp->ActiveSheet->Range("A2:F2")->HorizontalAlignment = -4108;
$xlApp->ActiveSheet->Cells(2,1)->Value = "Cheque Book Request Managment System";
*/


$xlApp->ActiveSheet->Range("A1")->Value = "Branch Name :".$_SESSION['branch_name'];


$xlApp->ActiveSheet->Range("F1")->Font->Bold = True;
$xlApp->ActiveSheet->Range("F1")->Font->Size = 12;
$xlApp->ActiveSheet->Range("F1")->Value = "United Commercial Bank Ltd.";

$xlApp->ActiveSheet->Range("A2")->Value = "User Name:".$_SESSION['branch_user_name'];

$xlApp->ActiveSheet->Range("F2")->HorizontalAlignment = -4108;
$xlApp->ActiveSheet->Range("F2")->Value = "Cheque Book Request Managment System";

$xlApp->ActiveSheet->Range("L1")->HorizontalAlignment = -4152;
$xlApp->ActiveSheet->Range("L1")->Value = "Date:".date("M d, Y");

$xlApp->ActiveSheet->Range("L2")->HorizontalAlignment = -4152;
$xlApp->ActiveSheet->Range("L2")->Value = "Total Request:".$len;


//*** Header ***//
$xlApp->ActiveSheet->Cells(3,1)->Value = "Approved Date";
$xlApp->ActiveSheet->Cells(3,1)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells(3,1)->Font->Bold = True;
$xlApp->ActiveSheet->Cells(3,1)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells(3,2)->Value = "Account No.";
$xlApp->ActiveSheet->Cells(3,2)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells(3,2)->Font->Bold = True;
$xlApp->ActiveSheet->Cells(3,2)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells(3,3)->Value = "Customer Name";
$xlApp->ActiveSheet->Cells(3,3)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells(3,3)->Font->Bold = True;
$xlApp->ActiveSheet->Cells(3,3)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells(3,4)->Value = "A/C Type";
$xlApp->ActiveSheet->Cells(3,4)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells(3,4)->Font->Bold = True;
$xlApp->ActiveSheet->Cells(3,4)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells(3,5)->Value = "Books";
$xlApp->ActiveSheet->Cells(3,5)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells(3,5)->Font->Bold = True;
$xlApp->ActiveSheet->Cells(3,5)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells(3,6)->Value = "Srart/End No.";
$xlApp->ActiveSheet->Cells(3,6)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells(3,6)->Font->Bold = True;
$xlApp->ActiveSheet->Cells(3,6)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells(3,7)->Value = "Branch";
$xlApp->ActiveSheet->Cells(3,7)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells(3,7)->Font->Bold = True;
$xlApp->ActiveSheet->Cells(3,7)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells(3,8)->Value = "Del. Type";
$xlApp->ActiveSheet->Cells(3,8)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells(3,8)->Font->Bold = True;
$xlApp->ActiveSheet->Cells(3,8)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells(3,9)->Value = "Status";
$xlApp->ActiveSheet->Cells(3,9)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells(3,9)->Font->Bold = True;
$xlApp->ActiveSheet->Cells(3,9)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells(3,10)->Value = "Maker ID";
$xlApp->ActiveSheet->Cells(3,10)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells(3,10)->Font->Bold = True;
$xlApp->ActiveSheet->Cells(3,10)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells(3,11)->Value = "Checker ID";
$xlApp->ActiveSheet->Cells(3,11)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells(3,11)->Font->Bold = True;
$xlApp->ActiveSheet->Cells(3,11)->BORDERS->Weight = 2;


$xlApp->ActiveSheet->Cells(3,12)->Value = "Customer Signatute";
$xlApp->ActiveSheet->Cells(3,12)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells(3,12)->Font->Bold = True;
$xlApp->ActiveSheet->Cells(3,12)->BORDERS->Weight = 2;


//***********//

$intRows = 4;

for($i=0;$i<$len;$i++)
{
$strSQL ="select *from aibl_chq_rqst where rqst_id='$id[$i]'";
$objQuery = mysql_query($strSQL);


$objResult = mysql_fetch_array($objQuery);
//while($objResult = mysql_fetch_array($objQuery))
//*** Detail ***//
$date=str_replace('-','/',$objResult['approval_date_time']); 		
if($objResult['ac_no_branch']!=4027)
	$ac_no=$objResult['ac_no_branch']."-".$objResult['ac_no_cus_no']."-".$objResult['ac_no_suffix'];
else	
	$ac_no=$objResult['ac_no_branch']."-".$objResult['ac_no_suffix']."-".$objResult['ac_no_cus_no']; 

$xlApp->ActiveSheet->Cells($intRows,1)->Value = date('M d, Y h:i a', strtotime($date));
$xlApp->ActiveSheet->Cells($intRows,1)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells($intRows,1)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells($intRows,2)->Value = $ac_no;
$xlApp->ActiveSheet->Cells($intRows,2)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells($intRows,2)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells($intRows,3)->Value = $objResult["cus_name"];
$xlApp->ActiveSheet->Cells($intRows,3)->WrapText = True;
$xlApp->ActiveSheet->Cells($intRows,3)->Font->Size = 7.0;
$xlApp->ActiveSheet->Cells($intRows,3)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells($intRows,4)->Value = $objResult['ac_type']."-".$objResult['total_leaf'];
$xlApp->ActiveSheet->Cells($intRows,4)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells($intRows,4)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells($intRows,5)->Value = $objResult["books"];
$xlApp->ActiveSheet->Cells($intRows,5)->HorizontalAlignment = -4108;
$xlApp->ActiveSheet->Cells($intRows,5)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells($intRows,5)->BORDERS->Weight = 2;
//$xlApp->ActiveSheet->Cells($intRows,5)->NumberFormat = "$#,##0.00";

$xlApp->ActiveSheet->Cells($intRows,6)->Value = $objResult['start_no']." / ".($objResult['end_no']-$objResult['start_no']+1);
$xlApp->ActiveSheet->Cells($intRows,6)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells($intRows,6)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells($intRows,7)->Value = ucwords(strtolower(strtok($objResult['collecting_branch'], " ")));
$xlApp->ActiveSheet->Cells($intRows,7)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells($intRows,7)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells($intRows,8)->Value = $objResult["severity"];
$xlApp->ActiveSheet->Cells($intRows,8)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells($intRows,8)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells($intRows,9)->Value = $objResult["rqst_status"];
$xlApp->ActiveSheet->Cells($intRows,9)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells($intRows,9)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells($intRows,10)->Value = ucwords(strtolower($objResult['rqst_by']));
$xlApp->ActiveSheet->Cells($intRows,10)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells($intRows,10)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells($intRows,11)->Value = ucwords(strtolower($objResult['approve_by']));
$xlApp->ActiveSheet->Cells($intRows,11)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells($intRows,11)->BORDERS->Weight = 2;

$xlApp->ActiveSheet->Cells($intRows,12)->Value = "";
$xlApp->ActiveSheet->Cells($intRows,12)->Font->Size = 7.5;
$xlApp->ActiveSheet->Cells($intRows,12)->BORDERS->Weight = 2;

$intRows++;
}

$xlApp->ActiveSheet->Range("A".($intRows+2))->Value = "		    __________________________";
$xlApp->ActiveSheet->Range("A".($intRows+3))->Value = "		             Account Opening";

$xlApp->ActiveSheet->Range("K".($intRows+2))->Value = "__________________________";
$xlApp->ActiveSheet->Range("K".($intRows+3))->Value = "	      Manager/Sub Manager";

@unlink($strFileName); //*** Delete old files ***//

$xlBook->SaveAs($strPath."/".$strFileName); //*** Save to Path ***//
//$xlBook->SaveAs(realpath($strFileName)); //*** Save to Path ***//

//*** Close & Quit ***//
$xlApp->Application->Quit();
$xlApp = null;
$xlBook = null;
$xlSheet1 = null;



mysql_close($objConnect);
header("Content-Disposition: attachment;filename=$strFileName");
readfile($strPath."/".$strFileName);

?>
