<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cliente</title>
    <link rel="stylesheet" href="/Laboratorio1Factura/css/registro.css">
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

    <div class="container">
        <h2>Registro de Cliente</h2>
        <form id="clienteForm" method="post" action="/Laboratorio1Factura/index.php?controller=cliente&action=registrar">
            <div>
                <label for="nombreCompleto">Nombre Completo:</label>
                <input type="text" id="nombreCompleto" name="nombreCompleto" required>
            </div>
            <div>
                <label for="tipoDocumento">Tipo de Documento:</label>
                <select id="tipoDocumento" name="tipoDocumento" required>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="CE">Cédula de Extranjería</option>
                    <option value="PA">Pasaporte</option>
                </select>
            </div>
            <div>
                <label for="numeroDocumento">Número de Documento:</label>
                <input type="text" id="numeroDocumento" name="numeroDocumento" required>
            </div>
            <div>
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit">Registrar Cliente</button>
        </form>
        <br>
        <br>
        <a href="/Laboratorio1Factura/index.php?controller=factura&action=generarFactura">Volver a la generación de factura</a>
    </div>

    <?php require_once 'views/partials/footer.php'; ?>
</body>

</html>