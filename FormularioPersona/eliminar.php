<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $id = $_GET['id'];

    $sql = "DELETE FROM public.personas WHERE id = '$id'";
    $consulta = pg_query($conexion,$sql);

    if($consulta){
        Header("Location: formularioPersona.php");
    }else{
        echo "Mamaste";
    }

?>
