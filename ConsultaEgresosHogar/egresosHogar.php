<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

	$sql = "SELECT * FROM viviendas ORDER BY id ASC";
	$consultaViviendas = pg_query($conexion,$sql);

    $sql = "SELECT * FROM personas";
	$consultaPersonas = pg_query($conexion,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="egresosHogarStyle.css">
    <title>Gastos por Hogar</title>
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
            <li><a href="./censar.html" class="">Soy censador</a></li>
        </ul>
    </header>

    <div class="titulo-ventana">
        <h5> Consulta por Hogar > Gastos por Hogar </h5>
            <h2> GASTOS POR HOGAR </h2>
    </div>
    
    <div class="contenedor">
        <section class="tabla">

            <section class="contTabla">
                <table>
                    <!-- Para el encabezado de la tabla -->
                    <thead class="encabezados">
                        <tr>
                            <th>Municipio</th>
                            <th>No. Integrantes</th>
                            <th>Gasto mensual</th>
                        </tr>
                    </thead>

                    <!-- Contenido de las filas -->
                    <tbody>
                    <?php
                            while ($fila = pg_fetch_array($consultaViviendas)){
                                $gasto = 0;
                                $id = $fila['id'];
                                $sql = "SELECT * FROM personas WHERE id_vivienda='$id'";

                                $familiares = pg_query($conexion,$sql);
                                
                                while($fila_familiar = pg_fetch_array($familiares)){
                                    $id_familiar = $fila_familiar['id'];

                                    $sql = "SELECT cantidad FROM gastos WHERE id_persona='$id_familiar'";
                                    $cantidad = pg_query($conexion,$sql);

                                    while($gasto_indv = pg_fetch_array($cantidad)){
                                        $gasto += intval($gasto_indv['cantidad']);
                                    }
                                }
                        ?>
                        <tr>
                            <?php $id_municipio = $fila['id_municipio'];
                                $sql = "SELECT * FROM municipios WHERE id='$id_municipio'";
                                $consulta_municipio = pg_query($conexion,$sql);
                                $municipio = pg_fetch_array($consulta_municipio);
                            ?>
                            <th> <?php echo $municipio['nombre']?></th>

                            <th>
                                <?php
                                $rows = pg_num_rows($familiares);
                                echo $rows
                                ?>
                            </th>

                            <th>$
                                <?php
                                echo $gasto
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