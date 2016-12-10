<!DOCTYPE html>
<html lang="en">
    
  <head>
      
    <meta charset="utf-8">
      
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
    <style>
	
          #Search {
              
              text-align: center;
              margin-top:150px;
              margin-bottom: 50px;
              
          }
		  
          body {
              margin-top:70px;
              position: relative;
              
          }
      
    </style>
      
  </head>
  
  <body data-spy="scroll" data-target="#navbar" data-offset="150">
      
        <nav class="navbar navbar-light bg-faded navbar-fixed-top" id="navbar">
          <a class="navbar-brand" href="login.php">Cookzilla</a>
          <ul class="nav navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#jumbotron">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">???</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#footer">???</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">???</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">about</a>
            </li>
			
			<?php 
				// add dropdown to log out
				session_start();
				if(isset($_SESSION["check"]) && $_SESSION["check"]=="successful"){
					if(isset($_SESSION["username"])){
						echo '<a class="nav-link pull-right" href="logout.php">				
						  log out </a>
						  <a class="nav-link pull-right" href="userpage.php">				
						 <span>Hello, '.$_SESSION["username"].'!</span></a>';
					} else {
						echo '<a class="nav-link pull-right" href="logout.php">				
						  log out </a>
						  <a class="nav-link pull-right" href="userpage.php">				
						 <span>Hello, '.$_SESSION["email"].'!</span></a>';
					}
				} else {
					echo '<form action="logincheck.php" method="post" class="form-inline pull-xs-right">
						<input class="form-control" type="email" required="required" name="email" placeholder="Email">
						  <input class="form-control" type="password" required="required" name="password" placeholder="Password">
						<button class="btn btn-success" type="submit">Login</button>
						<!-- alternative: check input then forward --></form>';
				}
			?>
          </ul>
         
        </nav>
		
		<div class="container">
      
			<div class="row" id="Search">
				<form action="searchresult.php" method="get" class="navbar-search">
              <input type="text" id="search" name="keyword" class="search-query" placeholder="Search for...">
				<select name="searchtype" id="dropdown">
                  <option value ="Recipe">Recipe</option>
                  <option value="User">User</option>
                  <option value ="Group">Group</option>
                  <option value="Event">Event</option>
                </select>
              <button type="submit" class="btn btn-info">Search</button>
            </form>	
			</div>
      </div>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
   
	</body>
</html>

<?php
	$_SESSION["link"] = mysqli_connect("localhost", "test", "", "cookzilla"); 
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
	
	