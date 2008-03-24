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

?>

<h4>Create New Wiki</h4>
    
<form action="javascript:;">
    <table>
        <tr><td>TW Type:</td><td>
        <select name="template">
        <?php
            $templatesDir = $serverInfo->TemplatesDirectory;
            $versions = scandir($templatesDir);
            foreach ($versions as $file) {
                if (strpos($file, ".htm") != false) {
                    echo "<option>$file</option>";
                }
            }
        ?>
        </select></td></tr>
        <tr><td>Unique Name:</td><td><input type="text" name="name"/></td></tr>
        <tr><td colspan="2"><input type="submit" value="Create Wiki" onclick="createWiki(this.form)"></td></tr>
    </table>
</form>