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

// DEFINED BY ModuleEvent.php: $userControl, $serverInfo, $clientRequest, $serverResponse, // 
// ALSO FUNCTIONS in SystemFunctions.php: writeToFile // 

// CREATE INSTANCES // 
    
    if ( $userControl->isAdmin != true ) {
        $serverResponse->throwCriticalError("You must be logged in as the admin to access this function");
    }
    
// SET VARS // 
    $newSource = $clientRequest->newSource;
    $dirShift = $serverInfo->BaseInstallOffset;
    $templatename = $serverInfo->TemplatesDirectory.$clientRequest->template;       
    
    $sourcepath = $dirShift.$newSource;
    
    if ($templatename == $serverInfo->TemplatesDirectory) 
        $serverResponse->throwError("The template name was lost in the request");
    
    else if (!file_exists($templatename))
        $serverResponse->throwError("The template '$templatename' does not exit");
        
    else if (strpos($templatename, ".htm") == false)
        $serverResponse->throwError("The template '$templatename' is not an html file");

    else if (file_exists($sourcepath))
        $serverResponse->throwError("The wiki '$newSource' already exists");
        
    else {
        // COPY TEMPLATE // Copy the template wiki
        
            if ( !copy($templatename, $sourcepath))
                $serverResponse->throwError("Could not copy '$templatename' to '$sourcepath'");
            else
                $serverResponse->setBoolean("created",true);
                
    }
    
    $serverResponse->send();
?>