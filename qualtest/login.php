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
					<h1>Login</h1>
					<hr>
					<br>
          <?php if(isset($_GET['f'])) echo "<p style=\"color:red\">Your ID - PASSWORD combination is not valid.</p>";?>
          <?php if(isset($_GET['j'])) echo "<p style=\"color:lightgreen\">You succesfully joined. Now login.</p>";?>
          <form action="login_check.php" method="post">
            <div class="form_settings" id="loginform">
              <p>
              <span>ID:</span>
              <input type='text' name='id' autofocus><br>
              </p>
              <p>
              <span>PASSWORD:</span>
              <input type='password' name='pw'><br><br>
              </p>
							<p>
							<span>&nbsp;</span>
              <input type='submit' class='submit' id='login' value='Login'>
              </p>
              <br>
              <br>
              <p>
              <span>If you don't have account.</span>
              <input type='button' class='submit' value='Join' onclick="document.location='join.php'">
              </p>
            </div>
           </form>
        </div>
      </div>
    </div>

    <?php include_once("footer.php"); ?>
  </div>

</body>
</html>
