<?php
    include('conexion.php');
    if(isset($_GET['seccion'])){
        $seccion = $_GET['seccion'];
    }else{
        $seccion = "home";
    } 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Note</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <header class="header">
       <nav class="nav">  
               <a class="nav_menu" href="index.php?seccion=home">Agenda</a>
               <li class="nav__menu nav__menu-color">Notas</li>
           <ul>
           <?php if(!isset($_SESSION['user_id'])){?>
           <li><a href="index.php?seccion=login">Login</a></li>
           <li><a href="index.php?seccion=signup">SignUp</a></li>
           </ul>
           <?php
           }else{    
            try {
                $records = $conn->prepare('SELECT Nombre FROM Usuario WHERE idUsuario = :id');
                $records->bindParam(':id', $_SESSION['user_id']);
                $records->execute();
                $results = $records->fetch(PDO::FETCH_ASSOC);
                $user = null;     
                if (count($results) > 0) {
                      $user = $results['Nombre'];
                }
            } catch (PDOException $error) {
                $message = 'user not available: ' . $error->getMessage();
                if(!empty($message)):
                echo "<p> $message;</p>";
                endif;
            }
           ?>

           <a href="index.php?seccion=#"><?php echo $user; ?></a>
           <a href="index.php?seccion=logout">LogOut</a>
           <?php
       };
           ?>
       </nav>
    </header>
    <main class="main">
        <?php
            switch ($seccion) {
                case 'home': include('contenidos/home.php');
                    break;
                case 'login': include('contenidos/login.php');
                    break;
                case 'signup': include('contenidos/signup.php');
                    break;
                case 'logout': include('contenidos/logout.php');
                    break;
                default:
                echo "<p class='error'>la seccion $seccion solicitada no esta disponible</p>";
				include('contenidos/home.php');
					break;
                    break;
            }

        ?>
    </main>
    <footer class="footer">
        <p class></p>
        <p></p>
    </footer>
    <script src="datos.js"></script>
</body>
</html>