<?php
	include 'function.php';
	$eid=$_GET["eid"];
	
	// event detail
	$query_set[2]="select eid, ename, edescription, edatetime, creatorid, gname from event natural join groups where eid=".$eid;
	if($result=do_query($_SESSION["link"], $query_set[2])){
		echo '<div class="container" style="width:900px;"><label>Event detail:</label><table class="table table-hover"><thead><tr>
			<th>eid</th><th>event name</th><th>description</th><th>event time</th><th>creator</th><th>group</th>
			</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){	
			echo '<tr>';
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}

		echo "</tbody></table></div>";
	}
		
	// attender
	$query_set[3]="SELECT username, email, ucity, udescription, image from event natural join rsvp natural join user where eid=".$eid;
	if($result=do_query($_SESSION["link"], $query_set[3])){
		echo '<div class="container" style="width:900px;"><label>Attender:</label>
				<table class="table table-hover"><thead><tr>
				<th>image</th><th>name</th><th>email</th><th>city</th><th>description</th>
				</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){	
			echo '<tr><td><p><img src="data:image/jpg;base64,'.base64_encode($row["image"]).'" width="100px"></p></td>';
			for ($x = 0; $x <count($row)/2-1; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	}
	
	// report
	$query_set[4]="SELECT reportid, title, content, writerid, pic1, pic2, pic3 from reporttoevent natural join report where eid=".$eid;
	if($result=do_query($_SESSION["link"], $query_set[4])){
		echo '<div class="container" style="width:900px;"><label>Event report:</label>
			<table class="table table-hover"><thead><tr>
			<th>report id</th><th>title</th><th>content</th><th>writer</th><th>pic</th><th>pic</th><th>pic</th>
			</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){	
			echo '<tr>';
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				if(!$row[$x])
					continue;
				if($x<count($row)/2-3)
					echo "<td>".$row[$x]."</td>";
				else
					echo '<td><p><img src="data:image/jpg;base64,'.base64_encode($row[$x]).'" width="100px"></p></td>';
			
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	}
?>