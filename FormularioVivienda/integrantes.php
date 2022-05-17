<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $id_vivienda = $_GET['id'];

    $sql = "SELECT * FROM personas WHERE id_vivienda ='$id_vivienda'";
    $consulta = pg_query($conexion,$sql);

    function calculaedad($fechanacimiento){
        list($ano,$mes,$dia) = explode("-",$fechanacimiento);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
          $ano_diferencia--;
        return $ano_diferencia;
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <script src="https://kit.fontawesome.com/d2400a49aa.js" crossorigin="anonymous"></script>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="formViviendaStyles.css">
        <title>Integrantes</title>
    </head>

    <body>
    <header>
        <div class="logo">
            <img src="Recursos/logo_blanco.png" alt="Logo SICOJA en color blanco">
            <h2 class="nombre-sicoja"> SISTEMA DE CONSULTA DE INGRESOS Y GASTOS EN LOS HOGARES DE JALISCO </h2>
        </div>
        <ul class="menu">
            <li><a href="" class="">Inicio</a></li>
            <li><a href="" class="">Consulta Individual</a>
                <ul>
                    <li><a href="" class="">Ingresos</a>
                        <ul>
                            <li><a href="" class="">Totales</a></li>
                            <li><a href="" class="">Por transacción</a></li>
                        </ul>
                    </li>
                    <li><a href="" class="">Gastos</a>
                        <ul>
                            <li><a href="" class="">Totales</a></li>
                            <li><a href="" class="">Por transacción</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="" class="">Consulta por Hogar</a>
                <ul>
                    <li><a href="" class="">Ingresos</a></li> 
                    <li><a href="" class="">Gastos</a></li> 
                </ul>
            </li>
            <li><a href="" class="">Negocios</a></li>
            <li><a href="../VentanaCensador/censar.php" class="">Soy censador</a></li>
        </ul>
    </header>

    <div class="titulo-ventana">
        <h5> Soy censador > Censar > Vivienda > Integrantes</h1>
            <h2>INTEGRANTES </h2>
    </div>

    <div class="contenedor">
        <section class="tabla">
            <h2>Miembros de la Vivienda </h2>

            <section class="contTabla">
                <table>
                    <!-- Para el encabezado de la tabla -->
                    <thead class="encabezados">
                        <tr>
                            <th>ID</th>
                            <th>CURP</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Género</th>
                            <th>Edad</th>
                            <th>Estado civil</th>
                            <th></th>
                        </tr>
                    </thead>

                    <!-- Contenido de las filas -->
                    <tbody>
                            <?php
                                while ($fila = pg_fetch_array($consulta)){
                                    switch($fila['estado_civil']){
                                        case 'S': $edoCivil = 'Soltero'; break;
                                        case 'C': $edoCivil = 'Casado'; break;
                                        case 'U': $edoCivil = 'Unión Libre'; break;
                                        case 'V': $edoCivil = 'Viudo'; break;
                                    }
                            ?>
                        <tr>
                            <th><?php echo $fila['id']?></th>
                            <th><?php echo $fila['curp']?></th>
                            <th><?php echo $fila['nombres']?></th>
                            <th><?php echo $fila['apellidos']?></th>
                            <th><?php echo $fila['genero']?></th>
                            <th> <?php echo calculaedad($fila['fecha_nacimiento'])?></th>
                            <th> <?php echo $edoCivil?></th>
                            <th></th>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </section>

            <section class='regresar'>
                <button class="botonRegistrar">
                    <a href="../FormularioVivienda/formularioVivienda.php"> Regresar </a>
                </button>
            </section>
        </section>
    </div>

    <footer>
        <div class="contFooter">
            <div class="infoFooter">
                <p>Proyecto Final - Seminario de Solución de Problemas de Bases de Datos</p>
            </div>

            <div class="copyright">
                <p>SICOJA © 2022</p>
            </div>
        </div>
    </footer>

    </body>

</html>