<? 
include_once ('../config.php');
include_once ('../tex_common.php'); 
$errmsg = " ";
if (isset($_POST['submit']))
 	{	
 	$user_id = mysql_real_escape_string(strtoupper($_POST["username"]));
 	$pass = md5($_POST['password']); 
	//$pass = $_POST['password']; 
	 	
 	$query = "select * from aibl_login where user_id= '$user_id'"; 	 	
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
			//if (($data_query[1]==$user_id && $data_query[2]==$pass && $data_query[7]==1 && $data_query[13]==0))
			if ($data_query && $data_query[1]==$user_id && $data_query[2]==$pass && $data_query[7]==1 && $data_query[13]==0)
				{
				session_register('username');
				session_register("userid");	
				session_register("user_id");
				session_register("user_email");			
				session_register("pass");
				session_register("password");
				$_SESSION['username'] = $user_id;
				$_SESSION['password'] = $pass;
				session_register("branch_name");
				session_register("branch_code");
				session_register("branch_user_name");
				session_register("vendor_name");
				session_register("user_type");
				$access_id = $data_query[0];
				$_SESSION['userid'] = $data_query[0];	
				$_SESSION['user_id'] = $data_query[1];			
				$_SESSION['pass'] = $data_query[2];
				$_SESSION['branch_code'] = $data_query[3];
				$_SESSION['branch_name'] = $data_query[4];
				$_SESSION['branch_user_name'] = $data_query[5];	
				$_SESSION['user_email'] = $data_query[6];			
				
				$_SESSION['user_type'] = $data_query[8];				
				session_regenerate_id(true); header("Location: set_password.php"); exit;
			}	
			
			//else if (($data_query[1]==$user_id && $data_query[2]==$pass && $data_query[7]==1 && $data_query[13]==1))
			else if ($data_query && $data_query[1]==$user_id && $data_query[2]==$pass && $data_query[7]==1 && $data_query[13]==1)
				{
				session_register('username');
				session_register("userid");	
				session_register("user_id");
				session_register("user_email");			
				session_register("pass");
				session_register("password");
				$_SESSION['username'] = $user_id;
				$_SESSION['password'] = $pass;
				session_register("branch_name");
				session_register("branch_code");
				session_register("branch_user_name");
				session_register("vendor_name");
				session_register("user_type");
				$access_id = $data_query[0];
				$_SESSION['userid'] = $data_query[0];	
				$_SESSION['user_id'] = $data_query[1];			
				$_SESSION['pass'] = $data_query[2];
				$_SESSION['branch_code'] = $data_query[3];
				$_SESSION['branch_name'] = $data_query[4];
				$_SESSION['branch_user_name'] = $data_query[5];	
				$_SESSION['user_email'] = $data_query[6];			
				
				$_SESSION['user_type'] = $data_query[8];				
				session_regenerate_id(true); header("Location: index.php?option=aibl_start"); exit;
			}	
			
			else
				{
				$errmsg ="Invalid password or User Id";					
			}	
		}
	}
	

require_once __DIR__.'/../ui/shell.php';
$uiLoginPortal = 'bank';
include __DIR__.'/../ui/login.php';
?>