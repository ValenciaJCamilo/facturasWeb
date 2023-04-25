<?php
require_once './config/conexion.php';
$conn = conexion();

//Obtener el valor del campo "documento" enviado por el formulario
$documento_cliente = $_POST['documento'];

//Validar si el número de documento existe en la tabla de clientes y obtener su ID
$sql = "SELECT id FROM clientes WHERE nume_doc = '$documento_cliente'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
    $row_cliente = mysqli_fetch_assoc($result);
    $id_cliente = $row_cliente['id'];
    $valor = $_POST['valor'];
    $codi_estado = $_POST['tipoEstadoFactura'];

    //Validar que el campo "valor" contenga solo números enteros positivos mayores a cero
    if (!preg_match('/^[1-9]\d*$/', $valor)) {
      echo "<script>window.alert('El campo Valor debe ser un número entero positivo mayor a cero'); window.history.go(-1);</script>";
      exit;
    }

    $sql = "INSERT INTO factura (fecha_fac, id_cliente, valor_fac, codi_estado) VALUES (CURRENT_TIMESTAMP, '$id_cliente', '$valor', ";
    $sql .= ($codi_estado === null) ? "NULL)" : "'$codi_estado')";
    $query = mysqli_query($conn, $sql);

    if($query) {
    header("Location: ./index.php");
    } else {
      echo "<script>window.alert('Error al intentar crear la factura :('); window.history.go(-1);</script>";
    }
} else {
  //Si el número de documento no existe en la tabla de clientes, mostrar un mensaje de error y no continuar con el insert en la tabla factura
  echo "<script>window.alert('El número de documento ingresado no está asociado a ningún cliente :('); window.history.go(-1);</script>";
}
?>
