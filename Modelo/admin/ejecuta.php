<?php
include "../../Controlador/conexion.php";
if($_POST['Caso']=="Eliminar"){
    mysqli_query($con,"delete from productos where id=".$_POST['Id']);
    unlink("../productos/".$_POST['Imagen']);
    echo 'El producto se ha eliminado';
}
if($_POST['Caso']=="Modificar"){
    mysqli_query($con,"update productos set nombre='".$_POST['Nombre']."' where id=".$_POST['Id']);
    mysqli_query($con,"update productos set descripcion='".$_POST['Descripcion']."' where id=".$_POST['Id']);
    mysqli_query($con,"update productos set precio='".$_POST['Precio']."' where id=".$_POST['Id']);
    echo 'El producto se ha modificado';
}
if($_POST['Caso']=="EliminarU"){
    mysqli_query($con,"delete from usuarios where id=".$_POST['Id']);
    echo 'El usuario se ha eliminado';
}
if($_POST['Caso']=="ModificarU"){
    mysqli_query($con,"update usuarios set Nombre='".$_POST['Nombre']."' where id=".$_POST['Id']);
    mysqli_query($con,"update usuarios set Apellido='".$_POST['Apellido']."' where id=".$_POST['Id']);
    mysqli_query($con,"update usuarios set Usuario='".$_POST['Usuario']."' where id=".$_POST['Id']);
    mysqli_query($con,"update usuarios set Password='".$_POST['Password']."' where id=".$_POST['Id']);
    echo 'El usuario se ha modificado';
}
?>