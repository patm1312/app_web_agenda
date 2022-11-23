<section>
<?php
    if (isset($_SESSION['user_id'])) {
        header('Location:index.php?seccion=home');
      }
      if (isset($_GET['sesion'])) {
        $message = "Por favor inicia sesion para agregar notas";
        echo "<p> $message;</p>";
      }
?>

<div class="box-login">
  <div class="box_login-tittle">
  <h1 class="h1-login">Login</h1>
  <span>or <a href="index.php?seccion=signup">SignUp</a></span>
  <div class="box__form__login-img">
  <img class="img-form-login" src="assets/ping.png" alt="imagen de ping">
  </div>
  
  </div>

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

  <form class="form--login" action="" method="POST">
    <input class="input--login" name="email" type="text" placeholder="Enter your email">
    <input class="input--login" name="password" type="password" placeholder="Enter your Password">
    <input class="input--login-submit" type="submit" value="Submit">
  </form>
</div>
  
</section>