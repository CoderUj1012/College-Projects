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
			
			<li><a href="gallery.php" id="main-menu5" accesskey="6" title="">Add Photos to gallery</a></li>
			
			<li><a href="aeditpswd.html" id="main-menu7" accesskey="6" title="">Edit Password</a></li>
			<li><a href="addevents.php" id="main-menu7" accesskey="6" title="">Add Events</a></li>
			
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
		
			
          <?php 
		
			
			
			$db = new mysqli("localhost", "root", "", "alumni");

if ($db->connect_errno) {
echo "Failed to connect to MySQL: (" 
. $db->connect_errno . ") " . $db->connect_error;
}

$sql="select fname,mname,lname,dob,mobile,poyr,photo,email,branch from  signup";
//echo $sql;
$result_db = $db->query($sql) or die("Error!");
$all_result = $result_db->fetch_all();

$table =
'<table border="1" align="left">
<tr>
<td>fname</td>
<td>mname</td>
<td>lname</td>
<td>dob</td>
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
$dob="";
$address="";
$contact="";
$poyr="";
$photo="";
$email="";
$br="";
foreach ($all_result as $row) 
{

$fname=$row[0];
$mname=$row[1];
$lname=$row[2];

$dob=$row[3];

$contact=$row[4];
$poyr=$row[5];
$photo=$row[6];
$email=$row[7];
$br=$row[8];



	$table .= '<tr>'
	  . '<td>' .$fname. '</td>'
  	. '<td>' . $mname . '</td>'
  	. '<td>' . $lname . '</td>'

	  	. '<td>' . $dob . '</td>'
		  	
			  	. '<td>' . $contact . '</td>'
				. '<td>' . $poyr . '</td>'
			. '<td><img src=' . $photo . ' width=25 height=25 ></img></td>'
				. '<td>' . $email . '</td>'
					. '<td>' . $br . '</td>'
		  	. '<td>' ."<a href=mailselect.php?email=".$email.">Click To Select</a>" . '</td>'
	  . '</tr>';
}




$table .='</table>';
echo $table;


$db->close();
		  ?>
          <?php  echo "<a href='sendmailselected.php'>Send Mail To Selected Email</a> &nbsp;&nbsp;&nbsp;<a href='sendmailall.php'>Send Mail To All</a>";?>
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
		