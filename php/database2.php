<?php
$db=mysqli_connect('jtb9ia3h1pgevwb1.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'vl0v51r0t6ald9dh','nq5d3dq46cc551cj','u67qxne0bs0uujx8');
//mysqli_options($db, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, 1);

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$db=mysqli_init();
if (!$db)
  {
  die("mysqli_init failed");
  }

mysqli_ssl_set($db,"rds-combined-ca-bundle.pem","rds-combined-ca-bundle.pem","rds-combined-ca-bundle.pem",NULL,NULL); 

if (!mysqli_real_connect($db,'jtb9ia3h1pgevwb1.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'vl0v51r0t6ald9dh','nq5d3dq46cc551cj','u67qxne0bs0uujx8'))
  {
  die("Connect Error: " . mysqli_connect_error());
  }


?>