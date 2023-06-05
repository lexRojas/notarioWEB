
<?php 

  require 'database.php';

  $id_registro = $_POST['id_acto'];

  $query = 'select id_acto as id, acto_descripcion as valor from notario.acto a inner join notario.registro_acto ra on a.id_acto  = ra.acto_id_acto where ra.registro_id_registro ='. $id_registro ;

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