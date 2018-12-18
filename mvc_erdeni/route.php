<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 13.12.18
 * Time: 18:59
 */

use mvc_erdeni\Controller\{
    Authorization,
    AuthStatus,
    Registration,
    RegistryStatus,
    Post
};

$post_secure_array = array_map ( 'htmlspecialchars' , $_POST );
$get_sucure_array = array_map ('htmlspecialchars', $_GET);
$authorization = new Authorization();

if (strtolower($get_sucure_array['page']) == 'registry') {

    if (!$authorization->IsSessionAuthorized()) {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $reg_login = $post_secure_array['reg_login'];
            $reg_email = $post_secure_array['reg_email'];
            $reg_pass = $post_secure_array['reg_pass'];
            $reg_repeat = $post_secure_array['reg_repeat'];
            $reg_firstname = $post_secure_array['reg_firstname'];
            $reg_lastname = $post_secure_array['reg_lastname'];

            if ($reg_pass === $reg_repeat) {
                $registration = new Registration();

                $returnCode = $registration->RegistryUser($reg_login, $reg_email, $reg_pass, $reg_firstname, $reg_lastname);
                if ($returnCode == RegistryStatus::SUCCESS) {

                    $token = $registration->getLastSuccessRegisterUserToke();

                    //Составляем заголовок письма
                    $subject = "Подтверждение почты на сайте ".$_SERVER['HTTP_HOST']."<br/>";

                    $email_admin = "admin@blog.project1";

                    //Составляем тело сообщения
                    $message = 'Здравствуйте! <br/> <br/> Сегодня '.date("d.m.Y", time()).', неким пользователем была произведена регистрация на сайте <a href="/">'.$_SERVER['HTTP_HOST'].'</a> используя Ваш email. Если это были Вы, то, пожалуйста, подтвердите адрес вашей электронной почты, перейдя по этой ссылке: <a href="/index.php?page=confirm_email&token='.$token.'">/index.php?page=confirm_email&token=/'.$token.'</a> <br/> <br/> В противном случае, если это были не Вы, то, просто игнорируйте это письмо. <br/> <br/> <strong>Внимание!</strong> Ссылка действительна 24 часа. После чего Ваш аккаунт будет удален из базы.';

                    //Составляем дополнительные заголовки для почтового сервиса mail.ru
                    //Переменная $email_admin, объявлена в файле dbconnect.php
                    $headers = "FROM: $email_admin\r\nReply-to: $email_admin\r\nContent-type: text/html; charset=utf-8\r\n";

                    //Отправляем сообщение с ссылкой для подтверждения регистрации на указанную почту и проверяем отправлена ли она успешно или нет.
                    mail($reg_email, $subject, $message, $headers);

                    include("View/registry_success.php");
                    echo $subject . $message;
                }
                elseif ($returnCode == RegistryStatus::FAIL_LOGIN_DUPLICATE) {
                    include("View/registry_failed.php");
                    echo "<p>Login is registered yet. Try another login.</p>";
                }
                elseif ($returnCode == RegistryStatus::FAIL_EMAIL_DUPLICATE) {
                    include("View/registry_failed.php");
                    echo "<p>E-mail is busy yet. Try another e-mail address.</p>";
                }

            }
            else {
                include("View/registry.php");
                echo '<p>Error. Repeated passwords not equal.</p>';
            }

        }
        else {
            include("View/registry.php");
        }

    }
    else {

        include("View/cabinet.php");

    }

}

elseif (strtolower($get_sucure_array['page']) == 'logout') {

    $authorization->Logout();
    header('Location: index.php');
    exit;

}

elseif (strtolower($get_sucure_array['page']) == 'confirm_email') {

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        $token = $get_sucure_array['token'];
        $registration = new Registration();
        $return = $registration->ConfirmEmail($token);
        include("View/login.php");
        if ($return) {
            echo '<p>Confirmation e-mail successfully. Your account is activated.</p>';
        }
        else {
            echo '<p>Confirmation e-mail failure. Time expired or token invalid.</p>';
        }

    }

}

elseif (strtolower($get_sucure_array['page']) == 'addpost') {

    if (!$authorization->IsSessionAuthorized()) { // если не авторизован, то перенаправить на логин

        include ("View/login.php");
        exit;

    }
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {  // если не POST-запрос, тогда перенаправить на страницу с формой
        include ("View/cabinet_addpost.php");
        exit;
    }
    // если пришли данные с POST-запросом, тогда выполняется код ниже
    $post_subject = $post_secure_array['post_subject'];
    $post_body = $post_secure_array['post_body'];
    $poster = new Post($post_subject, $post_body);
    $return = $poster->save();
    include ("View/cabinet_addpost.php");
    if ($return) {
        echo "Congratulations. Your post is added to database successfully.";
    }
    else {
        echo "Error. Your post is not added.";
    }

}

else {      /* index.php Главная страница */

    if (!$authorization->IsSessionAuthorized()) {
        /* Если не авторизован */

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $post_login = $post_secure_array['username'];
            $post_pass = $post_secure_array['password'];

            $return_auth = $authorization->CheckLoginPassword($post_login, $post_pass);
            if ($return_auth == AuthStatus::SUCCESS) {
                header('Location: index.php');
                exit;
            }
            include("View/login.php");
            if ($return_auth == AuthStatus::FAIL_NOT_ACTIVATION) {
                echo '<p>Error. Your account has not been activated.</p>';
            }
            if ($return_auth == AuthStatus::FAIL_INCORRECT_PASSWORD) {
                echo '<p>Incorrect password. Check your password and then try again.</p>';
            }
            if ($return_auth == AuthStatus::FAIL_LOGIN_NOT_EXIST || $return_auth == AuthStatus::FAIL_OTHER) {
                echo '<p>Incorrect login or password. Check your login and password and then try again.</p>';
            }

        }
        else {      /* GET, PUT и другие */

            include("View/login.php");

        }
    }
    else {      /* Если авторизован как пользователь */

        include("View/cabinet.php");

    }


}