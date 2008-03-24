<?php 
    session_start();
    session_unset();
    session_destroy();
    
    
        
    /*
    Configuration and Installation::
    Run this file after copying everything to your install server. (In a unique folder!)

    /////////////////////////////////////////////////////////////////////////////

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

    ////////////////////////////////////////////////////////////////////////////////
    */

    $userspath = "MTS/Source/users.php";
    if (file_exists($userspath))
    {
        ?><h2>Config Complete</h2><p>The users file already exists</h2><?php
        echo "<br><a href='index.php'>Return to your default wiki</a>";
        exit();
    }

    $adminpass = $_POST['adminpass'];
    $adminuser = $_POST['adminuser'];

    if (isset($adminpass) && isset($adminuser) && $adminpass != "" && $adminuser != "") {

            // 1 // Create a new users.php with the admin password 
                $userstext = "<?php\n";
                $userstext .= "\$users = array(\n";
                $userstext .= "\t\"$adminuser\" => \"$adminpass\",\n";
                $userstext .= ");\n";
                $userstext .= "\$admins = array(\n";
                $userstext .= "\t\"$adminuser\" => true,\n";
                $userstext .= ");\n";
                $userstext .= "?>";
                
                if (!file_put_contents($userspath, $userstext))
                {
                    echo "<h2>User File Writing Error</h2><p>MTS was unable to create users.php, the file that stores login information.</p>";
                    exit();
                }
            
            // 4 // Redirect 
                echo "User Created<br><a href='index.php'>Return to your default wiki</a>";
                exit();
        
    }
    
// FIRST TIME ... // When this is first called, run some tests and print out the form. 

    // CHECK PHP VERSION // Requires PHP 5, preferrably 5.1 or higher

        if ( substr(phpversion(),0,strpos(phpversion(), ".")) == "4" ) {
            echo "<h2>PHP Version Error</h2><p>You are running PHP Version ".phpversion().".  MiniTiddlyServer requires PHP 5.1 or higher. Please use a server with PHP 5 enabled. </p>";
            exit;
        }
        else if ( substr(phpversion(),0,strrpos(phpversion(), ".")) == "5.0" )
            echo "<h2>PHP Version Warning</h2><p>You are running PHP Version ".phpversion().".  We suspect that MiniTiddlyServer does no twork on PHP 5.0.  If you experience problems, you may want to switch to 5.1.x or higher, but please report your bugs to the google list</p>";
            
            
    // CHECK FILE PERMISSIONS // 
        
        if ( !file_put_contents("MTS/Source/nothing.txt","data") ||  !unlink("MTS/Source/nothing.txt")) {
            echo "<h2>PHP Permissions Error</h2><p>MTS was unable to write to a test file</p>";
            exit();
        }
    
?>


<head>
    <title>Admin Configuration Script for MiniTiddlyServer</title>
    <style>
       td, div, body, p {
    	   font-family:verdana;
           font-size:10pt;
       }
       
       h1 {
            color:red;
       }
    </style>
    <script>

        // VERIFY // make sure they typed in good information
        function saveAndComplete() {

            var form = document.getElementById("settings");
            
            if (form.adminpass.value != form.adminpass2.value || form.adminpass.value == "" || form.adminpass2.value == "") {
                alert("Error: the passwords to not match or have not been entered");
                
                return; 
            }
            else if (form.adminuser.value.length < 2 )
                alert("Please choose a longer username");
            else if (form.adminpass.value.length < 2 )
                alert("Please choose a longer password");
            else
                form.submit();
        }

    </script>
</head>

<body>
    <form id="settings" method="POST" action="config.php">
    <h2>MiniTiddlyServer</h2>

    <h4>Set Administrator Account</h4>
    <table>
        <tr><td>user: </td><td><input type="text" size="10" name="adminuser"/></td></tr>
        <tr><td>password: </td><td><input type="password" size="10" name="adminpass"/></td></tr>
        <tr><td>repeat pass: </td><td><input type="password" size="10" name="adminpass2"/></td></tr>
    </table>

    <h4>Save and Complete</h4>
    <div>By clicking submit below, this config file will be deleted and you will be taken to your first wiki!</div>
    </form>
    <p><input type="submit" value="Save and Complete" onclick="saveAndComplete()"/></p>
</body>

