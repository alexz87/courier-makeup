<?php 

    class User extends Controller {
        
        public function reg() {
            if (isset($_POST['login'])) {
                $user = $this->model('UserModel');
                $user->setData(
                    $_POST['login'],
                    $_POST['pass'], 
                    $_POST['re_pass']
                );

                $isValid = $user->validForm();
                if ($isValid == "ok") {
                    $user->addUser(); 
                } else {
                    $data['message'] = $isValid;
                }
            }

            $data = [
                'lang' => 'ua',
                'title' => 'Реєстрація', 
                'content' => 'Реєстрація користувача',
                'user' => 'admin',
                'message' => $isValid
            ];
          
            $this->view('user/reg', $data);
        }
        
        public function dashboard() {
            $user = $this->model('UserModel');

            if (isset($_POST['exit_btn'])) {
                $user->logOut();
                exit();
            }

            if (isset($_POST['add_photo'])) {
                $user->addPhoto($user->getUser()['id']);
            }

            $data = [
                'lang' => 'ua',
                'title' => 'Кабінет', 
                'content' => 'Кабінет користувача',
                'user' => $user->getUser(),
                'users' => $user->getUsers()
            ];

            $this->view('user/dashboard', $data);
        }

        public function reports() {
            $reports = $this->model('Orders');

            $data = [
                'lang' => 'ua',
                'title' => 'Звіти', 
                'content' => 'Звіти користувача',
                'reports' => $reports->getOrders()
            ];

            $this->view('user/reports', $data);
        }

        public function orders() {
            $orders = $this->model('Orders');
            $json = $orders->getJSON(1);
            
            $data = [
                'lang' => 'ua',
                'title' => 'json',
                'content' => 'json',
                'json' => $json
            ];

            $this->view('user/orders', $data);
        }
        
        public function auth() {
            if (isset($_POST['login'])) {
                $user = $this->model('UserModel');
                $result = $user->auth(
                    $_POST['login'], 
                    $_POST['pass']
                );
            }

            $data = [
                'lang' => 'ua',
                'title' => 'Авторизація', 
                'content' => 'Авторизація користувача',
                'user' => 'admin',
                'message' => $result
            ];
          
            $this->view('user/auth', $data);
        }
    }
