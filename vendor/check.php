<?php
    $login = filter_var(trim($_POST['login']));
    $pass = filter_var(trim($_POST['pass']));
    $email = filter_var(trim($_POST['email']));

    if (mb_strlen($login) < 3 || mb_strlen($login) > 30) {
        echo "Недопустимая длина логина";
        exit();
    }
    else if (mb_strlen($pass) < 8 || mb_strlen($pass) > 30) {
        echo "Недопустимая длина пароля (от 8 до 30 символов)";
        exit();
    }

    require('mysql.php');
    $mysql -> query("INSERT INTO `user` (`login`, `pass`, `email`)
    VALUES('$login', '$pass', '$email')");

    header('Location: ../auth.php');
?>