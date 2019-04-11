<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Free website template from 4Templates.com</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
	@import url("layout.css");
-->
</style>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<h1 align="center">R V Alumni Portal</h1>
		<h2 align="center"> Autonomous Institution under Visvesvaraya Technological University, Belgavi</h2>
  </div>
	<div id="main-menu">
		<ul>
			<li class="first"></li><li></li>
		    <div align="center"><span class="first"><a href="user.php" id="main-menu2" accesskey="1" title="">Back</a></span>
	          </div>
		</ul>
  </div>
<div id="content">
  <div id="right">
			<h2 class="bigger">
			<?php 
			echo("<p align= center>Member details </p>");
			
			$search=$_POST["select2"];
			$search1=$_POST["textfield"];
			//$yp=$_POST["select"];
			if($search=="Year of passing")
			{
				$sql="select fname,mname,lname,dob,mobile,poyr,photo,email,branch from  signup where poyr='{$search1}' and verify='Yes'";			//echo $sql;			
			}
			else if($search=="FIRST NAME")
			{
				$sql="select fname,mname,lname,dob,mobile,poyr,photo,email ,branch from  signup where fname='{$search1}' and verify='Yes'";						
				//echo $sql;
			}
			$db = new mysqli("localhost", "root", "", "alumni");

if ($db->connect_errno) {
echo "Failed to connect to MySQL: (" 
. $db->connect_errno . ") " . $db->connect_error;
}


//echo $sql;
$result_db = $db->query($sql) or die("Error!");
$all_result = $result_db->fetch_all();

$table =
'<table border="5">
<tr>
<td>fullname</td>
<td>contact</td>
<td>yearofpassing</td>
<td>photo</td>
<td>email</td>
<td>Branch</td>

</tr>';

$fname="";
$mname="";
$lname="";
$gender="";

$address="";
$contact="";
$poyr="";
$photo="";
$email="";
$br1="";

foreach ($all_result as $row) 
{
$fname=$row[0];
$mname=$row[1];
$lname=$row[2];

$contact=$row[4];
$poyr=$row[5];
$photo=$row[6];
$email=$row[7];
$br1=$row[8];
$fname1="$fname"." "."$mname"." "."$lname";
	$table .= '<tr>'
	  . '<td>' .$fname1. '</td>'
  . '<td>' . $contact . '</td>'
				. '<td>' . $poyr . '</td>'
			. '<td><img src=' . $photo . ' width=75 height=75 ></img></td>'
				. '<td>' . $email . '</td>'
				. '<td>' . $br1 . '</td>'
		  	. '</td>'
	  . '</tr>';
}




$table .='</table>';
echo $table;


$db->close();
//echo("<h4 align=center><a href=homepage.html><br>Home Page</a></h4>");
/*echo("<form method=post action=dispatch.php>");
        echo("<table><tr><td><input type=submit value=Dispatch Policy></td></tr></table>"); */

?>
	
			
			
			
			
			&nbsp;</h2>
			<h2>&nbsp;</h2>
	</div>
	</div>
	<div class="hr1">
		<hr />
	</div>
	<div id="footer">
		<ul>
			<li><a href="#" title="">Home</a></li>
			<li></li><li><a href="#" title="">About Us</a></li>
            <li></li><li><a href="adlandmrk.html" title="">Landmark</a></li>
            <li></li><li><a href="signup.html" title="">Sign up</a></li>
            <li></li><li><a href="signin.html" title="">Sign in</a></li>
            <li></li><li><a href="usignin.html" title="">Sign in</a></li>
            
			<li><a href="#" title="">Contact Us</a></li>
		</ul>
		<p>Copyright &copy; 2016 rvce.edu.in. All rights reserved.</p>
  </div>
</div>
</body>
</html>

			<center><span style="width: 100%; font-family: helvetica; font-size: 6px;">
			Design downloaded from <a href="http://www.freewebtemplates.com" style="font-family: helvetica; font-size: 6px;">FreeWebTemplates.com</a><br>
			Free web design, web templates, web layouts, and website resources!
			</span></center><br><br>
		