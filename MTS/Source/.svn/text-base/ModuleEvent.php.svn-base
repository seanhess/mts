<?php
    include_once("SessionManager.php");
    include_once("ServerResponse.php");
    include_once("ServerInformation.php");
    include_once("UserControl.php");
    include_once("ClientRequest.php");
    include_once("SystemFunctions.php");
    
    $serverInfo = new ServerInformation();
    include_once($serverInfo->UsersFile);
    $userControl = new UserControl($users,$admins);
    $serverResponse = new ServerResponse();
    $clientRequest = new ClientRequest();
    $sessionManager = new SessionManager();
    
    $userControl->setUser($sessionManager->user,$sessionManager->pass);
    
    $event = $clientRequest->ajaxModuleEventName;

    // INCLUDE MODULES! // 
        include_once("Modules.php");
        $moduleManager = new ModuleManager("../Modules/");
        $moduleManager->importModules();
        $moduleManager->runEvent($event);
        
    // DEFINES FOR YOUR EVENTS THE ABOVE INSTANCES // 
    
    // FINISH //
        $serverResponse->send();
    

?>