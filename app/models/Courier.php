<?php

    require 'DB.php';

    class Courier {
        
        private $_db = null;
        
        public function __construct() {
            $this->_db = DB::getInstance();
        }

        public function getOneUser($id) {
            $result = $this->_db->query("SELECT * FROM `courier_makeup` WHERE `id` = '$id'");

            return $result->fetch(PDO::FETCH_ASSOC);
        }
    }
