<?php

    if ( $userControl->isAdmin != true ) {
        $serverResponse->throwCriticalError("You must be logged in as the admin to access this function");
    }
    
    createBackup($clientRequest->sourceFile, date('dMy_Gi')."_manual.html");
    
    function createBackup($source,$backupName="noname.html") {
        global $clientRequest, $serverInfo, $serverResponse;
        
        $sourceName = $clientRequest->sourceName;
        $backupDir = $serverInfo->BackupDirectory;
        
        $myBackupDir = $backupDir.$sourceName ."/";
        $backupPath = $myBackupDir.$backupName;
        
        if (is_dir($backupDir) === FALSE) {
            if( mkdir($backupDir, 0755) === false )
                $serverResponse->throwCriticalError("Could not create directory ($backupDir)");
        }
        
        if (is_dir($myBackupDir) === FALSE) {
            if( mkdir($myBackupDir, 0755) === false )
                $serverResponse->throwCriticalError("Could not create directory ($myBackupDir)");
        }
        
        if ( copy($source, $backupPath))
            $serverResponse->setString("backup",$backupName);
        else
            $serverResponse->throwCriticalError("Copy failed on backup : ($myBackupDir) ($source) ($backupName)");
            

    }

?>