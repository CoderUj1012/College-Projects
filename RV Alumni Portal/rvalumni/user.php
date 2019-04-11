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
			<li class="first"><a href="homepage.html" id="main-menu6" accesskey="6" title="">Sign Out </a><a href="editpswd.html" id="main-menu7" accesskey="6" title="">Edit Profile</a>
		      <a href="search.html" id="main-menu3" accesskey="6" title="">Search Alumni</a>		</li>
		</ul>
  </div>
<div id="content">
<div id="right">
			
		
		<div align="center">
<table width="300" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td rowspan="3"><?php $p=$_COOKIE["photo"]; echo"<img src= ". $p . " width=150 height=100 ></img>" ?></td>
    <td><h2 align="center" class="bigger">Welcome Alumni</h2></td>
  </tr>
  <tr>
    <td><?php $user=$_COOKIE["names"]; echo "<h2 align='center' class='bigger'>$user</h2>"; ?></td>
  </tr>
  
</table>&nbsp;</div>
<div align="center">
	  <?php 
			$db = new mysqli("localhost", "root", "", "alumni");

if ($db->connect_errno) {
echo "Failed to connect to MySQL: (" 
. $db->connect_errno . ") " . $db->connect_error;
}

$sql="select * from  events order by date";
//echo $sql;
$result_db = $db->query($sql) or die("Error!");
$all_result = $result_db->fetch_all();





$pic="";
$en="";
$day="";
$date="";
$time="";
$venue="";
foreach ($all_result as $row) 
{

$pic=$row[6];
$en=$row[0];
$day=$row[2];

$date=$row[3];

$time=$row[4];
$venue=$row[5];



	$table = '<table width="300" border="1" cellspacing="0" cellpadding="0" align="left" class="first">
	
	.<tr>'
    .'<td rowspan="5"><img src=' . $pic . ' width=125 height=150 ></img></td>'
    .'<td>Event Name</td>'
   .'<td>' .$en. '</td>'
  .'</tr>'
  .'<tr>'
    .'<td>Day</td>'
    .'<td>' . $day . '</td>'
  .'</tr>'
  .'<tr>'
    .'<td>Date</td>'
    .'<td>' . $date . '</td>'
  .'</tr>'
  .'<tr>'
    .'<td>Time</td>'
    .'<td>' . $time . '</td>'
  .'</tr>'
  .'<tr>'
    .'<td>Venue</td>'
    .'<td>'.$venue.'</td>'
  .'</tr>';
	$table .='</table>';
echo $table;

}
		 



$db->close();  ?>
</div>
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
			<!--<li><a href="#" title="">Landmark</a></li>-->
			<li><a href="#" title="">Sign up</a></li>
            <li><a href="#" title="">Sign in</a></li>
			<li><a href="#" title="">Contact Us</a></li>
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
		