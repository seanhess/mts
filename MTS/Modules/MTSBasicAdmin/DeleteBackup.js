

// HELLO // 
function deleteBackup(path) {

    var lpath = path;
    
    if ( isAdmin == false ) {
        alert("You must be an administrator to access this function ");
        return;
    }
    
    if ( path.indexOf(".htm") < 0 ) {
        alert("Error, backup filename not valid: " + lpath);
        return;
    }
    
    singleMessage("Deleting Backup..");
    
    var ret = function (response) {
        displayMessage(lpath + " successfully deleted");
        var row = document.getElementById(lpath);
        row.parentNode.removeChild(row);
    }
    
    ajaxModuleEvent("DeleteBackupEvent",ret, {backupToDelete:path});
    
}
