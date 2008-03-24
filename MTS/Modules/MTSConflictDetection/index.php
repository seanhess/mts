<?php

$module = new Module("Sean Clark Hess","1.0","http://www.minitiddlyserver.com");

$module->addEventPHP("MainSaveEvent","ConflictsSave.php", true); // HIGH PRIORITY //
$module->addEventPHP("PostSaveEvent","ConflictsPostSave.php");
$module->addEventPHP("ConflictsInitEvent","ConflictsInitEvent.php");
$module->addHTMLMacro("mtsconflictcleanup","ConflictCleanup.html");
$module->addEventPHP("ConflictCleanupEvent","ConflictCleanupEvent.php");
$module->addScript("Conflicts.js");

?>