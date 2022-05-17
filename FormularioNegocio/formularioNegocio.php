<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    if(!isset($_POST['buscar'])){
        $_POST['buscar'] = '';
    }

	$sql = "SELECT * FROM negocios";
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
    <link rel="stylesheet" href="formNegocioStyles.css">
    <title>Formulario Negocios</title>
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
        <h5> Soy censador > Censar > Negocio</h1>
            <h2> CENSAR NEGOCIO </h2>
    </div>

    <div class="contenedor">
        <section class="contFormulario">
            <h2>Agregar Negocio </h2>
            <form action="insertar.php" method="POST">

                <input type="text" name="nombre" placeholder="Nombre del Negocio" class="input" required>
                <input type="text" name="rfc" placeholder="RFC" class="input" required>

                <text>Tipo de Negocio</text>
                <select name="tipo" class="input" requeried>
                    <option value="Agrónomo">Agrónomo</option>
                    <option value="Automotriz">Automotriz</option>
                    <option value="Confitería">Confitería</option>
                    <option value="Comercio">Comercio</option>
                    <option value="Computación">Computación</option>
                    <option value="Farmacéutica">Farmacéutica</option>
                    <option value="Industrial">Industrial</option>
                    <option value="Manufactura">Manufactura</option>
                    <option value="Telecomunicaciones">Telecomunicaciones</option>
                </select>

                <text>Servicio que ofrece</text>
                <select name="servicio" class="input" requeried>
                    <option value="Agua">Agua</option>
                    <option value="Arrendamiento">Arrendamiento</option>
                    <option value="Comestibles">Comestibles</option>
                    <option value="Comunicaciones">Comunicaciones</option>
                    <option value="Electricidad">Electricidad</option>
                    <option value="Entretenimiento">Entretenimiento</option>
                    <option value="Gas">Gas</option>
                    <option value="Mercancía">Mercancía</option>
                    <option value="Salud">Salud</option>
                    <option value="Transporte">Transporte</option>
                    <option value="Turismo">Turismo</option>
                </select>
                <input type="number" name="año_apertura" min="1850" max="2022" placeholder="Año de apertura" class="input" required>
                <text>Ubicación</text>
                <select name="id_municipio" class="input">
                    <?php
                        while ($filaMunicipio = pg_fetch_array($consulta2)){
                    ?>
                    <option value="<?php echo $filaMunicipio['id']?>"> <?php echo $filaMunicipio['nombre']?> </option>
                    <?php
                        }
                    ?>
                </select>
                <input type="number" name="no_empleados" min="1" placeholder="Número de empleados" class="input" required>
                <input type="number" name="ingreso_mensual" min="500" placeholder="Ingreso mensual" class="input" required>

                <input type="submit" value="Registrar" class="botonRegistrar">
           
            </form>
        </section>

        <section class="tabla">
            <h2>Registros de Negocios </h2>

            <div class="buscar">
            <form action="formularioNegocio.php" method="POST">
                    <input type="text" name="buscar" id="buscar" value="<?php echo $_POST["buscar"]?>" placeholder="Buscar por nombre" requeried>
                    <input class="btnBuscar" type="submit" name="enviar" value="Buscar">
                    <label><span class="fa-solid fa-magnifying-glass"></label>
                    </input>
                    <?php
                        if($_POST['buscar'] == ''){
                            $_POST['buscar'] = ' ';
                        }
                        $aKeyword = explode(" ", $_POST['buscar']);

                        if($_POST["buscar"] == ''){
                            $query = "SELECT * FROM negocios";
                        }else{
                            $query = "SELECT * FROM negocios";

                            if($_POST["buscar"] != ''){
                                $query .= " WHERE nombre LIKE '%".$aKeyword[0]."%'";

                                for($i = 1; $i < count($aKeyword); $i++){
                                    if(!empty($aKeyword[$i])){
                                        $query .= "OR nombre LIKE '%".$aKeyword[$i]."%'"; 
                                    }
                                }
                            }
                            $query .= "ORDER BY RFC ASC";
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
                            <th>RFC</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Servicio</th>
                            <th>No. Empleados</th>
                            <th>Ingreso mensual</th>
                            <th>Apertura</th>
                            <th>Municipio</th>
                            <th></th><th></th><th></th><th></th>
                        </tr>
                    </thead>

                    <!-- Contenido de las filas -->
                    <tbody>
                        <?php
                                while ($fila = pg_fetch_array($consulta)){
                        ?>
                        <tr>
                            <th><?php echo $fila['rfc']?></th>
                            <th><?php echo $fila['nombre']?></th>
                            <th><?php echo $fila['tipo']?></th>
                            <th><?php echo $fila['servicio']?></th>
                            <th><?php echo $fila['no_empleados']?></th>
                            <th><?php echo $fila['ingreso_mensual']?></th>
                            <th><?php echo $fila['año_apertura']?></th>
                            <?php $id_municipio = $fila['id_municipio'];
                                $sql = "SELECT * FROM municipios WHERE id='$id_municipio'";
                                $consulta_municipio = pg_query($conexion,$sql);
                                $municipio = pg_fetch_array($consulta_municipio);
                            ?>
                            <th><?php echo $municipio['nombre']?></th>
                            <th></th>
                            <th> <a class="icons" href="actualizar.php?rfc=<?php echo $fila['rfc'] ?>" id=''><i class="fa-solid fa-pencil"></i></a></th>
                            <th> <a class="icons" href="eliminar.php?rfc=<?php echo $fila['rfc'] ?>"><i class="fa-solid fa-trash"></i></a></th>
                            <th> <a class="icons" href="propietario.php?rfc=<?php echo $fila['rfc'] ?>"><i class="fa-solid fa-person-circle-plus"></i></a></th>
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