<?php
    require('vendor/mysql.php');
    $result = $mysql -> query("SELECT * FROM `community`");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/news.css">
    <link rel="stylesheet" href="assets/css/community.css">
    <title>Сообщества</title>
</head>
<body>
    <?php require('vendor/header.php'); ?>
    <div class="comm_block">
            <?php
                while ($community = mysqli_fetch_array($result)) {
                    echo "<div class='block__community'>";
                        echo "<img src='{$community['photo']}'>";
                        echo '<div class="info_comm">';
                        echo "<h1>{$community['name']}</h1>";
                        echo "<p>{$community['sub']} подписчиков</p>";
                        echo '</div>';
                    echo "</div>";
                }
            ?>
    </div>
</body>
</html>