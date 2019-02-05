<?php
session_start();
include "../Controlador/conexion.php";
if ($_SESSION['Usuario'][0]['Usuario'] == "admin") {

}else{
    header("Location: ../index.php?Error=Acceso_denegado");
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
    <script type="text/javascript"  href="../Modelo/js/scripts.js"></script>
</head>
<body>

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
                <li><a href="../index.php">Catálogo</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['Usuario'])) {
                    echo "<li><a href='' id='userNav'>".$_SESSION['Usuario'][0]['Usuario']."</a></li>";
                    if ($_SESSION['Usuario'][0]['Usuario'] == 'admin') {
                        ?>
                                <li><a href='registro.php'>Usuarios</a></li>
                                <li><a href='../Modelo/admin/productos.php'>Productos</a></li>
                                <li><a href='admin.php'>Pedidos</a></li>
                        <?php
                    } else {
                        echo "<li><a href='../Modelo/login/panelU.php'>Ajustes</a></li>";
                    }
                    echo "<li><a href='../Modelo/login/cerrar.php'>Salir</a></li>";
                }
                else{
                    echo "<li><a href='registro.php'>Registro</a></li>";
                    echo "<li><a href='login.php'>Login</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<section class="admin">
    <center><h1>Últimos pedidos</h1></center>
    <div class="container">
        <table class="table" border="0px" width="100%">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>

            <?php
            $datos=mysqli_query($con,"select * from compras")or die(mysqli_error($con));
            $numeroventa=0;
            while ($fila=mysqli_fetch_array($datos)) {
                if($numeroventa	!=$fila['numeroventa']){
                    echo '<tr><td>Pedido nº: '.$fila['numeroventa'].' </td></tr>';
                }
                $numeroventa=$fila['numeroventa'];
                echo '<tr>
						<td><img src="../Modelo/productos/'.$fila['imagen'].'" width="100px" heigth="100px" /></td>
						<td>'.$fila['nombre'].'</td>
						<td>'.$fila['precio'].'</td>
						<td>'.$fila['cantidad'].'</td>
						<td>'.$fila['subtotal'].'</td>
					</tr>';
            }
            ?>
        </table>
    </div>
</section>
</body>
</html>