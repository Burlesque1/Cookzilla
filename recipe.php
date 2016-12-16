<?php
	include 'function.php';
	$rid=$_GET["rid"];
	$q="select rid, pic, picii, piciii from recipes where rid=".$rid;
	$r=do_query($_SESSION["link"], $q);
	$row = mysqli_fetch_array($r);
	$rid=$row["rid"];

	$query_set[4]='SELECT rid, rtitle, serv_num, rdescription, postdatetime, username from recipes natural join user where rid="'.$rid.'";';
	$query_set[5]="SELECT iname, iquantities, unit from recipes natural join ingredients where rid='".$rid."';";
	$query_set[6]="SELECT reviewid, rating, title, text, suggestions, username, pic1, pic2, pic3 from user natural join recipes join review on recipes.rid=review.rid where recipes.rid='".$rid."';";
	$query_set[3]="SELECT rid1, rtitle FROM link join recipes on link.rid1=recipes.rid where rid2=".$rid." union select rid2, rtitle from link join recipes on link.rid2=recipes.rid where rid1=".$rid;
	$query_set[2]="SELECT tagname from tags natural join hastags where rid='".$rid."';";
	for($i=2;$i<7;$i++){		
		if($i==2){ 	// tag
			echo '<div class="container" style="width:600px;">
					<div>';
			if($row["pic"])
				echo '<img src="data:image/jpg;base64,'.base64_encode($row["pic"]).'" width="500px">';
			if($row["picii"])
				echo '<img src="data:image/jpg;base64,'.base64_encode($row["picii"]).'" width="500px">';
			if($row["piciii"])
				echo '<img src="data:image/jpg;base64,'.base64_encode($row["piciii"]).'" width="500px">';
			echo '</div><table class="table table-hover"><thead><th></th></thead><tbody>
			<tr>';
		}
		if($i==3){	// related recipes
			// print_r($query_set[3]);
			echo '<div class="container" style="width:900px;"><table class="table table-hover">';
			echo '<thead><label>Related Recipes:</label><th></th><th>rid</th><th>title</th></thead><tbody>';
		}
		if($i==4){	// recipe detail
			echo '<div class="container" style="width:900px;"><table class="table table-hover">';
			echo '<thead><label>Recipe Tetail:</label><th>rid</th><th>title</th>
				<th>servings</th><th>description</th><th>post time</th><th>creator</th></thead><tbody>';
		}
		if($i==5){	// ingredients
			echo '<div class="container" style="width:900px;"><table class="table table-hover">';
			echo '<thead><label>Ingredients:</label><th>ingredient name</th><th>quantities</th><th>unit</th></thead><tbody>';
		}
		if($i==6){	// comments
			echo '<div class="container" style="width:900px;"><table class="table table-hover">';
			echo '<thead><label>Comments:</label><th>comment id</th><th>rating</th><th>title</th><th>text</th>
				<th>suggestion</th><th>Reviewer</th></thead><tbody>';
		}
		if(!$result=do_query($_SESSION["link"], $query_set[$i])){
			echo "<p>no result found!</p>";
			continue;			
		}
			while($row = mysqli_fetch_array($result)){
				if(!isset($row['tagname']))
					echo '<tr>';	
				if($i==3){
					echo '<td><a class="btn btn-info" href="recipe.php?rid='.$row["rid1"].'">detail</a></td>';
				}
				// if($i==6){
					// echo '<td><a class="btn btn-info" href="review.php?reviewid='.$row["reviewid"].'">detail</a></td>';
				// }
				for ($x = 0; $x <count($row)/2; $x++) {
					if($i==6 && $x==count($row)/2-3)
						break;
					if(isset($row['tagname'])) {
						echo '<td><a class="btn btn-warning" href="allrecipe.php?searchtype=tagtorecipe&tagname='.$row['tagname'].'">'.$row['tagname'].'</a></td>';
						
					} else {
						echo "<td>".$row[$x]."</td>";
					}
					
				}
				if($i==6){
					// echo '<td>a</td><td>a</td><td>a</td>';
					// if($row["pic1"])
						// echo '<td><p><img src="data:image/jpg;base64,'.base64_encode($row["pic1"]).'></p></td>';
					// if($row["pic2"])
						// echo '<td><p><img src="data:image/jpg;base64,'.base64_encode($row["pic2"]).'></p></td>';
					// if($row["pic3"])
						// echo '<td><p><img src="data:image/jpg;base64,'.base64_encode($row["pic3"]).'></p></td>';
					// print_r($row);
				}
				if(!isset($row['tagname']))
					echo "</tr>";
			}

			echo "</tbody></table></div>";
			
	}
	
	echo "</div></div>";
	//insert into log
	if(isset($_SESSION["check"]) && $_SESSION["check"]=="successful"){
		//insert into logs
		$query='SELECT rtitle from recipes where rid="'.$rid.'";';
		if($result=do_query($_SESSION["link"], $query)){
			$rtitle = mysqli_fetch_array($result)[0];
			if($stmt = $_SESSION["link"]->prepare("INSERT INTO log (uid, logtype, logvalue, logtime) VALUES (?, ?, ?, now())")) {
				$recipe = 'recipe';
				$stmt->bind_param("iss", $_SESSION["uid"], $recipe, $rtitle);
				$stmt->execute();
				$stmt->close();
			}
		} else {
			echo "<script>alert('fail！');</script>";
		}

		echo '<div class="container" style="width:900px;">
			<form class="form-signup" action="update.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<input type="hidden" class="form-control" name="searchtype" value="addreview">
				<input type="hidden" class="form-control" name="rid" value="'.$rid.'">
			</div>
			<label for="comment">comment:</label>
				<div class="form-group">
					<textarea type="review" class="form-control" rows="1" required="required" name="title" placeholder="write title..."></textarea>
					<textarea type="review" class="form-control" rows="5" required="required" name="description" placeholder="write your review..."></textarea>
					<textarea type="review" class="form-control" rows="2" name="suggestion" placeholder="write your suggestion..."></textarea>
				</div>
				<div class="form-group">
				<label for="rating">rating:</label>
					<select name="rating">
						<option value=5>5</option>
						<option value=4>4</option>
						<option value=3>3</option>
						<option value=2>2</option>
						<option value=1>1</option>
					</select>
				</div>
				
				<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</form>';
		}
?>