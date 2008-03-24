function deactivateMod (btn,path) {
    if ( isAdmin == false ) {
        alert("You must be an administrator to access this function ");
        return;
    }

    var localBtn = btn;
    var localPath = path;
    
    singleMessage("Deactivating the mod at " + path);
    
    var ret = function (response) {
        
        if (!response.error) {
            displayMessage("Module Deactivated");
                       
            localBtn.setAttribute("value","[ OFF ]");
            localBtn.setAttribute("onClick","activateMod(this,'"+localPath+"');");
            
        }
                
    }
    
    ajaxModuleEvent("ModuleActivationEvent",ret,{mode:"disable",folder:path});
    
        
}

function activateMod (btn, path) {
    
    if ( isAdmin == false ) {
        alert("You must be an administrator to access this function ");
        return;
    }
        
    var localBtn = btn;
    var localPath = path;
    
    singleMessage("Activating the mod at " + path);
    
    var ret = function (response) {
        
        if (!response.error) {
            displayMessage("Module Activated");
            
            localBtn.setAttribute("value","[ ON ]");
            localBtn.setAttribute("onClick","deactivateMod(this,'"+localPath+"');");
                
        }
    }
    
    ajaxModuleEvent("ModuleActivationEvent",ret,{mode:"enable",folder:path});
    
    
    
}


// Create a shadow Tiddler // 
config.shadowTiddlers.MTSModulesPanel = "<<mtsmodulemanager>>";

// Create a handle for the backstage //

if ( config.backstageTasks ) {

    config.backstageTasks.push("MTSModules");
    config.tasks.MTSModules = {
        text: "MTS Modules", 
        tooltip: "MTS Controls and Admin Panel", 
        content: ""
    }

    var modsOldLoggedIn = adminLoggedIn;
    adminLoggedIn = function () {
        modsOldLoggedIn.apply(this,arguments);
        
        config.tasks.MTSModules.content = config.shadowTiddlers.MTSModulesPanel;
        
    }

    var modsOldLoggedOut = adminLoggedOut;
    adminLoggedOut = function () {
        modsOldLoggedOut.apply(this,arguments);
        config.tasks.MTSModules.content = "Please log in as an admin before accessing this panel";
        
    }
    
    if (isAdmin)
        adminLoggedIn();
    else
        adminLoggedOut();

}