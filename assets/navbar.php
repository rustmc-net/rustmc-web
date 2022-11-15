<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>RustMC - Network</title>
    <script type="text/javascript" src="/rustmc/js/theme.js"></script>
    <link rel="stylesheet" href="/rustmc/css/theme.css">
    <link rel="stylesheet" href="/rustmc/css/interface.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/rustmc/favicon.ico">
  </head>
  <body>
    <div class="navbar">
      <center><img src="/rustmc/assets/img/logo.png" alt="logo" width="150px"></center>
      <table>
        <tr><td class="heading">Allgemeines</td></tr>
        <tr><th><hr></th></tr>
        <tr><td><img src="/rustmc/assets/img/icons/ticketsystem.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Aufgaben</a></td></tr>
        <tr><td><img src="/rustmc/assets/img/icons/calendar.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Kalender</a></td></tr>
        <tr><td><img src="/rustmc/assets/img/icons/news.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Neuigkeiten</a></td></tr>
      </table>
      <?php
        require($_SERVER['DOCUMENT_ROOT'] . "/rustmc/mysql/MySQL.php");
        $stmt = $mysql->prepare("SELECT PERMISSIONS FROM accounts WHERE LOWER(USERNAME) = LOWER(:username)");
        $stmt->bindParam(":username", $_SESSION["username"]);
        $stmt->execute();
        $row = $stmt->fetch();
        $perms = explode(",",$row["PERMISSIONS"]);//array("dashboard.navbar.support","dashboard.navbar.development","dashboard.navbar.administration");
        if(in_array("dashboard.navbar.support", $perms) || in_array("*", $perms)) {
          echo '<table>
          <tr><td class="heading">Support</td></tr>
          <tr><th><hr></th></tr>
          <tr><td><img src="/rustmc/assets/img/icons/ticketsystem.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Tickets</a></td></tr>
          <tr><td><img src="/rustmc/assets/img/icons/flag.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Meldungen</a></td></tr>
        </table>';
        }
        if(in_array("dashboard.navbar.development", $perms) || in_array("*", $perms)) {
          echo '<table>
          <tr><td class="heading">Entwicklung</td></tr>
          <tr><th><hr></th></tr>
          <tr><td><img src="/rustmc/assets/img/icons/server.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Mein Server</a></td></tr>
          <tr><td><img src="/rustmc/assets/img/icons/cloud.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">CloudSystem</a></td></tr>
        </table>';
        }
        if(in_array("dashboard.navbar.administration", $perms) || in_array("*", $perms)) {
          echo '<table>
          <tr><td class="heading">Administration</td></tr>
          <tr><th><hr></th></tr>
          <tr><td><img src="/rustmc/assets/img/icons/palette.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Theme</a></td></tr>
          <tr><td><img src="/rustmc/assets/img/icons/manage_accounts.png" width="30px" height="30px" class="icon"></td><td><a href="admin/accounts.php" class="navbar_button">Accounts</a><span class="notify">1</span></td></tr>
          <tr><td><img src="/rustmc/assets/img/icons/settings.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Einstellungen</a></td></tr>
        </table>';
        }
      ?>
      <div class="navbar_profile">
        <table>
          <tr>
            <td><?php
              require($_SERVER['DOCUMENT_ROOT'] . "/rustmc/mysql/MySQL.php");
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
                require($_SERVER['DOCUMENT_ROOT'] . "/rustmc/mysql/MySQL.php");
                $stmt = $mysql->prepare("SELECT RANK FROM accounts WHERE LOWER(USERNAME) = LOWER(:username)");
                $stmt->bindParam(":username", $_SESSION["username"]);
                $stmt->execute();
                $row = $stmt->fetch();
                $rank = $row["RANK"];
                
                $stmt = $mysql->prepare("SELECT * FROM ranks WHERE ID = :id");
                $stmt->bindParam(":id", $rank);
                $stmt->execute();
                $count = $stmt->rowCount();
                if($count == 1) {
                  $row = $stmt->fetch();
                  $css = $row["CSS"];
                  $rank_name = $row["NAME"];
                  echo "<span class=\"$css\">$rank_name</span>";
                } else {
                  echo '<span class="navbar_profile_rank_unkown">Unbekannt</span>';
                }
              ?>
              </p></td>
          </tr>
        </table>
        <table class="navbar_profile_buttons">
          <tr>
            <td class="navbar_profile_button_first"><a href="profile.php" class="navbar_profile_settings"><img src="/rustmc/assets/img/icons/menu.png" width="40px" class="icon"></a><span class="notify_profile">1</span></td>
            <td><a href="logout.php" class="logout"><img src="/rustmc/assets/img/icons/logout.png" width="40px" class="icon"></a></td>
          </tr>
        </table>
      </div>
    </div>
    
  </body>
</html>
