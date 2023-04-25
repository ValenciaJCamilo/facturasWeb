<?php
require_once './config/conexion.php';
require_once './mainTable.php';

$conn = conexion();
$regFact = mostrar_registros_factura($conn);
$cargueEstados = mostrar_estados($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Desarrollo del punto número uno 'Prueba de Desarrollo', de la prueba técnica para aplicar a la empresa de Sistemas y Computadores SYC'">
    <link rel="stylesheet" href="./assets/style/style.css">
    <meta name="author" content="Juan Camilo Valencia Silva" />
    <meta name="copyright" content="Sistemas y Computadores SYC" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;500;600;700;800;900&display=swap" rel="stylesheet">
    <!--ICONSCOUT-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.0/css/line.css">
    <!--SWEETALERT2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Prueba de Desarrollo</title>
</head>
<body>    
    <section class="general-container">
        <div class="overview-general">
            <!--TÍTULO-->
            <div class="title">
                <h1 class="panel-title-name">PRUEBA DE DESARROLLO</h1>
            </div>
            <div class="title">
                <h2 class="panel-title-name">Facturas</h2>
            </div>
            <!--BOTÓN CREAR-->
            <div class="new-record-container">
                <label for="btn-modal-add-record" class="btn-add-record" title="Crear factura">
                    <i class="uil uil-plus-circle"></i>Nueva factura
                </label>
                <a class="btn-add-record btn-gestionClientes" title="Ir a sección de clientes" href="./clientes.php">
                <i class="uil uil-user"></i>Gestión de clientes
                </a>
            </div>
            <!--MODAL CREAR-->
            <input type="checkbox" id="btn-modal-add-record">
                <div class="container-modal-add-record">
                <div class="content-modal-add-record">
                <div class="title-info">
                    <div class="title-container">
                        <h3 class="content-modal-titulo">Nueva factura</h3>
                    </div>
                </div>
                    <p class="content-modal-recordatorio">Recuerde que * indica que el campo es obligatorio.</p>
                    <form action="./crearFact.php" method="POST" data-form="save" autocomplete="off">
                        <div class="input-field">
                            <input name="documento" type="number" placeholder="Número de documento del cliente*" pattern="[0-9]+" title="Por favor, complete el campo" required  />
                        </div>
                        <div class="input-field">
                            <input name="valor" type="number" placeholder="Valor *" pattern="[0-9]+" title="Por favor, complete el campo con un número entero positivo" required>
                        </div>
                        <div class="input-field ">
                            <div class="select-option">
                            <select name="tipoEstadoFactura" class="combobox-titulo" title="Si desea, seleccione algún estado">
                                <option selected disabled value="">Estado</option>
                                <?php
                                    require_once './config/conexion.php';
                                    while ($row = mysqli_fetch_array($cargueEstados)) {
                                    echo "<option value='" . $row['codi_estado'] . "'>" . $row['descripcion'] . "</option>";
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="botones-accion-modal">
                            <input type="submit" class="btn-submit-add-record" value="Crear" />
                            <label for="btn-modal-add-record" class="btn-close-add-record">Cerrar</label>
                        </div>
                    </form>
                </div>
                <label for="btn-modal-add-record" class="cerrar-modal"></label>
            </div>
            </div>
            <!--TABLA-->
            <div class="table-container">
                <table id="tablaFactura" class="tb-fact-records">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Fecha Facturación</th>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Descripción</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once './config/conexion.php';
                            $counter=1;
                            while($row=mysqli_fetch_array($regFact)){
                        ?>
                        <tr>
                            <td data-titulo="#"><?php echo $counter ?></td>
                            <td data-titulo="FECHA FACTURACIÓN" class="responsive-file"><?php echo $row['fecha_fac']?></td>
                            <td data-titulo="CLIENTE" class="responsive-file"><?php echo $row['nombre']?></td>
                            <td data-titulo="VALOR" class="responsive-file"><?php echo $row['valor_fac']?></td>
                            <td data-titulo="DESCRIPCIÓN" class="responsive-file"><?php echo $row['descripcion']?></td>
                            <td data-titulo="ACCIÓN" class="responsive-file">
                            <div class="action-options-container">
                                <div class="btn-group-action">
                                    <a href="#" class="btn-view-record" title="Ver reporte de cliente completo"><i class="uil uil-eye btn-view-record"></i></a>
                                    <a href="./editarFact-view.php?id=<?php echo $row['id_factura']?>" class="btn-edit-record" title="Editar factura"><i class="uil uil-edit btn-edit-record"></i></a>
                                    <a class="btn-delete-record" title="Eliminar factura" onclick="eliminarFactura(<?php echo $row['id_factura']?>)"><i class="uil uil-trash-alt"></i></a>
                                </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                            $counter++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        <div>
    </section>
</body>
<script src="./assets/js/alertas.js"></script>
</html>