<?php
session_start();
include '../Controlador/conexion.php';
$datos=$_SESSION['carrito'];
$numeroventa=0;
$resultado=mysqli_query($con,"select * from compras order by numeroventa DESC limit 1") or die(mysqli_error());
while ( $fila=mysqli_fetch_array($resultado)){
    $numeroventa=$fila['numeroventa'];
}
if($numeroventa==0){
    $numeroventa=1;
}else{
    $numeroventa++;
}
for ($i=0; $i < count($datos); $i++) {
    mysqli_query($con,"insert into compras (numeroventa, imagen, nombre, precio, cantidad, subtotal) values (
			".$numeroventa.",
			'".$datos[$i]['Imagen']."',
			'".$datos[$i]['Nombre']."',
			'".$datos[$i]['Precio']."',
			'".$datos[$i]['Cantidad']."',
			'".($datos[$i]['Precio']*$datos[$i]['Cantidad'])."'
			)")or die(mysqli_error());
}
unset($_SESSION['carrito']);
header("Location: ./admin.php");
?>