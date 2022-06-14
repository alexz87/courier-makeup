<?php

    require_once 'mysql_connect.php';

    if (isset($_POST['salary'])) {
        $login = $_COOKIE['login'];
        $sql = "SELECT * FROM `courier_makeup` WHERE `login` = '$login'";
        $query = $pdo->prepare($sql);
        $query->execute();
        $orders = $query->fetch(PDO::FETCH_ASSOC);

        // if ($orders['salary'] > 999) {
        //     $arr = str_split($orders['salary']);
        //     if (count($arr) > 4) {
        //         $orders['salary'] = $arr[0] . $arr[1] . ' ' . $arr[2] . $arr[3] . $arr[4];
        //     } else {
        //         $orders['salary'] = $arr[0] . ' ' . $arr[1] . $arr[2] . $arr[3];
        //     }
        // }
        $orders['cash'] = base64_decode($orders['cash']);

        echo json_encode($orders);
    }