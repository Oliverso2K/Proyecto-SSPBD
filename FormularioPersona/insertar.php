<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $curp = $_POST['curp'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $genero = $_POST['genero'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $estado_civil = $_POST['estado_civil'];
    $vivienda = $_POST['id_vivienda'];

    $sql = "INSERT INTO public.personas(curp, nombres, estado_civil, genero, id_vivienda, apellidos, fecha_nacimiento) VALUES ('$curp', '$nombres', '$estado_civil', '$genero', '$vivienda', '$apellidos', '$fecha_nacimiento')";
    $consulta = pg_query($conexion,$sql);

    if($consulta){
        Header("Location: formularioPersona.php");
    }else{
        echo "Mamaste";
    }
?>

