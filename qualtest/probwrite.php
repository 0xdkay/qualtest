<!DOCTYPE HTML>
<html>

<?php include_once("head.php"); ?>

<body>
  <div id="main">
    <?php include_once("header.php"); ?>

    <div id="site_content">
      <div id="sidebar_container">
        <?php include_once("notice.php"); ?>
        <?php include_once("rank.php"); ?>
      </div>

      <div class="content">
        <div class="probdiv">

<?php


	if($_SESSION['id']==="GoN"){
		include("conn.php");

		if(isset($_GET['no'])){
			$no = (int) $_GET['no'];
			$query = "select category, author, title, body, file, score, auth from QUAL_PROB_TBL where pno=$no";
			$res = mysql_query($query) or die("ERROR");
			$result = mysql_fetch_array($res);
			$category = $result['category'];
			$author = $result['author'];
			$title = $result['title'];
			$body = $result['body'];
			$file = $result['file'];
			$score = $result['score'];
			$key = $result['auth'];
?>
        <h1>Problem Modify</h1>
        <hr>

<?php
		}else{
			$query = "show table status where name='QUAL_PROB_TBL'";
			$res = mysql_query($query) or die("ERROR");
			$result = mysql_fetch_array($res);
			$no = $result['Auto_increment'];
			$category = "";
			$author = "";
			$title = "";
			$body = "";
			$file = "";
			$score = "";
			$key = "";
?>
        <h1>Problem Write</h1>
        <hr>

<?php
		}
?>

				<?php if(isset($_GET['a'])) echo "<p style=\"color:red\">Already exists for that score range.</p>"; ?>
				<?php if(isset($_GET['c'])) echo "<p style=\"color:red\">Please select the proper category.</p>"; ?>
				<?php if(isset($_GET['p'])) echo "<p style=\"color:red\">You don't have that permission.</p>"; ?>
				<?php if(isset($_GET['f'])) echo "<p style=\"color:red\">Please fill out all the blanks properly.</p>"; ?>
				<?php if(isset($_GET['l'])) echo "<p style=\"color:red\">Length of Author should be less than 20.<br>Length of Problem Name should be less than 20.<br>Score should be between 100 and 599.<br>Length of Key should be less than 50.</p>"; ?>
				<?php if(isset($_GET['e'])) echo "<p style=\"color:red\">File already exists.</p>"; ?>
				<?php if(isset($_GET['n'])) echo "<p style=\"color:red\">File upload error.</p>"; ?>

				<form enctype="multipart/form-data" action="probwrite_check.php<?php if(isset($_GET['no'])) echo "?no=$no";?>" method="post">
          <div class="form_settings">
						<p><span>Problem No</span><?php echo $no; ?></p>
						<p><span>Author</span><input class="contact" type="text" name="author" value="<?php echo $author; ?>"/></p>
						<P><span>Category</span><select name="category"><?php foreach($categorylist as $val) if($val===$category) echo "<option selected>$val</option>"; else echo "<option>$val</option>"; ?></select></p>
						<p><span>Problem Name</span><input class="contact" type="text" name="title" value="<?php echo $title; ?>"/></p>
						<p><span>Content</span><textarea class="contact textarea" rows="10" cols="50" name="body"><?php echo $body; ?></textarea></p>
						<p><span>File</span><input type="file" name="file"><input type="hidden" name="filename"></p>
<?php 
		if(strlen($file)>0){
?>
						<p><span>Current File</span><?php echo $file; ?></p>
						<p><span>Delete Current File</span><input class="check" type="checkbox" name="fdelete" value="delete"></p>

<?
		}
?>
						<p><span>Score</span><input class="contact" type="text" name="score" value="<?php echo $score; ?>"/></p>
						<p><span>Key</span><input class="contact" type="password" name="key" value="<?php echo $key; ?>"/></p>
            <br>
						<p><span>&nbsp;</span><input class="submit" type="submit" name="write" value="<?php if(isset($_GET['no'])) echo "Modify"; else echo "Write"; ?>" /></p>
          </div>
        </form>
<?php
		mysql_free_result($result);
		mysql_close();

	}else{
		echo "<script>document.location='prob.php?p';</script>";
	}
?>
        </div>
      </div>
    </div>

    <?php include_once("footer.php"); ?>
  </div>
</body>
</html>
