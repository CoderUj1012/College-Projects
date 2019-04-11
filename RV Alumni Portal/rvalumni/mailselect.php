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
			<li class="first"><a href="verify.php" id="main-menu1" accesskey="1" title="">Verify</a></li>
			<li></li>
			<li></li>
			<li></li>
			<li><a href="gallery.php" id="main-menu5" accesskey="6" title="">Add Photos to gallery</a></li>
			<li></li>
			<li><a href="aeditpswd.html" id="main-menu7" accesskey="6" title="">Edit Password</a></li>
			<li></li>
			<li></li>
			<li><a href="update.php" id="main-menu3" accesskey="6" title="">Update</a></li>
            <li><a href="stats.php" id="main-menu3" accesskey="6" title="">Stats</a></li>
            <li><a href="maillist.php" id="main-menu3" accesskey="6" title="">Mail</a></li>
			<a href="homepage.html" id="main-menu6" accesskey="6" title="">Sign out</a>
<li class="first"></li>
        </ul>
  </div>
<div id="content">
		<div id="left">
			<h2>&nbsp;</h2>
	</div>
		<div id="right">
			<?php 
			$mysqli= new mysqli("localhost", "root", "", "alumni");

if ($mysqli->connect_errno) 
{
	echo "Failed to connect to MySQL: (". $db->connect_errno . ") " . $db->connect_error;
}




$email=$_GET["email"];

$sql="select email from  tempmail where email='{$email}' ";
//echo $sql;
$found=0;

$result=$mysqli->query($sql);

if($result ->num_rows == 1)
{	
	$found=1;
	
}

if($found==0)
{
		
$mysqli= new mysqli("localhost", "root", "", "alumni");
if ($mysqli->connect_errno) 
{
	echo "Failed to connect to MySQL: (". $db->connect_errno . ") " . $db->connect_error;
}

$con= mysqli_connect("localhost","root","");
mysqli_select_db($con,"alumni");
$query= "insert into tempmail values('$email')";
//echo $query;
mysqli_query($con, $query);

echo "<h3 align='center'>You Have Already Selected This Mail</h3><br><h4 align='center'><a href='maillist.php'>Click to Add Another Mail</a></h4>";
	}
else
{
	echo "<h3 align='center'>You Have Already Selected This Mail</h3>";
	
}	  
?>
			<h2 align="center" class="bigger">&nbsp;</h2>
			<p class="bigger">&nbsp;</p>
			<p class="bigger">&nbsp;</p>
			<p class="bigger">&nbsp;</p>
			<p class="bigger">&nbsp;</p>
			<p class="bigger">&nbsp;</p>
			<p class="bigger">&nbsp;</p>
			<p class="bigger">&nbsp;</p>
			<p class="bigger">&nbsp;</p>
			<p class="bigger">&nbsp;</p>
			<p class="bigger">&nbsp;</p>
			<p class="bigger">&nbsp;</p>
			<p class="bigger">&nbsp;</p>
			<p class="bigger">&nbsp;</p>
			<p class="bigger">&nbsp;</p>
            <h2>&nbsp;</h2>
	</div>
  </div>
	<div class="hr1">
		<hr />
	</div>
	<div id="footer">
		<ul>
			<li><a href="#" title="">Home</a></li>
			<li><a href="#" title="">About us</a></li>
			<li><a href="#" title="">Landmark</a></li>
			<li><a href="#" title="">Sign up</a></li>
            <li><a href="#" title="">Sign in</a></li>
			<li><a href="#" title="">Contact Us</a></li>
            <li><a href="#" title="">Sign out</a></li>
            
	  </ul>
		<p>Copyright &copy; 2016 rvce.edu.in. All rights reserved. </p>
	</div>
</div>
</body>
</html>

			<center><span style="width: 100%; font-family: helvetica; font-size: 6px;">
			Design downloaded from <a href="http://www.freewebtemplates.com" style="font-family: helvetica; font-size: 6px;">FreeWebTemplates.com</a><br>
			Free web design, web templates, web layouts, and website resources!
			</span></center><br><br>
		