<?php

    if (isset($_POST['salary'])) {
        $user = 'root';
        $password = 'root';
        $db = 'Nasty';
        $host = 'localhost';

        $dsn = 'mysql:host='.$host.';dbname='.$db;
        $pdo = new PDO($dsn, $user, $password);

        $login = $_COOKIE['login'];
        $sql = "SELECT * FROM `courier_makeup` WHERE `login` = '$login'";
        $query = $pdo->prepare($sql);
        $query->execute();
        $orders = $query->fetch(PDO::FETCH_ASSOC);

        echo json_encode($orders);
    }
