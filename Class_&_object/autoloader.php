<?php

function autoloader($class_name)
{
    // для поиска файлов на одном уровне: 

    // echo 'подключен класс: '. $class_name.PHP_EOL;
    // return require_once $class_name.'.php';

    // для поиска файлов в папках:

    // $pathFile = search_file(__DIR__, $class_name);
    // return require $pathFile[0];



    // $class_name = basename(str_replace('\\', '/', $class_name));

    $pathFile = search_file(__DIR__, $class_name);

    if (!empty($pathFile)) {
        echo '-----'. PHP_EOL;
        var_dump($pathFile);
        echo '-----'. PHP_EOL;
       require_once $pathFile[0];
    }
}

// функция для поиска файлов в папках:

// function search_file($folderName, $fileName){
//     $found = array();
//     $folderName = trim( $folderName, '/');
//     $dir = opendir( $folderName );

//     while ($file = readdir($dir) !== false){
//         $file_path = "$folderName/$file";

//     if ( $file == '.' || $file == '..' ) continue;

//     if ( is_file( $file_path )) {
//         if (strpos($file, $fileName) !== false){
//             $found[] = $file_path;
//         }
//     } elseif (is_dir($file_path)) {
//             $res = search_file ( $file_path, $fileName);
//             $found = array_merge( $found, $res );
//         }
//     }

//    closedir($dir);
//    return $found;
// }


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
            // Ищем точное совпадение имени файла (например, User.php)
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
