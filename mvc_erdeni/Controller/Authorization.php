<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 14.12.18
 * Time: 14:58
 */

namespace mvc_erdeni\Controller {

    use mvc_erdeni\Model\PdoQuery;

    class Authorization {

        /** проверяем статус сессии - авторизован?
         * @return bool
         */
        public function IsSessionAuthorized() : bool {

            if (!$_SESSION['login'] || !$_SESSION['pass']) {
                return false;
            }

            $pdo = new PdoQuery();
            $query = "SELECT login, password, email_confirmed FROM users WHERE login = :login";
            $params = array (":login" => strtolower($_SESSION['login']));

            try {
                $fetchResult = $pdo->fetch($query, $params);
                if ( $fetchResult['login'] == strtolower($_SESSION['login']) ) {    /* username - существует */

                    if ($_SESSION['pass'] === $fetchResult['password'] && $fetchResult['email_confirmed'] != 0) {
                        return true;
                    }
                }
            }
            catch (\PDOException $pe) {
                echo 'Fetch failed: ' . $pe->getMessage();
            }
            return false;

        }

        /** проверяем пару логин:пароль
         * @param $username
         * @param $password
         * @return int
         */
        public function CheckLoginPassword($username, $password) : int {

            $pdo = new PdoQuery();
            $query = "SELECT login, password, email_confirmed FROM users WHERE login = :login";
            $params = array (":login" => strtolower($username));

            try {
                $fetchResult = $pdo->fetch($query, $params);
                if ( $fetchResult['login'] == strtolower($username) ) {    /* username - существует */

                    if (password_verify($password, $fetchResult['password'])) {

                        if ($fetchResult['email_confirmed'] != 0) {
                            // успешная авторизация
                            $_SESSION['login'] = $fetchResult['login'];
                            $_SESSION['pass'] = $fetchResult['password'];
                            return AuthStatus::SUCCESS;
                        }
                        else {
                            return AuthStatus::FAIL_NOT_ACTIVATION;
                        }
                    }
                    else {
                        // неправильный пароль
                        sleep(1);       //anti-DDOS
                        return AuthStatus::FAIL_INCORRECT_PASSWORD;
                    }
                }
                else {
                    return AuthStatus::FAIL_LOGIN_NOT_EXIST;
                }
            }
            catch (\PDOException $pe) {
                echo 'Fetch failed: ' . $pe->getMessage();
            }
            return AuthStatus::FAIL_OTHER;

        }

        /**
         * Выход из аккаунта. Очищаем сессию
         */
        public function Logout() {

            $_SESSION['login']=null;
            $_SESSION['pass']=null;

        }


    }
}