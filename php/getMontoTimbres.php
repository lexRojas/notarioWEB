<?php 

  include 'database_aws.php';

  $id_acto = $_POST['id_acto'];
  $monto = $_POST['monto'];

  $query = "select * from acto a " .  
           "inner join tarifario t ON a.id_acto = t.acto_id_acto " .
           "inner join timbre t2 on t.timbre_id_timbre  = t2.id_timbre " .
           "where a.id_acto = " . $id_acto .  "order by t2.id_timbre ;";

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