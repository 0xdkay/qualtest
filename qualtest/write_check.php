<!DOCTYPE HTML>


<?php
//post -> id, pw, name, sno, mail, key

session_save_path('./session/');
session_start();

if($_SESSION['id']==="GoN"){
	if(isset($_GET['no'])){
		$no = (int) $_GET['no'];
		$modstr = "&no=$no";
	}

	if(strlen($_POST['author']) && strlen($_POST['title']) && strlen($_POST['body'])){
		if(strlen($_POST['author'])<20 && strlen($_POST['title'])<50){
				include_once("conn.php");
				foreach($_POST as $key => $val){
					$_POST[$key] = htmlspecialchars(stripslashes($_POST[$key]));
					$_POST[$key] = mysql_escape_string($_POST[$key]);
				}

				$author = $_POST['author'];
				$title = $_POST['title'];
				$body = $_POST['body'];
				$file = "";

				$_FILES["file"]["name"] = htmlspecialchars(stripslashes($_FILES["file"]["name"]));
				$_FILES["file"]["name"] = mysql_escape_string($_FILES["file"]["name"]);

				if($_FILES["file"]["name"]){
					if($_FILES["file"]["error"] > 0){
						echo "<script>alert('ERROR: " . $_FILES["file"]["error"] . "');</script>";
						echo "<script>document.location='write.php?n$modstr';</script>";
						die();

					}else{
						if(file_exists("upload/Notice/" . $_FILES["file"]["name"]) && !isset($_GET['no'])){
							echo "<script>document.location='write.php?e$modstr';</script>";
							die();
						}else{
							move_uploaded_file($_FILES["file"]["tmp_name"], "upload/Notice/" . $_FILES["file"]["name"]);
							$file = $_FILES["file"]["name"];
						}
					}
				}

				if(isset($_GET['no'])){
					$query = "select file from QUAL_NOTICE_TBL where no=$no";
					$res = mysql_query($query) or die("ERROR");
					$result = mysql_fetch_array($res);
					$lfile = $result['file'];
					if(strlen($file)>0 || $_POST['fdelete']==="delete"){
						unlink("upload/Notice/$lfile");
					}else{
						$file = $lfile;
					}

					$date = date("Y-m-d H:i:s");
					$query = "update QUAL_NOTICE_TBL set title='$title', author='$author', body='$body', file='$file', ldate='$date' where no=$no";
					$result = mysql_query($query) or die("ERROR");
					echo "<script>document.location='notices.php?u'</script>";

				}else{
					$query = "insert into QUAL_NOTICE_TBL(title, author, body, file) values ('$title','$author','$body', '$file')";
					$result = mysql_query($query) or die("ERROR");
					echo "<script>document.location='notices.php?j'</script>";

				}

				mysql_free_result($result);
				mysql_close();

		}else{
				echo "<script>document.location='write.php?l$modstr'</script>";
		}

	}else{
		echo "<script>document.location='write.php?f$modstr'</script>";
	}

}else{
	echo "<script>document.location='write.php?a'</script>";
}

?>
