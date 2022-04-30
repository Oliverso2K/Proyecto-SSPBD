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
    <link rel="stylesheet" href="formIngresoStyles.css">
    <title>Formulario Ingresos</title>
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
        <h5> Soy censador > Censar > Individuo > Ingresos</h1>
            <h2> CENSAR INGRESOS </h2>
    </div>
    <text class="registroNombre"> Registros de Ingresos de MARIANA JOCELYN LÓPEZ QUIROZ </text>

    <div class="contenedor">
        <section class="contFormulario">
            <h2>Agregar Ingreso </h2>
            <form action="insertar.php" method="POST">
                <input type="number" name="cantidad" min="1" placeholder="Cantidad" class="input" required>
                <text>Fecha del ingreso</text>
                <input type="date" name="fecha" class="input" required>
                <text>Fuente de ingreso</text>
                <select name="tipo" class="input" requeried>
                    <option value="empleo">Empleo</option>
                    <option value="donativo">Donativo</option>
                    <option value="apoyo gobierno">Apoyo gubernamental</option>
                </select>
                <input type="text" name="razon_social" placeholder="Razón social" class="input" required>
                
                <input type="submit" value="Registrar" class="botonRegistrar">
            </form>
        </section>

        <section class="tabla">
            <div class="buscar">
                <input type="text" placeholder="Buscar por ID de ingreso, fecha o tipo de fuente" requeried>
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
                            <th>Fuente</th>
                            <th>Fecha</th>
                            <th></th><th></th><th></th>
                        </tr>
                    </thead>

                    <!-- Contenido de las filas -->
                    <tbody>
                        <tr>
                            <th>1</th>
                            <th>2000</th>
                            <th>Empleo</th>
                            <th>30-04-2022</th>
                            <th> <a class="icons" href="#" id='btn-abrir-popup'><i class="fa-solid fa-circle-question"></i></a></th>
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