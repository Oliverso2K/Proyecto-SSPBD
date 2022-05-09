<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $id = $_GET['id'];

    $sql = "SELECT * FROM ingresos WHERE id = '$id'";
    $consulta = pg_query($conexion,$sql);

    $persona = pg_fetch_row($consulta);
    $id_persona = $persona['2'];

    $sql = "DELETE FROM public.ingresos WHERE id = '$id'";
    $consulta = pg_query($conexion,$sql);

    if($consulta){
        Header("Location: formularioIngreso.php?id=$id_persona");
    }else{
        echo "Mamaste";
    }

?>
