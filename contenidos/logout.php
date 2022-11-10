<?php
  session_start();
//eliminar la sesion
  session_unset();
//destruir la session
  session_destroy();

  header('Location: index.php?seccion=home');
?>