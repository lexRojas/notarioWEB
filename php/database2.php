<?php
$db=mysqli_connect('us-cdbr-east-06.cleardb.net', 'bbe532e4e582c2','13228bd4','heroku_c9945836774c401');

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$db=mysqli_init();
if (!$db)
  {
  die("mysqli_init failed");
  }

mysqli_ssl_set($db,"key.pem","cert.pem","ca.pem",NULL,NULL); 

if (!mysqli_real_connect($db,'us-cdbr-east-06.cleardb.net', 'bbe532e4e582c2','13228bd4','heroku_c9945836774c401'))
  {
  die("Connect Error: " . mysqli_connect_error());
  }


?>