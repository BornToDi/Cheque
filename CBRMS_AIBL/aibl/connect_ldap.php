<?php	
session_start();
?>
<htmL>
<body>
This area is restricted.<br>
Please login to continue.<br>

<form method='post' action='<?php echo $_SERVER["PHP_SELF"]; ?>'>
<input type='hidden' name='name' value='<?php echo $_SESSION["username"]; ?>'>
<input type='hidden' name='pass' value='<?php echo $_SESSION["password"]; ?>'>
<input type='hidden' name='oldform' value='1'>

Username: <input type='text' name='username'><br>


<br>

<input type='submit' name='submit' value='Submit'><br>
<?php if ($failed){ echo ("<br>Login Failed!<br><br>\n"); } ?>
</form>

<?php if ($logout=="yes") { echo ("<br>You have successfully logged out."); } ?>

<a href="authenticate.php">Logout</a>
</body>

</html>
<?
$ldaphost = "aibl.org";  // your ldap servers
$ldapport = 389;                // your ldap server's port number

// Connecting to LDAP
$ds = ldap_connect($ldaphost, $ldapport)
         or die("Could not connect to $ldaphost");

if ($_POST["oldform"]){
$adname=$_POST['username'];
if ($ds) { 
	
	ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

    
    $r=ldap_bind($ds, $_POST["name"] . "@aibl.org", $_POST["pass"]);     // this is an "anonymous" bind, typically
                           // read-only access
    

    // Search surname entry
	$base_dn = "DC=aibl,DC=org";
	
    $sr=ldap_search($ds, $base_dn, "(samaccountname=$adname)");
	

    
    $info = ldap_get_entries($ds, $sr);
   

    for ($i=0; $i<$info["count"]; $i++) {
        echo "dn is: " . $info[$i]["dn"] . "<br />";
        echo "first cn entry is: " . $info[$i]["cn"][0] . "<br />";
		echo "first user entry is: " . $info[$i]["samaccountname"][0] . "<br />";
        echo "first email entry is: " . $info[$i]["mail"][0] . "<br /><hr />";
    }

 
    ldap_close($ds);

} else {
    echo "<h4>Unable to connect to LDAP server</h4>";
}
}
?>

