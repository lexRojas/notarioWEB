<?php 

  include 'database3.php'; 

  $query = 'SELECT registro.id_registro as id, registro.registro_descripcion as valor FROM u67qxne0bs0uujx8.registro;';

  print_r($query );

  $result  = mysqli_query($db,$query);

  print_r($db);

  print_r($result);


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