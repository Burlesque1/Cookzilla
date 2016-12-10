<?php
	include 'function.php';
	$rid=$_GET["rid"];
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
	for($i=2;$i<7;$i++){
		echo $query_set[$i].'<div class="container" style="width:900px;"><table class="table table-hover"><tbody>';
		
		if(!$result=do_query($_SESSION["link"], $query_set[$i])){
			echo "<p>no result found!</p>";
			continue;			
		}
			while($row = mysqli_fetch_array($result)){	
				echo '<tr><p>';
				
				for ($x = 0; $x <count($row)/2; $x++) {
					
					echo "<td>".$row[$x]."</td>";
					
				}
				
				echo "</p></tr>";
			}

			echo "</tbody></table></div>";
			
		}
		echo '<div class="form-group">
					<label for="text">review:</label>
					<textarea type="review" class="form-control" rows="5" id="description" placeholder="write your review..."></textarea>
				</div><button type="submit" class="btn btn-default">Submit</button>';
				
?>