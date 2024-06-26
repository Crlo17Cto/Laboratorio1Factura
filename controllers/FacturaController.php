<?php
require_once 'models/Factura.php';
require_once 'models/Cliente.php';
require_once 'models/Producto.php';

class FacturaController
{
    public function generarFactura()
    {
        // Verificar si hay clientes en la base de datos
        $clientes = Cliente::obtenerTodos();
        if (empty($clientes)) {
            // Redirigir al formulario de registro de cliente si no hay clientes
            header('Location: /Laboratorio1Factura/views/cliente/registro.php');
            exit();
        }

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
            header('Location: /Laboratorio1Factura/index.php?controller=factura&action=listarFacturas');
            exit();
        }

        // Obtener listado de clientes y productos para mostrar en el formulario
        $clientes = Cliente::obtenerTodos();
        $productos = Producto::obtenerTodos();

        // Vista del formulario de generación de factura
        require_once 'views/factura/formulario.php';
    }

    // Otros métodos del controlador...

    public function listarFacturas()
    {
        // Obtener todas las facturas generadas
        $facturas = Factura::obtenerFacturas();

        // Vista del listado de facturas
        require_once 'views/factura/listado.php';
    }


    public function verDetalleFactura($referencia)
    {
        // Crear una instancia de Factura y obtener el detalle de la factura
        $factura = new Factura('', '', '', '', ''); // Pasar los valores adecuados para evitar el error
        $detalleFactura = $factura->obtenerDetalleFactura($referencia);

        // Si no se encontró información, redirigir al listado de facturas
        if (empty($detalleFactura)) {
            header('Location: /Laboratorio1Factura/index.php?controller=factura&action=listarFacturas');
            exit();
        }

        // Vista del detalle de la factura
        require_once 'views/factura/detalle.php';
    }



    public function registrarCliente()
    {
        // Este método registra un nuevo cliente
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombreCompleto = $_POST['nombreCompleto'];
            $tipoDocumento = $_POST['tipoDocumento'];
            $numeroDocumento = $_POST['numeroDocumento'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];

            // Aquí debes validar y sanitizar los datos antes de insertar en la base de datos

            $resultado = Cliente::registrarCliente($nombreCompleto, $tipoDocumento, $numeroDocumento, $telefono, $email);

            if ($resultado) {
                echo "Cliente registrado correctamente.";
            } else {
                echo "Error al registrar el cliente.";
            }
        }

        // Vista del formulario de registro de cliente
        require_once 'views/cliente/registro.php';
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
            header('Location: /Laboratorio1Factura/index.php?controller=factura&action=listarFacturas');
            exit();
        } else {
            echo "El estado proporcionado no es válido";
        }
    }
}
