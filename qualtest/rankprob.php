<?php 
	include_once("conn.php");
	$pno = (int) $_GET['no'];

	$query2 = "select u.name, s.date from QUAL_SCORE_TBL s, QUAL_USER_TBL u where u.id=s.id and s.pno=$pno order by s.date asc limit 0,3";
	$res2 = mysql_query($query2) or die("ERROR");
	for($i=1; $i<4; $i++){
		$result2 = mysql_fetch_array($res2);
		if($result2){
			if($i==1){
?>
					<br><br><hr>
<?php
			}
			echo "$result2[name], $result2[date]<br>";
		}
	}


?>
