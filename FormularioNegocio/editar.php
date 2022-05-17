<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $no_empleados = $_POST['no_empleados'];
    $servicio = $_POST['servicio'];
    $id_municipio = $_POST['id_municipio'];
    $ingreso_mensual = $_POST['ingreso_mensual'];
    $año_apertura = $_POST['año_apertura'];

    $sql = "UPDATE negocios SET nombre='$nombre', tipo='$tipo',
            id_municipio='$id_municipio', no_empleados='$no_empleados',
            servicio='$servicio', ingreso_mensual='$ingreso_mensual',
            año_apertura='$año_apertura' WHERE nombre='$nombre'";

    $consulta = pg_query($conexion,$sql);

    if($consulta){
        Header("Location: formularioNegocio.php");
    }else{
        echo "Mamaste";
    }

?>