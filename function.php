<!DOCTYPE html>
<html lang="en">
	
	<title>Cookzilla</title>
  <head>
	  
	<meta charset="utf-8">
	  
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
	body {
	  padding-bottom: 40px;
	  color: #5a5a5a;
	}
	/* CUSTOMIZE THE NAVBAR
	-------------------------------------------------- */

	/* Special class on .container surrounding .navbar, used for positioning it into place. */
	.navbar-wrapper {
	  position: absolute;
	  top: 0;
	  right: 0;
	  left: 0;
	  z-index: 20;
	}
	/* Flip around the padding for proper display in narrow viewports */
	.navbar-wrapper > .container {
	  padding-right: 0;
	  padding-left: 0;
	}
	.navbar-wrapper .navbar {
	  padding-right: 15px;
	  padding-left: 15px;
	}
	.navbar-wrapper .navbar .container {
	  width: auto;
	}
	#Summary {
		
		text-align: center;
		margin-top:50px;
		margin-bottom: 50px;
	}
	#searchdropdown {
		width:70px;
		height:48px;
		border-radius: 5px;
	}
	#search{
		width:400px;
		height:48px;
		border-radius: 5px;
	}
	
	#f{
		display:none;
	}
	</style>
    </head>
  
		<body>
			<div class="navbar-wrapper">
				<div class="container">
					<nav class="navbar navbar-default navbar-fixed-top">
						<div class="container">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="homepage.php">Cookzilla</a>
							</div>

							<div id="navbar" class="navbar-collapse collapse">
								<ul class="nav navbar-nav">
									<li class="active"><a href="homepage.php">Home</a></li>
									<li><a href="allrecipe.php">Recipe</a></li>
									<li><a href="allgroup.php">Group</a></li>
									<li><a href="allevent.php">Event</a></li>
									<?php 
									session_start();
									if(isset($_SESSION["check"]) && $_SESSION["check"]=="successful"){
										echo '<li><a href="history.php">My History</a></li>';
									}  
									echo '</ul>';
									echo '<ul class="nav navbar-nav navbar-right">';
									if(isset($_SESSION["check"]) && $_SESSION["check"]=="successful"){
										echo '<li class="dropdown"> 
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span>Hello, '.$_SESSION["username"].'!</span><span class="caret"></span></a>
										<ul class="dropdown-menu">
										  <li><a href="userpage.php"><span>profile</span></a></li>
										  <li><a href="logout.php">log out </a></li>
									  </ul>
									  </li>';
									} else {
										echo '<form action="#" method="post" class="navbar-form">
										<input class="form-control" type="email" required="required" name="email" placeholder="Email">
										<input class="form-control" type="password" required="required" name="password" placeholder="Password">

											<button class="btn btn-success" type="submit" role="button">Sign in<span class="glyphicon glyphicon-log-in"></span></button>
										<a href="signup.php" class="btn btn-primary" role="button">sign up<span class="glyphicon glyphicon-user"></span></a>
										</form> ';
									}
								?>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</div>
		
	<div class="container">

				<div class="row" id="Summary">

					<h1>Why Our Site Is Awesome</h1>
					<p class="lead">good samples</p>

					<form action="searchresult.php" method="get" class="navbar-search">
						<input type="text" id="search" name="keyword" required="required" class="search-query" placeholder="Search for...">
						<select name="searchtype" id="searchdropdown">
							<option value ="Recipe">Recipe</option>
							<option value="User">User</option>
							<option value ="Group">Group</option>
							<option value="Event">Event</option>
						</select>
						<button type="submit" class="btn btn-info btn-lg">Search</button>
					</form> 
				</div>
			</div>
			<footer id="f">
				<p class="pull-right"><a href="#">Back to top</a></p>
				<p>&copy; 2016 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
			</footer>

<?php
	$_SESSION["link"] = mysqli_connect("localhost", "test", "", "cookzilla"); 
	function do_query($link_,$query_){
		if ($result = mysqli_query($link_, $query_)) {
			if($result==true)
				return $result;
			if (mysqli_num_rows($result) > 0) {
				
				return $result;
				
			} else {

				// echo "<script>alert('no result found！');</script>";
				return NULL;
			}

		} else{
			// echo "<script>alert('query is not successful!');</script>";
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

	