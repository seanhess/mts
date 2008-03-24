<?php
    class UserControl {
        
        private $users, $admins;
        public $isAdmin = false;
        public $isValid = false;
        public $isSet = false;
        
        public function __construct($lusers,$ladmins) {
            $this->users = $lusers;
            $this->admins = $ladmins;
        }
        
        public function setUser($luser, $lpass) {
            $this->isValid = $this->verify($luser, $lpass);
            $this->isAdmin = $this->verifyAdmin($luser, $lpass);
            $this->isSet = true;
        }
        
        public function verify($luser, $lpass) {
            return ( $luser != "" && $lpass != "" && ($this->users[$luser] == $lpass ));
        }
        
        public function verifyAdmin($luser, $lpass) {
            return ($this->userIsAdmin($luser) && $this->verify($luser,$lpass));
        }
        
        public function userExists($luser) {
            return ( isset($this->users[$luser]));
        }
        
        public function userIsAdmin($luser) {
            return ( isset($this->admins[$luser]));
        }
        
        public function getAllUsers() {
            return array_keys($this->users);
        }
    }
    



?>