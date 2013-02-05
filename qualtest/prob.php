<!DOCTYPE HTML>
<html>
<?php include_once("head.php"); ?>

<body>
  <div id="main">
    <?php include_once("header.php"); ?>

    <div id="site_content">

<?php
	include "conn.php";

	$category = array();
	foreach($categorylist as $key){
		$category[$key] = array();
	}

	$query = "select pno, category, title, score from QUAL_PROB_TBL order by score asc";
	$res = mysql_query($query) or die("ERROR");
	while( ($result = mysql_fetch_array($res)) ){
		$category[$result['category']][$result['score']/100] = array($result['pno'], $result['title'], $result['score']);
	}

	if(isset($_SESSION['id'])){
		$id = $_SESSION['id'];
		$query = "select s.pno, p.category, p.score from QUAL_SCORE_TBL s, QUAL_PROB_TBL p where s.id='$id' and s.pno=p.pno";
		$res = mysql_query($query) or die("ERROR");
		while( ($result = mysql_fetch_array($res)) ){
			$category[$result['category']][$result['score']/100][3] = 1;
		}
	}


?>

      <div id="sidebar_container">

<?php 

	$title = "Choose the problem.";
	$body = "";
	$score = "";
	$file = "";
	if(isset($_GET['no'])){

		$pno = (int) $_GET['no'];
		$query = "select count(id) from QUAL_SCORE_TBL where pno=$pno";
		$res = mysql_query($query) or die("ERROR");
		$result = mysql_fetch_array($res);
		$solvers = $result[0];

		if(isset($_SESSION['id'])){

			$query = "select title, category, body, score, file from QUAL_PROB_TBL where pno=$pno";
			$res = mysql_query($query) or die("ERROR");
			$result = mysql_fetch_array($res);

			
			$cat = $result['category'];
			$title = ucfirst($result['title']);
			$body = nl2br($result['body']);
			$score = $result['score'];
			$file = $result['file'];



		}
	}
?>
        <div class="sidebar" id="prob_sidebar">
					<h2>Problem To Solve</h2>
<?php if(!isset($_SESSION['id'])) echo "<p style='color:red'>You have to login first.</p>"; ?>
          <div class="probinfo">
						<h1><?php echo $title; ?></h1>
						<?php echo $solvers;?> solvers
						<hr>
						<br>
						<?php echo $body; ?>
						<br>
						<br>
						<?php if(strlen($file)>0) echo "file: <a href='./upload/$cat/$file'>$file</a>"; ?>
						<?php include_once("rankprob.php"); ?>
          </div>

					<form action="<?php if(isset($_GET['no']) && isset($_SESSION['id'])) echo "auth.php?no=$pno";?>" method="post">
            <div class="form_settings">
              <h4>Answer</h4>
<?php if(isset($_GET['s'])) echo "<p style='color:lightgreen'>Congratulations!</p>"; ?>
<?php if(isset($_GET['a'])) echo "<p style='color:lightgreen'>You already solved it.</p>"; ?>
<?php if(isset($_GET['w'])) echo "<p style='color:red'>Wrong Answer</p>"; ?>
<?php if(isset($_GET['l'])) echo "<p style='color:red'>You have to login first.</p>"; ?>
<?php if(isset($_GET['f'])) echo "<p style='color:red'>You have to choose the problem.</p>"; ?>
              <input type="text" name="answer" autofocus>
              <input class="submit" type="submit" value="Auth">
            </div>
          </form>
        </div>
        <?php include_once("rank.php"); ?>
      </div>
      <div class="content">
        <div class='probdiv'>
					<a name='T'></a>
					<h1>Problems</h1>
					<hr>
					<br>
<?php if(isset($_GET['p'])) echo "<p style='color:red'>You don't have that permission.</p>"; ?>
<?php if(isset($_GET['j'])) echo "<p style='color:lightgreen'>Problem is successfully written.</p>"; ?>
<?php if(isset($_GET['u'])) echo "<p style='color:lightgreen'>Problem is successfully modified.</p>"; ?>
<?php if(isset($_GET['d'])) echo "<p style='color:lightgreen'>Problem is successfully deleted.</p>"; ?>
  
          <table class='probtable'>
          <tr>
<?php
	foreach($category as $key => $val){
		echo "<th>$key</th>";
	}
?>
          </tr>
<?php

	for($i=1; $i<6; $i+=1){
		echo "<tr>";
		foreach($category as $key => $val){
			if($val[$i]){
				$tno = $val[$i][0];
				$tti = ucfirst($val[$i][1]);
				$tsc = $val[$i][2];
				$attr = "";
				$uri = $_SERVER["REQUEST_URI"];

				include "conn.php";
				$query = "select u.sno from QUAL_SCORE_TBL s, QUAL_USER_TBL u where s.id=u.id and s.pno=$tno order by s.date asc limit 1";
				$res = mysql_query($query) or die(mysql_error());
				$result = mysql_fetch_array($res);
				if($result){
					$sid = $result['sno'];
				}else{
					unset($sid);
				}

				preg_match("/no=(\d+)/", $uri, $match);

				if(isset($sid)){
					$attr = " style='background: url(https://ssogw.kaist.ac.kr:7781/static_files/photo/".substr($sid,0,4)."/$sid.jpg); background-size: 116px 85px; opacity:0.4;'";
				}

				if($match[1] === $tno){
					$attr = "class='current'";
					if(isset($sid)){
						$attr .= " style='background: url(https://ssogw.kaist.ac.kr:7781/static_files/photo/".substr($sid,0,4)."/$sid.jpg); background-size: 116px 85px;'";
					}
					echo "<td title='$tsc' $attr onclick='document.location=\"prob.php?no=$tno#T\";'>$tti<br>$tsc</td>";
				}elseif($val[$i][3]===1){
					$attr = "class='solved'";
					if(isset($sid)){
						$attr .= " style='background: url(https://ssogw.kaist.ac.kr:7781/static_files/photo/".substr($sid,0,4)."/$sid.jpg); background-size: 116px 85px; opacity:0.8'";
					}
					echo "<td title='$tsc' $attr onclick='document.location=\"prob.php?no=$tno#T\";'>Solved</td>";
				}else{
					echo "<td title='$tsc' $attr onclick='document.location=\"prob.php?no=$tno#T\";'>$tti<br>$tsc</td>";
				}


			}else{
				echo "<td class='notopened'></td>";
			}
		}
		echo "</tr>";
	}

?>
          </table> 

<?php 
	if($_SESSION['id'] === 'GoN'){
?>
					<div class='form_settings'>
						<input type='button' class='submit' id='probwrite' value='Problem Write' onclick='document.location="probwrite.php";'>
<?php
		if(isset($_GET['no'])){
?>
						<input type='button' class='submit' id='probmodify' value='Problem Modify' onclick='document.location="probwrite.php?no=<?php echo $pno?>";'>
						<input type='button' class='submit' id='probdelete' onclick='deleteCheckProb(<?php echo $pno; ?>,"<?php echo $title; ?>")' value='Problem Delete' />
<?php
		}
?>
					</div>
<?php
	}
?>
        </div>
      </div>
    </div>

    <?php include_once("footer.php"); ?>
  </div>
</body>
</html>
