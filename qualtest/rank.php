<?php
  include_once("conn.php");
  $query = "select pno, score from QUAL_PROB_TBL";
  $res = mysql_query($query) or die("ERROR");
  $scorelist = array();
  while( ($result = mysql_fetch_array($res)) ){
    $scorelist[$result['pno']] = $result['score'];
  }

  $ranklist = array();
  $query = "select u.name, s.pno from QUAL_SCORE_TBL s, QUAL_USER_TBL u where u.id=s.id";
  $res = mysql_query($query) or die("ERROR");
  while( ($result = mysql_fetch_array($res)) ){
    if($ranklist[$result['name']]){
      $ranklist[$result['name']] += $scorelist[$result['pno']];
    }else{
      $ranklist[$result['name']] = $scorelist[$result['pno']];
    }
  }


	$query = "select distinct(pno) from QUAL_SCORE_TBL";
	$res = mysql_query($query) or die("ERROR");
	while( ($result = mysql_fetch_array($res)) ){
		$query2 = "select u.name, s.pno from QUAL_SCORE_TBL s, QUAL_USER_TBL u where u.id=s.id and s.pno=$result[pno] order by s.date asc limit 0,3";
		$res2 = mysql_query($query2) or die("ERROR");
		for($i=0; $i<3; $i++){
			$result2 = mysql_fetch_array($res2);
			if($result2){
				$ranklist[$result2['name']]+=3-$i;
			}
		}
	}
  arsort($ranklist);



?>

        <div class="sidebar">
          <h4>Top 10 Rankers</h4>
          <table style="width:100%; border-spacing:0;" class="ranktable">
            <tr><th width='20px'>Rank</th><th width='180px'>Name</th><th width='30px'>Score</th></tr>
<?php
  $num = 1;
  foreach($ranklist as $key => $val){
		if($val>=3000){
			$output = "<tr><td class='num2'>$num</td><td class='name2'>$key</td><td class='num2'>$val</td></tr>";
		}else{
			$output = "<tr><td class='num'>$num</td><td class='name'>$key</td><td class='num'>$val</td></tr>";
		}

		if($num>0 && $num<4){
			$query = "select sno from QUAL_USER_TBL where name='$key'";
			$res = mysql_query($query) or die("ERROR");
			$result = mysql_fetch_array($res);
			$output = "<tr><td class='num3'>$num</td><td class='name3'><img src='https://ssogw.kaist.ac.kr:7781/static_files/photo/".substr($result[sno],0,4)."/$result[sno].jpg' width='30px' style='margin-right:10px; vertical-align:middle'>$key</td><td class='num3'>$val</td></tr>";
		}

		echo $output;


		if($num==10) break;
    $num+=1;
  }

  mysql_free_result($result);
  mysql_close();
?>
          </table>
        </div>
