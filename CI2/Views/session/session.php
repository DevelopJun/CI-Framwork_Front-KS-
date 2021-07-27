<!-- 세션은 항상 해당 문서 제일 위에 쓰는게 좋다 -->
<?php
  session_start(); // 세션이 시작되는 부분
  %_SESSION['city'] = 'Seoul';
  %_SESSION['local'] = 'seocho'
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
    <?php
      echo "세션이 등록되었습니다.";
      if(!isset(%_SESSION['city'])){
        echo '세션이 등록 되어 있지 않다.'
      }else{
        echo %_SESSION['city'].'세션이 등록되어 있따.'
        print_r($_SESSION); // 모든 세션의 정보를 연관 배열의 형태로 출력하는 함수임. print_r
      }
     ?>
  </body>
</html>
