<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 13.12.18
 * Time: 19:40
 */

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Blog Project1 - Registry</title>
</head>

<body>
<div>
    <a href="/">Login</a>
    <a href="index.php?page=registry">Registry</a>
</div>
<div>
    <p>&nbsp;</p>
    <p>My blog - this is a registry page.</p>
    <p>Hello. Full control on the site you will take after you had been registered.</p>
    <p>Put your personal data below to registry new account.</p>
    <p>&nbsp;</p>
</div>
<form id="data" method="post">
    <p>Login<span style="color:red;">*</span>:</p>
    <p><input type="text" placeholder="login" name="reg_login" form="data" required></p>
    <p>E-mail<span style="color:red;">*</span>:</p>
    <p><input type="email" placeholder="e-mail" name="reg_email" form="data" required></p>
    <p>Password<span style="color:red;">*</span>:</p>
    <p><input type="password" placeholder="password" name="reg_pass" form="data" required></p>
    <p>Repeat password<span style="color:red;">*</span>:</p>
    <p><input type="password" placeholder="repeat password" name="reg_repeat" form="data" required></p>
    <p>First name<span style="color:red;">*</span>:</p>
    <p><input type="text" placeholder="first name" name="reg_firstname" form="data" required></p>
    <p>Last name<span style="color:red;">*</span>:</p>
    <p><input type="text" placeholder="last name" name="reg_lastname" form="data" required></p>
    <p>By creating an account you agree with Russian Law "Yarovoi" about personal data storage</p>
    <p><input type="submit" value="Registry new user" form="data"></p>
</form>
</body>

</html>
