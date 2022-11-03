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
if(isset($_POST["submit"])) {
$name = $_COOKIE["currentedituser"];

$stmt = $mysql->prepare("UPDATE accounts SET USERNAME=?, RANK=?, PERMISSIONS=? WHERE LOWER(USERNAME)=LOWER(?)");
$stmt->execute([$_POST["username"],$_POST["rank"],$_POST["permission"],$name]);
}
setcookie("currentedituser", $name, time() + 1 - time(), "/rustmc/web/admin");
header("Location: accounts.php");
?>