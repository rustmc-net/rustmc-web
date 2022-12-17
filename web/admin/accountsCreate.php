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
if(isset($_POST["submit"])) {
    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE LOWER(USERNAME) = LOWER(:username)");
    $stmt->bindParam(":username", $_POST["username"]);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0) {
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE UUID = :uuid");
        $stmt->bindParam(":uuid", $_POST["uuid"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0) {
            $stmt = $mysql->prepare("INSERT INTO accounts(UUID, USERNAME, PASSWORD, PERMISSIONS, RANK, DISCORD) VALUES (:uuid,:username,:pw,:perms,:rank,:discord)");
            $stmt->bindParam(":uuid", $_POST["uuid"]);
            $stmt->bindParam(":username", $_POST["username"]);
            $stmt->bindParam(":pw", password_hash('changeme', PASSWORD_BCRYPT));
            $stmt->bindParam(":perms", $_POST["permission"]);
            $stmt->bindParam(":rank", $_POST["rank"]);
            $stmt->bindParam(":discord", $_POST["discord"]);
            $stmt->execute();
        }
    }
}else {
    $_SESSION["notify"] = true;
    header("Location: ../");
}

header("Location: accounts.php");
?>