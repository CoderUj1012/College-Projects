<?php 

//if(count($_POST)>0)
{
	include("../connect.php");
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$password = md5($_POST['password']);

	$query="INSERT INTO OWNER(email,phone,`password`,name) VALUES('$email','$phone','$password','$name')";
	$res = mysqli_query($con, $query);

	if($res)	echo "<script>alert('Registration Successful')</script>";
	else		echo "<script>alert('Registration Failed. Please Verify the Values and Try Again')</script>";

	echo "<script>self.location='../welcome'</script>";
	mysqli_close($con);
}

?>

	
