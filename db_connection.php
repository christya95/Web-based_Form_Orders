<?php

// connection info

$servername = 'localhost'; // same for local and cPanel
$username = 'root'; // this is where you need to change the username
$password = ''; // and password you created
$dbname = 'database_for_assignment7'; // this is the database we created

// Create a connection
$db = new mysqli($servername, $username, $password, $dbname);

//Check for errors
if($db->connect_error){
    die('Connection failed...');
}
