<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 17.12.18
 * Time: 14:36
 */

namespace mvc_erdeni\Controller;


class RegistryStatus extends \BetterEnum
{

    const __default = self::FAIL_OTHER;
    const SUCCESS = 0;
    const FAIL_LOGIN_DUPLICATE = 1;
    const FAIL_EMAIL_DUPLICATE = 2;
    const FAIL_OTHER = 3;

}