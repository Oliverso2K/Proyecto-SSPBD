<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $rfc = $_GET['rfc'];

	$sql = "SELECT * FROM propietarios WHERE rfc_negocio='$rfc'";
	$consulta = pg_query($conexion,$sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/d2400a49aa.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formNegocioStyles.css">
    <title>Formulario Propietario</title>
</head>

<body>

    <header>
        <div class="logo">
            <img src="Recursos/logo_blanco.png" alt="Logo SICOJA en color blanco">
            <h2 class="nombre-sicoja"> SISTEMA DE CONSULTA DE INGRESOS Y GASTOS EN LOS HOGARES DE JALISCO </h2>
        </div>
        <ul class="menu">
            <li><a href="../Home/home.php" class="">Inicio</a></li>
            <li><a href="" class="">Consulta Individual</a>
                <ul>
                    <li><a href="" class="">Ingresos</a>
                        <ul>
                            <li><a href="../IngresosTotales/ingresosTotales.php" class="">Totales</a></li>
                            <li><a href="../IngresosTransaccion/ingresosTransaccion.php" class="">Por transacción</a></li>
                        </ul>
                    </li>
                    <li><a href="" class="">Gastos</a>
                        <ul>
                            <li><a href="../GastosTotales/gastosTotales.php" class="">Totales</a></li>
                            <li><a href="../GastosTransaccion/gastosTransaccion.php" class="">Por transacción</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="" class="">Consulta por Hogar</a>
                <ul>
                    <li><a href="../ConsultaIngresosHogar/ingresosHogar.php" class="">Ingresos</a></li> 
                    <li><a href="../ConsultaEgresosHogar/egresosHogar.php" class="">Gastos</a></li> 
                </ul>
            </li>
            <li><a href="../ConsultaNegocios/consultaNegocios.php" class="">Negocios</a></li>
            <li><a href="../VentanaCensador/censar.php" class="">Soy censador</a></li>
        </ul>
    </header>

    <div class="titulo-ventana">
        <h5> Soy censador > Censar > Negocio > Propietario </h1>
            <h2> CENSAR PROPIETARIO </h2>
    </div>

    <div class="contenedor">
        <section class="contFormulario">
            <h2>Agregar Propietario </h2>
            <form action="insertarPropietario.php" method="POST">
                <input type="hidden" name="rfc" value="<?php echo $rfc?>" placeholder="ID individuo" class="input" required>
                <input type="text" name="id_persona" placeholder="ID individuo" class="input" required>
                <br></br>
                <text>Fecha inicio</text>
                <input type="date" name="fecha_inicio" class="input" required>

                <input type="submit" value="Registrar" class="botonRegistrar">
            </form>
        </section>

        <section class="tabla">
            <h2>Registros de propietarios del negocio </h2>

            <section class="contTabla">
                <table>
                    <!-- Para el encabezado de la tabla -->
                    <thead class="encabezados">
                        <tr>
                            <th>ID</th>
                            <th>ID Propietario</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Fecha inicio</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <!-- Contenido de las filas -->
                    <tbody>
                        <?php
                            while ($fila = pg_fetch_array($consulta)){
                                $id_persona = $fila['id_persona'];
                                $sql = "SELECT * FROM personas WHERE id='$id_persona'";
                                $consultaPersona = pg_query($conexion,$sql);
                                $persona = pg_fetch_array($consultaPersona);
                        ?>
                        <tr>
                            <th><?php echo $fila['id']?></th>
                            <th><?php echo $fila['id_persona']?></th>
                            <th><?php echo $persona['nombres']?></th>
                            <th><?php echo $persona['apellidos']?></th>
                            <th><?php echo $fila['fecha_inicio']?></th>
                            <th></th>
                            <th> <a class="icons" href="actualizar.php?id=<?php echo $fila['id'] ?>"><i class="fa-solid fa-pencil"></i></a></th>
                            <th> <a class="icons" href="eliminar.php?id=<?php echo $fila['id'] ?>"><i class="fa-solid fa-trash"></i></a></th>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
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