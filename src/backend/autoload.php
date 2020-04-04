<?php

include 'src/backend/core/Helper.php';

function autoload($class_name) 
{

    # List all the class directories in the array.
    $array_paths = array(
        'core/', 
        'core/Products'
    );

    foreach($array_paths as $path)
    {
        $file = sprintf('src/backend/%s/%s.php', $path, $class_name);
        if(is_file($file)) 
        {
            include_once $file;
        } 

    }
}

spl_autoload_register('autoload');