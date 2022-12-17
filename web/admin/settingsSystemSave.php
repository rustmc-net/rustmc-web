<?php
if(isset($_POST["submit-system"])) {
    $rootpath = $_POST['rootpath'];

    if(substr($rootpath, -1) != "/") {
        $rootpath = $rootpath . "/";
    }

    if(substr($rootpath, 0, 1) != "/") {
        $rootpath = "/" . $rootpath;
    } 

    $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/rustmc/assets/settings/system.json');
    $json = json_decode($file, true);

    $json['rootpath'] = $rootpath;
                    
    $newJsonString = json_encode($json);
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/rustmc/assets/settings/system.json', $newJsonString);
    header("Location: settings.php");
}else {
    $_SESSION["notify"] = true;
    header("Location: ../"); 
}
?>