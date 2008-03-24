<?php include_once("System.php");

    $userControl->setUser($clientRequest->user, $clientRequest->pass);
    
// SAVING INFORMATION // 
    if ( $clientRequest->action == "login" ) {
        if ($userControl->isValid) {
            $_SESSION['mts_saved_username'] = $clientRequest->user;
            $_SESSION['mts_saved_password'] = $clientRequest->pass;
            $_SESSION['mts_is_logged_in'] = true;
            $_SESSION['mts_user_is_admin'] = true;
            $serverResponse->setBoolean("login",true);
            $serverResponse->setBoolean("admin",$userControl->isAdmin);
        }
        
        else {
            $serverResponse->setBoolean("login",false);
        }
    }
    
    else if ( $clientRequest->action == "logout" ) {
        session_unset();
        session_destroy();
        $serverResponse->setBoolean("logout",true);
        $serverResponse->setString("checkuser",$_SESSION['mts_saved_username']);
    }
    
    else {
        $serverResponse->setBoolean("error",true);
        $serverResponse->setString("message","Action was not specified: ".$clientRequest->action);
    }
    
    
    // INCLUDE MODULES! // 
        include_once("Modules.php");
        $moduleManager = new ModuleManager($serverInfo->ModulesDirectory);
        $moduleManager->importModules();
        $moduleManager->runEvent("MainLoginEvent");
    
    $serverResponse->send();

?>