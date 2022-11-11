<article class="article__diary">
        <div class="circulo circulo-uno">
        </div>
        <div class="circulo circulo-dos">
        </div>
        <div class="circulo circulo-tres">
        </div>
        <div class="triangulo">
            
        </div>
        <div class="error error_hidden" id="error">
        </div>
            <h1 class="h1">Diario:</h1>
            <div class="container_diario">
            <form class="article__diary-form" name="myform" action="datos.php" method="POST" id="form">
                <section class="diary__section__notas">
                    <div class="diary__section__notas-tittle">
                        <h2 class="h2" id="botonprueba">Notas:</h2>
                        <div class="diary__section__notas-add">
                        <textarea class="diary__section-textarea" name="texto" id="texto" cols="30" rows="5" placeholder="Escribe tu nota aqui..." ></textarea>
                        <button id="agregar" class="boton_an bottons-agregar-one" name="agregar" type="submit">Agregar Nota</button>
                         </div>

                         <div id="container_registros" class="container_registros">
                             <?php
                                session_start();
                                //si la pagina se abre por primera vez el  valor de la session es de 1, o la pagina 1.
                                if(!isset($_SESSION['item'])){$_SESSION['item'] = 1;}else{$_SESSION['item']=$_SESSION['item'];}
                                //el valor de la pagina la almaceno en una variable
                                $pagina = $_SESSION['item'];
                                if(isset($_SESSION['user_id'])){
                                    //  require_once 'conexion.php';
                                    //  //ejecuto la consulta
                                    $consulta = "SELECT * FROM Nota";
                                    $resultado = mysqli_query($conexion, $consulta);
                                     $registros_filas = mysqli_num_rows($resultado);

                                     //el numero de registros que quiero que me muestre en cada pagina
                                     $num_reg = 3;
                                     //desde que numero de registro quiero empezar aconsultar
                                     $num_pagina = (($pagina-1 )*$num_reg);
                                     //realizo la consulta y la guardo, Esto cambiara simbolos como <>"' a entidades HTML, el resultado de esos 4 simbolos seria el siguiente: &lt;&gt;&quot;&apos; asi que de esta forma, el atacante tendra menos posibilidades de hacerse con tu informacion :) 
                                     $id_usuario = htmlentities($_SESSION['user_id'],ENT_QUOTES,'utf-8');
                                $consulta_limitada = "SELECT * FROM Nota WHERE Usuario_idUsuario = {$id_usuario} LIMIT $num_pagina,$num_reg";
                                echo $consulta_limitada;
                                    //  $consulta_limitada .= "WHERE Usuario_idUsuario = $_SESSION['user_id']";
                                
                                //ejecuto la consulta
                                $resultado_limit = mysqli_query($conexion, $consulta_limitada);
                                }
                                    
                                //imprimoi la consulta en la tabla                             
                                echo "<div id='box-table' class='box-table'>";
                                //cuantas filas tiene la consulta limitada
                                $registros_filas = mysqli_num_rows($resultado_limit);
                                echo "<input id='elemento' name='elemento' type='hidden' value='$registros_filas'>";
                                echo "<table id=''tabla_uno class='tabla'>";
                                //si no hay ningun registro en la base de datos
                                if(mysqli_num_rows($resultado)==0){
                                    echo "<tr class='tr'>";
                                    echo "<td class='td'>Tus notas apareceran aqui...</td>";
                                    echo"</tr>";
                                }else{
                                    while($fila=mysqli_fetch_row($resultado_limit)){
                                           $id = $fila[0];
                                           $fecha = $fila[2];
                                           $nota = $fila[1];
                                           $date = date_create($fecha);
                                           $new_hoy = date_format($date, "F j, Y, g:i a");
                                              echo "<tr class='tr'>";
                                              echo "<td class='td'><span class='date-span'> <input type='checkbox' name='dnis[]' value='$id' class='identificador'>$new_hoy</span>$nota</td>";
                                              echo"</tr>"; 
                                        }  
                                }
                                 echo "</table>"; 
                                 echo "</div>";
                            ?>

                         </div>
                        
                     <div class="article__diary-bottons">
                        <div  class="diary-bottons-option">
                        <button data-show class="diary-bottons-agregar bottons-agregar-two" name="eliminar">Eliminar Nota </button>
                        <button data-show class="diary-bottons-agregar bottons-agregar-dos" name="eliminar_todo">Eliminar Todo </button>
                        <button data-show class="diary-bottons-agregar bottons-agregar-three destacar" name="destacar" >Destacar Nota</button>
                        </div>
                     </div>
                    </div>
                    
                      <?php
                      //para imprimir los items de paginacion
                    //   require_once 'conexion.php';
                    //   //ejecuto la consulta
                    //   $consulta = "SELECT * FROM diario_tabla";
                    //   $resultado = mysqli_query($conexion, $consulta);
                      $registros_filas = mysqli_num_rows($resultado);
                      //divido todos los registro entre 3 para saber cuantod items numericos debo imprimir para la paginacion, siendo que cada uino muestre de a 3 registros
                      $numero_items =  ceil($registros_filas/3);
                      session_start();
                      $num_item = $_SESSION['item'];
                      //input tipo hidden que almacena el numero de item para la paginacion que le di clikc, para luego acceder a el desde javascript
                      echo "<input id='input_item' type='hidden' value='$num_item'>";
                           
                               echo "<div class='footer_item'>";
                               for ($i=1; $i <= $numero_items ; $i++) { 
                                   echo "<div class='item_box'>";
                                   //este valoir de el value lo envia a datos.php y lo almacena en  la session para luego usar ese valor en javascript y la base de datos para saber q pagina debe mostrar y sus datos.
                                   echo "<input id='enlace' type='submit' name='items' value='$i' class='enlace'>";
                                   echo "</div>";   
                               }
                               echo "</div>";
                           
                       ?>
                </section>
                <section class="diary__section__destacados">
                    <h2 class="h2 h2-size">Notas Destacadas:</h2>
                    <?php
                        // //incluyo la conexxion
                        // require_once 'conexion.php';
                        // //ejecuto la consulta
                        // //obtengo la consulta
                        // $consulta_destacados = "SELECT * FROM destacados";
                        // $resultado_destacad = mysqli_query($conexion, $consulta_destacados);
                        //guardo en variable el numero de filas que tiene la tabla de destacadaso de la bd.
                        $registros_filas_dest = mysqli_num_rows($resultado_destacad);
                        //en el inpuit hidden, guardo la variable anterior para lerla desde javascript
                        echo "<input id='elemento_destacados' name='elemento' type='hidden' value='$registros_filas_dest'>";
                        //si no hay ningun registro, imprimo una descripcion
                        if(mysqli_num_rows($resultado_destacad)==0){
                            echo "<div class='box-table'>";
                            echo "<table id='tabla_dos' class='tabla'>";
                            echo "<tr class='tr'>";
                            echo "<td class='td'>Tus notas favoritas apareceran aqui...</td>";
                            echo"</tr>";
                            echo "</table>"; 
                            echo "</div>";
                        }else{
                            echo "<div class='box-table'>";
                        echo "<table class='tabla'>";
                         while($fila=mysqli_fetch_row($resultado_destacad)){
                            $id = $fila[0];
                            $fecha = $fila[1];
                            $nota = $fila[2];
                            $date = date_create($fecha);
                            $new_hoy = date_format($date, "F j, Y, g:i a");
                               echo "<tr class='tr'>";
                               echo "<td class='td'><span class='date-span'> <input class='identificador' type='checkbox' name='dnis[]' value='$id'>$new_hoy</span>$nota</td>";
                                echo"</tr>";
                        }
                        echo "</table>"; 
                        echo "</div>";
                        }
                        unset($_SESSION['item']);
                    ?>
                    <button data-show-dest class="diary-bottons-agregar bottons-agregar-three quitar" name="quitar">Quitar Nota</button>
                </section>
            </form>
            </div>
        </article>
        <article class="article__notes">
            <section class="notes__section">

            </section>
        </article>