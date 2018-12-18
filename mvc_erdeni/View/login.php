<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 13.12.18
 * Time: 19:05
 */

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Blog Project1 - Login</title>
</head>

<body>
<div>
    <a href="/">Login</a>
    <a href="index.php?page=registry">Registry</a>
</div>
<div>
    <p>&nbsp;</p>
    <p>My blog - this is a main page.</p>
    <p>You will not see your personal cabinet until log on.</p>
    <p>Put your login and password below to log on.</p>
    <p>&nbsp;</p>
</div>
<form id="data" method="post" >
    <p>Your login:</p>
    <p><input type="text" placeholder="login" name="username" form="data"></p>
    <p>Your password:</p>
    <p><input type="password" placeholder="password" name="password" form="data"></p>
    <p><input type="submit" value="Authorization" form="data"></p>
</form>
</body>

</html>