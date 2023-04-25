<?php
function conexion(){
    $host="localhost";
    $user="root";
    $pass="";
    $bd="prueba_desarrollo";

    $con=mysqli_connect($host,$user,$pass);

    if (!$con) {
        die("La conexión falló: " . mysqli_connect_error());
    }

    mysqli_select_db($con,$bd);

    return $con;
}
?>