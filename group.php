<?php
	include 'userpage.php';
	$gid=$_POST["gid"];
	$q="select * from groups where gid=".$gid;
	echo $q;
	$r=do_query($_SESSION["link"], $q);
	$row = mysqli_fetch_array($r);
	// group detail
	$query_set[2]="select * from groups where gid=".$gid;
	// group member
	$query_set[3]="SELECT uid, username from joins join user on joins.memberid=user.uid where gid=".$gid;
	// events
	$query_set[4]="SELECT eid, ename, edescription, edatetime from groups natural join event where gid=".$gid;
	/* // links
	$query_set[5]="SELECT rid1 FROM link where rid2=".$rid." union select rid2 from link where rid1=".$rid;
	// tags
	$query_set[6]="SELECT tagname from tags natural join hastags where rid='".$rid."';";
	*/
	for($i=2;$i<5;$i++){
		echo $query_set[$i].'<div class="container" style="width:900px;"><table class="table table-hover"><tbody>';
		
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