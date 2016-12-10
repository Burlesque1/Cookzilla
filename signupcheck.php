<?php  
	// print_r($_POST);
	session_start();
	$email = $_POST["email"];   
	$password = $_POST["password"];  
	$confirm_psw = $_POST["confirm_psw"]; 
	// $user = $_POST["username"];  
	if($password == $confirm_psw) // check image file suffix 
	{  
		$link = mysqli_connect("localhost", "test", "", "cookzilla"); 
		$_SESSION["link"]=$link;
		$sql = "select email from user where email = '".$email."'";   
		$result = mysqli_query($link, $sql);   
		$num = mysqli_num_rows($result); 
		if($num){    
			echo "<script>alert('username has already exists!'); history.go(-1);</script>";  
		} else {  
			$sql_insert = "insert into user(email,upassword) values('".$email."','".$password."')";                      
			if($res_insert = mysqli_query($link, $sql_insert)){ 
				$_SESSION['email']=$email;
				$_SESSION["check"]="successful";
				echo "<script>alert('Registration successful'); </script>";//history.go(-1); 
				echo "<meta http-equiv=refresh content='0; url=userpage.php '>"; 
			} else {  
				echo "<script>alert('System error！Please try again later!');</script>";//  
			}  
		}  
	} else {  
		echo "<script>alert('Please make sure your password match！');history.go(-1);</script>";  
	}	
?>  