<?php
$file = $_GET['url'];
if (end(explode(".", $file))== "html")
    {
    header('Content-Disposition: attachment; filename='.$file);
    header('Content-type: application/octet-stream');
    readfile("../../../".$file);
    }
?>