<?php
class LocalInformation {
    
    public $sourceFile;
    public $wrapperFile;
    public $sourceName;
    public $wrapperName;
    public $siteUrl;
    public $ModulesDirectory;
    
    public $ext;

    public function __construct($wikipath) {
    
            
        $fullserverpath = $_SERVER["SCRIPT_NAME"];
        $parts = split("/",$fullserverpath);   
        $fullscriptpath = "http://".$_SERVER["SERVER_NAME"].$fullserverpath;
        $wrapperScriptPath = array_pop($parts);
        $sourcePath = $wikipath; // From the wikiframe .. the wrapper.  It should still be defined.
        $sourceName = substr($sourcePath, 0, strpos($sourcePath, ".htm"));
        list($wrapperScriptName, $ext) = split('\.', $wrapperScriptPath, 2);
        
        $this->sourceFile = $sourcePath;
        $this->sourceName = $sourceName;
        $this->wrapperFile = $wrapperScriptPath;
        $this->wrapperName = $wrapperScriptName;
        $this->ext = $ext;
        $this->siteUrl = $fullscriptpath;
        $this->ModulesDirectory = "MTS/Modules/";
    
    }


}

?>