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
if(!(in_array("dashboard.navbar.developer", $perms) || in_array("*", $perms))) {
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
    <script type="text/javascript" src="../../js/cloudserver.js"></script>
    <link rel="stylesheet" href="../../css/theme.css">
    <link rel="stylesheet" href="../../css/interface.css">
    <link rel="stylesheet" href="../../css/dashboard/cloudserver.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../favicon.ico">
  </head>
  <body >
    <div class="content_outside">
        <div class="content">
            <h1><span id="servername">{ServerName}</span></h1>
            <div class="server-stats">
                <table>
                    <tr>
                        <td class="server-stats-slots"><div>
                            <h3>Online Spieler</h3>
                            <p id="players">{onlinePlayer} / {maxPlayer}</p>
                            <span class="server-stats-bar" id="server-stats-bar-slots"></span>
                            <span class="server-stats-bar-bg"></span>
                        </div><span class="space-left"></span></td>
                        <td class="server-stats-cpu"><div>
                            <h3>CPU Auslastung</h3>
                            <p id="cpu">{cpuUsage}</p>
                            <span class="server-stats-bar" id="server-stats-bar-cpu"></span>
                            <span class="server-stats-bar-bg"></span>
                        </div></td>
                        <td class="server-stats-ram"><div>
                            <h3>RAM Auslastung</h3>
                            <p id="ram">{ramUsage} MB / {maxRam} MB</p>
                            <span class="server-stats-bar" id="server-stats-bar-ram"></span>
                            <span class="server-stats-bar-bg"></span>
                        </div></td>
                        <td class="server-stats-tps"><div>
                            <h3>TPS</h3>
                            <p id="tps">{currentTPS} / 20</p>
                            <span class="server-stats-bar" id="server-stats-bar-tps"></span>
                            <span class="server-stats-bar-bg"></span>
                        </div></td>
                    </tr>
                </table>
            </div>
            <div class="server-console">
              <textarea readonly id="console"></textarea>
              <form action="" method="post">
                <span class="server-console-input-bg"><span id="server-console-input-front">»</span><input type="text" name="command" id="server-console-input" placeholder="Befehl hier eingeben..."></span>
                <input type="submit" hidden>
              </form>
            </div>
            <div class="server-control">
              <h3>Informationen</h3>
              <span class="server-control-info">Alles wichtige auf einem Blick</span>
              <table>
                <tr>
                  <td><span class="server-control-header">Server-ID:</span></td>
                  <td><p id="info-id">{id}</p></td>
                </tr>
                <tr>
                  <td><span class="server-control-header">Port:</span></td>
                  <td><p id="info-port">{port}</p></td>
                </tr>
                <tr>
                  <td><span class="server-control-header">Node:</span></td>
                  <td><p id="info-node">{node}</p></td>
                </tr>
                <tr>
                  <td><span class="server-control-header">Gruppe:</span></td>
                  <td><p id="info-group">{group}</p></td>
                </tr>
              </table>
            </div>
        </div>
    </div>
    <?php include_once('../../assets/navbar.php');?>
  </body>
</html>