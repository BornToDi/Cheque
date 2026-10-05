<?php

$url=$_SERVER['REQUEST_URI'];
header("Refresh: 60; URL=$url"); 
	

	
if ($handle = opendir('inbox')) {

    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
             
			if(is_dir($entry)){
				echo $entry.' is a filder. so skiped. <br />';
				}else {
					echo $entry.' is a file call omr function to decode <br /><hr>';
					dec_omr($entry);
					}
        }
    
	
	}
	
	
	
    closedir($handle);
}





function dec_omr($file)
{

	echo 'upload file --->'.$file.'<br/>';

////////////////////////////////////////////////////////////////


$handle = @fopen("$file", "r");

if ($handle) {
    while (($line = fgets($handle, 4096)) !== false)
	 {
		
		$part = (explode('|',$line));
		
       
		$omr_status = trim(mysql_real_escape_string($part[0]));
		$omr_roll = trim(mysql_real_escape_string($part[1]));
		$omr_setcode = trim(mysql_real_escape_string($part[2]));
		$omr_district = trim(mysql_real_escape_string($part[3]));
		$omr_answer = trim(mysql_real_escape_string($part[4]));
		$omr_contact = trim(mysql_real_escape_string($part[5]));
		$omr_gender = trim(mysql_real_escape_string($part[6]));
		
		

    }
   
   
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }

}


	
///////////////////////////////////////////////////////////////
	

$srcfile='inbox'."/".$file;
$dstfile='upload'."/".$file;

copy($srcfile, $dstfile);
unlink('inbox'."/".$file);
	
	
///////////////////////////////////////////////////////////////

	
echo 'upload done file '.$file.'<br />'.'<br />'.'<br />';
	
	
	} //function end
?>
