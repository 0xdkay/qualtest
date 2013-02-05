
<?php
  session_save_path("session");
  session_start();
?>
    <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php">GoN<span class="logo_colour">_QualtheSecond</span></a></h1>
          <h2>Qualification test to be a Regular Member of GoN</h2>
        </div>
      </div>
      <nav>
        <ul class="sf-menu" id="nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="notices.php">Notices</a></li>
          <li><a href="rule.php">Rules</a></li>
          <li><a href="prob.php">Prob</a></li>
          <li><a href="ranktotal.php">Rank</a></li>
          <li><a href="contact.php">Contact Us</a></li>
<?php 
  if(isset($_SESSION['id'])){
    echo "<li><a href=\"profile.php?$_SESSION[id]\">Profile</li>";
    echo "<li><a href=\"logout.php\">Logout</a></li>";
    echo "<li id='msg'><h4>Hi, $_SESSION[id]</h4></li>";
		$_SESSION['modify'] = "0";
  }else{
    echo "<li><a href=\"login.php\">Login</a></li>"; 
  }

  if(isset($_GET['o'])){
    echo "<li id='msg'><h4>Goodbye, $_GET[o]</h4></li>";
  }
?>
        </ul>
      </nav>
    </header>
