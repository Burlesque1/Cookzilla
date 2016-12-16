	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The width=device-width part sets the width of the page to follow the screen-width of the device (which will vary depending on the device) -->
		<!-- The initial-scale=1 part sets the initial zoom level when the page is first loaded by the browser -->
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Cookzilla Home Page</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!-- the orde of these files is very infortant -->
		<style>
			.carousel-inner > .item > img,
			.carousel-inner > .item > a > img {
				width: 70%;
				margin: auto;
			}
			
			.panel--search__type {
				background-position: 50%;
				background-repeat: no-repeat;
				background-size: cover;
				padding: 25px 50px;
			}
			#Summary {
				background: rgba(0,0,0,.55);
				background-image:url(b.jpg);
				border-radius: 4px;
				color:white;
				width:900px;
				padding: 15px 30px 20px;
				text-align: center;
				margin-top:50px;
				margin-bottom: 50px;
			}
			#searchtype {
				color:black;
				width:70px;
				height:48px;
				border-radius: 5px;
			}
			#search{
				width:400px;
				height:48px;
				border-radius: 5px;
			}
			#myCarousel
			{
				font: inherit;
				font-style: inherit;
				font-variant-ligatures: inherit;
				font-variant-caps: inherit;
				font-variant-numeric: inherit;
				font-weight: inherit;
				font-stretch: inherit;
				font-size: 100%;
				line-height: inherit;
				font-family: inherit;
			}
		</style>
	 <!-- Custom styles for this template -->
	 <link href="carousel.css" rel="stylesheet">
	</head>
	<!-- NAVBAR
		================================================== -->
		<body>
			<div class="navbar-wrapper">
				<div class="container">
					<nav class="navbar navbar-default navbar-fixed-top">
						<!-- navbar-inverse: black navbar -->
						<div class="container">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="#">Cookzilla</a>
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
										echo '<form action="logincheck.php" method="post" class="navbar-form">
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

			 <!-- Carousel
			 ================================================== -->
			 <div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>

				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img class="first-slide" src="6.jpg" alt="First slide" width="460" height="345">
						<div class="container">
							<div class="carousel-caption" style="background-color:hsla(210,8%,95%,.9);">
								<h1 class="story__headline" style="">Our awesome groups.</h1>
								<p>come and join us and have great meals and events</p>
								<p><a class="btn btn-lg btn-primary" href="allgroup.php" role="button">Welcome join us</a></p>
							</div>
						</div>
					</div>
					<div class="item">
						<img class="second-slide" src="4.jpg" alt="Second slide" width="460" height="345">
						<div class="container">
							<div class="carousel-caption" style="background-color:hsla(210,8%,95%,.9);">
								<h1 class="story__headline" style="">delicious no-cook plates to bring to a party.</h1>
								<p>these summery no-cook solutions that will ensure you're invited back. </p>
								<p><a class="btn btn-lg btn-primary" href="allrecipe.php" role="button">Learn more</a></p>
							</div>
						</div>
					</div>
					<div class="item">
						<img class="third-slide" src="8.jpg" alt="Third slide" width="460" height="345">
						<div class="container">
							<div class="carousel-caption" style="background-color:hsla(210,8%,95%,.9);">
								<h1 class="story__headline" style="">Wonderful events you don't want to miss.</h1>
								<p>you can have a lot of fun here</p>
								<p><a class="btn btn-lg btn-primary" href="allevent.php" role="button">Browse events</a></p>
							</div>
						</div>
					</div>
				</div>
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			 </div><!-- /.carousel -->

			<div class="container"  id="Summary">
			<section class="panel--search__type">
				
				<div class="row panel--search__wrap">

					<h1>Why Our Site Is Awesome</h1>
					<p class="lead">Search our collection of over 10,000 recipes</p>

					<form action="searchresult.php" method="get" class="navbar-search">
						<input type="text" id="search" name="keyword" class="search-query" placeholder="Search for...">
						<select name="searchtype" id="searchtype">
							<option value ="Recipe">Recipe</option>
							<option value="User">User</option>
							<option value ="Group">Group</option>
							<option value="Event">Event</option>
						</select>
						<button type="submit" class="btn btn-info btn-lg">Search</button>
					</form> 
				</div>
			</section>
			</div>
		<!-- Marketing messaging and featurettes
		================================================== -->
		<!-- Wrap the rest of the page in another container to center all the content. -->

		<div class="container marketing">

			<!-- Three columns of text below the carousel -->
			<div class="row">
				<div class="col-lg-4">
					<img class="img-circle" src="01.jpg" alt="Generic placeholder image" width="240" height="240">
					<h2>Sydney opens its first rice burger bar</h2>
					<p>Guess what? Burger nerds stuck in an unending "brioche vs milk bun" argument now have a new topic to battle: the bun-free burger...</p>
					<p><a target="view_window" class="btn btn-default" href="http://www.goodfood.com.au/eat-out/just-open/sydney-opens-its-first-rice-burger-bar-gojima-at-the-star-in-pyrmont-20161213-gtantw" role="button">View details &raquo;</a></p>
				</div><!-- /.col-lg-4 -->
				<div class="col-lg-4">
					<img class="img-circle" src="02.jpg" alt="Generic placeholder image" width="240" height="240">
					<h2>Cool off this summer with an Aperol spritz</h2>
					<p>The sunset is particularly orange at Pontoon. The sun ripples off St Kilda beach's waters but also over bronzed and hairless arms holding Aperol spritz by the jugful.</p>
					<p><a target="view_window" class="btn btn-default" href="http://www.goodfood.com.au/pontoon-st-kilda/pontoon-restaurant-review-20161212-gt9fpl" role="button">View details &raquo;</a></p>
				</div><!-- /.col-lg-4 -->
				<div class="col-lg-4">
					<img class="img-circle" src="03.jpg" alt="Generic placeholder image" width="240" height="240">
					<h2>Wake up to brunch by The best chefs</h2>
					<p>A Finnish brunch from the Pasi Petanen pop up at Auto Lab</p>
					<p><a target="view_window" class="btn btn-default" href="http://www.goodfood.com.au/auto-lab-chippendale/auto-lab-20161209-gt7ta9" role="button">View details &raquo;</a></p>
				</div><!-- /.col-lg-4 -->
			</div><!-- /.row -->


			<!-- START THE FEATURETTES -->

			<hr class="featurette-divider">

			<div class="row featurette">
				<div class="col-md-7">
					<h2 class="featurette-heading">DIY cocktails. <span class="text-muted">It'll blow your mind.</span></h2>
					<p class="lead">Plus retro puddings, lightbulb drinks and how to trick kids into eating brekkie. 
					Hopscotch, an urban beer bar, opened in Melbourne last Friday – but it's not the 30 beers on tap that have us talking. </p>
				</div>
				<div class="col-md-5">
					<img class="featurette-image img-responsive center-block" src="h1.jpg" alt="Generic placeholder image">
				</div>
			</div>

			<hr class="featurette-divider">

			<div class="row featurette">
				<div class="col-md-7 col-md-push-5">
					<h2 class="featurette-heading">Traditional Christmas menu.<span class="text-muted">Just try it</span></h2>
					<p class="lead">Can't decide what to cook this year? Try a mixed approach. It's the annual dilemma – to cook a traditional Christmas meal or a contemporary one? Here's the best of both worlds, the trad/mod Christmas dinner, 
					beginning with a do-ahead smoked salmon mousse brought bang up-to-date with a tangy herb gelee...</p>
				</div>
				<div class="col-md-5 col-md-pull-7">
					<img class="featurette-image img-responsive center-block" src="h2.jpg" alt="Generic placeholder image">
				</div>
			</div>

			<hr class="featurette-divider">

			<div class="row featurette">
				<div class="col-md-7">
					<h2 class="featurette-heading">Amazing vegetarian salads.<span class="text-muted">You'll want to try</span></h2>
					<p class="lead">Make these summer-friendly recipes from Hetty McKinnon's latest cookbook. Salad Recipes from Arthur Street Kitchen, which in turn was based on her small but flourishing business of cooking up hearty, vegetarian fare which she delivered (by bike) to those living near her home in Arthur Street in Sydney's Surry Hills... </p>
				</div>
				<div class="col-md-5">
					<img class="featurette-image img-responsive center-block" src="h3.jpg" alt="Generic placeholder image">
				</div>
			</div>

			<hr class="featurette-divider">

			<!-- /END THE FEATURETTES -->


			<!-- FOOTER -->
			<footer>
				<p class="pull-right"><a href="#">Back to top</a></p>
				<p>&copy; 2016 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
			</footer>

		</div><!-- /.container -->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<link href="carousel.css" rel="stylesheet">
	</body>
	</html>