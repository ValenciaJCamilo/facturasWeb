<?php
require_once './config/conexion.php';
$conn = conexion();

$documento_cliente = $_POST['documento'];
$valor = $_POST['valor'];
$codi_estado = $_POST['tipoEstadoFactura'];
$identificador = $_POST['idFact'];

//? VALIFACIÓN PARA IDENTIFICAR QUE EL CLIENTE EXISTA EN LA TABLA DE CLIENTES
$sql_cliente = "SELECT id FROM clientes WHERE nume_doc = '$documento_cliente'";
$query_cliente = mysqli_query($conn, $sql_cliente);
if (mysqli_num_rows($query_cliente) == 0) {
    echo "<script>window.alert('No se pueden actualizar los datos porque el cliente no existe.'); window.history.go(-1);</script>";
    exit;
}
$id_cliente = mysqli_fetch_assoc($query_cliente)['id'];

//? SE OBTIENE EL CÓDIGO DEL ESTADO DE FACTURA
if (!empty($codi_estado)) {
    $sql_estado = "SELECT codi_estado, descripcion FROM estados_factura WHERE codi_estado = '$codi_estado'";
    $query_estado = mysqli_query($conn, $sql_estado);
    if (mysqli_num_rows($query_estado) == 0) {
        echo "<script>window.alert('No se pueden actualizar los datos porque el estado no existe.'); window.history.go(-1);</script>";
        exit;
    }
    $estado = mysqli_fetch_assoc($query_estado);
    $codi_estado = $estado['codi_estado'];
    $descripcion_estado = $estado['descripcion'];
}

//*? SE VERIFICA SI EXISTEN CAMBIOS
$sql = "SELECT id_cliente, valor_fac, codi_estado FROM factura WHERE id_factura = '$identificador'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

$changes = array();
if ($row['id_cliente'] != $id_cliente) {
    $changes[] = "cliente";
}
if ($row['valor_fac'] != $valor) {
    $changes[] = "valor";
}
if (!empty($codi_estado) && $row['codi_estado'] != $codi_estado) {
    $changes[] = "estado";
}

if (empty($changes)) {
    echo "<script>window.alert('Los datos no han sido modificados.'); window.location.href='./index.php';</script>";
    exit;
}

//? SI HAY CAMBIOS SE PROCEDE CON LA ACTUALIZACIÓN DE DATOS
$sql = "UPDATE factura SET id_cliente = '$id_cliente', valor_fac = '$valor', codi_estado='$codi_estado'";
if (!empty($codi_estado)) {
    $sql .= ", codi_estado = '$codi_estado'";
}
$sql .= " WHERE id_factura = '$identificador'";
$query = mysqli_query($conn, $sql);

if ($query) {
    if (!empty($descripcion_estado)) {
        echo "<script>window.alert('Los datos se han actualizado con éxito. El estado de la factura ahora es $descripcion_estado.'); window.location.href='./index.php';</script>";
    } else {
        echo "<script>window.alert('Los datos se han actualizado con éxito.'); window.location.href='./index.php';</script>";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
