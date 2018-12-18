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

    private $id = null;
    private $saved_subject = null;
    private $saved_body = null;

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
        $query = "SELECT header, body FROM posts WHERE id = :id";
        $params = array (":id" => $id);
        $result = $pdo->fetch($query, $params);
        $instance->subject = $result['header'];
        $instance->body = $result['body'];
        $instance->id = $id;
        return $instance;
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
            $this->saved_subject = $this->subject;
            $this->saved_body = $this->body;
            return true;
        }
        return false;

    }

    public function backupFromSaved() {

        $this->subject = $this->saved_subject;
        $this->body = $this->saved_body;

    }

}