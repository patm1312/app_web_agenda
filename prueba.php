<?php
session_start();
//si le di click al boton aagregar.
if(isset($_POST['agregar'])){
    //si el campo  esta vacio
    if(empty($_POST['texto'])){
        echo "<p>Por favor introduce tu nota</p>";
    }else{
        //recojo los datos
        $texto = $_POST['texto'];
        // Zona horarias
        date_default_timezone_set("America/Bogota");
        //fecha para publicarla en las notas, podria descargarla de la db, y  cambiar   este formato, $hoy = date("F j, Y, g:i a"); $date = date_create($hoy);$new_hoy = date_format($date, 'Y-m-d H:i:s');

        
        $hoy_prueba = date("Y-m-d H:i:s");
        //incluyo la conexxion
        require_once 'conexion.php';
        //ejecuto la consulta
        $consulta = "SELECT * FROM diario_tabla";
        $resultado = mysqli_query($conexion, $consulta);
        //cuento el numero de filas que tiene la base de datos para sumar y agregar el nuevo id a la base de datos.
        $filas = mysqli_num_rows($resultado);
        $filas++;
        //inserto nueva consulta
        $sql .= "INSERT INTO diario_tabla ";
        $sql .= "VALUES ('". $filas . "', ";
        $sql .= "'". $hoy_prueba . "','". $texto . "');";
        mysqli_query($conexion, $sql);
    }
}

?>