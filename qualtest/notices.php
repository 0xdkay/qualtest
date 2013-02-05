<!DOCTYPE HTML>
<html>
<?php include_once("head.php"); ?>

<body>
  <div id="main">
    <?php include_once("header.php"); ?>

    <div id="site_content">
      <div class="content" id="notice_content">
        <div class="noticediv">
				<a name="T"></a>
				<h1>Notices</h1>
				<hr>
				<br>


<?php 
include("conn.php");
if(isset($_GET['no'])){
	$no = (int) $_GET['no'];
	$query = "select no, author, title, body, file, date, ldate from QUAL_NOTICE_TBL where no=$no";
	$res = mysql_query($query) or die("ERROR");
	$result = mysql_fetch_array($res);
	$author = $result['author'];
	$title = ucfirst($result['title']);
	$body = nl2br($result['body']);
	$file = $result['file'];
	$date = $result['date'];
	$ldate = $result['ldate'];
	if(strlen($ldate)===0){
		$ldate = "Not Modified";
	}
?>
					<table class="notice_table">
						<tr>
							<th width='130px'>No</th>
							<td width='570px' class='title'><?php echo $no; ?></td>
							<th width='120px'>Date</th>
							<td width='230px' align='center'><?php echo $date; ?></th>
						</tr>
						<tr>
							<th width='130px'>Author</th>
							<td width='570px' class='title'><?php echo $author; ?></th>
							<th width='120px'>Modified</th>
							<td width='230px' align='center'><?php echo $ldate; ?></th>
						</tr>
						<tr>
							<th>Title</th>
							<td class='title' colspan=3><?php echo $title; ?></td>
						</tr>
<?php 
	if(strlen($file)>0){
?>
						<tr>
							<th>File</th>
							<td class='title' colspan=3><a href="<?php echo "upload/Notice/".$file; ?>"><?php echo $file;?></td>
						</tr>
<?php
	}
?>
						<tr>
							<td id='body' colspan=4><?php echo $body; ?></td>
						</tr>
					</table>
					<div class='form_settings'>
<?php
	if($_SESSION['id']==='GoN'){
?>
						<input type='button' class='submit' id='article_modify' onclick='document.location="write.php?no=<?php echo $no; ?>"' value='Modify' />
						<input type='button' class='submit' id='article_delete' onclick='deleteCheck(<?php echo $no; ?>,"<?php echo $title; ?>")' value='Delete' />

<?php
	}
?>
						<input type='button' class='submit' id='article_list' onclick='document.location="notices.php"' value='List' />
					</div>

<?php
}else{
	$page = 1;
	if(isset($_GET['page'])){
		$page = (int) $_GET['page'];
	}
?>
<?php if(isset($_GET['a'])) echo "<p style=\"color:red\">You don't have that permission.</p>"; ?>
<?php if(isset($_GET['j'])) echo "<p style=\"color:lightgreen\">Your article is successfully written.</p>"; ?>
<?php if(isset($_GET['u'])) echo "<p style=\"color:lightgreen\">Your article is successfully updated.</p>"; ?>
<?php if(isset($_GET['d'])) echo "<p style=\"color:lightgreen\">Your article is successfully deleted.</p>"; ?>

					<table>
						<tr>
						<th width='50px'>No</th>
						<th width='120px'>Author</th>
						<th width='700px'>Title</th>
						<th width='130px'>Date</th>
						</tr>
<?php 
	$a = ($page-1)*10;

	$query = "select count(no) from QUAL_NOTICE_TBL";
	$res = mysql_query($query) or die("ERROR");
	$result = mysql_fetch_array($res);
	$articleno = $result[0];


	$query = "select no, author, title, date from QUAL_NOTICE_TBL order by no desc limit $a,10";
	$res = mysql_query($query) or die("ERROR");
	while( ($result = mysql_fetch_array($res)) ){
		$no = $result['no'];
		$author = $result['author'];
		$title = ucfirst($result['title']);
		$date = substr($result['date'],0,10);

		echo "<tr>
			<td align='center'>$no</td>
			<td align='center'>$author</td>
			<td class='notice_title' onclick='document.location=\"notices.php?no=$no#T\"'>$title</td>
			<td align='center'>$date</td>
			</tr>";
	}
?>
					</table>
	<div align='center'>
<?php 
	$num = 1;
	do{
		if($num==$page){
			echo "[$num]";
		}else{
			echo "<a href='notices.php?page=$num'>[$num]</a>";
		}
		echo " ";
		$articleno = (int) $articleno/10;
		settype($articleno, "int");
		$num++;
	}while($articleno>0);
?>
	</div>
<?php
	if($_SESSION['id']==='GoN'){
?>
					<div class='form_settings'>
						<input type='button' class='submit' id='article_list' onclick='document.location="write.php"' value='Write' />
					</div>
<?php
	}
}
mysql_close();
?>
        </div>
      </div>
    </div>

    <?php include_once("footer.php"); ?>
  </div>

</body>
</html>
