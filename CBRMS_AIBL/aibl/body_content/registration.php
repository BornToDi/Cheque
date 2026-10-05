<script type="text/javascript">
function deletes(id)
{
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='delete.php?id='+id;
     }
	 
}
</script>	
<style>
table{margin-top:10;border:1px solid gray}
td{padding:5px}
</style>

<?php 
include_once ('config.php');

extract($_POST);
if(isset($save))
{
//check user already exists
$que=mysql_query("select email from student where email='$e'");
//return the records
$row=mysql_num_rows($que);
if($row)
{
echo "<font color='red'>This email id is  alredy exists</font>";
}
else
{
//hobbies
$hob=implode(",",$arr);

mysql_query("insert into student values('','$n','$e','$m','$gen','$hob','$cou',now())");

echo "<font color='blue'>Records saved</font>";
}
}


	echo "<table border='1'>";
	echo "<Tr><th>Stu_Id</th><th>Name</th><th>Email</th><th>Mobile</th><th>Gender</th><th>Hobbies</th><th>Country</th><th>Reg_Date</th><th>Delete</th><th>Update</th></tr>";
	
	
	$que = mysql_query("select *  from student");
	while($obj=mysql_fetch_object($que))
	{
	echo "<Tr>";
	echo "<td>".$obj->id."</td>";
	echo "<td>".$obj->name."</td>";	
	echo "<td>".$obj->email."</td>";
	echo "<td>".$obj->mob."</td>";
	echo "<td>".$obj->gender."</td>";
	echo "<td>".$obj->hobbies."</td>";
	echo "<td>".$obj->country."</td>";
	
	echo "<td>".$obj->regDate."</td>";
	//confirm before deletion
	?>
	<Td><a href="javascript:deletes(<?php echo $obj->id; ?>)">Delete</a></Td>
	<?php 
	echo "<Td><a href='update.php?eid=$obj->email'>Update</a> &nbsp;</td>";	
	
	echo "</tr>";
	}
	echo "</table>";


?>
<html>
	<head>
		<title>Registration Form</title>
	

	</head>
	<body>
		<form method="post" enctype="multipart/form-data">
			<table border="0" style="">
				<Tr>
					<th>Enter Your  name</th>
					<Td><input type="text" name="n"/></td>
				</tr>
				<Tr>
					<th>Enter Your  Email</th>
					<Td><input type="email" name="e"/></td>
				</tr>
				<Tr>
					<th>Enter Your  Mobile</th>
					<Td><input  type="number" name="m"/></td>
				</tr>
				<Tr>
					<th>Select Your gender</th>
					<Td>
					Male<input value="m"  type="radio" name="gen"/>
					Female<input type="radio" name="gen" value="f"/>
					</td>
				</tr>
				<Tr>
					<th>Choose Your hobbies</th>
					<Td>
					Reading<input  type="checkbox" name="arr[]" value="reading"/>
					Singing<input type="checkbox" name="arr[]" value="singing"/>
					Playing<input type="checkbox" name="arr[]" value="playing"/>
					
					</td>
				</tr>
				<Tr>
					<th>Select Your Country</th>
					<Td>
					<select name="cou">
						<option value="">Select Country</option>
						<option>India</option>
						<option>Pakistan</option>
						<option>China</option>
						<option>United State</option>
					</select>
					</td>
				</tr>
				
				<Tr>
					<Td colspan="2" align="center">
					<input type="submit" name="save" value="Save"/>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>