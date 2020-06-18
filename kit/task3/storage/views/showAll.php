<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>
<body>
<?php foreach ($data as $post) : ?>
    <div class="container">
        <p>
            Author: <?php echo $post['author']; ?>
        </p>
        <p>
            <?php echo $post['text']; ?>
        </p>
    </div>
    <hr>
<?php endforeach; ?>
</body>
</html>
