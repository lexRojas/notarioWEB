<?php 

  require 'database_aws.php';

    $id_acto = $_POST['id_acto'];
    $monto = $_POST['monto'];


    if ((!is_numeric($monto)) || ($monto < 0 )){
      $monto = 0;
    }


    $query = 'select * from acto a inner join tarifario t ON a.id_acto = t.acto_id_acto inner join timbre t2 on t.timbre_id_timbre  = t2.id_timbre  where a.id_acto = '.$id_acto.' order by t2.id_timbre';

    $result  = mysqli_query($db,$query);

  if(!$result) {
      die('Query Failed'. mysqli_error($db));
  }
  
  $json_tarifas = array();

  $tarifa=0;
  $honorarios=0;
  $total_tarifas=0;

  while($row = mysqli_fetch_array($result)) {

    $porcentaje_tarifa =   $row['porcentaje'];
  
    //TIMBRE DEFINIDO POR MULTIPLOS

    if ($row['factor'] =='M'){

        $tarifa = ($monto / $row['valor']) * $row['multiplo'];
        $tarifa = $tarifa  * $porcentaje_tarifa;
        
        if ($tarifa < $row['minimo']) {
            $tarifa = $row['minimo'];
        }
    }

    //TIMBRE DEFINIDO POR VALOR ABSOLUTO

    if ($row['factor'] =='A'){

        $tarifa = $row['valor'];
        $tarifa = $tarifa  * $porcentaje_tarifa;    
    }

    //TIMBRE DEFINIDO POR PORCENTAJE

    if ($row['factor'] =='P'){

        $tarifa = $monto * $row['valor'];
        $tarifa = $tarifa  * $porcentaje_tarifa;
        
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
            
            if( ($monto > $row_rango['minimo']) && ($monto <= $row_rango['maximo'])) {

                $tarifa  = $row_rango['valor'];
                $tarifa =  $tarifa * $porcentaje_tarifa;
            }
        }
        
    }
    
    // GUARDO LOS DATOS EN UNA JSON 

    $json_tarifas[] = array(
      'id' => $row['id_timbre'],
      'descripcion' => $row['timbre_descripcion'],
      'tarifa' => $tarifa
    );

    $total_tarifas = $total_tarifas+ $tarifa;
  }


  $query_2 = 'select * from honorarios h order by id_honorario;' ; 
        
  $result_rangos  = mysqli_query($db,$query_2);

  // RECORRO LOS DISTINTOS RANGOS QUE APLICAN HONORARIOS 

  while($row = mysqli_fetch_array($result_rangos)) {
      
    if ($monto > $row["minimo"]) {
        if ($monto <= $row["maximo"]) {
            $honorarios  = ($monto - $row["minimo"]) * $row["porcentaje"] + $honorarios;
        }else{
            $honorarios = ($row["maximo"] - $row["minimo"]) * $row["porcentaje"] + $honorarios;
        }
    }
  }

  // OBTENGO EL VALOR DEL IVA 

  $iva =0;
  $query_iva = 'select valor from variables where id=1' ; 
        
  $result_iva  = mysqli_query($db,$query_iva);

  if (isset($result_iva)){
    $iva = mysqli_fetch_assoc($result_iva)['valor'];
  }

  // OBTENGO EL VALOR DEL IVA 

  $honorarios_minimo =0;
  $query_honorarios = 'select valor from variables where id=2' ; 
        
  $result_honorarios  = mysqli_query($db,$query_honorarios);

  if (isset($result_honorarios)){
    $honorarios_minimo = mysqli_fetch_assoc($result_honorarios)['valor'];
  }

  if ($honorarios<$honorarios_minimo){
    $honorarios=$honorarios_minimo;
  }


  $json_tarifas[] = array(
    'id' => '->',
    'descripcion' => 'Sub Total de Timbres',
    'tarifa' => $total_tarifas
  );

  $json_tarifas[] = array(
    'id' => '->',
    'descripcion' => 'Sub Total de Honorarios',
    'tarifa' => $honorarios
  );

  $json_tarifas[] = array(
    'id' => '->',
    'descripcion' => 'Sub Total de IVA',
    'tarifa' => $honorarios * $iva
  );

  $json_tarifas[] = array(
    'id' => '->',
    'descripcion' => 'Costo Total -->',
    'tarifa' => $total_tarifas + ($honorarios * ($iva+1))
  );

  $jsonstring = json_encode($json_tarifas);
 
  echo $jsonstring;

?>

  