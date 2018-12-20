<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 20.12.18
 * Time: 16:22
 */

use mvc_erdeni\Controller\User;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Блог главная страница</title>
</head>

<body>
<?php
include("_cabinet_topmenu.php");   // меню внутри кабинета
?>
<div>
    <p>You are welcome, logged user: <strong><?=$_SESSION['login'];?></strong></p>
    <?php
    $user = $get_secure_array['user'];
    $element = User::loadByLogin($user);
    echo "<h2>Profile of ".$element->getFullUserName()."</h2>";
    echo "<div>
<p>Login:</p>
<p>&nbsp;&nbsp;&nbsp;<strong>".$element->login."</strong></p>
<p>E-mail:</p>
<p>&nbsp;&nbsp;&nbsp;<strong>".$element->getEmail()."</strong></p>
<p>First name:</p>
<p>&nbsp;&nbsp;&nbsp;<strong>".$element->first_name."</strong></p>
<p>Last name:</p>
<p>&nbsp;&nbsp;&nbsp;<strong>".$element->last_name."</strong></p>
<p>Date created:</p>
<p>&nbsp;&nbsp;&nbsp;<em>".$element->getTimeCreated()."</em></p>
<p>Date updated:</p>
<p>&nbsp;&nbsp;&nbsp;<em>".$element->getTimeUpdated()."</em></p>
</div>";
    echo "<div>
<p><a href='index.php?page=userposts&user=$user'>View all posts of this user.</a></p>
</div>"
    ?>

</div>
</body>

</html>
