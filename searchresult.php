
<html lang="en">
    
</html>


<?php
	include 'userpage.php'; 
    print_r($_GET);
	
	$query;
	if(isset($_POST["query"])){
		echo "yes";
		print_r($_POST);
		$query = $_POST["query"];
		echo '<div class="container" style="width:900px;">
          <table class="table table-hover">
              <thead>
                <tr>
                  <th>pic</th>
                  <th>#</th>
                  <th>Title</th>
                  <th>Decription</th>
				  <th>Creator</th>
                </tr>
              </thead>
              <tbody>';
  }
	else{
		echo "no";
		print_r($_POST);
		$query = "SELECT rid, rtitle, rdescription, username, pic 
			from recipes natural join user where rtitle like '%".$_GET['keyword']."%'";
		echo '<div class="container" style="width:900px;">
          <table class="table table-hover">
              <thead>
                <tr>
                  <th>pic</th>
                  <th>#</th>
                  <th>Title</th>
                  <th>Decription</th>
				  <th>Creator</th>
                </tr>
              </thead>
              <tbody>';
	}
	$result=do_query($_SESSION["link"], $query);
	while($row = mysqli_fetch_array($result)){
		
		$query2="SELECT * from recipes where rid='".$row["rid"]."';";
		
		echo '<tr>
				<td>
					<form action="#" method="post">
						<input type="hidden" name="query" value="'.$query2.'">
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
		
	
	echo "</tbody></table>";
		
		
?>