<?php  
	$email = $_POST["email"];  
	$user = $_POST["username"];  
	$password = $_POST["password"];  
	$confirm_psw = $_POST["confirm_psw"];  
	if($email == "" || $user == "" || $password == "" || $confirm_psw== "") {  
		echo "<script>alert('Please check your information！'); </script>";  
	}  
	else{  
		if($password == $confirm_psw) // check image file suffix 
		{  
			$link = mysqli_connect("localhost", "test", "", "cookzilla"); 
			$sql = "select username from user where username = '$_POST[username]'";   
			$result = mysqli_query($link, $sql);   
			$num = mysqli_num_rows($result); 
			if($num){    
				echo "<script>alert('username has already exists!'); history.go(-1);</script>";  
			} else {  
				$sql_insert = "insert into user(username,upassword, birthday, email, ucity, udescription) values('$_POST[username]','$_POST[password]','$_POST[birthday]','$_POST[email]','$_POST[city]','$_POST[description]')";                      
				if($res_insert = mysqli_query($link, $sql_insert)){  
					echo "<script>alert('Registration successful'); </script>";//history.go(-1); 
					echo "<meta http-equiv=refresh content='0; url=userpage.php '>"; 
				} else {  
					echo "<script>alert('System error！Please try again later!');history.go(-1);</script>";//  
				}  
			}  
		} else {  
			echo "<script>alert('Please make sure your password match！');history.go(-1);</script>";  
		}
	}		
?>  