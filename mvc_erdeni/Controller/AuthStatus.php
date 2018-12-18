<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 14.12.18
 * Time: 18:11
 */

namespace mvc_erdeni\Controller {

    class AuthStatus extends \BetterEnum
    {

        const __default = self::FAIL_OTHER;
        const SUCCESS = 0;
        const FAIL_NOT_ACTIVATION = 1;
        const FAIL_LOGIN_NOT_EXIST = 2;
        const FAIL_INCORRECT_PASSWORD = 3;
        const FAIL_OTHER = 4;

    }

}