<?php

    class Home extends Controller {

        public function index() {
			
			$orders = $this->model('Orders');
            
            
            if (isset($_POST['exit_btn'])) {
                $user = $this->model('UserModel');
                $user->logOut();
                exit();
            }

            if ($orders->getOrders()->day != date('d')) {
                $orders->newDay(date('d'));
                $orders->setCashTip(0, 0, 0);
            }

            if (isset($_POST['myCash'])) {
                $orders->setTip('-' . $_POST['myCash']);
            }

            if (isset($_POST['spentTips'])) {
                $orders->addSpentTips(($orders->getOrders()->spentTips + $_POST['spentTips']));
                $orders->setTip('-' . $_POST['spentTips']);
            }

            if (isset($_POST['login'])) {
                $orders->setUser(
                    $_POST['login'],
                    $_POST['pass']
                );
            }

            if (isset($_POST['orders']) || isset($_POST['newPost'])) {
                $orders->setOrders(
                    $_POST['orders'],
                    $_POST['newPost']
                );
            }

            if (isset($_POST['addTip'])) {
                $orders->setTip($_POST['addTip']);
            }

            if (isset($_POST['paydesk'])) {
                $orders->setCashTip($_POST['cash'], $_POST['tip'], $_POST['paydesk']);
            }

            $info = $orders->getOrders()->cash;
            $pay = $orders->this->pay;
            $weekendPay = $orders->this->weekendPay;
            $order_s = $orders->getOrders()->orders;
            $newPost = $orders->getOrders()->newPost;
            $weekendOrders = $orders->getOrders()->weekendOrders;
            $weekendNewPost = $orders->getOrders()->weekendNewPost;
            $fullOrders = $orders->getOrders()->fullOrders;
            $salary = $orders->getOrders()->salary;
            $spentTips = $orders->getOrders()->spentTips;
            $tip = $orders->getOrders()->tip;
            $attr = '';
            $class = '';
            $btndis = '';
            if (date('N') == 6 || date('N') == 7) {
                $attr = ' disabled';
                $class = ' disabled';
                $btndis = ' btn-dis';
            }

            
            // if ($orders->getOrders()->salary > 999) {
            //     $arr = str_split($orders->getOrders()->salary);
            //     if (count($arr) > 4) {
            //         $salary = $arr[0] . $arr[1] . ' ' . $arr[2] . $arr[3] . $arr[4];
            //     } else {
            //         $salary = $arr[0] . ' ' . $arr[1] . $arr[2] . $arr[3];
            //     }
            // } else {
            //     $salary = $orders->getOrders()->salary;
            // }


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
                'spentTips' => $spentTips,
                'tip' => $tip,
                'attr' => $attr,
                'class' => $class,
                'btn-dis' => $btndis
            ];

            $this->view('home/index', $data);
        }

        public function contact() {

            if (isset($_POST['name'])) {
                $telegram = $this->model('Telegram');
                $res = $telegram->setTelegram($_POST['name'], $_POST['tel'], $_POST['mess']);
            }

            $data = [
                'lang' => 'ua',
                'title' => 'Courier MAKEUP', 
                'content' => 'Сторінка контактів'
            ];

            $this->view('home/contact', $data);
        }
    }