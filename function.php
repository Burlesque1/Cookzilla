<?php
	session_start();
	function do_query($link_,$query_){
		if ($result = mysqli_query($link_, $query_)) {
	
			if (mysqli_num_rows($result) > 0) {
				
				return $result;
				
			} else {

				echo "<br>No result found.";
				return NULL;
			}

		} else{
			
			echo "query is not successful!";
			return NULL;
		}
	}
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
?>
	
	