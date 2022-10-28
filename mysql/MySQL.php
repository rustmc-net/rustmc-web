<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rustmc";

try {
  $mysql = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  //echo "Connection failed: " . $e->getMessage();
}
?>