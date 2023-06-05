<?php

$db = mysqli_init();
$db -> ssl_set('bbe532e4e582c2-key.pem', 'bbe532e4e582c2-cert.pem','cleardb-ca.pem', null, null);
$db -> real_connect('us-cdbr-east-06.cleardb.net', 'bbe532e4e582c2','13228bd4','heroku_c9945836774c401');

?>