<?php
	include 'userpage.php'; 
	if(isset($_POST["rid"])){
		$rid=$_POST["rid"];
		$q="select pic from recipes where rid=".$rid;
		
		$r=do_query($_SESSION["link"], $q);
		$row = mysqli_fetch_array($r);
		echo '<div><img src="data:image/jpg;base64,'.base64_encode($row["pic"]).'" width="100px"></div>';
							
		// recepis detail
		$query_set[2]='SELECT rid, rtitle, serv_num, rdescription, postdatetime, uid from recipes where rid="'.$rid.'";';
		// ingredients
		$query_set[3]="SELECT iname, iquantities, unit from recipes natural join ingredients where rid='".$rid."';";
		// reviews
		$query_set[4]="SELECT reviewid, uid, rating, title, text, suggestions from recipes natural join review where rid='".$rid."';";
		// links
		$query_set[5]="SELECT rid1 FROM link where rid2=".$rid." union select rid2 from link where rid1=".$rid;
		// tags
		$query_set[6]="SELECT tagname from tags natural join hastags where rid='".$rid."';";
		print_r($query);
		for($i=2;$i<7;$i++){
			echo $query_set[$i].' <div class="container" style="width:900px;">
			<table class="table table-hover">
				  <tbody>';
			
			if(!$result=do_query($_SESSION["link"], $query_set[$i])){
				echo "<p>no result found!</p>";
				continue;			
			}
			while($row = mysqli_fetch_array($result)){	
				echo '<tr>';
				
				for ($x = 0; $x <count($row)/2; $x++) {
					
					echo "<td>".$row[$x]."</td>";
					
				}
				
				echo "</tr>";
			}

			echo "</tbody></table></div>";
			
		}
		echo '<div class="form-group">
					<label for="text">review:</label>
					<textarea type="review" class="form-control" rows="5" id="description" placeholder="write your review..."></textarea>
				</div><button type="submit" class="btn btn-default">Submit</button>';
	}
	else{
		print_r($_GET);
		if($_GET["searchtype"] == "Recipe"){
			$q = "SELECT rid, rtitle, postdatetime, username, pic from recipes natural join user where rtitle like '%".$_GET['keyword']."%'";
			print_r($q);
			echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr><th>pic</th><th>#</th><th>Title</th><th>Post date</th><th>Creator</th></tr></thead><tbody>';
			$result=do_query($_SESSION["link"], $q);
			while($row = mysqli_fetch_array($result)){
				
				echo '<tr>
						<td>
							<form action="#" method="post">
								<input type="hidden" name="rid" value="'.$row["rid"].'">
								<button type="submit">
									<img src="data:image/jpg;base64,'.base64_encode($row["pic"]).'" width="100px">
								</button>
							</form>
						</td>';
				
				for ($x = 0; $x <count($row)/2-1; $x++) {
					
					echo "<td>".$row[$x]."</td>";
					
				}
				
				echo "</tr>";
			}
				
			
			echo "</tbody></table></div>";
		}
		if($_GET["searchtype"] == "Group"){
			$q = "SELECT * from groups where gname like '%".$_GET['keyword']."%'";
			print_r($q);
			echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr><th>pic</th><th>uid</th><th>username</th><th>city</th><th>description</th></tr></thead><tbody>';
			$result=do_query($_SESSION["link"], $q);
			while($row = mysqli_fetch_array($result)){
				
				echo '<tr>';
				
				for ($x = 0; $x <count($row)/2; $x++) {
					
					echo "<td>".$row[$x]."</td>";
					
				}
				
				echo "</tr>";
			}
			echo "</tbody></table></div>";
		}
		if($_GET["searchtype"] == "Event"){
			$q = "SELECT *	from event where ename like '%".$_GET['keyword']."%'";
			print_r($q);
			echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr><th>pic</th><th>uid</th><th>username</th><th>city</th><th>description</th></tr></thead><tbody>';
			$result=do_query($_SESSION["link"], $q);
			while($row = mysqli_fetch_array($result)){
				
				echo '<tr>';
				
				for ($x = 0; $x <count($row)/2; $x++) {
					
					echo "<td>".$row[$x]."</td>";
					
				}
				
				echo "</tr>";
			}
			echo "</tbody></table></div>";
		}
		if($_GET["searchtype"] == "User"){
			$q = "SELECT uid, username, ucity, udescription, image from user where username like '%".$_GET['keyword']."%'";
			print_r($q);
			echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr><th>pic</th><th>uid</th><th>username</th><th>city</th><th>description</th></tr></thead><tbody>';
			$result=do_query($_SESSION["link"], $q);
			while($row = mysqli_fetch_array($result)){
				
				echo '<tr><td><p><img src="data:image/jpg;base64,'.base64_encode($row["image"]).'" width="100px"></p></td>';
				
				for ($x = 0; $x <count($row)/2-1; $x++) {
					
					echo "<td>".$row[$x]."</td>";
					
				}
				
				echo "</tr>";
			}
			echo "</tbody></table></div>";
		}
	}	
?>