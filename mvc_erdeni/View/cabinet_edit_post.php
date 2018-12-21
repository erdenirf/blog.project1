<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 20.12.18
 * Time: 16:22
 */

use mvc_erdeni\Controller\Post;

    $id = $get_secure_array['id'];
    $element = Post::loadById($id);

    if ($element->getLogin() != $_SESSION['login']) {   //если автор поста не ты, то ошибка доступа
        header($_SERVER["SERVER_PROTOCOL"]." 403 Access was denied");
        exit;
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit post</title>
    <script src="mvc_erdeni/vendor/ckeditor/ckeditor.js"></script>
</head>

<body>
<?php
include("_cabinet_topmenu.php");   // меню внутри кабинета
?>
<div>
    <p>You are welcome, logged user: <strong><?=$_SESSION['login'];?></strong></p>

    <h2>Edit exist post for user</h2>

    <form action="index.php?page=editpost" id="data" method="post">

        <p>Post's subject:</p>
        <p><input type="text" value="<?=$element->subject;?>" placeholder="subject" name="post_subject" size="50" form="data"></p>

        <p>Post's body:</p>
        <!-- (2): textarea will replace by CKEditor -->
        <textarea class="ckeditor" name="post_body" cols="50" rows="10" form="data">
            <?=htmlspecialchars_decode($element->body); ?>
        </textarea>
        <input type="hidden" value="<?=$id;?>" form="data" name="id"/>

        <p><input type="submit" value="Edit post" form="data"></p>
    </form>
    <?php
    $user = $element->getLogin();
    echo "<p>------- Date create: ".$element->getDateCreate()." ----- User: <a href='index.php?page=profile&user=$user'>".$element->getFullUserName()."</a></p>";
    ?>


</div>
</body>

</html>
