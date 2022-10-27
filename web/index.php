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
    <title>CCloud | Web UI</title>
    <link rel="stylesheet" href="../css/interface.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
  </head>
  <body>
    <div class="navbar">

    </div>
  </body>
</html>
