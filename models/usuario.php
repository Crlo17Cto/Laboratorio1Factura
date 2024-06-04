<?php
class Usuario {
    public static function autenticar($username, $password) {
        $conn = Database::connect();
        $sql = "SELECT * FROM usuarios WHERE usuario = :username AND pwd = :password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
