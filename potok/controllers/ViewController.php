<?php

class ViewController
{
    function render($path, $data = []) {
        if($data != 0) extract($data);
        ob_start();
        require "views/". $path .".php";
        $content = ob_get_clean();
        require "views/default.php";
    }
}