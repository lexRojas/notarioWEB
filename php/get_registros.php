<?php 

  include 'database3.php'; 

  $query = "SELECT registro.id_registro as id, registro.registro_descripcion as valor FROM heroku_c9945836774c401.registro;";

  $result  = mysqli_query($db,$query);

  if(!$result) {
      die('Query Failed'. mysqli_error($db));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'id' => $row['id'],
      'value' => $row['valor']
    );
  }
  $jsonstring = json_encode($json);
 
  echo $jsonstring;
?>