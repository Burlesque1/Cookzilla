<?php
	include 'function.php';
	if($_GET["searchtype"] == "Recipe"){
		//insert into log;
		$logvalue='search';
		if(isset($_SESSION["check"]) && $_SESSION["check"]=="successful"){
			if($stmt = $_SESSION["link"]->prepare("INSERT INTO log (uid, logtype, logvalue, logtime) VALUES (?, ?, ?, now())")) {
			$stmt->bind_param("iss", $_SESSION["uid"], $logvalue, $_GET['keyword']);
			$stmt->execute();
			$stmt->close();
			} else {
		    	echo "Inserted into log table false";
			}
		}

		if($stmt = $_SESSION["link"]->prepare("select rid, rtitle, postdatetime, username, pic from recipes natural join user where rtitle like ? order by rid")) {
			$keyword = '%'.$_GET['keyword'].'%';
			$stmt->bind_param("s", $keyword);
			$stmt->execute();
			$stmt->bind_result($rid, $rtitle, $postdatetime, $username, $pic);
			echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr><th>pic</th><th>#</th><th>Title</th><th>Post date</th><th>Creator</th></tr></thead><tbody>';
			while($stmt->fetch()) {
				echo '<tr>
					<td>
						<form action="recipe.php" method="get">
							<input type="hidden" name="rid" value=$rid>
							<button type="submit" >
								<img src="data:image/jpg;base64,'.base64_encode($pic).'" width="100px">
							</button>
						</form>
					</td>';
					echo "<td>".$rid."</td>";	
					echo "<td>".$rtitle."</td>";
					echo "<td>".$postdatetime."</td>";
					echo "<td>".$username."</td>";
				echo "</tr>";
			}
			$stmt->close();
			echo "</tbody></table></div>";
		} else {
	    	echo "Select recipes from recipes table false";
	    }
	}

	if($_GET["searchtype"] == "Group"){
		if($stmt = $_SESSION["link"]->prepare("SELECT gid, gname, gdescription, username  from groups join user on groups.creatorid=user.uid where gname like ?")) {
			$keyword = '%'.$_GET['keyword'].'%';
			$stmt->bind_param("s", $keyword);
			$stmt->execute();
			$stmt->bind_result($gid, $gname, $gdescription, $username);
			echo '<div class="container" style="width:900px;"><table class="table table-hover">
			<thead><tr><th></th><th>group name</th><th>description</th><th>creator</th></tr></thead><tbody>';
			while($stmt->fetch()) {
				echo "<tr><td><form name='form1' action='group.php' method='get'>
				<input type='hidden' name='gid' value='".$gid."'> 
				  <button type='submit' class='btn btn-info'>link</button>
				</form></td>";
					echo "<td>".$gname."</td>";	
					echo "<td>".$gdescription."</td>";
					echo "<td>".$username."</td>";
				echo "</tr>";
			}
			$stmt->close();
			echo "</tbody></table></div>";
		} else {
	    	echo "Select group from groups table false";
	    }
	}

	if($_GET["searchtype"] == "Event"){
		if($stmt = $_SESSION["link"]->prepare("SELECT eid, ename, edescription, edatetime, gname, username from groups natural join event join user on event.creator_id=user.uid where ename like ?")) {
			$keyword = '%'.$_GET['keyword'].'%';
			$stmt->bind_param("s", $keyword);
			$stmt->execute();
			$stmt->bind_result($eid, $ename, $edescription, $edatetime, $gname, $username);
			echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr>
			<th></th><th>event name</th><th>event description</th><th>schedule</th><th>group</th><th>creator</th></tr></thead><tbody>';
			while($stmt->fetch()) {
				echo "<tr><td><form name='form1' action='event.php' method='get'>
				<input type='hidden' name='eid' value='".$eid."'> 
				  <button type='submit' class='btn btn-info'>link</button>
				</form></td>";
					echo "<td>".$ename."</td>";	
					echo "<td>".$edescription."</td>";	
					echo "<td>".$edatetime."</td>";	
					echo "<td>".$gname."</td>";
					echo "<td>".$username."</td>";
				echo "</tr>";
			}
			$stmt->close();
			echo "</tbody></table></div>";
		} else {
	    	echo "Select event from event table false";
	    }
	}


	if($_GET["searchtype"] == "User"){
		if($stmt = $_SESSION["link"]->prepare("SELECT uid, username, ucity, udescription, image from user where username like ?")) {
			$keyword = '%'.$_GET['keyword'].'%';
			$stmt->bind_param("s", $keyword);
			$stmt->execute();
			$stmt->bind_result($uid, $username, $ucity, $udescription, $image);
			echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr><th>pic</th><th>username</th><th>city</th><th>description</th></tr></thead><tbody>';
			while($stmt->fetch()) {
				echo '<tr><td><p><img src="data:image/jpg;base64,'.base64_encode($image).'" width="100px"></p></td>';
					echo "<td>".$username."</td>";	
					echo "<td>".$ucity."</td>";	
					echo "<td>".$udescription."</td>";	
				echo "</tr>";
			}
			$stmt->close();
			echo "</tbody></table></div>";
		} else {
	    	echo "Select event from event table false";
	    }
	}
?>