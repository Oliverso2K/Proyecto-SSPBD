<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="censarStyle.css">
    <title>Censar</title>
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
        <h5> Soy censador > Censar</h1>
            <h2> CENSAR </h2>
    </div>
    
    <div class="contenedor">
        <section class="botones"> 
            <button>
                <a href="../FormularioPersona/formularioPersona.php"> Individuo </a>
            </button>
            <button>
                <a href="../FormularioVivienda/formularioVivienda.php"> Vivienda </a>
            </button>
            <button>
                <a href="../FormularioNegocio/formularioNegocio.php"> Negocio </a>
            </button>
        </section>

        <section class="imagen">
          <img src="Recursos/inegi.png" alt="Imagen de los censadores">
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