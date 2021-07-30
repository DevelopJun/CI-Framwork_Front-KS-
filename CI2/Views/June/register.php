<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <!-- CDN 방법으로 그냥 넣었음 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>"> -->
    <!--위에 보이는게 지금 stylesheet 경로이다. public 아래에 만들어야 하고, asset 밑에 넣으면 에러가 발생한다. 이렇게 넣어야 정상 작동함.-->

  </head>
  <body>
    <div class="container">
      <div class="row" style="margin-top:45px">
          <div class="col-md-4 col-md-offset-4">
            <h4>Korea surver hosting sign UP</h4>
            <br>
            <form action="/test/save/" method="post">
              <?= csrf_field(); ?>
              <!-- 이 부분이 csrf_field 만들어서 난중에 사용하도록 설정함 -->
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter your Name">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                <!-- 이 부분이 지금 텍스트 위험 클래스 및 내부에서 표시 밑줄 오류 기능을 제공하는거임. 여기서 필드 이름 반드시 동일해야함. -->
              </div>
              <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Enter your Email">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
              </div>
              <div class="form-group">
                <label for="">Password</label>
                <input type="text" class="form-control" name="password" placeholder="Enter your Password" >
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
              </div>
              <div class="form-group">
                <label for="">Cpassword</label>
                <input type="text" class="form-control" name="cpassword" placeholder="Enter your Cpassword" >
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cpassword') : '' ?></span>
              </div>
              <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" > Sign UP</button>
              </div>
              <br>
              <a href="/test/">I already have account, login now</a>
            </form>

          </div>
      </div>
    </div>
  </body>
</html>
