<?php session_start();

    class SessionManager {
    
        public $user;
        public $pass;
        
        public function __construct() {
            $this->user =  $_SESSION['mts_saved_username'];
            $this->pass = $_SESSION['mts_saved_password'];

        }
    
    }

?>