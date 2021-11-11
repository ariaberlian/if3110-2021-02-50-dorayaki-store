<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link rel="stylesheet" href="css/register.css">
  <link rel="shortcut icon" type="image/jpg" href="<?= BASEURL; ?>img/favicon.png" />


</head>

<body class="body">
  <div class="center">
    <h1>Register</h1>
    <form method="post">
      <div class="txt_field">

        <input type="text" name="username" id="username" required>
        <span></span>
        <label>Username</label>
      </div>
      <div class="txt_field">
        <input type="email" name="email" id="email" required>
        <span></span>
        <label>Email</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" id="password" pattern="^[a-zA-Z0-9_]+$" required>
        <span></span>
        <label>Password</label>
      </div>
      <div class="salah" id="salah">
      </div>
      <input type="submit" value="Daftar">
      <div class="signup_link">
        Sudah punya akun? <a href="login">Login</a>
      </div>
    </form>
  </div>
  <script>
    let baseURL = "<?= BASEURL ?>";
  </script>
  <script src="<?= BASEURL ?>js/cek_username.js"></script>
</body>

</html>