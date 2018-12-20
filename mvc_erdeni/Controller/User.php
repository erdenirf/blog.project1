<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 20.12.18
 * Time: 17:53
 */

namespace mvc_erdeni\Controller;

use mvc_erdeni\Model\PdoQuery;


class User
{
    /** приватные поля, нельзя их менять
     * @var null
     */
    private $email = null;
    private $id = null;
    private $time_created = null;
    private $time_updated = null;
    private $is_email_confirmed = null;

    /** публичные поля их можно поменять
     * @var null
     */
    public $login = null;
    public $password = null;
    public $first_name = null;
    public $last_name = null;

    public function __construct() {
        // allocate your stuff
    }

    public static function setter($login, $password, $first_name, $last_name) {

        $instance = new self();
        $instance->login = $login;
        $instance->password = $password;
        $instance->first_name = $first_name;
        $instance->last_name = $last_name;
        return $instance;

    }

    public static function loadByLogin($login) {

        $instance = new self();
        $pdo = new PdoQuery();
        $query = "SELECT * FROM users WHERE login = :login";
        $params = array (":login" => $login);
        $result = $pdo->fetch($query, $params);
        $instance->id = $result['id'];
        $instance->login = $result['login'];
        $instance->email = $result['email'];
        $instance->password = $result['password'];
        $instance->first_name = $result['first_name'];
        $instance->last_name = $result['last_name'];
        $instance->time_created = $result['created'];
        $instance->time_updated = $result['updated'];
        $instance->is_email_confirmed = $result['email_confirmed'];
        return $instance;
    }

    public function getFullUserName() : string
    {
        if (!($this->login)) {
            return "";
        }
        return $this->first_name . " ". $this->last_name;
    }

    public function getId() {
        return $this->id;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getTimeCreated() {
        return $this->time_created;
    }
    public function getTimeUpdated() {
        return $this->time_updated;
    }
    public function getIsConfirmedEmail() {
        return $this->is_email_confirmed;
    }

}