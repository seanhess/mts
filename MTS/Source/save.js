function generateRss(){};
function getTime(){};
function mtsConvertToUTF8(z)
{
    return z? convertUnicodeToUTF8(z) : z;
}

function saveChanges(onlyIfDirty,tiddlers)
{
	if(onlyIfDirty && !store.isDirty() && !store.uploadError)
		return;
	
    if (loggedIn != true) {
        alert("Please log in before saving this wiki");
        return false;
    }
    
    singleMessage("Saving...");
    
    // SEND INFO //
        var params = {
            time:               getTime(),
            "wrapperScriptName":wrapperScriptName,
            "sourcePath":       sourcePath,
            data:               mtsConvertToUTF8((store.uploadError) ? store.allTiddlersAsHtml() : store.updatedTiddlersAsHtml()),
            savetype:           (store.uploadError) ? "full":"partial",
            "deletedTiddlers":  mtsConvertToUTF8(store.deletedTiddlersIndex.join("|||||")),
            rss:                mtsConvertToUTF8(generateRss())
        }
        
        // Handle for extending // 
        params = alterSaveParams(params);
        
        if ( params.data == "" && params.deletedTiddlers == "") {
            displayMessage("There was nothing to save");
            return;
        }
        
        //reset tiddlers that were marked for upload
        resetTiddlersMarkedForUpload();
        saveAjaxRequest(savepath, saveReturn, {backup:config.options.chkSaveBackups}, params);
        postSave();
}

function alterSaveParams(params) {
    return params;
}

function resetTiddlersMarkedForUpload () {
    store.deletedTiddlersIndex = [];
    store.unFlagForUpload(store.updatedTiddlersIndex);
}

function saveAjaxRequest(savepath, saveReturn, getParams, postParams) {
    var saveRequest = new AjaxRequest(savepath, saveReturn, getParams, postParams);
        saveRequest.send();
}

function postSave () {
    store.setDirty(false);
}




function saveReturn(response) {
    //alert(response);    
    if (response.error == true ) {
        store.uploadError = true;
        store.setDirty(true);
    }

    else if ( response.conflict ) {
        displayMessage("Error! A conflict was detected.  Your changes have been routed to the following file.  Please click the following link, refresh this wiki and copy your changes manually.<a href='" + data.path + "' target='_blank'>Rerouted Changes</a>");
        store.uploadError = false;
    }
    
    else if ( response.nothing ) {
        displayMessage("There was nothing to save");
        store.uploadError = false;
    }

    else {
        displayMessage(config.messages.mainSaved,sourcePath);
        store.uploadError = false;
    }

}


TiddlyWiki.prototype.deletedTiddlersIndex = [];
TiddlyWiki.prototype.updatedTiddlersIndex = [];
TiddlyWiki.prototype.uploadError = false;

TiddlyWiki.prototype.flagForUpload = function(title)
{
  store.suspendNotifications();
	this.setValue(title,"temp.flagForUpload",1,true);
	store.resumeNotifications();
}

TiddlyWiki.prototype.unFlagForUpload = function(tiddlers)
{
    store.suspendNotifications();
    for (var i=0; i<tiddlers.length;i++)
         this.setValue(tiddlers[i],"temp.flagForUpload","",true);
    store.resumeNotifications();
}

old_ffu_setTiddlerTag = TiddlyWiki.prototype.setTiddlerTag;
TiddlyWiki.prototype.setTiddlerTag = function(title,status,tag)
{
    old_ffu_setTiddlerTag.apply(this,arguments);
    this.flagForUpload(title);
}

TiddlyWiki.prototype.old_ffu_saveTiddler = TiddlyWiki.prototype.saveTiddler
TiddlyWiki.prototype.saveTiddler = function(title,newTitle,newBody,modifier,modified,tags,fields)
{
    if (newTitle && newTitle!= title)
        this.deletedTiddlersIndex.pushUnique(title);
    var temp = this.old_ffu_saveTiddler(title,newTitle,newBody,modifier,modified,tags,fields);
    this.flagForUpload(temp);
    return temp;
}

old_ffu_setValue = TiddlyWiki.prototype.setValue;
TiddlyWiki.prototype.setValue = function(tiddler, fieldName, value,flag) {
    old_ffu_setValue.apply(this,arguments);
    if (!flag)
        this.flagForUpload(tiddler);
}

old_ffu_removeTiddler = TiddlyWiki.prototype.removeTiddler;
TiddlyWiki.prototype.removeTiddler = function(title)
{
	old_ffu_removeTiddler.apply(this,arguments);
	this.deletedTiddlersIndex.pushUnique(title);
}


TiddlyWiki.prototype.updatedTiddlersAsHtml = function()
{
   return store.getSaver().externalizeUpdated(store);
}

SaverBase.prototype.externalizeUpdated = function(store)
{
	var results = [];
	var tiddlers = store.getTiddlersWithField("temp.flagForUpload",1);
	for (var t = 0; t < tiddlers.length; t++)
		{
    results.push(this.externalizeTiddler(store, tiddlers[t]));
	  store.updatedTiddlersIndex.push(tiddlers[t].title);
    }
  return results.join("\n");
}

TiddlyWiki.prototype.getTiddlersWithField = function (field,fieldValue,resultMatch)
{                
       if (resultMatch==undefined) var resultMatch = true;
       var results= [];
       this.forEachTiddler(function(title,tiddler){
                var f = !resultMatch;
                var fieldResult = store.getValue(tiddler,field);
                if (fieldResult!=undefined)
                  {if(fieldValue == undefined || fieldValue == fieldResult)
                          {f= resultMatch;}
                   if (f) results.push(tiddler);       }

                });
       results.sort(function(a,b) {return a["title"] < b["title"] ? -1 : (a["title"] == b["title"] ? 0 : +1);});
       return results;
}

// reassign save action for backstage to use mts modified version
//why is this necessary? should work without but doesnt.
if (config.tasks)
    config.tasks.save= {text: "save", tooltip: "Save your changes to this TiddlyWiki", action: saveChanges};
