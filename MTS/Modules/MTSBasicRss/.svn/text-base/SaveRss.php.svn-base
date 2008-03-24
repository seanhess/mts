<?php

/*/////////////////////////////////////////////////////////////////////////////

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

////////////////////////////////////////////////////////////////////////////////*/


    // RSS // 
    $rssfile = $clientRequest->rssFile;
    
    $rssData = $clientRequest->rss;
  
    if (isset($rssData) && $rssData != "" ) {
        $rss = updateRss($rssData,$rssfile,$clientRequest->deletedIndex,$clientRequest->savetype);
        if ( isset($rss) && $rss != "" && $rss!= false && $conflict != true) {
            writeToFile($rssfile, $rss);
            $serverResponse->setBoolean("rss",true);
        }
    }
           
    function splitRss ($source)
    {
        global $serverResponse;
        if (preg_match('/^(.*<\/generator>)(.*)?(<\/channel>.*)/sm', $source, $regs))
            return $regs;
            
        else 
            $serverResponse->throwCriticalError("There was a critical error in splitRss while saving your rss file");
    }

    function makeRssMap($source=' ')
    { 
       global $serverResponse;
       
       $temprssMap = array();
       if (preg_match_all('/<item>(?:.*?(?:<title>(.*?)<\/title>).*?)<\/item>/s', $source, $items, PREG_SET_ORDER))
         {
          foreach ($items as $item)
              {
               $temprssMap[$item[1]] = $item[0];
              }
          return $temprssMap;
         }
       else
         {
          //should throw an error here if the source was anything other than whitespace and the match still failed
          //when no items, the souce seems to be a line break
          return $temprssMap;
         }
    }
    
    
  function updateRss($newrss,$rssfilename,$deletedIndex,$savetype)
    {  
     global $serverResponse;
     
     if ($savetype == 'partial' && file_exists($rssfilename))
         {
         $oldrss = file_get_contents($rssfilename);
         $oldrssparts = splitRss($oldrss);
         $oldbody = $oldrssparts[2]; 
         $oldRssMap = makeRssMap ($oldbody); 
          
         #var_dump ($oldrssparts);
      
         #$newrss = file_get_contents("updates.xml"); #passed as an argument
         $newrssparts = splitRss($newrss);
         $newrssheader = $newrssparts[1];
         $newrssbody = $newrssparts[2];
         $newrssfooter = $newrssparts[3];
         $newRssMap = makeRssMap($newrssbody);
      
         #var_dump($newrssparts);
      
         $deletedrss = array_merge($deletedIndex,array_keys($newRssMap));
         
         #do I really need this now?
         if (! isset($oldRssMap) || $oldRssMap == false)
            $oldRssMap = array();
      
      //remove deleted tiddlers
         foreach($deletedrss as $deleted)
          {
            unset($oldRssMap[$deleted]);
          }
    
         $updatedrssbody = $newrssbody;
         foreach($oldRssMap as $t)
           {
            $updatedrssbody .= $t."\n";   
           }  
      
         $updatedrss = $newrssheader .$updatedrssbody .$newrssfooter;
        }
    else
        $updatedrss = $newrss;
        
     #echo $updatedrss;
     return $updatedrss;
   }
?>