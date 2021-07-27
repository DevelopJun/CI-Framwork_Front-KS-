<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>LOGIN</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/style.css') ?>">
    <!--위에 보이는게 지금 stylesheet 경로이다. public 아래에 만들어야 하고, asset 밑에 넣으면 에러가 발생한다. 이렇게 넣어야 정상 작동함.-->

  </head>
  <body>
    <form action="login.php" meth>
      <h2>Korea Surver Hosting LOGIN Page</h2>
      <label>User Name</label>
      <input type="text" name="unname" placeholder="User Name"><br>

      <label>User password</label>
      <input type="password" name="password" placeholder="Password"><br>

      <button type="submit">Login</button>

    </form>
  </body>
</html>
