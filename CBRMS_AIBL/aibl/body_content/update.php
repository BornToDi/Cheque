<?php 
include_once ('config.php');

$que=mysql_query("select * from student where email='".$_GET['eid']."'");
$res=mysql_fetch_array($que);

extract($_POST);
if(isset($update))
{
//hobbies
$hob=implode(",",$arr);
	
	mysql_query("update student set name='$n',mob='$m',gender='$gen',hobbies='$hob',country='$cou' where email='".$_GET['eid']."'");
	header('location:registration.php');
	
}


?>

<html>
	<head>
		<title>Registration Form</title>
		<style>
table{margin-top:10;border:1px solid gray}
td{padding:5px}
</style>
	</head>
	<body>
		<form method="post" enctype="multipart/form-data">
			<table border="0">
				<Tr>
					<th>Enter Your  name</th>
					<Td><input type="text" name="n" value="<?php echo $res['name'];?>"/></td>
				</tr>
				<Tr>
					<th>Enter Your  Email</th>
					<Td><input type="email" name="e" readonly="readonly" value="<?php echo $res['email'];?>"/></td>
				</tr>
				<Tr>
					<th>Enter Your  Mobile</th>
					<Td><input  type="number" name="m" value="<?php echo $res['mob'];?>"/></td>
				</tr>
				<Tr>
					<th>Select Your gender</th>
					<Td>
					
					Male<input value="m"  type="radio" name="gen"  <?php if($res['gender']=="m"){echo "checked";}?>/>
					Female<input <?php if($res['gender']=="f"){echo "checked";}?> type="radio" name="gen" value="f"/>
					</td>
				</tr>
				
				<Tr>
					<Td colspan="2" align="center">
					<input type="submit" name="update" value="Update"/>

					</td>
				</tr>
			</table>
		</form>
	</body>
</html>