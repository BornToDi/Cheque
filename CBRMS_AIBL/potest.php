<?php
//$url=$_SERVER['REQUEST_URI'];
//header("Refresh: 10; URL=$url"); 
$page = $_SERVER['PHP_SELF'];
 $sec = "100";
 header("Refresh: $sec; url=$page");
 echo "Watch the page reload itself in 100 second!";

if ($handle = opendir('poinbox')) 
		{

    while (false !== ($entry = readdir($handle))) 
			{
        if ($entry != "." && $entry != "..") 
				{
             
				if(is_dir($entry))
				      {
							echo $entry.' is a filder. so skiped. <br />';
					  }
				else 
					  {
					  
						echo $entry.' is a Execl file is to decode <br /><hr>';
						dec_omr($entry);
						break; 
					   }
        		}
    
	
			}
	
	
	
    closedir($handle);
		}





function dec_omr($file)
{

	echo 'upload file --->'.$file.'<br/>';

	
///////////////////////////////////////////////////////////////
	
$srcfile='poinbox'."/".$file;
$dstfile= $file;
copy($srcfile, $dstfile);




error_reporting(0);
ini_set("display_errors",1);
require_once 'excel_reader2.php';
require_once 'db.php';


$data = new Spreadsheet_Excel_Reader($file);

echo "Total Sheets in this xls file: ".count($data->sheets)."<br /><br />";

$html="<table border='1'>";
for($i=0;$i<count($data->sheets);$i++) // Loop to get all sheets in a file.
{	
	if(count($data->sheets[$i][cells])>0) // checking sheet not empty
	{
		echo "Sheet $i:<br /><br />Total rows in sheet $i  ".count($data->sheets[$i][cells])."<br />";
		for($j=5;$j<=count($data->sheets[$i][cells])+1;$j++) // loop used to get each row of the sheet
		{ 
			echo $j;
			$html.="<tr>";
			for($k=0;$k<=count($data->sheets[$i][cells][$j]);$k++) // This loop is created to get data in a table format.
			{
				$html.="<td>";
				$html.=$data->sheets[$i][cells][$j][$k];
				$html.="</td>";
			}
			$data->sheets[$i][cells][$j][0];
			$account =  mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][2]);
			//$account =  substr($account1,-9);		
			$start = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][3]);
			$leaf = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][4]/100);
			$end = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][5]);
			$micr = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][6]);
			$routing = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][7]);
			$trans = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][8]);
			$holder = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][9]);
			$branch = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][10]);
			$type = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][11]);
			$bname = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][12]);
			//$print = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][13]);
			$stock = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][13]);
			//$book = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][14]/100);
			$book=substr($leaf,-100);
			//$sufix = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][14]);
			//$sufix=substr($account1,4,4);
			//$filename = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][14]);
			$others_approval_date_time=date("Y-m-d H:i:s a");
			$others_req_date=date("Y-m-d H:i:s a");
			$others_order_date_time=date("Y-m-d H:i:s a");


try {
   $pdo = new PDO('mysql:dbname=cbrms_aibl_auto;host=localhost', 'root', '');
} catch (PDOException $e) {
   die("ERROR: Could not connect: " . $e->getMessage());
}
			
$str_qury= "select account_no from aibl_others_rqst where others_account_no='$account' and others_start_no='$start' and others_total_leaf='$leaf'";

$result=$pdo->prepare($str_qury);
$result->execute();
 
$numrows=$result->rowCount();

if ($numrows<=0 && strlen($account)>1){
			$query = "insert into aibl_others_rqst(others_account_no,others_start_no,others_total_leaf,others_end_no,others_micr,others_routing_no,others_tran_code,others_cus_name,others_collecting_branch_code,item_type,others_collecting_branch,others_severity,others_rqst_status,others_rqst_by,others_approve_by,others_approval_date_time,file_name,stock_code,others_rqst_date,others_books,others_ac_no_branch,others_ac_no_cus_no,others_ac_no_suffix,others_order_date_time) values('".$account."', '".$start."', '100', '".$end."', '".$micr."', '".$routing."', '".$trans."', '".$holder."', '".$branch."', '".$type."', '".$bname."', 'Normal', 'Ordered', 'aibl', 'aibl', '".$others_approval_date_time."', '".$dstfile."','".$stock."', '".$others_req_date."', '".$book."', '".$branch."', '".$account."', '".$sufix."', '".$others_order_date_time."')";
			
			mysqli_query($connection,$query);
			$html.="</tr>";
}			
			
		}
	}
	
}


$html.="</table>";
echo $html;
echo "<br />Data Inserted in dababase";

$srcfile1='poinbox'."/".$file;
$dstfile1= 'podone'."/".$file;
copy($srcfile1, $dstfile1);
	
unlink($file);
unlink('poinbox'."/".$file);
///////////////////////////////////////////////////////////////

	
echo 'upload done file '.$file.'<br />'.'<br />'.'<br />';
	
	
	} //function end
?>