<?php
class Database {
    private static $host = 'localhost';
    private static $dbName = 'facturacion_tienda_db';
    private static $username = 'root';
    private static $password = '';

    public static function connect() {
        try {
            $conn = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName, self::$username, self::$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo 'Error de conexión: '.$e->getMessage();
            die();
        }
    }
}
?>
