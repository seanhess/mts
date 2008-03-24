<?php


include_once("MTS/Source/ServerInformation.php");
$serverInfo = new ServerInformation("");
include_once($serverInfo->SourceDirectory."SessionManager.php");
include_once($serverInfo->SourceDirectory."UserControl.php");
include_once($serverInfo->SourceDirectory."LocalInformation.php");
    
    include($serverInfo->UsersFile);
    $userControl = new UserControl($users,$admins);
    $sessionManager = new SessionManager();
    $userControl->setUser($sessionManager->user,$sessionManager->pass);
    $localInfo = new LocalInformation($wikipath);
    
?>