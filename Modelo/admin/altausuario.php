<?php
session_start();
include("../../Controlador/conexion.php");
if (!isset($_POST['nombre']) ||  !isset($_POST['apellido']) || !isset($_POST['password']) || !isset($_POST['usuario'])) {
    header("Location: ../../Vista/registro.php?error=faltan datos");
}else{
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $password=$_POST['password'];
    $usuario=$_POST['usuario'];
    $sql="insert into usuarios (Nombre, Apellido, Usuario, Password) values(
			'".$nombre."',
			'".$apellido."',
			'".$usuario."',
			'".$password."')";
    if (mysqli_query($con,$sql)) {
        if ($_SESSION['Usuario'][0]['Usuario'] == 'admin') {
            header ("Location: ../../Vista/registro.php");
        }
        else{
            header ("Location: ../../Vista/login.php");
        }

    }else{
        header ("Location: ../../Vista/registro.php?con=0");
    }
}
?>