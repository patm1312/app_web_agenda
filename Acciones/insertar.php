<?php
include('conexion.php');
    if(isset($_POST['texto'])){
        $texto = $_POST['texto'];
        $apellido = $_POST['apellido'];
        $descripcion = $_POST['descripcion'];


        //insertar datos usando bim params con sentencias preparadas, para vincular los parametros:
        try {
        $query = "INSERT INTO informacion_usuarios(nommbre, apellido, descripcion)values(:nombre, :apellido, :descripcion)";
        //preparar la consulta:
        $stm = $pdo->prepare($query3);
        //vincular los dats con bimparams(recomendado):
        //primer argumento es el argumento  que especifico  en la consulta, el segundo parametro es la variable recibida  en el formuario, y  el tercer parametro es el tipo  de dato(PDO::PARAM_STR(es dato string)):
        $stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stm->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $stm->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    } catch (PDOException $error) {
        echo 'Falló la conexión: ' . $error->getMessage();
    }

        //ejecutar la consulta:
        $stm->execute();

    }else{
        
    }
?>