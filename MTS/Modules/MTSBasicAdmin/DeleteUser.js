
    function deleteUser(username, tableRow) {
        
        var user = username;
        var tr = tableRow;
        
        if ( confirm ("Are you sure you want to delete " + user + "?") == false )
            return;
      
        if ( isAdmin == false ) {
            alert("You must be an administrator to access this function ");
            return;
        }
        
        singleMessage("Deleting User: " + user);
        
        var ret = function (response) {
            displayMessage("User " + user + " has been deleted");
            tr.parentNode.removeChild(tr);
        }
        
        var params = {
            username: user
        }
      
        ajaxModuleEvent("DeleteUserEvent",ret,params);
        
    }
    
