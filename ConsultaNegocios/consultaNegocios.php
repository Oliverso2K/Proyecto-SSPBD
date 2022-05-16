<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

	$sql = "SELECT * FROM negocios ORDER BY nombre ASC";
	$consulta = pg_query($conexion,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="consultaNegociosStyle.css">
    <title>Censar</title>
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
        <h5> Negocios </h5>
            <h2> NEGOCIOS </h2>
    </div>
    
    <div class="contenedor">
        <section class="tabla">

            <section class="contTabla">
                <table>
                    <!-- Para el encabezado de la tabla -->
                    <thead class="encabezados">
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo de Negocio</th>
                            <th>No. Empleados</th>
                            <th>Servicio</th>
                            <th>Ingreso mensual</th>
                        </tr>
                    </thead>

                    <!-- Contenido de las filas -->
                    <tbody>
                    <?php
                            while ($fila = pg_fetch_array($consulta)){
                        ?>
                        <tr>
                            <th><?php echo $fila['nombre']?></th>
                            <th><?php echo $fila['tipo']?></th>
                            <th><?php echo $fila['no_empleados']?></th>
                            <th><?php echo $fila['servicio']?></th>
                            <th>$<?php echo $fila['ingreso_mensual']?></th>
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