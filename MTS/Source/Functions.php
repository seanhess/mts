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

/*

Common Functions .. These will allow us to not have to write so much duplicate code in System.php and config.php


*/
    function createNewWiki ($newWrapper, $newSource, $dirShift, $baseDir) {
        global $data, $templatename, $wikiframe;
        
        $wrapperpath = $dirShift.$newWrapper;
        $sourcepath = $dirShift.$newSource;
    
        if (file_exists($wrapperpath))
            $data .= "error:true, message:\"A wrapper file of the name '$newWrapper' already exists\",";
            
        else if (file_exists($sourcepath))
            $data .= "error:true, message:\"A source file of the name '$newSource' already exists\",";
            
        else {
        
            // COPY TEMPLATE // Copy the template wiki
                $source = file_get_contents($templatename);
                $source = preg_replace ( '/SiteUrl: ".*"/i',"SiteUrl: \"$baseDir$newWrapper\"",$source);
                writeToFile($sourcepath, $source);
            
            // CREATE WRAPPER // Open the wikiframe, put in the new filename and go.
                $output = file_get_contents($wikiframe);
                $output = preg_replace ( '/"WIKIPATH"/i',"\"$newSource\"",$output);
                writeToFile($wrapperpath, $output);
        }

    }


    function writeToFile($file, $str) {
    
        global $data, $lockdown;
        
        if ($lockdown == true)
            return false;
            
        if (!file_put_contents($file, $str))
            $data .= "error:true, message:'Cannot write file ($file)',";

        else
            $data .= "saved:true,";
        
    }
?>