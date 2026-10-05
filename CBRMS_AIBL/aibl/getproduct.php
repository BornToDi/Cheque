<?php 
include_once ('../config.php');
$pro=$_GET['p'];
	
	$pro_query  ="select *from aibl_product where pro_code ='$pro'";
	$pro_result = mysql_query($pro_query) or
    die('Server Connection Error!');
	$get_pro=mysql_fetch_assoc($pro_result);


	if((mysql_num_rows($pro_result)!=0))
	{	
		echo "<b>$get_pro[pro_name]</b>";		
	}
	else 
	echo "";  
?>
