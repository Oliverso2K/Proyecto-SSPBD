<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $id_persona = $_GET['id'];
    $cantidad = $_POST['cantidad'];
    $servicio = $_POST['servicio'];
    $fecha = $_POST['fecha'];

    $sql = "INSERT INTO public.gastos(id_persona, servicio, cantidad, fecha) VALUES ('$id_persona','$servicio','$cantidad','$fecha')";
    $consulta = pg_query($conexion,$sql);

    if($consulta){
        Header("Location: formularioEgreso.php?id=$id_persona");
    }else{
        echo "Mamaste";
    }
?>
