<?php 

  require 'database_aws.php';

    $id_acto = $_POST['id_acto'];
    $monto = $_POST['monto'];

    $query = 'select * from acto a inner join tarifario t ON a.id_acto = t.acto_id_acto inner join timbre t2 on t.timbre_id_timbre  = t2.id_timbre  where a.id_acto = '.$id_acto.' order by t2.id_timbre';

    $result  = mysqli_query($db,$query);

  if(!$result) {
      die('Query Failed'. mysqli_error($db));
  }
  
  $json_tarifas = array();
  
  
  $tarifa=0;
  
  while($row = mysqli_fetch_array($result)) {
  
    //TIMBRE DEFINIDO POR MULTIPLOS

    if ($row['factor'] =='M'){

        $tarifa = ($monto / $row['valor']) * $row['multiplo'];
        $tarifa = $tarifa  * $row['porcentaje'];
        
        if ($tarifa < $row['minimo']) {
            $tarifa = $row['minimo'];
        }
    }

    //TIMBRE DEFINIDO POR VALOR ABSOLUTO

    if ($row['factor'] =='A'){

        $tarifa = $row['valor'];
        $tarifa = $tarifa  * $row['porcentaje'];    
    }

    //TIMBRE DEFINIDO POR PORCENTAJE

    if ($row['factor'] =='P'){

        $tarifa = $monto * $row['valor'];
        $tarifa = $tarifa  * $row['porcentaje'];
        
        if ($tarifa < $row['minimo']) {
            $tarifa = $row['minimo'];
        }
    }

    //TIMBRE DEFINIDO POR RANGO
    
    if ($row['factor'] =='R'){

        $query_2 = "select * from rango_timbre rt where rt.id_rango_timbre = ".$row['timbre_id_rango_timbre'] ; 
        
        $result_rangos  = mysqli_query($db,$query_2);

        // RECORRO LOS DISTINTOS RANGOS QUE APLICAN 

        while($row_rango = mysqli_fetch_array($result_rangos)) {
            
            if( ($monto > $row_rango['minimo']) & ($monto <= $row_rango['maximo'])) {

                $tarifa  = $row_rango['minimo'];
                $tarifa =  $tarifa * $row['porcentaje'];
            }
        }
        
    }
    
    // GUARDO LOS DATOS EN UNA JSON 

    $json_tarifas[] = array(
      'id' => $row['id_timbre'],
      'descripcion' => $row['timbre_descripcion'],
      'tarifa' => $tarifa
    );

  }
  $jsonstring = json_encode($json_tarifas);
 
  echo $jsonstring;

?>

  