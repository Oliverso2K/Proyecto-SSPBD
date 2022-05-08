<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $rfc = $_GET['rfc'];

    $sql = "DELETE FROM public.negocios WHERE rfc = '$rfc'";
    $consulta = pg_query($conexion,$sql);

    if($consulta){
        Header("Location: formularioNegocio.php");
    }else{
        echo "Mamaste";
    }

?>
