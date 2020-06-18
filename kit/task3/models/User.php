<?php
namespace task3\models;

class User {

    protected $db;

    public function __construct() {
        $this->db = new Db();
    }

    public function getUserName($user_id) {
        $author = $this->db->select("SELECT name FROM Users WHERE id='{$user_id}'");
        return $author;
    }
}