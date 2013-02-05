<!DOCTYPE HTML>


<?php
//post -> id, pw, name, sno, mail, key

session_save_path('./session/');
session_start();

if($_SESSION['id']==="GoN"){

	if(isset($_GET['no'])){
		$no = (int) $_GET['no'];
		$modstr = "&no=$no";
	}else{
		$no = -1;
	}


	if(strlen($_POST['category']) && strlen($_POST['author']) && strlen($_POST['title']) && strlen($_POST['body']) && strlen($_POST['key']) && strlen($_POST['score'])){

		$score = (int) $_POST['score'];

		if(strlen($_POST['author'])<20 && strlen($_POST['title'])<20 && strlen($_POST['key'])<50 && $score>=100 && $score<600){

				$category = $_POST['category'];
				include_once("conn.php");

				if(in_array($category, $categorylist)){

					foreach($_POST as $key => $val){
						$_POST[$key] = htmlspecialchars(stripslashes($_POST[$key]));
						$_POST[$key] = mysql_escape_string($_POST[$key]);
					}

					$author = $_POST['author'];
					$title = $_POST['title'];
					$body = $_POST['body'];
					$key = $_POST['key'];
					$file = "";

					$sfrom = $score - $score%100;
					$sto = $sfrom+99;

					$query = "select pno from QUAL_PROB_TBL where pno<>$no and category='$category' and score between $sfrom and $sto";
					$res = mysql_query($query) or die("ERROR");
					$result = mysql_fetch_array($res);

					if(!$result){

						$_FILES["file"]["name"] = htmlspecialchars(stripslashes($_FILES["file"]["name"]));
						$_FILES["file"]["name"] = mysql_escape_string($_FILES["file"]["name"]);

						if($_FILES["file"]["name"]){
							if($_FILES["file"]["error"] > 0){
								echo "<script>alert('ERROR: " . $_FILES["file"]["error"] . "');</script>";
								echo "<script>document.location='probwrite.php?n$modstr';</script>";
								die();

							}else{
								if(file_exists("upload/$category/" . md5($_FILES["file"]["name"])) && !isset($_GET['no'])){
									echo "<script>document.location='probwrite.php?e$modstr';</script>";
									die();
								}else{
									move_uploaded_file($_FILES["file"]["tmp_name"], "upload/$category/" . md5($_FILES["file"]["name"]));
									$file = md5($_FILES["file"]["name"]);
								}
							}
						}


						if(isset($_GET['no'])){
							$query = "select file from QUAL_PROB_TBL where pno=$no";
							$res = mysql_query($query) or die("ERROR");
							$result = mysql_fetch_array($res);
							$lfile = $result['file'];
							if(strlen($file)>0 || $_POST['fdelete']==="delete"){
								unlink("upload/$category/$lfile");
							}else{
								$file = $lfile;
							}

							$date = date("Y-m-d H:i:s");
							$query = "update QUAL_PROB_TBL set category='$category', title='$title', author='$author', body='$body', file='$file', score=$score, auth='$key', ldate='$date' where pno=$no";
							$result = mysql_query($query) or die("ERROR");
							echo "<script>document.location='prob.php?u'</script>";

						}else{
							$query = "insert into QUAL_PROB_TBL(category, title, author, body, file, score, auth) values ('$category', '$title', '$author', '$body', '$file', $score, '$key')";
							$result = mysql_query($query) or die("ERROR");
							echo "<script>document.location='prob.php?j'</script>";

						}

					}else{
						echo "<script>document.location='probwrite.php?a'</script>";
					}


				}else{
					echo "<script>document.location='probwrite.php?c'</script>";
				}

				mysql_free_result($result);
				mysql_close();


		}else{
				echo "<script>document.location='probwrite.php?l$modstr'</script>";
		}

	}else{
		echo "<script>document.location='probwrite.php?f$modstr'</script>";
	}

}else{
	echo "<script>document.location='probwrite.php?p'</script>";
}

?>
