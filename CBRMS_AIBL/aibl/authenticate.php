<?php

//force the browser to use ssl (STRONGLY RECOMMENDED!!!!!!!!)
if ($_SERVER["SERVER_PORT"]!=443){ header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']); exit(); }

//you should look into using PECL filter or some form of filtering here for POST variables
$username=strtoupper($_POST["username"]); //remove case sensitivity on the username
$password=$_POST["password"];
$formage=$_POST["formage"];

if ($_POST["oldform"]){ //prevent null bind
include_once '../tex_common.php';
	if ($username!=NULL && $password!=NULL){
		//include the class and create a connection
		include ("adLDAP.php");
		$adldap = new adLDAP();
		$_SESSION["username"]=$username;
		//authenticate the user
	if ($adldap -> authenticate($username,$password)){
			//establish your session and redirect
			session_start();
			session_register('username');	
			session_register('password');
			session_register('user_type');
			$_SESSION['user_type'] = 'admin';
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			redirectUrl("index.php");
			
		}
		
	}
	$failed=1;
}

?>

<html>
<head>
<title>adLDAP example</title>
</head>

<body>

This area is restricted.<br>
Please login to continue.<br>

<form method='post' action='<?php echo $_SERVER["PHP_SELF"]; ?>'>
<input type='hidden' name='oldform' value='1'>

Username: <input type='text' name='username' value='<?php echo ($username); ?>'><br>
Password: <input type='password' name='password'><br>
<br>

<input type='submit' name='submit' value='Submit'><br>
<?php if ($failed){ echo ("<br>Login Failed!<br><br>\n"); } ?>
</form>

<?php if ($logout=="yes") { echo ("<br>You have successfully logged out."); } ?>


</body>

</html>

