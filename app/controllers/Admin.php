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
                $user_info .= '<div class="user border p-1 mb-1" id="' . $users[$i]['id'] . '">
                    <a href="/admin/courier/' . $users[$i]['id'] . '" class="d-flex justify-between align-center">
                        <b>' . ($num + 1) . ' </b>
                        <img id="user-photo" src="/public/img/' . $users[$i]['photo'] . '" alt="user photo">
                        <p>id: <b class="success">' . $users[$i]['id'] . '</b></p>
                        <p>date: <b class="danger">' . $users[$i]['day'] . '.' . $users[$i]['mounth'] . '</b></p>
                        <button onclick="deleteUser(' . $users[$i]['id'] . ')" class="p-1 b-radius-s btn-danger">X</button>
                    </a>
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

        public function courier($id) {
            $user = $this->model('Courier');

            $courier = $user->getOneUser($id);
            $html = '<div class="border p-2 mt-2 mb-2 d-flex col align-center">
                        <div class="width-s">
                            <img class="border" src="/public/img/' . $courier['photo'] . '" alt="courier">
                        </div>
                        <h3 class="warning">Дата: ' . $courier['date'] . ' р.</h3>
                        <h2 class="success">Login: ' . $courier['login'] . '</h2>
                        <h3>Заробітна плата: ' . $courier['salary'] . ' UAH</h3>
                        <h3>Замовлення: ' . $courier['fullOrders'] . ' шт.</h3>
                        <p class="danger">Останній вхід: ' . $courier['day'] . '.' . $courier['mounth'] . '</p>
                        <div class="border p-1 mt-1 mb-1">' . base64_decode($courier['cash']) . '</div>
                    </div>';

            $data = [
                'lang' => 'ua',
                'title' => 'Courier', 
                'content' => 'Courier',
                'courier' => $html
            ];

            $this->view('admin/courier', $data);
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