<? 
include_once ('../config.php');
include_once ('../tex_common.php'); 
$errmsg = " ";
if (isset($_POST['submit']))
 	{	
 	$user_id = strtoupper($_POST["username"]);
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
			if (($data_query[1]==$user_id && $data_query[2]==$pass && $data_query[7]==1))
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
				redirectUrl("index.php?option=aibl_start");
			}	
			else
				{
				$errmsg ="Invalid password or User Id";					
			}	
		}
	}
	
?>	
<body onLoad="document.frm.username.focus();">	
<table height=100% width=100% align=center >

<tr>
<td colspan="2">
<form name="frm" method="POST" action="user_signin.php">
<table width=325 height="220" bgcolor="#FFFFFF" align="center" style="border: 1px solid #FF0000;" cellpadding="0" cellspacing="0">
	<tr><td  width="26%" height="20%"><img src="logo/net_logo.jpg" width="90" height="70" border="0"></td>
        <td width="74%" align="" bgcolor="#2852A1"><font color="#FFFFFF" size="3" face="Geneva, Arial, Helvetica, sans-serif"><b>Networld Bangladesh Limited </b></font><br>
        <font color="#FFFFFF" face="Verdana" size="1">&nbsp;&nbsp;&nbsp;&nbsp;<b>Online Cheque Requisition System</b></font>		</td>
    	</tr>
		
		<tr><td colspan="2" bgcolor="#FF0000" height="2">&nbsp;</td></tr>
		<tr><td colspan="2">
		<table width="100%" height="100%" bgcolor="#EEEEEE" cellpadding="0" cellspacing="0">
        <tr> 
        <td colspan="2" height="10%">&nbsp; </td>
        </tr>
        <tr>
        <td colspan="2" height="4" align="center"><? echo "<font color=red>".$errmsg."</font>"; ?></td>
        </tr>
        <tr> 
        <td align="left"><font face=verdana color=black size=2>&nbsp;&nbsp;&nbsp;Enter User Id: </font></td>
        <td><input type="text" name="username" style="font-family: Verdana; font-size: 8pt; color: black; border: 1px solid #AD998C; background-color: #ffffff" size=20>
        &nbsp;</td>
        </tr>
        <tr>
        <td align="left"><font face=verdana color=black size=2>&nbsp;&nbsp;&nbsp;Enter Password:</font></td>
        <td><input type=password name="password"  style="font-family: Verdana; font-size: 8pt; color: black; border: 1px solid #AD998C; background-color: #ffffff" size=20>&nbsp;</td>
        </tr>
        <tr> 
		<td>&nbsp;</td>
        <td><input type="submit" value="Sign In" name="submit" style="color: #000000; font-family: Verdana; font-size: 8pt; border: 1px solid #AD998C; background-color:#ECDACE"></td>
        </tr>
         <tr>
         <td colspan="2">
       			<center><font size=-2 face=Arial color:#003366>Copyright: Networld Bangladesh Ltd.&nbsp;Contact at <a href="mailto:sales@networld-bd.com">sales@networld-bd.com</a> for more information</font></center>
         </td>
         </tr>
      	</table>
		</td></tr>
     </table>
	</form>
	 </td>
    </tr>
</table>

