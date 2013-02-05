<?php
$charset = "UTF-8";
$header  = 'MIME=Version: 1.0\n' . "\r\n";
$header .= 'Return-Path: <abcd@tistory.com>' . "\r\n";
$header .= 'Content-type:text/html; charset=UTF-8' . "\r\n"; // 캐릭터 셋과 텍스트 or html코드 쓸것인지 선언
$header .= iconv('utf-8', 'euckr', 'From: 발신자<abcd@tistory.com>'). "\r\n";
$frommail = "abcd@tistory.com"; // 보내는이
$to = "dongkwan1114@nate.com"; // 받는사람
$subject = iconv('utf-8', 'euckr', '제목입니다..'); // 제목
$mail_body  = "
	                          메일 내용부분
														                     ";
$email = mail($to, $subject, $mail_body, $header, '-f'.$frommail);    // 메일보내기
  if($email == ""){
		   echo "
				        <script>
        alert('메일전송 실패');
       </script>
				       ";
  }else{
		   echo "
				        <script>
        alert('메일전송 성공');
       </script>
				        ";
       
  }

?>
