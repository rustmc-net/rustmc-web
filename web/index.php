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
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
  </head>
  <body>
    <div class="navbar">
      <center><img src="../assets/img/logo.png" alt="logo" width="150px"></center>
      <table>
        <tr><td class="heading">Allgemeines</td></tr>
        <tr><th><hr></th></tr>
        <tr><td><img src="../assets/img/icons/ticketsystem.png" width="30px" height="30px" class="icon"></td><td><a href="">Aufgaben</a></td></tr>
        <tr><td><img src="../assets/img/icons/news.png" width="30px" height="30px" class="icon"></td><td><a href="">Neuigkeiten</a></td></tr>
      </table>
      <table>
        <tr><td class="heading">Support</td></tr>
        <tr><th><hr></th></tr>
        <tr><td><img src="../assets/img/icons/ticketsystem.png" width="30px" height="30px" class="icon"></td><td><a href="">Tickets</a></td></tr>
        <tr><td><img src="../assets/img/icons/flag.png" width="30px" height="30px" class="icon"></td><td><a href="">Meldungen</a></td></tr>
      </table>
      <table>
        <tr><td class="heading">Entwicklung</td></tr>
        <tr><th><hr></th></tr>
        <tr><td><img src="../assets/img/icons/server.png" width="30px" height="30px" class="icon"></td><td><a href="">Mein Server</a></td></tr>
        <tr><td><img src="../assets/img/icons/cloud.png" width="30px" height="30px" class="icon"></td><td><a href="">CloudSystem</a></td></tr>
      </table>
      <table>
        <tr><td class="heading">Administration</td></tr>
        <tr><th><hr></th></tr>
        <tr><td><img src="../assets/img/icons/palette.png" width="30px" height="30px" class="icon"></td><td><a href="">Theme</a></td></tr>
        <tr><td><img src="../assets/img/icons/manage_accounts.png" width="30px" height="30px" class="icon"></td><td><a href="">Accounts</a></td></tr>
        <tr><td><img src="../assets/img/icons/settings.png" width="30px" height="30px" class="icon"></td><td><a href="">Einstellungen</a></td></tr>
      </table>
      <!--<div class="navbar_profile">
        <p>USERNAME</p>
      </div>-->
    </div>
  </body>
</html>
