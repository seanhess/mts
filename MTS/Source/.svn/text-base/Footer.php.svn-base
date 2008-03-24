<script language="javascript" type="text/javascript" src="MTS/Source/ajax.js"></script>
<script>

<?php
/* /////////////////////////////////////////////////////////////////////////////

    MiniTiddlyServer: A mini-server for TiddlyWikis
    Copyright (C) 2007  Sean Clark Hess and Saq Imtiaz
    
    MiniTiddlyServer is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
    
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU General Public License along
    with this program; if not, write to the Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.

//////////////////////////////////////////////////////////////////////////////// */


// Plugins. Load to array as variables for later processing.
   echo "\nvar MTSExternalPlugins = [];";
   foreach (glob("MTS/Plugins/*.js") as $filename) {
      $fcontents = file_get_contents($filename);
      $fcontents = addslashes($fcontents);
      $fcontents = preg_replace('/(\n)/i', '\\n', $fcontents);
      $fcontents = preg_replace('/</i', '\\<', $fcontents);
      $fcontents = preg_replace('/>/i', '\\>', $fcontents);
      echo "\nMTSExternalPlugins.push(['$filename','$fcontents']);";
}

// AUTOSETTINGS // 
    include_once("MTS/Source/LocalInformation.php");
    
    $localInfo = new LocalInformation($wikipath);
    
    $fullscriptpath = $localInfo->siteUrl;
    $wrapperScriptPath = $localInfo->wrapperFile;
    $sourcePath = $localInfo->sourceFile;
    $sourceName = $localInfo->sourceName;
    $wrapperScriptName = $localInfo->wrapperName;
    $ext = $localInfo->ext;
    
// SPLIT // 
    if (file_exists($wrapperScriptName.".xml"))
       echo "\nvar mtsRssExists = true;";
    else
       echo "\nvar mtsRssExists = false;";
    
// STORE ORIGINAL VERSION // 
    echo "\nvar wrapperScriptPath = '$wrapperScriptPath';";
    echo "\nvar wrapperScriptName = '$wrapperScriptName';";
    echo "\nvar sourcePath = '$sourcePath';";
    echo "\nvar sourceName = '$sourceName';";
    echo "\nvar fullScriptPath = '$fullscriptpath';";
        
// RSS // 
    echo "\nvar rssExists = '" . file_exists($wrapperScriptName.".xml") . "';";

// FILETIME // Must be updated for prefixes
    echo "\nvar origtime = '".filemtime($sourcePath)."';";
    
// SERVER PATH // 
    echo "\nconfig.shadowTiddlers.SiteUrl = '$fullscriptpath';";


?>
</script>
<script>
    var startLogin = "<?php echo $_SESSION['mts_is_logged_in']?>";
    var loggedIn = (startLogin == "1");
    
    var startIsAdmin = "<?php echo $_SESSION['mts_user_is_admin']?>";
    var isAdmin = (startIsAdmin == "1");
    
function cloneObject(source) {
    var newObj = new Object();
    for ( var i in source )
        newObj[i] = source[i];
    
    return newObj;
}

function singleMessage(message, linkText) {
    clearMessage();
    displayMessage(message, linkText);
}

function ajaxModuleEvent(eventname, returnFunction, getParams, postParams) {
    
    if (!getParams)
        getParams = {};
        
    if (!postParams)
        postParams = {};
    
    getParams.ajaxModuleEventName = eventname;
    postParams.sourcePath = sourcePath;
    postParams.wrapperScriptName = wrapperScriptName;

    var eventAjax = new AjaxRequest("MTS/Source/ModuleEvent.php", returnFunction, getParams, postParams);
    eventAjax.send();
}

config.macros.IncludeTiddler= {}; 
config.macros.IncludeTiddler.handler = function (place, macroName, params) {
    var tiddlerName = params[0];
    var tiddlerText = store.getTiddlerText(tiddlerName);
    wikify(tiddlerText, place);
}



var loginpath = "MTS/Source/Login.php";
var savepath = "MTS/Source/Save.php";


</script>
<script language="javascript" type="text/javascript" src="MTS/Source/login.js"></script>
<script language="javascript" type="text/javascript" src="MTS/Source/save.js"></script>


<?php 

    include_once("MTS/Source/Modules.php"); 

    $moduleManager = new ModuleManager("MTS/Modules/");
    $moduleManager->importModules();
    $moduleManager->runModules();
    
    include_once("MTS/Source/ModuleController.php");
    
?>

