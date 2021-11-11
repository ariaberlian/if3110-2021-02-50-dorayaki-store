<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
  <link rel="stylesheet" href="css/login.css">
  <link rel="shortcut icon" type="image/jpg" href="<?= BASEURL; ?>img/favicon.png" />

</head>

<body>

  <div class="center">
    <h1>Login</h1>
    <form method="post">
      <div class="txt_field">

        <input type="text" name="username" id="username" required>
        <span></span>
        <label>Username</label>
      </div>

      <div class="txt_field">
        <input type="password" name="password" id="password" required>
        <span></span>
        <label>Password</label>
      </div>
      <?php
      if ($data["gagalMasuk"] == true) {
        echo ("<div class=\"salah\">User ID atau Password salah!</div>");
      }
      ?>
      <input type="submit" value="Login">

      <div class="signup_link">
        Belum punya akun? <a href="register">Register</a>
      </div>

    </form>
  </div>

</body>

</html>