<?php
// Create connection
/*
$hostname = 'localhost';
$username = 'id20870862_basedatos'; 
$password = 'C0c0l0c0++';
$database = 'id20870862_notario'; 
*/
$hostname = 'jtb9ia3h1pgevwb1.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
$username = 'vl0v51r0t6ald9dh'; 
$password = 'nq5d3dq46cc551cj';
$database = 'u67qxne0bs0uujx8'; 

$db = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

?>