<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Productos</title>
    <link rel="stylesheet" href="/facturacion_tienda/css/listadoPro.css">
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

    <h1>Listado de Productos</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
        </tr>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?php echo $producto['id']; ?></td>
                <td><?php echo $producto['nombre']; ?></td>
                <td><?php echo $producto['precio']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>

    <?php require_once 'views/partials/footer.php'; ?>
</body>
</html>
