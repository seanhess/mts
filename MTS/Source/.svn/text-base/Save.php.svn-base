<?php include_once("System.php");

    // VERIFY USER NAME // Kill if not good user
    if ($userControl->verify($_SESSION['mts_saved_username'], $_SESSION['mts_saved_password']) == false ) {
        $serverResponse->throwError("Your session information was lost.  Please make sure cookies are enabled");
        $serverResponse->send();
        exit();
    }
    
    class SavePostRequest extends ClientRequest {
        public $updatesDiv;
        public $savetype;
        public $deletedIndex;
        public $isPartial;
        public $updatesMap;
        public $updatesIndex;
    
        public function __construct() {
            $this->updatesDiv = $this->decodePost($_POST['data']);
            $this->savetype = $this->decodePost($_POST['savetype']);
            $this->deletedIndex = explode("|||||",$this->decodePost($_POST['deletedTiddlers']));
            $this->isPartial = ($this->savetype == "partial");
            $this->updatesMap = createTiddlerMap($this->updatesDiv);
            $this->updatesIndex = array_keys($this->updatesMap);
            parent::__construct();
        }
    }
    
    class TiddlyWikiInfo {
    
        public $markupBlockData;
        public $markupBlocks;
    
        public function __construct() {
        
            // MARKUP BLOCKS // Titles are automatic now, but for support !!
                $this->markupBlockData = array(
                    'SiteTitle'           =>  array("<title>","</title>","My TiddlyWiki"),
                    'SiteSubtitle'       => array("<title>","</title>","a reusable non-linear personal web notebook"),
                    'MarkupPreHead'   => array("\n<!--PRE-HEAD-START-->\n","\n<!--PRE-HEAD-END-->\n","<!--{{{-->\n<link rel='alternate' type='application/rss+xml' title='RSS' href='index.xml'/>\n<!--}}}-->"),
                    'MarkupPostHead'  => array("\n<!--POST-HEAD-START-->\n","\n<!--POST-HEAD-END-->\n",""),
                    'MarkupPreBody'   => array("\n<!--PRE-BODY-START-->\n","\n<!--PRE-BODY-END-->\n",""),
                    'MarkupPostBody'  => array("\n<!--POST-BODY-START-->\n","\n<!--POST-BODY-END-->\n","")
                );
                $this->markupBlocks = array_keys($this->markupBlockData);
                
        }
    
    }

    class TiddlyWiki {

        private $serverResponse;

        public $source;
        public $sourceFile;
        public $sourcename;

        public $prestore;
        public $store;
        public $poststore;

        public $storeTiddlerMap;

        //public $parseError;

        public function __construct($sourceFile, $serverResponse) {


            $this->serverResponse = $serverResponse;

            // LOAD FILE //
                $this->sourceFile = $sourceFile;
                $this->source = file_get_contents ( $this->sourceFile );
                $this->sourcename = basename($this->sourceFile,".html");
                //$this->parseError = false;

        }


        public function init() {
             // PARSE FILE //
                $parts = split("<div id=\"storeArea\">",$this->source);

                if (count($parts) == 2)
                    {
                    if (preg_match('/(.*)(\s*<\/div>\s*<!--POST-BODY-START-->.*)/s', $parts[1], $regs)) {
                        $this->prestore = $parts[0]."<div id=\"storeArea\">";
                        $this->store = $regs[1];
                        $this->poststore = $regs[2];
                        $this->storeTiddlerMap = createTiddlerMap($this->store);
                        $this->parseError = "0";
                        }
                    else
                        {
                        $pieces = explode("<!--POST-STOREAREA-->",$parts[1],2);
                        if ($pieces!=$parts[1] && count($pieces) == 2)
                            {
                            $this->prestore = $parts[0]."<div id=\"storeArea\">\n";
			    $this->store = $pieces[0];
		       	    $this->poststore = "</div>\n<!--POST-STOREAREA-->".$pieces[1];
			    $this->storeTiddlerMap = createTiddlerMap($this->store);
                        $this->parseError = "0";
                        //$this->serverResponse->throwError($this->parseError);
                            }
                        else
                            {
                            $this->serverResponse->throwError("The source file ($this->sourceFile) was not found or is corruped.  Please open manually to fix.  Your save was redirected to $this->sourcename.err");
                            $this->parseError = "1";
                            }
                        }
                    }
                else
                   {
                   $this->serverResponse->throwError("The source file ($this->sourceFile) was not found or is corruped.  Please open manually to fix.  Your save was redirected to $this->sourcename.err");        
                   $this->parseError = "1";}
                   }
    }

    class SavingMachine {

        private $serverResponse;
        private $tiddlyWiki;
        private $clientRequest;
        private $tiddlyWikiInfo;
        private $newStoreMap;
        
        private $newTW;
        
        public $saveFile;
        public $errorFile;
        public $saveRedirect;

        public function __construct($serverResponse,$tiddlyWiki,$clientRequest,$tiddlyWikiInfo) {
            $this->serverResponse = $serverResponse;
            $this->tiddlyWiki = $tiddlyWiki;
            $this->clientRequest = $clientRequest;
            $this->tiddlyWikiInfo = $tiddlyWikiInfo;
            $this->saveFile = $this->tiddlyWiki->sourceFile;
            $this->errorFile = str_replace(".html",".err",$this->tiddlyWiki->sourceFile);
        }
        
        public function goSave() {
        
            // GET NEW TW STRING // 
                $newstore="";
            
                if ($this->clientRequest->isPartial)
                    $newstore = $this->getPartialData();
                    
                else
                    $newstore = $this->clientRequest->updatesDiv;
                    
                $this->newTW = $this->tiddlyWiki->prestore.$newstore.$this->tiddlyWiki->poststore;
                

            // FIX MARKUP BLOCKS // 
            
            if ($this->clientRequest->isPartial) {
                
                $changedtiddlers = array_merge($this->clientRequest->updatesIndex, $this->clientRequest->deletedIndex);

                foreach($this->tiddlyWikiInfo->markupBlocks as $block)
                    if (in_array($block, $changedtiddlers))
                        $this->updateBlock($block);
            }
            else
                foreach($this->tiddlyWikiInfo->markupBlocks as $block)
                    $this->updateBlock($block);
            
            if ($this->tiddlyWiki->parseError === "1")
                writeToFile($this->errorFile, $this->newTW);
            else
                writeToFile($this->saveFile, $this->newTW);
        }
        
        
        private function updateBlock($block) {
            if ($block == 'SiteTitle' || $block == 'SiteSubtitle') {
                $text = $this->getBlockText('SiteTitle').' - '.$this->getBlockText('SiteSubtitle');
                $last = false;
            }
            else {
                $text = $this->getBlockText($block);
                $last = true;
            }          
            $this->newTW = findAndReplaceInside($this->newTW, $this->tiddlyWikiInfo->markupBlockData[$block][0],  $this->tiddlyWikiInfo->markupBlockData[$block][1], $text,$last);
        }
        
        private function getBlockText($block) {
               $markupBlockData = $this->tiddlyWikiInfo->markupBlockData;
               
                if (isset($this->newStoreMap[$block]))
                   $text = $this->fixBlockText($this->newStoreMap[$block][1]);
                else
                   $text = $markupBlockData[$block][2];
                   
                return $text;
        }
        
        private function fixBlockText($text) {
            return htmlspecialchars_decode(preg_replace ('/\\\n/i',' ',$text));
        }
        
        private function getPartialData() {
            $updatesMap = $this->clientRequest->updatesMap;
            $storeTiddlerMap = $this->tiddlyWiki->storeTiddlerMap;
            $deletedIndex = $this->clientRequest->deletedIndex;
            
            // delete tiddlers from store 
            foreach($deletedIndex as $deleted) {
              unset($storeTiddlerMap[$deleted]);
              }
              
            // add updates to storeTiddlerMap
            $this->newStoreMap = array_merge($storeTiddlerMap,$updatesMap);
            
            ksort($this->newStoreMap);
            
            //create new storeDiv
            $newstore = '';
            foreach($this->newStoreMap as $t)
                $newstore .= $t[0]."\n";   
                 
            return $newstore;
        }
        
    }
    
    
    function createTiddlerMap ($tiddlersDiv){
        $tiddlersMap =array();
        //$regexp = "<div\s[^>]*tiddler=\"([^\"]*)\"[^>]*>(.*)<\/div>";
        $regexp1="<div\s[^>]*(?:tiddler|(?<!tsnip.)title)=\"([^\"]*)\"[^>]*>\s*(.*)\s*<\/div>";
        $regexp2="<div\s[^>]*(?:tiddler|(?<!tsnip.)title)=\"([^\"]*)\"[^>]*>\s*<pre>(.*)<\/pre>\s*<\/div>";
        if(preg_match_all("/$regexp2/siU", $tiddlersDiv, $tiddlers, PREG_SET_ORDER))
        {
            foreach($tiddlers as $tiddler)
            {
                # title: [tiddlerDivAsString,tiddlerText]
                $tiddlersMap[$tiddler[1]] = array($tiddler[0],$tiddler[2]);
            }
        }
        elseif(preg_match_all("/$regexp1/siU", $tiddlersDiv, $tiddlers, PREG_SET_ORDER))
        {
            foreach($tiddlers as $tiddler)
            {
                # title: [tiddlerDivAsString,tiddlerText]
                $tiddlersMap[$tiddler[1]] = array($tiddler[0],$tiddler[2]);
            }
        }
        return $tiddlersMap;
    }
    
    
    // ACTIONS! //
    $clientRequest = new SavePostRequest();
    
    // UPDATES AND DELETES // 
    if ( $clientRequest->updatesDiv == "" && $clientRequest->deletedTiddlers == "") {
        $serverResponse->setBoolean("saved",true);
        $serverResponse->setBoolean("nothing",true);
        $serverResponse->send();
        exit();
    }
    
  
    
    // END INCLUDE MODULES ! // 
    
    $tiddlyWiki = new TiddlyWiki($clientRequest->sourceFile, $serverResponse);
    $tiddlyWikiInfo = new TiddlyWikiInfo();
    $savingMachine = new SavingMachine($serverResponse,$tiddlyWiki,$clientRequest,$tiddlyWikiInfo);
    
    // INCLUDE MODULES! // 
        include_once("Modules.php");
        $moduleManager = new ModuleManager($serverInfo->ModulesDirectory);
        $moduleManager->importModules();
        $moduleManager->runEvent("MainSaveEvent");

    $tiddlyWiki->init();
    $savingMachine->goSave();
    
    // POST SAVE // 
        $moduleManager->runEvent("PostSaveEvent");
    
    $serverResponse->send();
    

?>