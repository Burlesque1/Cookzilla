<?php
	include 'function.php';
	echo'<div class="container" style="width:900px">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#recipe">Recipe History</a></li>
			<li><a data-toggle="tab" href="#tag"> Tag History</a></li>
			<li><a data-toggle="tab" href="#searchwords">Search History </a></li>
	    </ul>
	    <div class="tab-content">
		<div id="recipe" class="tab-pane fade in active">';
		//recipe
		$query = "SELECT logid, rid, rtitle, serv_num, rdescription, logtime, pic from log join recipes where log.uid='".$_SESSION["uid"]."' and log.logtype='recipe' and log.logvalue=recipes.rtitle order by logtime DESC";
		print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr>
			<th></th><th>pic</th><th>logid</th><th>rid</th><th>rtitle</th><th>serv_num</th><th>rdescription</th><th>logtime</th><th>edit</th>
			</tr></thead><tbody>';
			while($row = mysqli_fetch_array($result)){
				echo '<tr><td><a href="recipe.php?rid='.$row['rid'].'">Detail</a></td><td><p><img src="data:image/jpg;base64,'.base64_encode($row["pic"]).'" width="100px"></p></td>';

				for ($x = 0; $x <count($row)/2-1; $x++) {
				
					echo "<td>".$row[$x]."</td>";
				
				}
				$logid = "".$row["logid"]."";
				echo '<td><a href="update.php?searchtype=delete_log&logid='.$logid.'" class="btn btn-danger" role="button">Delete</a></td>';
				echo "</tr>";	
			}
			echo "</tbody></table></div>";
		} else{
			echo "<p>You have no recipe log!</p>";
		}
		echo'</div>';
		//tag
		echo '<div id="tag" class="tab-pane fade">';
		$query = "SELECT logid, logvalue, logtime from log join tags on log.logvalue=tags.tagname where log.uid=".$_SESSION["uid"]." and log.logtype='tag' order by logtime DESC";
		print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr>
			<th>logid</th><th>logvalue</th><th>logtime</th><th>edit</th>
			</tr></thead><tbody>';
			while($row = mysqli_fetch_array($result)){
				echo '<tr>';

				for ($x = 0; $x <count($row)/2; $x++) {
				
					echo "<td>".$row[$x]."</td>";
				
				}
				$logid = "".$row["logid"]."";
				echo '<td><a href="update.php?searchtype=delete_log&logid='.$logid.'" class="btn btn-danger" role="button">Delete</a></td>';
				echo "</tr>";	
			}
			echo "</tbody></table></div>";
		} else{
			echo "<p>You have no tag log!</p>";
		}
		echo'</div>';
		//Search
		echo '<div id="searchwords" class="tab-pane fade">';
		$query = "SELECT logid, logvalue, logtime from log where log.uid='".$_SESSION["uid"]."' and logtype = 'search' order by logtime DESC";
		print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr>
			<th>logid</th><th>logvalue</th><th>logtime</th><th>edit</th>
			</tr></thead><tbody>';
			while($row = mysqli_fetch_array($result)){
				echo '<tr>';

				for ($x = 0; $x <count($row)/2; $x++) {
				
					echo "<td>".$row[$x]."</td>";
				
				}
				$logid = "".$row["logid"]."";
				echo '<td><a href="update.php?searchtype=delete_log&logid='.$logid.'" class="btn btn-danger" role="button">Delete</a></td>';
				echo "</tr>";	
			}
			echo "</tbody></table></div>";
		} else{
			echo "<p>You have no search log!</p>";
		}
		echo'</div>';

	echo'</div>';
echo'</div>';
?>