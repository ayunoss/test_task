<?php
namespace task3\models;

class View {

    public function render($title, $layout, $data = []) {
        // достаем данные для отображения, если они есть
        extract($data);

        // путь для шаблона
        $path = 'storage/views/'.$layout.'.php';
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
        } else {
            echo $path.' is not found';
        }
    }
}
