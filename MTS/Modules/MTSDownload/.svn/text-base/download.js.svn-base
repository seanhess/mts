var regexp = /<<saveChanges>>/i;
config.shadowTiddlers.SideBarOptions = config.shadowTiddlers.SideBarOptions.replace(regexp, "<<saveChanges>> <<mtsdownload>>");
config.shadowTiddlers.MTSDownloadPanel = '[[Right click on this link and select "Save As"|' + sourcePath + ']]';//
    
config.macros.mtsdownload = {};
config.macros.mtsdownload.handler = function (place,macroName,params,wikifier,paramString,tiddler) {
      wikify("[[download|"+fullScriptPath.replace(wrapperScriptPath,"")+"MTS/Modules/MTSDownload/download.php?url="+sourcePath+"]]",place);
      place.lastChild.className="button";
      place.lastChild.title="download the html wiki file";
}
