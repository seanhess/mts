<h4>Backups</h4>
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
    echo "<table id='mtsBackupsTable'>";
    $backupDir = "MTS/Backups/".$localInfo->sourceName;
    if (is_dir($backupDir) ) {
        $versions = scandir($backupDir);
        foreach ($versions as $file) {
            if (strpos($file, ".htm") != false) {
                $fullpath = $backupDir."/".$file;
                echo "<tr id='$fullpath'><td><a href='$fullpath'>$file</a></td><td><input type='submit' value='Revert' onClick='revertWiki(\"$file\")'/></td><td><input type='submit' value='[ X ]' onClick='deleteBackup(\"$fullpath\")'/></td></tr>";
            }
        }
    }    
    echo "</table>";

?>

