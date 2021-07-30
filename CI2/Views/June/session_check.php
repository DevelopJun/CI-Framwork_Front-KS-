<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>세션이 유지되고 있는 페이지</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
      <figure class="text-center" style="margin-top: 200px;">
          <blockquote class="blockquote">
              <p> 현재 아래와 같이 세션이 유지되고 있습니다.</p>
          </blockquote>
          <figcaption class="blockquote-footer">
              Session <cite title="Source Title">Testing</cite>
              <div class="test" style="margin-top: 30px; display: flex; justify-content: center; border:1px solid black;">
                  <?php
                  echo print_r($_SESSION);
                  ?>
              </div>
          </br>
      </br>
              <a href="/test/session_destroy" button type="button" class="btn btn-light">로그아웃</button>
          </figcaption>
      </figure>



  </body>
</html>
