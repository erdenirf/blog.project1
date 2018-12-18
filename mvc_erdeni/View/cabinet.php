<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 13.12.18
 * Time: 19:31
 */

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Блог главная страница</title>
</head>

<body>
<div>
    <a href="/">Home</a>
    <a href="/">My posts</a>
    <a href="/">My profile</a>
    <a href="index.php?page=logout">Logout</a>
</div>
<div>
    <p>&nbsp;</p>
    <p>PERSONAL CABINET</p>
    <p>You are welcome, logged user :)</p>
    <p>Your name is <?=$_SESSION['login'];?></p>
    <p>Your hashcode is <?=$_SESSION['pass'];?></p>
    <p>&nbsp;</p>
</div>
</body>

</html>