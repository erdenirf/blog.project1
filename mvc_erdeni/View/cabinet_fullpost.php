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
    echo "<p>------- </p>";
    echo "<div>".htmlspecialchars_decode($element->body)."</div>";
    echo "<p>------- Date create: ".$element->getDateCreate()." ----- User: ".$element->getFullUserName()."</p>";
    ?>

</div>
</body>

</html>
