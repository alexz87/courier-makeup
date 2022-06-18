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

            if (isset($_POST['login'])) {
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

            if (isset($_POST['exit_btn'])) {
                $user->logOut();
                exit();
            }

            if (isset($_POST['user_id'])) {
                $user->deleteUser($_POST['user_id']);
            }

            if (isset($_POST['id'])) {
                $user->addPhoto($_POST['id']);
            }

            $users = $user->getUsers();
            $user_info = '';
            for ($i = 0; $i < count($users); $i++) {
                $num = $i;
                $user_info .= '<div class="user border d-flex justify-between align-center p-1 mb-1" id="' . $users[$i]['id'] . '">
                <b>' . ($num + 1) . ' </b>
                    <img id="user-photo" src="/public/img/' . $users[$i]['photo'] . '" alt="user photo">
                    <b>id: ' . $users[$i]['id'] . '</b>
                    <h2 class="warning text-center p-1">' . $users[$i]['login'] . '</h2>
                    <button onclick="deleteUser(' . $users[$i]['id'] . ')" class="p-1 b-radius-s btn-danger">X</button>
                </div>';
            }

            $data = [
                'lang' => 'ua',
                'title' => 'Кабінет', 
                'content' => 'Кабінет користувача',
                'user' => $user->getUser(),
                'users' => $users,
                'users_info' => $user_info,
                'count' => count($user->getUsers())
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
