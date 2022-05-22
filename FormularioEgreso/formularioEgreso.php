<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $id_persona = $_GET['id'];

	$sql = "SELECT * FROM gastos WHERE id_persona='$id_persona'";
	$consulta = pg_query($conexion,$sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/d2400a49aa.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formEgresoStyles.css">
    <title>Formulario Egresos</title>
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
        <h5> Soy censador > Censar > Individuo > Egresos</h1>
            <h2> CENSAR EGRESOS </h2>
    </div>
    
    <?php 
        $sql = "SELECT * FROM personas WHERE id='$id_persona'";
        $consulta_persona = pg_query($conexion,$sql);
        $persona = pg_fetch_array($consulta_persona);
    ?>   

    <text class="registroNombre"> Registros de Egresos de <?php echo $persona['nombres']?> <?php echo $persona['apellidos']?></text>

    <div class="contenedor">
        <section class="contFormulario">
            <h2>Agregar Egreso </h2>
            <form action="insertar.php?id=<?php echo $persona['id'] ?>" method="POST">
                <input type="number" name="cantidad" min="1" placeholder="Cantidad" class="input" required>
                <text>Servicio en el que se empleó</text>
                <select name="servicio" class="input" requeried>
                    <option value="agua">Agua</option>
                    <option value="arrendamiento">Arrendamiento</option>
                    <option value="comestibles">Comestibles</option>
                    <option value="comunicaciones">Comunicaciones</option>
                    <option value="electricidad">Electricidad</option>
                    <option value="entretenimiento">Entretenimiento</option>
                    <option value="gas">Gas</option>
                    <option value="mercancía">Mercancía</option>
                    <option value="salud">Salud</option>
                    <option value="transporte">Transporte</option>
                    <option value="turismo">Turismo</option>
                </select>
                <text>Fecha del egreso</text>
                <input type="date" name="fecha" class="input" required>

                <input type="submit" value="Registrar" class="botonRegistrar">
            </form>
        </section>

        <section class="tabla">
            <div class="buscar">
                <input type="text" placeholder="Buscar por tipo de servicio" requeried>
                <div class="btnBuscar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            <section class="contTabla">
                <table>
                    <!-- Para el encabezado de la tabla -->
                    <thead class="encabezados">
                        <tr>
                            <th>ID</th>
                            <th>Cantidad</th>
                            <th>Servicio</th>
                            <th>Fecha</th>
                            <th></th><th>
                        </tr>
                    </thead>

                    <!-- Contenido de las filas -->
                    <tbody>
                        <?php
                            while ($fila = pg_fetch_array($consulta)){
                        ?> 
                        <tr>
                            <th><?php echo $fila['id']?></th>
                            <th><?php echo $fila['cantidad']?></th>
                            <th><?php echo $fila['servicio']?></th>
                            <th><?php echo $fila['fecha']?></th>
                            <th> <a class="icons" href="#" id=''><i class="fa-solid fa-pencil"></i></a></th>
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