<?php
session_start();
include "../../Controlador/conexion.php";
if(isset($_SESSION['Usuario'])){
}else{
    header("Location: ../../index.php?Error=Acceso denegado");
}
?>
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
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../js/scripts.js"></script>
    <script type="text/javascript" src="../js/modificar.js"></script>
</head>
<body>
<section class="modif">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../index.php">Libreria</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="../../index.php">Catálogo</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (isset($_SESSION['Usuario'])) {
                        echo "<li><a href='' id='userNav'>".$_SESSION['Usuario'][0]['Usuario']."</a></li>";
                        if ($_SESSION['Usuario'][0]['Usuario'] == 'admin') {
                            ?>

                                    <li><a href='../../Vista/registro.php'>Usuarios</a></li>
                                    <li><a href='#'>Productos</a></li>
                                    <li><a href='../../Vista/admin.php'>Pedidos</a></li>

                            <?php
                        } else {
                            echo "<li><a href='../login/panelU.php'>Ajustes</a></li>";
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

    <center><h1>Añadir producto</h1></center>
    <form class="col-xs-offset-4 col-xs-4 col-sm-offset-4 col-sm-4 col-md-offset-4 col-md-4" action="altaproducto.php" method ="post" enctype="multipart/form-data">
        <?php
        if(isset($GET['error'])){
            echo "<center>Introduce todos los campos</center>";
        }
        elseif (isset($_GET['correcto'])) {
            echo "<center>El producto se añadió correctamente</center>";
        }
        ?>
        <fieldset class="form-group">
            Nombre
            <input type="text" name="nombre" class="form-control">
        </fieldset>
        <fieldset class="form-group">
            Descripción
            <input type="text" name="descripcion" class="form-control">
        </fieldset>
        <fieldset class="form-group">
            Imagen
            <input type="file" name="file">
        </fieldset>
        <fieldset class="form-group">
            Precio
            <input type="text" name="precio" class="form-control">
        </fieldset>
        <input type="submit" name="accion" value="Enviar" class="btn btn-primary aceptar">
    </form>

    <div class="clearfix"></div><br><br>

    <center><h1>Gestión de productos</h1></center>
    <table class="table col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10">
        <tr>
            <td>Id</td>
            <td>Nombre</td>
            <td>Descripción</td>
            <td>Precio</td>
            <td>Modificar</td>
            <td>Eliminar</td>
        </tr>
        <?php
        $datos=mysqli_query($con,"select * from productos");
        while ($fila=mysqli_fetch_array($datos)) {
            echo '
				<tr>
					<td>
						<input type="hidden" value="'.$fila['id'].'">'.$fila['id'].'
						<input type="hidden" class="imagen" value="'.$fila['imagenes'].'">
					</td>
					<td><input type="text" class="nombre form-control" value="'.$fila['nombre'].'"></td>
					<td><input type="text" class="descripcion form-control" value="'.$fila['descripcion'].'"></td>
					<td><input type="text" class="precio form-control" value="'.$fila['precio'].'"></td>
					<td><button class="modificar btn btn-primary" data-id="'.$fila['id'].'">Modificar</button></td>
					<td><a class="eliminar" data-id="'.$fila['id'].'"><i class="fa fa-times" aria-hidden="true"></i></a></td>
				</tr>
				';
        }
        ?>
    </table>
</section>
</body>
</html>