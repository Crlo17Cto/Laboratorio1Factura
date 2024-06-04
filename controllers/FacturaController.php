<?php
require_once 'models/Factura.php';
require_once 'models/Cliente.php';
require_once 'models/Producto.php';

class FacturaController
{
    public function generarFactura()
    {
        // Procesar el formulario de generación de factura
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idCliente = $_POST['idCliente'];
            $productosAgregados = $_POST['productos_agregados'] ?? [];

            // Validar que haya productos agregados
            if (empty($productosAgregados)) {
                echo "Debe seleccionar al menos un producto.";
                return;
            }

            // Preparar datos de productos para la generación de factura
            $productos = [];
            foreach ($productosAgregados as $producto) {
                if (isset($producto['id']) && isset($producto['cantidad'])) {
                    $productos[] = [
                        'id' => $producto['id'],
                        'cantidad' => $producto['cantidad']
                    ];
                }
            }

            // Validar que haya productos válidos
            if (empty($productos)) {
                echo "Debe proporcionar productos válidos.";
                return;
            }

            // Llamar al modelo para generar la factura
            Factura::generarFactura($idCliente, $productos);

            // Redireccionar a otra página (por ejemplo, página principal)
            header('Location: /facturacion_tienda/index.php?controller=factura&action=listarFacturas');
            exit();
        }


        $productos = Producto::obtenerTodos();

        // Vista del formulario de generación de factura
        require_once 'views/factura/formulario.php';
    }


    public function verDetalleFactura($referencia)
    {
        // Crear una instancia de Factura y obtener el detalle de la factura
        $factura = new Factura('', '', '', '', ''); // Pasar los valores adecuados para evitar el error
        $detalleFactura = $factura->obtenerDetalleFactura($referencia);

        // Si no se encontró información, redirigir al listado de facturas
        if (empty($detalleFactura)) {
            header('Location: /facturacion_tienda/index.php?controller=factura&action=listarFacturas');
            exit();
        }

        // Vista del detalle de la factura
        require_once 'views/factura/detalle.php';
    }



    public function cambiarEstadoFactura($referencia, $nuevoEstado)
    {
        // Verificar que el nuevo estado sea válido (Error, Cambio, Devolución)
        $estadosValidos = ['Error', 'Cambio', 'Devolución'];
        if (in_array($nuevoEstado, $estadosValidos)) {
            // Actualizar estado de la factura
            $conn = Database::connect();
            $sql = "UPDATE facturas SET estado = :estado WHERE refencia = :refencia";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':estado', $nuevoEstado);
            $stmt->bindParam(':refencia', $referencia);
            $stmt->execute();

            // Redireccionar al listado de facturas utilizando el controlador y la acción correspondientes
            header('Location: /facturacion_tienda/index.php?controller=factura&action=listarFacturas');
            exit();
        } else {
            echo "El estado proporcionado no es válido";
        }
    }
}
