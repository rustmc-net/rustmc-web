<?php
if(isset($_POST["reset-theme"])) {

    $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/rustmc/assets/settings/theme.json');
    $json = json_decode($file, true);

    $json['colorFirst'] = '#f7893b';
    $json['colorSecond'] = '#f2d055';
    $json['dark'] = true;
                    
    $newJsonString = json_encode($json);
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/rustmc/assets/settings/theme.json', $newJsonString);
    header("Location: settings.php");
}
?>