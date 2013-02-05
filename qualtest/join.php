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
					<h1>Join</h1>
					<hr>
					<br>
          <?php if(isset($_GET['f'])) echo "<p style=\"color:red\">Please fill out all the blanks properly.</p>"; ?>
          <?php if(isset($_GET['l'])) echo "<p style=\"color:red\">Length of ID should be less than 20.<br>Length of NAME should be less than 50.<br>Length of STUDENT NO. should be less than 10.<br>Length of E-MAIL should be less than 50.</p>"; ?>
          <?php if(isset($_GET['k'])) echo "<p style=\"color:red\">Please input valid key.</p>"; ?>
          <?php if(isset($_GET['a'])) echo "<p style=\"color:red\">Already joined id.</p>"; ?>
          <form action="join_check.php" method="post">
            <div class="form_settings" id="loginform">
              <p>
              <span>ID:</span>
              <input type='text' name='id' maxlength='20' autofocus><br>
              </p>
              <p>
              <span>PASSWORD:</span>
              <input type='password' name='pw'><br>
              </p>
              <p>
              <span>NAME:</span>
              <input type='text' name='name' maxlength='50'><br>
              </p>
              <p>
              <span>STUDENT NO.:</span>
              <input type='text' name='sno' maxlength='10'><br>
              </p>
              <p>
              <span>E-MAIL:</span>
              <input type='text' name='mail' maxlength='50'><br>
              <h5>E-mail address is used for your password recovery.</h5>
              </p>
              <br>
              <p>
              <span>JOIN KEY:</span>
              <input type='text' name='key'><br>
              <h5>If you are the member of GoN, you already know the key :P</h5>
              </p>
              <br>
							<p>
							<span>&nbsp;</span>
              <input type='submit' class='submit' id='login' value='Join'>
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
