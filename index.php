<?php
session_start();

require_once 'config/Database.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user']) && ($_GET['controller'] !== 'auth' || $_GET['action'] !== 'login')) {
    header('Location: /Laboratorio1Factura/views/auth/login.php');
    exit();
}

// Enrutamiento básico
$controller = $_GET['controller'] ?? null;
$action = $_GET['action'] ?? null;

ob_start(); // Inicia el almacenamiento en búfer de salida

if ($controller === null && $action === null) {
    require_once 'views/partials/inicio.php';
} else {
    switch ($controller) {
        case 'factura':
            require_once 'controllers/FacturaController.php';
            $facturaController = new FacturaController();

            switch ($action) {
                case 'generarFactura':
                    $facturaController->generarFactura();
                    break;
                case 'listarFacturas':
                    $facturaController->listarFacturas();
                    break;
                case 'verDetalleFactura':
                    $referencia = $_GET['referencia'] ?? null;
                    if ($referencia) {
                        $facturaController->verDetalleFactura($referencia);
                    } else {
                        echo "Referencia de factura no válida.";
                    }
                    break;
                case 'cambiarEstadoFactura':
                    $referencia = $_GET['referencia'] ?? null;
                    $nuevoEstado = $_GET['estado'] ?? null;
                    if ($referencia && $nuevoEstado) {
                        $facturaController->cambiarEstadoFactura($referencia, $nuevoEstado);
                    } else {
                        echo "Datos de factura no válidos.";
                    }
                    break;
                default:
                    echo "Acción no válida para factura";
                    break;
            }
            break;

        case 'producto':
            require_once 'controllers/ProductoController.php';
            $productoController = new ProductoController();

            switch ($action) {
                case 'listarProductos':
                    $productoController->listarProductos();
                    break;
                default:
                    echo "Acción no válida para producto";
                    break;
            }
            break;

        case 'auth':
            require_once 'controllers/AuthController.php';
            $authController = new AuthController();

            switch ($action) {
                case 'login':
                    $authController->login();
                    break;
                case 'logout':
                    $authController->logout();
                    break;
                default:
                    echo "Acción no válida para autenticación";
                    break;
            }
            break;

        case 'cliente':
            require_once 'controllers/ClienteController.php';
            $clienteController = new ClienteController();

            switch ($action) {
                case 'mostrarFormularioRegistro':
                    $clienteController->mostrarFormularioRegistro();
                    break;
                case 'registrar':
                    $clienteController->registrarCliente();
                    break;
                default:
                    echo "Acción no válida para cliente";
                    break;
            }
            break;

        default:
            echo "Controlador no válido";
            break;
    }
}

$content = ob_get_clean(); // Obtiene el contenido del búfer y lo limpia
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación Tienda</title>
</head>

<body>
    <?php require_once 'views/partials/header.php'; ?>
    <div class="container">
        <?php echo $content; // Imprime el contenido dinámico 
        ?>
    </div>
    <?php require_once 'views/partials/footer.php'; ?>
</body>

</html>