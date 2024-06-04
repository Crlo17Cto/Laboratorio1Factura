<header>
    <h1 class="h1Header">Facturación Tienda Deportiva</h1>
    <nav>
        <ul>
            <li><a href="/facturacion_tienda/index.php">Inicio</a></li>
            <li><a href="/facturacion_tienda/index.php?controller=factura&action=listarFacturas">Listar Facturas</a></li>
            <li><a href="/facturacion_tienda/index.php?controller=factura&action=generarFactura">Generar Factura</a></li>
            <li><a href="/facturacion_tienda/index.php?controller=producto&action=listarProductos">Listar Productos</a></li>
            <?php if (isset($_SESSION['user'])) : ?>
                <li><a href="/facturacion_tienda/index.php?controller=auth&action=logout">Cerrar Sesión</a></li>
            <?php else : ?>
                <li><a href="/facturacion_tienda/views/auth/login.php">Iniciar Sesión</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
