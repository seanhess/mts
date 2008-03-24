<?php

    function writeToFile($file, $str) {
    
        global $serverResponse;
        
        if (!file_put_contents($file, $str))
            $serverResponse->throwError("Cannot open file ($file)");
            
        else
            $serverResponse->setBoolean("saved",true);
    }
    
    function findAndReplaceInside($source, $start, $end, $content, $last=false) {
    
        global $serverResponse;
        
        $startpos = strpos ( $source, $start );
        
        if ($last) {
            $endpos = strrpos( $source, $end ); 
        }
            
        else
            $endpos = strpos( $source, $end, $startpos); 
            
            
        if (!$startpos || !$endpos && $start == "<title")
            return $source;
            
        if (!$startpos || !$endpos ) {
            $serverResponse->throwError("There was a critical saving error looking for ($start) and ($end).");
            return $source;
        }
        
            $startpos += strlen($start);
            return substr($source, 0, $startpos) . $content . substr($source, $endpos);
            
    }
    
    

?>