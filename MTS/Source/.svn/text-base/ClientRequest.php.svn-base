<?php
    
    class ClientRequest
    {
        public $action, $user, $pass;
        public $wrapperFile, $wrapperName;
        public $sourceFile, $sourceName;
        public $rssFile;
        
        public $doBackup = false;
        public $time;
        
        private $cache;
        
        public function __construct() {
            global $serverInfo;
        
            $this->action = $_GET['action'];
            $this->user = $_GET['get_user']; 
            $this->pass = $_GET['get_pass'];
            
            $this->wrapperName = $_POST['wrapperScriptName'];
            $this->wrapperFile = $serverInfo->BaseInstallOffset.$this->wrapperName.$serverInfo->WrapperExt;
            $this->sourceFile = $serverInfo->BaseInstallOffset.$_POST['sourcePath'];
            $this->sourceName = substr($_POST['sourcePath'], 0, strpos($_POST['sourcePath'], ".htm"));
            
            $this->doBackup = ($_GET['backup'] == "true");
            $this->time = $_POST['time'];
            
            $this->rssFile = $serverInfo->BaseInstallOffset.$this->wrapperName.".xml";
            
            $this->cache = array();
            
        }
        
        // ANYTHING ELSE SENT, NOT SPECIFIED IN THE ABOVE VARIABLES //
        public function get($valuename) {
            if (isset($_GET[$valuename])) {
            
                $this->cache[$valuename] = $_GET[$valuename];
                return $_GET[$valuename];
                
            }
            else 
                return false;
        }
        
        public function post($valuename) {
            if (isset($_POST[$valuename])) {
                $value = $this->decodePost($_POST[$valuename]);
                $this->cache[$valuename] = $value;
                return $value;
            }
            else 
                return false;
        }
        
        public function __get($valuename) {
            $cached = $this->getCache($valuename);
            
            if ($cached) return $cached;
            
            $get = $this->get($valuename);
            
            if ($get) return $get;
            
            $post = $this->post($valuename);
            
            if ($post) return $post;
            
            return false;
            
        }
        
        public function __set($valuename, $value) {
            $this->cache[$valuename] = $value;
        }
        
        private function getCache($valuename) {
            if ( $this->cache[$valuename])
                return $this->cache[$valuename];
            else
                return false;
        }
        
        public function decodePost($str) {
            $str = rawurldecode($str);
            
            if ( strpos($str, "\\\\n") > 0 || strpos($str, "\\\"") > 0) {
                $str = stripslashes($str);
            }
                
            $str = preg_replace ( '/\&\#43;/i','+',$str);
            return $str;
        }
    
    }

?>