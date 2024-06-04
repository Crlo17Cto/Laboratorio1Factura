<?php
// /facturacion_tienda/controllers/ClienteController.php
require_once 'models/Cliente.php';

class ClienteController {
    public function mostrarFormularioRegistro() {
        // Vista del formulario de registro
        require_once 'views/cliente/registro.php';
    }

    public function registrarCliente() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombreCompleto = $_POST['nombreCompleto'];
            $tipoDocumento = $_POST['tipoDocumento'];
            $numeroDocumento = $_POST['numeroDocumento'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];

            // Guardar cliente en la base de datos
            Cliente::registrarCliente($nombreCompleto, $tipoDocumento, $numeroDocumento, $telefono, $email);

            // Redirigir al formulario de generación de factura con el nuevo cliente seleccionado
            header('Location: /facturacion_tienda/index.php?controller=factura&action=generarFactura');
            exit();
        }
    }
}
?>




