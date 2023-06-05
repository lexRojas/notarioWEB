<?php
// Create connection
$hostname = 'jtb9ia3h1pgevwb1.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
$username = 'vl0v51r0t6ald9dh'; 
$password = 'nq5d3dq46cc551cj';
$database = 'u67qxne0bs0uujx8'; 


$db = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connection was successfully established!";

?>