<?php

function obtener_actos($id) {

    try{
        // importar las credenciales
            require 'database.php';
        // Realizar la consulta

        $sql = 'select id_acto as id, acto_descripcion as valor from notario.acto where id_acto = '.$id.';';

        $consulta = mysqli_query($db,$sql);

        return $consulta;

        // Cerrar la Cnn 

        mysqli_close($db);

    }catch (\Throwable $th ) {
            var_dump ($th);
    };


};

function obtener_registros() {

    try{
        // importar las credenciales
            require 'database.php';
        // Realizar la consulta

        $sql = 'select id_registro as id,registro_descripcion as valor from notario.registro;';

        $consulta = mysqli_query($db,$sql);

        return $consulta;

        // Cerrar la Cnn 

        mysqli_close($db);

    }catch (\Throwable $th ) {
            var_dump ($th);
    };


};

function hola(){

    echo 'hola';
}