<?php

// TO BE INCLUDED FROM A MODULE // 


include_once("../../Source/ServerInformation.php");
$serverInfo = new ServerInformation("../../../");
include_once($serverInfo->SourceDirectory."SessionManager.php");
include_once($serverInfo->SourceDirectory."UserControl.php");
    
    include($serverInfo->UsersFile);
    $userControl = new UserControl($users,$admins);
    $sessionManager = new SessionManager();
    $userControl->setUser($sessionManager->user,$sessionManager->pass);
    
    
    
?>