<!DOCTYPE HTML>


<?php
//post -> id, pw, name, sno, mail, key

$key = sha1("ehdqkddptjqhkdy");


if(strlen($_POST['id']) && strlen($_POST['pw']) && strlen($_POST['sno']) && strlen($_POST['mail']) && strlen($_POST['name'])){
  if(strlen($_POST['id'])<20 && strlen($_POST['sno'])<10 && strlen($_POST['mail'])<50 && strlen($_POST['name'])<50 ){
    if(!strcmp($_POST['key'],$key)){
      include_once("conn.php");


      foreach($_POST as $key => $val){
        $_POST[$key] = htmlspecialchars(stripslashes($_POST[$key]));
        $_POST[$key] = mysql_escape_string($_POST[$key]);
      }

      $id = $_POST['id'];
      $pw = sha1($_POST['pw']);
      $name = $_POST['name'];
      $sno = $_POST['sno'];
      $mail = $_POST['mail'];
      $key=$_POST['key'];

      $query = "insert into QUAL_USER_TBL(id, pw, name, sno, mail, ip) select '$id','$pw','$name','$sno','$mail','".$_SERVER['REMOTE_ADDR']."' from dual where not exists (select id from QUAL_USER_TBL where id='$id');";
      $result = mysql_query($query) or die("ERROR");
      $no = mysql_affected_rows();
      if($no>0){
        echo "<script>document.location='login.php?j'</script>";
      }else{
        echo "<script>document.location='join.php?a'</script>";
      }

      mysql_free_result($result);
      mysql_close();

    }else{
      echo "<script>document.location='join.php?k'</script>";
    }

  }else{
      echo "<script>document.location='join.php?l'</script>";
  }

}else{
  echo "<script>document.location='join.php?f'</script>";
}


?>
