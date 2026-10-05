<?

function checklogin($uname,$upass)
{
	$query = "select * from net_user where user_name = '$uname'"; 
 	$result = @mysql_query($query);
 	$row = @mysql_fetch_assoc($result); 			
	if ($row["user_pass"] == $upass)
	{
		session_register("user_id");
		session_register("user_name");
		session_register("user_email");
		session_register("user_fullname");
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['user_name'] = $row['user_name'];
		$_SESSION['user_fullname'] = $row['user_fullname'];
		$_SESSION['user_email'] = $row['user_email'];
 		//redirectJS( "user_account.php?name=$name&user_id=$user_id&user_fullname=$data_query[2]" );
		$set_user = true;
	}	
	else
	{
		$errmsg ="<font color=red>Invalid user name or password !!!</font>";
		print $errmsg;		
	}
}



function redirectUrl( $uri )
{
	?>
	<script language="javascript">
	document.location.href="<?php echo $uri ?>";
	</script>
	<?
}

?>
