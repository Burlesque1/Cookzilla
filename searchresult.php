<?php
	include 'userpage.php';
	print_r($_GET);
	if($_GET["searchtype"] == "Recipe"){
		$q = "SELECT rid, rtitle, postdatetime, username, pic from recipes natural join user where rtitle like '%".$_GET['keyword']."%'";
		print_r($q);
		echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr><th>pic</th><th>#</th><th>Title</th><th>Post date</th><th>Creator</th></tr></thead><tbody>';
		$result=do_query($_SESSION["link"], $q);
		while($row = mysqli_fetch_array($result)){
			
			echo '<tr>
					<td>
						<form action="recipe.php" method="post">
							<input type="hidden" name="rid" value="'.$row["rid"].'">
							<button type="submit">
								<img src="data:image/jpg;base64,'.base64_encode($row["pic"]).'" width="100px">
							</button>
						</form>
					</td>';
			
			for ($x = 0; $x <count($row)/2-1; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}
			
		
		echo "</tbody></table></div>";
	}
	if($_GET["searchtype"] == "Group"){
		$q = "SELECT * from groups where gname like '%".$_GET['keyword']."%'";
		print_r($q);
		echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr><th>pic</th><th>uid</th><th>username</th><th>city</th><th>description</th></tr></thead><tbody>';
		$result=do_query($_SESSION["link"], $q);
		while($row = mysqli_fetch_array($result)){
			
			echo "<tr><td><form name='form1' action='group.php' method='post'>
				<input type='hidden' name='gid' value='".$row["gid"]."'> 
				  <button type='submit'>link</button>
				</form></td>";
				
			for ($x = 0; $x <count($row)/2; $x++) {
				
				echo '<td>'.$row[$x].'</td>';
				
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	}
	if($_GET["searchtype"] == "Event"){
		$q = "SELECT *	from event where ename like '%".$_GET['keyword']."%'";
		print_r($q);
		echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr><th>pic</th><th>uid</th><th>username</th><th>city</th><th>description</th></tr></thead><tbody>';
		$result=do_query($_SESSION["link"], $q);
		while($row = mysqli_fetch_array($result)){
			
			echo "<tr><td><form name='form1' action='event.php' method='post'>
				<input type='hidden' name='eid' value='".$row["eid"]."'> 
				  <button type='submit'>link</button>
				</form></td>";
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	}
	if($_GET["searchtype"] == "User"){
		$q = "SELECT uid, username, ucity, udescription, image from user where username like '%".$_GET['keyword']."%'";
		print_r($q);
		echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr><th>pic</th><th>uid</th><th>username</th><th>city</th><th>description</th></tr></thead><tbody>';
		$result=do_query($_SESSION["link"], $q);
		while($row = mysqli_fetch_array($result)){
			
			echo '<tr><td><p><img src="data:image/jpg;base64,'.base64_encode($row["image"]).'" width="100px"></p></td>';
			
			for ($x = 0; $x <count($row)/2-1; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	}
?>