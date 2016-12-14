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
	$query_set[4]="SELECT reportid, title, content, username, pic1, pic2, pic3 from reporttoevent natural join report 
			join user on report.writerid=user.uid where eid=".$eid;
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
	
	if(isset($_SESSION["check"]) && $_SESSION["check"]=="successful"){
		
		echo '<div class="container" style="width:900px;">
			<form class="form-signup" action="update.php" method="post">
			<div class="form-group">
				<input type="hidden" class="form-control" name="searchtype" value="addreview">
				<input type="hidden" class="form-control" name="rid" value="'.$rid.'">
			</div>';
		
		echo '<div class="form-group">
			<label for="text">review:</label>
			<textarea type="review" class="form-control" rows="1" required="required" name="title" placeholder="write title..."></textarea>
			<textarea type="review" class="form-control" rows="5" required="required" name="description" placeholder="write your review..."></textarea>
			<textarea type="review" class="form-control" rows="2" required="required" name="suggestion" placeholder="write your suggestion..."></textarea>
			</div>
			<div class="form-group">
				<select name="rating">
					<option value=5>5</option>
					<option value=4>4</option>
					<option value=3>3</option>
					<option value=2>2</option>
					<option value=1>1</option>
				</select>
			</div>
			<button type="submit" class="btn btn-default">Submit</button>
			</div></form>';
		}
?>