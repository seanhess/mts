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
   
    include_once("SessionManager.php");
    include_once("ServerInformation.php");
    include_once("UserControl.php");
    include_once("ClientRequest.php");
    include_once("ServerResponse.php");
    include_once("SystemFunctions.php");
    
    $sessionManager = new SessionManager();
    $serverInfo = new ServerInformation();
    $serverResponse = new ServerResponse();
    
// CREATE INSTANCES // 
    if (file_exists($serverInfo->UsersFile))
        include_once($serverInfo->UsersFile);
    else
    {
        $users = array();
        $admins = array();
    }
    
    $userControl = new UserControl($users, $admins);
    $clientRequest = new ClientRequest();
    
    
