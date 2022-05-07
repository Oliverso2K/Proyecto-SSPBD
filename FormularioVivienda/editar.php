<?php
    $conexion = pg_connect("host=localhost dbname=SICOJA user=postgres password=password");

    $id = $_POST['id'];
    $direccion = $_POST['dirección'];
    $colonia = $_POST['colonia'];
    $id_municipio = $_POST['id_municipio'];

    $sql = "UPDATE viviendaS SET dirección='$direccion', colonia='$colonia',
            id_municipio='$id_municipio' WHERE id='$id'";

    $consulta = pg_query($conexion,$sql);

    if($consulta){
        Header("Location: formularioVivienda.php");
    }else{
        echo "Mamaste";
    }

?>