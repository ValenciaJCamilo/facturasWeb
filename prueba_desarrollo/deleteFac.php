<?php
require_once './config/conexion.php';
$conn = conexion();

$id=$_GET['id'];
$sql="DELETE FROM factura WHERE id_factura='$id'";
$query=mysqli_query($conn,$sql);

if($query){
    Header("Location:index.php");
}else{
    
}
?>