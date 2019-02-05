<?php
session_start();
$datos=$_SESSION['carrito'];
$total=0;
$numero=0;
for ($i=0; $i < count($datos) ; $i++) {
    if ($datos[$i]['Id']==$_POST['Id']) {
        $numero=$i;
    }
}
$datos[$numero]['Cantidad']=$_POST['Cantidad'];
for ($i=0; $i < count($datos) ; $i++) {
    $total=($datos[$i]['Precio']*$datos[$i]['Cantidad'])+$total;
}
$_SESSION['carrito']=$datos;
echo $total;
?>