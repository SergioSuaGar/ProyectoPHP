<!-- GESTIÓN DEL PROPIO USUARIO -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Libreria</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://bootswatch.com/united/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Asset" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript"  href="../js/scripts.js"></script>
    <script type="text/javascript" src="../js/modificarU.js"></script>
    <script type="text/javascript" src="../js/panelU.js"></script>
</head>
<body>
<?php
session_start();
include '../../Controlador/conexion.php';
?>
<!-- navbar -->
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Libreria</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="../../Vista/inicio.php">Inicio</a></li>
                <li><a href="../../index.php">Catálogo</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['Usuario'])) {
                    echo "<li><a href='' id='userNav'>".$_SESSION['Usuario'][0]['Usuario']."</a></li>";
                    if ($_SESSION['Usuario'][0]['Usuario'] == 'admin') {
                        ?>
                                <li><a href='../../Vista/registro.php'>Usuarios</a></li>
                                <li><a href='../admin/productos.php'>Productos</a></li>
                                <li><a href='../../Vista/admin.php'>Pedidos</a></li>
                        <?php
                    } else {
                        echo"<li><a href=' ' class='active'>Ajustes</a></li>";
                    }
                    echo "<li><a href='../login/cerrar.php'>Salir</a></li>";
                }
                else{
                    echo "<li><a href='../../Vista/registro.php'>Registro</a></li>";
                    echo "<li><a href='../../Vista/login.php'>Login</a></li>";
                }
                ?>
                <li class="active"><a href="../../Vista/carrito.php">Carrito</a></li>
            </ul>
        </div>
    </div>
</nav>

<section class="panel">
    <center><h1>Modificar datos</h1></center>
    <table class="table col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10">
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Usuario</th>
            <th>Password</th>
            <th>Modificar</th>
        </tr>
        <?php
        $usuario=$_SESSION['Usuario'][0]['Usuario'];
        $sql="select * from usuarios where Usuario='$usuario'";
        $datos=mysqli_query($con,$sql);
        while ($fila=mysqli_fetch_array($datos)) {
            echo '
				<tr>
					<td><input type="text" class="nombre form-control" value="'.$fila['Nombre'].'"></td>
					<td><input type="text" class="apellido form-control" value="'.$fila['Apellido'].'"></td>
					<td><input type="text" class="usuario form-control" value="'.$fila['Usuario'].'"></td>
					<td><input type="password" class="password form-control" value="'.$fila['Password'].'"></td>
					<td><button class="modificar btn btn-primary" data-id="'.$fila['Id'].'">Modificar</button></td>
				</tr>
				<tr>
				<td></td><td></td>
				<td><button style="margin-top: 30px;" class="eliminar btn btn-primary" data-id="'.$fila['Id'].'">Dar de baja</button></td>
				</tr>
				';
        }
        ?>
    </table>

</section>
</body>
</html>