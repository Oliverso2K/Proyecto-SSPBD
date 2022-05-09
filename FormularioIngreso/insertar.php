<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $id_persona = $_GET['id'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['fecha'];

    $razon_social = $_POST['razon_social'];
    $tipo = $_POST['tipo'];

    $sql = "INSERT INTO public.fuentes(razon_social, tipo) VALUES ('$razon_social', '$tipo') RETURNING id";
    $consulta = pg_query($conexion,$sql);

    $fuente = pg_fetch_row($consulta);

    $id_fuente = $fuente['0'];

    $sql = "INSERT INTO public.ingresos(id_fuente, id_persona, cantidad, fecha) VALUES ('$id_fuente','$id_persona','$cantidad','$fecha')";
    $consulta = pg_query($conexion,$sql);

    if($consulta){
        Header("Location: formularioIngreso.php?id=$id_persona");
    }else{
        echo "Mamaste";
    }
?>

