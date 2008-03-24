
var oldSaveReturn = saveReturn;
saveReturn = function (response) {
    oldSaveReturn.apply(this,arguments);
    
    if ( !response.error && response.backup)
        displayMessage(config.messages.backupSaved,"MTS/Backups/" + sourceName + "/" + response.backup);
}
