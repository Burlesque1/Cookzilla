<?php
	include 'function.php';
	$query = "SELECT gid, gname, gdescription, username from groups join user on groups.creatorid=user.uid";
	if($result=do_query($_SESSION["link"], $query)){
		echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr>
			<th></th><th>gid</th><th>group name</th><th>description</th><th>creator</th>
			</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){
		
			echo '<tr><td><a href="group.php?gid='.$row[0].'">Detail</a></td>';
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			$Group_rid = "".$row[0]."";
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	}
?>