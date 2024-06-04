<?php
class Cliente
{
    private $id;
    private $nombreCompleto;
    private $tipoDocumento;
    private $numeroDocumento;
    private $email;
    private $telefono;

    public function __construct($id, $nombreCompleto, $tipoDocumento, $numeroDocumento, $email, $telefono)
    {
        $this->id = $id;
        $this->nombreCompleto = $nombreCompleto;
        $this->tipoDocumento = $tipoDocumento;
        $this->numeroDocumento = $numeroDocumento;
        $this->email = $email;
        $this->telefono = $telefono;
    }

    public static function obtenerTodos()
    {
        $conn = Database::connect();
        $sql = "SELECT id, nombreCompleto FROM clientes";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerClientePorId($id)
    {
        $conn = Database::connect();
        $sql = "SELECT * FROM clientes WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function registrarCliente($nombreCompleto, $tipoDocumento, $numeroDocumento, $telefono, $email)
    {
        try {
            $conn = Database::connect();

            $sql = "INSERT INTO clientes (nombreCompleto, tipoDocumento, numeroDocumento, telefono, email) 
                    VALUES (:nombreCompleto, :tipoDocumento, :numeroDocumento, :telefono, :email)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombreCompleto', $nombreCompleto);
            $stmt->bindParam(':tipoDocumento', $tipoDocumento);
            $stmt->bindParam(':numeroDocumento', $numeroDocumento);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':email', $email);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function actualizarCliente()
    {
        $conn = Database::connect();
        $sql = "UPDATE clientes 
                SET nombreCompleto = :nombreCompleto, tipoDocumento = :tipoDocumento, 
                    numeroDocumento = :numeroDocumento, email = :email, telefono = :telefono
                WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nombreCompleto', $this->nombreCompleto);
        $stmt->bindParam(':tipoDocumento', $this->tipoDocumento);
        $stmt->bindParam(':numeroDocumento', $this->numeroDocumento);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':telefono', $this->telefono);
        return $stmt->execute();
    }
}
