<?php
	include 'userpage.php';
	$eid=$_POST["eid"];
	$q="select * from event where eid=".$eid;
	$r=do_query($_SESSION["link"], $q);
	$row = mysqli_fetch_array($r);
	// event detail
	$query_set[2]="select * from event natural join groups where eid=".$eid;
	// attender
	$query_set[3]="SELECT eid, gid, ename,username from event natural join rsvp natural join user where eid=".$eid;
	// report
	$query_set[4]="SELECT * from reporttoevent natural join report where eid=".$eid;
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