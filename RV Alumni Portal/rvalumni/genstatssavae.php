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
  <div id="right">
	  <?php 
		 include "libchart/classes/libchart.php";
		  $db = new mysqli("localhost", "root", "", "alumni");

if ($db->connect_errno) {
echo "Failed to connect to MySQL: (" 
. $db->connect_errno . ") " . $db->connect_error;
}


$year=$_POST["select"];

if($year=="All")
{
$mysqli= new mysqli("localhost", "root", "", "alumni");

if ($mysqli->connect_errno) 
{
	echo "Failed to connect to MySQL: (". $db->connect_errno . ") " . $db->connect_error;
}

$sql="select jborhstd from signup where jborhstd='Higher Studies'";
$result=$mysqli->query($sql);
$sno=$result->num_rows ;
$sno=$sno+0;
//echo $sno;

//////////
$sql1="select jborhstd from signup where jborhstd='Job'";
$result=$mysqli->query($sql1);
$sno2=$result->num_rows ;
$sno2=$sno2+0;
//////	
$sql="select fname,poyr,jborhstd from  signup";
//echo $sql;
$result_db = $db->query($sql) or die("Error!");
$all_result = $result_db->fetch_all();



$fname="";
$poyr="";
$jborhstd="";

foreach ($all_result as $row) 
{

$fname=$row[0];
$poyr=$row[1];
$jborhstd=$row[2];


}
$chart = new PieChart();

	$dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("Higher Studies ($sno)", $sno));
	$dataSet->addPoint(new Point("Job ($sno2)", $sno2));

	$chart->setDataSet($dataSet);

	$chart->setTitle("Stats For $year Year");
	$chart->render("demo3.png");

/*$file = 'C:\\xampp\\htdocs\\rvalumni\\newfile.txt';
// Open the file to get existing content
$current = file_get_contents($file);
// Append a new person to the file
$current .="\r\n";
$current .="Higher Studies".","."Y-"."$poyr".","."$sno"."\r\n";
$current .="Job".","."Y-"."$poyr".","."$sno2"."\r\n";
// Write the contents back to the file
file_put_contents($file, $current);*/

}
else
{
	$mysqli= new mysqli("localhost", "root", "", "alumni");

if ($mysqli->connect_errno) 
{
	echo "Failed to connect to MySQL: (". $db->connect_errno . ") " . $db->connect_error;
}

$sql="select jborhstd from signup where poyr='{$year}' and jborhstd='Higher Studies'";
$result=$mysqli->query($sql);
$sno=$result->num_rows ;
$sno=$sno+0;
//echo $sno;

//////////
$sql1="select jborhstd from signup where poyr='{$year}' and jborhstd='Job'";
$result=$mysqli->query($sql1);
$sno2=$result->num_rows ;
$sno2=$sno2+0;
//echo $sno2;
/////////
	
	
	$sql="select fname,poyr,jborhstd from signup where poyr='{$year}'";
//echo $sql;
$result_db = $db->query($sql) or die("Error!");
$all_result = $result_db->fetch_all();



$fname="";
$poyr="";
$jborhstd="";

foreach ($all_result as $row) 
{

$fname=$row[0];
$poyr=$row[1];
$jborhstd=$row[2];



}

	$chart = new PieChart();

	$dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("Higher Studies ($sno)", $sno));
	$dataSet->addPoint(new Point("Job ($sno2)", $sno2));

	$chart->setDataSet($dataSet);

	$chart->setTitle("Stats For Year $year");
	$chart->render("demo3.png");
/*
$file = 'C:\\xampp\\htdocs\\rvalumni\\newfile.txt';
// Open the file to get existing content
$current = file_get_contents($file);
// Append a new person to the file
$current .="YEAR".","."STATUS".","."HEADCOUNT"."\r\n";
$current .="Y-"."$year".","."Higher Studies".","."$sno"."\r\n";
$current .="Y-"."$year".","."Job".","."$sno2"."\r\n";
// Write the contents back to the file
file_put_contents($file, $current);*/
}
		  
		  ?>
	  <h2 align="center" class="bigger">Stats Has Been Generated Successfully</h2>
		  <p align="center">
	<p align="left"><img alt="Pie chart"  src="demo3.png" style="border: 1px solid gray;"/></p>

&nbsp;</p>
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
		<!--	<li><a href="#" title="">Landmark</a></li>-->
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
		