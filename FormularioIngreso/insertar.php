<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $direccion = $_POST['dirección'];
    $colonia = $_POST['colonia'];
    $municipio = $_POST['id_municipio'];

    $sql = "INSERT INTO public.viviendas(dirección, colonia, id_municipio) VALUES ('$direccion', '$colonia', '$municipio')";
    $consulta = pg_query($conexion,$sql);

    if($consulta){
        Header("Location: formularioVivienda.php");
    }else{
        echo "Mamaste";
    }
?>

