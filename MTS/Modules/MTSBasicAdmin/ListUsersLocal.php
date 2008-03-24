<h4>User List</h4>
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

    include("MTS/Source/ModuleLocal.php");

// PRINT DIV // 
    echo "<table>";
    $userlist = $userControl->getAllUsers();
    foreach ($userlist as $username)
        echo "<tr><td>$username</td><td><input type='submit' value='[ X ]' onClick='deleteUser(\"$username\", this.parentNode.parentNode);'/></td></tr>";
    echo "</table>";

?>


