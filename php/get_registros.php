
<?php 

  require 'database.php';

  $query = "select id_registro as id,registro_descripcion as valor from registro";

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