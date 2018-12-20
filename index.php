<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 13.12.18
 * Time: 14:56
 */

// Запуск сессии куков
session_start();

$root = $_SERVER['DOCUMENT_ROOT'];

require_once($root . 'mvc_erdeni/config.php');
require_once($root . 'mvc_erdeni/Model/SingletonDataBase.php');
require_once($root . 'mvc_erdeni/Model/PdoQuery.php');
require_once($root . 'mvc_erdeni/vendor/Isloan/BetterEnum.php');
require_once($root . 'mvc_erdeni/Controller/AuthStatus.php');
require_once($root . 'mvc_erdeni/Controller/Authorization.php');
require_once($root . 'mvc_erdeni/Controller/RegistryStatus.php');
require_once($root . 'mvc_erdeni/Controller/Registration.php');
require_once($root . 'mvc_erdeni/Controller/Post.php');
require_once($root . 'mvc_erdeni/Controller/User.php');
require_once($root . 'mvc_erdeni/route.php');

