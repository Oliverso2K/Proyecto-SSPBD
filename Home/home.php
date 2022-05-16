<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

	$sql = "SELECT * FROM personas";
	$consultaPersonas = pg_query($conexion,$sql);

    $sql = "SELECT * FROM viviendas";
	$consultaViviendas = pg_query($conexion,$sql);

    $sql = "SELECT * FROM negocios";
	$consultaNegocios = pg_query($conexion,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homeStyle.css">
    <title>Home</title>
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
        <section class="datoCensados">
            <text>
            <?php
                $rows = pg_num_rows($consultaPersonas);
                echo $rows
            ?>
            </text>
            <p>Individuos censados</p>
        </section>
        <section class="datoCensados">
            <text>
            <?php
                $rows = pg_num_rows($consultaNegocios);
                echo $rows
            ?>
            </text>
            <p>Negocios censados</p>
        </section>
        <section class="datoCensados">
            <text>
            <?php
                $rows = pg_num_rows($consultaViviendas);
                echo $rows
            ?>
            </text>
            <p>Familias censadas</p>
        </section>
    </div>
    
    <div class="contenedor">
        <section class="imagen">
          <img src="Recursos/agroi.png" alt="Imagen de los censadores">
        </section>

        <div class="contenedorDescripcion">
            <section class="descripcion">
                <Text>¿Quiénes somos?</Text>
                <p>si</p>
            </section>
            <section class="descripcion">
                <Text>¿Qué funciones puede realizar?</Text>
                <p>Consultar los ingresos y gastos que se realizan dentro de las comunidades de Jalisco.</p>
            </section>
        </div>
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