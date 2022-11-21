<section>
<?php
$message = '';


if (!empty($_POST['email']) && !empty($_POST['password'])){
  $user_exist = "";
    try {
    $sql = "INSERT INTO usuario (Nombre, Apellido, Correo, password) VALUES (:nombre, :apellido, :correo, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $_POST['name']);
    $stmt->bindParam(':apellido', $_POST['apellido']);
    $stmt->bindParam(':correo', $_POST['email']);
    //para cifrar la contraseña
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    //hago consulta a la bd para saber si el correo que me envio, ya esta registrado en la bd:
    $query2 = "SELECT * FROM usuario WHERE Correo = :correo";
    $stm_veri = $conn->prepare($query2);
    $stm_veri->execute([':correo'=>$_POST['email']]);
    $stm_veri->execute();
    $user = $stm_veri->fetchAll();
    $user_exist = count($user);
    echo $user_exist;
    if($user_exist<1){
      if ($stmt->execute()) {
        $message = 'Successfully created new user';
        echo "<p> $message;</p>";
      }
    }else{
      $message = 'Hay un usuario duplicado';
      echo "<p> $message;</p>";
    }
    //si se ejecuto la ejecucion de la consulta
    
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