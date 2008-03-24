
getTime = function () {
    return origtime;
}


// RUN THE EVENT RIGHT NOW // 

function initConflictAccess() {
    
    var ret = function (response) {
        if (response.conflictfile) {
            
            //~ if (response.conflictfileexists)
                //~ displayMessage("Using existing conflict access file", response.conflictfile);
            
            //~ else
                //~ displayMessage("Created new conflict access file",response.conflictfile);
            
        }
    }
    
    ajaxModuleEvent("ConflictsInitEvent", ret);
    
}

initConflictAccess();


// ADD CLEANUP COMMAND TO ADMIN PANEL // 
function cleanupConflicts() {
    
    singleMessage("Destroying all conflict access files");
    
    var ret = function (response) {
        if (response.cleanup)
            displayMessage("All conflict access files were destroyed","MTS/Modules/MTSConflictDetection/access/");
    }
    
    ajaxModuleEvent("ConflictCleanupEvent", ret);
}

config.shadowTiddlers.MTSAdminPanel += "\n|<<mtsconflictcleanup>>||";

   if (isAdmin)
        adminLoggedIn();
    else
        adminLoggedOut();
    

var oldConflictSaveReturn = saveReturn;
saveReturn = function (response) {
    
    
    if ( !response.error && response.conflict) {
        store.uploadError = false;
 
        var conflictfile = "MTS/Backups/" + response.conflictfile;

        displayMessage("Conflict! Please refresh and merge your changes into this copy.",conflictfile);
        store.setDirty(true);
        
        for (var i in response.tiddlers) {
            if (typeof(response.tiddlers[i]) == "string")
                displayMessage(" >> " + response.tiddlers[i],conflictfile+"#"+response.tiddlers[i]);
        }
    }
    else {
        oldConflictSaveReturn.apply(this,arguments);
    
        if ( response.conflictaccess ) 
            displayMessage("All conflict access files were updated","MTS/Modules/"+response.conflictaccess +"/access/");
        
        if ( response.conflictmodtime ) {
            origtime = response.conflictmodtime;
            displayMessage("Current modtime updated");
        }
        
        else
            displayMessage("New modtime lost! Please refresh.");
    }

}
