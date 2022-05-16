<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

	$sql = "SELECT * FROM personas ORDER BY id ASC";
	$consultaPersonas = pg_query($conexion,$sql);

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="IngresosTotalesStyle.css">
    <title>Ingresos Individuales Totales</title>
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
        <h5> Consulta Individual > Ingresos individuales totales </h5>
            <h2> INGRESOS INDIVIDUALES TOTALES </h2>
    </div>
    
    <div class="contenedor">
        <section class="tabla">

            <section class="contTabla">
                <table>
                    <!-- Para el encabezado de la tabla -->
                    <thead class="encabezados">
                        <tr>
                            <th>Edad</th>
                            <th>Género</th>
                            <th>Estado Civil</th>
                            <th>Municipio</th>
                            <th>Propietario de Negocio</th>
                            <th>Ingreso Total</th>
                        </tr>
                    </thead>

                    <!-- Contenido de las filas -->
                    <tbody>
                    <?php
                        while ($fila = pg_fetch_array($consultaPersonas)){

                            $id_vivienda = $fila['id_vivienda'];
                            $sql = "SELECT * FROM viviendas WHERE id='$id_vivienda'";
                            $consulta_vivienda = pg_query($conexion,$sql);
                            $vivienda = pg_fetch_array($consulta_vivienda);

                            $id_municipio = $vivienda['id_municipio'];
                            $sql = "SELECT * FROM municipios WHERE id='$id_municipio'";
                            $consulta_municipio = pg_query($conexion,$sql);
                            $municipio = pg_fetch_array($consulta_municipio);

                            $ingreso = 0;
                            $id_persona = $fila['id'];

                            $sql = "SELECT cantidad FROM ingresos WHERE id_persona='$id_persona'";
                            $cantidad = pg_query($conexion,$sql);

                            while($ingreso_indv = pg_fetch_array($cantidad)){
                                $ingreso += intval($ingreso_indv['cantidad']);
                            }
                            
                            $sql = "SELECT * FROM propietarios WHERE id_persona='$id_persona'";
                            $propietario = pg_query($conexion,$sql);

                            if(pg_num_rows($propietario) > 0){
                                $es_propietario = 'Sí';
                            }else{
                                $es_propietario = 'No';
                            }

                            switch($fila['estado_civil']){
                                case 'S': $edoCivil = 'Soltero'; break;
                                case 'C': $edoCivil = 'Casado'; break;
                                case 'U': $edoCivil = 'Unión Libre'; break;
                                case 'V': $edoCivil = 'Viudo'; break;
                            }
                        ?>
                        <tr>
                            <th> <?php echo calculaedad($fila['fecha_nacimiento'])?></th>
                            <th> <?php echo $fila['genero']?></th>
                            <th> <?php echo $edoCivil?></th>
                            <th> <?php echo $municipio['nombre']?></th>
                            <th>
                                <?php
                                echo $es_propietario
                                ?>
                            </th>
                            <th>$
                                <?php
                                echo $ingreso
                                ?>
                            </th>
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