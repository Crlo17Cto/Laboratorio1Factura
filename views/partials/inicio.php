<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="/Laboratorio1Factura/css/inicio.css">
    <!--letra body-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Danfo&family=Jaro:opsz@6..72&family=Jersey+25+Charted&family=Permanent+Marker&family=
    Rubik+Mono+One&display=swap" rel="stylesheet">
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
        <h1 class="inicio">'Bienvenido'</h1>
        <div class="video-container">
            <video autoplay muted loop>
                <source src="/Laboratorio1Factura/resource/animated.mp4" type="video/mp4">
            </video>
        </div>
    </div>
    <br>
    <br>
    <br>
    <?php require_once 'views/partials/footer.php'; ?>
</body>

</html>