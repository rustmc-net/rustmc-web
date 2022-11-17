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
    <link rel="stylesheet" href="../../css/theme.css">
    <link rel="stylesheet" href="../../css/interface.css">
    <link rel="stylesheet" href="../../css/dashboard/taskdetails.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../favicon.ico">
  </head>
  <body>
    <div class="content_outside">
        <div class="content">
            <h1><?php
              require($_SERVER['DOCUMENT_ROOT'] . "/rustmc/mysql/MySQL.php");
              $stmt = $mysql->prepare("SELECT * FROM tasks WHERE ID = :id");
              $stmt->bindParam(":id", $_GET["id"]);
              $stmt->execute();
              $row = $stmt->fetch();
              echo $row["HEADING"];
            ?></h1>
            <div class="tasks-author">
              <h2>Ersteller</h2>
              <table>
                <tr>
                  <td><?php
                        require($_SERVER['DOCUMENT_ROOT'] . "/rustmc/mysql/MySQL.php");
                        $stmt = $mysql->prepare("SELECT * FROM tasks WHERE ID = :id");
                        $stmt->bindParam(":id", $_GET["id"]);
                        $stmt->execute();
                        $row = $stmt->fetch();
                        $uuid = $row["AUTHOR"];
                        echo "<img class=\"navbar_profile_skin\" src=\"https://crafatar.com/avatars/$uuid\" width=\"50px\" alt=\"Minecraft Player Skin\">";
                      ?></td>
                  <td><p class="navbar_profile_name"><?php
                    $stmt = $mysql->prepare("SELECT * FROM tasks WHERE ID = :id");
                    $stmt->bindParam(":id", $_GET["id"]);
                    $stmt->execute();
                    $row = $stmt->fetch();


                    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE UUID = :uuid");
                    $stmt->bindParam(":uuid", $row["AUTHOR"]);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    $rank = $row["RANK"];

                    echo($row["USERNAME"]);
                    echo('<br>');

                    $stmt = $mysql->prepare("SELECT * FROM ranks WHERE ID = :id");
                    $stmt->bindParam(":id", $rank);
                    $stmt->execute();
                    $count = $stmt->rowCount();
                    if($count == 1) {
                      $row = $stmt->fetch();
                      $css = $row["CSS"];
                      $rank_name = $row["NAME"];
                      echo "<span class=\"$css\">$rank_name</span>";
                    } else {
                      echo '<span class="navbar_profile_rank_unkown">Unbekannt</span>';
                    }
                  ?>
                  </p></td>
                </tr>
              </table>
            </div>
            <div class="tasks-worker">
              <h2>Bearbeiter</h2>
              <table>
                <tr>
                  <td><?php
                        require($_SERVER['DOCUMENT_ROOT'] . "/rustmc/mysql/MySQL.php");
                        $stmt = $mysql->prepare("SELECT * FROM tasks WHERE ID = :id");
                        $stmt->bindParam(":id", $_GET["id"]);
                        $stmt->execute();
                        $row = $stmt->fetch();
                        $uuid = $row["WORKER"];
                        echo "<img class=\"navbar_profile_skin\" src=\"https://crafatar.com/avatars/$uuid\" width=\"50px\" alt=\"Minecraft Player Skin\">";
                      ?></td>
                  <td><p class="navbar_profile_name"><?php
                    $stmt = $mysql->prepare("SELECT * FROM tasks WHERE ID = :id");
                    $stmt->bindParam(":id", $_GET["id"]);
                    $stmt->execute();
                    $row = $stmt->fetch();


                    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE UUID = :uuid");
                    $stmt->bindParam(":uuid", $row["WORKER"]);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    $rank = $row["RANK"];

                    echo($row["USERNAME"]);
                    echo('<br>');

                    $stmt = $mysql->prepare("SELECT * FROM ranks WHERE ID = :id");
                    $stmt->bindParam(":id", $rank);
                    $stmt->execute();
                    $count = $stmt->rowCount();
                    if($count == 1) {
                      $row = $stmt->fetch();
                      $css = $row["CSS"];
                      $rank_name = $row["NAME"];
                      echo "<span class=\"$css\">$rank_name</span>";
                    } else {
                      echo '<span class="navbar_profile_rank_unkown">Unbekannt</span>';
                    }
                  ?>
                  </p></td>
                </tr>
              </table>
            </div>
            <div class="tasks-info">
              <h2>Information</h2>
              <textarea readonly><?php
              require($_SERVER['DOCUMENT_ROOT'] . "/rustmc/mysql/MySQL.php");
              $stmt = $mysql->prepare("SELECT * FROM tasks WHERE ID = :id");
              $stmt->bindParam(":id", $_GET["id"]);
              $stmt->execute();
              $row = $stmt->fetch();
              echo $row["INFO"];
              ?></textarea>
            </div>
            <form action="" method="post">
              <input class="button" type="submit" name="submit" value="Fertigstellen">
            </form>
            <?php 
              if(isset($_POST["submit"])) {
                require($_SERVER['DOCUMENT_ROOT'] . "/rustmc/mysql/MySQL.php");
                $stmt = $mysql->prepare("DELETE FROM tasks WHERE ID = :id");
                $stmt->bindParam(":id", $_GET["id"]);
                $stmt->execute();
                echo '<script>location.href = "../";</script>';
              }?>
        </div>
    </div>
    <?php include_once('../../assets/navbar.php');?>
  </body>
</html>
