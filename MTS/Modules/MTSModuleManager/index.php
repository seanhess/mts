<?php

    $module = new Module("Sean Clark Hess","1.0","http://www.minitiddlyserver.com");
    
    $module->addScript("Modules.js");
    $module->addHTMLMacro("mtsmodulemanager","ModuleManager.php");
    $module->addEventPHP("ModuleActivationEvent","ModuleActivation.php");



?>