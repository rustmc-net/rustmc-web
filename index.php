<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>RustMC - Network</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/theme.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script type="text/javascript" src="js/theme.js"></script>

  </head>
  <body>
    <div id="particles-js"></div>
    <div class="form">
      <center>
      <img src="assets/img/logo.png" alt="Logo" width="256px">
      <h1>Login</h1>
      <br>
      <form class="login" action="" method="post">
        <p class="heading heading_username">Benutzername</p>
        <input class="input" type="text" name="username" value="">
        <br>
        <br>
        <p class="heading">Passwort</p>
        <input class="input" type="password" name="password" value="">
        <br>
        <br>
        <br>
        <input class="button" type="submit" name="submit" value="Login">
        <br>
        <p class="error"><?php
            if(isset($_POST["submit"])){
              if($_POST["username"] != "Tester" || $_POST["password"] != "Test"){
                echo "Benutzername oder Passwort ist falsch!";
              }else{
                session_start();
                $_SESSION["username"] = "Tester";
                header("Location: web");
              }
            }
             ?></p>
      </form>
      <p class="copyright">© 2022 RustMC. All rights reserved.</p>
      </center>
    </div>
    <script src="js/particle/particles.js"></script>
    <script src="js/particle/app.js"></script>
  </body>
</html>
