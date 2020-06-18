<?php
namespace task3\models;

use task3\models\Db;

class Post {

    protected $db;

    public function __construct() {
        $this->db = new Db();
    }

    public function getAllUserPosts($user_id) {
        $posts = $this->db->select("SELECT * FROM Posts WHERE user_id='{$user_id}'");
        return $posts;
    }

    public function getAuthor($post_id) {
        $author = $this->db->select("SELECT author FROM Posts WHERE id='{$post_id}'");
        return $author;
    }

    public function createPost($data) {
        $sql = "INSERT INTO Posts (id, user_id, author, text)
        VALUES (null, :user_id, :author, :text)";
        $result = $this->db->insert($sql, $data);
    }

    public function setAuthor($data, $id) {
        $this->db->update($data, $id);
    }
}