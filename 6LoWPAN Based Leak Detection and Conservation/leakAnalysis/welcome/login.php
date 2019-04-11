<?php 
session_start();
$message="";
//require_once "recaptchalib.php";
//$secret = "6Lcw8R4TAAAAAHyciEn1_4qpSRdErtddnEm_HHyW";
//$response = null;
 
/* check secret key
$reCaptcha = new ReCaptcha($secret);
if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}
*/

if(count($_POST)>0){
	include("../connect.php"); 
	$email = $_POST['email'];
	$password = $_POST['password'];


	//$oid = stripslashes($oid);
	//$pass = stripslashes($pass);
	//$oid = mysql_real_escape_string($oid);
	//$pass = mysql_real_escape_string($pass);
	$pass = md5($password);

	$sql = "SELECT * FROM OWNER WHERE email='$email' AND password='$pass'";
	//echo $sql;
	$res = mysqli_query($con, $sql);

	$check = mysqli_fetch_array($res);

	if( isset($_POST['remember']) ) {
		$_SESSION["remember"] = "ON";
	}
	else {
		$_SESSION["remember"] = "OFF";
	}

	$_SESSION["email"] = $check["email"];
	$_SESSION["name"] = $check["name"];

	//echo $_SESSION["oid"]; 
	if(isset($check)) {// and $response != null && $response->success){
		header("Location:../dashboard/index.php");
	}
	else{
			echo "<script>alert('Invalid Email or Password')</script>";
			echo("<script>window.location = '../welcome';</script>");		
	}	
	mysqli_close($con);
}
?>

