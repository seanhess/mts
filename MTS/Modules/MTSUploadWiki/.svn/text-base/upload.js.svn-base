  
    function uploadFile() {
        var file = document.getElementById("uploadfile");
        if (file.lastChild.value.length == 0)
              {
              alert("no file selected!");
              return false;
              }           
        if (confirm("Upload: Are you sure?  This will completely replace your current wiki.  You may want to perform a manual backup first.")) {              
            singleMessage("Uploading Wiki ... ");
            
            file.submit();
        }
    }
    
config.shadowTiddlers.MTSAdminPanel += "\n|<<mtsconflictcleanup>>|";
