<?php
	include 'function.php';
	$_SESSION["link"] = mysqli_connect("localhost", "test", "", "cookzilla"); 

	//edit user
	if(isset($_POST["searchtype"]) && $_POST["searchtype"]=="user"){  
		$password = $_POST["psw"];  
		$confirm_psw = $_POST["psw2"]; 
		if($password == $confirm_psw) {  
			if($stmt = $_SESSION["link"]->prepare("UPDATE user SET username=?, upassword=?, birthday=?, ucity=?, udescription=? WHERE uid=?")) {
				$stmt->bind_param("sssssi", $_POST["username"], $password, $_POST["birthday"], $_POST["city"], $_POST["description"], $_SESSION["uid"]);
				$stmt->execute();
				$stmt->close();
				echo "<script>alert('successful！');history.go(-1);</script>";
			}
		} else {
			echo "<script>alert('Please make sure your password match！');history.go(-1);</script>";  
		}
		$_SESSION["username"]=$_POST["username"];
	}
	
	//my recipe
	if(isset($_POST["searchtype"]) && $_POST["searchtype"]=="recipe"){
		$_POST["rname"]=str_replace('"','', $_POST["rname"]);
		$_POST["rname"]=str_replace('%','', $_POST["rname"]);
		$_POST["rname"]=str_replace('`','', $_POST["rname"]);
		$_POST["rname"]=str_replace("'","", $_POST["rname"]);
		
		$_POST["description"]=str_replace('"','', $_POST["description"]);
		$_POST["description"]=str_replace('%','', $_POST["description"]);
		$_POST["description"]=str_replace('`','', $_POST["description"]);
		$_POST["description"]=str_replace("'","", $_POST["description"]);

		$content2=null;
		if(isset($_FILES["fileToUpload2"]["tmp_name"]) && $_FILES["fileToUpload2"]["tmp_name"]){
			$img2=mysqli_real_escape_string($_SESSION["link"], file_get_contents($_FILES["fileToUpload2"]["tmp_name"]));
			$fp2=fopen($_FILES["fileToUpload2"]["tmp_name"],'r');
			$content2=fread($fp2, filesize($_FILES["fileToUpload2"]["tmp_name"]));
			$content2=addslashes($content2);
			fclose($fp2);
			// echo '<p><img src="data:image/jpg;base64,'.base64_encode($content2).'" width="100px"></p>';
		}
		$content=null;
		if(isset($_FILES["fileToUpload1"]["tmp_name"]) && $_FILES["fileToUpload1"]["tmp_name"]){
			$img=mysqli_real_escape_string($_SESSION["link"], file_get_contents($_FILES["fileToUpload1"]["tmp_name"]));
			$fp=fopen($_FILES["fileToUpload1"]["tmp_name"],'r');
			$content=fread($fp, filesize($_FILES["fileToUpload1"]["tmp_name"]));
			$content=addslashes($content);
			fclose($fp);
			// echo '<p><img src="data:image/jpg;base64,'.base64_encode($content).'" width="100px"></p>';
		}
		$content3=null;
		if(isset($_FILES["fileToUpload3"]["tmp_name"]) && $_FILES["fileToUpload3"]["tmp_name"]){
			$img3=mysqli_real_escape_string($_SESSION["link"], file_get_contents($_FILES["fileToUpload3"]["tmp_name"]));
			$fp3=fopen($_FILES["fileToUpload3"]["tmp_name"],'r');
			$content3=fread($fp3, filesize($_FILES["fileToUpload3"]["tmp_name"]));
			$content3=addslashes($content3);
			fclose($fp3);
			// echo '<p><img src="data:image/jpg;base64,'.base64_encode($content3).'" width="100px"></p>';
		}
		
		$query="insert into recipes(uid, rtitle, serv_num, rdescription, postdatetime, pic, picii, piciii) 
				values('".$_POST["uid"]."','".$_POST["rname"]."','".$_POST["serving"]."',
				'".$_POST["description"]."', now(),'".$content."','".$content2."','".$content3."')";  
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
				// print_r($f_query);
				if($result2=do_query($_SESSION["link"], $f_query)){
					while($row2=mysqli_fetch_array($result2)){
						$s_query="insert into link(rid1, rid2) value('".$row2["rid"]."','".$row["rid"]."')";
						// print_r($s_query);
						if(do_query($_SESSION["link"], $s_query)){
							// echo "<script>alert('Insert link successful！');</script>";
						}
					}
				}
			}
		}		
		
	    // update ingredient
		for($i=1;$i<=$_POST["numRows"];$i++){
			if($stmt = $_SESSION["link"]->prepare("INSERT INTO ingredients (rid, iname, iquantities, unit) VALUES (?, ?, ?, ?)")) {
				$stmt->bind_param("isis", $rid, $_POST["ingredient".$i], $_POST["quantities".$i], $_POST["unit".$i]);
				$stmt->execute();
				$stmt->close();
				// echo "<script>alert('successful！');history.go(-1);</script>";
			} else {
				echo "Insert into ingredients false";
			}
		}
	}
	
	// add comment
	if(isset($_POST["searchtype"]) && $_POST["searchtype"]=="addreview"){
		// print_r($_FILES);
		$content=null;
		$content2=null;
		$content3=null;		
		if($_FILES["fileToUpload1"]["tmp_name"]){
			$img=mysqli_real_escape_string($_SESSION["link"],file_get_contents($_FILES["fileToUpload1"]["tmp_name"]));
			$fp=fopen($_FILES["fileToUpload1"]["tmp_name"],'r');
			$content=fread($fp, filesize($_FILES["fileToUpload1"]["tmp_name"]));
			$content=addslashes($content);
			fclose($fp);
		}
		 if($_FILES["fileToUpload2"]["tmp_name"]){
			$img=mysqli_real_escape_string($_SESSION["link"],file_get_contents($_FILES["fileToUpload2"]["tmp_name"]));
			$fp=fopen($_FILES["fileToUpload2"]["tmp_name"],'r');
			$content2=fread($fp, filesize($_FILES["fileToUpload2"]["tmp_name"]));
			$content2=addslashes($content);
			fclose($fp);
		 }
		if($_FILES["fileToUpload3"]["tmp_name"]){
			$img=mysqli_real_escape_string($_SESSION["link"],file_get_contents($_FILES["fileToUpload3"]["tmp_name"]));
			$fp=fopen($_FILES["fileToUpload3"]["tmp_name"],'r');
			$content3=fread($fp, filesize($_FILES["fileToUpload3"]["tmp_name"]));
			$content3=addslashes($content);
			fclose($fp);
		}
		if($stmt = $_SESSION["link"]->prepare("INSERT INTO review (rid, uid, rating, title, text, suggestions, pic1, pic2, pic3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
			$stmt->bind_param("iiisssbbb", $_POST["rid"], $_SESSION["uid"], $_POST["rating"], $_POST["title"], $_POST["description"], $_POST["suggestion"], $content, $content2, $content3);
			$stmt->execute();
			$stmt->close();
			echo "Insert into review table successfully";
	    } else {
	    	echo "Insert into review table false";
	    }
	}
	
	if(isset($_POST["searchtype"]) && $_POST["searchtype"]=="group"){
		if($stmt = $_SESSION["link"]->prepare("INSERT INTO groups (creatorid, gname, gdescription) VALUES (?, ?, ?)")) {
			$stmt->bind_param("iss", $_SESSION["uid"], $_POST["gname"], $_POST["description"]);
			$stmt->execute();
			$stmt->close();
			echo "New records has been inserted into groups table successfully";
		} else {
	    	echo "Inserted into groups table false";
	    }
		if($stmt = $_SESSION["link"]->prepare("select gid from groups where gname=?")) {
			$stmt->bind_param("s", $_POST["gname"]);
			$stmt->execute();
			$stmt->bind_result($gid);
			$stmt->fetch();
			$stmt->close();
		} else {
	    	echo "select from groups false";
	    }
		if($stmt = $_SESSION["link"]->prepare("INSERT INTO joins (gid, memberid) VALUES (?, ?)")) {
			$stmt->bind_param("ii", $gid, $_SESSION["uid"]);
			$stmt->execute();
			$stmt->close();
		} else {
	    	echo "Inserted into joins table false";
	    }
	}
	
	
	if(isset($_POST["searchtype"]) && $_POST["searchtype"]=="event"){
		if($stmt = $_SESSION["link"]->prepare("select gid from groups where gname=?")) {
			$stmt->bind_param("s", $_POST["group"]);
			$stmt->execute();
			$stmt->bind_result($gid);
			$stmt->fetch();
			$stmt->close();
		} else {
			   echo "select from groups false";
		}
		if($stmt = $_SESSION["link"]->prepare("INSERT INTO event (gid, ename, edescription, edatetime, creator_id) VALUES (?, ?, ?, ?, ?)")) {
			$stmt->bind_param("isssi", $gid, $_POST["ename"], $_POST["edescription"], $_POST["schedule"], $_SESSION["uid"]);
			$stmt->execute();
			$stmt->close();
			// get eid
			if($stmt = $_SESSION["link"]->prepare("select eid from event where ename=?")) {
				$stmt->bind_param("s", $_POST["ename"]);
				$stmt->execute();
				$stmt->bind_result($eid);
				$stmt->fetch();
				$stmt->close();
				//insert into RSVP
				if($stmt = $_SESSION["link"]->prepare("INSERT INTO rsvp (uid, eid) VALUES (?, ?)")) {
					$stmt->bind_param("ii", $_SESSION["uid"], $eid);
					$stmt->execute();
					$stmt->close();
					echo "<script>alert('successful！');history.go(-1);</script>";
				}
			}
		}
	}
	
	if(isset($_POST["searchtype"]) && $_POST["searchtype"]=="event_report"){
		// 1
		if($_FILES["fileToUpload1"]["tmp_name"]!=null) {
			// print_r($_FILES);
			$img=mysqli_real_escape_string($_SESSION["link"],file_get_contents($_FILES["fileToUpload1"]["tmp_name"]));
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
			// print_r($_FILES);
			$img=mysqli_real_escape_string($_SESSION["link"],file_get_contents($_FILES["fileToUpload2"]["tmp_name"]));
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
			// print_r($_FILES);
			$img=mysqli_real_escape_string($_SESSION["link"],file_get_contents($_FILES["fileToUpload3"]["tmp_name"]));
			$fp=fopen($_FILES["fileToUpload3"]["tmp_name"],'r');
			$content3=fread($fp, filesize($_FILES["fileToUpload3"]["tmp_name"]));
			$content3=addslashes($content3);
			fclose($fp);
			echo '<p>dfsdfs<img src="data:image/jpg;base64,'.base64_encode($img).'" width="100px"></p>';
		} else {
			$content3=null;
		}
		//INSERT INTO report
		if($stmt = $_SESSION["link"]->prepare("INSERT INTO report (title, writerid, content, pic1, pic2, pic3) VALUES (?, ?, ?, ?, ?, ?)")) {
			$stmt->bind_param("sisbbb", $_POST["Report_title"], $_SESSION["uid"], $_POST["Report_content"], $content1, $content2, $content3);
			$stmt->execute();
			$stmt->close();
		} else {
	    	echo "Inserted into joins table false";
	    }
	    if($stmt = $_SESSION["link"]->prepare("select reportid from report where title=? and writerid=? and content=?")) {
			$stmt->bind_param("sis", $_POST["Report_title"], $_SESSION["uid"], $_POST["Report_content"]);
			$stmt->execute();
			$stmt->bind_result($reportid);
			$stmt->fetch();
			$stmt->close();
	    	if($stmt = $_SESSION["link"]->prepare("INSERT INTO reporttoevent (reportid, eid) VALUES (?, ?)")) {
			$stmt->bind_param("ii", $reportid, $_POST["eid"]);
			$stmt->execute();
			$stmt->close();
			}
		}
	}

	
	//------------------------------------
	if(isset($_GET["searchtype"]) && $_GET["searchtype"]=="delete_event") {
		$Event_eid = $_GET['eid'];
		$query="DELETE FROM event WHERE eid=$Event_eid";
		// print_r($query);
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
		// print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('fail！');</script>";
		}
		echo "<script>alert('recipe has deleted!'); history.go(-1);</script>";  
	}
	if(isset($_GET["searchtype"]) && $_GET["searchtype"]=="delete_group") {
		$group_gid = $_GET['gid'];
		$query="DELETE FROM groups WHERE rid=$group_gid";
		// print_r($query);
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
		// print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('fail！');</script>";
		}
		echo "<script>alert('log has deleted!'); history.go(-1);</script>";  
	}
	if(isset($_GET["searchtype"]) && $_GET["searchtype"]=="joingroup") {
		$query="insert into joins values('".$_GET["gid"]."','".$_SESSION["uid"]."')";
		if(do_query($_SESSION["link"], $query)){
			echo "<script>alert('join successful！');</script>";
		}
	}
	if(isset($_GET["searchtype"]) && $_GET["searchtype"]=="rsvp") {
		$query="insert into rsvp values('".$_SESSION["uid"]."','".$_GET["eid"]."', now())";
		// print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('fail！');</script>";
		}
	}

	if(isset($_GET["searchtype"]) && $_GET["searchtype"]=="delete_review") {
		$reviewid = $_GET['reviewid'];
		$query="DELETE FROM review WHERE reviewid=$reviewid";
		// print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('report has deleted!'); history.go(-1);</script>";   
		} else {
			// echo "<script>alert('fail！');</script>";
		}
		
	}

	if(isset($_GET["searchtype"]) && $_GET["searchtype"]=="delete_report") {
		$reportid = $_GET['reportid'];
		$query="DELETE FROM report WHERE reportid=$reportid";
		// print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('report has deleted!'); history.go(-1);</script>";   
		} else {
			// echo "<script>alert('fail！');</script>";
		}
		
	}
	// echo "<script>location.href='userpage.php';</script>";
?>