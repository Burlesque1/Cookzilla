<?php  
	// prevent SQL injections
	// function check_input($value){
		// if (get_magic_quotes_gpc()){
			// $value = stripslashes($value);
		// }
		// if (!is_numeric($value)){
			// $value = "'" . mysqli_real_escape_string($value) . "'";
		// }
		// $value = mysqli_real_escape_string($value);
		// echo $value;
		// return $value;
	// }
	session_start();
     
		
        // $user = check_input($_POST["username"]);  
        // $psw = check_input($_POST["password"]);
		$email=$_POST["email"]; 
        $psw = $_POST["password"];
        if($email == "" || $psw == "")  
        {  
            echo "<script>alert('Please enter username and password！'); history.go(-1);</script>";  
        }  
        else  
        {  
			$_SESSION["sign"]=true;
            $_SESSION["link"] = mysqli_connect("localhost", "test", "", "cookzilla"); 
			$_SESSION["username"]=$user;
			$_SESSION["email"]=$email;
			if (mysqli_connect_error()) {
                die("There was an error connecting to the database");
			} 
            $sql = "select username, upassword from user where email = '$_POST[email]' and upassword = '$_POST[password]'";   
			if($result = mysqli_query($_SESSION["link"], $sql)){ 
				$num = mysqli_num_rows($result);  
				if($num){  
					$row = mysqli_fetch_array($result);
					Header("Location: userpage.php"); 
					// echo "<meta http-equiv=refresh content='0; url=userpage.php '>";  
				} else {  
					echo "<script>alert('Filename or password incorrect！');history.go(-1);</script>";  
				}  
			} else {
				echo "<br>1 query is not successful!</br>";
			}
        }  
    
  
?>  