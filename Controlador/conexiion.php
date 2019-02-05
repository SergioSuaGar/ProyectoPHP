<?php
try {
    $username="root";
    $password="";
    $mbd = new PDO('mysql:host=localhost;dbname=libreria', username, password);
    foreach($mbd->query('SELECT * from FOO') as $fila) {
        print_r($fila);
    }
    $mbd = null;
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
