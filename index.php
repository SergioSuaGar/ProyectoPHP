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
    <script type="text/javascript"  href="Modelo/js/scripts.js"></script>
</head>
<body>
<?php
session_start();
include 'Controlador/conexion.php';
?>

<!-- navbar -->
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header navbar-dark bg-dark">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand navbar-dark bg-dark" href="#">Libreria</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-dark bg-dark">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Catálogo</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-dark bg-dark">
                <?php
                if (isset($_SESSION['Usuario'])) {
                    echo "<li><a href='' id='userNav'>".$_SESSION['Usuario'][0]['Usuario']."</a></li>";
                    if ($_SESSION['Usuario'][0]['Usuario'] == 'admin') {
                        ?>
                            <li><a href='Vista/registro.php'>Usuarios</a></li>
                            <li><a href='Modelo/admin/productos.php'>Productos</a></li>
                            <li><a href='Vista/admin.php'>Pedidos</a></li>
                        <?php
                    } else {
                        echo "<li><a href='Modelo/login/panelU.php'>Ajustes</a></li>";
                    }
                    echo "<li><a href='Modelo/login/cerrar.php'>Salir</a></li>";
                }
                else{
                    echo "<li><a href='Vista/registro.php'>Registro</a></li>";
                    echo "<li><a href='Vista/login.php'>Login</a></li>";
                }
                ?>
                <li class="active"><a href="Vista/carrito.php">Carrito</a></li>
            </ul>
        </div>
    </div>
</nav>

<section class="catalog">
    <center>
        <?php
        $re=mysqli_query($con,"select * from productos")or die(mysqli_error($con));
        while ($f=mysqli_fetch_array($re)) {
            ?>
            <div class="card-group">
                <div class="card col-xs-12 col-sm-6 col-md-3">
                    <img class="card-img-top" src="Modelo/productos/<?php echo $f['imagenes'];?>" width="250px" height="150px">
                    <div class="card-block">
                        <h4 class="card-title"><?php echo $f['nombre'];?></h4>

                    </div>
                    <div class="card-footer">
                        <span>Precio: <?php echo $f['precio']; ?>€/u</span></div>
                        <a href="Vista/detalles.php?id=<?php echo $f['id'];?>">Info</a>
                    </div>
                </div>
            <br>
            </div>
            <?php
        }
        ?>
    </center>
</section>
</body>
</html>