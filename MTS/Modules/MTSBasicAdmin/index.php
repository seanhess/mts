<?php


// DEFINE // 
$module = new Module("Sean Clark Hess","1.0","http://www.minitiddlyserver.com");


// ADMIN PANEL AND PRECHECKING // 
$module->addScript("Admin.js");

// CREATEWIKI // 
$module->addScript("CreateWiki.js");
$module->addHTMLMacro("mtscreatewiki","CreateWikiLocal.php");
$module->addEventPHP("CreateWikiEvent","CreateWiki.php");

// ADDUSER // 
$module->addScript("AddUser.js");
$module->addHTMLMacro("mtsadduser","AddUser.html");
$module->addEventPHP("AddUserEvent","AddUser.php");

// REMOVEUSER // 
$module->addScript("DeleteUser.js");
$module->addEventPHP("DeleteUserEvent","DeleteUser.php");

// LISTUSERS // 
$module->addHTMLMacro("mtsuserlist","ListUsersLocal.php");

// DELETEWIKI // 
/*
$module->addScript("DeleteWiki.js");
$module->addHTMLMacro("mtsdeletewiki","DeleteWiki.html");
$module->addEventPHP("DeleteWikiEvent","DeleteWiki.php");*/

// MANUAL BACKUP // 
$module->addScript("ManualBackup.js");
$module->addHTMLMacro("mtsbackup","ManualBackup.html");
$module->addEventPHP("ManualBackupEvent","ManualBackup.php");

// REVERT // 
$module->addScript("Revert.js");
$module->addHTMLMacro("mtsrevert","RevertLocal.php");
$module->addEventPHP("RevertEvent","RevertRemote.php");

$module->addScript("DeleteBackup.js");
$module->addEventPHP("DeleteBackupEvent","DeleteBackup.php");

?>

