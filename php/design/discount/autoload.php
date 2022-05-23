<?php
spl_autoload_register(function ($className)
{
    $classFile = './discount/'.$className.'.php';
    include_once $classFile;
});