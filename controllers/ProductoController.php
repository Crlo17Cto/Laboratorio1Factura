<?php
require_once 'models/Producto.php';

class ProductoController {
    public function listarProductos() {
        // Obtener todos los productos de la base de datos
        $productos = Producto::obtenerTodos();

        // Vista del listado de productos
        require_once 'views/productos/listado.php';
    }
}
?>

