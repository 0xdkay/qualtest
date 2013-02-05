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
				<h1>Contact Us</h1>
				<hr>
				<br>
        <p>If you have any troubles with problems, please contact us.</p>
        <?php
          // Set-up these 3 parameters
          // 1. Enter the email address you would like the enquiry sent to
          // 2. Enter the subject of the email you will receive, when someone contacts you
          // 3. Enter the text that you would like the user to see once they submit the contact form

          // Do not amend anything below here, unless you know PHP
          function email_is_valid($email) {
            return preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i',$email);
          }
          if (isset($_POST['contact_submitted'])) {

						$to = "dongkwan1114@nate.com";

						if (!email_is_valid($to)) {
							echo '<p style="color: red;">You must set-up a valid (to) email address before this contact page will work.</p>';
						}

            $name = stripslashes(strip_tags($_POST['name']));
            $email = trim(htmlspecialchars($_POST['email']));
						$subject = stripslashes(strip_tags($_POST['title']));
						$subject = iconv('utf-8', 'euckr', $subject); // 제목
            $message = nl2br(stripslashes(strip_tags($_POST['message'])));;

						$header  = 'MIME=Version: 1.0\n' . "\r\n";
						$header .= 'Return-Path: <abcd@tistory.com>' . "\r\n";
						$header .= 'Content-type:text/html; charset=UTF-8' . "\r\n"; // 캐릭터 셋과 텍스트 or html코드 쓸것인지 선언
						$header .= iconv('utf-8', 'euckr', "From: $name <$email>"). "\r\n";

            $user_answer = trim(htmlspecialchars($_POST['user_answer']));
            $answer = trim(htmlspecialchars($_POST['answer']));

            if (email_is_valid($email) && !eregi("\r",$email) && !eregi("\n",$email) && $name != "" && $message != "" && $subject != "" && substr(md5($user_answer),5,10) === $answer) {

							$subject = "QUAL2 - " . $subject;

							$result = mail($to, $subject, $message, $header, '-f'.$email);    // 메일보내기

              $name = "";
              $email = "";
							$subject = "";
              $message = "";
							if($result){
								$contact_submitted = 'Your message has been sent.';
								echo '<p style="color: lightgreen;">'.$contact_submitted.'</p>';
							}else{
								echo '<p style="color: red;">something is wrong.</p>';
							}
            }
            else echo '<p style="color: red;">Please enter valid inputs.<br>Answer to the simple maths question.</p>';
          }
          $number_1 = rand(1, 9);
          $number_2 = rand(1, 9);
          $answer = substr(md5($number_1+$number_2),5,10);
        ?>
        <form id="contact" action="contact.php" method="post">
          <div class="form_settings">
            <p><span>Name</span><input class="contact" type="text" name="name" value="<?php echo $name; ?>" /></p>
            <p><span>Email Address</span><input class="contact" type="text" name="email" value="<?php echo $email; ?>" /></p>
            <p><span>Title</span><input class="contact" type="text" name="title" value="<?php echo $subject; ?>" /></p>
            <p><span>Message</span><textarea class="contact textarea" rows="5" cols="50" name="message"><?php echo $message; ?></textarea></p>
            <p style="line-height: 1.7em;">To help prevent spam, please enter the answer to this question:</p>
            <p><span><?php echo $number_1; ?> + <?php echo $number_2; ?> = ?</span><input type="text" name="user_answer" /><input type="hidden" name="answer" value="<?php echo $answer; ?>" /></p>
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="contact_submitted" value="send" /></p>
          </div>
        </form>
        </div>
      </div>
    </div>

    <?php include_once("footer.php"); ?>
  </div>
</body>
</html>
