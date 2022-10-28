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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
  </head>
  <body>
    <div class="navbar">
      <center><img src="../assets/img/logo.png" alt="logo" width="150px"></center>
      <table>
        <tr><td class="heading">Allgemeines</td></tr>
        <tr><th><hr></th></tr>
        <tr><td><img src="../assets/img/icons/ticketsystem.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Aufgaben</a></td></tr>
        <tr><td><img src="../assets/img/icons/calendar.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Kalender</a></td></tr>
        <tr><td><img src="../assets/img/icons/news.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Neuigkeiten</a></td></tr>
      </table>
      <?php
        require("../mysql/MySQL.php");
        $stmt = $mysql->prepare("SELECT PERMISSIONS FROM accounts WHERE LOWER(USERNAME) = LOWER(:username)");
        $stmt->bindParam(":username", $_SESSION["username"]);
        $stmt->execute();
        $row = $stmt->fetch();
        $perms = explode(",",$row["PERMISSIONS"]);//array("dashboard.navbar.support","dashboard.navbar.development","dashboard.navbar.administration");
        if(in_array("dashboard.navbar.support", $perms) || in_array("*", $perms)) {
          echo '<table>
          <tr><td class="heading">Support</td></tr>
          <tr><th><hr></th></tr>
          <tr><td><img src="../assets/img/icons/ticketsystem.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Tickets</a></td></tr>
          <tr><td><img src="../assets/img/icons/flag.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Meldungen</a></td></tr>
        </table>';
        }
        if(in_array("dashboard.navbar.development", $perms) || in_array("*", $perms)) {
          echo '<table>
          <tr><td class="heading">Entwicklung</td></tr>
          <tr><th><hr></th></tr>
          <tr><td><img src="../assets/img/icons/server.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Mein Server</a></td></tr>
          <tr><td><img src="../assets/img/icons/cloud.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">CloudSystem</a></td></tr>
        </table>';
        }
        if(in_array("dashboard.navbar.administration", $perms) || in_array("*", $perms)) {
          echo '<table>
          <tr><td class="heading">Administration</td></tr>
          <tr><th><hr></th></tr>
          <tr><td><img src="../assets/img/icons/palette.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Theme</a></td></tr>
          <tr><td><img src="../assets/img/icons/manage_accounts.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Accounts</a><span class="notify">1</span></td></tr>
          <tr><td><img src="../assets/img/icons/settings.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Einstellungen</a></td></tr>
        </table>';
        }
      ?>
      <div class="navbar_profile">
        <table>
          <tr>
            <td><?php
              require("../mysql/MySQL.php");
              $stmt = $mysql->prepare("SELECT UUID FROM accounts WHERE LOWER(USERNAME) = LOWER(:username)");
              $stmt->bindParam(":username", $_SESSION["username"]);
              $stmt->execute();
              $row = $stmt->fetch();
              $uuid = $row["UUID"];
              echo "<img class=\"navbar_profile_skin\" src=\"https://crafatar.com/avatars/$uuid\" width=\"50px\" alt=\"Minecraft Player Skin\">";
            ?></td>
            <td><p class="navbar_profile_name">
              <?php
                echo($_SESSION["username"]);
                echo('<br>');

                require("../mysql/MySQL.php");
                $stmt = $mysql->prepare("SELECT RANK FROM accounts WHERE LOWER(USERNAME) = LOWER(:username)");
                $stmt->bindParam(":username", $_SESSION["username"]);
                $stmt->execute();
                $row = $stmt->fetch();
                $rank = $row["RANK"];

                switch(strtolower($rank)){
                  case "admin":
                    echo('<span class="navbar_profile_rank_admin">Administrator</span>');
                    break;
                  default:
                  echo('<span class="navbar_profile_rank_unkown">Unbekannt</span>');
                }
              ?>
              </p></td> <!-- Remove 18 from the end of theUUID -->
          </tr>
        </table>
        <table class="navbar_profile_buttons">
          <tr>
            <td class="navbar_profile_button_first"><a href="" class="navbar_profile_settings"><img src="../assets/img/icons/menu.png" width="40px" class="icon"></a><span class="notify_profile">1</span></td>
            <td><a href="logout.php" class="logout"><img src="../assets/img/icons/logout.png" width="40px" class="icon"></a></td>
          </tr>
        </table>
      </div>
    </div>
    
  </body>
</html>
