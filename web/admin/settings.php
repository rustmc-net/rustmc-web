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
    <script type="text/javascript" src="../../js/adminsettings.js"></script>
    <link rel="stylesheet" href="../../css/theme.css">
    <link rel="stylesheet" href="../../css/interface.css">
    <link rel="stylesheet" href="../../css/dashboard/settings.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../favicon.ico">
  </head>
  <body onload="onPageLoad();">
    <div class="content_outside">
        <div class="content">
          <div class="sidebar">
            <h1>Einstellungen</h1>
              <table>
                <tr><td onclick="selectSetting('theme');"><span class="unselect" id="theme"><img src="/rustmc/assets/img/icons/palette.png" width="20px" height="20px" class="icon">Aussehen</span></td></tr>
                <tr><td onclick="selectSetting('ranks');"><span class="unselect" id="ranks"><img src="/rustmc/assets/img/icons/ranks.png" width="20px" height="20px" class="icon">Ränge</span></td></tr>
                <tr><td onclick="selectSetting('permissions');"><span class="unselect" id="permissions"><img src="/rustmc/assets/img/icons/security.png" width="20px" height="20px" class="icon">Rechte</span></td></tr>
                <tr><td onclick="selectSetting('system');"><span class="unselect" id="system"><img src="/rustmc/assets/img/icons/webinterface.png" width="20px" height="20px" class="icon">System</span></td></tr>
              </table>
          </div>
          <div class="settings-content">
            <div class="settings-content-inner">
              <div id="settings-content-theme">
                <form action="settingsThemeSave.php" method="post">
                  <p class="settings-header">Primärfarbe</p>
                  <div id="color-picker-wrapper-primary">
	                  <input type="color" name="primary" value="<?php 
                      $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/rustmc/assets/settings/theme.json');
                      $json = json_decode($file, true);
                      echo $json['colorFirst'];
                      ?>" id="color-picker-primary">
                  </div>
                  <div class="color-secondary">
                    <p class="settings-header">Sekundärfarbe</p>
                    <div id="color-picker-wrapper-secondary">
	                    <input type="color" name="secondary" value="<?php 
                      $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/rustmc/assets/settings/theme.json');
                      $json = json_decode($file, true);
                      echo $json['colorSecond'];
                      ?>" id="color-picker-secondary">
                    </div>
                  </div>
                  <p class="settings-header">Thema</p>
                  <span><input type="radio" name="darkmode" value="darkmode" <?php 
                      $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/rustmc/assets/settings/theme.json');
                      $json = json_decode($file, true);
                      if($json['dark'] == true) {
                        echo "checked";
                      }
                      ?>>Dunkel</span>
                  <br>
                  <span><input type="radio" name="darkmode" value="lightmode" <?php 
                      $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/rustmc/assets/settings/theme.json');
                      $json = json_decode($file, true);
                      if($json['dark'] == false) {
                        echo "checked";
                      }
                      ?>>Hell</span>
                  <br>
                  <input class="settings-save" name="submit-theme" type="submit" value="Speichern" id="theme-save">
                </form>
                <form action="settingsThemeReset.php" method="post">
                  <input class="settings-reset" name="reset-theme" type="submit" value="Zurücksetzen" id="theme-reset">
                </form>
              </div>
              <div id="settings-content-ranks">
                <p>ranks</p>
              </div>
              <div id="settings-content-permissions">
                <p>perms</p>
              </div>
              <div id="settings-content-system">
                <p class="settings-header">Pfad</p>
                <p class="settings-header-description">Der Pfad zum Webinterface. Default: Leer lassen.</p>
                <form action="settingsSystemSave.php" method="post">
                  <input type="text" name="rootpath" id="system-rootpath" value="<?php 
                      $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/rustmc/assets/settings/system.json');
                      $json = json_decode($file, true);
                      echo $json['rootpath'];
                      ?>">
                  <br><br>
                  <input class="settings-save" name="submit-system" type="submit" value="Speichern" id="system-save">
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
    <?php include_once('../../assets/navbar.php');?>
  </body>
</html>
