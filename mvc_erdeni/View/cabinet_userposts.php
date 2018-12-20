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
    <p>You are welcome, logged user: <strong><?=$_SESSION['login'];?></strong></p>
    <h2>All posts from the user</h2>
    <?php
    $user = $get_secure_array['user'];
    foreach (Post::allPostsOfUser($user) as $element) {
        $id = $element->getId();
        echo "<div><p><a href=\"/index.php?page=fullpost&id=$id\">".$element->subject."</a>
</p>".htmlspecialchars_decode($element->body)."</div>";
        echo "<p>------- Date create: ".$element->getDateCreate()." ----- User: ".$element->getFullUserName()."</p>";
    }
    ?>

</div>
</body>

</html>