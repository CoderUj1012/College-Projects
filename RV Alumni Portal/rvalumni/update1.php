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
			<a href="homepage.html" id="main-menu6" accesskey="6" title="">Sign out</a>
            <li class="first"></li>
            <li class="first"></li>
            </ul>
  </div>
<div id="content">
		<div id="left">
			<h2>&nbsp;</h2>
	</div>
		<div id="right">
			<h2 class="bigger">&nbsp;
            
            </h2>
			<p class="bigger">
			<?php
			
            $db = new mysqli("localhost", "root", "", "alumni");
			$mysqli= new mysqli("localhost", "root", "", "alumni");
	
			if ($mysqli->connect_errno) 
			{
				echo "Failed to connect to MySQL: (". $db->connect_errno . ") " . $db->connect_error;
			}

			    $db1 = new mysqli("localhost", "root", "", "alumni1");
			$mysqli1= new mysqli("localhost", "root", "", "alumni1");
	
			if ($mysqli1->connect_errno) 
			{
				echo "Failed to connect to MySQL: (". $db->connect_errno . ") " . $db->connect_error;
			}
			//////////////
			
$sql="select * from  signup";

$result_db = $db->query($sql) or die("Error!");
$all_result = $result_db->fetch_all();
//////////////////////////
$sql1="select * from  db";

$result_db1 = $db1->query($sql1) or die("Error!");
$all_result1 = $result_db1->fetch_all();

$em1="";
$em2="";
$q="";
$p="";
$oq="";
$op="";
$nq="";
$np="";
foreach ($all_result as $row) 
{
	$oq=$row[12];
	$op=$row[13];
	

		foreach ($all_result1 as $row1) 
		{
				if($row[6]==$row1[0])
				{
	echo "Updating Details of ".$row[6]."<br>";				
	echo "Updating  Qualification =".$oq."&nbsp;&nbsp;&nbsp;  by ".$row1[1]." &nbsp;&nbsp;&nbsp;Profession=".$op." by ".$row1[2]."<br><br><br><br>";
	
					$em1=$row[6];
					$em2=$row1[0];
					
//					echo "success";
					$q=$row1[1];
					$p=$row1[2];
					
					////////////////////////
					
					$con = mysqli_connect("localhost", "root", "");
					mysqli_select_db($con,"alumni");

					$query="update signup set qualify='{$q}',profession='{$p}'  where email='{$em2}'";

					//echo $query;

					mysqli_query($con,$query);

	
	
					echo("  Updation success" );
					///////////////////
				}
		}
}




			
			
			
			?>&nbsp;</p>
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
			<!--<li><a href="#" title="">Landmark</a></li>-->
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
		