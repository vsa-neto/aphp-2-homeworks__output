<?php


function autoloader ($class_name): string
{
    $pathFile = search_file('.', $class_name);
    return require_once __DIR__. "/" .  $pathFile[0];
}

function search_file($folderName, $fileName){
    $found = [];
    $folderName = trim( $folderName, '/');
    $dir = opendir( $folderName );

    while ($file = readdir($dir) !== false){
        $file_path = "$folderName/$file";

    if ( $file == '.' || $file == '..' ) continue;
    
    if ( is_file( $file_path )) {
        if (strpos($file, $fileName) !== false){
            $found[] = $file_path;
        }
    } elseif (is_dir($file_path)) {
            $res = search_file ( $file_path, $fileName);
            $found = array_merge( $found, $res );
        }
    }

   closedir($dir);
   return $found;
}
