<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 13.12.18
 * Time: 19:31
 */

use mvc_erdeni\Controller\Post;

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
    <h2>Home of personal cabinet</h2>
    <p>You are welcome, logged user: <strong><?=$_SESSION['login'];?></strong></p>
    <p>&nbsp;</p>
    <?php
    foreach (Post::AllPosts() as $element) {
        $id = $element->getId();
        echo "<div><p><a href=\"/index.php?page=fullpost&id=$id\">".$element->subject."</a>
</p>".htmlspecialchars_decode($element->body)."</div>";
        $login = $element->getLogin();
        echo "<p>------- Date create: ".$element->getDateCreate()." ----- User: <a href=\"index.php?page=profile&user=$login\">".$element->getFullUserName()."</p>";
    }
    ?>
</div>
</body>

</html>