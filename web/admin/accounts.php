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
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>RustMC - Network</title>
    <script type="text/javascript" src="../../js/theme.js"></script>
    <script type="text/javascript" src="../../js/accounts.js"></script>
    <link rel="stylesheet" href="../../css/theme.css">
    <link rel="stylesheet" href="../../css/interface.css">
    <link rel="stylesheet" href="../../css/dashboard/accounts.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../favicon.ico">
  </head>
  <body>
    <div class="content_outside">
        <div class="content">
            <div class="toolbar">
                <a onclick="openAddGUI();" class="tool"><img src="../../assets/img/icons/account_add.png" width="30px" height="30px" class="icon"><span class="tool_text">Hinzufügen</span></a>
            </div>
            <div class="accounts">
                <table>
                    <?php
                        require("../../mysql/MySQL.php");
                        $stmt = $mysql->prepare("SELECT * FROM accounts");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach($result as $row) {
                            $name = $row["USERNAME"];
                            $rank = $row["RANK"];
                            $uuid = $row["UUID"];
                            $edit_permission_value = $row["PERMISSIONS"];
                            $final_rank = "";
                            
                            $stmt = $mysql->prepare("SELECT * FROM ranks WHERE ID = :id");
                            $stmt->bindParam(":id", $rank);
                            $stmt->execute();
                            $count = $stmt->rowCount();
                            if($count == 1) {
                              $row = $stmt->fetch();
                              $css = $row["CSS"];
                              $rank_name = $row["NAME"];
                              $final_rank = "<span class=\"$css\">$rank_name</span>";
                            } else {
                              $final_rank = '<span class="navbar_profile_rank_unkown">Unbekannt</span>';
                            }

                            $edit_username = $name . "_username";
                            $edit_rank = $name . "_rank";
                            $edit_permission = $name . "_permission";
                            $edit_save = $name . "_save";

                            $str_first = "<tr class=\"account\" id=\"$name\">
                            <td><img src=\"https://crafatar.com/avatars/$uuid\" width=\"50px\" alt=\"Minecraft Player Skin\"></td>
                            <td class=\"account_username\">Benutzername</td>
                            <td class=\"account_username_value\">$name</td>
                            <td class=\"account_rank\">Rang</td>
                            <td class=\"account_rank_value\">$final_rank</td>
                            <td><a onclick=\"openEdit($name);\" class=\"account_edit\"><img class=\"icon\" src=\"../../assets/img/icons/edit.png\" width=\"30px\"></a></td>
                            <td><a onclick=\"gotoDelete($name);\" class=\"account_delete\"><img class=\"icon\" src=\"../../assets/img/icons/delete.png\" width=\"30px\"></a></td>
                            <form action=\"accountsEditSave.php\" id=\"name_form\" method=\"post\">
                              <td class=\"account_edit_username\" id=\"$edit_username\">Benutzername<input name=\"username\" type=\"text\" class=\"account_edit_username_input\" value=\"$name\"></td>
                              <td class=\"account_edit_rank\" id=\"$edit_rank\">Rang<select name=\"rank\" class=\"account_edit_rank_input\">";
                              
                              $str_last = "</select></td>
                              <td class=\"account_edit_permission\" id=\"$edit_permission\">Rechte<textarea name=\"permission\" class=\"account_edit_permission_input\">$edit_permission_value</textarea></td>
                              <td><button type=\"submit\" name=\"submit\" class=\"account_edit_save\" id=\"$edit_save\"><img class=\"icon\" src=\"../../assets/img/icons/save.png\" width=\"30px\"></button></td>
                            </form>
                            <style>
                              #$edit_save {
                                visibility: hidden;
                              }
                              #$edit_permission {
                                visibility: hidden;
                              }
                              #$edit_rank {
                                visibility: hidden;
                              }
                              #$edit_username {
                                visibility: hidden;
                              }
                            </style>
                            </tr>";

                              $stmt = $mysql->prepare("SELECT * FROM ranks");
                              $stmt->execute();
                              $result = $stmt->fetchAll();
                              foreach($result as $row) {
                                $rank_id = $row["ID"];
                                $css = $row["CSS"];
                                $name = $row["NAME"];
                                if(strtolower($rank_name) == strtolower($name)) {
                                  $str_first = $str_first . "<option selected=\"selected\" value=\"$rank_id\">$name</option>";
                                }else {
                                  $str_first = $str_first . "<option value=\"$rank_id\">$name</option>";
                                }
                                
                              }
                              
                            echo $str_first . $str_last;
                        }
                    ?>
                </div>
                </table>
            </div>
            <div class="add_popup" id="add_popup">
              <table>
                <tr>
                  <td><img src="https://crafatar.com/avatars/<?php echo $_SESSION["uuid"]; ?>" width="75px"></td>
                  <form action="accountsCreate.php" method="post">
                    <td class="add_popup_username">Benutzernamen<input name="username" type="text" class="add_popup_username_input" placeholder="Benutzernamen"></td>
                    <td class="add_popup_rank">Rang
                    <select name="rank" class="add_popup_rank_input">
                      <?php 
                      $stmt = $mysql->prepare("SELECT * FROM ranks");
                      $stmt->execute();
                      $result = $stmt->fetchAll();
                      foreach($result as $row) {
                        $rank_id = $row["ID"];
                        $css = $row["CSS"];
                        $name = $row["NAME"];
                        echo "<option value=\"$rank_id\">$name</option>";
                      }
                      ?>
                    </select></td>
                    <td class="add_popup_uuid">UUID<input name="uuid" type="text" class="add_popup_uuid_input" placeholder="UUID"></td>
                    <td class="add_popup_discord">Discord-ID<input name="discord" type="text" class="add_popup_discord_input" placeholder="Discord-ID"></td>
                    <td class="add_popup_permission">Rechte<textarea name="permission" class="add_popup_permission_input"></textarea></td>
                    <td><a onclick="closeAddGUI();" class="add_popup_exit"><img class="icon" src="../../assets/img/icons/close.png" width="30px"></a></td>
                    <td><button type="submit" name="submit" class="add_popup_save"><img class="icon" src="../../assets/img/icons/save.png" width="30px"></button></td>
                  </form>
                </tr>
              </table>  
            </div>
        </div>
    </div>
    <?php include_once('../../assets/navbar.php');?>
  </body>
</html>