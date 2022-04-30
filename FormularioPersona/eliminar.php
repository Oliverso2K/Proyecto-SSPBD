<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $id = $_GET['id'];

    $sql = "DELETE FROM public.viviendas WHERE id = '$id'";
    $consulta = pg_query($conexion,$sql);

    if($consulta){
        Header("Location: formularioVivienda.php");
    }else{
        echo "Mamaste";
    }

?>
