<?php
	include 'function.php';
	$rid=$_GET["rid"];
	$q="select rid, pic from recipes where rid=".$rid;
	$r=do_query($_SESSION["link"], $q);
	$row = mysqli_fetch_array($r);
	$rid=$row["rid"];
	echo '<div class="container" style="width:900px;">
		<div><img src="data:image/jpg;base64,'.base64_encode($row["pic"]).'" width="500px"></div></div>';
						
	// recepis detail
	$query_set[4]='SELECT rid, rtitle, serv_num, rdescription, postdatetime, username from recipes natural join user where rid="'.$rid.'";';
	// ingredients
	$query_set[5]="SELECT iname, iquantities, unit from recipes natural join ingredients where rid='".$rid."';";
	// reviews
	$query_set[6]="SELECT reviewid, rating, title, text, suggestions, username from user natural join recipes join review on recipes.rid=review.rid where recipes.rid='".$rid."';";
	// links
	$query_set[3]="SELECT rid1, rtitle FROM link join recipes on link.rid1=recipes.rid where rid2=".$rid." union select rid2, rtitle from link join recipes on link.rid2=recipes.rid where rid1=".$rid;
	// tags
	$query_set[2]="SELECT tagname from tags natural join hastags where rid='".$rid."';";
	for($i=2;$i<7;$i++){		
		if($i==2){
			echo '<div class="container" style="width:200px;"><table class="table table-hover">';
			echo '<thead><label>tag:</label><th></th><th>tag name</th></thead><tbody>';
		}
		if($i==3){
			echo '<div class="container" style="width:600px;"><table class="table table-hover">';
			echo '<thead><label>related recipes:</label><th></th><th>rid</th><th>title</th></thead><tbody>';
		}
		if($i==4){
			echo '<div class="container" style="width:900px;"><table class="table table-hover">';
			echo '<thead><label>recipe detail:</label><th></th><th>rid</th><th>title</th>
				<th>servings</th><th>description</th><th>post time</th><th>creator</th></thead><tbody>';
		}
		if($i==5){
			// echo $query_set[$i];
			echo '<div class="container" style="width:900px;"><table class="table table-hover">';
			echo '<thead><label>ingredients:</label><th></th><th>ingredient name</th><th>quantities</th><th>unit</th></thead><tbody>';
		}
		if($i==6){
			echo '<div class="container" style="width:900px;"><table class="table table-hover">';
			echo '<thead><label>reviews:</label><th></th><th>review id</th><th>rating</th><th>title</th><th>text</th>
				<th>suggestion</th><th>reviewer</th></thead><tbody>';
		}
		if(!$result=do_query($_SESSION["link"], $query_set[$i])){
			echo "<p>no result found!</p>";
			continue;			
		}
			while($row = mysqli_fetch_array($result)){	
				echo '<tr><td>detail</td>';
				
				for ($x = 0; $x <count($row)/2; $x++) {
					
					echo "<td>".$row[$x]."</td>";
					
				}
				
				echo "</tr>";
			}

			echo "</tbody></table></div>";
			
	}
	
	echo "</div></div>";
	
	if(isset($_SESSION["check"]) && $_SESSION["check"]=="successful"){
		
		echo '<div class="container" style="width:900px;">
			<form class="form-signup" action="update.php" method="post">
			<div class="form-group">
				<input type="hidden" class="form-control" name="searchtype" value="addreview">
				<input type="hidden" class="form-control" name="rid" value="'.$rid.'">
			</div>';
		
		echo '<div class="form-group">
			<label for="text">review:</label>
			<textarea type="review" class="form-control" rows="1" required="required" name="title" placeholder="write title..."></textarea>
			<textarea type="review" class="form-control" rows="5" required="required" name="description" placeholder="write your review..."></textarea>
			<textarea type="review" class="form-control" rows="2" required="required" name="suggestion" placeholder="write your suggestion..."></textarea>
			</div>
			<div class="form-group">
				<select name="rating">
					<option value=5>5</option>
					<option value=4>4</option>
					<option value=3>3</option>
					<option value=2>2</option>
					<option value=1>1</option>
				</select>
			</div>
			<button type="submit" class="btn btn-default">Submit</button>
			</div></form>';
		}
?>