<?php  
	print_r($_POST);
	session_start();
	$email = $_POST["email"];   
	$password = $_POST["password"];  
	$confirm_psw = $_POST["confirm_psw"]; 
	$username = $_POST["username"];  
	if($password == $confirm_psw) // check image file suffix 
	{  
		$link = mysqli_connect("localhost", "test", "", "cookzilla"); 
		$_SESSION["link"]=$link;
		if($stmt = $_SESSION["link"]->prepare("select email from user where email=?")) {
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$stmt->bind_result($returnedemail);
			$stmt->fetch();
			$stmt->close();
			if($returnedemail==$email){    
				echo "<script>alert('username has already exists!'); history.go(-1);</script>";  
			} else {  
				if($stmt = $_SESSION["link"]->prepare("INSERT INTO user (email, upassword, username) VALUES (?, ?, ?)")) {
					$stmt->bind_param("sss", $email, $password, $username);
					$stmt->execute();
					$stmt->close();
					$_SESSION['email']=$email;
					$_SESSION["check"]="successful";
					$_SESSION["username"]=$username;
					if($stmt = $_SESSION["link"]->prepare("select uid from user where email=?")) {
						$stmt->bind_param("s", $email);
						$stmt->execute();
						$stmt->bind_result($returneduid);
						$stmt->fetch();
						$stmt->close();
						$_SESSION["uid"]=$returneduid;
					}
					echo "<script>alert('Registration successful'); </script>";//history.go(-1); 
					echo "<meta http-equiv=refresh content='0; url=userpage.php '>"; 
				} else {
				    echo "<script>alert('System error！Please try again later!');</script>";
				}
			}
		}
	} else {  
		echo "<script>alert('Please make sure your password match！');history.go(-1);</script>";  
	}	
?>  