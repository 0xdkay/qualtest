


<?php
  include_once("conn.php");

//post -> id, pw
//if correct -> login
//else -> goto    'login.php?f'

  foreach($_POST as $key => $val){
    $_POST[$key] = htmlspecialchars(stripslashes($_POST[$key]));
    $_POST[$key] = mysql_escape_string($_POST[$key]);
  }

  $id = $_POST['id'];
  $pw = sha1($_POST['pw']);

  $query = "select id,pw from QUAL_USER_TBL where id='$id' and pw='$pw';";
  $result = mysql_query($query) or die("ERROR");
  $result = mysql_fetch_array($result);
  if($result){
    session_save_path('./session/');
    session_start();
		session_destroy();
    session_start();

		$id = $result['id'];
		$ip = $_SERVER["REMOTE_ADDR"];
		$date = date("Y-m-d H:i:s");

    $_SESSION['id']=$id;
		$query = "update QUAL_USER_TBL set lip='$ip', ldate='$date' where id='$id'";

		$res = mysql_query($query) or die("ERROR");

    echo "<script>document.location='index.php'</script>";
  }else{
    echo "<script>document.location='login.php?f'</script>";
  }
  mysql_free_result($result);
  mysql_close();

?>


