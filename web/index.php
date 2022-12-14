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
    <link rel="stylesheet" href="../css/notify.css">
    <link rel="stylesheet" href="../css/dashboard/dashboard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
  </head>
  <body>
    <div class="content_outside">
        <div class="content">
          <h1 id="welcome">Willkommen, <?php echo $_SESSION["username"];?>👋</h1>
          <div class="tasks">
            <h2>Deine Aufgaben</h2>
            <div class="tasks-content">
              <table cellspacing="0">
                <?php 
                  require("../mysql/MySQL.php");
                  $stmt = $mysql->prepare("SELECT * FROM tasks WHERE WORKER = :worker");
                  $stmt->bindParam(":worker", $_SESSION["uuid"]);
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                  foreach($result as $row) {
                    $task_id = $row["ID"];
                    $task_heading = $row["HEADING"];
                    $task_info = $row["INFO"];

                    if(strlen($task_info) > 170) {
                      $task_info = substr($task_info, 0, 150) . "[...]";
                    }

                    $task_info = $task_info . "<a href=\"tasks/details.php?id=$task_id\">Details</a>";

                    echo "<tr><td><div class=\"tasks-task\"><h4>$task_heading</h4><p>$task_info</p></div></td></tr>";
                  }
                  
                ?>
              </table>
            </div>
          </div>
          <div class="notifications">
            <table>
              <?php 
                  $notify = $_SESSION["notify"];
                  if($notify == true) {
                    echo '<tr><td><div id="notify-error"><img src="../assets/img/icons/error.png" width="25px"><div class="notify-text">Entschuldige! Es ist ein Fehler aufgetreten!</div><div class="notify-timeline"></div></div></td></tr>';
                    $_SESSION["notify"] = false;
                  }
                  
              ?>
              <script>
                setTimeout(function() {
                  document.getElementById("notify-error").style.visibility = "hidden";
                }, 1000*5);
              </script>
            </table>
          </div>
        </div>
    </div>
    <?php include_once('../assets/navbar.php');?>
  </body>
</html>
