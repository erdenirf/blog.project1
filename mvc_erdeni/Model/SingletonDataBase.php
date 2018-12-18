<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 13.12.18
 * Time: 17:06
 */

namespace mvc_erdeni\Model {

    class SingletonDataBase
    {

        /**
         * @return \PDO|null  Получить статичный объект бд
         */
        public static function getInstance() {

            return self::$instance ?? self::connect();

        }

        private static $instance = null;

        private function __construct()
        {
        }

        private static function connect() {

            try {
                return new \PDO("mysql:host=localhost;dbname=blog_project1;charset=utf8",
                    "blog_owner",
                    "vCdLFNQ1cJErpisB", [
                        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                        \PDO::ATTR_EMULATE_PREPARES   => false,
                    ]);
            }
            catch (\PDOException $pe) {
                echo 'Connection failed: ' . $pe->getMessage();
            }


        }

    }
}