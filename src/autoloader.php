<?php

class AutoLoader {

    public function load($className)
    {

        $file = __DIR__  . DIRECTORY_SEPARATOR . 'core'. DIRECTORY_SEPARATOR;
        $file .=  str_replace('\\', '/', $className). '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            return false;
        }
    }

    public function register()
    {
        spl_autoload_register(array($this, 'load'));
    }
}

$loader = new AutoLoader();
$loader->register();
