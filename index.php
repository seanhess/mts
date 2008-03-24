<?php session_start(); ?>
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

// PHP SOURCE // This file is copied as the php source for each file. 
       
    if (isset($_GET['source'])) 
        $wikipath = preg_replace('/.htm.?$/i','', $_GET['source']).'.html';
    
    //else
    //    $wikipath = 'defaultsource.html';
        
//  $wikipath = isset($_GET['source']) ? $_GET['source'].'.html' : "defaultsource.html";
    
    if (!file_exists($wikipath))
    {
        ?><h2>Wiki Does not Exist</h2><p><?= $wikipath ?></p><?php
        exit();
    }
        
    $wikidata = file_get_contents($wikipath);
    print $wikidata;

// FOOTER // 
include_once("MTS/Source/Footer.php"); 

?>