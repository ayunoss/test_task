<?php
use task3\controllers\PostController;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$url = $_SERVER['REQUEST_URI'];

$autoloadFunction = function($class){
    $path = str_replace('\\','/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
};

spl_autoload_register($autoloadFunction);
session_start();

$post = new PostController();
// показать все статьи пользователя
$post->showAllUserPosts();
// показать автора статьи
$post->getAuthor();
// создать статью
$post->createPost();
// изменить автора статьи
$post->setAuthor();


