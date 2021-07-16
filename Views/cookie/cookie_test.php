<?php
  $cookieName = 'ksadmin';
  $cookieValue = 'Seoul';
  setcookie($cookieName, $cookieValue, time()+1, '/');
 ?>
<!-- 위에가 이제 php 쿠키 함수 정의한거임 setcookie가  -->

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
     // isset 함수가 원래 있는지 없는지 확인하는 내장함수임
     if(!isset($_COOKIE[$cookieName])){
       echo $cookieName.'의 쿠키는 생성되지 않았습니다.';
     }else{
       echo $cookieName.'의 쿠키는 생성되었습니다.';
       echo '생성된 값은'.$_COOKIE[$cookieName].'입니다.';
     }

      ?>

  </body>
</html>
