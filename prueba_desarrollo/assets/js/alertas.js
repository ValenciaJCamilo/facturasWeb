function eliminarFactura(id) {
    if (confirm('¿Estás seguro de que deseas eliminar esta factura?')) {
        window.location.href = 'deleteFac.php?id=' + id;
    }
}