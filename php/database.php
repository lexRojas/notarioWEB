<?php

$db = mysqli_init();
mysqli_options ($db, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);

$db->ssl_set('bbe532e4e582c2-key.pem', 'bbe532e4e582c2-cert.pem','cleardb-ca.pem', null, null);
$link = mysqli_real_connect ($db, 'us-cdbr-east-06.cleardb.net', 'bbe532e4e582c2','13228bd4','heroku_c9945836774c401', 3306, NULL, MYSQLI_CLIENT_SSL);


echo mysqli_error($db);

if ($link){
    echo 'succefully...!';
}else{
    echo 'crash...!';
}



?>