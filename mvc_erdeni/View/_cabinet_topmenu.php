<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 20.12.18
 * Time: 16:23
 */

?>


<div>
    <a href="/">Home</a>
    <a href="index.php?page=addpost">Add post</a>
    <a href="index.php?page=userposts&user=<?=$_SESSION['login'];?>">My posts</a>
    <a href="index.php?page=profile&user=<?=$_SESSION['login'];?>">My profile</a>
    <a href="index.php?page=logout">Logout</a>
</div>
