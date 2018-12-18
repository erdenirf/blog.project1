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
    <a href="index.php?page=addpost">Add post</a>
    <a href="/">My posts</a>
    <a href="/">My profile</a>
    <a href="index.php?page=logout">Logout</a>
</div>
<div>
    <h2>Home of personal cabinet</h2>
    <p>You are welcome, logged user: <strong><?=$_SESSION['login'];?></strong></p>
    <p>&nbsp;</p>

</div>
</body>

</html>