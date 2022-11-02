<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: ../../");
  exit;
}
require("../../mysql/MySQL.php");
$stmt = $mysql->prepare("SELECT PERMISSIONS FROM accounts WHERE LOWER(USERNAME) = LOWER(:username)");
$stmt->bindParam(":username", $_SESSION["username"]);
$stmt->execute();
$row = $stmt->fetch();
$perms = explode(",",$row["PERMISSIONS"]);
if(!(in_array("dashboard.navbar.administration", $perms) || in_array("*", $perms))) {
    header("Location: ../../");
    exit;
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>RustMC - Network</title>
    <script type="text/javascript" src="../../js/theme.js"></script>
    <script type="text/javascript" src="../../js/accounts.js"></script>
    <link rel="stylesheet" href="../../css/theme.css">
    <link rel="stylesheet" href="../../css/interface.css">
    <link rel="stylesheet" href="../../css/dashboard/accounts.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../favicon.ico">
  </head>
  <body>
    <div class="content_outside">
        <div class="content">
            <div class="toolbar">
                <a href="#add" class="tool"><img src="../../assets/img/icons/account_add.png" width="30px" height="30px" class="icon"><span class="tool_text">Hinzufügen</span></a>
            </div>
            <div class="accounts">
                <table>
                    <?php
                        require("../../mysql/MySQL.php");
                        $stmt = $mysql->prepare("SELECT * FROM accounts");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach($result as $row) {
                            $name = $row["USERNAME"];
                            $rank = $row["RANK"];
                            $uuid = $row["UUID"];
                            $edit_permission_value = $row["PERMISSIONS"];
                            $final_rank = "";
                            
                            $stmt = $mysql->prepare("SELECT * FROM ranks WHERE ID = :id");
                            $stmt->bindParam(":id", $rank);
                            $stmt->execute();
                            $count = $stmt->rowCount();
                            if($count == 1) {
                              $row = $stmt->fetch();
                              $css = $row["CSS"];
                              $rank_name = $row["NAME"];
                              $final_rank = "<span class=\"$css\">$rank_name</span>";
                            } else {
                              $final_rank = '<span class="navbar_profile_rank_unkown">Unbekannt</span>';
                            }

                            $edit_username = $name . "_username";
                            $edit_rank = $name . "_rank";
                            $edit_permission = $name . "_permission";
                            $edit_save = $name . "_save";
                            echo "<tr class=\"account\" id=\"$name\">
                            <td><img src=\"https://crafatar.com/avatars/$uuid\" width=\"50px\" alt=\"Minecraft Player Skin\"></td>
                            <td class=\"account_username\">Benutzername</td>
                            <td class=\"account_username_value\">$name</td>
                            <td class=\"account_rank\">Rang</td>
                            <td class=\"account_rank_value\">$final_rank</td>
                            <td><a onclick=\"openEdit($name);\" class=\"account_edit\"><img class=\"icon\" src=\"../../assets/img/icons/edit.png\" width=\"30px\"></a></td>
                            <td><a href=\"#delete\" class=\"account_delete\"><img class=\"icon\" src=\"../../assets/img/icons/delete.png\" width=\"30px\"></a></td>
                            <form action=\"accountsEditSave.php\" id=\"name_form\" method=\"post\">
                              <td class=\"account_edit_username\" id=\"$edit_username\">Benuzernamen<input name=\"username\" type=\"text\" class=\"account_edit_username_input\" value=\"$name\"></td>
                              <td class=\"account_edit_rank\" id=\"$edit_rank\">Rang<input name=\"rank\" type=\"text\" class=\"account_edit_rank_input\" value=\"$rank_name\"></td>
                              <td class=\"account_edit_permission\" id=\"$edit_permission\">Rechte<textarea name=\"permission\" class=\"account_edit_permission_input\">$edit_permission_value</textarea></td>
                              <td><button type=\"submit\" name=\"submit\" class=\"account_edit_save\" id=\"$edit_save\"><img class=\"icon\" src=\"../../assets/img/icons/save.png\" width=\"30px\"></button></td>
                            </form>
                            <style>
                              #$edit_save {
                                visibility: hidden;
                              }
                              #$edit_permission {
                                visibility: hidden;
                              }
                              #$edit_rank {
                                visibility: hidden;
                              }
                              #$edit_username {
                                visibility: hidden;
                              }
                            </style>
                            </tr>";
                        }
                    ?>
                </div>
                </table>
            </div>
            <div class="add_popup">
              <table>
                <tr>
                  <td><img src="https://crafatar.com/avatars/ec561538-f3fd-461d-aff5-086b22154bce" width="75px"></td>
                  <form action="" method="post">
                    <td class="add_popup_username">Benutzername<input name="username" type="text" class="add_popup_username_input" placeholder="Benutzername"></td>
                    <td class="add_popup_rank">Rang<input name="rank" type="text" class="add_popup_rank_input" placeholder="Rang"></td>
                    <td class="add_popup_uuid">UUID<input name="uuid" type="text" class="add_popup_uuid_input" placeholder="UUID"></td>
                    <td class="add_popup_discord">Discord-ID<input name="discord" type="text" class="add_popup_discord_input" placeholder="Discord-ID"></td>
                    <td class="add_popup_permission">Rechte<textarea name="permission" class="add_popup_permission_input"></textarea></td>
                    <td><button type="submit" name="submit" class="add_popup_exit" id="$edit_save"><img class="icon" src="../../assets/img/icons/close.png" width="30px"></button></td>
                    <td><button type="submit" name="submit" class="add_popup_save" id="$edit_save"><img class="icon" src="../../assets/img/icons/save.png" width="30px"></button></td>
                  </form>
                </tr>
              </table>  
            </div>
        </div>
    </div>
    <div class="navbar">
      <center><img src="../../assets/img/logo.png" alt="logo" width="150px"></center>
      <table>
        <tr><td class="heading">Allgemeines</td></tr>
        <tr><th><hr></th></tr>
        <tr><td><img src="../../assets/img/icons/ticketsystem.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Aufgaben</a></td></tr>
        <tr><td><img src="../../assets/img/icons/calendar.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Kalender</a></td></tr>
        <tr><td><img src="../../assets/img/icons/news.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Neuigkeiten</a></td></tr>
      </table>
      <?php
        require("../../mysql/MySQL.php");
        $stmt = $mysql->prepare("SELECT PERMISSIONS FROM accounts WHERE LOWER(USERNAME) = LOWER(:username)");
        $stmt->bindParam(":username", $_SESSION["username"]);
        $stmt->execute();
        $row = $stmt->fetch();
        $perms = explode(",",$row["PERMISSIONS"]);//array("dashboard.navbar.support","dashboard.navbar.development","dashboard.navbar.administration");
        if(in_array("dashboard.navbar.support", $perms) || in_array("*", $perms)) {
          echo '<table>
          <tr><td class="heading">Support</td></tr>
          <tr><th><hr></th></tr>
          <tr><td><img src="../../assets/img/icons/ticketsystem.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Tickets</a></td></tr>
          <tr><td><img src="../../assets/img/icons/flag.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Meldungen</a></td></tr>
        </table>';
        }
        if(in_array("dashboard.navbar.development", $perms) || in_array("*", $perms)) {
          echo '<table>
          <tr><td class="heading">Entwicklung</td></tr>
          <tr><th><hr></th></tr>
          <tr><td><img src="../../assets/img/icons/server.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Mein Server</a></td></tr>
          <tr><td><img src="../../assets/img/icons/cloud.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">CloudSystem</a></td></tr>
        </table>';
        }
        if(in_array("dashboard.navbar.administration", $perms) || in_array("*", $perms)) {
          echo '<table>
          <tr><td class="heading">Administration</td></tr>
          <tr><th><hr></th></tr>
          <tr><td><img src="../../assets/img/icons/palette.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Theme</a></td></tr>
          <tr><td><img src="../../assets/img/icons/manage_accounts.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Accounts</a><span class="notify">1</span></td></tr>
          <tr><td><img src="../../assets/img/icons/settings.png" width="30px" height="30px" class="icon"></td><td><a href="" class="navbar_button">Einstellungen</a></td></tr>
        </table>';
        }
      ?>
      <div class="navbar_profile">
        <table>
          <tr>
            <td><?php
              require("../../mysql/MySQL.php");
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

                require("../../mysql/MySQL.php");
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
            <td class="navbar_profile_button_first"><a href="" class="navbar_profile_settings"><img src="../../assets/img/icons/menu.png" width="40px" class="icon"></a><span class="notify_profile">1</span></td>
            <td><a href="../logout.php" class="logout"><img src="../../assets/img/icons/logout.png" width="40px" class="icon"></a></td>
          </tr>
        </table>
      </div>
    </div>
  </body>
</html>