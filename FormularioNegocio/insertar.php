<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $rfc = $_POST['rfc'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $servicio = $_POST['servicio'];
    $no_empleados = $_POST['no_empleados'];
    $ingreso_mensual = $_POST['ingreso_mensual'];
    $año_apertura = $_POST['año_apertura'];
    $municipio = $_POST['id_municipio'];

    $sql = "INSERT INTO public.negocios(rfc, nombre, tipo, no_empleados, servicio, id_municipio, ingreso_mensual, año_apertura) VALUES ('$rfc', '$nombre', '$tipo', '$no_empleados', '$servicio', '$municipio', '$ingreso_mensual', '$año_apertura')";
    $consulta = pg_query($conexion,$sql);

    if($consulta){
        Header("Location: formularioNegocio.php");
    }else{
        echo "Mamaste";
    }
?>

