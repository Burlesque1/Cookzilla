<?php
	include 'function.php';
	$eid=$_POST["eid"];
	$q="select * from event where eid=".$eid;
	$r=do_query($_SESSION["link"], $q);
	$row = mysqli_fetch_array($r);
	// event detail
	$query_set[2]="select * from event natural join groups where eid=".$eid;
	echo '<div class="container" style="width:900px;"><table class="table table-hover">
			<thead><tr>
			<th>link</th><th>eid</th><th>event name</th><th>description</th><th>event time</th><th>group</th>
			</tr></thead><tbody>';
		
	if(!$result=do_query($_SESSION["link"], $query_set[2])){
		echo "<p>no result found!</p>";
	}
	while($row = mysqli_fetch_array($result)){	
		echo '<tr>';
		
		for ($x = 0; $x <count($row)/2; $x++) {
			
			echo "<td>".$row[$x]."</td>";
			
		}
		
		echo "</tr>";
	}

	echo "</tbody></table></div>";
		
	// attender
	$query_set[3]="SELECT eid, gid, ename,username from event natural join rsvp natural join user where eid=".$eid;
	echo '<div class="container" style="width:900px;"><table class="table table-hover">
			<thead><tr>
			<th>link</th><th>eid</th><th>event name</th><th>description</th><th>event time</th><th>group</th>
			</tr></thead><tbody>';
		
	if(!$result=do_query($_SESSION["link"], $query_set[3])){
		echo "<p>no result found!</p>";
	}
	while($row = mysqli_fetch_array($result)){	
		echo '<tr>';
		
		for ($x = 0; $x <count($row)/2; $x++) {
			
			echo "<td>".$row[$x]."</td>";
			
		}
		
		echo "</tr>";
	}

	echo "</tbody></table></div>";
	
	// report
	$query_set[4]="SELECT * from reporttoevent natural join report where eid=".$eid;
	echo '<div class="container" style="width:900px;"><table class="table table-hover">
			<thead><tr>
			<th>link</th><th>eid</th><th>event name</th><th>description</th><th>event time</th><th>group</th>
			</tr></thead><tbody>';
		
	if(!$result=do_query($_SESSION["link"], $query_set[4])){
		echo "<p>no result found!</p>";
	}
	while($row = mysqli_fetch_array($result)){	
		echo '<tr>';
		
		for ($x = 0; $x <count($row)/2; $x++) {
			
			echo "<td>".$row[$x]."</td>";
			
		}
		
		echo "</tr>";
	}

	echo "</tbody></table></div>";
?>