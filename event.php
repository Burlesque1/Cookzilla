<script type="text/javascript">
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
	$eid=$_GET["eid"];
	
	// event detail
	$query_set[2]="select eid, ename, edescription, edatetime, creatorid, gname from event natural join groups where eid=".$eid;
	if($result=do_query($_SESSION["link"], $query_set[2])){
		echo '<div class="container" style="width:900px;"><label>Event detail:</label><table class="table table-hover"><thead><tr>
			<th>eid</th><th>event name</th><th>description</th><th>event time</th><th>creator</th><th>group</th>
			</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){	
			echo '<tr>';
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}

		echo "</tbody></table></div>";
	}
		
	// attender
	$query_set[3]="SELECT username, email, ucity, udescription, image from event natural join rsvp natural join user where eid=".$eid;
	if($result=do_query($_SESSION["link"], $query_set[3])){
		echo '<div class="container" style="width:900px;"><label>Attender:</label>
				<table class="table table-hover"><thead><tr>
				<th>image</th><th>name</th><th>email</th><th>city</th><th>description</th>
				</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){	
			echo '<tr><td><p><img src="data:image/jpg;base64,'.base64_encode($row["image"]).'" width="100px"></p></td>';
			for ($x = 0; $x <count($row)/2-1; $x++) {
				
				echo "<td>".$row[$x]."</td>";
				
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	}
	
	// report
	echo'<div class="container" style="width:900px">';
	$query_set[4]="SELECT reportid, title, content, writerid, pic1, pic2, pic3 from reporttoevent natural join report where eid=".$eid;
	if($result=do_query($_SESSION["link"], $query_set[4])){
		echo '<div class="container" style="width:900px;"><label>Event report:</label>
			<table class="table table-hover"><thead><tr>
			<th>report id</th><th>title</th><th>content</th><th>writer</th><th>pic</th><th>pic</th><th>pic</th>
			</tr></thead><tbody>';
		while($row = mysqli_fetch_array($result)){	
			echo '<tr>';
			
			for ($x = 0; $x <count($row)/2; $x++) {
				
				if(!$row[$x])
					continue;
				if($x<count($row)/2-3)
					echo "<td>".$row[$x]."</td>";
				else
					echo '<td><p><img src="data:image/jpg;base64,'.base64_encode($row[$x]).'" width="100px"></p></td>';
			}
			
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	}

	$tablename="'table3'";
	echo '<u onclick="show('.$tablename.')">Create report</u>
		<div class="container" id="table3" style="width:900px; display:none ">
			<form class="form-signup" action="update.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<input type="hidden" class="form-control" name="searchtype" value="event_report">
				<input type="hidden" class="form-control" name="uid" value="'.$_SESSION["uid"].'">
				<input type="hidden" class="form-control" name="eid" value="'.$eid.'">
			</div>
			<div class="form-group">
			<label class="control-label" for="rname">Report title:</label>
			<input type="text" class="form-control" required="required" name="Report_title" placeholder="Report Title...">
			</div>
			<div class="form-group">
			<label for="description">Description:</label>
			<input type="text" class="form-control" rows="5" cols="40" required="required" name="Report_content" placeholder="Write some description...">
			</div>
			<div class="form-group">
				<label for="text">Image(.jpeg, .png):</label>
				<input type="file" name="fileToUpload1" id="fileToUpload1" placeholder=".jpeg, .png">
			</div>
			<div class="form-group">
				<label for="text">Image(.jpeg, .png):</label>
				<input type="file" name="fileToUpload2" id="fileToUpload2" placeholder=".jpeg, .png">
			</div>
			<div class="form-group">
				<label for="text">Image(.jpeg, .png):</label>
				<input type="file" name="fileToUpload3" id="fileToUpload3" placeholder=".jpeg, .png">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		  </div>
		</div>';
		echo'</div>';
?>