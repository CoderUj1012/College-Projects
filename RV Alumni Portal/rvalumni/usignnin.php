<?php


$mysqli= new mysqli("localhost", "root", "", "alumni");

if ($mysqli->connect_errno) 
{
	echo "Failed to connect to MySQL: (". $db->connect_errno . ") " . $db->connect_error;
}




$username=$_POST["textfield"];
$password=$_POST["textfield2"];

$sql="select email,password from  signup where email ='{$username}' and  password= '{$password}' and verify= 'Yes'";
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
		$db = new mysqli("localhost", "root", "", "alumni");

if ($db->connect_errno) {
echo "Failed to connect to MySQL: (" 
. $db->connect_errno . ") " . $db->connect_error;
}
		
		$sql="select * from signup where email='{$username}'"; 
$result_db = $db->query($sql) or die("Error!");
$all_result = $result_db->fetch_all();

foreach ($all_result as $row) 
{
	$s="";
	$fn="";
	$mn="";
	$ln="";
	$s=$row[9];
	$fn=$row[0];
	$mn=$row[1];
	$ln=$row[2];
	
}
		
		$fname="$fn"." "."$mn"." "."$ln";
		setcookie("user",$username);
		setcookie("photo",$s);
		setcookie("names",$fname);
		//echo $s;
		header('Location:user.php');
	}
	else
	{
		header('Location:invalid.php');
	}




?>
