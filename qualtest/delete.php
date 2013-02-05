<!DOCTYPE HTML>


<?php
//post -> id, pw, name, sno, mail, key

session_save_path('./session/');
session_start();


if($_SESSION['id']==="GoN"){

	include_once("conn.php");

	if(isset($_GET['no'])){
		$no = (int) $_GET['no'];

		$query = "select file from QUAL_NOTICE_TBL where no=$no";
		$res = mysql_query($query) or die("ERROR");
		$result = mysql_fetch_array($res);
		$file = $result['file'];
		if(strlen($file)>0){
			unlink("upload/Notice/$file");
		}


		$query = "delete from QUAL_NOTICE_TBL where no=$no";
		$result = mysql_query($query) or die("ERROR");
		echo "<script>document.location='notices.php?d'</script>";

	}else{
		echo "Wrong way.";

	}

	mysql_free_result($result);
	mysql_close();

}else{
	$no = (int) $_GET['no'];
	echo "<script>document.location='notices.php?a'</script>";
}

?>
