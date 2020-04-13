<?php
require 'ViewController.php';

class EditController
{
    public $view;

    public function edit()
    {
        $this->view = new ViewController();
        $path = substr($_SERVER['REQUEST_URI'], 1);
        $data = $this->getContent();
        return $this->view->render($path, $data);
    }

    public function editSave() {
        $text = $_POST['text'];
        if(isset($_FILES['image'])){
            $file = "images/img";
            $filePath = $_FILES['image']['tmp_name'];
            copy($filePath, __DIR__ . "/../{$file}");
        }
        $connect = $this->getConnect();
        $id = 1;
        $sql = "UPDATE posts SET text = '{$text}' WHERE id = {$id}";
        $query = mysqli_query($connect, $sql);
        if($query === true) {
            header('Location: /show');
        }
    }

    public function show()
    {
        $this->view = new ViewController();
        $path = substr($_SERVER['REQUEST_URI'], 1);
        $data = $this->getContent();
        return $this->view->render($path, $data);
    }

    public function getContent() {
        $connect = $this->getConnect();
        $id = 1;
        $sl = mysqli_query($connect,"SELECT text from posts where id = {$id} ");
        $data = mysqli_fetch_assoc($sl);
        return $data;
    }

    public function getConnect() {
        $connect = mysqli_connect('localhost','id13267060_user','WSHv?Hq%}*R?2<Bh', 'id13267060_main');
        //$connect = mysqli_connect('localhost','root','5311', 'test');
        return $connect;
    }
}