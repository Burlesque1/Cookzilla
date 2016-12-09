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
				if(isset($_SESSION["email"])){
					echo '<a class="nav-link pull-right" href="logout.php">				
						  log out </a>
						  <a class="nav-link pull-right" href="userpage.php">				
						 <span>Hello, '.$_SESSION["username"].'!</span></a>';
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
				return NULL;
			}

		} else{
			
			echo "<script>alert('query is not successful!</script>";
			return NULL;
		}
	}
	
	// event infomation
	$query = "SELECT eid, ename, edescription, edatetime, gname from groups natural join event natural join rsvp natural join user
				where email='".$_SESSION['email']."'";
	//print_r($query);
	echo '<div class="container" style="width:900px;"><label>Your events:<table class="table table-hover"><thead><tr>
			<th>eid</th><th>event name</th><th>description</th><th>event time</th><th>group</th>
			</tr></thead><tbody>';
	if($result=do_query($_SESSION["link"], $query)){
		while($row = mysqli_fetch_array($result)){
			
			echo '<tr>';
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></label></div>";
	} else{
		echo "<p>You have no coming event!</p>";
	}
	
	// user profile
	$query = "SELECT uid, username, email, birthday, ucity, udescription, image from user where email='".$_SESSION['email']."'";
	
	echo '<div class="container" style="width:900px;"><label>Your profile:<table class="table table-hover"><thead><tr>
			<th>pic</th><th>uid</th><th>username</th><th>e-mail</th><th>birthday</th><th>city</th>
			<th>description</th></tr></thead><tbody>';
	if($result=do_query($_SESSION["link"], $query)){
		while($row = mysqli_fetch_array($result)){
			
			echo '<tr><td><p><img src="data:image/jpg;base64,'.base64_encode($row["image"]).'" width="100px"></p></td>';
			
			for ($x = 0; $x <count($row)/2-1; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></label></div>";
	} else {
		
	}
	
	// recipes
	$query = "SELECT rid, rtitle, serv_num, rdescription, postdatetime, pic from user natural join recipes where email='".$_SESSION['email']."'";

	echo '<div class="container" style="width:900px;"><label>Your recipes:<table class="table table-hover"><thead><tr>
			<th>pic</th><th>rid</th><th>title</th><th>servings</th><th>description</th><th>post time</th><th>tag</th>
			</tr></thead><tbody>';
	$result=do_query($_SESSION["link"], $query);
	while($row = mysqli_fetch_array($result)){
		echo '<tr><td><p><img src="data:image/jpg;base64,'.base64_encode($row["pic"]).'" width="100px"></p></td>';
		
		for ($x = 0; $x <count($row)/2-1; $x++) {
			
			echo "<td>".$row[$x]."</td>";
			
		}
		// tag
		$query_s = "SELECT tagname from tags natural join hastags natural join recipes where rid='".$row['rid']."'";
		
		print_r($query_s);
		
		if($result_s=do_query($_SESSION["link"], $query_s)){
			echo "<td>";
			while($row_s = mysqli_fetch_array($result_s)){
				echo "<span class='tag tag-pill tag-success'><p>".$row_s["tagname"]."</p></span>";
			}
			echo "</td>";
		} else {
			echo "<td>none</td>";
		}
		echo "</tr>";
	}
	echo "</tbody></table></label></div>";
	
	// group infomation
	$query = "SELECT gid, gname, gdescription, u1.username from user as u1 join groups on u1.uid=groups.creatorid
				natural join joins join user as u2
				on joins.memberid=u2.uid where u2.email='".$_SESSION['email']."'";
	// print_r($query);
	echo '<div class="container" style="width:900px;"><label>Your groups:<table class="table table-hover">
			<thead><tr><th>gid</th><th>group name</th><th>description</th><th>creato</th>
			</tr></thead><tbody>';
	$result=do_query($_SESSION["link"], $query);
	while($row = mysqli_fetch_array($result)){
		
		echo '<tr>';
		
		for ($x = 0; $x <count($row)/2; $x++) {
			
			echo "<td>".$row[$x]."</td>";
			
		}
		
		echo "</tr>";
	}
	echo "</tbody></table></label></div>";
?>