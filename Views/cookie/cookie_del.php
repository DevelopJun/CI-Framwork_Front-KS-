<?php
  $cookieName = 'ksadmin';
  $cookieValue = 'Seoul';
  setcookie($cookieName, $cookieValue, time()-20, '/');
 ?>
<!-- 위에가 이제 -20으로 바꾸면 쿠키 삭제 되는거지, -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>쿠키 PHP 테스트</title>
  </head>
  <body>
     <h1>쿠키 테스트 하는 화면</h1>
     <?php
     echo $cookieName.'의 쿠키가 삭제되었습니다.';
     echo '생성된 값은'.$_COOKIE[$cookieName],'입니다.';
      ?>
  </body>
</html>
