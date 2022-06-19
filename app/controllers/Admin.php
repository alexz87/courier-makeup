<?php

    class Admin extends Controller {
        
        public function index() {
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

            $this->view('admin/index', $data);
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

            $this->view('admin/orders', $data);
        }
    }