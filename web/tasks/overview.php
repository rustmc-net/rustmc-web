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
    <script type="text/javascript" src="../../js/tasks.js"></script>
    <link rel="stylesheet" href="../../css/theme.css">
    <link rel="stylesheet" href="../../css/interface.css">
    <link rel="stylesheet" href="../../css/dashboard/taskoverview.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../favicon.ico">
  </head>
  <body>
    <div class="content_outside">
        <div class="content">
          <div class="toolbar">
            <a onclick="openAddGUI();" class="tool"><img src="../../assets/img/icons/add_circle.png" width="30px" height="30px" class="icon"><span class="tool_text">Hinzufügen</span></a>  
          </div>
          <div class="tasks">
                <table>
                    <?php
                        require("../../mysql/MySQL.php");
                        $stmt = $mysql->prepare("SELECT * FROM tasks WHERE WORKER = :id");
                        $stmt->bindParam(":id", $_SESSION["uuid"]);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach($result as $row) {
                            $id = $row["ID"];
                            $heading = $row["HEADING"];
                            $author_uuid = $row["AUTHOR"];
                            
                            $stmt = $mysql->prepare("SELECT USERNAME FROM accounts WHERE UUID = :uuid");
                            $stmt->bindParam(":uuid", $_SESSION["uuid"]);
                            $stmt->execute();
                            $row = $stmt->fetch();
                            $author_name = $row["USERNAME"];

                            if(strlen($heading) > 12) {
                              $heading = substr($heading, 0, 11) . '<span class="small-text">[...]</span>';
                            }

                            $str_first = "<tr class=\"task\" id=\"$id\">
                            <td><img src=\"https://crafatar.com/avatars/$author_uuid\" width=\"50px\" alt=\"Minecraft Player Skin\"></td>
                            <td class=\"task_author\">Author</td>
                            <td class=\"task_author_value\">$author_name</td>
                            <td class=\"task_title\">Aufgabe</td>
                            <td class=\"task_title_value\">$heading</td>
                            <td><a href=\"details.php?id=$id\" class=\"task_detail\"><img class=\"icon\" src=\"../../assets/img/icons/info.png\" width=\"30px\"></a></td>
                            </tr>";
                              
                            echo $str_first;
                        }
                    ?>
                </div>
                </table>
            </div>
        </div>
        <div class="add_popup" id="add_popup">
              <table>
                <tr>
                  <td><img src="https://crafatar.com/avatars/<?php echo $_SESSION["uuid"]; ?>" width="75px"></td>
                  <form action="createTask.php" method="post">
                    <td class="add_popup_heading">Titel<input name="heading" type="text" class="add_popup_heading_input" placeholder="Titel"></td>
                    <td class="add_popup_worker">Bearbeiter
                    <select name="worker" class="add_popup_worker_input">
                      <?php 
                      $stmt = $mysql->prepare("SELECT * FROM accounts");
                      $stmt->execute();
                      $result = $stmt->fetchAll();
                      foreach($result as $row) {
                        $uuid = $row["UUID"];
                        $name = $row["USERNAME"];
                        echo "<option value=\"$uuid\">$name</option>";
                      }
                      ?>
                    </select></td>
                    <td class="add_popup_info">Aufgabe<textarea name="info" class="add_popup_info_input"></textarea></td>
                    <td><a onclick="closeAddGUI();" class="add_popup_exit"><img class="icon" src="../../assets/img/icons/close.png" width="30px"></a></td>
                    <td><button type="submit" name="submit" class="add_popup_save"><img class="icon" src="../../assets/img/icons/save.png" width="30px"></button></td>
                  </form>
                </tr>
              </table>  
            </div>
    </div>
    <?php include_once('../../assets/navbar.php');?>
  </body>
</html>
