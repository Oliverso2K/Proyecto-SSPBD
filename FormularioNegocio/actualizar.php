<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $rfc = $_GET['rfc'];

    $sql = "SELECT * FROM negocios WHERE rfc='$rfc'";
    $consulta = pg_query($conexion,$sql);

    $fila = pg_fetch_array($consulta);

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
        <title>Editar Negocio</title>
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
        <h5> Soy censador > Censar > Negocio > Editar Negocio</h1>
            <h2> EDITAR NEGOCIO </h2>
    </div>
    <div class="contenedor" style={align}>
        <section class="contFormulario">
            <h2>Actualiza el negocio :) </h2>
            <form action="editar.php" method="POST">

                <input type="text" name="nombre" value="<?php echo $fila['nombre']?>" placeholder="Nombre del Negocio" class="input" required>

                <text>Tipo de Negocio</text>
                <select name="tipo" class="input" requeried>
                    <option <?php if('Agrónomo'==$fila['tipo']){echo 'selected';}?> value="Agrónomo">Agrónomo</option>
                    <option <?php if('Automotriz'==$fila['tipo']){echo 'selected';}?> value="Automotriz">Automotriz</option>
                    <option <?php if('Confitería'==$fila['tipo']){echo 'selected';}?> value="Confitería">Confitería</option>
                    <option <?php if('Comercio'==$fila['tipo']){echo 'selected';}?> value="Comercio">Comercio</option>
                    <option <?php if('Computación'==$fila['tipo']){echo 'selected';}?> value="Computación">Computación</option>
                    <option <?php if('Farmacéutica'==$fila['tipo']){echo 'selected';}?> value="Farmacéutica">Farmacéutica</option>
                    <option <?php if('Industrial'==$fila['tipo']){echo 'selected';}?> value="Industrial">Industrial</option>
                    <option <?php if('Manufactura'==$fila['tipo']){echo 'selected';}?> value="Manufactura">Manufactura</option>
                    <option <?php if('Telecomunicaciones'==$fila['tipo']){echo 'selected';}?> value="Telecomunicaciones">Telecomunicaciones</option>
                </select>

                <text>Servicio que ofrece</text>
                <select name="servicio" class="input" requeried>
                    <option <?php if('Agua'==$fila['servicio']){echo 'selected';}?> value="Agua">Agua</option>
                    <option <?php if('Arrendamiento'==$fila['servicio']){echo 'selected';}?> value="Arrendamiento">Arrendamiento</option>
                    <option <?php if('Comestibles'==$fila['servicio']){echo 'selected';}?> value="Comestibles">Comestibles</option>
                    <option <?php if('Comunicaciones'==$fila['servicio']){echo 'selected';}?> value="Comunicaciones">Comunicaciones</option>
                    <option <?php if('Electricidad'==$fila['servicio']){echo 'selected';}?> value="Electricidad">Electricidad</option>
                    <option <?php if('Entretenimiento'==$fila['servicio']){echo 'selected';}?> value="Entretenimiento">Entretenimiento</option>
                    <option <?php if('Gas'==$fila['servicio']){echo 'selected';}?> value="Gas">Gas</option>
                    <option <?php if('Mercancía'==$fila['servicio']){echo 'selected';}?> value="Mercancía">Mercancía</option>
                    <option <?php if('Salud'==$fila['servicio']){echo 'selected';}?> value="Salud">Salud</option>
                    <option <?php if('Transporte'==$fila['servicio']){echo 'selected';}?> value="Transporte">Transporte</option>
                    <option <?php if('Turismo'==$fila['servicio']){echo 'selected';}?>value="Turismo">Turismo</option>
                </select>
                <input type="number" name="año_apertura" value="<?php echo $fila['año_apertura']?>" min="1850" max="2022" placeholder="Año de apertura" class="input" required>
                <text>Ubicación</text>
                <select name="id_municipio" class="input">
                    <?php
                        while ($filaMunicipio = pg_fetch_array($consulta2)){
                    ?>
                    <option
                    <?php if($filaMunicipio['id']==$fila['id_municipio']){echo 'selected';} ?>
                    value="<?php echo $filaMunicipio['id']?>"> <?php echo $filaMunicipio['nombre']?>
                    </option>
                    <?php
                        }
                    ?>
                </select>
                <input type="number" name="no_empleados" value="<?php echo $fila['no_empleados']?>" min="1" placeholder="Número de empleados" class="input" required>
                <input type="number" name="ingreso_mensual" value="<?php echo $fila['ingreso_mensual']?>" min="500" placeholder="Ingreso mensual" class="input" required>

                <input type="submit" value="Actualizar" class="botonRegistrar">
            </form>
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