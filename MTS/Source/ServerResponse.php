<?php

    class ServerResponse 
    {
        private $data;
        private $arrays;
        private $objects;
        
        public function __construct() {
            $this->data = "var data = {";
            
            $this->arrays = array();
            $this->objects = array();
        }
                
        public function setValue($key, $value) {
            $this->data = $this->data . "$key:$value,";
        }
        
        public function setBoolean($key, $value) {
            if ($value) $value = "true";
            else        $value = "false";
        
            $this->setValue($key,$value);
        }
        
        public function setString($key, $value) {
            $this->setValue($key,"\"".$value."\"");
        }
        
        public function setArrayString($arrayName, $value) {
        
            if (!isset($this->arrays[$arrayName])) {
                $this->arrays[$arrayName] = array();
            }
                
            array_push($this->arrays[$arrayName],"\"".$value."\"");
        }
        
        public function setArrayBoolean($arrayName, $key, $value) {
            if (!isset($this->arrays[$arrayName]))
                $this->arrays[$arrayName] = array();
                
            if ($value) $value = "true";
            else        $value = "false";
                
            array_push($this->arrays[$arrayName],$value);
        
        }
        
        public function throwError($message) {
            $this->setBoolean("error",true);
            $this->setString("message",$message);
        }
        
        public function throwCriticalError($message) {
            $this->throwError($message);
            $this->send();
            exit();
        }
        
        // Flushes data and exits // 
        public function send() {
        
            foreach ($this->arrays as $name => $array) {
            
                $this->data.= "$name:[";
                $last = count($this->arrays[$name]);
                    for ($i = 0; $i < $last-1; $i++)
                        $this->data.=$this->arrays[$name][$i].",";
                $this->data.=$this->arrays[$name][$last-1]."],";
            }
        
            echo $this->data . "end:true};"; // AND THE endl thing?? // No, that was C++
            exit();
        }
    }

?>