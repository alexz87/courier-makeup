<?php 

	require 'DB.php';

	class Orders {
		private $pay = 23.50;
		private $weekendPay = 23.50;
		private $cash;
		private $tip;
		private $salary;
		private $date;
		private $mounth;
		private $mounthDec;
		private $day;
		private $tariff;
		private $fullOrders;
		private $allOrders;
		private $allWeekendOrders;
		private $orders;
		private $newPost;
		private $weekendOrders;
		private $weekendNewPost;
		private $reports;


		private $_db = null;
        
        public function __construct() {
            $this->_db = DB::getInstance();
        }

		public function mounthFunc() {
			if (date('m') == '01') {
				$this->mounthDec = 'Грудень ';
			} else if (date('m') == '02') {
				$this->mounthDec = 'Січень ';
			} else if (date('m') == '03') {
				$this->mounthDec = 'Лютий ';
			} else if (date('m') == '04') {
				$this->mounthDec = 'Березень ';
			} else if (date('m') == '05') {
				$this->mounthDec = 'Квітень ';
			} else if (date('m') == '06') {
				$this->mounthDec = 'Травень ';
			} else if (date('m') == '07') {
				$this->mounthDec = 'Червень ';
			} else if (date('m') == '08') {
				$this->mounthDec = 'Липень ';
			} else if (date('m') == '09') {
				$this->mounthDec = 'Серпень ';
			} else if (date('m') == '10') {
				$this->mounthDec = 'Вересень ';
			} else if (date('m') == '11') {
				$this->mounthDec = 'Жовтень ';
			} else if (date('m') == '12') {
				$this->mounthDec = 'Листопад ';
			}

			return $this->mounthDec;
		}

		public function setOrders($orders, $newPost) {
			$getOrders = $this->getOrders();
			$bgColor = '';
			$this->date = date('d.m.Y');
			$this->mounth = date('m');



			if ($getOrders->mounth != $this->mounth) {
				if ($getOrders->salary < 15000) {
					$bgColor = 'bg-danger';
				} else if ($getOrders->salary < 20000) {
					$bgColor = 'bg-warning';
				} else {
					$bgColor = 'bg-success';
				}
				$aaa = 'PGRpdiBjbGFzcz0icmVwb3J0IGJnLXdhcm5pbmciPgoJCQkJCQkJCTxoMj7QotGA0LDQstC10L3RjCAyMDIyINGA0L7QutGDPC9oMj4KCQkJCQkJCQk8aDM+0JfQsNCz0LDQu9GM0L3QviDQt9Cw0LzQvtCy0LvQtdC90Yw6IDg0NCDRiNGCLjwvaDM+CgkJCQkJCQkJPGI+0JHRg9C00LXQvdC90ZYg0LfQsNC80L7QstC70LXQvdC90Y86PC9iPiA4MjEg0YjRgi48YnI+CgkJCQkJCQkJPGI+0J3QvtCy0LAg0J/QvtGI0YLQsDo8L2I+IDIzINGI0YIuPGJyPgoJCQkJCQkJCTxiPtCS0LjRhdGW0LTQvdGWINC30LDQvNC+0LLQu9C10L3QvdGPOjwvYj4gMCDRiNGCLjxicj4KCQkJCQkJCQk8Yj7QndC+0LLQsCDQn9C+0YjRgtCwINGDINCy0LjRhdGW0LTQvdGWOjwvYj4gMCDRiNGCLjxicj4KCQkJCQkJCQk8aDM+0JfQsNGA0L7QsdGW0YLQvdCwINC/0LvQsNGC0LA6IDE5MzcwIFVBSDwvaDM+CgkJCQkJCQk8L2Rpdj4=';
				$report = '<div class="report ' . $bgColor . '">
								<h2>' . $this->mounthFunc() . date('Y') . ' року</h2>
								<h3>Загально замовлень: ' . $getOrders->fullOrders . ' шт.</h3>
								<b>Буденні замовлення:</b> ' . $getOrders->orders . ' шт.<br>
								<b>Нова Пошта:</b> ' . $getOrders->newPost . ' шт.<br>
								<b>Вихідні замовлення:</b> ' . $getOrders->weekendOrders . ' шт.<br>
								<b>Нова Пошта у вихідні:</b> ' . $getOrders->weekendNewPost . ' шт.<br>
								<h3>Заробітна плата: ' . $getOrders->salary . ' UAH</h3>
							</div>';
				$this->reports = base64_decode($getOrders->reports) . $report;

				$this->addReports();

				if (date('N') == 6 || date('N') == 7) {
					$this->weekendOrders = $orders;
					$this->weekendNewPost = $newPost;
					$this->allWeekendOrders = $this->weekendOrders + $this->weekendNewPost;
					$this->salary = ($this->allWeekendOrders * $this->weekendPay) + ($getOrders->allOrders * $this->pay);
					$this->fullOrders = $getOrders->allOrders + $this->allWeekendOrders;
	
					$this->addWeekendOrders();
				} else {
					$this->orders = $orders;
					$this->newPost = $newPost;
					$this->allOrders = $this->orders + $this->newPost;
					$this->salary = ($this->allOrders * $this->pay) + ($getOrders->allWeekendOrders * $this->weekendPay);
					$this->fullOrders = $this->allOrders + $getOrders->allWeekendOrders;
	
					$this->addOrders();
				}
			} else {
				if (date('N') == 6 || date('N') == 7) {
					$this->weekendOrders = $getOrders->weekendOrders + $orders;
					$this->weekendNewPost = $getOrders->weekendNewPost + $newPost;
					$this->allWeekendOrders = $this->weekendOrders + $this->weekendNewPost;
					$this->salary = ($this->allWeekendOrders * $this->weekendPay) + ($getOrders->allOrders * $this->pay);
					$this->fullOrders = $getOrders->allOrders + $this->allWeekendOrders;
	
					$this->addWeekendOrders();
				} else {
					$this->orders = $getOrders->orders + $orders;
					$this->newPost = $getOrders->newPost + $newPost;
					$this->allOrders = $this->orders + $this->newPost;
					$this->salary = ($this->allOrders * $this->pay) + ($getOrders->allWeekendOrders * $this->weekendPay);
					$this->fullOrders = $this->allOrders + $getOrders->allWeekendOrders;
	
					$this->addOrders();
				}
			}
		}

		public function setTip($tip) {
			$getTip = $this->getTip();

			$this->tip = $getTip->tip + $tip;

			$this->addTip();
		}

		public function setCashTip($its_cash, $tip, $paydesk) {
			$getTip = $this->getTip();

			$this->cash = 
					'<div><b>Сума:</b> ' . $its_cash . ' UAH</div>
					<div><b>Каса</b> ' . $paydesk . ' UAH</div>
					<div class="success"><b>Чайові:</b> ' . $tip . ' UAH</div>';
			$this->tip = $getTip->tip + $tip;

			$this->addCashTip();
		}

		public function newDay($day) {
			$id = $this->getUser()['id'];

			$sql = "UPDATE `courier_makeup` SET `day` = :day WHERE `id` = '$id'";
            $query = $this->_db->prepare($sql);
            $query->execute(['day' => $day]);
		}
		
		public function newMounth($mounth) {
			$id = $this->getUser()['id'];

			$sql = "UPDATE `courier_makeup` SET `mounth` = :mounth WHERE `id` = '$id'";
            $query = $this->_db->prepare($sql);
            $query->execute(['mounth' => $mounth]);
		}

		public function addOrders() {
			$id = $this->getUser()['id'];

			$sql = "UPDATE `courier_makeup` SET
					`salary` = :salary, `date` = :date,
					`mounth` = :mounth, `fullOrders` = :fullOrders,
					`allOrders` = :allOrders, `orders` = :orders,
					`newPost` = :newPost 
				WHERE `id` = '$id'";
            $query = $this->_db->prepare($sql);
            $query->execute([
                'salary' => round($this->salary), 
                'date' => $this->date,
                'mounth' => $this->mounth,
				'fullOrders' => $this->fullOrders,
                'allOrders' => $this->allOrders,
                'orders' => $this->orders,
				'newPost' => $this->newPost
            ]);
		}

		public function addWeekendOrders() {
			$id = $this->getUser()['id'];

			$sql = "UPDATE `courier_makeup` SET
					`salary` = :salary, `date` = :date,
					`mounth` = :mounth, `fullOrders` = :fullOrders,
					`allWeekendOrders` = :allWeekendOrders, `weekendOrders` = :weekendOrders,
					`weekendNewPost` = :weekendNewPost 
				WHERE `id` = '$id'";
            $query = $this->_db->prepare($sql);
            $query->execute([
                'salary' => round($this->salary), 
                'date' => $this->date,
                'mounth' => $this->mounth,
				'fullOrders' => $this->fullOrders,
                'allWeekendOrders' => $this->allWeekendOrders,
				'weekendOrders' => $this->weekendOrders,
				'weekendNewPost' => $this->weekendNewPost
            ]);
		}

		public function addReports() {
			$id = $this->getUser()['id'];

			$sql = "UPDATE `courier_makeup` SET `reports` = :reports WHERE `id` = '$id'";
            $query = $this->_db->prepare($sql);
            $query->execute(['reports' => base64_encode($this->reports)]);
		}

		public function addTip() {
			$id = $this->getUser()['id'];

			$sql = "UPDATE `courier_makeup` SET `tip` = :tip WHERE `id` = '$id'";
			$query = $this->_db->prepare($sql);
			$query->execute(['tip' => $this->tip]);
		}

		public function addCashTip() {
			$id = $this->getUser()['id'];

			$sql = "UPDATE `courier_makeup` SET `cash` = :cash, `tip` = :tip WHERE `id` = '$id'";
			$query = $this->_db->prepare($sql);
			$query->execute(['cash' => base64_encode($this->cash), 'tip' => $this->tip]);
		}

		public function addSpentTips($spentTips) {
			$id = $this->getUser()['id'];

			$sql = "UPDATE `courier_makeup` SET `spentTips` = :spentTips WHERE `id` = '$id'";
			$query = $this->_db->prepare($sql);
			$query->execute(['spentTips' => $spentTips]);
		}
		
		public function getOrders() {
			$id = $this->getUser()['id'];

			$result = $this->_db->query("SELECT * FROM `courier_makeup` WHERE `id` = '$id'");

            return $result->fetch(PDO::FETCH_OBJ);
		}

		public function getTip() {
			$id = $this->getUser()['id'];

            $result = $this->_db->query("SELECT * FROM `courier_makeup` WHERE `id` = '$id'");

            return $result->fetch(PDO::FETCH_OBJ);
        }

		public function getUser() {
            $login = $_COOKIE['login'];
            $result = $this->_db->query("SELECT * FROM `courier_makeup` WHERE `login` = '$login'");

            return $result->fetch(PDO::FETCH_ASSOC);
        }

		public function getJSON($id) {
			$result = $this->_db->query("SELECT * FROM `courier_makeup` WHERE `id` = '$id'");
			
			return $json = json_encode($result->fetch(PDO::FETCH_ASSOC));
		}
	}