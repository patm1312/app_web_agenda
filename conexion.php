<?php
//creo las variables de concexxion
// define("HOST_DB", "localhost");
// define("USER_DB", "root");
// define("PASS_DB", "admin");
// define("NAME_DB", "My_Diary");
// //hago la conexion con msqli, a mi base de datos.
// $conexion = new mysqli(
//     constant("HOST_DB"),
//     constant("USER_DB"),
//     constant("PASS_DB"),
//     constant("NAME_DB")
// );
//la direccion de la base de datos
// $direccion_bd='localhost';
// //nombre de base de datos
// $nombre_bd='My_Diary';
// $nombre_user='root';
// $password_user='admin';
// $conexion=new mysqli($direccion_bd,$nombre_user,$password_user);

//la direccion de la base de datos
$direccion_bd='localhost';
//nombre de base de datos
$nombre_bd='My_Diary';
$nombre_user='root';
$password_user='admin';
// manejo de errores
if(mysqli_connect_errno()){
  echo "fallo al conectar al host";
}
$conexion= new mysqli ($direccion_bd, $nombre_user, $password_user, $nombre_bd);
if(!conexion){
    echo "fallo";
    error_log('Connection error: ' . mysqli_connect_errno());
    exit;
}
echo mysqli_error($conexion);
 //ejecuto la consulta
$consulta = "SELECT * FROM diario_tabla";
 $resultado = mysqli_query($conexion, $consulta);

  //incluyo la conexxion

//obtengo la consulta
$consulta_destacados = "SELECT * FROM destacados";
$resultado_destacad = mysqli_query($conexion,$consulta_destacados);
?>