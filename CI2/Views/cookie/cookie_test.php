<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>쿠키 PHP 테스트</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
      <figure class="text-center" style="margin-top: 200px;">
          <blockquote class="blockquote">
              <p> 현재 {username} 님은 로그인 되었습니다.</p>
          </blockquote>
          <figcaption class="blockquote-footer">
              Session <cite title="Source Title">Testing</cite>
          </br>
      </br>
              <a href="/test/session_check" button type="button" class="btn btn-light">페이지 이동(세션유지)</button>
              <a href="/test/session_destroy" button type="button" class="btn btn-light">로그아웃</button>
          </figcaption>
      </figure>



  </body>
</html>
