<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: ../../");
  exit;
}
try {
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
    $data = openssl_random_pseudo_bytes(16);
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    echo $uuid;

    $stmt = $mysql->prepare("SELECT * FROM tasks WHERE ID = LOWER(:id)");
    $stmt->bindParam(":id", $uuid);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0) {
        $stmt = $mysql->prepare("INSERT INTO tasks(ID, HEADING, INFO, AUTHOR, WORKER) VALUES (LOWER(:id),:heading,:info,:author,:worker)");
            $stmt->bindParam(":id", $uuid);
            $stmt->bindParam(":heading", $_POST["heading"]);
            $stmt->bindParam(":info", $_POST["info"]);
            $stmt->bindParam(":author", $_SESSION["uuid"]);
            $stmt->bindParam(":worker", $_POST["worker"]);
            $stmt->execute();
            header("Location: overview.php");
    } else {
        $_SESSION["notify"] = true;
        header("Location: ../");
    }
} else {
    $_SESSION["notify"] = true;
    header("Location: ../");
}
} catch(Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
    $_SESSION["notify"] = true;
    header("Location: ../");
}
?>