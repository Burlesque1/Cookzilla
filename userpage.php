<!DOCTYPE html>
<html lang="en">
    
  <head>
      
    <meta charset="utf-8">
      
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
      
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
          <a class="navbar-brand" href="#">Cookzilla</a>
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
			<li class="nav-item">
				<form class="navbar-search">
				  <input type="text" class="search-query" placeholder="Search">
				  <button type="submit" class="btn btn-primary">Search</button>
				</form>
			</li>
			<?php 
				// add dropdown to log out
				session_start();
				if($_SESSION['username']=='')
					echo '<a class="nav-link pull-right" href="">				
						 Hello, '.$_SESSION["email"].'!</a>';
				else	
					echo '<a class="nav-link pull-right" href="">				
						 Hello, '.$_SESSION["username"].'!</a>';
			?>
          </ul>
         
        </nav>
		
		<div class="container">
      
			<div class="row" id="Search">
          
				<form action="#" class="navbar-search">
				  <input type="text" class="search-query" name="keyword" placeholder="recipes, group, event...">
				  <input type="text" class="search-query" placeholder="dropdown menu">
					<button type="submit" class="btn btn-primary">Search</button>
				  <a href="">Adavanced search</a>
				  <? $_SESSION["sign"]==false;
				  ?>
				</form>
          
			</div>
          
      </div>
	</body>
</html>

<?php
	function do_query($link_,$query_){
		if ($result = mysqli_query($link_, $query_)) {
	
			if (mysqli_num_rows($result) > 0) {
				
				return $result;
				
			} else {

				echo "<br>No result found.";
			}

		} else{
			
			echo "query is not successful!";
		}
	}
	// ?????????????????????????????????????????????
$_SESSION["link"] = mysqli_connect("localhost", "test", "", "cookzilla");
	
	if(isset($_SESSION["sign"]) && $_SESSION["sign"]){ // show login page
		echo "<h2><big><b><a href=''>Profile</a>	<a href=''>Recipes</a>	<a href=''>Groups</a>	<a href=''>Events</a></b></big></h2>";
	
		$query = "SELECT uid, username, email, birthday, ucity, udescription from user where email='".$_SESSION['email']."'";

		// echo $query;
		
		// echo $_SESSION['username'];
		echo "<table border='1'><caption>Profile</caption><tr><th>uid</th><th>username</th><th>e-mail</th><th>birthday</th><th>city</th><th>description</th></tr>";

		do_query($_SESSION["link"], $query);
		
		$query = "SELECT rid, rtitle, serv_num, rdescription, postdatetime from user natural join recipes where email='".$_SESSION['email']."'";

		echo "</table><table border='1'><caption>Recipes</caption><tr><th>id</th><th>title</th><th>number of serving</th><th>description</th><th>postdatetime</th></tr>";

		do_query($_SESSION["link"], $query);
		
		// $query = "select * from group";
		
		echo "</table><table border='1'><caption>Groups</caption><tr><th>id</th><th>Group name</th><th>Creater</th><th>Description</th></tr>";

		// do_query($_SESSION["link"], $query);// echo "<br>Event</br>";
		
		// $query = "select * from event";
		
		echo "</table><table border='1'><caption>Events</caption><tr><th>id</th><th>Event name</th><th>Description</th><th>Event schedule</th></tr>";

		// do_query($_SESSION["link"], $query);// echo "<br>Event</br>";
		
		echo "</table>"; 
	} else {	// show search result
		
	}
	
?>