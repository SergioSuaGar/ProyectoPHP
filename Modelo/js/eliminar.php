<?php
session_start();
$datos=$_SESSION['carrito'];
for ($i=0; $i < count($datos); $i++) {
    if ($datos[$i]['Id']!=$_POST['Id']) {
        $datosNuevos[]=array(
            'Id'=>$datos[$i]['Id'],
            'Nombre'=>$datos[$i]['Nombre'],
            'Precio'=>$datos[$i]['Precio'],
            'Imagen'=>$datos[$i]['Imagen'],
            'Cantidad'=>$datos[$i]['Cantidad']
        );
    }
}
if (isset($datosNuevos)) {
    $_SESSION['carrito']=$datosNuevos;
}else{
    unset($_SESSION['carrito']);
    echo '0';
}
?>