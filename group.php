<?php
	include 'function.php';
	$gid=$_GET["gid"];
	$q="select * from groups where gid=".$gid;
	$r=do_query($_SESSION["link"], $q);
	$row = mysqli_fetch_array($r);
	// group detail
	$query_set[2]="select * from groups where gid=".$gid;
	// group member
	$query_set[3]="SELECT uid, username from joins join user on joins.memberid=user.uid where gid=".$gid;
	// events
	$query_set[4]="SELECT eid, ename, edescription, edatetime from groups natural join event where gid=".$gid;

	for($i=2;$i<5;$i++){
		if($i==2) {
			echo '<div class="container" style="width:900px;"><label>Detail:</label><table class="table table-hover"><tbody>';
		}
		if($i==3) {
			echo '<div class="container" style="width:900px;"><label>Group Member:</label><table class="table table-hover"><tbody>';
		}
		if($i==4) {
			echo '<div class="container" style="width:900px;"><label>Event:</label><table class="table table-hover"><tbody>';
		}
		
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
	
	echo '<div class="container" style="width:900px;">
	<a class="btn btn-danger" href="update.php?searchtype=joingroup&gid='.$gid.'">Join us</a>
	</div>';
?>