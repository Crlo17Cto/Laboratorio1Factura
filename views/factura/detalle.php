<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Factura</title>
    <link rel="stylesheet" href="/facturacion_tienda/css/detalle.css">
      <!--letra titulo header-->
      <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Danfo&family=Jaro:opsz@6..72&family=Jersey+25+Charted&family=
    Permanent+Marker&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <!--letra opciones header-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Danfo&family=Jaro:opsz@6..72&family=Jersey+25+Charted&family=
    Oleo+Script:wght@400;700&family=Permanent+Marker&family=Rubik+Mono+One&display=swap" rel="stylesheet">
</head>
<body>
    <?php require_once 'views/partials/header.php'; ?>

    <h1 class="detalle-factura-titulo">Detalle de Factura</h1>

    <?php if (!empty($detalleFactura)): ?>
        <h2>Información de la Factura</h2>
        <p><strong>Referencia:</strong> <?php echo $detalleFactura[0]['refencia']; ?></p>
        <p><strong>Fecha:</strong> <?php echo $detalleFactura[0]['fecha']; ?></p>
        <p><strong>Estado:</strong> <?php echo $detalleFactura[0]['estado']; ?></p>
        
        <h2>Información del Cliente</h2>
        <p><strong>Nombre:</strong> <?php echo $detalleFactura[0]['nombreCompleto']; ?></p>
        <p><strong>Tipo de Documento:</strong> <?php echo $detalleFactura[0]['tipoDocumento']; ?></p>
        <p><strong>Número de Documento:</strong> <?php echo $detalleFactura[0]['numeroDocumento']; ?></p>
        <p><strong>Teléfono:</strong> <?php echo $detalleFactura[0]['telefono']; ?></p>
        <p><strong>Email:</strong> <?php echo $detalleFactura[0]['email']; ?></p>

        <h2>Detalle de Productos</h2>
        <table>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Valor Total</th>
            </tr>
            <?php 
                $totalPagar = 0;
                foreach ($detalleFactura as $detalle): 
                    $totalPagar += $detalle['valorTotal'];
            ?>
                <tr>
                    <td><?php echo $detalle['nombreProducto']; ?></td>
                    <td><?php echo $detalle['cantidad']; ?></td>
                    <td>$ <?php echo number_format($detalle['precioUnitario'], 2); ?></td>
                    <td>$ <?php echo number_format($detalle['valorTotal'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php 
            $descuento = (int)$detalleFactura[0]['descuento']; // Convertir descuento a entero
            $totalConDescuento = $totalPagar * (1 - $descuento / 100);
        ?>
        <h2>Resumen de la Factura</h2>
        <?php if ($descuento > 0): ?>
            <p><strong>Descuento:</strong> <?php echo $descuento; ?>%</p>
        <?php endif; ?>
        <p><strong>Total a pagar:</strong> $ <?php echo number_format($totalConDescuento, 2); ?></p>
    <?php else: ?>
        <p>No se encontró información de la factura.</p>        
    <?php endif; ?>

    <?php require_once 'views/partials/footer.php'; ?>
</body>
</html>
