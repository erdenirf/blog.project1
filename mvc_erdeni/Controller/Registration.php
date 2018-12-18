<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 14.12.18
 * Time: 19:31
 */

namespace mvc_erdeni\Controller;

use mvc_erdeni\Model\PdoQuery;

class Registration
{

    private $lastUserToken = null;

    public function getLastSuccessRegisterUserToke() {
        return $this->lastUserToken;
    }

    /** Функция регистрации нового пользователя
     * @param $login
     * @param $email
     * @param $password
     * @param $first_name
     * @param $last_name
     * @return int
     */
    public function RegistryUser ($login, $email, $password, $first_name, $last_name) : int {

        if ($this->isExistLogin(strtolower($login))) {

            return RegistryStatus::FAIL_LOGIN_DUPLICATE;
        }

        if ($this->isExistEmail(strtolower($email))) {

            return RegistryStatus::FAIL_EMAIL_DUPLICATE;
        }

        $pdo = new PdoQuery();
        $data = [
            'login' => strtolower($login),
            'email' => strtolower($email),
            'password' => $this->HashCodeGenerate($password),
            'first_name' => $first_name,
            'last_name' => $last_name,
            'created' => date('Y-m-d G:i:s'),
            'email_confirmed' => 0
        ];
        $confirmation = [
            "email" => strtolower($email),
            "token" => $this->activationCodeGenerate($email),
            "date_expires" => $this->activationDateExpiresGet()
        ];
        try {
            $pdo->beginTransaction();
            $returnCode = $pdo->insert("users", $data);
            if ($returnCode > 0) {
                $secondCode = $pdo->insert("confirm_emails", $confirmation);
            }
        }
        catch (\PDOException $pe) {
            echo 'pdo: ' . $pe->getMessage();
            $pdo->rollBack();
            return RegistryStatus::FAIL_OTHER;
        }

        if ($returnCode > 0 && $secondCode > 0) {

            $this->lastUserToken = $confirmation['token'];
            return RegistryStatus::SUCCESS;
        }

        return RegistryStatus::FAIL_OTHER;
    }

    /**
     * @param $token
     * @return bool
     * @throws \Exception
     */
    public function ConfirmEmail ($token) : bool {

        $pdo = new PdoQuery();
        $query = "SELECT email, date_expires FROM confirm_emails WHERE token = :token";
        $params = array (":token" => strtolower($token));
        try {
            $fetchResult = $pdo->fetch($query, $params);
            $date1 = new \DateTime($fetchResult['date_expires']);
            $date2 = new \DateTime("now");
            if ($date1 >= $date2) {
                $email = '"'.$fetchResult['email'].'"';
                $result = $pdo->exec("UPDATE users SET email_confirmed=1 WHERE email = ".$email);
                if ($result > 0) {
                    return true;
                }
            }
        }
        catch (\PDOException $pe) {
            return false;
        }
        return false;

    }

    /** Время окончания ссылки активации e-mail
     * @return string
     * @throws \Exception
     */
    private function activationDateExpiresGet() : string {

        $dt = new \DateTime("@".$_SERVER['REQUEST_TIME']);  // convert UNIX epoch to PHP DateTime
        $dt->modify('+24 hours');
        return $dt->format("Y-m-d G:i:s");

    }

    /** ссылка подтверждения e-mail
     * @return string
     */
    private function activationCodeGenerate($email) : string {

        return password_hash(strtolower($email), PASSWORD_DEFAULT);
    }

    /** есть логин в базе?
     * @param $login
     * @return bool
     */
    private function isExistLogin ($login) : bool {

        $pdo = new PdoQuery();
        $query = "SELECT id FROM users WHERE login = :login";
        $params = array (":login" => strtolower($login));

        try {
            $fetchResult = $pdo->fetch($query, $params);
            if ($fetchResult['id']) {
                return true;
            }
        }
        catch (\PDOException $pe) {
            echo 'fetch error: ' . $pe->getMessage();
        }
        return false;

    }

    /** есть email уже в базе?
     * @param $email
     * @return bool
     */
    private function isExistEmail ($email) : bool {

        $pdo = new PdoQuery();
        $query = "SELECT id FROM users WHERE email = :email";
        $params = array (":email" => strtolower($email));

        try {
            $fetchResult = $pdo->fetch($query, $params);
            if ($fetchResult['id']) {
                return true;
            }
        }
        catch (\PDOException $pe) {
            echo 'fetch error: ' . $pe->getMessage();
        }
        return false;

    }

    /** хеш-код пароля
     * @param $word
     * @return bool|string
     */
    private function HashCodeGenerate ($word)
    {

        return password_hash($word, PASSWORD_BCRYPT);

    }

}