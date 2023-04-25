<?php
require_once './config/conexion.php';

function mostrar_registros_factura($conn){
    $sql = "SELECT f.id_factura, f.fecha_fac, c.nombre, f.valor_fac, COALESCE(ef.descripcion, 'Sin estado') as descripcion 
    FROM factura f
    INNER JOIN clientes c ON f.id_cliente = c.id 
    LEFT JOIN estados_factura ef ON f.codi_estado = ef.codi_estado 
    ORDER BY f.id_factura";
    $query = mysqli_query($conn, $sql);

    return $query;
}

function mostrar_estados($conn){
    $sql = "SELECT * FROM estados_factura";
    $query = mysqli_query($conn, $sql);
    return $query;
}

function eliminar_factura($conn){
$id=$_GET['id'];
$sql="DELETE FROM factura WHERE id_factura='$id'";
$query=mysqli_query($conn,$sql);

if($query){
    Header("Location:index.php");
}else{
    
}
}
?>