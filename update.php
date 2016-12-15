<?php
	include 'function.php';
	print_r($_POST);
	$_SESSION["link"] = mysqli_connect("localhost", "test", "", "cookzilla"); 
	
	//edit user
	if(isset($_POST["searchtype"]) && $_POST["searchtype"]=="user"){  
		if($stmt = $_SESSION["link"]->prepare("UPDATE user SET username=?, birthday=?, ucity=?, udescription=? WHERE uid=?")) {
			$stmt->bind_param("ssssi", $_POST["username"], $_POST["birthday"], $_POST["city"], $_POST["description"], $_SESSION["uid"]);
			$stmt->execute();
			$stmt->close();
			echo "update user table successfully";
		}
		else {
		    echo "Update user table false";
		}
	}
	
	//my recipe
	if(isset($_POST["searchtype"]) && $_POST["searchtype"]=="recipe"){
		$content=null;
		if(isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"]){
			$img=mysqli_real_escape_string($_SESSION["link"], file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
			$fp=fopen($_FILES["fileToUpload"]["tmp_name"],'r');
			$content=fread($fp, filesize($_FILES["fileToUpload"]["tmp_name"]));
			$content=addslashes($content);
			fclose($fp);
			echo '<p>dfsdfs<img src="data:image/jpg;base64,'.base64_encode($img).'" width="100px"></p>';
		}
		if($stmt = $_SESSION["link"]->prepare("INSERT INTO recipes (uid, rtitle, serv_num, rdescription, postdatetime, pic) VALUES (?, ?, ?, ?, now(), ?)")) {
			$stmt->bind_param("isisb", $_POST["uid"], $_POST["rname"], $_POST["serving"], $_POST["description"], $content);
			$stmt->execute();
			$stmt->close();
			echo "New record has been inserted into recipes table successfully";
	    } else {
	    	echo "Insert into recipes table false";
	    }
	    //get rid;
	    if($stmt = $_SESSION["link"]->prepare("select rid from recipes  where rtitle=?")) {
			$stmt->bind_param("s", $_POST["rname"]);
			$stmt->execute();
	        $stmt->bind_result($rid);
	        $stmt->fetch();
	        $stmt->close();
	        echo "Select rid from recipes successfully";
	    } else {
	    	echo "Select rid from recipes false";
	    }

	    // update tag
		for($count=1;$count<8;$count++){
			if(isset($_POST["tag".$count])){
				if($stmt = $_SESSION["link"]->prepare("INSERT INTO hastags (rid, tid) VALUES (?, ?)")) {
					$stmt->bind_param("ii", $rid, $_POST["tag".$count]);
					$stmt->execute();
					$stmt->close();
			    } else {
			    	echo "Insert into recipes table false";
			    }
				// update related recipes
			    if($stmt = $_SESSION["link"]->prepare("select rid from hastags where rid<>? and tid=?")) {
			    	$stmt->bind_param("ii", $rid, $_POST["tag".$count]);
					$stmt->execute();
					$stmt->bind_result($rid2);
	        		while($stmt->fetch()) {
	        			if($stmt2 = $_SESSION["link"]->prepare("INSERT INTO link (rid1, rid2) VALUES (?, ?)")) {
							$stmt2->bind_param("ii", $rid2, $rid);
							$stmt2->execute();
							$stmt2->close();
						}
	        		}
					$stmt->close();
				}
			}
		}

	    if($stmt = $_SESSION["link"]->prepare("INSERT INTO hastags (rid, tid) VALUES (?, ?)")) {
			$stmt->bind_param("ii", $rid, $content);
			$stmt->execute();
			$stmt->close();
			echo "New record has been inserted into recipes table successfully";
	    } else {
	    	echo "Insert into recipes table false";
	    }
	    // update ingredient
		for($i=1;$i<=$_POST["numRows"];$i++){
			if($stmt = $_SESSION["link"]->prepare("INSERT INTO ingredients (rid, iname, iquantities, unit) VALUES (?, ?, ?, ?)")) {
				$stmt->bind_param("isis", $rid, $_POST["ingredient".$i], $_POST["quantities".$i], $_POST["unit".$i]);
				$stmt->execute();
				$stmt->close();
				echo "Insert into ingredients successfully";
			} else {
				echo "Insert into ingredients false";
			}
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
				$stmt->bind_param("s", $gid, $_POST["ename"]);
				$stmt->execute();
				$stmt->bind_result($eid);
				$stmt->fetch();
				$stmt->close();
				//insert into RSVP
				if($stmt = $_SESSION["link"]->prepare("INSERT INTO rsvp (uid, eid) VALUES (?, ?)")) {
					$stmt->bind_param("ii", $_SESSION["uid"], $eid);
					$stmt->execute();
					$stmt->close();
				}
			}
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
	
	if(isset($_GET["searchtype"]) && $_GET["searchtype"]=="rsvp") {
		$query="insert into rsvp values('".$_SESSION["uid"]."','".$_GET["eid"]."', now())";
		print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('fail！');</script>";
		}
	}
	echo "<script>location.href='userpage.php';</script>";
?>