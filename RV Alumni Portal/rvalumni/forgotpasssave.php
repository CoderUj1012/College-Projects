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
.style1 {color: #000000}
.style2 {
	color: #000000;
	font-size: 18px;
	font-weight: bold;
}
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
			<li class="first"><a href="#" id="main-menu1" accesskey="1" title="">Home</a></li>
			<li><a href="aboutus.html" id="main-menu2" accesskey="2" title="">About us</a></li>
			<!--<li><a href="adlandmrk.html" id="main-menu3" accesskey="3" title="">Landmark</a></li>-->
			<li><a href="signup.html" id="main-menu4" accesskey="4" title="">Sign Up</a></li>
			<li><a href="signin.html" id="main-menu5" accesskey="5" title="">Sign in</a></li>
			<li><a href="contactus.html" id="main-menu6" accesskey="4" title="">Contact Us</a></li>
			<li><a href="usignin.html" id="main-menu7" accesskey="4" title="">User sign in</a></li>
			<li class="first"></li></ul>
  </div>
<div id="content">
		<div id="left">
			<h2>&nbsp;</h2>
	  </div>
		<div id="right">
			<h2 class="bigger">&nbsp;</h2>
	  <div>
				
			</div>
			<?php 
$user=$_POST['select'];
$txt=$_POST['t1'];
$pass=rp(strlen($txt));



///////////////////

$mysqli= new mysqli("localhost", "root", "", "ins");

if ($mysqli->connect_errno) 
{
	echo "Failed to connect to MySQL: (". $db->connect_errno . ") " . $db->connect_error;
}
if($user=="User")
{

$sql="select email from  signup where email ='{$txt}'";
//echo $sql;
$result_db = $db->query($sql) or die("Error!");
$all_result = $result_db->fetch_all();

$email="";

foreach ($all_result as $row) 
{
$email=$row[0];
}

}
else if($user=="Admin")
{
$sql="select * from adminlogin where uname ='{$txt}'";
}


$found=0;
$result=$mysqli->query($sql);


if($result ->num_rows == 1)
{	
	$found=1;
}




////////////////////
if( $found==1)
{


	$con = mysqli_connect("localhost", "root", "");
	mysqli_select_db($con,"ins");

if($user=="User")
{
$query="update signup set password='{$pass}'  where uname='{$txt}'";


}
else if($user=="Admin")
{
$query="update admin set pwd='{$pass}'  where  uname='{$txt}'";
}


//echo $query;

mysqli_query($con,$query);
/////////////
	require("class.phpmailer.php"); // path to the PHPMailer class
	
	$mail = new PHPMailer();  
 
$mail->IsSMTP();  // telling the class to use SMTP
$mail->Mailer = "smtp";
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "vijaynagartest@gmail.com"; // SMTP username
$mail->Password = "vijaynagar2017"; // SMTP password 

$mail->From     = "vijaynagartest@gmail.com";//sender email
//$mail->AddAddress("@gmail.com");  
 $mail->AddAddress($email);  
$mail->Subject  = "New Password";

			 


$mail->Body     = "Your new Password generated successuflly = ".$pass."";
$mail->WordWrap = 50;  

if(!$mail->Send()) 
{

echo "<h1 align=center>Please Check Your Mail For New Passowrd.</h1>"; ;
echo 'Mailer error: ' . $mail->ErrorInfo;
} 
else 
{

//echo 'Message has been sent.';
}
	

			//echo "<h3 align=center>Your new Password generated successuflly = ".$pass."</h3>";
			
			
			//echo("<h4 align=center><a href=signin.php><br>Home Page</a></h4>");
			



	
}

else
{
	echo "<h1 align=center> Some thing Wrong Please try again </h1>";
	//echo("<h4 align=center><a href=index.php><br>Home Page</a></h4>");
}









?>
<?php 


function rp($len)
{

$chars="ABCD1234";
$pass=substr( str_shuffle($chars),0,$len);
return $pass;
}


?>
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
		<p>Copyright &copy; 2016 rvce.edu.in All rights reserved. </p>
	</div>
</div>
</body>
</html>

			<center><span style="width: 100%; font-family: helvetica; font-size: 6px;">
			Design downloaded from <a href="http://www.freewebtemplates.com" style="font-family: helvetica; font-size: 6px;">FreeWebTemplates.com</a><br>
			Free web design, web templates, web layouts, and website resources!
			</span></center><br><br>
		