<?php

    require 'DB.php';

    class UserModel {
        
        private $login;
        private $pass;
        private $re_pass;

        private $_db = null;
        
        public function __construct() {
            $this->_db = DB::getInstance();
        }
        
        public function setData($login, $pass, $re_pass) {
            $this->login = $login;
            $this->pass = $pass;
            $this->re_pass = $re_pass;
        }
        
        public function validForm() {
            $checkUser = $this->checkUser($this->login);

            if ($checkUser['login'] != '') {
                return "Такий login вже зареєстрований";
            } else if (strlen($this->pass) < 8) {
                return "Пароль не може бути меньше 8 символів";
            } else if ($this->pass != $this->re_pass) {
                return "Паролі не співпадають";
            } else {
                return "ok";
            }
        }

        public function addPhoto($id) {
            // $id = $this->getID($login)['id'];
            $photo = 'IMG_' . $id . '.jpg';
            $sql = "UPDATE `courier_makeup` SET 
                `photo` = :photo
            WHERE `id` = '$id'";
            $query = $this->_db->prepare($sql);
            $query->execute([
                'photo' => $photo
            ]);
        }

        public function checkUser($login) {
            $result = $this->_db->query("SELECT * FROM `courier_makeup` WHERE `login` = '$login'");

            return $result->fetch(PDO::FETCH_ASSOC);
        }
        
        public function addUser() {
            $photo = 'IMG_none.jpg';
            $cash = '';
            $tip = 0;
            $spentTips = 0;
            $salary = 0;
            $date = date('d.m.Y');
            $mounth = date('m');
            $day = date('d');
            $tariff = '22.95';
            $fullOrders = 0;
            $allOrders = 0;
            $allWeekendOrders = 0;
            $orders = 0;
            $newPost = 0;
            $weekendOrders = 0;
            $weekendNewPost = 0;
            $reports = '';
            $sql = 'INSERT INTO courier_makeup(
                    login, pass, photo, cash, tip, spentTips,
                    salary, date, mounth, day, tariff, fullOrders,
                    allOrders, allWeekendOrders, orders,
                    newPost, weekendOrders, weekendNewPost,
                    reports
                ) VALUES(
                    :login, :pass, :photo, :cash, :tip, :spentTips,
                    :salary, :date, :mounth, :day, :tariff, :fullOrders,
                    :allOrders, :allWeekendOrders, :orders,
                    :newPost, :weekendOrders, :weekendNewPost,
                    :reports
                )';
            $query = $this->_db->prepare($sql);
            $pass = password_hash($this->pass, PASSWORD_DEFAULT);
            $query->execute([
                'login' => $this->login,
                'pass' => $pass,
                'photo' => $photo,
                'cash' => $cash,
                'tip' => $tip,
                'spentTips' => $spentTips,
                'salary' => $salary,
                'date' => $date,
                'mounth' => $mounth,
                'day' => $day,
                'tariff' => $tariff,
                'fullOrders' => $fullOrders,
                'allOrders' => $allOrders,
                'allWeekendOrders' => $allWeekendOrders,
                'orders' => $orders,
                'newPost' => $newPost,
                'weekendOrders' => $weekendOrders,
                'weekendNewPost' => $weekendNewPost,
                'reports' => $reports
            ]);

            if ($_COOKIE['login'] == '') {
                $this->setAuth($this->login);
            }
        }

        public function deleteUser($id) {
            unlink('public/img/IMG_' . $id . '.jpg');
            $this->_db->query("DELETE FROM `courier_makeup` WHERE `id` = '$id'");
        }
        
        public function getUser() {
            $login = $_COOKIE['login'];
            $result = $this->_db->query("SELECT * FROM `courier_makeup` WHERE `login` = '$login'");

            return $result->fetch(PDO::FETCH_ASSOC);
        }

        public function getID($id) {
            $result = $this->_db->query("SELECT * FROM `courier_makeup` WHERE `id` = '$id'");

            return $result->fetch(PDO::FETCH_ASSOC);
        }

        public function getUsers() {
            $result = $this->_db->query("SELECT * FROM `courier_makeup`");

            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function logOut() {
            setcookie('login', $this->login, time() - 3600 * 24 * 30, '/');
            unset($_COOKIE['login']);
            header('Location: /');
        }
        
        public function auth($login, $pass) {
            $result = $this->_db->query("SELECT * FROM `courier_makeup` WHERE `login` = '$login'");
            $user = $result->fetch(PDO::FETCH_ASSOC);

            if ($user['login'] == '') {
                return 'Такий login не зареєстровано';
            } else if (password_verify($pass, $user['pass'])) {
                $this->setAuth($login);
            } else {
                return 'Не вірний пароль';
            }
        }
        
        public function setAuth($login) {
            setcookie('login', $login, time() + 3600 * 24 * 30, '/'); // + 3600(1 година) * 24(1 день) * 30(1 місяць) * 12(1 рік)
            header('Location: /');
        }
    }
