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
    $_SESSION["notify"] = true;
    header("Location: ../");
}
$name = $_COOKIE["currentedituser"];

$stmt = $mysql->prepare("DELETE FROM accounts WHERE LOWER(USERNAME)= LOWER(:username)");
$stmt->bindParam(":username", $name);
$stmt->execute();

setcookie("currentedituser", $name, time() + 1 - time(), "/rustmc/web/admin");
header("Location: accounts.php");
?>