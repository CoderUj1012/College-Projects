<?php


$mysqli= new mysqli("localhost", "root", "", "alumni");

if ($mysqli->connect_errno) 
{
	echo "Failed to connect to MySQL: (". $db->connect_errno . ") " . $db->connect_error;
}




$f=$_POST["textfield"];
$m=$_POST["textfield2"];
$l=$_POST["textfield3"];
$g=$_POST["textfield7"];
$dob=$_POST["textfield6"];
$a=$_POST["textfield4"];
$c=$_POST["textfield5"];
$yop=$_POST["select"];
$photo=$_POST["textfield11"];
$e=$_POST["textfield9"];
$p=$_POST["textfield10"];

$mysqli= new mysqli("localhost", "root", "", "alumni");
if ($mysqli->connect_errno) 
{
	echo "Failed to connect to MySQL: (". $db->connect_errno . ") " . $db->connect_error;
}

$con= mysqli_connect("localhost","root","");
mysqli_select_db($con,"alumni");
$query= "insert into signup values('$f','$m','$l', '$g', '$dob', '$a' , '$e' , '$yop', '$c', '$photo', '$p','')";
echo $query;
mysqli_query($con, $query);

//echo"<h3 align= center>Submitted Successfully </h3>";

header('Location:signupsubmit.php');
?>

