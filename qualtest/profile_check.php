<!DOCTYPE HTML>


<?php
//post -> id, pw, name, sno, mail, key

session_save_path("session");
session_start();

if($_SESSION['modify']==='1'){
	if(strlen($_POST['pw']) && strlen($_POST['sno']) && strlen($_POST['mail']) && strlen($_POST['name'])){
		if(strlen($_POST['sno'])<10 && strlen($_POST['mail'])<50 && strlen($_POST['name'])<50 ){
				include_once("conn.php");


				foreach($_POST as $key => $val){
					$_POST[$key] = htmlspecialchars(stripslashes($_POST[$key]));
					$_POST[$key] = mysql_escape_string($_POST[$key]);
				}

				$id = $_SESSION['id'];
				$pw = sha1($_POST['pw']);
				$name = $_POST['name'];
				$sno = $_POST['sno'];
				$mail = $_POST['mail'];

				$query = "update QUAL_USER_TBL set pw='$pw', name='$name', sno='$sno', mail='$mail' where id='$id';";
				$result = mysql_query($query) or die("ERROR");

				echo "<script>document.location='index.php'</script>";

				mysql_free_result($result);
				mysql_close();

				$_SESSION['modify']='0';
		}else{
				echo "<script>document.location='profile.php?l'</script>";
		}

	}else{
		echo "<script>document.location='profile.php?f'</script>";
	}

}else{
	echo "<script>alert('please use proper way.');</script>";
	echo "<script>document.location='profile.php'</script>";

}


?>
