<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

	$sql = "SELECT * FROM negocios";
	$consulta = pg_query($conexion,$sql);

    $sql = "SELECT * FROM municipios";
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
            <li><a href="" class="">Soy censador</a></li>
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
                    <option value="agrónomo">Agrónomo</option>
                    <option value="automotriz">Automotriz</option>
                    <option value="confitería">Confitería</option>
                    <option value="comercio">Comercio</option>
                    <option value="computación">Computación</option>
                    <option value="farmacéutica">Farmacéutica</option>
                    <option value="industrial">Industrial</option>
                    <option value="manufactura">Manufactura</option>
                    <option value="telecomunicaciones">Telecomunicaciones</option>
                </select>

                <text>Servicio que ofrece</text>
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
                <input type="text" placeholder="Buscar por ID de negocio, RFC o nombre" requeried>
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
                            <th>Nombre</th>
                            <th>RFC</th>
                            <th>Tipo</th>
                            <th>Servicio</th>
                            <th>No. Empleados</th>
                            <th>Ingreso mensual</th>
                            <th>Apertura</th>
                            <th>Municipio</th>
                            <th></th><th></th>
                        </tr>
                    </thead>

                    <!-- Contenido de las filas -->
                    <tbody>
                        <tr>
                            <th>1</th>
                            <th>Papelería Yuem</th>
                            <th>MELM8305281H0</th>
                            <th>Comercio</th>
                            <th>Mercancía</th>
                            <th>2</th>
                            <th>7000</th>
                            <th>2010</th>
                            <th>Tlajomulco</th>
                            <th> <a class="icons" href="#" id='btn-abrir-popup'><i class="fa-solid fa-pencil"></i></a></th>
                            <th> <a class="icons" href="eliminar.php?id=<?php echo $fila['id'] ?>"><i class="fa-solid fa-trash"></i></a></th>
                        </tr>

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

    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"> <i class="fas fa-times"> </i> </a>
            <h3>Editar registro</h3>
            
            <form action="">
                <div class="contInputs">
                    <input type="text" placeholder="Dirección">
                    <input type="text" placeholder="Colonia">
                    <select name="id_municipio" class="input">
                        <!-- <?php
                            while ($filaMunicipio = pg_fetch_array($consulta2)){
                        ?>
                        <option value="<?php echo $filaMunicipio['id']?>"> <?php echo $filaMunicipio['nombre']?> </option>
                        <?php
                            }
                        ?> -->
                    </select>
                </div>
                <input type="submit" class="btn-submit" value="Actualizar">
            </form>
        </div>
    </div>

    <script src="popup.js"></script>

</body>

</html>