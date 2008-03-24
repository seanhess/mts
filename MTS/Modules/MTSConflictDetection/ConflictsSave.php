<?php

    // FIRST // Check to see if we have a possible conflict here // 
    $localtime = $clientRequest->time;
    $servertime = filemtime($clientRequest->sourceFile);
    $isConflict = false;
    $newchangesarr = array();

    $moddir = $serverInfo->ModulesDirectory.$module->name;
    $accessdir = $moddir."/access/";
    $accessfile = $accessdir.$localtime.".txt";

    $fullaccessfile = $accessfile;
    
    
    $newchangesarr = array_merge($clientRequest->deletedIndex, $clientRequest->updatesIndex);

    if ($servertime > $localtime ) {
        // POSSIBLE CONFLICT // 
        
        // READ FILE //
        if (file_exists($fullaccessfile) ) {
            $oldchangesstr = file_get_contents($fullaccessfile);
            
            // SCAN FILE FOR ANY OF MY CHANGES, OR SCAN CHANGES FOR ANY IN MY FILE?? // 
            foreach ($newchangesarr as $tiddler) {
                if ( $tiddler != "") {
                    if (preg_match("/$tiddler/si", $oldchangesstr)) {
                        $isConflict = true;
                        // NEED TO MERGE ALL TIDDLERS, since we're doing a full redirect // 
                        //~ $serverResponse->setArrayString("tiddlers",$tiddler);
                    }
                }
            }
        }
        else 
            $serverResponse->throwError("The access file was not found: $fullaccessfile");
        
    }
    
    
    if ($isConflict ) {
        // REDIRECT CHANGES // 
        $file = $clientRequest->sourceName."/conflict_".$sessionManager->user."_".$localtime.".html";
        $redirectedFile = $serverInfo->BackupDirectory.$file;
        
            $savingMachine->saveFile = $redirectedFile;
            $moduleManager->killEvent(); // don't allow low-priority MainSaveEvent scripts to run. 
    
        // SEND MESSAGE // 
            $serverResponse->setBoolean("conflict",true);
            $serverResponse->setString("conflictfile",$file);
            
             foreach ($newchangesarr as $tiddler) {
                if ( $tiddler != "") {
                    $serverResponse->setArrayString("tiddlers",$tiddler);
                }
            }

    }
    else {
    
        // ON A GOOD SAVE, WRITE THE TIDDLERS TO ALL ACCESS FILES // 
        $tiddlers = join(" ",$newchangesarr);
        
        if (is_dir($accessdir) ) {
            $files = scandir($accessdir);
            foreach ($files as $file)
                if (strpos($file, ".txt") != false)
                   writeToFile($accessdir.$file,$tiddlers);
            
            $serverResponse->setString("conflictaccess",$module->name);
        }    
        else
            $serverResponse->throwError("The access directory was not found: $accessdir");
            
        
    }    
    
    

?>