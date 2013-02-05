<?php
	include_once("conn.php");

	$query = "select no, title, date, body from QUAL_NOTICE_TBL where no=(select max(no) from QUAL_NOTICE_TBL);";
	$res = mysql_query($query) or die("ERROR");
	$result = mysql_fetch_array($res);
	$no = $result['no'];
	$title = $result['title'];
	$date = $result['date'];
	$body = nl2br($result['body']);

?>

				<div class="sidebar">
          <h3>Latest News</h3>
					<h4><?php echo $title; ?></h4>
					<h5><?php echo $date; ?></h5>
					<div class='sidenotice'>
					<?php echo $body; ?>
					</div>
					<p><br/><a href="notices.php?no=<?php echo $no;?>">Read more</a></p>
        </div>
