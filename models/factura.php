<?php
class Factura {
    private $referencia;
    private $fecha;
    private $idCliente;
    private $estado;
    private $descuento;
    private $productos;

    public function __construct($referencia, $fecha, $idCliente, $estado, $descuento, $productos = []) {
        $this->referencia = $referencia;
        $this->fecha = $fecha;
        $this->idCliente = $idCliente;
        $this->estado = $estado;
        $this->descuento = $descuento;
        $this->productos = $productos;
    }

    public static function generarFactura($idCliente, $productos) {
        $fecha = date('Y-m-d H:i:s');
        $descuento = self::calcularDescuento($productos);

        $conn = Database::connect();
        $sql = "INSERT INTO facturas (refencia, fecha, idCliente, estado, descuento)
                VALUES (:refencia, :fecha, :idCliente, 'Pagada', :descuento)";
        $stmt = $conn->prepare($sql);

        $referencia = self::generarReferencia();
        $stmt->bindParam(':refencia', $referencia);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':idCliente', $idCliente);
        $stmt->bindParam(':descuento', $descuento);
        $stmt->execute();

        // Insertar detalles de la factura
        foreach ($productos as $producto) {
            $idProducto = $producto['id'];
            $cantidad = $producto['cantidad'];
            $precioUnitario = Producto::obtenerPorId($idProducto)['precio'];

            $sqlDetalle = "INSERT INTO detallefacturas (cantidad, precioUnitario, idArticulo, refenciaFactura)
                           VALUES (:cantidad, :precioUnitario, :idArticulo, :refenciaFactura)";
            $stmtDetalle = $conn->prepare($sqlDetalle);
            $stmtDetalle->bindParam(':cantidad', $cantidad);
            $stmtDetalle->bindParam(':precioUnitario', $precioUnitario);
            $stmtDetalle->bindParam(':idArticulo', $idProducto);
            $stmtDetalle->bindParam(':refenciaFactura', $referencia);
            $stmtDetalle->execute();
        }
    }

    private static function calcularDescuento($productos) {
        $totalCompra = 0;

        foreach ($productos as $producto) {
            $idProducto = $producto['id'];
            $cantidad = $producto['cantidad'];
            $precioUnitario = Producto::obtenerPorId($idProducto)['precio'];

            $totalCompra += $cantidad * $precioUnitario;
        }

        if ($totalCompra > 200000) {
            return '10'; // 10% de descuento
        } elseif ($totalCompra > 100000) {
            return '5'; // 5% de descuento
        } else {
            return '0'; // Sin descuento
        }
    }

    private static function generarReferencia() {
        return uniqid('FACTURA_');
    }

    public static function obtenerFacturas() {
        $conn = Database::connect();
        $sql = "SELECT * FROM facturas";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerDetalleFactura($referencia) {
        $conn = Database::connect();
        $sql = "SELECT f.refencia, f.fecha, f.estado, c.nombreCompleto, c.tipoDocumento, 
                       c.numeroDocumento, c.telefono, c.email,
                       d.cantidad, d.precioUnitario, 
                       d.cantidad * d.precioUnitario AS valorTotal,
                       f.descuento,
                       p.nombre AS nombreProducto
                FROM facturas f
                INNER JOIN clientes c ON f.idCliente = c.id
                INNER JOIN detallefacturas d ON f.refencia = d.refenciaFactura
                INNER JOIN articulos p ON d.idArticulo = p.id
                WHERE f.refencia = :refencia";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':refencia', $referencia);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

