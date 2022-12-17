<?php
if(isset($_POST["submit-theme"])) {
    $primary = $_POST['primary'];
    $secondary = $_POST['secondary'];
    $dark = true;

    if($_POST["darkmode"] == "lightmode") {
        $dark = false;
    }

    $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/rustmc/assets/settings/theme.json');
    $json = json_decode($file, true);

    $json['colorFirst'] = $primary;
    $json['colorSecond'] = $secondary;
    $json['dark'] = $dark;
                    
    $newJsonString = json_encode($json);
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/rustmc/assets/settings/theme.json', $newJsonString);
    header("Location: settings.php");
}else {
    $_SESSION["notify"] = true;
    header("Location: ../"); 
}
?>