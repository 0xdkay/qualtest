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

<?php

?>

      <div class="content">
        <div class="probdiv">
          <h1>Profile</h1>
          <hr>
          <br>

<?php
	if(isset($_SESSION['id'])){
		include("conn.php");

		$query = "select pw, name, sno, mail, date, ip, ldate, lip from QUAL_USER_TBL where id='$_SESSION[id]'";
		$res = mysql_query($query) or die("ERROR");
		$result = mysql_fetch_array($res);
		$pw = $result['pw'];
		$name = $result['name'];
		$sno = $result['sno'];
		$mail = $result['mail'];
		$ip = $result['ip'];
		$lip = $result['lip'];
		$date = $result['date'];
		$ldate = $result['ldate'];

		mysql_free_result($result);
		mysql_close();

		if(!strcmp(sha1($_POST['pw']), $pw) || $_SESSION['modify']==='1'){
			$_SESSION['modify'] = '1';
?>
			<?php if(isset($_GET['f'])) echo "<p style=\"color:red\">Please fill out all the blanks properly.</p>"; ?>
			<?php if(isset($_GET['l'])) echo "<p style=\"color:red\">Length of ID should be less than 20.<br>Length of NAME should be less than 50.<br>Length of STUDENT NO. should be less than 10.<br>Length of E-MAIL should be less than 50.</p>"; ?>
          <form action="profile_check.php" method="post">
            <div class="form_settings" id="loginform">
              <p>
								<span>ID:</span>
								<?php echo $_SESSION['id']; ?>
              </p>
              <br>
              <p>
								<span>PASSWORD:</span>
								<input type='password' name='pw' value='' autofocus><br>
              </p>
              <p>
								<span>NAME:</span>
								<input type='text' name='name' value='<?php echo $name; ?>' maxlength="50"><br>
              </p>
              <p>
								<span>STUDENT NO.:</span>
								<input type='text' name='sno' value='<?php echo $sno; ?>' maxlength="10"><br>
              </p>
              <p>
								<span>E-MAIL:</span>
								<input type='text' name='mail' value='<?php echo $mail; ?>' maxlength="50"><br>
              </p>
              <br>
							<p>
								<span>Join Date:</span>
								<?php echo $date; ?>
							</p>
							<p>
								<span>Join IP:</span>
								<?php echo $ip; ?>
							</p>
							<p>
								<span>Last Login Date:</span>
								<?php echo $ldate; ?>
							</p>
							<p>
								<span>Last Login IP:</span>
								<?php echo $lip; ?>
							</p>

              <br>
              <p>
								<span>&nbsp;</span>
								<input type='submit' class='submit' id='login' value='Modify'>
              </p>
            </div>
           </form>

<?php 
		}else{
			if(isset($_POST['pw'])) echo "<p style='color:red'>You typed wrong password.</p>";
?>
          <form action="profile.php" method="post">
            <div class="form_settings" id="loginform">
							<p>
              <span>PASSWORD:</span>
							<input type='password' name='pw' value='' autofocus><br>
              </p>
							<br>
              <p><span>&nbsp;</span><input type='submit' class='submit' value='Check'></p>
            </div>
           </form>
<?php 
		}
	}else{
		echo "<p style='color:red'>You are not logged in.</p>";
	}
?>

        </div>
      </div>
    </div>

    <?php include_once("footer.php"); ?>
  </div>

</body>
</html>
