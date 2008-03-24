
    function manualBackup () {
        
        if ( isAdmin == false ) {
            alert("You must be an administrator to access this function ");
            return;
        }

        singleMessage("Creating Backup ... ");
        
        var ret = function (response) {
        
            if (response.backup) {
                var fullpath = "MTS/Backups/" + sourceName + "/" + response.backup;
                displayMessage("A manual backup has been created.",fullpath);

                addBackup(response.backup,fullpath);

            }
                    
            else
                displayMessage("The backup was not created succesfully");
            
        }
        
        
        ajaxModuleEvent("ManualBackupEvent",ret);
    }