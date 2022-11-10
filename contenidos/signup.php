<section>
<?php
$message = '';


if (!empty($_POST['email']) && !empty($_POST['password'])){
    try {
    $sql = "INSERT INTO Usuario (Nombre, Apellido, Correo, password) VALUES (:nombre, :apellido, :correo, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $_POST['name']);
    $stmt->bindParam(':apellido', $_POST['apellido']);
    $stmt->bindParam(':correo', $_POST['email']);
    //para cifrar la contraseña
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    //si se ejecuto la ejecucion de la consulta
    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } 
    echo "<p> $message;</p>";
} catch (PDOException $error) {
    echo 'Falló la conexión: ' . $error->getMessage();
    $message = 'Sorry there must have been an issue creating your account';
    if(!empty($message)):
     echo "<p> $message;</p>";
    endif;
}
}
?>
<h1>SignUp</h1>
    <span>or <a href="index.php?seccion=login">Login</a></span>
   <form action="" method="POST">
      <input name="name" type="text" placeholder="Enter your name">
      <input name="apellido" type="text" placeholder="Enter your subname">
      <input name="email" type="text" placeholder="Enter your email">
      <input name="password" type="password" placeholder="Enter your Password">
      <input name="confirm_password" type="password" placeholder="Confirm Password">
      <input type="submit" value="Submit">
    </form>
</section>