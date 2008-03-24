<h4>Module Manager</h4>
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

    include("MTS/Source/ModuleLocal.php");

// PRINT DIV // 
    echo "<table>";
    $dir = "MTS/Modules/";
    $mods = $moduleManager->modules;
    foreach ($mods as $mod) {
        $modfolder = $dir.$mod->name."/";
        $name = $mod->name;
        echo "<tr><td>";
        if ( $mod->isActive )
            echo "<input type='submit' value='[ ON ]' onClick='deactivateMod(this,\"$modfolder\")'/>";
        else
            echo "<input type='submit' value='[ OFF ]' onClick='activateMod(this,\"$modfolder\")'/>";
            
        echo "</td><td><a href='".$mod->website."' target='_blank'>$name</a></td><td>".$mod->author."</td><td>".$mod->version."</td></tr>\n";
    }
    
    echo "</table>";

?>

