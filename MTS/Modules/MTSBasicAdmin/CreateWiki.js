

function createWiki(form) {
    
    if ( isAdmin == false ) {
        alert("You must be an administrator to access this function ");
        return;
    }
    
	var sourcename = form.name.value;
    var sourcepath = sourcename + ".html";
    var template = form.template.options[form.template.selectedIndex].value;
    
    if ( template == undefined || template == "")
        template = form.template.options[form.template.selectedIndex].text;
    
    if ( sourcename.indexOf(".") > -1 ) 
        alert("The name must not include an extension");

    else {
        
        singleMessage("Creating Wiki ... ");
        
        var ret = function (response) {
            if ( response.created )
                displayMessage("Wiki Created Successfully: " + sourcename,"index.php?source=" + sourcename);
        }
        
        var params = {
            newSource: sourcepath,
            template: template
        }
        
        ajaxModuleEvent("CreateWikiEvent",ret,params);
    }
}