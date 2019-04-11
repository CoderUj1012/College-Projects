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
		<div id="right">
			<form id="form1" name="form1" method="post" action="addeventssave.php">
			  <table width="300" border="0" cellspacing="0" cellpadding="0">
			    <tr>
			      <td>Event Name</td>
			      <td><label for="textfield"></label>
		          <input type="text" name="textfield" id="textfield"  required/></td>
		        </tr>
			    <tr>
			      <td>Event Id</td>
			      <td><?php $mysqli= new mysqli("localhost", "root", "", "alumni");

if ($mysqli->connect_errno) 
{
	echo "Failed to connect to MySQL: (". $db->connect_errno . ") " . $db->connect_error;
}

$sql="select * from  events";
$result=$mysqli->query($sql);
$sno=$result->num_rows ;
$sno=$sno+1001;
$sno="E-".$sno;
echo $sno;
setcookie('sno',$sno);
?>&nbsp;</td>
		        </tr>
			    <tr>
			      <td>Day</td>
			      <td><label for="textfield2"></label>
		          <input type="text" name="textfield2" id="textfield2" required /></td>
		        </tr>
			    <tr>
			      <td>Date</td>
			      <td><label for="textfield3"></label>
		          <input type="date" name="textfield3" id="textfield3" required /></td>
		        </tr>
			    <tr>
			      <td>Time</td>
			      <td><label for="textfield4"></label>
		          <input type="text" name="textfield4" id="textfield4" required/></td>
		        </tr>
			    <tr>
			      <td>Venue</td>
			      <td><label for="textfield5"></label>
		          <input type="text" name="textfield5" id="textfield5" required/></td>
		        </tr>
			    <tr>
			      <td>Picture</td>
			      <td><label for="textfield6"></label>
		          <input type="file" name="textfield6" id="textfield6" required/></td>
		        </tr>
			    <tr>
			      <td><input type="submit" name="button" id="button" value="Submit" /></td>
			      <td><input type="reset" name="button2" id="button2" value="Reset" /></td>
		        </tr>
		      </table>
	      </form>
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
			<!--<li><a href="#" title="">Landmark</a></li>-->
			<li><a href="#" title="">Sign up</a></li>
            <li><a href="#" title="">Sign in</a></li>
			<li><a href="#" title="">Contact Us</a></li>
            <li><a href="#" title="">Sign out</a></li>
            
	  </ul>
		
		<p>Copyright &copy; 2016 rvce.edu.in All rights reserved.</p>
	</div>
</div>
</body>
</html>

			<center><span style="width: 100%; font-family: helvetica; font-size: 6px;">
			Design downloaded from <a href="http://www.freewebtemplates.com" style="font-family: helvetica; font-size: 6px;">FreeWebTemplates.com</a><br>
			Free web design, web templates, web layouts, and website resources!
			</span></center><br><br>
		