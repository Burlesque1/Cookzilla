<?php
	include 'function.php';
	print_r($_POST);
	$_SESSION["link"] = mysqli_connect("localhost", "test", "", "cookzilla"); 
	
	
	if($_POST["searchtype"]=="user"){
		echo "user";
	}
	
	if($_POST["searchtype"]=="recipe"){
		print_r($_FILES);
		$img=mysqli_real_escape_string(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
		$fp=fopen($_FILES["fileToUpload"]["tmp_name"],'r');
		$content=fread($fp, filesize($_FILES["fileToUpload"]["tmp_name"]));
		$content=addslashes($content);
		fclose($fp);
		echo '<p>dfsdfs<img src="data:image/jpg;base64,'.base64_encode($img).'" width="100px"></p>';
		$query="insert into recipes(uid, rtitle, serv_num, rdescription, postdatetime, pic) 
	values('".$_POST["uid"]."','".$_POST["rname"]."','".$_POST["serving"]."','".$_POST["description"]."', now(),'".$content."')";  
		// print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('fail！');</script>";
		}
	}
	
	if($_POST["searchtype"]=="group"){
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
	if($_POST["searchtype"]=="event"){
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
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('fail！');</script>";
		}
	}
	
	if($_POST["searchtype"]=="addreview"){
		$query="insert into review(rid, uid, rating, title, text, suggestions) 
		values('".$_POST["rid"]."','".$_SESSION["uid"]."','".$_POST["rating"]."','".$_POST["title"]."','".$_POST["description"]."','".$_POST["suggestion"]."')";  
		print_r($query);
		if($result=do_query($_SESSION["link"], $query)){
			echo "<script>alert('successful！');</script>";
		} else {
			echo "<script>alert('fail！');</script>";
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
	// echo "<script>location.href='homepage.php';</script>";
?>