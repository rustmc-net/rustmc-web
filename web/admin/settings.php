<?php
session_start();
if(!isset($_SESSION["username"])){
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
                <tr><td onclick="selectSetting('theme');"><span class="unselect" id="theme">Theme</span></td></tr>
                <tr><td onclick="selectSetting('ranks');"><span class="unselect" id="ranks">Ränge</span></td></tr>
                <tr><td onclick="selectSetting('permissions');"><span class="unselect" id="permissions">Rechte</span></td></tr>
              </table>
          </div>
          <div class="settings-content">
            <div class="settings-content-inner">
              <div id="settings-content-theme">
                <p>Test</p>
                <h1>Test</h1>
                <button>Test</button>
              </div>
              <div id="settings-content-ranks">
                <p>ranks</p>
              </div>
              <div id="settings-content-permissions">
                <img src="https://atendesigngroup.com/sites/default/files/user-personas-permissions-drupal-8.png" alt="" width="250px">
              </div>
            </div>
          </div>
        </div>
    </div>
    <?php include_once('../../assets/navbar.php');?>
  </body>
</html>
