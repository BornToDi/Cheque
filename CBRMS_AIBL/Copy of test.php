<?php
$url=$_SERVER['REQUEST_URI'];
header("Refresh: 5; URL=$url"); 

if ($handle = opendir('inbox')) 
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
	
$srcfile='inbox'."/".$file;
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
		for($j=5;$j<=count($data->sheets[$i][cells]);$j++) // loop used to get each row of the sheet
		{ 
			$html.="<tr>";
			for($k=1;$k<=count($data->sheets[$i][cells][$j]);$k++) // This loop is created to get data in a table format.
			{
				$html.="<td>";
				$html.=$data->sheets[$i][cells][$j][$k];
				$html.="</td>";
			}
			$data->sheets[$i][cells][$j][1];
			$account =  mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][2]);
			$start = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][3]);
			$leaf = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][4]);
			$end = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][5]);
			$micr = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][6]);
			$routing = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][7]);
			$trans = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][8]);
			$holder = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][9]);
			$branch = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][10]);
			$type = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][11]);
			$bname = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][12]);
			$print = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][13]);
			$file = mysqli_real_escape_string($connection,$data->sheets[$i][cells][$j][14]);
			
			$query = "insert into excel(account,start,leaf,end,micr,routiing,trans,holder,branch,type,bname,print,file) values('".$account."', '".$start."', '".$leaf."', '".$end."', '".$micr."', '".$routing."', '".$trans."', '".$holder."', '".$branch."', '".$type."', '".$bname."', '".$print."','".$file."')";
			
			mysqli_query($connection,$query);
			$html.="</tr>";
		}
	}
	
}

$html.="</table>";
echo $html;
echo "<br />Data Inserted in dababase";

$srcfile1='inbox'."/".$file;
$dstfile1= 'done'."/".$file;
copy($srcfile1, $dstfile1);
	
unlink($file);
unlink('inbox'."/".$file);
///////////////////////////////////////////////////////////////

	
echo 'upload done file '.$file.'<br />'.'<br />'.'<br />';
	
	
	} //function end
?>