<?php 

  require 'database_aws.php';

    $id_acto = $_POST['id_acto'];
    $monto = $_POST['monto'];

    $datos=[$id_acto,$monto];

    echo 'resultao -->'.$id_acto.'==='.$monto;

  
?>