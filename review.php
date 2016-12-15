<?php
	include 'function.php';
	print_r($_GET);
	$query="select * from review where reviewid=".$_GET["reviewid"];
	if($result=do_query($_SESSION["link"], $query){
		$row = mysqli_fetch_array($result);
		echo '<div class="container" style="width:900px;"><table class="table table-hover">';
			 '<thead><label>comment detail:</label><th>review id</th><th>rating</th><th>title</th><th>text</th>
				<th>suggestion</th><th>reviewer</th></thead><tbody>';
	}

?>