<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: ../");
  exit;
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>RustMC - Network</title>
    <script type="text/javascript" src="../js/theme.js"></script>
    <link rel="stylesheet" href="../css/theme.css">
    <link rel="stylesheet" href="../css/interface.css">
    <link rel="stylesheet" href="../css/dashboard/profile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
  </head>
  <body>
    <div class="content_outside">
        <div class="content">
            <table>
              <tr class="password">
                <td>
                <center>
                <p class="password_header">Passwort ändern</p>
                  <form action="" method="post">
                    <p class="password_input_old_header">Aktuelles Passwort</p>
                    <input type="password" name="pwold" class="password_input_old">
                    <p class="password_input_new_header">Neues Passwort</p>
                    <input type="password" name="pwnew" class="password_input_new">
                    <p class="password_input_check_header">Passwort wiederholen</p>
                    <input type="password" name="pwnewcheck" class="password_input_check">
                    <br>
                    <button type="submit" name="submitpw" class="password_button">Passwort Ändern</button>
                  </form>
                  <p class="error"><?php
            if(isset($_POST["submitpw"])){
              require("../mysql/MySQL.php");
              $stmt = $mysql->prepare("SELECT * FROM accounts WHERE LOWER(USERNAME) = LOWER(:username)");
              $stmt->bindParam(":username", $_SESSION["username"]);
              $stmt->execute();
              $count = $stmt->rowCount();
              if($count == 1) {
                $row = $stmt->fetch();
                if(password_verify($_POST["pwold"], $row["PASSWORD"])) {
                  if($_POST["pwnew"] == $_POST["pwnewcheck"]) {
                    $stmt = $mysql->prepare("UPDATE accounts SET PASSWORD = :pw WHERE LOWER(USERNAME) = LOWER(:username)");
                    $stmt->bindParam(":username", $_SESSION["username"]);
                    $stmt->bindParam(":pw", password_hash($_POST["pwnew"], PASSWORD_BCRYPT));
                    $stmt->execute();
                    header("Location: ../");
                    exit;
                  } else {
                    echo "Die Passwörter stimmen nicht überein!";
                  }
                } else {
                  echo "Dein Aktuelles Passwort ist falsch!";
                }
              }else {
                $_SESSION["notify"] = true;
                header("Location: ../"); 
              }
            }
             ?></p></center>
                </td>
              </tr>
            </table>
        </div>
    </div>
    <?php include_once('../assets/navbar.php');?>
  </body>
</html>
