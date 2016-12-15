<?php
	include 'function.php';
	$query = "SELECT eid, ename, edescription, edatetime from event";
	if($result=do_query($_SESSION["link"], $query)){
	echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr>
			<th></th><th>eid</th><th>event name</th><th>description</th><th>event time</th>
			</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){
			
			echo '<tr><td><a href="event.php?eid='.$row[0].'">Detail</a></td>';
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	} else{
		echo "<p>You have not created event!</p>";
	}