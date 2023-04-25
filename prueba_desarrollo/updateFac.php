<?php
require_once './config/conexion.php';
$conn = conexion();

$documento_cliente = $_POST['documento'];
$valor = $_POST['valor'];
$codi_estado = $_POST['tipoEstadoFactura'];

$sql="UPDATE factura SET documento='$documento_cliente',valor='$valor',tipoEstadoFactura='$codi_estado'";
$query=mysqli_query($conn,$sql);
    if($query){
        header("Location: ./index.php"); 
    }
?>