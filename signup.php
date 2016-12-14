<?php
	include 'function.php';
?>

<html lang="en">
    
  <body data-spy="scroll" data-target="#navbar" data-offset="150">
		<div class="container" >
		  <form class="form-signup" action="signupcheck.php" method="post">
			<div class="form-group">
				<label class="control-label" for="email">Email address:</label>
				<input type="email" class="form-control" required="required" name="email" placeholder="Email address">
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" class="form-control" required="required" name="password" placeholder="Password">
			</div>
			<div class="form-group">
				<label for="confirm_psw">Confirm Password:</label>
				<input type="password" class="form-control" required="required" name="confirm_psw" placeholder="Confirm Password">
			</div>
			
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" class="form-control" name="username" placeholder="Username">
			</div>
			<div class="form-group">
				<label for="birthday">Birthday:</label>
				<input type="date" class="form-control" name="birthday" placeholder="xxxx-xx-xx">
			</div>
			<div class="form-group">
				<label for="city">City:</label>
				<input type="text" class="form-control" name="city" placeholder="city you live in">
			</div>
			<div class="form-group">
				<label for="text">Description:</label>
				<textarea type="description" class="form-control" rows="5" name="description" placeholder="describe yourself"></textarea>
			</div>
			<div class="form-group">
				<label for="text">Image(.jpeg, .png):</label>				 
				<input type="file" name="image" placeholder=".jpeg, .png">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>

		</div> <!-- /container -->
	
	</body>
</html>
