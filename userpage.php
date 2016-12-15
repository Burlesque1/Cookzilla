<style>
	#in{
		width:400px;
	}
	#in2{
		width:60px;
		height:30px;
	}


</style>
<script type="text/javascript">
function addRow(){
	var newTr = ingre.insertRow();
	var newTd0 = newTr.insertCell();
	var newTd1 = newTr.insertCell();
	var newTd2 = newTr.insertCell();
	var num=ingre.rows.length.toString();	
	// alert(ingre.rows.length);
	
	newTd0.innerHTML='<input id="in" type="text" class="form-control"required="required" name="ingredient'+num+'" placeholder="Ingredient...">';
	newTd1.innerHTML= '<input id="in" type="number" class="form-control"required="required" name="quantities'+num+'" placeholder="Quantities...">';
	newTd2.innerHTML= '<select id="in2" name="unit'+num+'"><option>gram</option><option>pcs</option><option>mililiter</option></select>';
	
	var numRow=document.getElementById("nr");
	numRow.value=ingre.rows.length;
	alert(numRow.value);
}
function show(id){
	// alert(id);
	var div=document.getElementById(id);
	if(div.style.display=="block"){ 
		div.style.display="none"; 
	}
	else{
		div.style.display="block";
	}
}
function foo(){
	// alert("hehe");
	var div=document.getElementById("table");
	if(div.style.display=="block"){ 
		div.style.display="none"; 
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
			<li><a data-toggle="tab" href="#rsvp">My RSVP</a></li>
	    </ul>
	    <div class="tab-content">
		<div id="Event" class="tab-pane fade in active">';
	$query = "SELECT eid, ename, edescription, edatetime, gname from groups natural join event join user on user.uid=event.creator_id
				where email='".$_SESSION['email']."'";
	if($result=do_query($_SESSION["link"], $query)){
	echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr>
			<th></th><th>eid</th><th>event name</th><th>description</th><th>event time</th><th>group</th><th>edit</th>
			</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){
			
			echo '<tr><td><a href="event.php?eid='.$row[0].'">Detail</a></td>';
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			$Event_eid = "".$row["eid"]."";
			echo '<td><a href="update.php?searchtype=delete_event&eid='.$Event_eid.'" class="btn btn-danger" role="button">Cancel</a></td>';
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	} else{
		echo "<p>You have not created event!</p>";
	}
	$tablename="'table'";
	echo '<u onclick="show('.$tablename.')">Create new event</u>
		<div class="container" id="table" style="width:900px; display:none ">
			<form class="form-signup" action="update.php" method="post">
			<div class="form-group">
				<input type="hidden" class="form-control" name="searchtype" value="event">
			</div>
			<div class="form-group">
			<label class="control-label" for="ename">Event name:</label>
			<input type="text" class="form-control" required="required" name="ename" placeholder="Event name...">
			</div>
			<div class="form-group">
			<label for="edescription">Description:</label>
			<input type="text" class="form-control" rows="5" required="required" name="edescription" placeholder="Write some description...">
			</div>
			<div class="form-group">
			<label for="group">Group:</label>
			<input type="text" class="form-control"required="required" name="group" placeholder="Group...">
			</div>
			<div class="form-group">
			<label for="Schedule">Event schedule:</label>
			<input type="DateTime-local" min="2016-11-30T00:00" class="form-control" required="required" name="schedule">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		  </div>
		</div>';
		
	// user profile
	echo '<div id="Profile" class="tab-pane fade">';
	$query = "SELECT uid, username, email, birthday, ucity, udescription, image from user where email='".$_SESSION['email']."'";	
	if($result=do_query($_SESSION["link"], $query)){
		echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr>
			<th>pic</th><th>uid</th><th>username</th><th>e-mail</th><th>birthday</th><th>city</th>
			<th>description</th></tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){
			
			$uid=$row["uid"];
			echo '<tr><td><p><img src="data:image/jpg;base64,'.base64_encode($row["image"]).'" width="100px"></p></td>';
			
			for ($x = 0; $x <count($row)/2-1; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	} else {
		
	}
	$tablename="'table2'";
	echo '<u onclick="show('.$tablename.')">Edit profile</u>
		<div class="container" id="table2" style="width:900px; display:none ">
			<form class="form-signup" action="update.php" method="post">
				<div class="form-group">
					<input type="hidden" class="form-control" name="searchtype" value="user">
				</div>
				<div class="form-group">
				<label class="control-label" for="uname">User name:</label>
				<input type="text" class="form-control" required="required" name="username" placeholder="User name...">
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
		echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr>
				<th></th><th>pic</th><th>rid</th><th>title</th><th>servings</th><th>description</th><th>post time</th><th>tag</th><th>edit</th>
				</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){
			
			echo '<tr><td><a href="recipe.php?rid='.$row[0].'">Detail</a></td><td><p><img src="data:image/jpg;base64,'.base64_encode($row["pic"]).'" width="100px"></p></td>';
			
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
			$Recipi_rid = "".$row[0]."";
			echo '<td><a href="update.php?searchtype=delete_recipe&rid= '.$Recipi_rid.'" class="btn btn-danger" role="button">Delete</a></td>';
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	}
	$tablename="'table3'";
	echo '<u onclick="show('.$tablename.')">Create recipe</u>
		<div class="container" id="table3" style="width:900px; display:none ">
			<form class="form-signup" action="update.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<input type="hidden" class="form-control" name="searchtype" value="recipe">
				<input type="hidden" class="form-control" name="uid" value="'.$uid.'">
				<input type="hidden" class="form-control" id="nr" name="numRows" value=1>
			</div>
			<div class="form-group">
			<label class="control-label" for="rname">Recipe title:</label>
			<input type="text" class="form-control" required="required" name="rname" placeholder="User name...">
			</div>
			<div class="form-group">
			<label for="serving">Servings:</label>
			<input type="number" class="form-control" required="required" name="serving">
			</div>
			<div class="form-group">
			<label for="ingredient">Ingredient: <p class="btn btn-info" onclick="addRow()">add</p></label>
			<table id="ingre"><tbody><tr>
			<td><input id="in" type="text" class="form-control"required="required" name="ingredient1" placeholder="Ingredient..."></td>
			<td><input id="in" type="number" class="form-control"required="required" name="quantities1" placeholder="Quantities..."></td>
			<td><select id="in2" name="unit1"><option>gram</option><option>pcs</option><option>mililiter</option></select></td></tr></tbody></table>
			</div>
			<div class="form-group">
			<label for="description">Description:</label>
			<textarea type="text" class="form-control" rows="5" required="required" name="description" placeholder="Write some description..."></textarea>
			</div>
			<div class="form-group">
				<label for="tag">Tag:</label>
				<input type="text" class="form-control" required="required" name="tag" placeholder="Write some description...">
			</div>
			<div class="form-group">
				<label for="text">Image(.jpeg, .png):</label>
				<input type="file" name="fileToUpload" id="fileToUpload" placeholder=".jpeg, .png">
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
		echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr>
			<th></th><th>gid</th><th>group name</th><th>description</th><th>creator</th><th>edit</th>
			</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){
		
			echo '<tr><td><a href="group.php?gid='.$row[0].'">Detail</a></td>';
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			$Group_rid = "".$row[0]."";
			echo '<td><a href="update.php?searchtype=delete_group&gid='.$Group_rid.'" class="btn btn-danger" role="button">Quit</a></td>';
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	}
	$tablename="'table4'";
	echo '<u onclick="show('.$tablename.')">Create group</u>
			<div class="container" id="table4" style="width:900px; display:none ">
			<form class="form-signup" action="update.php" method="post">
			<div class="form-group">
				<input type="hidden" class="form-control" name="searchtype" value="group">
			</div>
			<div class="form-group">
			<label class="control-label" for="gname">Group name:</label>
			<input type="text" class="form-control" required="required" name="gname" placeholder="User name...">
			</div>
			<div class="form-group">
			<label for="description">Description:</label>
			<input type="text" class="form-control" rows="5" required="required" name="description" placeholder="Write some description...">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		  </div>
		</div>';
		
		echo '<div id="Group" class="tab-pane fade">';
	$query = "SELECT gid, gname, gdescription, u1.username from user as u1 join groups on u1.uid=groups.creatorid
				natural join joins join user as u2
				on joins.memberid=u2.uid where u2.email='".$_SESSION['email']."'";
	if($result=do_query($_SESSION["link"], $query)){
		echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr>
			<th></th><th>gid</th><th>group name</th><th>description</th><th>creator</th><th>edit</th>
			</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){
		
			echo '<tr><td><a href="group.php?gid='.$row[0].'">Detail</a></td>';
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			$Group_rid = "".$row[0]."";
			echo '<td><a href="update.php?searchtype=delete_group&gid='.$Group_rid.'" class="btn btn-danger" role="button">Quit</a></td>';
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	}
	$tablename="'table4'";
	echo '<u onclick="show('.$tablename.')">Create group</u>
			<div class="container" id="table4" style="width:900px; display:none ">
			<form class="form-signup" action="update.php" method="post">
			<div class="form-group">
				<input type="hidden" class="form-control" name="searchtype" value="group">
			</div>
			<div class="form-group">
			<label class="control-label" for="gname">Group name:</label>
			<input type="text" class="form-control" required="required" name="gname" placeholder="User name...">
			</div>
			<div class="form-group">
			<label for="description">Description:</label>
			<input type="text" class="form-control" rows="5" required="required" name="description" placeholder="Write some description...">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		  </div>
		</div>';
	
	// RSVP
	echo '<div id="rsvp" class="tab-pane fade">';
	$query = "SELECT eid, ename, edescription, edatetime, gname 
				from groups natural join event natural join rsvp natural join user
				where email='".$_SESSION['email']."'";
	if($result=do_query($_SESSION["link"], $query)){
		echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr>
			<th></th><th>eid</th><th>event name</th><th>description</th><th>event time</th><th>group</th><th>edit</th>
			</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){
		
			echo '<tr><td><a href="event.php?eid='.$row[0].'">Detail</a></td>';
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			$eid = "".$row[0]."";
			echo '<td><a href="update.php?searchtype=delete_rsvp&eid='.$eid.'" class="btn btn-danger" role="button">Quit</a></td>';
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	}
?>