<?php


$f=$_POST["fileField"];
//echo $f;



$mysqli= new mysqli("localhost", "root", "", "alumni");

if ($mysqli->connect_errno) 
{
	echo "Failed to connect to MySQL: (". $db->connect_errno . ") " . $db->connect_error;
}





$mysqli= new mysqli("localhost", "root", "", "alumni");
if ($mysqli->connect_errno) 
{
	echo "Failed to connect to MySQL: (". $db->connect_errno . ") " . $db->connect_error;
}

$con= mysqli_connect("localhost","root","");
mysqli_select_db($con,"alumni");
$query= "insert into gallery values('$f')";
echo $query;
mysqli_query($con, $query);

echo"<h3 align= center>Submitted Successfully </h3>"; 
?>

