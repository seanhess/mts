

  function addUser(form) {
      
      
        var user = form.user.value;
        var pass = form.pass.value;
        var pass2 = form.pass2.value;
        var goingToBeAdmin = form.admin.checked;
      
        if ( isAdmin == false ) {
            alert("You must be an administrator to access this function ");
            return;
        }
        
        if ( pass != pass2 ) {
            alert("The two passwords did not match");
            return;
        }

        
        singleMessage("Adding User: " + user);
        
        var ret = function (response) {
            displayMessage("User " + user + " added successfully");
        }
        
        var params = {
            username: user,
            password: pass,
            admin: goingToBeAdmin
        }
      
        ajaxModuleEvent("AddUserEvent",ret,params);
        
    }
    
