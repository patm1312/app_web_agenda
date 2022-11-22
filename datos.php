<?php
session_start();
$messahe = "";
include('conexion.php');
//recojo los datos
$texto = $_POST['texto'];
// Zona horarias
date_default_timezone_set("America/Bogota");
//fecha para publicarla en las notas, podria descargarla de la db, y  cambiar   este formato, $hoy = date("F j, Y, g:i a"); $date = date_create($hoy);$new_hoy = date_format($date, 'Y-m-d H:i:s');

$hoy_prueba = date("Y-m-d H:i:s");
//incluyo la conexxion
//si le di clikc a un boton de items de paginacion
if(isset($_POST['items'])){
    //creo una sesion para alacenar la variable del numero de pagina
    $_SESSION['item'] = $_POST['items'];
    header("Location: index.php?seccion=home");
}else{
    echo "";
}

//si le di click al boton aagregar.
if(isset($_POST['agregar'])){
    echo "existe agregar";
    //si el campo  esta vacio
    if(empty($_POST['texto'])){
        
    }else{
        if(isset($_SESSION['user_id'])){
            //cuento el numero de filas que tiene la base de datos para sumar y agregar el nuevo id a la base de datos.
        try {
        // $consulta = "SELECT * FROM Nota";
        // $resultado = mysqli_query($conexion, $consulta);
        // $filas = mysqli_num_rows($resultado);
        // $filas++;
        $favorito = 0;
        //inserto nueva consulta
        // $sql .= "INSERT INTO Nota (Nota, Fecha, Usuario_idUsuario, Favorito)";
        // $sql .= "VALUES ('". $texto . "', ";
        // $sql .= "'". $hoy_prueba . "','". $_SESSION['user_id'] . "', '". $favorito . "');";
        // mysqli_query($conexion, $sql);


        //pdo
        $query3 = "INSERT INTO Nota(Nota, Fecha, Usuario_idUsuario, Favorito)values(:nota, :fecha, :Usuario_idUsuario, :favorito)";
        $stm = $conn->prepare($query3);
        $stm->bindParam(':nota', $texto, PDO::PARAM_STR);
        $stm->bindParam(':fecha', $hoy_prueba);
        $stm->bindParam(':Usuario_idUsuario', $_SESSION['user_id']);
        $stm->bindParam(':favorito', $favorito);
        //ejecutar la consulta:
        $stm->execute();
        } catch (\Throwable $th) {
            echo $th;
            echo "error de la conexion";
        }
    }else{
        header('Location:index.php?seccion=login&sesion=false');
    }
        }
        
}
if(!isset($_POST['eliminar'])){
}else{
    if(!empty($_POST['dnis'])){
        foreach($_POST['dnis'] as $seleccion){
            $sql_erase = "DELETE FROM diario_tabla WHERE id = '$seleccion';";
            mysqli_query($conexion, $sql_erase);
            //hago consulta a la tabla de destacados para eliminar
            $consulta_dest = "SELECT * FROM destacados";
            $resultado_dest = mysqli_query($conexion, $consulta_dest);
            //numero de destacados
            $filas_destacados = mysqli_num_rows($resultado_dest);
            if(!empty(mysqli_num_rows($resultado))){
                $sql_erase = "DELETE FROM destacados WHERE id = '$seleccion';";
                mysqli_query($conexion, $sql_erase);
            }else{
            }
        }
    }
}
if(isset($_POST['eliminar_todo'])){
    $sql_erase_todo = "DELETE FROM diario_tabla;";
    mysqli_query($conexion, $sql_erase_todo);
    $sql_erase_todo = "DELETE FROM destacados;";
    mysqli_query($conexion, $sql_erase_todo);
}
//si le di en destacar
if(!isset($_POST['destacar'])){
}else{
    if(!empty($_POST['dnis'])){
        $favorito = 1;
        //iteroi sobre los ids seleccionados
        foreach($_POST['dnis'] as $seleccion){
            echo $seleccion;
            $query_actualizar = "UPDATE nota set Favorito=? WHERE idNota=?";
            $stm = $conn->prepare($query_actualizar);
            $stm->bindParam(1, $favorito);
            $stm->bindParam(2, $seleccion);
            $stm->execute();
            //slecciono de la bd, los registros con eses id seleccionados
            // $consulta_destacados = "SELECT * FROM diario_tabla WHERE id='$seleccion'" ;
            // $resultado_destacados = mysqli_query($conexion, $consulta_destacados);
            // //desempaqueto la consulta
            // while($fila_dest=mysqli_fetch_row($resultado_destacados)){
            //     //inserto nueva consulta con los datos de la consulta en la nueva tabla destacados
            //     $sql_dest .= "INSERT INTO destacados ";
            //     $sql_dest .= "VALUES ('". $fila_dest[0] . "', ";
            //     $sql_dest .= "'". $fila_dest[1] . "','". $fila_dest[2] . "');";
            //     echo "<br>";
            //     echo "<br>";
            //     mysqli_query($conexion, $sql_dest);
            // }
            // $sql_dest = "";
        }
    }
}
if(!isset($_POST['quitar'])){
}else{
    if(!empty($_POST['dnis'])){
        foreach($_POST['dnis'] as $seleccion){
            $sql_erase = "DELETE FROM destacados WHERE id = '$seleccion';";
            mysqli_query($conexion, $sql_erase);
    }
}
}
header('Location:index.php');

?>