<section>
<?php
session_start();
    if (isset($_SESSION['user_id'])) {
        header('Location:index.php?seccion=home');
      }
      if (isset($_GET['sesion'])) {
        $message = "Por favor inicia sesion para agregar notas";
        echo "<p> $message;</p>";
      }
?>
<h1>Login</h1>
  <span>or <a href="index.php?seccion=signup">SignUp</a></span>
<?php
    if (!empty($_POST['email']) && !empty($_POST['password'])){
        try {
        $records = $conn->prepare('SELECT idUsuario, Nombre, Apellido, correo, password FROM Usuario WHERE Correo = :email');
       $records->bindParam(':email', $_POST['email']);
       $records->execute();
       //fect assoc es un array asociativo que almacena los datos de un usuario
       $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = '';

  if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
    //almaceno el id del usuario de la consulta en la sesion.
    $_SESSION['user_id'] = $results['idUsuario'];
    header("Location: index.php?seccion=home");
  } else {
    $message = 'Sorry, those credentials do not match';
    echo "<p> $message;</p>";
  }
} catch (PDOException $error) {
    $message = 'Sorry there must have been an issue creating your account';
    echo 'Falló la conexión: ' . $error->getMessage();
    if(!empty($message)):
     echo "<p> $message;</p>";
    endif;
}
    }

?>

  <form action="" method="POST">
    <input name="email" type="text" placeholder="Enter your email">
    <input name="password" type="password" placeholder="Enter your Password">
    <input type="submit" value="Submit">
  </form>
</section>