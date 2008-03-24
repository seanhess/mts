<?php

    $module =  new Module("Sean Clark Hess","1.0","http://www.minitiddlyserver.com");
    
    $module->addScript("rss.js");
    $module->addEventPHP("MainSaveEvent","SaveRss.php");

?>