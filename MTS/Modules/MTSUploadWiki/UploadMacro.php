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

<h4>Upload and Replace</h4>
<table>
    <tr><td>Select a TW: </td><td><form id="uploadfile" method="POST" enctype="multipart/form-data" action="MTS/Modules/MTSUploadWiki/Upload.php"><input type="hidden" name="sourcepath" value="<?php echo $localInfo->sourceFile ?>"/><input type="hidden" name="wrapperpath" value="<?php echo $localInfo->wrapperFile ?>"/><input name="uploadfile" type="file"/></form></td></tr>
    <tr><td colspan="2"><input type="submit" value="Upload" onclick="uploadFile()"></td></tr>
</table>