<?php

    $storeFormat = "'2.2'";

    function createTiddlerMap ($tiddlersDiv){
        global $storeFormat;
        $tiddlersMap =array();
        //$regexp = "<div\s[^>]*tiddler=\"([^\"]*)\"[^>]*>(.*)<\/div>";
        $regexp1="<div\s[^>]*(?:tiddler)?(?:title)?=\"([^\"]*)\"[^>]*>\s*(.*)\s*<\/div>";
        $regexp2="<div\s[^>]*(?:tiddler)?(?:title)?=\"([^\"]*)\"[^>]*>\s*<pre>(.*)<\/pre>\s*<\/div>";
        if(preg_match_all("/$regexp2/siU", $tiddlersDiv, $tiddlers, PREG_SET_ORDER))
        {
            foreach($tiddlers as $tiddler)
            {
                # title: [tiddlerDivAsString,tiddlerText]
                $tiddlersMap[$tiddler[1]] = array($tiddler[0],$tiddler[2]);
                $storeFormat = "'2.2'";
            }
        }
        elseif(preg_match_all("/$regexp1/siU", $tiddlersDiv, $tiddlers, PREG_SET_ORDER))
        {
            foreach($tiddlers as $tiddler)
            {
                # title: [tiddlerDivAsString,tiddlerText]
                $tiddlersMap[$tiddler[1]] = array($tiddler[0],$tiddler[2]);
                $storeFormat = "'2.1'";
            }
        }
        return $tiddlersMap;
    }

    
    function getTiddlersList ($map){
        return array_keys($map);
    }


    $source = file_get_contents ( "../../../".$_GET['file'] );

             // PARSE FILE //
    $parts = split("<div id=\"storeArea\">",$source);

    if (count($parts) == 2 && preg_match('/(.*)(\s*<\/div>\s*<!--POST-BODY-START-->.*)/s', $parts[1], $regs)) {
        $prestore = $parts[0]."<div id=\"storeArea\">";
        $store = $regs[1];
        $poststore = $regs[2];

        $storeTiddlerMap = createTiddlerMap($store);
        }

		       elseif (count($parts)==2)
			   {
                        $pieces = explode("<!--POST-STOREAREA-->",$parts[1],2);
                        if ($pieces!=$parts[1] && count($pieces) == 2)
                            {
                            $prestore = $parts[0]."<div id=\"storeArea\">\n";
				 $store = $pieces[0];
				 $poststore = "</div>\n<!--POST-STOREAREA-->".$pieces[1];
				 $storeTiddlerMap = createTiddlerMap($store);
                            }
                        //else
                          //   exit();
                       }

    $action = $_GET['action'];
    if ($action == 'index')
         $output = "var data = {tiddlerList:'".implode(",",getTiddlersList ($storeTiddlerMap))."',success:true,storeType:".$storeFormat."};";
       //write a function getStoreType($storeTiddlerMap)


    elseif ($action == 'fetch'){
        $title == $_GET['title'];
        $output = getTiddler($title);
        }

    echo $output;


?>