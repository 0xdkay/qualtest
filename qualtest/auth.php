<!DOCTYPE HTML>


<?php
//post -> id, pw, name, sno, mail, key

session_save_path('./session/');
session_start();

if(isset($_SESSION['id'])){
	if(isset($_GET['no'])){
		include_once("conn.php");
		foreach($_POST as $key => $val){
			$_POST[$key] = htmlspecialchars(stripslashes($_POST[$key]));
			$_POST[$key] = mysql_escape_string($_POST[$key]);
		}

		$pno = (int) $_GET['no'];
		$key = $_POST['answer'];

		$query = "select 1 from QUAL_PROB_TBL where pno=$pno and auth='$key'";
		$res = mysql_query($query) or die("ERROR");
		$result = mysql_fetch_array($res);

		if($result){
			$id = $_SESSION['id'];
      $query = "insert into QUAL_SCORE_TBL(id, pno) select '$id',$pno from dual where not exists (select id, pno from QUAL_SCORE_TBL where id='$id' and pno=$pno);";
			$result = mysql_query($query) or die("ERROR");
      $no = mysql_affected_rows();
      if($no>0){
        echo "<script>document.location='prob.php?no=$pno&s'</script>";
      }else{
        echo "<script>document.location='prob.php?no=$pno&a'</script>";
      }

		}else{
			echo "<script>document.location='prob.php?no=$pno&w'</script>";
		}

		mysql_free_result($result);
		mysql_close();

	}else{
		echo "<script>document.location='prob.php?f'</script>";
	}

}else{
	echo "<script>document.location='prob.php?l'</script>";
}

?>
