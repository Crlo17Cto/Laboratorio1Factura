<?php
require_once 'models/Usuario.php'; // Asegúrate de incluir el modelo Usuario

class AuthController {
    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $usuario = Usuario::autenticar($username, $password);

        if ($usuario) {
            // Guardar usuario en la sesión
            $_SESSION['user'] = $usuario;
            header("Location: /facturacion_tienda/index.php");
            exit();
        } else {
            // Redirigir con error
            header("Location: /facturacion_tienda/views/auth/login.php?errorSesion=1");
            exit();
        }
    }

    public function logout() {
        session_destroy();
        header("Location: /facturacion_tienda/views/auth/login.php");
        exit();
    }
}
?>
