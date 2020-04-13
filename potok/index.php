<?php
//
require 'controllers/EditController.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$editController = new EditController();

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
if ($requestUri === '/edit') {
    if ($requestMethod === 'GET') {
        $content = $editController->edit();
    } elseif ($requestMethod === 'POST') {
        $content = $editController->editSave();
    }
} elseif ($requestUri === '/show') {
    $content = $editController->show();
} else {
    $content = '404';
}
echo $content;
die;