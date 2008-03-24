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

    // DELETE ACCESS FILES // 
    $accessDir = $serverInfo->ModulesDirectory.$module->name."/access/";
    if (is_dir($accessDir) ) {
        $files = scandir($accessDir);
        foreach ($files as $file) {
            if (strpos($file, ".txt") != false) {
               unlink($accessDir.$file);
            }
        }
        
        $serverResponse->setBoolean("cleanup",true);
    }    
    else
        $serverResponse->throwError("The access directory was not found: $accessDir");
    
?>