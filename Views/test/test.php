<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>"> -->
    <!--위에 보이는게 지금 stylesheet 경로이다. public 아래에 만들어야 하고, asset 밑에 넣으면 에러가 발생한다. 이렇게 넣어야 정상 작동함.-->
  </head>
  <body>
    <div class="container">
      <div class="row" style="margin-top:45px">
          <div class="col-md-4 col-md-offset-4">
            <h4>Korea surver hosting sign In</h4>
            <form id="frmlogin" method="POST" action="/test/check">
              <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="username" placeholder="Enter your email"><br>
              </div>
              <div class="form-group">
                <label for="">Password</label>
                <input type="text" class="form-control" name="password" placeholder="Enter your Password"><br>
              </div>
              <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" > Sign in</button>
              </div>
              <br>
              <a href="http://1.234.15.177/test/register">Have no account, create new account</a>
            </form>
          </div>
      </div>
    </div>
  </body>
</html>
