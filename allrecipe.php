<?php
	include 'function.php';
	if(isset($_GET["searchtype"]) && $_GET["searchtype"]=="tagtorecipe") {
		$tagname = "'".$_GET['tagname']."'";
		$query = "SELECT rid, rtitle, serv_num, rdescription, postdatetime, pic from recipes natural join hastags natural join tags where tags.tagname = ".$tagname."";
		//insert into log
		$logquery="insert into log(uid, logtype, logvalue, logtime) 
		values('".$_SESSION["uid"]."','tag',".$tagname.", now())";  
		// print_r($query);
		if($result=do_query($_SESSION["link"], $logquery)){
			// echo "<script>alert('log successful！');</script>";
		} else {
			echo "<script>alert('insert log fail！');</script>";
		}

	} else {
		$query = "SELECT rid, rtitle, serv_num, rdescription, postdatetime, pic from recipes";
	}
	if($result=do_query($_SESSION["link"], $query)){
		echo '<div class="container" style="width:900px;"><table class="table table-hover"><thead><tr>
				<th></th><th>pic</th><th>rid</th><th>title</th><th>servings</th><th>description</th><th>post time</th><th>tag</th>
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
					echo '<p><a href="allrecipe.php?searchtype=tagtorecipe&tagname='.$row_s['tagname'].'">'.$row_s['tagname'].'</a></p>';
				}
				echo "</td>";
			} else {
				echo "<td>none</td>";
			}
			echo "</tr>";
		}
		echo "</tbody></table></div>";
	}
	// echo "<script>location.href='userpage.php';</script>";
?>