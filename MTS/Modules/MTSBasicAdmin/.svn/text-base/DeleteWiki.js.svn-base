
function deleteWiki() {
    
    if ( isAdmin == false ) {
        alert("You must be an administrator to access this function ");
        return;
    }
    

        if (confirm("Delete: Are you sure?  This will destroy all saved data!")) {
        
            singleMessage("Removing Wiki ... ");
            
            var ret = function (response) {
                if (response.deleted)
                    displayMessage("This wiki has been deleted.");    
                else
                    displayMessage("The file was NOT deleted successfully");
            }
            
            // SEND INFO //
            var getParams = {
                hey:true
            }
            var postParams = {
                "wrapperScriptName":wrapperScriptName,
                "sourcePath":       sourcePath
            }
            
            ajaxModuleEvent("DeleteWikiEvent",ret, getParams, postParams);
        }
    }