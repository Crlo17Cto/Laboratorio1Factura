<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >Listado de Facturas</title>
    <link rel="stylesheet" href="/Laboratorio1Factura/css/listado.css">
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
    <?php require_once __DIR__ . '/../partials/header.php'; ?>

    <div class="container">
        <h1 >Listado de Facturas</h1>

        <table>
            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($facturas as $factura) : ?>
                    <tr>
                        <td><?php echo $factura['refencia']; ?></td>
                        <td><?php echo $factura['fecha']; ?></td>
                        <td><?php echo $factura['estado']; ?></td>
                        <td>
                            <a href="/Laboratorio1Factura/index.php?controller=factura&action=verDetalleFactura&referencia=<?php echo $factura['refencia']; ?>">Ver Detalle</a>
                            <?php if ($factura['estado'] == 'Pagada') : ?>
                                | <a href="/Laboratorio1Factura/index.php?controller=factura&action=cambiarEstadoFactura&referencia=<?php echo $factura['refencia']; ?>&estado=Error">Error</a>
                                | <a href="/Laboratorio1Factura/index.php?controller=factura&action=cambiarEstadoFactura&referencia=<?php echo $factura['refencia']; ?>&estado=Cambio">Cambio</a>
                                | <a href="/Laboratorio1Factura/index.php?controller=factura&action=cambiarEstadoFactura&referencia=<?php echo $factura['refencia']; ?>&estado=Devolución">Devolución</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>
