<?php
/**
 * Project: paneldev
 * Created by: WinXaito
 * Date: 12.01.2017
 */

/**
 * @param $class
 */
function autoload($class){
    $path = autoloadStripPath($class);

    if(substr($class, 0, 4) == 'Twig'){
        $finalPath = __DIR__ . '/../lib/'.$path.'.php';

        if (file_exists($finalPath)) {
            require_once $finalPath;
            return;
        }
    }else if(substr($class, 0, 2) == "Wx"){
        $finalPath = __DIR__.'/'.$path.'.class.php';

        if (file_exists($finalPath)) {
            require_once $finalPath;
            return;
        }
    }else{
        echo 'Error 500, please contact an administrator<br>
        Debug:<br>
          '.$path.'
        ';
        die;
    }
}

/**
 * @param $strip
 * @return string
 */
function autoloadStripPath($strip){
    $classToLoad = explode("_", $strip);

    $path = "";
    for ($i = 0; $i < count($classToLoad); $i++) {
        if ($i == count($classToLoad) - 1)
            $path .= $classToLoad[$i];
        else
            $path .= $classToLoad[$i] . '/';
    }

    return $path;
}