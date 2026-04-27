<?php

function autoloader($class_name)
{
    $pathFile = search_file(__DIR__, $class_name);

    if (!empty($pathFile)) {
        // echo '-----'. PHP_EOL;
        // var_dump($pathFile);
        // echo '-----'. PHP_EOL;
        require_once $pathFile[0];
    }
}

function search_file($folderName, $fileName)
{
    $found = [];
    $folderName = rtrim($folderName, '/');

    if (!$dir = @opendir($folderName)) return [];

    while (($file = readdir($dir)) !== false) {
        if ($file == '.' || $file == '..') continue;

        $file_path = "$folderName/$file";
        // echo PHP_EOL.$file_path.PHP_EOL;
        
        if (is_file($file_path)) {
            if ($file === $fileName . ".php") {
                $found[] = $file_path;
            }
        } elseif (is_dir($file_path)) {
            $found = array_merge($found, search_file($file_path, $fileName));
        }
    }
    closedir($dir);
    return $found;
}
