
<?php 

  include 'php\database.php'; 

  $query = "SELECT registro.id_registro as id, registro.registro_descripcion as valor FROM heroku_c9945836774c401.registro;";

  $result  = mysqli_query($db,$query);

echo 'buscando registros...';


  if(!$result) {

      echo 'algo fallo!!!';
      echo '<pre>';
      echo $result;
      echo '</pre>';       
      die('Query Failed'. mysqli_error($db));
  }else{
    

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