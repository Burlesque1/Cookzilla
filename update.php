<?php
	include 'function.php';
	print_r($_POST);
	$_SESSION["link"] = mysqli_connect("localhost", "test", "", "cookzilla"); 
	
	
	if(isset($_POST["searchtype"]) && $_POST["searchtype"]=="user"){  
		$username = $_POST["username"];
		$birthday = $_POST["birthday"];  
		$city = $_POST["city"];  
		$udescription = $_POST["description"];  
		$query = "UPDATE user SET username='".$username."', birthday='".$birthday."',ucity='".$city."', udescription='".$udescription."' WHERE uid='".$_SESSION["uid"]."'";
		print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('fail！');</script>";
		}
	}
	
	if(isset($_POST["searchtype"]) && $_POST["searchtype"]=="recipe"){
		$content=null;
		if(isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"]){
			$img=mysqli_real_escape_string($_SESSION["link"], file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
			$fp=fopen($_FILES["fileToUpload"]["tmp_name"],'r');
			$content=fread($fp, filesize($_FILES["fileToUpload"]["tmp_name"]));
			$content=addslashes($content);
			fclose($fp);
			echo '<p><img src="data:image/jpg;base64,'.base64_encode($img).'" width="100px"></p>';
		}
		
		$query="insert into recipes(uid, rtitle, serv_num, rdescription, postdatetime, pic) 
				values('".$_POST["uid"]."','".$_POST["rname"]."','".$_POST["serving"]."','".$_POST["description"]."', now(),'".$content."')";  
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('fail！');</script>";
		}
		
		// get rid
		$pre_query="select rid from recipes where rtitle='".$_POST["rname"]."'";
		$r=do_query($_SESSION["link"], $pre_query);
		$row=mysqli_fetch_array($r);
		
		// update tag
		for($count=1;$count<8;$count++){
			if(isset($_POST["tag".$count])){
				$query="insert into hastags(rid, tid) 
						values('".$row["rid"]."','".$_POST["tag".$count]."')"; 		
				// print_r($query);
				do_query($_SESSION["link"], $query);	
				// update related recipes
				$f_query="select rid from hastags where rid<>".$row["rid"]." and tid=".$_POST["tag".$count];
				print_r($f_query);
				if($result2=do_query($_SESSION["link"], $f_query)){
					while($row2=mysqli_fetch_array($result2)){
						$s_query="insert into link(rid1, rid2) value('".$row2["rid"]."','".$row["rid"]."')";
						print_r($s_query);
						do_query($_SESSION["link"], $s_query);
					}
				}
			}
		}		
		
		// update ingredient
		
		for($i=1;$i<=$_POST["numRows"];$i++){
			$query="insert into ingredients(rid, iname, iquantities, unit) 
				value('".$row["rid"]."','".$_POST["ingredient".$i]."','".$_POST["quantities".$i]."','".$_POST["unit".$i]."')";  
				print_r($query);
			if(do_query($_SESSION["link"], $query))
				echo "<script>alert('successful！');</script>";
			else
				echo "<script>alert('fail！');</script>";
		}
	}
	
	
	if(isset($_POST["searchtype"]) && $_POST["searchtype"]=="addreview"){
		print_r($_FILES);
		$content=null;
		$content2=null;
		$content3=null;		
		if($_FILES["fileToUpload1"]["tmp_name"] || $_FILES["fileToUpload2"]["tmp_name"] || $_FILES["fileToUpload3"]["tmp_name"]){
			$img=mysqli_real_escape_string($_SESSION["link"],file_get_contents($_FILES["fileToUpload1"]["tmp_name"]));
			$fp=fopen($_FILES["fileToUpload1"]["tmp_name"],'r');
			$content=fread($fp, filesize($_FILES["fileToUpload1"]["tmp_name"]));
			$content=addslashes($content);
			fclose($fp);
			$img=mysqli_real_escape_string($_SESSION["link"],file_get_contents($_FILES["fileToUpload2"]["tmp_name"]));
			$fp=fopen($_FILES["fileToUpload2"]["tmp_name"],'r');
			$content2=fread($fp, filesize($_FILES["fileToUpload2"]["tmp_name"]));
			$content2=addslashes($content);
			fclose($fp);
			$img=mysqli_real_escape_string($_SESSION["link"],file_get_contents($_FILES["fileToUpload3"]["tmp_name"]));
			$fp=fopen($_FILES["fileToUpload3"]["tmp_name"],'r');
			$content3=fread($fp, filesize($_FILES["fileToUpload3"]["tmp_name"]));
			$content3=addslashes($content);
			fclose($fp);
			// echo '<p><img src="data:image/jpg;base64,'.base64_encode($img).'" width="100px"></p>';
		}
		
		$query="insert into review(rid, uid, rating, title, text, suggestions, pic1,pic2,pic3) 
		values('".$_POST["rid"]."','".$_SESSION["uid"]."','".$_POST["rating"]."','".$_POST["title"]."','".$_POST["description"]."','".$_POST["suggestion"]."','".$content."','".$content2."','".$content3."')";  
		// print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('fail！');</script>";
		}
	}

	
	
	
	if(isset($_POST["searchtype"]) && $_POST["searchtype"]=="group"){
		$query="insert into groups(creatorid, gname, gdescription) values('".$_SESSION["uid"]."','".$_POST["gname"]."','".$_POST["description"]."')";  
		print_r($query);
		if(do_query($_SESSION["link"], $query)==true){
			$pre_query="select gid from groups where gname='".$_POST["gname"]."'";
			$r=do_query($_SESSION["link"], $pre_query);
			$row=mysqli_fetch_array($r);
			print_r($row);
			$query="insert into joins(gid, memberid) values('".$row["gid"]."','".$_SESSION["uid"]."')"; 
			if($result=do_query($_SESSION["link"], $query)){
				echo "<script>alert('good！');</script>";
			} else {
				echo "<script>alert('not good！');</script>";
			}
		} else {
			echo "<script>alert('The group name has already existed！');</script>";//history.go(-1);
		}		
	}
	
	
	
	// add event
	if(isset($_POST["searchtype"]) && $_POST["searchtype"]=="event"){
		// get gid
		$pre_query="select gid from groups where gname='".$_POST["group"]."'";
		if($r=do_query($_SESSION["link"], $pre_query)){
			$row=mysqli_fetch_array($r);
			print_r($row);
		} else {
			echo '<script>alert("no group found!");</script>';
		}
		$query="insert into event(gid, ename, edescription, edatetime, creator_id) 
		values('".$row["gid"]."','".$_POST["ename"]."','".$_POST["edescription"]."','".$_POST["schedule"]."','".$_SESSION["uid"]."')";  
		print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			// get eid
			$pre_query="select eid from event where ename='".$_POST["ename"]."'";
			print_r($pre_query);		
			$r=do_query($_SESSION["link"], $pre_query);
			$e=mysqli_fetch_array($r);		
			$f_query="insert into rsvp values('".$_SESSION["uid"]."','".$e["eid"]."', now())";  
			print_r($f_query);
			do_query($_SESSION["link"], $f_query);
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('fail！');</script>";
		}
	}
	
	if(isset($_POST["searchtype"]) && $_POST["searchtype"]=="event_report"){
		// 1
		if($_FILES["fileToUpload1"]["tmp_name"]!=null) {
			print_r($_FILES);
			$img=mysqli_real_escape_string(file_get_contents($_FILES["fileToUpload1"]["tmp_name"]));
			$fp=fopen($_FILES["fileToUpload1"]["tmp_name"],'r');
			$content1=fread($fp, filesize($_FILES["fileToUpload1"]["tmp_name"]));
			$content1=addslashes($content1);
			fclose($fp);
			echo '<p>dfsdfs<img src="data:image/jpg;base64,'.base64_encode($img).'" width="100px"></p>';
		} else {
			$content1=null;
		}
		// 2
		if($_FILES["fileToUpload2"]["tmp_name"]!=null) {
			print_r($_FILES);
			$img=mysqli_real_escape_string(file_get_contents($_FILES["fileToUpload2"]["tmp_name"]));
			$fp=fopen($_FILES["fileToUpload2"]["tmp_name"],'r');
			$content2=fread($fp, filesize($_FILES["fileToUpload2"]["tmp_name"]));
			$content2=addslashes($content2);
			fclose($fp);
			echo '<p>dfsdfs<img src="data:image/jpg;base64,'.base64_encode($img).'" width="100px"></p>';
		} else {
			$content2=null;
		}
		// 3
		if($_FILES["fileToUpload3"]["tmp_name"]!=null) {
			print_r($_FILES);
			$img=mysqli_real_escape_string(file_get_contents($_FILES["fileToUpload3"]["tmp_name"]));
			$fp=fopen($_FILES["fileToUpload3"]["tmp_name"],'r');
			$content3=fread($fp, filesize($_FILES["fileToUpload3"]["tmp_name"]));
			$content3=addslashes($content3);
			fclose($fp);
			echo '<p>dfsdfs<img src="data:image/jpg;base64,'.base64_encode($img).'" width="100px"></p>';
		} else {
			$content3=null;
		}
		// 
		$query="insert into report(title, writerid, content, pic1, pic2, pic3) 
	values('".$_POST["Report_title"]."','".$_SESSION["uid"]."','".$_POST["Report_content"]."','".$content1."','".$content2."','".$content3."')";  
		// print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('insert into report fail！');</script>";
		}
		$query = "select reportid from report where title = '".$_POST["Report_title"]."' and writerid ='".$_SESSION["uid"]."' and content = '".$_POST["Report_content"]."'";
		if($result=do_query($_SESSION["link"], $query)) {
			$row = mysqli_fetch_array($result);
			$reportid = "".$row[0]."";
			$query="insert into reporttoevent(reportid, eid) values('".$reportid."','".$_POST["eid"]."')";
			if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('successful！');</script>";
			} else {
				echo "<script>alert('insert into reporttoevent fail！');</script>";
			}
		} else {
			echo "<script>alert('select reportid fail！');</script>";
		}

	}

	
	//------------------------------------
	if(isset($_GET["searchtype"]) && $_GET["searchtype"]=="delete_event") {
		$Event_eid = $_GET['eid'];
		$query="DELETE FROM event WHERE eid=$Event_eid";
		print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('fail！');</script>";
		}
		echo "<script>alert('Event has deleted!'); history.go(-1);</script>";  
	}
	if(isset($_GET["searchtype"]) && $_GET["searchtype"]=="delete_recipe") {
		$Recipe_rid = $_GET['rid'];
		$query="DELETE FROM recipes WHERE rid=$Recipe_rid";
		print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('fail！');</script>";
		}
		echo "<script>alert('recip has deleted!'); history.go(-1);</script>";  
	}
	if(isset($_GET["searchtype"]) && $_GET["searchtype"]=="delete_group") {
		$group_gid = $_GET['gid'];
		$query="DELETE FROM groups WHERE rid=$group_gid";
		print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('fail！');</script>";
		}
		echo "<script>alert('group has deleted!'); history.go(-1);</script>";   
	}
	if(isset($_GET["searchtype"]) && $_GET["searchtype"]=="delete_log") {
		$logid = $_GET['logid'];
		$query="DELETE FROM log WHERE logid=$logid";
		print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('fail！');</script>";
		}
		// echo "<script>alert('log has deleted!'); history.go(-1);</script>";  
	}
	// echo "<script>location.href='homepage.php';</script>";
?>