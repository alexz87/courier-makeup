<?php

    //require 'public/php/ajax.php';

    class Home extends Controller {

        public function index() {
			
			$orders = $this->model('Orders');
            $info = '<div class="success"><b>Чайові: ' . $orders->getOrders()->tip . ' UAH</b></div>';

            if (isset($_POST['exit_btn'])) {
                $user = $this->model('UserModel');
                $user->logOut();
                exit();
            }

            if ($orders->getOrders()->day != date('d')) {
                $orders->newDay(date('d'), 0);
            }

            if (isset($_POST['myCash'])) {
                if ($orders->getOrders()->day != date('d')) {
    
                    $orders->newDay(date('d'), $_POST['myCash']);
                } else {
                    $this->day = date('d');
                    $myCash = $orders->getOrders()->myCash + $_POST['myCash'];
    
                    $orders->newDay(date('d'), $myCash);
                }
            }

            if (isset($_POST['spentTips'])) {
                $orders->addSpentTips(($orders->getOrders()->spentTips + $_POST['spentTips']));
            }

            if (isset($_POST['login'])) {
                $orders->setUser(
                    $_POST['login'],
                    $_POST['pass']
                );
            }

            if (isset($_POST['orders'])) {
                $orders->setOrders(
                    $_POST['orders'],
                    $_POST['newPost']
                );
            }

            if (isset($_POST['paydesk'])) {
                $orders->setTip($_POST['tip']);

                if ($_COOKIE['login'] == 'admin') {
                    $info = 
                        '<div><b>Сума:</b> ' . $_POST['cash'] . 
                        ' UAH</div><div><b>Каса</b> ' . $_POST['paydesk'] . 
                        ' UAH</div><div class="warning"><b>Мої гроші:</b> ' . $orders->getOrders()->myCash . 
                        ' UAH</div><div class="success"><b>Чайові:</b> ' . ($_POST['tip'] - $orders->getOrders()->myCash) . 
                        ' UAH</div>';
                } else {
                    $info = 
                        '<div><b>Сума:</b> ' . $_POST['cash'] . 
                        ' UAH</div><div><b>Каса</b> ' . $_POST['paydesk'] . 
                        ' UAH</div><div class="success"><b>Чайові:</b> ' . $_POST['tip'] . 
                        ' UAH</div>';
                }
            }

            // if ($orders->getOrders()->salary > 999) {
            //     $arr = explode('', $orders->getOrders()->salary);
            //     if (count($arr) > 4) {
            //         $salary = $arr[0] . $arr[1] . ' ' . $arr[2] . $arr[3] . $arr[4];
            //     } else {
            //         $salary = $arr[0] . ' ' . $arr[1] . $arr[2] . $arr[3];
            //     }
            // } else {
            //     $salary = $orders->getOrders()->salary;
            // }

            $pay = $orders->this->pay;
            $weekendPay = $orders->this->weekendPay;
            $order_s = $orders->getOrders()->orders;
            $newPost = $orders->getOrders()->newPost;
            $weekendOrders = $orders->getOrders()->weekendOrders;
            $weekendNewPost = $orders->getOrders()->weekendNewPost;
            $fullOrders = $orders->getOrders()->fullOrders;
            $salary = $orders->getOrders()->salary;
            $myCash = $orders->getOrders()->myCash;
            $spentTips = $orders->getOrders()->spentTips;
            $tip = $orders->getOrders()->tip;

            $data = [
                'lang' => 'ua',
                'title' => 'Courier MAKEUP', 
                'content' => 'Головна сторінка',
                'weekendPay' => $weekendPay,
                'pay' => $pay,
                'orders' => $order_s,
                'newPost' => $newPost,
                'weekendOrders' => $weekendOrders,
                'weekendNewPost' => $weekendNewPost,
				'fullOrders' => $fullOrders,
                'salary' => $salary,
                'info' => $info,
                'myCash' => $myCash,
                'spentTips' => $spentTips,
                'tip' => $tip
            ];

            $this->view('home/index', $data);
        }

        public function contact() {

            $data = [
                'lang' => 'ua',
                'title' => 'Courier MAKEUP', 
                'content' => 'Сторінка контактів'
            ];

            $this->view('home/contact', $data);
        }
    }