<?php

    require_once 'mysql_connect.php';

    if (isset($_POST['salary'])) {
        $login = $_COOKIE['login'];
        $sql = "SELECT * FROM `courier_makeup` WHERE `login` = '$login'";
        $query = $pdo->prepare($sql);
        $query->execute();
        $orders = $query->fetch(PDO::FETCH_ASSOC);

        $orders['cash'] = base64_decode($orders['cash']);

        echo json_encode($orders);
    }