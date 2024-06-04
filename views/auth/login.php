<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        body.bodyLogin {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url('/Laboratorio1Factura/resource/login.jpg') no-repeat center center fixed; 
            background-size: cover;
        }

        .containerLogin {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco con transparencia */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .containerLogin h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            font-family: 'Roboto', sans-serif;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .input-group input {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .btnLogin {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .btnLogin:hover {
            background-color: #45a049;
        }

        .h4Login {
            color: red;
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
        }
    </style>
</head>
<body class="bodyLogin">
    <div class="containerLogin">
        <h2>Iniciar Sesión</h2>
        <form action="/Laboratorio1Factura/index.php?controller=auth&action=login" method="post">
            <div class="input-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btnLogin">Iniciar Sesión</button>
        </form>
        <?php if (!empty($_GET['errorSesion'])): ?>
            <h4 class="h4Login">Usuario o contraseña incorrectos.</h4>
        <?php endif; ?>
    </div>
</body>
</html>
