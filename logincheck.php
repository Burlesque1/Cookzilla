<?php  
	session_start();
	$email=$_POST["email"]; 
	$psw = $_POST["password"];
	$_SESSION["link"] = mysqli_connect("localhost", "test", "", "cookzilla"); 
	$_SESSION["email"]=$email;
	if (mysqli_connect_error()) {
		die("There was an error connecting to the database");
	} 
	$sql = "select uid, username, upassword from user where email = '$_POST[email]' and upassword = '$_POST[password]'";   
	if($result = mysqli_query($_SESSION["link"], $sql)){ 
		$num = mysqli_num_rows($result);  
		if($num){  
			$row = mysqli_fetch_array($result);
			$_SESSION["username"]=$row["username"];
			$_SESSION["uid"]=$row["uid"];
			$_SESSION["check"]="successful";
			Header("Location: userpage.php"); 
			// echo "<meta http-equiv=refresh content='0; url=userpage.php '>";  
		} else {  
			echo "<script>alert('Filename or password incorrect！');history.go(-1);</script>";  
		}  
	} else {
		echo "<script>alert('user profile not found！');history.go(-1);</script>";
	}  
?>  