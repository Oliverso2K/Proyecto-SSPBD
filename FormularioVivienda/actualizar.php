<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $id = $_GET['id'];

    $sql = "SELECT * FROM viviendas WHERE id='$id'";
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
        <link rel="stylesheet" href="formViviendaStyles.css">
        <title>Editar Vivienda</title>
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
        <h5> Soy censador > Censar > Vivienda > Editar Vivienda</h1>
            <h2> EDITAR VIVIENDA </h2>
    </div>
    <div class="contenedor" style={align}>
        <section class="contFormulario">
            <h2>Actualiza la vivienda :) </h2>
            <form action="editar.php" method="POST">

                <input type="hidden" name="id" value="<?php echo $fila['id']?>">
                <input type="text" name="dirección" value="<?php echo $fila['dirección']?>" placeholder="Dirección" class="input" required>
                <input type="text" name="colonia" value="<?php echo $fila['colonia']?>"placeholder="Colonia" class="input" required>
                <select name="id_municipio" class="input">
                    <?php
                        while ($filaMunicipio = pg_fetch_array($consulta2)){
                    ?>
                    <option <?php if($filaMunicipio['id']==$fila['id_municipio']){echo 'selected';} ?> value="<?php echo $filaMunicipio['id']?>"> <?php echo $filaMunicipio['nombre']?> </option>
                    <?php
                        }
                    ?>
                </select>

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