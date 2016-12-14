<?php
	include 'function.php';
	$gid=$_GET["gid"];
	$q="select * from groups where gid=".$gid;
	echo $q;
	$r=do_query($_SESSION["link"], $q);
	$row = mysqli_fetch_array($r);
	// group detail
	$query_set[2]="select gid, gname, gdescription,username from groups join user on groups.creatorid=user.uid where gid=".$gid;
	// group member
	$query_set[3]="SELECT uid, username from joins join user on joins.memberid=user.uid where gid=".$gid;
	// events
	$query_set[4]="SELECT eid, ename, edescription, edatetime, username from groups natural join event join user on	
		event.creator_id=user.uid where gid=".$gid;

	for($i=2;$i<5;$i++){
		// echo $query_set[$i].'<div class="container" style="width:900px;"><table class="table table-hover"><tbody>';
		if($i==2){
			echo $query_set[$i].'<div class="container" style="width:600px;"><table class="table table-hover">';
			echo '<thead><label>group detail:</label><th>gid</th><th>group name</th><<th>description</th><th>creator</th></thead><tbody>';
		}
		if($i==3){
			echo $query_set[$i].'<div class="container" style="width:600px;"><table class="table table-hover">';
			echo '<thead><label>group member:</label><th>uid</th><th>username</th></thead><tbody>';
		}
		if($i==4){
			echo $query_set[$i].'<div class="container" style="width:600px;"><table class="table table-hover">';
			echo '<thead><label>group event:</label><th></th>eid<th>event name</th><th>description</th>
				<th>schedule</th><th>creator</th></thead><tbody>';
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
?>