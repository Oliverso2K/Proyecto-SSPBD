<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    if(!isset($_POST['buscar'])){
        $_POST['buscar'] = '';
    }

	$sql = "SELECT * FROM viviendas";
	$consulta = pg_query($conexion,$sql);

    $sql = "SELECT * FROM municipios ORDER BY nombre ASC";
    $consulta2 = pg_query($conexion,$sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/d2400a49aa.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formViviendaStyles.css">
    <title>Formulario Vivienda</title>
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
        <h5> Soy censador > Censar > Vivienda</h1>
            <h2> CENSAR VIVIENDA </h2>
    </div>

    <div class="contenedor">
        <section class="contFormulario">
            <h2>Agregar Vivienda </h2>
            <form action="insertar.php" method="POST">

                <input type="text" name="dirección" placeholder="Dirección" class="input" required>
                <input type="text" name="colonia" placeholder="Colonia" class="input" required>
                <select name="id_municipio" class="input">
                    <?php
                        while ($filaMunicipio = pg_fetch_array($consulta2)){
                    ?>
                    <option value="<?php echo $filaMunicipio['id']?>"> <?php echo $filaMunicipio['nombre']?> </option>
                    <?php
                        }
                    ?>
                </select>

                <input type="submit" value="Registrar" class="botonRegistrar">
           
            </form>
        </section>

        <section class="tabla">
            <h2>Registros de Viviendas </h2>

            <div class="buscar">
                <form action="formularioVivienda.php" method="POST">
                    <input type="text" name="buscar" id="buscar" value="<?php echo $_POST["buscar"]?>" placeholder="Buscar por dirección" requeried>
                    <input class="btnBuscar" type="submit" name="enviar" value="Buscar">
                    <label><span class="fa-solid fa-magnifying-glass"></label>
                    </input>
                    <?php
                        if($_POST['buscar'] == ''){
                            $_POST['buscar'] = ' ';
                        }
                        $aKeyword = explode(" ", $_POST['buscar']);

                        if($_POST["buscar"] == ''){
                            $query = "SELECT * FROM viviendas";
                        }else{
                            $query = "SELECT * FROM viviendas";

                            if($_POST["buscar"] != ''){
                                $query .= " WHERE dirección LIKE '%".$aKeyword[0]."%'";

                                for($i = 1; $i < count($aKeyword); $i++){
                                    if(!empty($aKeyword[$i])){
                                        $query .= "OR dirección LIKE '%".$aKeyword[$i]."%'"; 
                                    }
                                }
                            }
                            $query .= "ORDER BY id ASC";
                        }

                        $consulta = pg_query($conexion,$query);
                    ?>
                </form>
            </div>

            <section class="contTabla">
                <table>
                    <!-- Para el encabezado de la tabla -->
                    <thead class="encabezados">
                        <tr>
                            <th>ID</th>
                            <th>Dirección</th>
                            <th>Colonia</th>
                            <th>Municipio</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <!-- Contenido de las filas -->
                    <tbody>
                        <?php
                            while ($fila = pg_fetch_array($consulta)){
                        ?>
                        <tr>
                            <th><?php echo $fila['id']?></th>
                            <th><?php echo $fila['dirección']?></th>
                            <th><?php echo $fila['colonia']?></th>
                            <?php $id_municipio = $fila['id_municipio'];
                                $sql = "SELECT * FROM municipios WHERE id='$id_municipio'";
                                $consulta_municipio = pg_query($conexion,$sql);
                                $municipio = pg_fetch_array($consulta_municipio);
                            ?>
                            <th> <?php echo $municipio['nombre']?></th>
                            <th></th>
                            <th> <a class="icons" href="actualizar.php?id=<?php echo $fila['id'] ?>"><i class="fa-solid fa-pencil"></i></a></th>
                            <th> <a class="icons" href="integrantes.php?id=<?php echo $fila['id'] ?>"><i class="fa-solid fa-eye"></i></a></th>
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