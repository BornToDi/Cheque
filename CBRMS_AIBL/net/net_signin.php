<? 
include_once ('../config.php');
include_once ('../tex_common.php'); 
$errmsg = " ";
if (isset($_POST['submit']))
 	{
 	$user_id = mysql_real_escape_string($_POST['user_id']);
 	$pass = $_POST['pass']; 
 	
 	$query = "select * from net_user where user_name='$user_id'"; 
 	$query_exec = mysql_query($query);
	$data_query = mysql_fetch_row($query_exec);
	
 	if (empty($user_id))
 		{
  		$errmsg = "User Id Empty!";
	}
	elseif (empty($pass))
		{
			$errmsg = "Password Empty!";
	}
	
	if (empty($errmsg) || $errmsg==" ")
		{
			if ($data_query[3]==$pass && $data_query[4]==1)
				{
				session_register("access_id");	
				session_register("user_id");
				session_register("user_name");			
				session_register("pass");				
				session_register("net_user_type");
				$access_id = $data_query[0];
				$_SESSION['access_id'] = $data_query[0];	
				$_SESSION['user_name'] = $data_query[1];			
				$_SESSION['user_pass'] = $data_query[3];				
				$_SESSION['net_user_type'] = $data_query[5];
				session_regenerate_id(true); header("Location: index.php?option=aibl_start"); exit;
			}	
			else
				{
				$errmsg ="Invalid password or User Id!!!";					
			}	
		}
	}
	

require_once __DIR__.'/../ui/shell.php';
$uiLoginPortal = 'vendor';
include __DIR__.'/../ui/login.php';
?>