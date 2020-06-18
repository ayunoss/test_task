<?php
namespace task3\controllers;
use task3\models\Post;
use task3\models\User;
use task3\models\View;

class PostController
{
    protected $model;
    public    $view;

    public function __construct() {
        $this->model = new Post();
        $this->view  = new View();
    }

    // предполагается, что можно выбрать пользователя, для отображения постов
    public function showAllUserPosts() {
        $user_id = $_POST['user_id'];
        $data    = $this->model->getAllUserPosts($user_id);
        $this->view->render('Posts', 'showAll', $data);
    }

    // предполагается, что можно выбрать пост, для отображения имени автора
    public function getAuthor() {
        $post_id = $_POST['post_id'];
        $data    = $this->model->getAuthor($post_id);
        $this->view->render("Post's Author", 'showAuthor', $data);
    }

    // предполагается, что пользователь авторизован и есть форма для создания поста
    public function createPost() {
        $user    = new User();
        $user_id = $_SESSION['user_id'];
        $author  = $user->getUserName($user_id);
        $text    = $_POST['text'];
        $data    = [
            'user_id' => $user_id,
            'author'  => $author,
            'text'    => $text
        ];
        $this->model->createPost($data);
    }

    public function setAuthor() {
        $user    = new User();
        $user_id = $_POST['user_id'];
        $post_id = $_POST['post_id'];
        $author  = $user->getUserName($user_id);
        $data    = [
            'author' => $author
        ];
        $this->model->setAuthor($data, $post_id);
    }
}