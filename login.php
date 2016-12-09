<!DOCTYPE html>

<html lang="en">
    
  <head>
      
    <meta charset="utf-8">
      
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
      
    <style>

          
          .jumbotron {
              
              background-image: url(background.jpeg);
              text-align: center;
              margin-top: 50px;
          }
          
          #email {
              
              width: 300px;
              
          }
          
          #Summary {
              
              text-align: center;
              margin-top:50px;
              margin-bottom: 50px;
              
          }
		  
		  #search{
				width:400px;
                height:50px;
                border-radius: 5px;
		  }
            #dropdown{
                height:50px;
                border-radius: 5px;
		  }
          
          .card-img-top {
              
              width: 100%;
              
          }
          
          #appStoreIcon {
              
              width: 200px;
              
          }
          
          #footer {
              
              background-color: aqua;
              padding-top: 150px;
              margin-top: 50px;
              text-align: center;
              padding-bottom: 150px;
          }
          
          body {
              
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
              <a class="nav-link" href="#footer">???</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#footer">about</a>
            </li>
          </ul>
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
          
        </nav>

        <div class="jumbotron" id="jumbotron">
          <h1 class="display-3" style="color:white">Delicious Foods!</h1>
          <p class="lead">This is why YOU should join this fantastic sites!</p>
          <hr class="m-y-2">
          <p>Want to know more? Join our mailing list!</p>
		  

        <form class="form-inline">
          <div class="form-group">
            <label class="sr-only" for="email">Email address</label>
            <div class="input-group">
              <div class="input-group-addon">@</div>
              <input type="email" class="form-control" id="email" placeholder="Your email">
            </div>
          </div>
            <a href="signup.php" class="btn btn-primary">Sign up</a> 
        </form>
        </div>
      
      <div class="container">
      
        <div class="row" id="Summary">
          
            <h1>Why Our Site Is Awesome</h1>
            <p class="lead">good samples</p>
            
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
      
      <div class="container" id="about">
      <div class="card-deck-wrapper">
  <div class="card-deck">
    <div class="card">
      <img class="card-img-top" src="11.jpg" alt="Card image cap">
      <div class="card-block">
        <h4 class="card-title"><i class="fa fa-anchor"></i> Jamaican jerk chicken with rice and beans</h4>
        <p class="card-text"> This content.</p>
        
      </div>
    </div>
    <div class="card">
      <img class="card-img-top" src="12.jpg" alt="Card image cap">
      <div class="card-block">
        <h4 class="card-title"><i class="fa fa-camera"></i> Macadamia dukkah chicken with preserved lemon</h4>
        <p class="card-text">Brief introduction.</p>
        
      </div>
    </div>
      
    <div class="card">
      <img class="card-img-top" src="13.jpg" alt="Card image cap">
      <div class="card-block">
        <h4 class="card-title"><i class="fa fa-bicycle"></i> Tandoori chicken salad with cucumber raita</h4>
        <p class="card-text">Brief introduction.</p>
        
      </div>
  </div>
</div>
          </div>
    </div>
          
      <div id="footer">
            
      
      </div>
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
      
  </body>
    
</html>
