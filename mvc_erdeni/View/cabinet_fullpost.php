<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 20.12.18
 * Time: 16:22
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
    <?php
    $id = $get_secure_array['id'];
    $element = Post::loadById($id);
    echo "<h2>".$element->subject."</h2>";
    if ($element->getLogin() == $_SESSION['login']) {
        echo "<a href='index.php?page=editpost&id=$id'>[ Edit ]</a>";
    }
    echo "<p>------- </p>";
    echo "<div>".htmlspecialchars_decode($element->body)."</div>";
    $user = $element->getLogin();
    echo "<p>------- Date create: ".$element->getDateCreate()." ----- User: <a href='index.php?page=profile&user=$user'>".$element->getFullUserName()."</a></p>";
    ?>

</div>
</body>

</html>
