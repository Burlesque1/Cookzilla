<script type="text/javascript">
function show(id){
	// alert(id);
	var div=document.getElementById(id);
	if(div.style.display=="block"){ // == 判断div.display是否为显示
		div.style.display="none"; //= 赋值也可了解成改变
	}
	else{
		div.style.display="block";
	}
}
function foo(){
	// alert("hehe");
	var div=document.getElementById("table");
	if(div.style.display=="block"){ // == 判断div.display是否为显示
		div.style.display="none"; //= 赋值也可了解成改变
	}
	else{
		div.style.display="block";
	}
}
</script>
<?php
	include 'function.php';
	// event infomation
	echo'<div class="container" style="width:900px">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#Event">My Event</a></li>
			<li><a data-toggle="tab" href="#Profile">My Profile</a></li>
			<li><a data-toggle="tab" href="#Recipe">My Recipe</a></li>
			<li><a data-toggle="tab" href="#Group">My Group</a></li>
	    </ul>
	    <div class="tab-content">
		<div id="Event" class="tab-pane fade in active">';
	$query = "SELECT eid, ename, edescription, edatetime, gname from groups natural join event natural join rsvp natural join user
				where email='".$_SESSION['email']."'";
	//print_r($query);
	if($result=do_query($_SESSION["link"], $query)){
	echo '<div class="container" style="width:900px;"><label>Your events:<table class="table table-hover"><thead><tr>
			<th></th><th>eid</th><th>event name</th><th>description</th><th>event time</th><th>group</th>
			</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){
			
			echo '<tr><td><a href="">Edit</a></td>';
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></label></div>";
	} else{
		echo "<p>You have no coming event!</p>";
	}
	$tablename="'table'";
	echo '<u onclick="show('.$tablename.')">Create new event</u>
		<div class="container" id="table" style="width:900px; display:none ">
			<form class="form-signup" action="update.php" method="post">
			<div class="form-group">
			<label class="control-label" for="ename">Event name:</label>
			<input type="email" class="form-control" required="required" name="ename" placeholder="Event name...">
			</div>
			<div class="form-group">
			<label for="edescription">description:</label>
			<input type="text" class="form-control" rows="5" required="required" name="description" placeholder="Write some description...">
			</div>
			<div class="form-group">
			<label for="Schedule">Event schedule:</label>
			<input type="date" class="form-control" required="required" name="schdule">
			</div>
			<div class="form-group">
			<input type="time" class="form-control" required="required" name="schdule">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		  </div>
		</div>';
	
	// user profile
	echo '<div id="Profile" class="tab-pane fade">';
	$query = "SELECT uid, username, email, birthday, ucity, udescription, image from user where email='".$_SESSION['email']."'";	
	if($result=do_query($_SESSION["link"], $query)){
		echo '<div class="container" style="width:900px;"><label>Your profile:<table class="table table-hover"><thead><tr>
			<th>pic</th><th>uid</th><th>username</th><th>e-mail</th><th>birthday</th><th>city</th>
			<th>description</th></tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){
			
			echo '<tr><td><p><img src="data:image/jpg;base64,'.base64_encode($row["image"]).'" width="100px"></p></td>';
			
			for ($x = 0; $x <count($row)/2-1; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></label></div>";
	} else {
		
	}
	$tablename="'table2'";
	echo '<u onclick="show('.$tablename.')">Edit profile</u>
		<div class="container" id="table2" style="width:900px; display:none ">
			<form class="form-signup" action="update.php" method="post">
			<div class="form-group">
			<label class="control-label" for="uname">User name:</label>
			<input type="text" class="form-control" required="required" name="uname" placeholder="User name...">
			</div>
			<div class="form-group">
			<label for="birthday">Birthday:</label>
			<input type="date" class="form-control" required="required" name="birthday">
			</div>
			<div class="form-group">
			<label for="city">City:</label>
			<input type="text" class="form-control" required="required" name="city" placeholder="Your city...">
			</div>
			<div class="form-group">
			<label for="description">Description:</label>
			<input type="text" class="form-control" rows="5" required="required" name="description" placeholder="Write some description...">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		  </div>
		</div>';
		
	// recipes
	echo '<div id="Recipe" class="tab-pane fade">';
	$query = "SELECT rid, rtitle, serv_num, rdescription, postdatetime, pic from user natural join recipes where email='".$_SESSION['email']."'";
	if($result=do_query($_SESSION["link"], $query)){
		echo '<div class="container" style="width:900px;"><label>Your recipes:<table class="table table-hover"><thead><tr>
				<th></th><th>pic</th><th>rid</th><th>title</th><th>servings</th><th>description</th><th>post time</th><th>tag</th>
				</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){
			
			echo '<tr><td><a href="">Edit</a></td><td><p><img src="data:image/jpg;base64,'.base64_encode($row["pic"]).'" width="100px"></p></td>';
			
			for ($x = 0; $x <count($row)/2-1; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			// tag
			$query_s = "SELECT tagname from tags natural join hastags natural join recipes where rid='".$row['rid']."'";
			if($result_s=do_query($_SESSION["link"], $query_s)){
				echo "<td>";
				while($row_s = mysqli_fetch_array($result_s)){
					echo  "<span class='tag tag-pill tag-success'><p>".$row_s["tagname"]."</p></span>";
				}
				echo "</td>";
			} else {
				echo "<td>none</td>";
			}
			echo "</tr>";
		}
		echo "</tbody></table></label></div>";
	}
	$tablename="'table3'";
	echo '<u onclick="show('.$tablename.')">Create recipe</u>
		<div class="container" id="table3" style="width:900px; display:none ">
			<form class="form-signup" action="update.php" method="post">
			<div class="form-group">
			<label class="control-label" for="rname">Recipe title:</label>
			<input type="text" class="form-control" required="required" name="rname" placeholder="User name...">
			</div>
			<div class="form-group">
			<label for="serving">Servings:</label>
			<input type="number" class="form-control" required="required" name="serving">
			</div>
			<div class="form-group">
			<label for="description">Description:</label>
			<input type="text" class="form-control" rows="5" required="required" name="description" placeholder="Write some description...">
			</div>
			<div class="form-group">
			<label for="tag">Tag:</label>
			<input type="text" class="form-control" required="required" name="tag" placeholder="Write some description...">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		  </div>
		</div>';
		
	// group infomation
	echo '<div id="Group" class="tab-pane fade">';
	$query = "SELECT gid, gname, gdescription, u1.username from user as u1 join groups on u1.uid=groups.creatorid
				natural join joins join user as u2
				on joins.memberid=u2.uid where u2.email='".$_SESSION['email']."'";
	if($result=do_query($_SESSION["link"], $query)){
		echo '<div class="container" style="width:900px;"><label>Your groups:<table class="table table-hover"><thead><tr>
			<th></th><th>gid</th><th>group name</th><th>description</th><th>creator</th>
			</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){
		
			echo '<tr><td><a href="group.php?gid='.$row[0].'">Detail</a></td>';
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></label></div>";
	}
	echo '<u onclick="show()">Create group</u>
			<div class="container" id="table4" style="width:900px; display:none ">
			<form class="form-signup" action="update.php" method="post">
			<div class="form-group">
			<label class="control-label" for="ename">Group name:</label>
			<input type="text" class="form-control" required="required" name="ename" placeholder="User name...">
			</div>
			<div class="form-group">
			<label for="description">Description:</label>
			<input type="text" class="form-control" rows="5" required="required" name="description" placeholder="Write some description...">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		  </div>
		</div>';
?>
</div>
</body>
</html>