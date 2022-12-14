<?php
    session_start();
    require('vendor/mysql.php');

    if ($_GET['tab']) {
        $result = $mysql -> query("SELECT * FROM `community` WHERE `admin` = {$_SESSION['user']['id']}");
    } else {
        $result = $mysql -> query("SELECT * FROM `community`");
    }
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

        <!-- Вывод сообществ -->
        <div class="show-com">
            <a href="community.php">Все сообщества</a>
            <a href="community.php?tab=admin">Управление</a>
            <button class="bt-createCom" onclick="openForm()">Создать сообщество</button>
        </div>

        <!-- Форма создании сообщества -->
        <div id="createCom" class="createCom">
            <form action="vendor/create-com.php" method="post" enctype="multipart/form-data">
                <label>Название:</label>
                <input type="text" name="name_com" required>
                <br><br>
                <label>Аватарка:</label>
                <input type="file" name="avatar">
                <br><br>
                <input type="submit" value="Создать">
                <input type="button" value="Отмена" onclick="closeForm()">
              </form>
        </div>

            <?php
                if ($_SESSION['user']['login']) {
                    $colCom = 0;
                    while ($community = mysqli_fetch_array($result)) {
                        $resultSub = $mysql -> query("SELECT COUNT(1) FROM `com_sub` WHERE `com_id` = {$community['id']}");
                        $colSub = mysqli_fetch_array($resultSub);
                        $resultColor = $mysql -> query("SELECT * FROM `com_sub` WHERE `com_id` = {$community['id']} AND `user_id` = {$_SESSION['user']['id']}");
                        $colorSub = mysqli_fetch_array($resultColor);
                        $resultText = $mysql -> query("SELECT * FROM `com_sub` WHERE `com_id` = {$community['id']}");
                        $textSub = mysqli_fetch_array($resultText);
                        $linkId = "group.php?id=" . "{$community['id']}"; 
                        echo "<div class='block__community'>";
                            echo "<a href='{$linkId}'>";
                            echo "<img src='{$community['photo']}'>";
                            echo '<div class="info_comm">';
                            echo "<h1>{$community['name']}</h1>";
                            echo "</a>";
                            echo "<p id='colSub{$colCom}' data-idcom='{$community['id']}'>{$colSub['COUNT(1)']} {$textSub['text']}</p>";
                            echo "<button id='buttonSub{$colCom}' class='sub-off {$colorSub['color']}' onclick=upSub({$colCom})></button>";
                            echo '</div>';
                        echo "</div>";
                        $colCom++;
                    }
                } else {
                    header("Location: auth.php");
                }
            ?>
    </div>

    <script src="components/community.js"></script>
    <script src="components/ajax.js"></script>
</body>
</html>