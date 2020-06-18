<?php

/**
 * @param PDO $connection
 * @param string $ids
 * @return mixed $data
 */
function loadUsersData($ids, $connection) {
    $data = [];
    $ids  = explode(',', $ids);
    if (count($ids) < 1) {
        return $data;
    }
    /**
     * PDO bind.
     */
    $in = str_repeat('?,', count($ids) - 1) . '?';
    $query = $connection->prepare("SELECT * FROM users WHERE id IN ($in)");
    $query->execute($ids);
    while ($user = $query->fetchObject()) {
        $data[$user->id] = $user->username;
    }

    return $data;
}

/**
 * Вынесем отображение ссылок на пользователей в отдельный метод
 * @param $data
 */
function showUserLink($data) {
    foreach ($data as $user_id => $name) {
        echo <<<HTML
   <a href="show_user.php?id=$user_id">$name</a>
HTML;
    }
}

/**
 * Подключимся к бд один раз, вместо цикла, с помощью конфиг файла
 * @param array $config
 */
$link = [];
$config = require "config.php";
foreach ($config as $key => $val) {
    $link[$key] = $val;
}
try {
    $connect = new PDO('mysql:host='.$link['host'].';dbname='.$link['dbname'].'', $link['user'], $link['password']);
    $data    = loadUsersData($_GET['user_ids'] ?? '', $connect);
    showUserLink($data);
} catch (\PDOException $e) {
    echo 'Сonnection failed'.$e->getMessage();
}


