var backupsmap = new Object();
 
function revertWiki(revertTo) {
    
    if ( isAdmin == false ) {
        alert("You must be an administrator to access this function ");
        return;
    }
    
    if (confirm("Revert: Are you sure?  This will overwrite your current wiki!") == false )
        return;

    if ( revertTo.indexOf(".html") < 0 ) {
        alert("Error, backup filename not valid: " + revertTo);
        return;
    }
    
    singleMessage("Reverting... You will be redirected");
    
    var ret = function (response) {
        if (response.reverted) 
            history.go();
            
        else
            displayMessage("Revert was unsuccessful. " + response.message);
    }
    
    var postParams ={
        "wrapperScriptName":wrapperScriptName,
        "sourcePath":       sourcePath
    }
       
    ajaxModuleEvent("RevertEvent",ret, {revertfile:revertTo}, postParams);
    
}


function addBackup(file, fullpath) {
    var row = document.createElement("tr");
    row.setAttribute("id",fullpath);
    
    var cell1 = document.createElement("td");
    cell1.innerHTML = "<a href='" + fullpath + "'>" + file + "</a>";
    
    var cell2 = document.createElement("td");
    cell2.innerHTML = "<input type='submit' value='Revert' onClick='revertWiki(\""+file+"\")'/>";
    
    var cell3 = document.createElement("td");
    cell3.innerHTML = "<input type='submit' value='[ X ]' onClick='deleteBackup(\""+fullpath+"\")'/>";
    
    row.appendChild(cell1);
    row.appendChild(cell2);
    row.appendChild(cell3);
    
    document.getElementById("mtsBackupsTable").appendChild(row);
}
