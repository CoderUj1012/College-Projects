<?php


$mysqli= new mysqli("localhost", "root", "", "alumni");

if ($mysqli->connect_errno) 
{
	echo "Failed to connect to MySQL: (". $db->connect_errno . ") " . $db->connect_error;
}




$username=$_POST["textfield"];
$password=$_POST["textfield2"];

$sql="select uname,pwd from  adminlogin where uname ='{$username}' and  pwd= '{$password}'";
$found=0;
//$result=$mysqli->query("select  * from admin where unam=".$uname);
$result=$mysqli->query($sql);
//" and "." pwd=".$pword);

if($result ->num_rows == 1)
{	
	$found=1;
}
	if($found==1 )
	{
		setcookie("user",$username);
	
		header('Location:admin.php');
	}
	else
	{
		header('Location:invalid1.php');
	}




?>