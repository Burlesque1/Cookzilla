<?php
	include 'function.php';
	echo '<div class="container" style="width:900px;">
			<ul class="nav nav-tabs">
			<li class="nav-item""><a class="nav-link" data-toggle="tab" href="#Event">My Event</a></li>
			<li class="nav-item active"><a class="nav-link" data-toggle="tab" href="#Profile">My Profile</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Recipe">My Recipe</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Group">My Group</a></li>
		  </ul>
		  <div class="tab-content">';

	// event infomation
    echo'<div id="Event" class="tab-pane fade in active">';
	$query = "SELECT eid, ename, edescription, edatetime, gname from groups natural join event natural join rsvp natural join user
				where email='".$_SESSION['email']."'";
	//print_r($query);
	if($result=do_query($_SESSION["link"], $query)){
		echo '<label>Your events:<table class="table table-hover"><thead><tr>
			<th>eid</th><th>event name</th><th>description</th><th>event time</th><th>group</th>
			</tr></thead><tbody>';
			while($row = mysqli_fetch_array($result)){
			
			echo '<tr>';
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></label>";
	} else{
		echo "<p>You have no coming event!</p>";
	}
	echo "</div>";
	
	// user profile
	echo '<div id="Profile" class="tab-pane fade">';
	$query = "SELECT uid, username, email, birthday, ucity, udescription, image from user where email='".$_SESSION['email']."'";
	
	if($result=do_query($_SESSION["link"], $query)){
		echo '<label>Your profile:<table class="table table-hover"><thead><tr>
			<th>pic</th><th>uid</th><th>username</th><th>e-mail</th><th>birthday</th><th>city</th>
			<th>description</th></tr></thead><tbody>';
			while($row = mysqli_fetch_array($result)){
			
			echo '<tr><td><p><img src="data:image/jpg;base64,'.base64_encode($row["image"]).'" width="100px"></p></td>';
			
			for ($x = 0; $x <count($row)/2-1; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></label>";
	} else {
		
	}
	echo "</div>";
	
	// recipes
	echo '<div id="Recipe" class="tab-pane fade">';
	$query = "SELECT rid, rtitle, serv_num, rdescription, postdatetime, pic from user natural join recipes where email='".$_SESSION['email']."'";

	/* if($result=do_query($_SESSION["link"], $query)){
		echo '<label>Your recipes:<table class="table table-hover"><thead><tr>
			<th>pic</th><th>rid</th><th>title</th><th>servings</th><th>description</th><th>post time</th><th>tag</th>
			</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){
			echo '<tr><td><p><img src="data:image/jpg;base64,'.base64_encode($row["pic"]).'" width="100px"></p></td>';
			
			for ($x = 0; $x <count($row)/2-1; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			// tag
			$query_s = "SELECT tagname from tags natural join hastags natural join recipes where rid='".$row['rid']."'";
			
			print_r($query_s);
			
			if($result_s=do_query($_SESSION["link"], $query_s)){
				echo "<td>";
				while($row_s = mysqli_fetch_array($result_s)){
					echo "<span class='tag tag-pill tag-success'><p>".$row_s["tagname"]."</p></span>";
				}
				echo "</td>";
			} else {
				echo "<td>none</td>";
			}
			echo "</tr>";
		}
		echo "</tbody></table></label>";
	} */
	echo "</div>";
	
	// group infomation
	echo '<div id="Group" class="tab-pane fade">';
	$query = "SELECT gid, gname, gdescription, u1.username from user as u1 join groups on u1.uid=groups.creatorid
				natural join joins join user as u2
				on joins.memberid=u2.uid where u2.email='".$_SESSION['email']."'";
	// print_r($query);
	if($result=do_query($_SESSION["link"], $query)){
			echo '<label>Your groups:<table class="table table-hover">
			<thead><tr><th>gid</th><th>group name</th><th>description</th><th>creato</th>
			</tr></thead><tbody>';
			while($row = mysqli_fetch_array($result)){
			
			echo '<tr>';
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></label>";
	}
	echo "</div></div>";
?>