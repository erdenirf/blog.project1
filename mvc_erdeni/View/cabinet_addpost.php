<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 18.12.18
 * Time: 17:05
 */
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Post Add new</title>

    <!-- (1) : Declaration for CKEditor library -->
    <script src="mvc_erdeni/vendor/ckeditor/ckeditor.js"></script>

</head>
<body>
<?php
include("_cabinet_topmenu.php");   // меню внутри кабинета
?>

    <h2>Add new post from user</h2>

    <form action="index.php?page=addpost" id="data" method="post">

        <p>Post's subject:</p>
        <p><input type="text" placeholder="subject" name="post_subject" size="50" form="data"></p>

        <p>Post's body:</p>
        <!-- (2): textarea will replace by CKEditor -->
        <textarea class="ckeditor" name="post_body" cols="50" rows="10" form="data">
            <p>Hello, World!</p>
        </textarea>

        <p><input type="submit" value="Add post" form="data"></p>
    </form>
</body>
</html>