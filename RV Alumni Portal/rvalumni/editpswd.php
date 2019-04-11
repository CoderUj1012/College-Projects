<?php
	
$uname=$_COOKIE["user"];
	
	
$op=$_POST["textfield"];
$np=$_POST["textfield3"];
$cp=$_POST["textfield2"];

/////////////////
$mysqli= new mysqli("localhost", "root", "", "alumni");

if ($mysqli->connect_errno) 
{
	echo "Failed to connect to MySQL: (". $db->connect_errno . ") " . $db->connect_error;
}

$sql="select * from  signup where email ='{$uname}' and  password= '{$op}'";
//echo $sql;
$found=0;
$result=$mysqli->query($sql);


if($result ->num_rows == 1)
{	
	$found=1;
}





////////////////////
if($np==$cp  && $found==1)
{


	$con = mysqli_connect("localhost", "root", "");
	mysqli_select_db($con,"alumni");

$query="update signup set password='{$np}'  where email='{$uname}'";

//echo $query;

mysqli_query($con,$query);

	
	
			//echo("Password  Updated Successfully" ."<h1>");
			header('Location:sucssupdt.php');
						
		//	echo("<h4 align=center><a href=sucssupdt.php><br></a></h4>");
			



	
}

else
{
//	echo "<h1 align=center> Some thing Wrong Please try again </h1>";
				header('Location:unsucssupdt.php');
}





?>