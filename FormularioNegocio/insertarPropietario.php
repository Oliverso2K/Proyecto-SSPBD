<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $rfc_negocio = $_POST['rfc'];
    $id_persona = $_POST['id_persona'];
    $fecha_inicio = $_POST['fecha_inicio'];

    $sql = "INSERT INTO public.propietarios(id_persona, fecha_inicio, rfc_negocio) VALUES ('$id_persona', '$fecha_inicio', '$rfc_negocio')";
    $consulta = pg_query($conexion,$sql);


    if($consulta){
        Header("Location: formularioNegocio.php");
    }else{
        echo "Mamaste";
    }
?>
