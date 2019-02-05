<?php
session_start();
include '../Controlador/conexion.php';
if (isset($_SESSION['carrito'])) {
    if (isset($_GET['id'])) {
        $carro=$_SESSION['carrito'];
        $encontro=false;
        $numero=0;
        for ($i=0; $i < count($carro) ; $i++) {
            if ($carro[$i]['Id']==$_GET['id']) {
                $encontro=true;
                $numero=$i;
            }
        }
        if($encontro==true){
            $carro[$numero]['Cantidad']=$carro[$numero]['Cantidad']+1;
            $_SESSION['carrito']=$carro;
        }else{
            $nombre="";
            $precio=0;
            $imagen="";
            $resultado=mysqli_query($con,"select * from productos where id=".$_GET['id']);
            while ($f=mysqli_fetch_array($resultado)) {
                $nombre=$f['nombre'];
                $precio=$f['precio'];
                $imagen=$f['imagenes'];
            }
            $datosNuevos=array('Id'=>$_GET['id'],
                'Nombre'=>$nombre,
                'Precio'=>$precio,
                'Imagen'=>$imagen,
                'Cantidad'=>1);
            array_push($carro, $datosNuevos);
            $_SESSION['carrito']=$carro;
        }
    }
}else{
    if(isset($_GET['id'])){
        $nombre="";
        $precio=0;
        $imagen="";
        $resultado=mysqli_query($con,"select * from productos where id=".$_GET['id']);
        while ($f=mysqli_fetch_array($resultado)) {
            $nombre=$f['nombre'];
            $precio=$f['precio'];
            $imagen=$f['imagenes'];
        }
        $carro[]=array('Id'=>$_GET['id'],
            'Nombre'=>$nombre,
            'Precio'=>$precio,
            'Imagen'=>$imagen,
            'Cantidad'=>1);
        $_SESSION['carrito']=$carro;
    }
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
    <script type="text/javascript"  src="../Modelo/js/scripts.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
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
                <li class="active"><a href="carrito.php">Carrito</a></li>
            </ul>
        </div>
    </div>
</nav>
<section class="carrito">
    <div class="col-xs-12 col-sm-8 col-md-8 col-md-offset-1">
        <?php
        $total=0;
        if (isset($_SESSION['carrito'])) {
        ?>
        <table>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Eliminar</th>
            </tr>
            <?php
            $datos=$_SESSION['carrito'];
            $total=0;
            for ($i=0; $i < count($datos); $i++) {
                ?>
                <tr class="producto">
                    <td>
                        <img src="../Modelo/productos/<?php echo $datos[$i]['Imagen'];?>" width="100px" height="70px">
                        <span>&nbsp;&nbsp;<?php echo $datos[$i]['Nombre'];?></span>
                    </td>
                    <td><?php echo $datos[$i]['Precio'];?>€</td>
                    <td><input type="text" value="<?php echo $datos[$i]['Cantidad'];?>"
                               data-precio="<?php echo $datos[$i]['Precio'];?>"
                               data-id="<?php echo $datos[$i]['Id'];?>"
                               class="cantidad"></td>
                    <td><span class="subtotal"><?php echo $datos[$i]['Precio']*$datos[$i]['Cantidad'];?>€</span></td>
                    <td style="padding: 0% 3%;"><a href="#" class="eliminar" data-id="<?php echo $datos[$i]['Id']?>" ><i class="fa fa-times" aria-hidden="true"></i></a></td>

                </tr>
                <?php
                $total=($datos[$i]['Precio']*$datos[$i]['Cantidad'])+$total;
            }
            echo '</table>';



            }else{
                echo '<center><p style="margin-top:20px;">El carrito esta vacio</p></center>';
            }
            echo '<center class="dcha"><h2 id="total" >Total: '.$total.'€</h2></center>';
            if ($total!=0) {
                echo '<center class="dcha"><a href="./compras.php" class="aceptar"><strong>Realizar Pedido</strong></a></center>';
            }
            ?>
            <center class="dcha"><a href="..">Seguir comprando</a></center>
    </div>
</section>
</body>
</html>