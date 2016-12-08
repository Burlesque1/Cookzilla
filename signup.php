<!DOCTYPE html>

<html lang="en">
    
  <head>
      
    <meta charset="utf-8">
      
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
      
      <style>

          
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
              <a class="nav-link" href="#footer">???</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#footer">about</a>
            </li>
          </ul>
          <form action="logincheck.php" method="post" class="form-inline pull-xs-right">
            <input class="form-control" type="email" name="email" placeholder="Email">
              <input class="form-control" type="password" name="password" placeholder="Password">
            <button class="btn btn-success" type="submit">Login</button>
			
			<!-- alternative: check input then forward -->
			
          </form>
        </nav>
		<a href="login.html">back</a>
		<div class="container">
		  <form class="form-signup" action="signupcheck.php" method="post">
			<div class="form-group">
				<label class="control-label" for="email">Email address:</label>
				<input type="email" class="form-control" id="email" placeholder="Email address">
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" class="form-control" id="password" placeholder="Password">
			</div>
			<div class="form-group">
				<label for="confirm_psw">Confirm Password:</label>
				<input type="password" class="form-control" id="confirm_psw" placeholder="Confirm Password">
			</div>
			<!-- optional
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" class="form-control" id="username" placeholder="Username">
			</div>
			<div class="form-group">
				<label for="birthday">Birthday:</label>
				<input type="date" class="form-control" id="birthday" placeholder="xxxx-xx-xx">
			</div>
			<div class="form-group">
				<label for="city">City:</label>
				<input type="text" class="form-control" id="city" placeholder="city you live in">
			</div>
			<div class="form-group">
				<label for="text">Description:</label>
				<textarea type="description" class="form-control" rows="5" id="description" placeholder="describe yourself"></textarea>
			</div>
			<div class="form-group">
				<label for="text">Image(.jpeg, .png):</label>				 
				<input type="file" name="image" placeholder=".jpeg, .png">
			</div>
			 -->
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>

		</div> <!-- /container -->
	</body>
</html>