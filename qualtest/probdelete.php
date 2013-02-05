<!DOCTYPE HTML>


<?php
//post -> id, pw, name, sno, mail, key

session_save_path('./session/');
session_start();


if($_SESSION['id']==="GoN"){

	include_once("conn.php");

	if(isset($_GET['no'])){
		$no = (int) $_GET['no'];

		$query = "select category, file from QUAL_PROB_TBL where pno=$no";
		$res = mysql_query($query) or die("ERROR");
		$result = mysql_fetch_array($res);
		$file = $result['file'];
		$category = $result['category'];
		if(strlen($file)>0){
			unlink("upload/$category/$file");
		}

		$query = "delete from QUAL_PROB_TBL where pno=$no";
		$result = mysql_query($query) or die("ERROR");
		echo "<script>document.location='prob.php?d'</script>";

	}else{
		echo "Wrong way.";

	}

	mysql_free_result($result);
	mysql_close();

}else{
	$no = (int) $_GET['no'];
	echo "<script>document.location='prob.php?p'</script>";
}

?>
