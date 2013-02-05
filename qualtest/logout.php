<?php
  session_save_path('session/');
  session_start();
  $id = $_SESSION['id'];
  session_destroy();
  echo "<script>document.location='index.php?o=$id'</script>";
?>
