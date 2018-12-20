<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 18.12.18
 * Time: 17:34
 */

namespace mvc_erdeni\Controller;

use mvc_erdeni\Model\PdoQuery;

class Post
{
    /** приватные
     * @var null
     */
    private $id = null;
    private $date_create = null;
    private $login = null;
    private $date_update = null;

    /** публичные
     * @var null
     */
    public $subject = null;
    public $body = null;

    public function __construct() {
        // allocate your stuff
    }

    public static function setter($subject, $body) {

        $instance = new self();
        $instance->subject = $subject;
        $instance->body = $body;
        return $instance;

    }

    public static function loadById($id) {
        $instance = new self();
        $pdo = new PdoQuery();
        $query = "SELECT * FROM posts WHERE id = :id";
        $params = array (":id" => $id);
        $result = $pdo->fetch($query, $params);
        $instance->subject = $result['header'];
        $instance->body = $result['body'];
        $instance->id = $id;
        $instance->date_create = $result['time_created'];
        $instance->date_update = $result['time_updated'];
        $instance->login = $result['login_author'];
        return $instance;
    }

    public static function AllPosts() {

        $pdo = new PdoQuery();
        $query = "SELECT id FROM `posts` ORDER BY time_created DESC";
        $params = array();
        $fetchAll = $pdo->fetchAll($query, $params);
        foreach ($fetchAll as $row) {
            $containerPosts[] = Post::loadById($row['id']);
        }
        return $containerPosts;

    }

    public static function allPostsOfUser($user) {

        $pdo = new PdoQuery();
        $query = "SELECT id FROM `posts` WHERE login_author = :login_author ORDER BY time_created DESC";
        $params = array(":login_author" => $user);
        $fetchAll = $pdo->fetchAll($query, $params);
        foreach ($fetchAll as $row) {
            $containerPosts[] = Post::loadById($row['id']);
        }
        return $containerPosts;

    }


    public function save() : bool {

        $pdo = new PdoQuery();
        $lastId = $pdo->insert("posts", array(
            "header" => $this->subject,
            "body" => $this->body,
            "login_author" => $_SESSION['login'],
            'time_created' => date('Y-m-d G:i:s')
        ));
        if ($lastId > 0) {
            $this->id = $lastId;
            return true;
        }
        return false;

    }

    public function getId() {
        return $this->id;
    }
    public function getDateCreate() {
        return $this->date_create;
    }
    public function getDataUpdate() {
        return $this->date_update;
    }
    public function getLogin() {
        return $this->login;
    }
    public function getFullUserName() : string
    {
        if (!($this->login)) {
            return "";
        }
        $pdo = new PdoQuery();
        $query = "SELECT first_name, last_name FROM users WHERE login = :login";
        $params = array (":login" => $this->login);
        $result = $pdo->fetch($query, $params);
        return $result['first_name'] . " ". $result['last_name'];
    }

}